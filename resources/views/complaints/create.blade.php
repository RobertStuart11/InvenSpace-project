@extends('layouts.app')

@section('title', 'Buat Komplain')
@section('subtitle', 'Laporkan masalah terkait barang atau peminjaman')

@section('content')
<form class="max-w-2xl space-y-4">

    <div class="bg-white rounded-xl border border-slate-200 p-5 space-y-4">
        <div>
            <label class="text-xs font-medium text-slate-600">Terkait Peminjaman (opsional)</label>
            <select class="mt-1 w-full px-3 py-2 rounded-lg border border-slate-200 text-sm bg-white">
                <option value="">— Tidak terkait peminjaman —</option>
                @foreach($loans as $loan)
                    <option>{{ $loan->code }} — {{ $loan->items }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="text-xs font-medium text-slate-600">Judul Komplain</label>
            <input class="mt-1 w-full px-3 py-2 rounded-lg border border-slate-200 text-sm" placeholder="Contoh: Proyektor tidak menyala">
        </div>
        <div>
            <label class="text-xs font-medium text-slate-600">Prioritas</label>
            <div class="flex gap-2 mt-1">
                <label class="flex-1">
                    <input type="radio" name="priority" class="peer sr-only" checked>
                    <span class="block text-center px-3 py-2 rounded-lg border border-slate-200 text-sm cursor-pointer
                                 peer-checked:bg-rose-50 peer-checked:border-rose-300 peer-checked:text-rose-700">Tinggi</span>
                </label>
                <label class="flex-1">
                    <input type="radio" name="priority" class="peer sr-only">
                    <span class="block text-center px-3 py-2 rounded-lg border border-slate-200 text-sm cursor-pointer
                                 peer-checked:bg-amber-50 peer-checked:border-amber-300 peer-checked:text-amber-700">Sedang</span>
                </label>
                <label class="flex-1">
                    <input type="radio" name="priority" class="peer sr-only">
                    <span class="block text-center px-3 py-2 rounded-lg border border-slate-200 text-sm cursor-pointer
                                 peer-checked:bg-slate-100 peer-checked:border-slate-400 peer-checked:text-slate-700">Rendah</span>
                </label>
            </div>
        </div>
        <div>
            <label class="text-xs font-medium text-slate-600">Deskripsi Masalah</label>
            <textarea rows="4" class="mt-1 w-full px-3 py-2 rounded-lg border border-slate-200 text-sm" placeholder="Jelaskan detail masalah..."></textarea>
        </div>
    </div>

    <div class="flex items-center justify-end gap-2">
        <a href="{{ route('preview.complaints') }}" class="px-4 py-2 rounded-lg border border-slate-200 text-sm font-medium text-slate-700 hover:bg-slate-50">Batal</a>
        <button type="button" class="px-4 py-2 rounded-lg bg-indigo-600 text-white text-sm font-medium hover:bg-indigo-700">Kirim Komplain</button>
    </div>
</form>
@endsection
