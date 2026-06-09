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
        Schema::table('pasien', function (Blueprint $table) {
            // Tambahan kolom yang ada di form tapi belum ada di DB
            $table->integer('usia_kehamilan')->nullable()->after('anak_ke');
            $table->decimal('lingkar_kepala_lahir', 5, 2)->nullable()->after('panjang_lahir');
            $table->boolean('buku_kia_bayi_kecil')->default(false)->after('lingkar_kepala_lahir');
            $table->boolean('tatalaksana_bblr')->default(false)->after('buku_kia_bayi_kecil');
            
            // Kolom Wilayah yang diwajibkan oleh Form
            $table->string('provinsi')->nullable()->after('tatalaksana_bblr');
            $table->string('kabupaten')->nullable()->after('provinsi');
            $table->string('kecamatan')->nullable()->after('kabupaten');
            $table->string('desa_kelurahan')->nullable()->after('kecamatan');
            $table->string('nama_puskesmas')->nullable()->after('desa_kelurahan');
            $table->string('nama_posyandu')->nullable()->after('nama_puskesmas');
            $table->integer('rt')->nullable()->after('nama_posyandu');
            $table->integer('rw')->nullable()->after('rt');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pasien', function (Blueprint $table) {
            // Menghapus kembali semua kolom jika dilakukan rollback
            $table->dropColumn([
                'usia_kehamilan',
                'lingkar_kepala_lahir',
                'buku_kia_bayi_kecil',
                'tatalaksana_bblr',
                'provinsi',
                'kabupaten',
                'kecamatan',
                'desa_kelurahan',
                'nama_puskesmas',
                'nama_posyandu',
                'rt',
                'rw'
            ]);
        });
    }
};