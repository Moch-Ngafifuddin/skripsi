<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pasien', function (Blueprint $table) {
            $table->string('nik_hash', 64)->unique()->nullable();
            $table->dropUnique(['nik']); 
            $table->text('nik')->nullable()->change();
            $table->text('no_kk')->nullable()->change();
            $table->text('no_hp')->nullable()->change();
            $table->text('nik_ibu')->nullable()->change();
            $table->text('nik_ayah')->nullable()->change();
        });
    }

    public function down(): void
    {
        //
    }
};
