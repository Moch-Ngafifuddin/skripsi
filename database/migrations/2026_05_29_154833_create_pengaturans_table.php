<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengaturan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_puskesmas')->default('Puskesmas Tambak Sari Kidul');
            
            // 🛠️ PERBAIKAN: Diubah dari text() menjadi string() agar bisa diberi default value
            $table->string('teks_login', 500)->default('Selamat datang di sistem informasi balita puskesmas tambak sari kidul');
            
            $table->string('logo')->nullable();
            $table->string('warna_tema')->default('#ec4899'); // Default warna rose/pink
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaturan');
    }
};