@props(['stat'])
@php
    $palettes = [
        'indigo'  => ['bg-indigo-50',  'text-indigo-600',  'ring-indigo-100'],
        'amber'   => ['bg-amber-50',   'text-amber-600',   'ring-amber-100'],
        'rose'    => ['bg-rose-50',    'text-rose-600',    'ring-rose-100'],
        'emerald' => ['bg-emerald-50', 'text-emerald-600', 'ring-emerald-100'],
    ];
    [$bg, $tx, $ring] = $palettes[$stat['color']] ?? $palettes['indigo'];
@endphp
<div class="bg-white rounded-xl border border-slate-200 p-5">
    <div class="flex items-start justify-between">
        <div>
            <div class="text-xs font-medium text-slate-500">{{ $stat['label'] }}</div>
            <div class="mt-2 text-2xl font-semibold text-slate-900">{{ $stat['value'] }}</div>
        </div>
        <div class="w-10 h-10 rounded-lg {{ $bg }} {{ $tx }} flex items-center justify-center ring-1 {{ $ring }}">
            <x-icon :name="$stat['icon']" class="w-5 h-5" />
        </div>
    </div>
    <div class="mt-3 text-xs text-slate-500">{{ $stat['delta'] }}</div>
</div>
