<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pasien', function (Blueprint $table) {
            // 1. Ubah NIK agar boleh kosong jika belum punya
            $table->string('nik', 16)->nullable()->change();

            // 2. Tambah kolom pengukuran saat lahir
            $table->integer('usia_kehamilan')->nullable()->comment('Dalam hitungan minggu');
            $table->decimal('lingkar_kepala_lahir', 5, 2)->nullable();
            
            // 3. Tambah kolom BBLR & Prematur
            $table->boolean('buku_kia_bayi_kecil')->default(0);
            $table->boolean('tatalaksana_bblr')->default(0);

            // 4. Tambah kolom hierarki wilayah Posyandu
            $table->string('provinsi')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('desa_kelurahan')->nullable();
            $table->string('nama_puskesmas')->nullable();
            $table->string('nama_posyandu')->nullable();
            $table->string('rt', 5)->nullable();
            $table->string('rw', 5)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('pasien', function (Blueprint $table) {
            $table->dropColumn([
                'usia_kehamilan', 'lingkar_kepala_lahir', 'buku_kia_bayi_kecil', 
                'tatalaksana_bblr', 'provinsi', 'kabupaten', 'kecamatan', 
                'desa_kelurahan', 'nama_puskesmas', 'nama_posyandu', 'rt', 'rw'
            ]);
            $table->string('nik', 16)->nullable(false)->change();
        });
    }
};