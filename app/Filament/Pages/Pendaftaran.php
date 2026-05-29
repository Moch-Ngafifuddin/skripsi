<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Filament\Resources\PasienResource;
use Illuminate\Support\Facades\Auth;

class Pendaftaran extends Page
{
    // Menggunakan ikon registrasi dari Heroicons
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    // Judul Menu di Sidebar
    protected static ?string $navigationLabel = 'Pendaftaran';

    // Judul Halaman Utama
    protected ?string $heading = 'Pendaftaran Posyandu';

    // Kelompok menu di sidebar
    protected static ?string $navigationGroup = 'Pelayanan';
    protected static ?int $navigationSort = 1;

    protected static string $view = 'filament.pages.pendaftaran';

    public function getViewData(): array
    {
        $user = Auth::user();
        
        return [
            'mejaTugas' => $user->meja_tugas ?? 'Belum Diatur',
            'urlDaftarBalita' => PasienResource::getUrl('create', ['kategori' => 'balita']),
            'urlDaftarRemaja' => PasienResource::getUrl('create', ['kategori' => 'remaja']),
            'urlDaftarLansia' => PasienResource::getUrl('create', ['kategori' => 'lansia']),
        ];
    }
}