<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['role_id', 'nama', 'username', 'password', 'kelas', 'nip'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $primaryKey = 'id_user';

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    /**
     * The role this user belongs to.
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id', 'id_role');
    }

    /**
     * Determine whether the user has any of the given roles.
     */
    public function hasRole(string ...$roles): bool
    {
        return in_array($this->role?->nama_role, $roles, true);
    }

    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    public function isGuru(): bool
    {
        return $this->hasRole('guru');
    }

    public function isSiswa(): bool
    {
        return $this->hasRole('siswa');
    }

    /**
     * Loans this user submitted as a student (siswa).
     */
    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class, 'id_siswa', 'id_user');
    }

    /**
     * Loans this user validated as a teacher (guru).
     */
    public function validatedLoans(): HasMany
    {
        return $this->hasMany(Loan::class, 'id_guru_validator', 'id_user');
    }

    /**
     * Complaints this user filed as a student (siswa).
     */
    public function complaints(): HasMany
    {
        return $this->hasMany(Complaint::class, 'id_siswa', 'id_user');
    }

    /**
     * Stock mutations recorded by this user.
     */
    public function stockMutations(): HasMany
    {
        return $this->hasMany(StockMutation::class, 'id_user', 'id_user');
    }
}