<?php

namespace App\Filament\Resources\PasienResource\Pages;
use App\Filament\Resources\PasienResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePasien extends CreateRecord
{
    protected static string $resource = PasienResource::class;

    // Tambahkan ini untuk mengubah judul "Create Pasien" menjadi "Buat Data Pasien"
    public function getTitle(): string 
    {
        return 'Buat Data Pasien';
    }
}