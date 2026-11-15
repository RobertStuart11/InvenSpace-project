@extends('layouts.app')

@section('title', 'Peminjaman')
@section('subtitle', 'Kelola pengajuan peminjaman barang')

@section('actions')
    <a href="{{ route('preview.loans.create') }}"
       class="inline-flex items-center gap-1.5 px-3 py-2 rounded-lg bg-indigo-600 text-white text-sm font-medium hover:bg-indigo-700">
        <x-icon name="plus" class="w-4 h-4" /> Ajukan Peminjaman
    </a>
@endsection

@section('content')
<div class="bg-white rounded-xl border border-slate-200">
    <div class="px-5 py-3 border-b border-slate-100 flex flex-wrap gap-2">
        @php $statuses = ['' => 'Semua', 'pending' => 'Menunggu', 'approved' => 'Disetujui', 'returned' => 'Dikembalikan', 'rejected' => 'Ditolak']; @endphp
        @foreach($statuses as $key => $label)
            <a href="{{ route('preview.loans', array_filter(['status' => $key ?: null])) }}"
               class="px-3 py-1.5 rounded-lg text-xs font-medium border
                      {{ ($statusFilter ?? '') === $key
                          ? 'bg-indigo-600 text-white border-indigo-600'
                          : 'bg-white text-slate-600 border-slate-200 hover:bg-slate-50' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wide">
                <tr>
                    <th class="text-left font-medium px-5 py-3">Kode</th>
                    <th class="text-left font-medium px-5 py-3">Peminjam</th>
                    <th class="text-left font-medium px-5 py-3">Barang</th>
                    <th class="text-left font-medium px-5 py-3">Tanggal</th>
                    <th class="text-left font-medium px-5 py-3">Status</th>
                    <th class="text-right font-medium px-5 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($loans as $loan)
                    <tr class="hover:bg-slate-50">
                        <td class="px-5 py-3 font-mono text-xs text-slate-500">{{ $loan->code }}</td>
                        <td class="px-5 py-3">
                            <div class="font-medium text-slate-800">{{ $loan->borrower }}</div>
                            <div class="text-xs text-slate-500">{{ $loan->kelas }}</div>
                        </td>
                        <td class="px-5 py-3 text-slate-700 max-w-xs truncate">{{ $loan->items }}</td>
                        <td class="px-5 py-3 text-xs text-slate-600 whitespace-nowrap">
                            {{ $loan->start_date }}<br>
                            <span class="text-slate-400">s.d. {{ $loan->end_date }}</span>
                        </td>
                        <td class="px-5 py-3"><x-badge :status="$loan->status" /></td>
                        <td class="px-5 py-3 text-right">
                            <a href="{{ route('preview.loans.show', $loan->id) }}" class="text-xs font-medium text-indigo-600 hover:text-indigo-700">Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
