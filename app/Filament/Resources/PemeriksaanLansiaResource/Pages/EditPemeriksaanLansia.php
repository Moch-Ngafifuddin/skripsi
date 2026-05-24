<?php

namespace App\Filament\Resources\PemeriksaanLansiaResource\Pages;

use App\Filament\Resources\PemeriksaanLansiaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPemeriksaanLansia extends EditRecord
{
    protected static string $resource = PemeriksaanLansiaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
