<?php

namespace App\Filament\Resources\PemeriksaanRemajaResource\Pages;

use App\Filament\Resources\PemeriksaanRemajaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPemeriksaanRemajas extends ListRecords
{
    protected static string $resource = PemeriksaanRemajaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
