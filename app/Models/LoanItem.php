<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['id_peminjaman', 'id_barang', 'jumlah_pinjam'])]
class LoanItem extends Model
{
    use HasFactory;

    protected $table = 'loan_items';

    protected $primaryKey = 'id_detail';

    protected function casts(): array
    {
        return [
            'jumlah_pinjam' => 'integer',
        ];
    }

    /**
     * The loan this detail line belongs to.
     */
    public function loan(): BelongsTo
    {
        return $this->belongsTo(Loan::class, 'id_peminjaman', 'id_peminjaman');
    }

    /**
     * The item being borrowed.
     */
    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'id_barang', 'id_barang');
    }
}
