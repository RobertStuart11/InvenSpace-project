@extends('layouts.app')

@section('title', 'Pengguna')
@section('subtitle', 'Kelola akun admin, guru, dan siswa')

@section('actions')
    <button class="inline-flex items-center gap-1.5 px-3 py-2 rounded-lg bg-indigo-600 text-white text-sm font-medium hover:bg-indigo-700">
        <x-icon name="plus" class="w-4 h-4" /> Tambah Pengguna
    </button>
@endsection

@section('content')
<div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wide">
            <tr>
                <th class="text-left font-medium px-5 py-3">Nama</th>
                <th class="text-left font-medium px-5 py-3">Username</th>
                <th class="text-left font-medium px-5 py-3">Peran</th>
                <th class="text-left font-medium px-5 py-3">Kelas / NIP</th>
                <th class="text-left font-medium px-5 py-3">Status</th>
                <th class="text-right font-medium px-5 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @foreach($users as $u)
                <tr class="hover:bg-slate-50">
                    <td class="px-5 py-3">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-xs font-semibold text-slate-600">
                                {{ strtoupper(substr($u->name, 0, 1)) }}
                            </div>
                            <div class="min-w-0">
                                <div class="font-medium text-slate-800 truncate">{{ $u->name }}</div>
                                <div class="text-xs text-slate-500 truncate">{{ $u->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-5 py-3 font-mono text-xs text-slate-600">{{ $u->username }}</td>
                    <td class="px-5 py-3"><x-badge :status="$u->role" /></td>
                    <td class="px-5 py-3 text-slate-600">{{ $u->kelas ?? $u->nip ?? '—' }}</td>
                    <td class="px-5 py-3">
                        @if($u->status === 'active')
                            <span class="inline-flex items-center gap-1.5 text-xs text-emerald-700">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Aktif
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 text-xs text-slate-500">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span> Nonaktif
                            </span>
                        @endif
                    </td>
                    <td class="px-5 py-3 text-right">
                        <div class="inline-flex gap-1">
                            <button class="p-1.5 rounded-md hover:bg-slate-100 text-slate-500"><x-icon name="pencil" class="w-4 h-4" /></button>
                            <button class="p-1.5 rounded-md hover:bg-rose-50 text-rose-500"><x-icon name="trash" class="w-4 h-4" /></button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
