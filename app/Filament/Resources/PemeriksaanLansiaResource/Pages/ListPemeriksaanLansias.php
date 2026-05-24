<?php

namespace App\Filament\Resources\PemeriksaanLansiaResource\Pages;

use App\Filament\Resources\PemeriksaanLansiaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPemeriksaanLansias extends ListRecords
{
    protected static string $resource = PemeriksaanLansiaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
