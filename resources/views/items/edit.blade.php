@extends('layouts.app')
@section('title', 'Edit Barang')
@section('subtitle', 'Ubah data inventaris: ' . $item->name)

@section('content')
<form class="max-w-2xl space-y-4">
    @include('items.form', ['item' => $item, 'categories' => $categories])
    <div class="flex justify-end gap-2">
        <a href="{{ route('preview.items') }}" class="px-4 py-2 rounded-lg border border-slate-200 text-sm font-medium text-slate-700 hover:bg-slate-50">Batal</a>
        <button type="button" class="px-4 py-2 rounded-lg bg-indigo-600 text-white text-sm font-medium hover:bg-indigo-700">Perbarui</button>
    </div>
</form>
@endsection
