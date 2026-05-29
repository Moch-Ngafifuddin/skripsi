<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Login as BaseLogin;
use App\Models\Pengaturan;
use Illuminate\Contracts\Support\Htmlable;

class CustomLogin extends BaseLogin
{
    // Mengubah tulisan heading di dalam kotak card login secara dinamis
    public function getHeading(): string | Htmlable
    {
        $pengaturan = Pengaturan::first();
        return $pengaturan?->teks_login ?? 'Selamat Datang';
    }
}