@extends('layouts.app')

@section('title', 'Dashboard')
@section('subtitle', 'Ringkasan aktivitas inventaris sekolah')

@section('content')
<div class="space-y-6">

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
        @foreach($stats as $s)
            <x-stat-card :stat="$s" />
        @endforeach
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-4">

        <div class="xl:col-span-2 bg-white rounded-xl border border-slate-200 overflow-hidden">
            <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
                <div>
                    <h2 class="text-sm font-semibold text-slate-900">Peminjaman Terbaru</h2>
                    <p class="text-xs text-slate-500">5 pengajuan terakhir</p>
                </div>
                <a href="{{ route('preview.loans') }}" class="text-xs font-medium text-indigo-600 hover:text-indigo-700">Lihat semua &rarr;</a>
            </div>
            <div class="divide-y divide-slate-100">
                @foreach($recentLoans as $loan)
                    <a href="{{ route('preview.loans.show', $loan->id) }}" class="flex items-center gap-4 px-5 py-3 hover:bg-slate-50">
                        <div class="w-10 h-10 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0">
                            <x-icon name="arrow-right" class="w-5 h-5" />
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="text-sm font-medium text-slate-800 truncate">{{ $loan->borrower }} <span class="text-slate-400 font-normal">· {{ $loan->kelas }}</span></div>
                            <div class="text-xs text-slate-500 truncate">{{ $loan->items }}</div>
                        </div>
                        <x-badge :status="$loan->status" />
                    </a>
                @endforeach
            </div>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-100">
                <h2 class="text-sm font-semibold text-slate-900 flex items-center gap-2">
                    <x-icon name="alert" class="w-4 h-4 text-rose-500" /> Stok Menipis
                </h2>
                <p class="text-xs text-slate-500">Barang di bawah stok minimum</p>
            </div>
            <ul class="divide-y divide-slate-100">
                @foreach($lowStock as $item)
                    <li class="px-5 py-3">
                        <div class="text-sm font-medium text-slate-800">{{ $item->name }}</div>
                        <div class="mt-1 flex items-center justify-between text-xs">
                            <span class="text-slate-500">{{ $item->category }}</span>
                            <span class="font-mono text-rose-600 font-semibold">{{ $item->stock }}/{{ $item->min }} unit</span>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
