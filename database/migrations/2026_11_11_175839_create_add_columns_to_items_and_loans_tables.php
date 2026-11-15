// database/migrations/2024_11_23_000001_add_columns_to_items_and_loans_tables.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('items', function (Blueprint $table) {
            $table->string('kategori')->default('Lainnya')->after('nama_barang');
            $table->unsignedInteger('stok_minimum')->default(0)->after('stok_total');
            $table->string('satuan', 20)->default('unit')->after('stok_minimum');
        });

        Schema::table('loans', function (Blueprint $table) {
            $table->date('tanggal_kembali_rencana')->nullable()->after('tanggal_ajuan');
            $table->text('tujuan')->nullable()->after('status');
        });

        Schema::table('complaints', function (Blueprint $table) {
            $table->enum('prioritas', ['rendah', 'sedang', 'tinggi'])->default('sedang')->after('isi');
        });

        Schema::table('stock_mutations', function (Blueprint $table) {
            $table->string('keterangan')->nullable()->after('jumlah');
        });
    }

    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn(['kategori', 'stok_minimum', 'satuan']);
        });

        Schema::table('loans', function (Blueprint $table) {
            $table->dropColumn(['tanggal_kembali_rencana', 'tujuan']);
        });

        Schema::table('complaints', function (Blueprint $table) {
            $table->dropColumn('prioritas');
        });

        Schema::table('stock_mutations', function (Blueprint $table) {
            $table->dropColumn('keterangan');
        });
    }
};
