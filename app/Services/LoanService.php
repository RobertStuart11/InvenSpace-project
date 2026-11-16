<?php

namespace App\Services;

use App\Models\Item;
use App\Models\Loan;
use App\Models\StockMutation;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class LoanService
{
    /**
     * Student submits a loan request.
     *
     * @param  array{tanggal_pinjam: string, tanggal_kembali_rencana: string, tujuan?: ?string, items: array<int, array{id_barang: int, jumlah_pinjam: int}>}  $data
     */
    public function ajukan(User $siswa, array $data): Loan
    {
        if (! $siswa->isSiswa()) {
            $this->gagal('siswa', 'Hanya siswa yang dapat mengajukan peminjaman.');
        }

        $tanggalPinjam = Carbon::parse($data['tanggal_pinjam'])->startOfDay();
        $tanggalKembali = Carbon::parse($data['tanggal_kembali_rencana'])->startOfDay();

        if ($tanggalPinjam->lt(today())) {
            $this->gagal('tanggal_pinjam', 'Tanggal pinjam tidak boleh sebelum hari ini.');
        }

        if ($tanggalKembali->lt($tanggalPinjam)) {
            $this->gagal('tanggal_kembali_rencana', 'Tanggal kembali tidak boleh sebelum tanggal pinjam.');
        }

        $lines = collect($data['items'] ?? [])->map(fn ($line) => [
            'id_barang' => (int) $line['id_barang'],
            'jumlah_pinjam' => (int) $line['jumlah_pinjam'],
        ]);

        if ($lines->isEmpty()) {
            $this->gagal('items', 'Pilih minimal satu barang.');
        }

        $ids = $lines->pluck('id_barang');

        if ($ids->count() !== $ids->unique()->count()) {
            $this->gagal('items', 'Satu barang hanya boleh dipilih sekali.');
        }

        if ($lines->contains(fn ($line) => $line['jumlah_pinjam'] < 1)) {
            $this->gagal('items', 'Jumlah pinjam minimal 1.');
        }

        return DB::transaction(function () use ($siswa, $data, $tanggalPinjam, $tanggalKembali, $lines, $ids) {
            $items = Item::whereIn('id_barang', $ids)->lockForUpdate()->get()->keyBy('id_barang');

            foreach ($lines as $line) {
                $item = $items->get($line['id_barang']);

                if (! $item) {
                    $this->gagal('items', 'Barang tidak ditemukan.');
                }

                if ($item->kondisi !== 'baik') {
                    $this->gagal('items', "Barang {$item->nama_barang} sedang tidak berkondisi baik.");
                }

                if ($line['jumlah_pinjam'] > $item->stok_tersedia) {
                    $this->gagal('items', "Stok {$item->nama_barang} tidak cukup (tersedia {$item->stok_tersedia} {$item->satuan}).");
                }
            }

            $loan = Loan::create([
                'id_siswa' => $siswa->id_user,
                'tanggal_ajuan' => today()->toDateString(),
                'tanggal_pinjam' => $tanggalPinjam->toDateString(),
                'tanggal_kembali_rencana' => $tanggalKembali->toDateString(),
                'tujuan' => $data['tujuan'] ?? null,
            ]);

            $loan->loanItems()->createMany($lines->all());

            return $loan->fresh('loanItems.item');
        });
    }

    public function setujui(Loan $loan, User $guru, ?string $catatan = null): Loan
    {
        return DB::transaction(function () use ($loan, $guru, $catatan) {
            $loan = $this->kunciDiajukan($loan, $guru);

            if ($loan->tanggal_kembali_rencana->lt(today())) {
                $this->gagal('status', 'Peminjaman sudah melewati tanggal kembali yang direncanakan.');
            }

            $items = Item::whereIn('id_barang', $loan->loanItems->pluck('id_barang'))
                ->lockForUpdate()
                ->get()
                ->keyBy('id_barang');

            foreach ($loan->loanItems as $line) {
                $item = $items->get($line->id_barang);

                if ($item->kondisi !== 'baik') {
                    $this->gagal('items', "Barang {$item->nama_barang} sedang tidak berkondisi baik.");
                }

                if ($line->jumlah_pinjam > $item->stok_tersedia) {
                    $this->gagal('items', "Stok {$item->nama_barang} tidak cukup untuk disetujui (tersedia {$item->stok_tersedia} {$item->satuan}).");
                }
            }

            return $this->catatKeputusan($loan, $guru, 'disetujui', $catatan);
        });
    }

    public function tolak(Loan $loan, User $guru, string $catatan): Loan
    {
        if (trim($catatan) === '') {
            $this->gagal('catatan_validator', 'Alasan penolakan wajib diisi.');
        }

        return DB::transaction(function () use ($loan, $guru, $catatan) {
            $loan = $this->kunciDiajukan($loan, $guru);

            return $this->catatKeputusan($loan, $guru, 'ditolak', $catatan);
        });
    }

    private function kunciDiajukan(Loan $loan, User $guru): Loan
    {
        if (! $guru->isGuru()) {
            $this->gagal('guru', 'Hanya guru yang dapat memvalidasi peminjaman.');
        }

        $loan = Loan::whereKey($loan->getKey())->lockForUpdate()->firstOrFail();

        if ($loan->status !== 'diajukan') {
            $this->gagal('status', "Peminjaman ini sudah diproses (status: {$loan->status}).");
        }

        return $loan->load('loanItems');
    }

    private function catatKeputusan(Loan $loan, User $guru, string $status, ?string $catatan): Loan
    {
        $loan->forceFill([
            'status' => $status,
            'id_guru_validator' => $guru->id_user,
            'tanggal_validasi' => today()->toDateString(),
            'catatan_validator' => $catatan,
        ])->save();

        return $loan->fresh('loanItems.item');
    }
    public function serahkan(Loan $loan, User $admin): Loan
    {
        return DB::transaction(function () use ($loan, $admin) {
            $loan = $this->kunciUntukAdmin($loan, $admin, 'disetujui');

            $items = Item::whereIn('id_barang', $loan->loanItems->pluck('id_barang'))
                ->lockForUpdate()
                ->get()
                ->keyBy('id_barang');

            foreach ($loan->loanItems as $line) {
                $item = $items->get($line->id_barang);

                if ($item->kondisi !== 'baik') {
                    $this->gagal('items', "Barang {$item->nama_barang} sedang tidak berkondisi baik.");
                }

                if ($item->stok_tersedia < 0) {
                    $this->gagal('items', "Stok {$item->nama_barang} tidak mencukupi untuk diserahkan.");
                }
            }

            $loan->forceFill(['status' => 'dipinjam'])->save();

            return $loan->fresh('loanItems.item');
        });
    }

    /**
     * @param  array<int, array{id_barang: int, jumlah_rusak?: int, jumlah_hilang?: int}>  $laporan
     */
    public function kembalikan(Loan $loan, User $admin, array $laporan = []): Loan
    {
        $ids = collect($laporan)->pluck('id_barang')->map(fn ($id) => (int) $id);

        if ($ids->count() !== $ids->unique()->count()) {
            $this->gagal('laporan', 'Satu barang hanya boleh dilaporkan sekali.');
        }

        return DB::transaction(function () use ($loan, $admin, $laporan) {
            $loan = $this->kunciUntukAdmin($loan, $admin, 'dipinjam');

            $baris = $loan->loanItems->keyBy('id_barang');
            $items = Item::whereIn('id_barang', $baris->keys())
                ->lockForUpdate()
                ->get()
                ->keyBy('id_barang');

            foreach ($laporan as $r) {
                $idBarang = (int) $r['id_barang'];
                $rusak = (int) ($r['jumlah_rusak'] ?? 0);
                $hilang = (int) ($r['jumlah_hilang'] ?? 0);

                if (! $baris->has($idBarang)) {
                    $this->gagal('laporan', 'Barang pada laporan tidak termasuk dalam peminjaman ini.');
                }

                $item = $items->get($idBarang);

                if ($rusak < 0 || $hilang < 0 || $rusak + $hilang > $baris->get($idBarang)->jumlah_pinjam) {
                    $this->gagal('laporan', "Jumlah rusak/hilang tidak valid untuk {$item->nama_barang}.");
                }

                $this->catatKeluar($loan, $admin, $item, $rusak, 'Rusak');
                $this->catatKeluar($loan, $admin, $item, $hilang, 'Hilang');
            }

            $loan->forceFill([
                'status' => 'dikembalikan',
                'tanggal_kembali_aktual' => today()->toDateString(),
            ])->save();

            return $loan->fresh('loanItems.item');
        });
    }

    private function kunciUntukAdmin(Loan $loan, User $admin, string $statusSyarat): Loan
    {
        if (! $admin->isAdmin()) {
            $this->gagal('admin', 'Hanya admin yang dapat melakukan serah-terima barang.');
        }

        $loan = Loan::whereKey($loan->getKey())->lockForUpdate()->firstOrFail();

        if ($loan->status !== $statusSyarat) {
            $this->gagal('status', "Peminjaman berstatus {$loan->status}; diperlukan status {$statusSyarat}.");
        }

        return $loan->load('loanItems');
    }

    private function catatKeluar(Loan $loan, User $admin, Item $item, int $jumlah, string $alasan): void
    {
        if ($jumlah === 0) {
            return;
        }

        if ($item->stok_total < $jumlah) {
            $this->gagal('laporan', "Stok {$item->nama_barang} lebih kecil dari jumlah yang dilaporkan.");
        }

        $item->decrement('stok_total', $jumlah);

        StockMutation::create([
            'id_barang' => $item->id_barang,
            'id_user' => $admin->id_user,
            'id_peminjaman' => $loan->id_peminjaman,
            'jumlah' => $jumlah,
            'tipe' => 'KELUAR',
            'keterangan' => "{$alasan} saat peminjaman #{$loan->id_peminjaman}",
        ]);
    }
    private function gagal(string $field, string $pesan): never
    {
        throw ValidationException::withMessages([$field => $pesan]);
    }
}