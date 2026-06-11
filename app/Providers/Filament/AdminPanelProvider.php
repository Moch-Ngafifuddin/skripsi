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
use Illuminate\Support\HtmlString;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        $pengaturan = Pengaturan::first();
        $logoUrl = $pengaturan?->logo ? asset('storage/' . $pengaturan->logo) : asset('logo_kecil.svg');
        $namaPuskesmas = $pengaturan?->nama_puskesmas ?? 'Sistem Informasi Posyandu';
        $warnaHex = $pengaturan?->warna_tema ?? '#10b981';
        $textLogo = $pengaturan?->text_logo ?? '';
        $tinggiLogoUtama = $pengaturan?->tinggi_logo_utama ?? '2.5rem'; 

        return $panel
            ->default()
            ->id('admin')
            ->favicon(asset('logo_kecil.svg'))
            ->path('')
            ->login(CustomLogin::class)
            ->colors([
                'primary' => Color::Emerald,
                'success' => Color::Teal,
                'warning' => Color::Amber,
                'danger'  => Color::Rose,
                'info'    => Color::Sky,
                'gray'    => Color::Slate,
            ])
            
            // 🟢 PERBAIKAN 1: Mengunci Nama Brand Utama sesuai Nama Puskesmas
            ->brandName($namaPuskesmas) 

            // 🟢 PERBAIKAN 2: Render Teks Murni dari input text_logo di samping gambar logo asli
            ->brandLogo(new \Illuminate\Support\HtmlString("
                <div class='flex items-center gap-3 py-1'>
                    <img src='{$logoUrl}' alt='Logo' style='height: {$tinggiLogoUtama}; width: auto; object-fit: contain;' />
                    <div class='flex flex-col'>
                        <span class='text-sm font-bold text-slate-800 dark:text-white tracking-wide leading-tight break-words max-w-[160px]'>
                            " . e($textLogo) . "
                        </span>
                    </div>
                </div>
            "))
            ->brandLogoHeight($tinggiLogoUtama)
            
            // 🟢 PERBAIKAN UTAMA 3: Mengunci Judul Tab Browser menggunakan HTML Head Render Hook
            // Cara ini memaksa browser mengabaikan text 'Dashboard' atau 'Pasien' dan menguncinya ke Nama Puskesmas
            ->renderHook(
                'panels::head.end',
                fn () => new \Illuminate\Support\HtmlString("
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            // Mengunci judul tab pertama kali dimuat
                            document.title = '" . e($namaPuskesmas) . "';
                            
                            // Mencegah Livewire mengubah judul kembali saat berpindah halaman menu
                            const observer = new MutationObserver(function(mutations) {
                                if (document.title !== '" . e($namaPuskesmas) . "') {
                                    document.title = '" . e($namaPuskesmas) . "';
                                }
                            });
                            observer.observe(document.querySelector('title'), { subtree: true, characterData: true, childList: true });
                        });
                    </script>
                ")
            )
            
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