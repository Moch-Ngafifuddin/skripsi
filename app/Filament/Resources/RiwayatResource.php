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

    protected static ?string $navigationIcon = 'heroicon-o-document-magnifying-glass';

    protected static ?string $navigationLabel = 'Cek Riwayat Pengukuran';

    protected static ?string $navigationGroup = 'Pelayanan';

    protected static ?int $navigationSort = 3;

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // 1. Kolom No (Nomor Urut Otomatis)
                Tables\Columns\TextColumn::make('no')
                    ->label('No')
                    ->rowIndex(),

                // 2. Kolom NIK
                Tables\Columns\TextColumn::make('nik')
                    ->label('NIK')
                    ->searchable()
                    ->sortable(),

                // 3. Kolom Nama Pasien
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama')
                    ->searchable()
                    ->sortable()
                    ->weight('semibold'),

                // 4. Kolom Jenis Kelamin (JK)
                Tables\Columns\TextColumn::make('jenis_kelamin')
                    ->label('JK')
                    ->alignCenter(),

                // 5. Kolom Tanggal Lahir (Format: DD-MM-YYYY)
                Tables\Columns\TextColumn::make('tgl_lahir')
                    ->label('Tgl Lahir')
                    ->date('d-m-Y')
                    ->sortable(),

                // 6. Kolom Nama Orang Tua (Mengambil data nama_ibu dari model pasien)
                Tables\Columns\TextColumn::make('nama_ibu')
                    ->label('Nama Ortu')
                    ->searchable()
                    ->placeholder('-'),

                // 7. Kolom Provinsi (Diambil dinamis dari akun petugas yang sedang login)
                Tables\Columns\TextColumn::make('prov')
                    ->label('Prov')
                    ->state(fn () => auth()->user()?->provinsi ?? '-'),

                // 8. Kolom Kab/Kota (Diambil dinamis dari akun petugas yang sedang login)
                Tables\Columns\TextColumn::make('kab_kota')
                    ->label('Kab/Kota')
                    ->state(fn () => auth()->user()?->kabupaten_kota ?? '-'),

                // 9. Kolom Kecamatan (Diambil dinamis dari akun petugas yang sedang login)
                Tables\Columns\TextColumn::make('kec')
                    ->label('Kec')
                    ->state(fn () => auth()->user()?->kecamatan ?? '-'),

                // 10. Kolom Puskesmas (Diambil dinamis dari akun petugas yang sedang login)
                Tables\Columns\TextColumn::make('puskesmas')
                    ->label('Puskesmas')
                    ->state(fn () => auth()->user()?->nama_puskesmas ?? '-'),

                // 11. Kolom Desa/Kel (Diambil dinamis dari akun petugas yang sedang login)
                Tables\Columns\TextColumn::make('desa_kel')
                    ->label('Desa/Kel')
                    ->state(fn () => auth()->user()?->desa_kelurahan ?? '-'),

                // 12. Kolom Posyandu (Diambil dinamis dari akun petugas yang sedang login)
                Tables\Columns\TextColumn::make('posyandu')
                    ->label('Posyandu')
                    ->state(fn () => auth()->user()?->nama_posyandu ?? '-'),
            ])
            ->actions([
                // Tombol aksi bawaan / kustom diletakkan di kolom Tindakan secara otomatis
                Tables\Actions\Action::make('lihat_riwayat')
                    ->label('Riwayat')
                    ->icon('heroicon-m-clock')
                    ->color('info')
                    ->iconButton() // Mengubah tombol menjadi lingkaran ikon murni agar hemat ruang seperti di foto
                    ->modalHeading(fn (Pasien $record) => "Riwayat Pemeriksaan: {$record->nama}")
                    ->modalSubmitAction(false)
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