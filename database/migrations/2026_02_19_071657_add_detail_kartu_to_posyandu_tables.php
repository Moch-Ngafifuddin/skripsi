<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. TAMBAH KOLOM KE TABEL PASIEN (Identitas & Lahir)
        Schema::table('pasien', function (Blueprint $table) {
            // Data Orang Tua
            $table->string('nama_ayah')->nullable()->after('nama_wali');
            $table->string('nik_ayah', 16)->nullable()->after('nama_ayah');
            $table->string('pendidikan_pekerjaan_ayah')->nullable()->after('nik_ayah'); // cth: S1 / Kary. Swasta
            $table->string('nama_ibu')->nullable()->after('pendidikan_pekerjaan_ayah');
            $table->string('nik_ibu', 16)->nullable()->after('nama_ibu');
            $table->string('pendidikan_pekerjaan_ibu')->nullable()->after('nik_ibu'); // cth: D3 / Kary. Swasta
            
            // Riwayat Kelahiran Bayi
            $table->integer('anak_ke')->nullable()->after('pendidikan_pekerjaan_ibu');
            $table->decimal('berat_lahir', 6, 2)->nullable()->comment('BBL dalam gram/kg')->after('anak_ke');
            $table->decimal('panjang_lahir', 5, 2)->nullable()->comment('PBL dalam cm')->after('berat_lahir');
            $table->boolean('imd')->default(false)->comment('Inisiasi Menyusu Dini')->after('panjang_lahir');
            $table->string('riwayat_asi')->nullable()->comment('E1, E2, E3, E4, E5, E6')->after('imd');
        });

        // 2. TAMBAH KOLOM KE TABEL PEMERIKSAAN BAYI (Buku Bulanan)
        Schema::table('pemeriksaan_bayi', function (Blueprint $table) {
            $table->integer('usia_bulan')->nullable()->after('tgl_periksa');
            
            // Indikator Pertumbuhan
            $table->string('rambu_gizi')->nullable()->comment('N / T / O')->after('tinggi_badan');
            $table->string('titik_pertumbuhan')->nullable()->comment('Hijau / Kuning / BGM')->after('rambu_gizi');
            $table->decimal('lingkar_lengan', 5, 2)->nullable()->comment('LILA cm')->after('lingkar_kepala');
            
            // Pelayanan Khusus
            $table->boolean('obat_cacing')->default(false)->after('vitamin_a');
            $table->string('sdidtk_pmba_asi')->nullable()->comment('SDIDTK/PMBA/ASI Eksklusif')->after('obat_cacing');
            
            // Evaluasi & Tindak Lanjut
            $table->boolean('deteksi_tbc')->default(false)->comment('S.TBC')->after('jenis_imunisasi');
            $table->boolean('kie')->default(false)->comment('Konseling/KIE')->after('deteksi_tbc');
            $table->boolean('rujuk')->default(false)->after('kie');
        });
    }

    public function down(): void
    {
        Schema::table('pemeriksaan_bayi', function (Blueprint $table) {
            $table->dropColumn([
                'usia_bulan', 'rambu_gizi', 'titik_pertumbuhan', 'lingkar_lengan', 
                'obat_cacing', 'sdidtk_pmba_asi', 'deteksi_tbc', 'kie', 'rujuk'
            ]);
        });

        Schema::table('pasien', function (Blueprint $table) {
            $table->dropColumn([
                'nama_ayah', 'nik_ayah', 'pendidikan_pekerjaan_ayah',
                'nama_ibu', 'nik_ibu', 'pendidikan_pekerjaan_ibu',
                'anak_ke', 'berat_lahir', 'panjang_lahir', 'imd', 'riwayat_asi'
            ]);
        });
    }
};