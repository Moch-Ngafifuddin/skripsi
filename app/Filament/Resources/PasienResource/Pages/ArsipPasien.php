<?php

namespace App\Filament\Resources\PasienResource\Pages; // 👈 1. Perubahan namespace ke folder Pages Resource

use App\Filament\Resources\PasienResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Table;
use Filament\Tables;
use App\Models\Pasien;
use Illuminate\Support\Facades\Auth;

class ArsipPasien extends ListRecords // 👈 2. Menggunakan ListRecords murni tanpa perlu import trait manual
{
    protected static string $resource = PasienResource::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';
    protected static ?string $navigationLabel = 'Arsip Pasien';
    protected static ?string $title = 'Arsip Data Balita';
    protected static ?string $navigationGroup = 'Pelayanan';
    protected static ?int $navigationSort = 5;

    public function table(Table $table): Table
    {
        return $table
            ->query(Pasien::query()->where('is_arsip', true)) // Hanya mengambil data yang diarsipkan
            ->columns([
                Tables\Columns\TextColumn::make('nik')
                    ->label('NIK')
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Balita')
                    ->searchable()
                    ->weight('bold'),
                
                Tables\Columns\TextColumn::make('jenis_kelamin')
                    ->label('JK')
                    ->badge()
                    ->colors(['info' => 'L', 'danger' => 'P']),

                Tables\Columns\TextColumn::make('status_arsip')
                    ->label('Status/Alasan')
                    ->badge()
                    ->state(function ($record) {
                        return $record->tgl_meninggal ? 'Meninggal Dunia' : 'Pindah Domisili/Puskesmas';
                    })
                    ->colors([
                        'danger' => 'Meninggal Dunia',
                        'warning' => 'Pindah Domisili/Puskesmas',
                    ]),

                Tables\Columns\TextColumn::make('detail_kondisi')
                    ->label('Detail Informasi Arsip')
                    ->wrap()
                    ->state(function ($record) {
                        if ($record->tgl_meninggal) {
                            return "Wafat: " . \Carbon\Carbon::parse($record->tgl_meninggal)->format('d/m/Y') . 
                                   " | Penyebab: " . ($record->penyebab_meninggal ?? '-') . 
                                   " | Makam: " . ($record->tempat_pemakaman ?? '-');
                        }
                        return "Ket. Pindah: " . ($record->keterangan_pindah ?? '-');
                    }),
            ])
            ->actions([
                Tables\Actions\Action::make('pulihkan')
                    ->label('Pulihkan')
                    ->icon('heroicon-o-arrow-path')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Pulihkan Data Pasien?')
                    ->modalDescription('Pasien ini akan dikembalikan ke dalam daftar Data Balita aktif.')
                    ->action(function ($record) {
                        $record->update([
                            'is_arsip' => false,
                            'keterangan_pindah' => null,
                            'tgl_meninggal' => null,
                            'penyebab_meninggal' => null,
                            'tempat_pemakaman' => null,
                        ]);

                        \Filament\Notifications\Notification::make()
                            ->title('Pasien Dipulihkan')
                            ->body("Data {$record->nama} berhasil dikembalikan ke daftar aktif.")
                            ->success()
                            ->send();
                    }),
            ])
            ->bulkActions([]);
    }

    protected function getHeaderActions(): array
    {
        return [];
    }

    public static function shouldRegisterNavigation(array $parameters = []): bool
    {
        if (Auth::user()?->email === 'admin@posyandu.com' || Auth::user()?->meja_tugas === 'superadmin') {
            return true;
        }
        $akses = Auth::user()?->akses_menu ?? [];
        return in_array('pasien', $akses);
    }

    public static function getNavigationItems(array $parameters = []): array
    {

        if (! static::shouldRegisterNavigation($parameters)) {
            return [];
        }

        return [
            \Filament\Navigation\NavigationItem::make(static::getNavigationLabel())
                ->group(static::getNavigationGroup())
                ->icon(static::getNavigationIcon())
                ->activeIcon(static::getNavigationIcon())
                ->isActiveWhen(fn () => request()->routeIs(static::getRouteName()))
                ->sort(static::getNavigationSort())
                ->url(static::getUrl()),
        ];
    }

}