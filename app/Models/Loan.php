<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['id_siswa', 'tanggal_ajuan', 'tanggal_pinjam', 'tanggal_kembali_rencana', 'tujuan'])]
class Loan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_peminjaman';

    protected function casts(): array
    {
        return [
            'tanggal_ajuan' => 'date',
            'tanggal_pinjam' => 'date',
            'tanggal_kembali_rencana' => 'date',
            'tanggal_kembali_aktual' => 'date',
            'tanggal_validasi' => 'date',
        ];
    }

    /**
     * The student who submitted this loan request.
     */
    public function siswa(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_siswa', 'id_user');
    }

    /**
     * The teacher who validated this loan request.
     */
    public function guruValidator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_guru_validator', 'id_user');
    }

    /**
     * The items requested in this loan.
     */
    public function loanItems(): HasMany
    {
        return $this->hasMany(LoanItem::class, 'id_peminjaman', 'id_peminjaman');
    }

    /**
     * Complaints related to this loan (optional).
     */
    public function complaints(): HasMany
    {
        return $this->hasMany(Complaint::class, 'id_peminjaman', 'id_peminjaman');
    }

    /**
     * Stock mutations linked to this loan.
     */
    public function stockMutations(): HasMany
    {
        return $this->hasMany(StockMutation::class, 'id_peminjaman', 'id_peminjaman');
    }
}