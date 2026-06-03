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
use Carbon\Carbon;

class PasienResource extends Resource
{
    protected static ?string $model = Pasien::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Data Balita';
    protected static ?string $pluralModelLabel = 'Data Balita';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?string $modelLabel = 'Data Balita';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                \Filament\Forms\Components\Tabs::make('Pusat Pelayanan Terpadu Balita')
                    ->tabs([
                        
                        // 📑 TAB 1: MEJA 1 (PENDAFTARAN & IDENTITAS)
                        \Filament\Forms\Components\Tabs\Tab::make('Meja 1: Pendaftaran & Profil')
                            ->icon('heroicon-o-user-plus')
                            ->schema([
                                \Filament\Forms\Components\Group::make([
                                    Forms\Components\TextInput::make('nik')
                                        ->label('NIK Anak')
                                        ->required()
                                        ->maxLength(16)
                                        ->placeholder('Masukkan 16 digit NIK'),
                                    Forms\Components\TextInput::make('nama')
                                        ->label('Nama Lengkap Balita')
                                        ->required()
                                        ->placeholder('Contoh: Radithya Adhyasta Pratama'),
                                    Forms\Components\Select::make('jenis_kelamin')
                                        ->label('Jenis Kelamin')
                                        ->options([
                                            'L' => 'Laki-laki',
                                            'P' => 'Perempuan',
                                        ])
                                        ->required()
                                        ->live(),
                                    Forms\Components\DatePicker::make('tanggal_lahir')
                                        ->label('Tanggal Lahir')
                                        ->required()
                                        ->native(false)
                                        ->live(),
                                ])->columns(2),

                                \Filament\Forms\Components\Section::make('Data Orang Tua / Wali')
                                    ->schema([
                                        Forms\Components\TextInput::make('nama_ibu')->label('Nama Ibu Kandung'),
                                        Forms\Components\TextInput::make('nama_ayah')->label('Nama Ayah'),
                                        Forms\Components\TextInput::make('no_hp')->label('Nomor WhatsApp (Aktif)')->tel(),
                                    ])->columns(3)
                            ])
                            ->disabled(fn () => !in_array(auth()->user()->meja_tugas, [1, 'superadmin', null]) && !in_array('pasien', auth()->user()->akses_menu ?? [])),

                        // 📑 TAB 2: MEJA 2-5 (PELAYANAN BULANAN)
                        \Filament\Forms\Components\Tabs\Tab::make('Meja 2-5 & Riwayat')
                            ->icon('heroicon-o-plus-circle')
                            ->schema([
                                Forms\Components\Repeater::make('pemeriksaanBayi')
                                    ->relationship('pemeriksaanBayi')
                                    ->label('Siklus Pengukuran & Konseling Anak')
                                    ->createItemButtonLabel('Tambah Data Kunjungan Bulan Ini')
                                    ->collapsible()
                                    ->schema([
                                        
                                        \Filament\Forms\Components\Grid::make(3)
                                            ->schema([
                                                Forms\Components\DatePicker::make('tgl_periksa')
                                                    ->label('Tanggal Periksa')
                                                    ->default(now())
                                                    ->required()
                                                    ->live()
                                                    ->afterStateUpdated(function (Forms\Set $set, Forms\Get $get, $state) {
                                                        $tglLahir = $get('../../tanggal_lahir');
                                                        if ($tglLahir && $state) {
                                                            $lahir = Carbon::parse($tglLahir);
                                                            $periksa = Carbon::parse($state);
                                                            $selisih = $lahir->diffInMonths($periksa, false);
                                                            $set('usia_bulan', max(0, $selisih));
                                                        }
                                                    }),

                                                Forms\Components\TextInput::make('usia_bulan')
                                                    ->label('Usia (Bulan)')
                                                    ->numeric()
                                                    ->required()
                                                    ->readOnly() 
                                                    ->helperText('Otomatis'),
                                            ]),

                                        // ⚖️ FIELD KHUSUS MEJA 2
                                        \Filament\Forms\Components\Fieldset::make('Meja 2: Pengukuran Fisik')
                                            ->schema([
                                                Forms\Components\TextInput::make('berat_badan')
                                                    ->label('Berat Badan (Kg)')
                                                    ->numeric()
                                                    ->required()
                                                    ->lazy() 
                                                    ->afterStateUpdated(function (Forms\Set $set, Forms\Get $get, $state) {
                                                        if (!empty($state)) self::kalkulasiStatusGizi($set, $get);
                                                    }),
                                                Forms\Components\TextInput::make('tinggi_badan')
                                                    ->label('Tinggi Badan (Cm)')
                                                    ->numeric()
                                                    ->required()
                                                    ->lazy() 
                                                    ->afterStateUpdated(function (Forms\Set $set, Forms\Get $get, $state) {
                                                        if (!empty($state)) self::kalkulasiStatusGizi($set, $get);
                                                    }),
                                            ])->columns(2)
                                              ->disabled(fn () => !in_array(auth()->user()->meja_tugas, [2, 1, 'superadmin', null]) && !in_array('pasien', auth()->user()->akses_menu ?? [])),

                                        // 📏 FIELD KHUSUS MEJA 3
                                        \Filament\Forms\Components\Fieldset::make('Meja 3: LiLA & Kepala')
                                            ->schema([
                                                Forms\Components\TextInput::make('lila')->label('LiLA (Cm)')->numeric(),
                                                Forms\Components\TextInput::make('lingkar_kepala')->label('Lingkar Kepala (Cm)')->numeric(),
                                            ])->columns(2)
                                              ->disabled(fn () => !in_array(auth()->user()->meja_tugas, [3, 1, 'superadmin', null]) && !in_array('pasien', auth()->user()->akses_menu ?? [])),

                                        // 💬 FIELD KHUSUS MEJA 4 & 5
                                        \Filament\Forms\Components\Fieldset::make('Meja 4-5: Z-Score & Wawancara')
                                            ->schema([
                                                Forms\Components\TextInput::make('status_gizi')->label('Status Gizi')->readOnly(),
                                                Forms\Components\TextInput::make('status_stunting')->label('Status Stunting')->readOnly(),
                                                Forms\Components\Textarea::make('catatan')->label('Catatan & Intervensi')->rows(2)->columnSpan('full'),
                                            ])->columns(2)
                                              ->disabled(fn () => !in_array(auth()->user()->meja_tugas, [4, 5, 1, 'superadmin', null]) && !in_array('pasien', auth()->user()->akses_menu ?? [])),

                                    ])->columns(1)
                            ]),

                        // 📑 TAB 3: KMS DIGITAL
                        \Filament\Forms\Components\Tabs\Tab::make('KMS & Kurva Pertumbuhan')
                            ->icon('heroicon-o-chart-bar')
                            ->schema([
                                Forms\Components\ViewField::make('grafik_kms')
                                    ->view('filament.pages.kms-grafik-layout')
                            ]),

                        // 🟢 SOLUSI UTAMA: 📑 TAB 4 RIWAYAT PEMERIKSAAN VIA CUSTOM BLADE (CEK-RIWAYAT)
                        \Filament\Forms\Components\Tabs\Tab::make('Riwayat Pengukuran')
                            ->icon('heroicon-o-clock')
                            ->schema([
                                Forms\Components\ViewField::make('riwayat_pengukuran_blade')
                                    ->view('filament.pages.cek-riwayat-layout') // Mengarah ke file penjembatan view
                            ]),
                            
                    ])->columnSpan('full')
            ]);
    }

    protected static function kalkulasiStatusGizi(Forms\Set $set, Forms\Get $get): void
    {
        $bb = $get('berat_badan');
        $tb = $get('tinggi_badan');
        $usia = $get('usia_bulan');
        $jk = $get('../../jenis_kelamin'); 

        if ($usia !== null && !empty($jk)) {
            if (!empty($bb) && is_numeric($bb)) {
                $set('status_gizi', \App\Helpers\AntropometriHelper::hitungBBU($usia, $bb, $jk));
            }
            if (!empty($tb) && is_numeric($tb)) {
                $set('status_stunting', \App\Helpers\AntropometriHelper::hitungTBU($usia, $tb, $jk));
            }
        }
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nik')->label('NIK')->searchable()->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('nama')->label('Nama Balita')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('jenis_kelamin')->label('L/P')->sortable(),
                Tables\Columns\TextColumn::make('tanggal_lahir')->label('Tanggal Lahir')->date('d M Y')->sortable(),
                Tables\Columns\TextColumn::make('nama_ibu')->label('Nama Ibu')->searchable(),
                Tables\Columns\TextColumn::make('no_hp')->label('No. WhatsApp')->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                
                Tables\Actions\Action::make('arsipkan')
                    ->label('Arsipkan Data')
                    ->icon('heroicon-o-archive-box')
                    ->color('warning')
                    ->visible(fn () => in_array(Auth::user()?->meja_tugas, [1, 'superadmin', null])) 
                    ->form([
                        Forms\Components\Select::make('keterangan_pindah')
                            ->label('Alasan Arsip')
                            ->options([
                                'pindah_domisili' => 'Pindah Domisili',
                                'lulus_posyandu' => 'Lulus Posyandu (Usia > 60 Bulan)',
                                'meninggal_dunia' => 'Meninggal Dunia',
                            ])
                            ->required()
                            ->live(),
                        Forms\Components\DatePicker::make('tgl_meninggal')
                            ->label('Tanggal Meninggal')
                            ->visible(fn (Forms\Get $get) => $get('keterangan_pindah') === 'meninggal_dunia')
                            ->required(fn (Forms\Get $get) => $get('keterangan_pindah') === 'meninggal_dunia'),
                    ])
                    ->action(function (Pasien $record, array $data) {
                        $record->update([
                            'is_arsip' => true,
                            'keterangan_pindah' => $data['keterangan_pindah'] ?? null,
                            'tgl_meninggal' => $data['tgl_meninggal'] ?? null,
                        ]);

                        \Filament\Notifications\Notification::make()
                            ->title('Data Berhasil Diarsipkan')
                            ->success()
                            ->send();
                    }),
            ])
            ->bulkActions([]);
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
        if (Auth::user()?->email === 'admin@posyandu.com' || Auth::user()?->meja_tugas === 'superadmin') {
            return true;
        }
        $akses = Auth::user()?->akses_menu ?? [];
        return in_array('pasien', $akses);
    }
}