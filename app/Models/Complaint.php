<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['id_siswa', 'id_peminjaman', 'judul', 'isi', 'prioritas', 'status_komplain'])]
class Complaint extends Model
{
    use HasFactory;

    protected $table = 'complaints';

    protected $primaryKey = 'id_komplain';

    /**
     * The student who filed this complaint.
     */
    public function siswa(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_siswa', 'id_user');
    }

    /**
     * The loan this complaint relates to (optional).
     */
    public function loan(): BelongsTo
    {
        return $this->belongsTo(Loan::class, 'id_peminjaman', 'id_peminjaman');
    }
}
