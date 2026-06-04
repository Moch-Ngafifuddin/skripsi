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
                        
                        // 📑 TAB 1: MEJA 1 (PENDAFTARAN & IDENTITAS LENGKAP STANDAR E-PPGBM)
                        \Filament\Forms\Components\Tabs\Tab::make('Meja 1: Pendaftaran & Profil')
                            ->icon('heroicon-o-user-plus')
                            ->schema([
                                Forms\Components\Section::make('Identitas Utama Balita')
                                    ->schema([
                                        Forms\Components\TextInput::make('nik')
                                            ->label('NIK Anak')
                                            ->required()
                                            ->maxLength(16)
                                            ->placeholder('Masukkan 16 digit NIK'),
                                        Forms\Components\TextInput::make('no_kk')
                                            ->label('Nomor Kartu Keluarga (KK)')
                                            ->maxLength(16)
                                            ->placeholder('Masukkan 16 digit Nomor KK'),
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
                                        Forms\Components\TextInput::make('tempat_lahir')
                                            ->label('Tempat Lahir')
                                            ->required()
                                            ->placeholder('Contoh: Banyumas'),
                                        Forms\Components\DatePicker::make('tgl_lahir')
                                            ->label('Tanggal Lahir')
                                            ->required()
                                            ->native(false)
                                            ->live(),
                                        Forms\Components\Textarea::make('alamat')
                                            ->label('Alamat Rumah Lengkap (Domisili)')
                                            ->required()
                                            ->columnSpanFull()
                                            ->placeholder('Tuliskan nama jalan, RT/RW, dan nama desa...'),
                                    ])->columns(2),

                                Forms\Components\Section::make('Data Khusus Kelahiran Balita (Buku KIA)')
                                    ->schema([
                                        Forms\Components\TextInput::make('anak_ke')
                                            ->label('Anak Ke-')
                                            ->numeric()
                                            ->placeholder('Contoh: 1'),
                                        Forms\Components\TextInput::make('berat_lahir')
                                            ->label('Berat Badan Lahir (BBL)')
                                            ->numeric()
                                            ->suffix('Gram')
                                            ->placeholder('Contoh: 3100'),
                                        Forms\Components\TextInput::make('panjang_lahir')
                                            ->label('Panjang Badan Lahir (PBL)')
                                            ->numeric()
                                            ->suffix('Cm')
                                            ->placeholder('Contoh: 49'),
                                        Forms\Components\Select::make('riwayat_asi')
                                            ->label('Riwayat ASI Eksklusif')
                                            ->options([
                                                'E1' => 'E1 (ASI Eksklusif 1 Bulan)',
                                                'E2' => 'E2 (ASI Eksklusif 2 Bulan)',
                                                'E3' => 'E3 (ASI Eksklusif 3 Bulan)',
                                                'E4' => 'E4 (ASI Eksklusif 4 Bulan)',
                                                'E5' => 'E5 (ASI Eksklusif 5 Bulan)',
                                                'E6' => 'E6 (ASI Eksklusif 6 Bulan)',
                                            ]),
                                        Forms\Components\Toggle::make('imd')
                                            ->label('Inisiasi Menyusu Dini (IMD)')
                                            ->inline(false),
                                    ])->columns(2),

                                Forms\Components\Section::make('Data Orang Tua / Wali & Kontak')
                                    ->schema([
                                        Forms\Components\Group::make([
                                            Forms\Components\TextInput::make('nama_ibu')->label('Nama Ibu Kandung'),
                                            Forms\Components\TextInput::make('nik_ibu')->label('NIK Ibu')->maxLength(16),
                                            Forms\Components\TextInput::make('pendidikan_pekerjaan_ibu')->label('Pendidikan / Pekerjaan Ibu'),
                                        ])->columns(3),

                                        Forms\Components\Group::make([
                                            Forms\Components\TextInput::make('nama_ayah')->label('Nama Ayah Kandung'),
                                            Forms\Components\TextInput::make('nik_ayah')->label('NIK Ayah')->maxLength(16),
                                            Forms\Components\TextInput::make('pendidikan_pekerjaan_ayah')->label('Pendidikan / Pekerjaan Ayah'),
                                        ])->columns(3),

                                        Forms\Components\Group::make([
                                            Forms\Components\TextInput::make('nama_wali')->label('Nama Wali (Jika Ada)'),
                                            Forms\Components\TextInput::make('no_hp')->label('Nomor WhatsApp Aktif Orang Tua')->tel(),
                                        ])->columns(2),
                                    ])
                            ])
                            ->disabled(fn () => !in_array(auth()->user()->meja_tugas, ['meja_1', 'superadmin', null]) && !in_array('pasien', auth()->user()->akses_menu ?? [])),

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
                                                    ->afterStateUpdated(function (Forms\Set $set, Forms\Get $get) {
                                                        self::kalkulasiStatusGizi($set, $get);
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
                                                    ->live(onBlur: true) 
                                                    ->afterStateUpdated(function (Forms\Set $set, Forms\Get $get) {
                                                        self::kalkulasiStatusGizi($set, $get);
                                                    }),
                                                Forms\Components\TextInput::make('tinggi_badan')
                                                    ->label('Tinggi/Panjang Badan (Cm)')
                                                    ->numeric()
                                                    ->required()
                                                    ->live(onBlur: true) 
                                                    ->afterStateUpdated(function (Forms\Set $set, Forms\Get $get) {
                                                        self::kalkulasiStatusGizi($set, $get);
                                                    }),
                                                Forms\Components\Select::make('cara_ukur')
                                                    ->label('Cara Ukur')
                                                    ->options([
                                                        'berdiri' => 'Berdiri',
                                                        'terlentang' => 'Terlentang',
                                                    ])
                                                    ->required()
                                                    ->live()
                                                    ->afterStateUpdated(function (Forms\Set $set, Forms\Get $get) {
                                                        self::kalkulasiStatusGizi($set, $get);
                                                    }),
                                            ])->columns(3)
                                              ->disabled(fn () => !in_array(auth()->user()->meja_tugas, ['meja_2', 'meja_1', 'superadmin', null]) && !in_array('pasien', auth()->user()->akses_menu ?? [])),

                                        // 📏 FIELD KHUSUS MEJA 3
                                        \Filament\Forms\Components\Fieldset::make('Meja 3: LiLA & Kepala')
                                            ->schema([
                                                Forms\Components\TextInput::make('lila')->label('LiLA (Cm)')->numeric(),
                                                Forms\Components\TextInput::make('lingkar_kepala')->label('Lingkar Kepala (Cm)')->numeric(),
                                            ])->columns(2)
                                              ->disabled(fn () => !in_array(auth()->user()->meja_tugas, ['meja_3', 'meja_1', 'superadmin', null]) && !in_array('pasien', auth()->user()->akses_menu ?? [])),

                                        // 💬 FIELD KHUSUS MEJA 4 & 5
                                        \Filament\Forms\Components\Fieldset::make('Meja 4-5: Z-Score & Wawancara')
                                            ->schema([
                                                Forms\Components\TextInput::make('status_gizi')->label('Status (BB/U)')->readOnly()->placeholder('Menghitung...'),
                                                Forms\Components\TextInput::make('zscore_bbu')->label('Z-Score (BB/U)')->readOnly()->placeholder('0.00'),
                                                
                                                Forms\Components\TextInput::make('status_stunting')->label('Status (TB/U)')->readOnly()->placeholder('Menghitung...'),
                                                Forms\Components\TextInput::make('zscore_tbu')->label('Z-Score (TB/U)')->readOnly()->placeholder('0.00'),

                                                Forms\Components\TextInput::make('status_bbtb')->label('Status (BB/TB)')->readOnly()->placeholder('Fungsi Belum Aktif'),
                                                Forms\Components\TextInput::make('zscore_bbtb')->label('Z-Score (BB/TB)')->readOnly()->placeholder('0.00'),

                                                Forms\Components\Textarea::make('catatan')->label('Catatan & Intervensi')->rows(2)->columnSpan('full'),
                                            ])->columns(2)
                                              ->disabled(fn () => !in_array(auth()->user()->meja_tugas, ['meja_4', 'meja_5', 'meja_1', 'superadmin', null]) && !in_array('pasien', auth()->user()->akses_menu ?? [])),

                                    ])->columns(1)
                            ]),

                        // 📑 TAB 3: KMS DIGITAL
                        \Filament\Forms\Components\Tabs\Tab::make('KMS & Kurva Pertumbuhan')
                            ->icon('heroicon-o-chart-bar')
                            ->schema([
                                Forms\Components\ViewField::make('grafik_kms')
                                    ->view('filament.pages.kms-grafik-layout')
                                    ->dehydrated(false),
                            ]),

                        // 📑 TAB 4 RIWAYAT PEMERIKSAAN VIA CUSTOM BLADE
                        \Filament\Forms\Components\Tabs\Tab::make('Riwayat Pengukuran')
                            ->icon('heroicon-o-clock')
                            ->schema([
                                Forms\Components\ViewField::make('riwayat_pengukuran_blade')
                                    ->view('filament.pages.cek-riwayat-layout') 
                                    ->dehydrated(false),
                            ]),
                            
                    ])->columnSpan('full')
            ]);
    }

    // 🟢 SAFE REFACTORING: Ditambahkan pembungkus method_exists agar program kebal dari eror crash BB/TB
    protected static function kalkulasiStatusGizi(Forms\Set $set, Forms\Get $get): void
    {
        $bb = $get('berat_badan');
        $tb = $get('tinggi_badan');
        $caraUkur = $get('cara_ukur');
        $tglPeriksa = $get('tgl_periksa');
        $tglLahir = $get('../../tgl_lahir');
        $jkMentah = $get('../../jenis_kelamin'); 

        // Isi Usia Bulan otomatis
        $usia = null;
        if ($tglLahir && $tglPeriksa) {
            $lahir = Carbon::parse($tglLahir);
            $periksa = Carbon::parse($tglPeriksa);
            $usia = max(0, $lahir->diffInMonths($periksa, false));
            $set('usia_bulan', $usia);
        }

        $jk = null;
        if ($jkMentah === 'L') {
            $jk = 'L'; 
        } elseif ($jkMentah === 'P') {
            $jk = 'P';
        }

        if ($usia !== null && !empty($jk)) {
            
            // ⚖️ 1. Hitung Gizi & Z-Score BB/U (Sudah memakai huruf kecil sesuai Helper)
            if (!empty($bb) && is_numeric($bb)) {
                if (method_exists(\App\Helpers\AntropometriHelper::class, 'hitungBbu')) {
                    $set('status_gizi', \App\Helpers\AntropometriHelper::hitungBbu($jk, $usia, $bb));
                }
                if (method_exists(\App\Helpers\AntropometriHelper::class, 'hitungZScoreBBU')) {
                    $zscoreBbu = \App\Helpers\AntropometriHelper::hitungZScoreBBU($jk, $usia, $bb);
                    $set('zscore_bbu', is_null($zscoreBbu) ? '0.00' : number_format($zscoreBbu, 2));
                }
            }
            
            // 📏 2. Hitung TB/U dengan koreksi Cara Ukur 0.7 cm
            if (!empty($tb) && is_numeric($tb) && !empty($caraUkur)) {
                $tbKoreksi = (float) $tb;
                
                if ($usia < 24 && $caraUkur === 'berdiri') {
                    $tbKoreksi += 0.7;
                } elseif ($usia >= 24 && $caraUkur === 'terlentang') {
                    $tbKoreksi -= 0.7;
                }

                if (method_exists(\App\Helpers\AntropometriHelper::class, 'hitungTbu')) {
                    $set('status_stunting', \App\Helpers\AntropometriHelper::hitungTbu($jk, $usia, $tbKoreksi));
                }
                if (method_exists(\App\Helpers\AntropometriHelper::class, 'hitungZScoreTBU')) {
                    $zscoreTbu = \App\Helpers\AntropometriHelper::hitungZScoreTBU($jk, $usia, $tbKoreksi);
                    $set('zscore_tbu', is_null($zscoreTbu) ? '0.00' : number_format($zscoreTbu, 2));
                }

                // ⚖️📏 3. BB/TB (Hanya berjalan otomatis jika fungsi di Helper sudah kamu buat)
                if (!empty($bb) && is_numeric($bb)) {
                    if (method_exists(\App\Helpers\AntropometriHelper::class, 'hitungBbtb')) {
                        $set('status_bbtb', \App\Helpers\AntropometriHelper::hitungBbtb($jk, $tbKoreksi, $bb));
                    }
                    if (method_exists(\App\Helpers\AntropometriHelper::class, 'hitungZScoreBBTB')) {
                        $zscoreBbtb = \App\Helpers\AntropometriHelper::hitungZScoreBBTB($jk, $tbKoreksi, $bb);
                        $set('zscore_bbtb', is_null($zscoreBbtb) ? '0.00' : number_format($zscoreBbtb, 2));
                    }
                }
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
                Tables\Columns\TextColumn::make('tgl_lahir')->label('Tanggal Lahir')->date('d M Y')->sortable(),
                Tables\Columns\TextColumn::make('nama_ibu')->label('Nama Ibu')->searchable(),
                Tables\Columns\TextColumn::make('no_hp')->label('No. WhatsApp')->searchable(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                
                Tables\Actions\Action::make('arsipkan')
                    ->label('Arsipkan Data')
                    ->icon('heroicon-o-archive-box')
                    ->color('warning')
                    ->visible(fn () => in_array(Auth::user()?->meja_tugas, ['meja_1', 'superadmin', null])) 
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