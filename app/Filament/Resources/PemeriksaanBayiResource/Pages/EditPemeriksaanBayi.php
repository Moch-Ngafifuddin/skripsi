<?php

namespace App\Filament\Resources\PemeriksaanBayiResource\Pages;

use App\Filament\Resources\PemeriksaanBayiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPemeriksaanBayi extends EditRecord
{
    protected static string $resource = PemeriksaanBayiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
