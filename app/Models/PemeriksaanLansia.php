<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PemeriksaanLansia extends Model
{
    // Memberitahu Laravel nama tabel yang benar
    protected $table = 'pemeriksaan_lansia';

    // Mengizinkan semua kolom diisi
    protected $guarded = [];

    // Memastikan tanggal dibaca sebagai objek tanggal oleh Laravel
    protected $casts = [
        'tgl_periksa' => 'date',
    ];

    // Relasi ke tabel Pasien
    public function pasien(): BelongsTo
    {
        return $this->belongsTo(Pasien::class, 'pasien_id');
    }
}