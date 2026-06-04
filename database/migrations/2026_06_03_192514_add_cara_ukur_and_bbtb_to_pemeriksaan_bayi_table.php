<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pemeriksaan_bayi', function (Blueprint $table) {
            // Tambahkan kolom jika belum ada
            if (!Schema::hasColumn('pemeriksaan_bayi', 'cara_ukur')) {
                $table->enum('cara_ukur', ['berdiri', 'terlentang'])->nullable()->after('tinggi_badan');
            }
            if (!Schema::hasColumn('pemeriksaan_bayi', 'zscore_bbtb')) {
                $table->decimal('zscore_bbtb', 5, 2)->nullable()->after('zscore_tbu');
            }
            if (!Schema::hasColumn('pemeriksaan_bayi', 'status_bbtb')) {
                $table->string('status_bbtb')->nullable()->after('status_stunting');
            }
        });
    }

    public function down()
    {
        Schema::table('pemeriksaan_bayi', function (Blueprint $table) {
            $table->dropColumn(['cara_ukur', 'zscore_bbtb', 'status_bbtb']);
        });
    }
};