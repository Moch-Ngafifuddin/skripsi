<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Filament\Resources\PasienResource;
use Illuminate\Support\Facades\Auth;

class Pendaftaran extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
    protected static ?string $navigationLabel = 'Pendaftaran Balita Baru';
    protected ?string $heading = 'Pendaftaran Balita Baru';
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