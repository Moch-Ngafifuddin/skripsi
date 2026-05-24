<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pemeriksaan_bayi', function (Blueprint $table) {
            // Menambahkan kolom keterangan_umur (berupa teks)
            $table->string('keterangan_umur')->nullable()->after('tgl_periksa');
            
            // Menambahkan kolom layanan (berupa boolean / true-false)
            $table->boolean('asi_eksklusif')->default(false)->nullable();
            $table->boolean('pmba')->default(false)->nullable();
            $table->boolean('sdidtk')->default(false)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('pemeriksaan_bayi', function (Blueprint $table) {
            $table->dropColumn([
                'keterangan_umur',
                'asi_eksklusif',
                'pmba',
                'sdidtk'
            ]);
        });
    }
};