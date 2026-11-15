@extends('layouts.app')

@section('title', 'Komplain')
@section('subtitle', 'Daftar komplain dari siswa')

@section('actions')
    <a href="{{ route('preview.complaints.create') }}"
       class="inline-flex items-center gap-1.5 px-3 py-2 rounded-lg bg-indigo-600 text-white text-sm font-medium hover:bg-indigo-700">
        <x-icon name="plus" class="w-4 h-4" /> Buat Komplain
    </a>
@endsection

@section('content')
<div class="bg-white rounded-xl border border-slate-200">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wide">
                <tr>
                    <th class="text-left font-medium px-5 py-3">Kode</th>
                    <th class="text-left font-medium px-5 py-3">Judul</th>
                    <th class="text-left font-medium px-5 py-3">Pelapor</th>
                    <th class="text-left font-medium px-5 py-3">Prioritas</th>
                    <th class="text-left font-medium px-5 py-3">Status</th>
                    <th class="text-left font-medium px-5 py-3">Tanggal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($complaints as $c)
                    <tr class="hover:bg-slate-50">
                        <td class="px-5 py-3 font-mono text-xs text-slate-500">{{ $c->code }}</td>
                        <td class="px-5 py-3">
                            <div class="font-medium text-slate-800">{{ $c->title }}</div>
                            <div class="text-xs text-slate-500 truncate max-w-xs">{{ $c->description }}</div>
                        </td>
                        <td class="px-5 py-3">
                            <div class="text-slate-800">{{ $c->reporter }}</div>
                            <div class="text-xs text-slate-500">{{ $c->kelas }}</div>
                        </td>
                        <td class="px-5 py-3"><x-badge :status="$c->priority" /></td>
                        <td class="px-5 py-3"><x-badge :status="$c->status" /></td>
                        <td class="px-5 py-3 text-xs text-slate-600 whitespace-nowrap">{{ $c->date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
