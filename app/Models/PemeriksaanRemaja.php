<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PemeriksaanRemaja extends Model
{
    // Memberitahu Laravel nama tabel yang benar
    protected $table = 'pemeriksaan_remaja';

    // Mengizinkan semua kolom diisi (Mass Assignment)
    protected $guarded = [];

    // Mengubah data 0/1 di database menjadi true/false di PHP
    protected $casts = [
        'minum_ttd' => 'boolean',
        'tgl_periksa' => 'date',
    ];

    // Relasi ke tabel Pasien (Setiap pemeriksaan milik satu pasien)
    public function pasien(): BelongsTo
    {
        return $this->belongsTo(Pasien::class, 'pasien_id');
    }
}