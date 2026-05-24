<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PemeriksaanRemajaResource\Pages;
use App\Models\PemeriksaanRemaja;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PemeriksaanRemajaResource extends Resource
{
    protected static ?string $model = PemeriksaanRemaja::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'Pemeriksaan';
    protected static ?string $navigationLabel = 'Posyandu Remaja';
    protected static ?string $pluralModelLabel = 'Pemeriksaan Remaja';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // 1. Data Kunjungan
                Forms\Components\Section::make('Data Kunjungan')
                    ->schema([
                        Forms\Components\Select::make('pasien_id')
                            ->relationship('pasien', 'nama')
                            ->label('Nama Remaja')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\DatePicker::make('tgl_periksa')
                            ->label('Tanggal Periksa')
                            ->default(now())
                            ->required(),
                    ])->columns(2),

                // 2. Fisik Dasar
                Forms\Components\Section::make('Fisik & Tanda Vital')
                    ->schema([
                        Forms\Components\TextInput::make('berat_badan')
                            ->label('Berat (Kg)')
                            ->numeric()
                            ->suffix('Kg')
                            ->required(),

                        Forms\Components\TextInput::make('tinggi_badan')
                            ->label('Tinggi (Cm)')
                            ->numeric()
                            ->suffix('Cm')
                            ->required(),
                        
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('sistole')
                                    ->label('Tensi Atas (Sys)')
                                    ->numeric()
                                    ->suffix('mmHg'),
                                
                                Forms\Components\TextInput::make('diastole')
                                    ->label('Tensi Bawah (Dia)')
                                    ->numeric()
                                    ->suffix('mmHg'),
                            ]),
                    ])->columns(2),

                // 3. Screening Anemia & Gizi (Penting utk Remaja Putri)
                Forms\Components\Section::make('Screening Kesehatan')
                    ->description('Khusus screening anemia dan gizi')
                    ->schema([
                        Forms\Components\TextInput::make('kadar_hb')
                            ->label('Hemoglobin (Hb)')
                            ->numeric()
                            ->step(0.1) // Bisa desimal, misal 11.5
                            ->suffix('g/dL'),

                        Forms\Components\TextInput::make('lingkar_lengan')
                            ->label('Lingkar Lengan (LiLA)')
                            ->numeric()
                            ->suffix('Cm'),

                        Forms\Components\Toggle::make('minum_ttd')
                            ->label('Sudah Minum Tablet Tambah Darah (TTD)?')
                            ->inline(false)
                            ->onColor('success')
                            ->offColor('danger'),
                    ])->columns(3),

                // 4. Keluhan
                Forms\Components\Section::make('Lainnya')
                    ->schema([
                        Forms\Components\Textarea::make('keluhan')
                            ->label('Keluhan / Konseling')
                            ->columnSpanFull(),
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

                // Menggabungkan Tensi menjadi satu kolom (Contoh: 110/80)
                Tables\Columns\TextColumn::make('tensi')
                    ->label('Tensi')
                    ->state(function (PemeriksaanRemaja $record): string {
                        if ($record->sistole && $record->diastole) {
                            return "{$record->sistole}/{$record->diastole}";
                        }
                        return '-';
                    }),

                Tables\Columns\TextColumn::make('kadar_hb')
                    ->label('Hb')
                    ->suffix(' g/dL')
                    ->color(fn (string $state): string => $state < 12 ? 'danger' : 'success'), 
                    // ^ Otomatis MERAH jika Hb < 12 (Anemia)

                Tables\Columns\IconColumn::make('minum_ttd')
                    ->label('TTD')
                    ->boolean(),
            ])
            ->defaultSort('tgl_periksa', 'desc')
            ->filters([
                Tables\Filters\Filter::make('anemia')
                    ->label('Indikasi Anemia (Hb < 12)')
                    ->query(fn ($query) => $query->where('kadar_hb', '<', 12)),
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
            'index' => Pages\ListPemeriksaanRemajas::route('/'),
            'create' => Pages\CreatePemeriksaanRemaja::route('/create'),
            'edit' => Pages\EditPemeriksaanRemaja::route('/{record}/edit'),
        ];
    }

    public static function shouldRegisterNavigation(): bool
    {
        if (Auth::user()?->email === 'admin@posyandu.com' || Auth::user()?->meja_tugas === 'superadmin') {
            return true;
        }
        $akses = Auth::user()?->akses_menu ?? [];
        return in_array('remaja', $akses); // Harus sama dengan kunci di UserResource
    }
}