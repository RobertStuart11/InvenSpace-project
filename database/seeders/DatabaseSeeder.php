<?php

namespace Database\Seeders;

use App\Models\Complaint;
use App\Models\Item;
use App\Models\Loan;
use App\Models\Role;
use App\Models\StockMutation;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Roles
        $roles = [];
        foreach (['admin', 'guru', 'siswa'] as $nama) {
            $roles[$nama] = Role::firstOrCreate(['nama_role' => $nama]);
        }

        // Users (password di-hash otomatis oleh cast 'hashed')
        $admin = User::firstOrCreate(['username' => 'admin'], [
            'role_id' => $roles['admin']->id_role,
            'nama' => 'Admin InvenSpace',
            'password' => 'password',
        ]);
        $guru = User::firstOrCreate(['username' => 'budiguru'], [
            'role_id' => $roles['guru']->id_role,
            'nama' => 'Budi Santoso',
            'password' => 'password',
            'nip' => '198501152010011002',
        ]);
        $siswa = User::firstOrCreate(['username' => 'sitisiswa'], [
            'role_id' => $roles['siswa']->id_role,
            'nama' => 'Siti Aminah',
            'password' => 'password',
            'kelas' => 'XI IPA 2',
        ]);

        // Barang + mutasi stok awal
        $dataBarang = [
            ['INV-001', 'Proyektor Epson X500',  'Elektronik', 5,  5,  'unit', 'baik'],
            ['INV-002', 'Laptop Lenovo ThinkPad', 'Elektronik', 12, 4,  'unit', 'baik'],
            ['INV-003', 'Mikroskop Binokuler',    'Lab',        6,  6,  'unit', 'baik'],
            ['INV-004', 'Kabel HDMI 5m',          'Aksesoris',  4,  4,  'buah', 'baik'],
            ['INV-005', 'Kursi Lipat',            'Furniture',  40, 20, 'buah', 'baik'],
            ['INV-006', 'Meja Lipat',             'Furniture',  15, 10, 'buah', 'baik'],
            ['INV-007', 'Spidol Whiteboard',      'Alat Tulis', 80, 30, 'pcs',  'baik'],
            ['INV-008', 'Tabung Reaksi',          'Lab',        25, 15, 'pcs',  'baik'],
        ];

        $items = [];
        foreach ($dataBarang as [$kode, $nama, $kategori, $stok, $min, $satuan, $kondisi]) {
            $item = Item::firstOrCreate(['kode_barang' => $kode], [
                'nama_barang' => $nama,
                'kategori' => $kategori,
                'stok_total' => $stok,
                'stok_minimum' => $min,
                'satuan' => $satuan,
                'kondisi' => $kondisi,
            ]);

            if ($item->wasRecentlyCreated) {
                StockMutation::create([
                    'id_barang' => $item->id_barang,
                    'id_user' => $admin->id_user,
                    'jumlah' => $stok,
                    'tipe' => 'MASUK',
                    'keterangan' => 'Stok awal',
                ]);
            }
            $items[$kode] = $item;
        }

        // Contoh peminjaman & komplain (hanya jika masih kosong)
        if (Loan::count() === 0) {
            $l1 = Loan::create([
                'id_siswa' => $siswa->id_user,
                'tanggal_ajuan' => now()->toDateString(),
                'tanggal_pinjam' => now()->addDay()->toDateString(),
                'tanggal_kembali_rencana' => now()->addDays(2)->toDateString(),
                'tujuan' => 'Presentasi kelas',
            ]);
            $l1->loanItems()->create([
                'id_barang' => $items['INV-001']->id_barang,
                'jumlah_pinjam' => 1,
            ]);

            $l2 = Loan::create([
                'id_siswa' => $siswa->id_user,
                'tanggal_ajuan' => now()->subDays(2)->toDateString(),
                'tanggal_pinjam' => now()->subDay()->toDateString(),
                'tanggal_kembali_rencana' => now()->addDay()->toDateString(),
                'tujuan' => 'Rapat OSIS',
            ]);
            $l2->forceFill([
                'status' => 'dipinjam',
                'id_guru_validator' => $guru->id_user,
                'tanggal_validasi' => now()->subDays(2)->toDateString(),
            ])->save();
            $l2->loanItems()->create([
                'id_barang' => $items['INV-005']->id_barang,
                'jumlah_pinjam' => 10,
            ]);

            Complaint::create([
                'id_siswa' => $siswa->id_user,
                'id_peminjaman' => $l2->id_peminjaman,
                'judul' => 'Kursi lipat patah',
                'isi' => 'Salah satu kursi patah pada bagian kaki.',
                'prioritas' => 'sedang',
            ]);
        }
    }
}