<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['id_barang', 'id_user', 'jumlah', 'tipe'])]
class StockMutation extends Model
{
    use HasFactory;

    protected $table = 'stock_mutations';

    protected $primaryKey = 'id_mutasi';

    protected function casts(): array
    {
        return [
            'jumlah' => 'integer',
        ];
    }

    /**
     * The item this mutation affects.
     */
    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'id_barang', 'id_barang');
    }

    /**
     * The user who recorded this mutation.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
