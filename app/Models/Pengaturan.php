<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    protected $table = 'pengaturan';

    protected $fillable = [
        'nama_puskesmas',
        'teks_login',
        'logo',
        'warna_tema',
        'logos',
        'background_login',
    ];
    
    protected $casts = [
        'logos' => 'array',
    ];
}