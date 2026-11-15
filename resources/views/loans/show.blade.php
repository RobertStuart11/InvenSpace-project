@extends('layouts.app')

@section('title', 'Detail Peminjaman')
@section('subtitle', $loan->code)

@section('content')
<div class="max-w-3xl space-y-4">

    <div class="bg-white rounded-xl border border-slate-200 p-5">
        <div class="flex items-start justify-between gap-3">
            <div>
                <div class="text-xs text-slate-500">Kode Peminjaman</div>
                <div class="font-mono text-sm font-medium text-slate-800">{{ $loan->code }}</div>
            </div>
            <x-badge :status="$loan->status" />
        </div>

        <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
            <div>
                <div class="text-xs text-slate-500">Peminjam</div>
                <div class="font-medium text-slate-800">{{ $loan->borrower }}</div>
                <div class="text-xs text-slate-500">{{ $loan->kelas }}</div>
            </div>
            <div>
                <div class="text-xs text-slate-500">Guru Pembimbing</div>
                <div class="font-medium text-slate-800">{{ $loan->guru ?? '—' }}</div>
            </div>
            <div>
                <div class="text-xs text-slate-500">Tanggal Mulai</div>
                <div class="font-medium text-slate-800">{{ $loan->start_date }}</div>
            </div>
            <div>
                <div class="text-xs text-slate-500">Tanggal Selesai</div>
                <div class="font-medium text-slate-800">{{ $loan->end_date }}</div>
            </div>
            <div class="sm:col-span-2">
                <div class="text-xs text-slate-500">Tujuan</div>
                <div class="text-slate-800">{{ $loan->purpose }}</div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-slate-200">
        <div class="px-5 py-4 border-b border-slate-100">
            <h2 class="text-sm font-semibold text-slate-900">Barang yang Dipinjam</h2>
        </div>
        <div class="p-5 text-sm text-slate-700">
            {{ $loan->items }} <span class="text-slate-400">· {{ $loan->items_count }} unit</span>
        </div>
    </div>

    @if(!empty($loan->note))
        <div class="bg-rose-50 border border-rose-200 rounded-xl p-4 text-sm text-rose-800">
            <div class="font-medium mb-1">Catatan Penolakan</div>
            {{ $loan->note }}
        </div>
    @endif

    <div class="flex items-center justify-end gap-2">
        <a href="{{ route('preview.loans') }}" class="px-4 py-2 rounded-lg border border-slate-200 text-sm font-medium text-slate-700 hover:bg-slate-50">Kembali</a>
        <button type="button" class="px-4 py-2 rounded-lg bg-indigo-600 text-white text-sm font-medium hover:bg-indigo-700">Setujui</button>
    </div>
</div>
@endsection
