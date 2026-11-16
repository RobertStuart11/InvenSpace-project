<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['kode_barang', 'nama_barang', 'kategori', 'stok_total', 'stok_minimum', 'satuan', 'kondisi'])]
class Item extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_barang';

    protected function casts(): array
    {
        return [
            'stok_total' => 'integer',
            'stok_minimum' => 'integer',
        ];
    }

    /**
     * Loan detail lines that reference this item.
     */
    public function loanItems(): HasMany
    {
        return $this->hasMany(LoanItem::class, 'id_barang', 'id_barang');
    }

    /**
     * Stock in/out mutations for this item.
     */
    public function stockMutations(): HasMany
    {
        return $this->hasMany(StockMutation::class, 'id_barang', 'id_barang');
    }

    /**
     * Total quantity currently reserved or borrowed (loans approved or in progress).
     */
    public function jumlahTerpinjam(): int
    {
        return (int) $this->loanItems()
            ->whereHas('loan', fn ($q) => $q->whereIn('status', ['disetujui', 'dipinjam']))
            ->sum('jumlah_pinjam');
    }

    /**
     * Available stock: total owned minus what is reserved or borrowed.
     */
    protected function stokTersedia(): Attribute
    {
        return Attribute::get(fn () => $this->stok_total - $this->jumlahTerpinjam());
    }
}