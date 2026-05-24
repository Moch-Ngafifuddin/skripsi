<?php

namespace App\Filament\Resources\PemeriksaanRemajaResource\Pages;

use App\Filament\Resources\PemeriksaanRemajaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPemeriksaanRemaja extends EditRecord
{
    protected static string $resource = PemeriksaanRemajaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
