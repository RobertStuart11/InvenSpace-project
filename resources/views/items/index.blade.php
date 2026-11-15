@extends('layouts.app')

@section('title', 'Data Barang')
@section('subtitle', 'Kelola inventaris sekolah')

@section('actions')
    <a href="{{ route('preview.items.create') }}"
       class="inline-flex items-center gap-1.5 px-3 py-2 rounded-lg bg-indigo-600 text-white text-sm font-medium hover:bg-indigo-700">
        <x-icon name="plus" class="w-4 h-4" /> Tambah Barang
    </a>
@endsection

@section('content')
<div class="bg-white rounded-xl border border-slate-200">
    <form method="GET" class="px-5 py-4 border-b border-slate-100 flex flex-wrap gap-2">
        <div class="relative flex-1 min-w-[220px]">
            <x-icon name="search" class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-slate-400" />
            <input name="q" value="{{ $q }}" placeholder="Cari nama atau kode barang..."
                   class="w-full pl-9 pr-3 py-2 rounded-lg border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-500">
        </div>
        <button class="px-4 py-2 rounded-lg bg-slate-900 text-white text-sm font-medium hover:bg-slate-800">Cari</button>
    </form>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wide">
                <tr>
                    <th class="text-left font-medium px-5 py-3">Kode</th>
                    <th class="text-left font-medium px-5 py-3">Nama Barang</th>
                    <th class="text-left font-medium px-5 py-3">Kategori</th>
                    <th class="text-right font-medium px-5 py-3">Stok</th>
                    <th class="text-left font-medium px-5 py-3">Kondisi</th>
                    <th class="text-right font-medium px-5 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($items as $item)
                    @php $low = $item->stock <= $item->min_stock; @endphp
                    <tr class="hover:bg-slate-50">
                        <td class="px-5 py-3 font-mono text-xs text-slate-500">{{ $item->code }}</td>
                        <td class="px-5 py-3 font-medium text-slate-800">{{ $item->name }}</td>
                        <td class="px-5 py-3 text-slate-600">{{ $item->category }}</td>
                        <td class="px-5 py-3 text-right">
                            <span class="font-mono font-medium {{ $low ? 'text-rose-600' : 'text-slate-800' }}">{{ $item->stock }}</span>
                            <span class="text-slate-400">/ {{ $item->min_stock }} {{ $item->unit }}</span>
                        </td>
                        <td class="px-5 py-3"><x-badge :status="$item->condition" /></td>
                        <td class="px-5 py-3 text-right">
                            <div class="inline-flex gap-1">
                                <a href="{{ route('preview.items.edit', $item->id) }}" class="p-1.5 rounded-md hover:bg-slate-100 text-slate-500">
                                    <x-icon name="pencil" class="w-4 h-4" />
                                </a>
                                <button class="p-1.5 rounded-md hover:bg-rose-50 text-rose-500">
                                    <x-icon name="trash" class="w-4 h-4" />
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-5 py-10 text-center text-slate-500">Tidak ada data barang.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
