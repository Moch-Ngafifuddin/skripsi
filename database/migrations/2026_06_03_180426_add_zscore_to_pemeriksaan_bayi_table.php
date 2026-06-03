<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('pemeriksaan_bayi', function (Blueprint $table) {
            $table->decimal('zscore_bbu', 5, 2)->nullable();
            $table->decimal('zscore_tbu', 5, 2)->nullable();
            $table->string('kenaikan_bb')->nullable();
            $table->string('keterangan_bb')->nullable();
        });
    }
    public function down(): void {
        Schema::table('pemeriksaan_bayi', function (Blueprint $table) {
            $table->dropColumn(['zscore_bbu', 'zscore_tbu', 'kenaikan_bb', 'keterangan_bb']);
        });
    }
};