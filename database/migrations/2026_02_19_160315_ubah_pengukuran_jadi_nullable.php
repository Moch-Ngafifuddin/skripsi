<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Longgarkan aturan di tabel Bayi
        Schema::table('pemeriksaan_bayi', function (Blueprint $table) {
            $table->decimal('berat_badan', 5, 2)->nullable()->change();
            $table->decimal('tinggi_badan', 5, 2)->nullable()->change();
        });

        // 2. Longgarkan aturan di tabel Remaja
        Schema::table('pemeriksaan_remaja', function (Blueprint $table) {
            $table->decimal('berat_badan', 5, 2)->nullable()->change();
            $table->decimal('tinggi_badan', 5, 2)->nullable()->change();
        });

        // 3. Longgarkan aturan di tabel Lansia
        Schema::table('pemeriksaan_lansia', function (Blueprint $table) {
            $table->decimal('berat_badan', 5, 2)->nullable()->change();
            $table->decimal('tinggi_badan', 5, 2)->nullable()->change();
            $table->integer('sistole')->nullable()->change();
            $table->integer('diastole')->nullable()->change();
        });
    }

    public function down(): void
    {
        // Tidak perlu diisi untuk down() dalam kasus ini
    }
};