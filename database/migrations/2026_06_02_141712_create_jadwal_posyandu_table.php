<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_posyandu', function (Blueprint $table) {
            $table->id();
            $table->string('judul_agenda');
            $table->date('tanggal_acara');
            $table->time('waktu_acara');
            $table->string('tempat_acara');
            $table->time('jam_kirim_pesan')->default('08:00:00');
            $table->string('kategori_target');
            $table->text('isi_pesan');
            $table->boolean('is_aktif')->default(true); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_posyandu');
    }
};
