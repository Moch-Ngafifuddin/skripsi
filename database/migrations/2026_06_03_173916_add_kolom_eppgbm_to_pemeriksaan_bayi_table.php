<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pemeriksaan_bayi', function (Blueprint $table) {
            // Menambahkan LiLA yang sebelumnya tertinggal
            $table->decimal('lila', 5, 2)->nullable()->after('lingkar_kepala');
            
            // Menambahkan Cara Ukur (Dropdown / Select)
            $table->enum('cara_ukur', ['berdiri', 'terlentang'])->nullable()->after('tinggi_badan');
            
            // Menambahkan Pitting Edema (Dropdown / Select)
            $table->enum('pitting_edema', ['derajat +1', 'derajat +2', 'derajat +3', 'tidak ada'])->default('tidak ada')->nullable();
            
            // Menambahkan Checkbox (Boolean Y/T)
            $table->boolean('kelas_ibu')->default(false)->nullable();
            $table->boolean('menerima_mbg')->default(false)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('pemeriksaan_bayi', function (Blueprint $table) {
            $table->dropColumn([
                'lila',
                'cara_ukur',
                'pitting_edema',
                'kelas_ibu',
                'menerima_mbg'
            ]);
        });
    }
};