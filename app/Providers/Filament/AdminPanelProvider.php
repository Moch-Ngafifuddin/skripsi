<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Models\Pengaturan;
use App\Filament\Pages\Auth\CustomLogin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        // Ambil data pengaturan baris pertama dari database
        $pengaturan = Pengaturan::first();
        
        // Cek jika ada logo di database, arahkan ke path storage asset
        $logoUrl = $pengaturan?->logo ? asset('storage/' . $pengaturan->logo) : null;
        $namaPuskesmas = $pengaturan?->nama_puskesmas ?? 'Sistem Informasi Posyandu';
        $warnaHex = $pengaturan?->warna_tema ?? '#ec4899';

        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login(CustomLogin::class) // 👈 GANTI LOGIN BIASA MENJADI CUSTOM LOGIN KITA
            ->colors([
                'primary' => $warnaHex, // 👈 WARNA TEMA JADI DINAMIS DARI DATABASE
            ])
            ->brandName($namaPuskesmas) // 👈 NAMA DI ATAS LOGO JADI DINAMIS
            ->brandLogo($logoUrl) // 👈 LOGO JADI DINAMIS
            ->brandLogoHeight('3rem')
            ->databaseNotifications()
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]); 
    }
}