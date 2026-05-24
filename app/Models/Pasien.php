<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pasien extends Model
{
    protected $table = 'pasien'; // Nama tabel di database
    protected $guarded = [];    // Mengizinkan penyimpanan massal (mass assignment)

    /**
     * Relasi ke riwayat pemeriksaan Balita
     */
    public function pemeriksaanBayi(): HasMany 
    {
        return $this->hasMany(PemeriksaanBayi::class, 'pasien_id');
    }

    /**
     * Relasi ke riwayat pemeriksaan Remaja
     */
    public function pemeriksaanRemaja(): HasMany
    {
        return $this->hasMany(PemeriksaanRemaja::class, 'pasien_id');
    }

    /**
     * Relasi ke riwayat pemeriksaan Lansia
     */
    public function pemeriksaanLansia(): HasMany
    {
        return $this->hasMany(PemeriksaanLansia::class, 'pasien_id');
    }
}