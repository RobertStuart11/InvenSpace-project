@php $isEdit = isset($item); @endphp

<div class="space-y-4">
    <div class="bg-white rounded-xl border border-slate-200 p-5 space-y-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="text-xs font-medium text-slate-600">Kode Barang</label>
                <input value="{{ $item->code ?? '' }}" class="mt-1 w-full px-3 py-2 rounded-lg border border-slate-200 text-sm focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-500 outline-none" placeholder="INV-XXX">
            </div>
            <div>
                <label class="text-xs font-medium text-slate-600">Kategori</label>
                <select class="mt-1 w-full px-3 py-2 rounded-lg border border-slate-200 text-sm bg-white">
                    @foreach($categories as $c)
                        <option @selected(($item->category ?? '') === $c)>{{ $c }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div>
            <label class="text-xs font-medium text-slate-600">Nama Barang</label>
            <input value="{{ $item->name ?? '' }}" class="mt-1 w-full px-3 py-2 rounded-lg border border-slate-200 text-sm" placeholder="Contoh: Proyektor Epson X500">
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            <div>
                <label class="text-xs font-medium text-slate-600">Stok</label>
                <input type="number" min="0" value="{{ $item->stock ?? 0 }}" class="mt-1 w-full px-3 py-2 rounded-lg border border-slate-200 text-sm">
            </div>
            <div>
                <label class="text-xs font-medium text-slate-600">Stok Min.</label>
                <input type="number" min="0" value="{{ $item->min_stock ?? 0 }}" class="mt-1 w-full px-3 py-2 rounded-lg border border-slate-200 text-sm">
            </div>
            <div>
                <label class="text-xs font-medium text-slate-600">Satuan</label>
                <input value="{{ $item->unit ?? 'unit' }}" class="mt-1 w-full px-3 py-2 rounded-lg border border-slate-200 text-sm">
            </div>
            <div>
                <label class="text-xs font-medium text-slate-600">Kondisi</label>
                <select class="mt-1 w-full px-3 py-2 rounded-lg border border-slate-200 text-sm bg-white">
                    <option value="baik" @selected(($item->condition ?? 'baik') === 'baik')>Baik</option>
                    <option value="rusak" @selected(($item->condition ?? '') === 'rusak')>Rusak</option>
                </select>
            </div>
        </div>
    </div>
</div>
