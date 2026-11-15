@extends('layouts.app')

@section('title', 'Mutasi Stok')
@section('subtitle', 'Riwayat barang masuk dan keluar')

@section('content')

<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-4">
    <div class="bg-white rounded-xl border border-slate-200 p-5">
        <div class="text-xs text-slate-500">Total Mutasi</div>
        <div class="text-2xl font-semibold text-slate-900">{{ $mutations->count() }}</div>
    </div>
    <div class="bg-white rounded-xl border border-slate-200 p-5">
        <div class="text-xs text-slate-500">Barang Masuk</div>
        <div class="text-2xl font-semibold text-emerald-600">{{ $mutations->where('type', 'in')->sum('qty') }}</div>
    </div>
    <div class="bg-white rounded-xl border border-slate-200 p-5">
        <div class="text-xs text-slate-500">Barang Keluar</div>
        <div class="text-2xl font-semibold text-rose-600">{{ $mutations->where('type', 'out')->sum('qty') }}</div>
    </div>
</div>

<div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wide">
            <tr>
                <th class="text-left font-medium px-5 py-3">Waktu</th>
                <th class="text-left font-medium px-5 py-3">Barang</th>
                <th class="text-left font-medium px-5 py-3">Tipe</th>
                <th class="text-right font-medium px-5 py-3">Jumlah</th>
                <th class="text-left font-medium px-5 py-3">Catatan</th>
                <th class="text-left font-medium px-5 py-3">Oleh</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @foreach($mutations as $m)
                <tr class="hover:bg-slate-50">
                    <td class="px-5 py-3 text-xs text-slate-600 whitespace-nowrap">{{ $m->date }}</td>
                    <td class="px-5 py-3">
                        <div class="font-medium text-slate-800">{{ $m->item }}</div>
                        <div class="text-xs text-slate-500 font-mono">{{ $m->code }}</div>
                    </td>
                    <td class="px-5 py-3"><x-badge :status="$m->type" /></td>
                    <td class="px-5 py-3 text-right font-mono {{ $m->type === 'in' ? 'text-emerald-600' : 'text-rose-600' }}">
                        {{ $m->type === 'in' ? '+' : '−' }}{{ $m->qty }}
                    </td>
                    <td class="px-5 py-3 text-slate-700 text-xs">{{ $m->note }}</td>
                    <td class="px-5 py-3 text-slate-700 text-xs">{{ $m->by }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
