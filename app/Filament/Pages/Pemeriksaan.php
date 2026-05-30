<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Filament\Resources\PemeriksaanBayiResource;
use App\Filament\Resources\PemeriksaanRemajaResource;
use App\Filament\Resources\PemeriksaanLansiaResource;
use Illuminate\Support\Facades\Auth;

class Pemeriksaan extends Page
{
    // Menggunakan ikon aktivitas/kesehatan
    protected static ?string $navigationIcon = 'heroicon-o-heart';

    protected static ?string $navigationLabel = 'Pemeriksaan Balita';

    protected ?string $heading = 'Pemeriksaan Posyandu';

    protected static ?string $navigationGroup = 'Pelayanan';
    
    // Urutan kedua setelah menu Pendaftaran Balita Baru
    protected static ?int $navigationSort = 2; 

    protected static string $view = 'filament.pages.pemeriksaan';

    public function getViewData(): array
    {
        $user = Auth::user();
        
        return [
            'mejaTugas' => $user->meja_tugas ?? 'Belum Diatur',
            // Membuat URL otomatis menuju halaman list index dari masing-masing resource
            'urlPemeriksaanBalita' => PemeriksaanBayiResource::getUrl('index'),
            'urlPemeriksaanRemaja' => PemeriksaanRemajaResource::getUrl('index'),
            'urlPemeriksaanLansia' => PemeriksaanLansiaResource::getUrl('index'),
        ];
    }
}