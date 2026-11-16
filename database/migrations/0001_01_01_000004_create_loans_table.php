<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id('id_peminjaman');
            $table->foreignId('id_siswa')->constrained('users', 'id_user')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('id_guru_validator')->nullable()->constrained('users', 'id_user')->cascadeOnUpdate()->nullOnDelete();
            $table->enum('status', ['diajukan', 'disetujui', 'ditolak', 'dipinjam', 'dikembalikan'])->default('diajukan');
            $table->text('tujuan')->nullable();
            $table->date('tanggal_ajuan');
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali_rencana');
            $table->date('tanggal_kembali_aktual')->nullable();
            $table->date('tanggal_validasi')->nullable();
            $table->text('catatan_validator')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};