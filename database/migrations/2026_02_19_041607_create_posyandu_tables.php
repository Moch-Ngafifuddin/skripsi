<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tabel Master Pasien
        Schema::create('pasien', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 16)->unique();
            $table->string('no_kk', 16)->nullable();
            $table->string('nama');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->date('tgl_lahir');
            $table->string('tempat_lahir');
            $table->text('alamat');
            $table->string('no_hp')->nullable();
            $table->string('nama_wali')->nullable();
            $table->timestamps();
        });

        // 2. Tabel Pemeriksaan Bayi
        Schema::create('pemeriksaan_bayi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pasien_id')->constrained('pasien')->cascadeOnDelete();
            $table->date('tgl_periksa');
            $table->decimal('berat_badan', 5, 2)->nullable();
            $table->decimal('tinggi_badan', 5, 2)->nullable();
            $table->decimal('lingkar_kepala', 5, 2)->nullable();
            $table->boolean('vitamin_a')->default(false);
            $table->string('jenis_imunisasi')->nullable();
            $table->text('catatan')->nullable();
            $table->string('status_gizi')->nullable();
            $table->string('status_stunting')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan_bayi');
        Schema::dropIfExists('pasien');
    }
};