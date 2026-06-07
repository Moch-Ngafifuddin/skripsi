<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PasienResource\Pages;
use App\Models\Pasien;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Get;

class PasienResource extends Resource
{
    protected static ?string $model = Pasien::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-plus';
    protected static ?string $navigationLabel = 'Input Data Balita Baru';
    protected static ?string $pluralModelLabel = 'Data Balita';
    protected static ?string $navigationGroup = 'Pelayanan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Identitas Utama Balita')
                    ->schema([
                        Forms\Components\TextInput::make('nama')->label('Nama Lengkap Balita')->required(),
                        Forms\Components\Radio::make('jenis_kelamin')->label('Jenis Kelamin')->options(['L' => 'Laki-laki', 'P' => 'Perempuan'])->inline()->required(),
                        Forms\Components\TextInput::make('tempat_lahir')->label('Tempat Lahir')->required(),
                        Forms\Components\DatePicker::make('tgl_lahir')->label('Tanggal Lahir')->required()->native(false),
                        Forms\Components\TextInput::make('no_kk')->label('Nomor Kartu Keluarga (KK)')->numeric()->maxLength(16),

                        Forms\Components\Grid::make(2)->schema([
                            Forms\Components\TextInput::make('nik')
                                ->label('Nomor NIK Anak')
                                ->numeric()
                                ->maxLength(16)
                                ->required(fn (Get $get) => !$get('belum_punya_nik'))
                                ->disabled(fn (Get $get) => $get('belum_punya_nik'))
                                ->dehydrated(),
                            Forms\Components\Checkbox::make('belum_punya_nik')
                                ->label('Anak belum memiliki NIK')
                                ->live()
                                ->dehydrated(false) // Jangan masukkan checkbox ini ke database
                        ]),
                    ])->columns(2),

                Forms\Components\Section::make('Data Kelahiran & Pengukuran Awal (Buku KIA)')
                    ->schema([
                        Forms\Components\TextInput::make('anak_ke')->label('Anak Ke-')->numeric(),
                        Forms\Components\TextInput::make('usia_kehamilan')->label('Usia Kehamilan Saat Lahir (Minggu)')->numeric(),
                        Forms\Components\TextInput::make('berat_lahir')->label('Berat Lahir (Kg)')->numeric()->live(onBlur: true)->helperText('Gunakan titik, misal: 2.4'),
                        Forms\Components\TextInput::make('panjang_lahir')->label('Panjang Lahir (Cm)')->numeric(),
                        Forms\Components\TextInput::make('lingkar_kepala_lahir')->label('Lingkar Kepala Lahir (Cm)')->numeric(),
                        Forms\Components\Toggle::make('imd')->label('Inisiasi Menyusu Dini (IMD)')->inline(false),

                        Forms\Components\Fieldset::make('Tatalaksana BBLR & Prematur')
                            ->visible(fn (Get $get) => is_numeric($get('berat_lahir')) && (float) $get('berat_lahir') < 2.5)
                            ->schema([
                                Forms\Components\Checkbox::make('buku_kia_bayi_kecil')->label('Mendapatkan Buku KIA Bayi Kecil (BBLR & Prematur)'),
                                Forms\Components\Checkbox::make('tatalaksana_bblr')->label('Mendapatkan Tatalaksana BBLR'),
                            ])->columns(1)
                    ])->columns(3),

                Forms\Components\Section::make('Informasi Orang Tua & Wilayah')
                    ->schema([
                        Forms\Components\Group::make([
                            Forms\Components\TextInput::make('nama_ibu')->label('Nama Ibu'),
                            Forms\Components\TextInput::make('nik_ibu')->label('NIK Ibu')->numeric()->maxLength(16),
                            Forms\Components\TextInput::make('nama_ayah')->label('Nama Ayah'),
                            Forms\Components\TextInput::make('nik_ayah')->label('NIK Ayah')->numeric()->maxLength(16),
                        ])->columns(2),

                        Forms\Components\Grid::make(3)->schema([
                            Forms\Components\Select::make('provinsi')->label('Provinsi')->options(['Jawa Tengah' => 'Jawa Tengah', 'Jawa Barat' => 'Jawa Barat']),
                            Forms\Components\TextInput::make('kabupaten')->label('Kabupaten/Kota'),
                            Forms\Components\TextInput::make('kecamatan')->label('Kecamatan'),
                            Forms\Components\TextInput::make('desa_kelurahan')->label('Desa/Kelurahan'),
                            Forms\Components\TextInput::make('nama_puskesmas')->label('Nama Puskesmas'),
                            Forms\Components\TextInput::make('nama_posyandu')->label('Nama Posyandu'),
                        ]),

                        Forms\Components\Grid::make(4)->schema([
                            Forms\Components\Textarea::make('alamat')->label('Alamat Lengkap')->columnSpan(2),
                            Forms\Components\TextInput::make('rt')->label('RT')->numeric(),
                            Forms\Components\TextInput::make('rw')->label('RW')->numeric(),
                        ]),
                        Forms\Components\TextInput::make('no_hp')->label('Nomor WhatsApp Aktif')->tel(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nik')
                ->label('NIK')
                ->searchable(query: function ($query, $search) {
                    $query->orWhere('nik_hash', hash('sha256', $search));
                }),
                Tables\Columns\TextColumn::make('nama')->label('Nama Balita')->searchable(),
                Tables\Columns\TextColumn::make('jenis_kelamin')->label('L/P'),
                Tables\Columns\TextColumn::make('tgl_lahir')->label('Tanggal Lahir')->date('d M Y'),
                Tables\Columns\TextColumn::make('nama_ibu')->label('Nama Ibu')->searchable(),
            ])
            ->actions([Tables\Actions\EditAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPasiens::route('/'),
            'create' => Pages\CreatePasien::route('/create'),
            'edit' => Pages\EditPasien::route('/{record}/edit'),
        ];
    }
    
    public static function canAccess(): bool
    {
        if (Auth::user()?->email === 'admin@posyandu.com' || Auth::user()?->meja_tugas === 'superadmin') return true;
        return in_array('pasien', Auth::user()?->akses_menu ?? []);
    }
}