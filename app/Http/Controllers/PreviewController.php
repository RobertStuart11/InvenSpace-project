<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class PreviewController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function dashboard()
    {
        return view('dashboard', [
            'stats' => [
                ['label' => 'Total Barang',      'value' => '248', 'delta' => '+12 bulan ini',           'icon' => 'box',         'color' => 'indigo'],
                ['label' => 'Peminjaman Aktif',  'value' => '18',  'delta' => '5 menunggu validasi',     'icon' => 'arrow-right', 'color' => 'amber'],
                ['label' => 'Komplain Terbuka',  'value' => '4',   'delta' => '2 prioritas tinggi',      'icon' => 'exclamation', 'color' => 'rose'],
                ['label' => 'Mutasi Bulan Ini',  'value' => '56',  'delta' => '+8 dibanding bulan lalu', 'icon' => 'arrows',      'color' => 'emerald'],
            ],
            'recentLoans' => $this->mockLoans()->take(5),
            'lowStock'    => collect([
                (object) ['name' => 'Proyektor Epson X500', 'stock' => 2, 'min' => 5, 'category' => 'Elektronik'],
                (object) ['name' => 'Mikroskop Binokuler',  'stock' => 3, 'min' => 6, 'category' => 'Lab'],
                (object) ['name' => 'Kabel HDMI 5m',        'stock' => 1, 'min' => 4, 'category' => 'Aksesoris'],
            ]),
        ]);
    }

    public function items(Request $request)
    {
        $q = trim((string) $request->get('q', ''));
        $items = $this->mockItems();
        if ($q !== '') {
            $items = $items->filter(fn ($i) =>
                stripos($i->name, $q) !== false || stripos($i->code, $q) !== false
            )->values();
        }
        return view('items.index', ['items' => $items, 'q' => $q]);
    }

    public function createItem()
    {
        return view('items.create', ['categories' => $this->categories()]);
    }

    public function editItem(int $id)
    {
        $item = $this->mockItems()->firstWhere('id', $id) ?? $this->mockItems()->first();
        return view('items.edit', ['item' => $item, 'categories' => $this->categories()]);
    }

    public function loans(Request $request)
    {
        $status = $request->get('status');
        $loans = $this->mockLoans();
        if ($status) {
            $loans = $loans->where('status', $status)->values();
        }
        return view('loans.index', ['loans' => $loans, 'statusFilter' => $status]);
    }

    public function createLoan()
    {
        return view('loans.create', ['items' => $this->mockItems()]);
    }

    public function showLoan(int $id)
    {
        $loan = $this->mockLoans()->firstWhere('id', $id) ?? $this->mockLoans()->first();
        return view('loans.show', ['loan' => $loan]);
    }

    public function complaints()
    {
        return view('complaints.index', ['complaints' => $this->mockComplaints()]);
    }

    public function createComplaint()
    {
        return view('complaints.create', ['loans' => $this->mockLoans()]);
    }

    public function stockMutations()
    {
        return view('stock-mutations.index', ['mutations' => $this->mockMutations()]);
    }

    public function users()
    {
        return view('users.index', ['users' => $this->mockUsers()]);
    }

    /* ---------------- mock data ---------------- */

    private function categories(): array
    {
        return ['Elektronik', 'Lab', 'Aksesoris', 'Furniture', 'Alat Tulis', 'Lainnya'];
    }

    private function mockItems(): Collection
    {
        return collect([
            (object) ['id'=>1,'code'=>'INV-001','name'=>'Proyektor Epson X500',   'category'=>'Elektronik', 'stock'=>2, 'min_stock'=>5,  'unit'=>'unit','condition'=>'baik'],
            (object) ['id'=>2,'code'=>'INV-002','name'=>'Laptop Lenovo ThinkPad', 'category'=>'Elektronik', 'stock'=>12,'min_stock'=>4,  'unit'=>'unit','condition'=>'baik'],
            (object) ['id'=>3,'code'=>'INV-003','name'=>'Mikroskop Binokuler',    'category'=>'Lab',        'stock'=>3, 'min_stock'=>6,  'unit'=>'unit','condition'=>'baik'],
            (object) ['id'=>4,'code'=>'INV-004','name'=>'Kabel HDMI 5m',          'category'=>'Aksesoris',  'stock'=>1, 'min_stock'=>4,  'unit'=>'buah','condition'=>'rusak'],
            (object) ['id'=>5,'code'=>'INV-005','name'=>'Kursi Lipat',            'category'=>'Furniture',  'stock'=>40,'min_stock'=>20, 'unit'=>'buah','condition'=>'baik'],
            (object) ['id'=>6,'code'=>'INV-006','name'=>'Meja Lipat',             'category'=>'Furniture',  'stock'=>15,'min_stock'=>10, 'unit'=>'buah','condition'=>'baik'],
            (object) ['id'=>7,'code'=>'INV-007','name'=>'Spidol Whiteboard',      'category'=>'Alat Tulis', 'stock'=>80,'min_stock'=>30, 'unit'=>'pcs', 'condition'=>'baik'],
            (object) ['id'=>8,'code'=>'INV-008','name'=>'Tabung Reaksi',          'category'=>'Lab',        'stock'=>25,'min_stock'=>15, 'unit'=>'pcs', 'condition'=>'baik'],
        ]);
    }

    private function mockLoans(): Collection
    {
        return collect([
            (object) ['id'=>101,'code'=>'L-2024-0101','borrower'=>'Siti Aminah',  'kelas'=>'XI IPA 2', 'items'=>'Proyektor Epson X500 (1x)',      'items_count'=>1, 'start_date'=>'2024-11-20','end_date'=>'2024-11-22','status'=>'pending',  'guru'=>'Budi Santoso','purpose'=>'Presentasi kelas'],
            (object) ['id'=>102,'code'=>'L-2024-0102','borrower'=>'Ahmad Rizki',  'kelas'=>'XII IPS 1','items'=>'Kursi Lipat (10x)',               'items_count'=>10,'start_date'=>'2024-11-21','end_date'=>'2024-11-21','status'=>'approved', 'guru'=>'Budi Santoso','purpose'=>'Rapat OSIS'],
            (object) ['id'=>103,'code'=>'L-2024-0103','borrower'=>'Dewi Lestari', 'kelas'=>'XI IPA 1', 'items'=>'Mikroskop (2x), Tabung Reaksi (5x)','items_count'=>7, 'start_date'=>'2024-11-19','end_date'=>'2024-11-20','status'=>'returned', 'guru'=>'Budi Santoso','purpose'=>'Praktikum biologi'],
            (object) ['id'=>104,'code'=>'L-2024-0104','borrower'=>'Fajar Nugroho','kelas'=>'X-3',      'items'=>'Laptop Lenovo (1x)',             'items_count'=>1, 'start_date'=>'2024-11-22','end_date'=>'2024-11-25','status'=>'rejected', 'guru'=>'Budi Santoso','purpose'=>'Ujian online', 'note'=>'Laptop sedang dipakai untuk ujian sekolah'],
            (object) ['id'=>105,'code'=>'L-2024-0105','borrower'=>'Rina Wati',    'kelas'=>'XII IPA 2','items'=>'Proyektor (1x)',                  'items_count'=>1, 'start_date'=>'2024-11-23','end_date'=>'2024-11-24','status'=>'pending',  'guru'=>null,          'purpose'=>'Presentasi proyek akhir'],
        ]);
    }

    private function mockComplaints(): Collection
    {
        return collect([
            (object) ['id'=>1,'code'=>'C-2024-001','reporter'=>'Dewi Lestari','kelas'=>'XI IPA 1', 'title'=>'Mikroskop tidak fokus',      'description'=>'Lensa okuler kabur saat digunakan untuk praktikum.','priority'=>'high',  'status'=>'open',       'date'=>'2024-11-20','item'=>'Mikroskop Binokuler'],
            (object) ['id'=>2,'code'=>'C-2024-002','reporter'=>'Ahmad Rizki', 'kelas'=>'XII IPS 1','title'=>'Kursi lipat patah',           'description'=>'Salah satu kursi patah pada bagian kaki.','priority'=>'medium','status'=>'in_progress','date'=>'2024-11-21','item'=>'Kursi Lipat'],
            (object) ['id'=>3,'code'=>'C-2024-003','reporter'=>'Siti Aminah', 'kelas'=>'XI IPA 2', 'title'=>'Proyektor overheat',           'description'=>'Proyektor mati sendiri setelah 30 menit pemakaian.','priority'=>'high', 'status'=>'resolved',   'date'=>'2024-11-18','item'=>'Proyektor Epson X500'],
            (object) ['id'=>4,'code'=>'C-2024-004','reporter'=>'Rina Wati',   'kelas'=>'XII IPA 2','title'=>'Kabel HDMI tidak berfungsi',  'description'=>'Tidak ada sinyal keluar saat dihubungkan ke proyektor.','priority'=>'low', 'status'=>'open',       'date'=>'2024-11-22','item'=>'Kabel HDMI 5m'],
        ]);
    }

    private function mockMutations(): Collection
    {
        return collect([
            (object) ['id'=>1,'date'=>'2024-11-22 09:14','item'=>'Proyektor Epson X500','code'=>'INV-001','type'=>'in', 'qty'=>3, 'note'=>'Pembelian baru dari dana BOS',  'by'=>'Admin'],
            (object) ['id'=>2,'date'=>'2024-11-21 14:02','item'=>'Kursi Lipat',          'code'=>'INV-005','type'=>'out','qty'=>10,'note'=>'Peminjaman L-2024-0102',        'by'=>'Budi Santoso'],
            (object) ['id'=>3,'date'=>'2024-11-20 11:30','item'=>'Mikroskop Binokuler',   'code'=>'INV-003','type'=>'in', 'qty'=>2, 'note'=>'Pengembalian dari praktikum',   'by'=>'Dewi Lestari'],
            (object) ['id'=>4,'date'=>'2024-11-19 08:45','item'=>'Kabel HDMI 5m',         'code'=>'INV-004','type'=>'out','qty'=>1, 'note'=>'Rusak, dibuang',                'by'=>'Admin'],
            (object) ['id'=>5,'date'=>'2024-11-18 16:20','item'=>'Spidol Whiteboard',     'code'=>'INV-007','type'=>'in', 'qty'=>40,'note'=>'Restock bulanan',                'by'=>'Admin'],
        ]);
    }

    private function mockUsers(): Collection
    {
        return collect([
            (object) ['id'=>1,'username'=>'admin',    'name'=>'Administrator', 'role'=>'admin','kelas'=>null,       'nip'=>null,                  'email'=>'admin@invenspace.id','status'=>'active'],
            (object) ['id'=>2,'username'=>'budiguru', 'name'=>'Budi Santoso',  'role'=>'guru', 'kelas'=>null,       'nip'=>'198501152010011002',  'email'=>'budi@invenspace.id', 'status'=>'active'],
            (object) ['id'=>3,'username'=>'sitisiswa','name'=>'Siti Aminah',   'role'=>'siswa','kelas'=>'XI IPA 2', 'nip'=>null,                  'email'=>'siti@invenspace.id', 'status'=>'active'],
            (object) ['id'=>4,'username'=>'ahmadr',   'name'=>'Ahmad Rizki',   'role'=>'siswa','kelas'=>'XII IPS 1','nip'=>null,                  'email'=>'ahmad@invenspace.id','status'=>'active'],
            (object) ['id'=>5,'username'=>'dewil',    'name'=>'Dewi Lestari',  'role'=>'siswa','kelas'=>'XI IPA 1', 'nip'=>null,                  'email'=>'dewi@invenspace.id', 'status'=>'inactive'],
        ]);
    }
}
