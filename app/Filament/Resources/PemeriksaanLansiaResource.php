<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PemeriksaanLansiaResource\Pages;
use App\Models\PemeriksaanLansia;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Table;

class PemeriksaanLansiaResource extends Resource
{
    protected static ?string $model = PemeriksaanLansia::class;
    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }
    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $navigationIcon = 'heroicon-o-heart'; // Ikon Hati/Kesehatan
    protected static ?string $navigationGroup = 'Pemeriksaan';
    protected static ?string $navigationLabel = 'Posyandu Lansia';
    protected static ?string $pluralModelLabel = 'Pemeriksaan Lansia';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // 1. Kunjungan
                Forms\Components\Section::make('Data Kunjungan')
                    ->schema([
                        Forms\Components\Select::make('pasien_id')
                            ->relationship('pasien', 'nama')
                            ->label('Nama Lansia')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\DatePicker::make('tgl_periksa')
                            ->label('Tanggal Periksa')
                            ->default(now())
                            ->required(),
                    ])->columns(2),

                // 2. Tanda Vital
                Forms\Components\Section::make('Tanda Vital')
                    ->schema([
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('berat_badan')
                                    ->label('Berat (Kg)')
                                    ->numeric()
                                    ->required(),
                                Forms\Components\TextInput::make('tinggi_badan')
                                    ->label('Tinggi (Cm)')
                                    ->numeric()
                                    ->required(),
                                Forms\Components\TextInput::make('lingkar_perut')
                                    ->label('Lingkar Perut')
                                    ->numeric()
                                    ->suffix('Cm'),
                            ]),
                        
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('sistole')
                                    ->label('Tensi Atas')
                                    ->numeric()
                                    ->suffix('mmHg')
                                    ->required(),
                                Forms\Components\TextInput::make('diastole')
                                    ->label('Tensi Bawah')
                                    ->numeric()
                                    ->suffix('mmHg')
                                    ->required(),
                            ]),
                    ]),

                // 3. Laboratorium Sederhana (Stick)
                Forms\Components\Section::make('Cek Lab Sederhana')
                    ->description('Isi jika dilakukan pemeriksaan')
                    ->schema([
                        Forms\Components\TextInput::make('gula_darah')
                            ->label('Gula Darah (GDS)')
                            ->numeric()
                            ->suffix('mg/dL'),

                        Forms\Components\TextInput::make('kolesterol')
                            ->label('Kolesterol')
                            ->numeric()
                            ->suffix('mg/dL'),

                        Forms\Components\TextInput::make('asam_urat')
                            ->label('Asam Urat')
                            ->numeric()
                            ->step(0.1)
                            ->suffix('mg/dL'),
                    ])->columns(3),

                // 4. Diagnosa
                Forms\Components\Section::make('Diagnosa & Tindakan')
                    ->schema([
                        Forms\Components\Textarea::make('riwayat_penyakit')
                            ->label('Keluhan / Riwayat')
                            ->rows(2),
                        
                        Forms\Components\Textarea::make('tindakan')
                            ->label('Tindakan / Obat / Rujukan')
                            ->rows(2),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tgl_periksa')
                    ->date('d M Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('pasien.nama')
                    ->searchable()
                    ->weight('bold'),

                // Tensi dengan logika warna (Merah jika tinggi > 140)
                Tables\Columns\TextColumn::make('tensi')
                    ->label('Tensi')
                    ->state(fn (PemeriksaanLansia $record) => "{$record->sistole}/{$record->diastole}")
                    ->color(fn (PemeriksaanLansia $record) => $record->sistole > 140 ? 'danger' : 'success')
                    ->badge(),

                Tables\Columns\TextColumn::make('gula_darah')
                    ->label('Gula')
                    ->suffix(' mg/dL')
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make('kolesterol')
                    ->label('Kolest.')
                    ->suffix(' mg/dL')
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make('asam_urat')
                    ->label('As. Urat')
                    ->placeholder('-'),
            ])
            ->defaultSort('tgl_periksa', 'desc')
            ->filters([
                // Filter Hipertensi
                Tables\Filters\Filter::make('hipertensi')
                    ->label('Hipertensi (Sys > 140)')
                    ->query(fn ($query) => $query->where('sistole', '>', 140)),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPemeriksaanLansias::route('/'),
            'create' => Pages\CreatePemeriksaanLansia::route('/create'),
            'edit' => Pages\EditPemeriksaanLansia::route('/{record}/edit'),
        ];
    }
}