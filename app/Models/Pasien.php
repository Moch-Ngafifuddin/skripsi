<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pasien extends Model
{
    protected $table = 'pasien';

    protected $fillable = [
        'is_arsip',
        'keterangan_pindah',
        'tgl_meninggal',
        'tempat_pemakaman',
        'penyebab_meninggal',
    ];
    protected $casts = [
        'nik' => 'encrypted',
        'no_kk' => 'encrypted',
        'no_hp' => 'encrypted',
        'nik_ibu' => 'encrypted',
        'nik_ayah' => 'encrypted',
        
    ];
    protected $guarded = [];

    public function pemeriksaanBayi(): HasMany
    {
        // Pastikan 'pasien_id' adalah nama kolom foreign key yang benar di tabel pemeriksaan_bayi
        return $this->hasMany(PemeriksaanBayi::class, 'pasien_id', 'id');
    }


    protected static function booted()
    {
        static::saving(function ($pasien) {
            if ($pasien->isDirty('nik')) {
                $pasien->nik_hash = $pasien->nik ? hash_hmac('sha256', $pasien->nik, config('app.key')) : null;
            }
        });
    }
}