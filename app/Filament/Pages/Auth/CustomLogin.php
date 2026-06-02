<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Login as BaseLogin;
use App\Models\Pengaturan;
use Illuminate\Contracts\Support\Htmlable;

class CustomLogin extends BaseLogin
{
    // Mengubah tulisan heading default Filament
    public function getHeading(): string | Htmlable
    {
        $pengaturan = Pengaturan::first();
        return $pengaturan?->teks_login ?? 'Selamat Datang';
    }

    // 🛠️ PERBAIKAN: Hak akses diubah menjadi PUBLIC agar sama dengan BasePage Filament
    public function getView(): string
    {
        return 'filament.pages.auth.custom-login';
    }

    // 🛠️ PERBAIKAN: Hak akses diubah menjadi PUBLIC untuk mendukung kompatibilitas data
    public function getViewData(): array
    {
        $pengaturan = Pengaturan::first();

        return [
            'pengaturan'     => $pengaturan,
            'warna_tema'     => $pengaturan?->warna_tema ?? '#10b981', // Sesuai variabel di Blade
            'teks_login'     => $pengaturan?->teks_login ?? 'Selamat Datang Di Sistem Informasi Balita', // Sesuai variabel di Blade[cite: 8]
            'nama_puskesmas' => $pengaturan?->nama_puskesmas ?? 'Puskesmas Lokal', // Sesuai variabel di Blade[cite: 8]
        ];
    }
}