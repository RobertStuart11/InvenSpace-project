@props(['status' => ''])
@php
    $map = [
        // ===== DB enum (target utama) =====
        'diajukan'      => ['Diajukan',     'bg-amber-50 text-amber-700 ring-amber-200'],
        'disetujui'     => ['Disetujui',    'bg-emerald-50 text-emerald-700 ring-emerald-200'],
        'ditolak'       => ['Ditolak',      'bg-rose-50 text-rose-700 ring-rose-200'],
        'dipinjam'      => ['Dipinjam',     'bg-sky-50 text-sky-700 ring-sky-200'],
        'dikembalikan'  => ['Dikembalikan', 'bg-slate-100 text-slate-700 ring-slate-200'],
        'diproses'      => ['Diproses',     'bg-amber-50 text-amber-700 ring-amber-200'],
        'selesai'       => ['Selesai',      'bg-emerald-50 text-emerald-700 ring-emerald-200'],
        'MASUK'         => ['Masuk',        'bg-emerald-50 text-emerald-700 ring-emerald-200'],
        'KELUAR'        => ['Keluar',       'bg-rose-50 text-rose-700 ring-rose-200'],
        'baik'          => ['Baik',         'bg-emerald-50 text-emerald-700 ring-emerald-200'],
        'rusak'         => ['Rusak',        'bg-rose-50 text-rose-700 ring-rose-200'],
        'hilang'        => ['Hilang',       'bg-slate-200 text-slate-700 ring-slate-300'],
        'rendah'        => ['Rendah',       'bg-slate-100 text-slate-700 ring-slate-200'],
        'sedang'        => ['Sedang',       'bg-amber-50 text-amber-700 ring-amber-200'],
        'tinggi'        => ['Tinggi',       'bg-rose-50 text-rose-700 ring-rose-200'],

        // ===== role =====
        'admin'         => ['Admin',        'bg-indigo-50 text-indigo-700 ring-indigo-200'],
        'guru'          => ['Guru',         'bg-sky-50 text-sky-700 ring-sky-200'],
        'siswa'         => ['Siswa',        'bg-violet-50 text-violet-700 ring-violet-200'],

        // ===== priority (kalau mock masih dipakai) =====
        'high'          => ['Tinggi',       'bg-rose-50 text-rose-700 ring-rose-200'],
        'medium'        => ['Sedang',       'bg-amber-50 text-amber-700 ring-amber-200'],
        'low'           => ['Rendah',       'bg-slate-100 text-slate-700 ring-slate-200'],

        // ===== fallback: mock lama (PreviewController) =====
        'pending'       => ['Menunggu',     'bg-amber-50 text-amber-700 ring-amber-200'],
        'approved'      => ['Disetujui',    'bg-emerald-50 text-emerald-700 ring-emerald-200'],
        'rejected'      => ['Ditolak',      'bg-rose-50 text-rose-700 ring-rose-200'],
        'returned'      => ['Dikembalikan', 'bg-slate-100 text-slate-700 ring-slate-200'],
        'open'          => ['Terbuka',      'bg-rose-50 text-rose-700 ring-rose-200'],
        'in_progress'   => ['Diproses',     'bg-amber-50 text-amber-700 ring-amber-200'],
        'resolved'      => ['Selesai',      'bg-emerald-50 text-emerald-700 ring-emerald-200'],
        'in'            => ['Masuk',        'bg-emerald-50 text-emerald-700 ring-emerald-200'],
        'out'           => ['Keluar',       'bg-rose-50 text-rose-700 ring-rose-200'],
    ];
    [$label, $classes] = $map[$status] ?? [ucfirst($status ?: '—'), 'bg-slate-100 text-slate-700 ring-slate-200'];
@endphp
<span {{ $attributes->merge(['class' => 'inline-flex items-center px-2 py-0.5 rounded-md text-[11px] font-medium ring-1 ring-inset ' . $classes]) }}>
    {{ $label }}
</span>