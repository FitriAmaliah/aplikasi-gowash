<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::table('layanan', function (Blueprint $table) {
            $table->string('estimasi_waktu')->nullable()->after('nama_layanan'); // Membuat nullable agar tidak wajib diisi
        });
    }

    /**
     * Kembalikan perubahan migrasi.
     */
    public function down(): void
    {
        Schema::table('layanan', function (Blueprint $table) {
            $table->dropColumn('estimasi_waktu');
        });
    }
};
