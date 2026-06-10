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

        $pengaturan = Pengaturan::first();
        $logoUrl = $pengaturan?->logo ? asset('storage/' . $pengaturan->logo) : null;
        $namaPuskesmas = $pengaturan?->nama_puskesmas ?? 'Sistem Informasi Posyandu';
        $warnaHex = $pengaturan?->warna_tema ?? '#10b981';

        $tinggiLogoUtama = $pengaturan?->tinggi_logo_utama ?? '2.5rem'; 

        return $panel
            ->default()
            ->id('admin')
            ->favicon(asset('logo_kecil.svg'))
            ->path('')
            ->login(CustomLogin::class)
            ->colors([
                //'primary' => $warnaHex,
                'primary' => Color::Emerald,
                'success' => Color::Teal,
                'warning' => Color::Amber,
                'danger'  => Color::Rose,
                'info'    => Color::Sky,
                'gray'    => Color::Slate,
            ])
            ->brandName($namaPuskesmas)
            ->brandLogo($logoUrl)
            ->brandLogoHeight($tinggiLogoUtama)
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