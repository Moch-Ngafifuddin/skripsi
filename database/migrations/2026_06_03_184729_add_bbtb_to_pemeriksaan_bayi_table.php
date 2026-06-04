<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pemeriksaan_bayi', function (Blueprint $table) {
            // Menambahkan kolom Z-Score dan Status BB/TB
            $table->decimal('zscore_bbtb', 5, 2)->nullable()->after('zscore_tbu');
            $table->string('status_bbtb')->nullable()->after('status_stunting');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pemeriksaan_bayi', function (Blueprint $table) {
            //
        });
    }
};
