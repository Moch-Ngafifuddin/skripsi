<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RiwayatResource\Pages;
use App\Models\Pasien;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class RiwayatResource extends Resource
{
    protected static ?string $model = Pasien::class;

    // Menggunakan ikon pencarian dokumen / riwayat
    protected static ?string $navigationIcon = 'heroicon-o-document-magnifying-glass';

    protected static ?string $navigationLabel = 'Cek Riwayat';

    protected static ?string $navigationGroup = 'Pelayanan';

    protected static ?int $navigationSort = 3;

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Pasien')
                    ->searchable()
                    ->sortable(),
                // Tables\Columns\TextColumn::make('kategori_pasien')
                //     ->label('Kategori')
                //     ->badge()
                //     ->color(fn (string $state): string => match ($state) {
                //         'balita' => 'pink',
                //         'remaja' => 'blue',
                //         'lansia' => 'emerald',
                //         default => 'gray',
                //     }),
                Tables\Columns\TextColumn::make('nik')
                    ->label('NIK')
                    ->searchable(),
            ])
            ->actions([
                // Tombol aksi kustom di sebelah kanan berbentuk ikon Riwayat
                Tables\Actions\Action::make('lihat_riwayat')
                    ->label('Riwayat')
                    ->icon('heroicon-m-clock') // Menggunakan ikon jam dinding mini
                    ->color('info')
                    ->modalHeading(fn (Pasien $record) => "Riwayat Pemeriksaan: {$record->nama}")
                    ->modalSubmitAction(false) // Menghilangkan tombol 'Save' di modal
                    ->modalCancelActionLabel('Tutup')
                    ->modalContent(fn (Pasien $record) => view('filament.pages.cek-riwayat', ['pasien' => $record])),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRiwayats::route('/'),
        ];
    }
}