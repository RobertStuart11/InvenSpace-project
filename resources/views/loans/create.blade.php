@extends('layouts.app')

@section('title', 'Ajukan Peminjaman')
@section('subtitle', 'Form pengajuan peminjaman barang')

@section('content')
<form class="max-w-3xl space-y-4">

    <div class="bg-white rounded-xl border border-slate-200 p-5 space-y-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="text-xs font-medium text-slate-600">Tanggal Mulai</label>
                <input type="date" class="mt-1 w-full px-3 py-2 rounded-lg border border-slate-200 text-sm">
            </div>
            <div>
                <label class="text-xs font-medium text-slate-600">Tanggal Selesai</label>
                <input type="date" class="mt-1 w-full px-3 py-2 rounded-lg border border-slate-200 text-sm">
            </div>
        </div>
        <div>
            <label class="text-xs font-medium text-slate-600">Tujuan Peminjaman</label>
            <textarea rows="3" class="mt-1 w-full px-3 py-2 rounded-lg border border-slate-200 text-sm" placeholder="Contoh: presentasi kelas XI IPA 2..."></textarea>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-slate-200">
        <div class="px-5 py-4 border-b border-slate-100">
            <h2 class="text-sm font-semibold text-slate-900">Barang yang Dipinjam</h2>
            <p class="text-xs text-slate-500">Masukkan jumlah yang ingin dipinjam</p>
        </div>
        <div class="p-5 divide-y divide-slate-100">
            @foreach($items as $item)
                <div class="grid grid-cols-12 gap-3 items-center py-3 first:pt-0 last:pb-0">
                    <div class="col-span-8 min-w-0">
                        <div class="text-sm font-medium text-slate-800 truncate">{{ $item->name }}</div>
                        <div class="text-xs text-slate-500">{{ $item->code }} · stok tersedia {{ $item->stock }}</div>
                    </div>
                    <div class="col-span-4">
                        <input type="number" min="0" max="{{ $item->stock }}" placeholder="0"
                               class="w-full px-3 py-2 rounded-lg border border-slate-200 text-sm text-right">
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="flex items-center justify-end gap-2">
        <a href="{{ route('preview.loans') }}" class="px-4 py-2 rounded-lg border border-slate-200 text-sm font-medium text-slate-700 hover:bg-slate-50">Batal</a>
        <button type="button" class="px-4 py-2 rounded-lg bg-indigo-600 text-white text-sm font-medium hover:bg-indigo-700">Kirim Pengajuan</button>
    </div>
</form>
@endsection
