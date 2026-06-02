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
            $table->string('judul_agenda'); // Contoh: Imunisasi Campak Nasional
            $table->date('tanggal_acara'); // Tanggal pelaksanaan posyandu
            $table->time('jam_kirim_pesan')->default('08:00:00'); // Jam berapa WA akan terkirim di H-1
            $table->string('kategori_target'); // balita, remaja, lansia, atau bumil
            $table->text('isi_pesan'); // Pesan kustom pengingat
            $table->boolean('is_aktif')->default(true); // Sakelar Tombol Aktif/Nonaktif otomatis
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
