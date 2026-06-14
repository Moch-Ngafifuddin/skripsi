<?php

namespace App\Filament\Resources;

use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Select;
use Filament\Tables\Filters\Filter;
use Carbon\Carbon;
use App\Models\Pasien;
use App\Filament\Resources\PemeriksaanBayiResource\Pages;
use App\Models\PemeriksaanBayi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Components\Toggle;

class PemeriksaanBayiResource extends Resource
{
    protected static ?string $model = PemeriksaanBayi::class;
    
    protected static bool $shouldRegisterNavigation = true;
    protected static ?string $navigationIcon = 'fas-baby'; 
    protected static ?string $navigationGroup = 'Pelayanan';
    protected static ?string $navigationLabel = 'Pemeriksaan Balita';
    protected static ?string $pluralModelLabel = 'Pendaftaran Pemeriksaan Balita';

    public static function form(Form $form): Form
    {
        $hitungUmur = function (Forms\Set $set, Forms\Get $get) {
            $pasienId = $get('pasien_id');
            $tglPeriksa = $get('tgl_periksa');
            
            if (!$pasienId || !$tglPeriksa) {
                $set('keterangan_umur', null);
                $set('usia_bulan', null);
                return;
            }
            
            $pasien = Pasien::find($pasienId);
            if (!$pasien || !$pasien->tgl_lahir) return;
            
            $lahir = Carbon::parse($pasien->tgl_lahir);
            $periksa = Carbon::parse($tglPeriksa);
            
            $hari = (int) $lahir->diffInDays($periksa);
            $bulan = (int) $lahir->diffInMonths($periksa);
            $tahun = (int) $lahir->diffInYears($periksa);
            
            $set('usia_bulan', max(0, $bulan));
            
            if ($tahun >= 1) {
                $sisaBulan = $bulan % 12;
                $set('keterangan_umur', $sisaBulan > 0 ? "{$tahun} Thn {$sisaBulan} Bln" : "{$tahun} Thn");
            } elseif ($bulan >= 1) {
                $set('keterangan_umur', "{$bulan} Bulan");
            } else {
                $set('keterangan_umur', "{$hari} Hari");
            }
        };

        $kalkulasiStatusGizi = function (Forms\Set $set, Forms\Get $get) {
            $bb = $get('berat_badan');
            $tb = $get('tinggi_badan');
            $caraUkur = $get('cara_ukur');
            $usia = $get('usia_bulan');
            $pasienId = $get('pasien_id');

            if (!$pasienId || $usia === null) return;
            
            $pasien = Pasien::find($pasienId);
            if (!$pasien) return;

            $jk = $pasien->jenis_kelamin;

            if (!empty($bb) && is_numeric($bb)) {
                if (method_exists(\App\Helpers\AntropometriHelper::class, 'hitungBbu')) {
                    $set('status_gizi', \App\Helpers\AntropometriHelper::hitungBbu($jk, $usia, $bb));
                }
                if (method_exists(\App\Helpers\AntropometriHelper::class, 'hitungZScoreBBU')) {
                    $zscoreBbu = \App\Helpers\AntropometriHelper::hitungZScoreBBU($jk, $usia, $bb);
                    $set('zscore_bbu', is_null($zscoreBbu) ? '0.00' : number_format($zscoreBbu, 2));
                }
            }

            if (!empty($tb) && is_numeric($tb) && !empty($caraUkur)) {
                $tbKoreksi = (float) $tb;
                if ($usia < 24 && $caraUkur === 'berdiri') $tbKoreksi += 0.7;
                if ($usia >= 24 && $caraUkur === 'terlentang') $tbKoreksi -= 0.7;

                if (method_exists(\App\Helpers\AntropometriHelper::class, 'hitungTbu')) {
                    $set('status_stunting', \App\Helpers\AntropometriHelper::hitungTbu($jk, $usia, $tbKoreksi));
                }
                if (method_exists(\App\Helpers\AntropometriHelper::class, 'hitungZScoreTBU')) {
                    $zscoreTbu = \App\Helpers\AntropometriHelper::hitungZScoreTBU($jk, $usia, $tbKoreksi);
                    $set('zscore_tbu', is_null($zscoreTbu) ? '0.00' : number_format($zscoreTbu, 2));
                }

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
        };

        return $form
            ->schema([
                Tabs::make('Zona Pelayanan Terintegrasi')
                    ->columnSpanFull()
                    ->tabs([
                        // 🟢 ZONA A: REGISTRASI & PRA-PEMERIKSAAN
                        Tabs\Tab::make('ZONA A (Registrasi & Lingkar Tubuh)')
                            ->icon('heroicon-o-user-plus')
                            ->schema([
                                Forms\Components\Grid::make(3)
                                    ->schema([
                                        Forms\Components\Select::make('pasien_id')
                                            ->relationship('pasien', 'nama')
                                            ->label('Nama Balita')
                                            ->searchable()
                                            ->preload()
                                            ->required()
                                            ->live() 
                                            ->afterStateUpdated(function(Forms\Set $set, Forms\Get $get) use ($hitungUmur, $kalkulasiStatusGizi) {
                                                $hitungUmur($set, $get);
                                                $kalkulasiStatusGizi($set, $get);
                                            })
                                            ->disabled(fn () => !in_array(Auth::user()?->meja_tugas, ['meja_1', 'superadmin']))
                                            ->dehydrated()
                                            ->createOptionForm([
                                                Forms\Components\Section::make('Identitas Umum')
                                                    ->schema([
                                                        Forms\Components\TextInput::make('nik')->label('NIK')->required()->numeric()->length(16)->unique('pasien', 'nik'),
                                                        Forms\Components\TextInput::make('no_kk')->label('Nomor KK')->numeric(),
                                                        Forms\Components\TextInput::make('nama')->label('Nama Lengkap')->required(),
                                                        Forms\Components\Select::make('jenis_kelamin')->options(['L' => 'Laki-laki', 'P' => 'Perempuan'])->required(),
                                                        Forms\Components\TextInput::make('tempat_lahir')->required(),
                                                        Forms\Components\DatePicker::make('tgl_lahir')->label('Tanggal Lahir')->required()->maxDate(now()),
                                                        Forms\Components\Textarea::make('alamat')->columnSpanFull(),
                                                    ])->columns(2),
                                            ]),

                                        Forms\Components\DatePicker::make('tgl_periksa')
                                            ->label('Tanggal Kunjungan')
                                            ->default(now())
                                            ->required()
                                            ->live() 
                                            ->afterStateUpdated(function(Forms\Set $set, Forms\Get $get) use ($hitungUmur, $kalkulasiStatusGizi) {
                                                $hitungUmur($set, $get);
                                                $kalkulasiStatusGizi($set, $get);
                                            })
                                            ->disabled(fn () => !in_array(Auth::user()?->meja_tugas, ['meja_1', 'superadmin']))
                                            ->dehydrated(),

                                        Forms\Components\TextInput::make('keterangan_umur')
                                            ->label('Usia Saat Diperiksa')
                                            ->disabled() 
                                            ->dehydrated() 
                                            ->required(),
                                            
                                        Forms\Components\Hidden::make('usia_bulan')->dehydrated(), 
                                    ]),

                                Forms\Components\Grid::make(2)
                                    ->schema([
                                        Forms\Components\TextInput::make('lingkar_kepala')
                                            ->label('Lingkar Kepala (Cm)')
                                            ->numeric()
                                            ->disabled(fn () => !in_array(Auth::user()?->meja_tugas, ['meja_1', 'superadmin']))
                                            ->dehydrated(),
                                        Forms\Components\TextInput::make('lila')
                                            ->label('Lingkar Lengan Atas / LiLA (Cm)')
                                            ->numeric()
                                            ->disabled(fn () => !in_array(Auth::user()?->meja_tugas, ['meja_1', 'superadmin']))
                                            ->dehydrated(),
                                    ]),
                            ]),

                        // 🟢 ZONA B: ANTROPOMETRI UTAMA & KBM KEMENKES
                        Tabs\Tab::make('ZONA B (Pengukuran & Penimbangan)')
                            ->icon('heroicon-o-scale')
                            ->schema([
                                Forms\Components\Grid::make(3)
                                    ->schema([
                                        Forms\Components\TextInput::make('tinggi_badan')
                                            ->label('Tinggi/Panjang Badan (Cm)')
                                            ->numeric()
                                            ->live(onBlur: true)
                                            ->afterStateUpdated($kalkulasiStatusGizi)
                                            ->disabled(fn () => !in_array(Auth::user()?->meja_tugas, ['meja_2', 'meja_4', 'superadmin']))
                                            ->dehydrated(),
                                            
                                        Forms\Components\Select::make('cara_ukur')
                                            ->label('Cara Ukur')
                                            ->options(['berdiri' => 'Berdiri', 'terlentang' => 'Terlentang'])
                                            ->live()
                                            ->afterStateUpdated($kalkulasiStatusGizi)
                                            ->disabled(fn () => !in_array(Auth::user()?->meja_tugas, ['meja_2', 'meja_4', 'superadmin']))
                                            ->dehydrated(),

                                        Forms\Components\TextInput::make('berat_badan')
                                            ->label('Berat Badan (Kg)')
                                            ->numeric()
                                            ->live(debounce: 500) 
                                            ->disabled(fn () => !in_array(Auth::user()?->meja_tugas, ['meja_2', 'meja_4', 'superadmin']))
                                            ->dehydrated()
                                            ->afterStateUpdated(function (?string $state, Get $get, Set $set, ?PemeriksaanBayi $record) use ($kalkulasiStatusGizi) {
                                                $kalkulasiStatusGizi($set, $get);
                                                $pasienId = $get('pasien_id'); 
                                                $bbSekarang = (float) $state;
                                                $usiaBulan = (int) $get('usia_bulan');

                                                if ($pasienId && $bbSekarang > 0) {
                                                    $pasien = \App\Models\Pasien::find($pasienId);
                                                    $jk = $pasien ? $pasien->jenis_kelamin : 'L';
                                                    $tglPeriksaHariIni = $get('tgl_periksa') ?? now()->toDateString();

                                                    $kbm = 0.2; 
                                                    if ($usiaBulan === 1) { $kbm = 0.8; }
                                                    elseif ($usiaBulan === 2) { $kbm = ($jk === 'L') ? 0.9 : 0.8; }
                                                    elseif ($usiaBulan === 3) { $kbm = ($jk === 'L') ? 0.8 : 0.6; }
                                                    elseif ($usiaBulan === 4) { $kbm = ($jk === 'L') ? 0.6 : 0.5; }
                                                    elseif ($usiaBulan === 5) { $kbm = ($jk === 'L') ? 0.5 : 0.4; }
                                                    elseif ($usiaBulan === 6) { $kbm = ($jk === 'L') ? 0.4 : 0.3; }
                                                    elseif ($usiaBulan >= 7 && $usiaBulan <= 11) { $kbm = 0.3; }

                                                    $queryLalu = \App\Models\PemeriksaanBayi::where('pasien_id', $pasienId)
                                                        ->whereDate('tgl_periksa', '<', \Carbon\Carbon::parse($tglPeriksaHariIni)->startOfMonth()->toDateString());

                                                    if ($record && $record->exists) {
                                                        $queryLalu->where('id', '!=', $record->id);
                                                    }
                                                    
                                                    $pemeriksaanLalu = $queryLalu->orderBy('tgl_periksa', 'desc')->first();

                                                    if ($pemeriksaanLalu && $pemeriksaanLalu->berat_badan) {
                                                        $bbLalu = (float) $pemeriksaanLalu->berat_badan;
                                                        $kenaikanRiil = $bbSekarang - $bbLalu;

                                                        if ($kenaikanRiil >= $kbm) {
                                                            $set('kenaikan_bb', 'naik'); 
                                                            $set('keterangan_bb', "N (Naik). Timbangan naik " . number_format($kenaikanRiil, 2) . " Kg (Memenuhi standar KBM Kemenkes usia {$usiaBulan} bulan sebesar {$kbm} Kg).");
                                                        } else {
                                                            $set('kenaikan_bb', 'not_naik'); 
                                                            if ($kenaikanRiil > 0) {
                                                                $set('keterangan_bb', "T (Tidak Naik). Timbangan hanya naik " . number_format($kenaikanRiil, 2) . " Kg (TIDAK LOLOS standar KBM Kemenkes usia {$usiaBulan} bulan sebesar {$kbm} Kg).");
                                                            } else {
                                                                $set('keterangan_bb', "T (Tidak Naik). Timbangan menyusut / tetap sebesar " . number_format($kenaikanRiil, 2) . " Kg dari bulan lalu.");
                                                            }
                                                        }
                                                    } else {
                                                        $adaRiwayatSamaSekali = \App\Models\PemeriksaanBayi::where('pasien_id', $pasienId)->exists();
                                                        if ($adaRiwayatSamaSekali) {
                                                            $set('kenaikan_bb', 'not_naik');
                                                            $set('keterangan_bb', "Bulan lalu tidak menimbang (Status: T).");
                                                        } else {
                                                            $set('kenaikan_bb', 'naik');
                                                            $set('keterangan_bb', "Bulan ini dihitung N (Naik) karena merupakan penimbangan pertama kali di sistem.");
                                                        }
                                                    }
                                                }
                                            }),
                                    ]),

                                Forms\Components\Grid::make(2)
                                    ->schema([
                                        Forms\Components\Select::make('kenaikan_bb')
                                            ->label('Status Kenaikan Berat Badan (N/T) Kemenkes')
                                            ->placeholder('Otomatis...')
                                            ->options([
                                                'naik' => 'N (Berat Badan Naik Sesuai KBM)',
                                                'not_naik' => 'T (Berat Badan Tidak Naik / Kurang Dari KBM)',
                                            ])
                                            ->disabled() 
                                            ->dehydrated(),

                                        Forms\Components\TextInput::make('keterangan_bb')
                                            ->label('Analisis Kenaikan Minimal (KMS)')
                                            ->placeholder('Otomatis...')
                                            ->readOnly()
                                            ->dehydrated(),
                                    ]),
                            ]),

                        // 🟢 ZONA C: VALIDASI AKHIR, Z-SCORE, & INTERVENSI MEDIS
                        Tabs\Tab::make('ZONA C (Evaluasi Medis & Intervensi)')
                            ->icon('heroicon-o-clipboard-document-check')
                            ->schema([
                                Forms\Components\Fieldset::make('Kesimpulan Gizi Anak (Murni Komputasi Sistem)')
                                    ->schema([
                                        Forms\Components\TextInput::make('status_gizi')->label('Status Gizi (BB/U)')->readOnly()->dehydrated(),
                                        Forms\Components\TextInput::make('zscore_bbu')->label('Z-Score (BB/U)')->readOnly()->dehydrated(),
                                        Forms\Components\TextInput::make('status_stunting')->label('Status Stunting (TB/U)')->readOnly()->dehydrated(),
                                        Forms\Components\TextInput::make('zscore_tbu')->label('Z-Score (TB/U)')->readOnly()->dehydrated(),
                                        Forms\Components\TextInput::make('status_bbtb')->label('Status (BB/TB)')->readOnly()->dehydrated(),
                                        Forms\Components\TextInput::make('zscore_bbtb')->label('Z-Score (BB/TB)')->readOnly()->dehydrated(),
                                    ])->columns(2),

                                Forms\Components\Grid::make(3)
                                    ->schema([
                                        Forms\Components\TextInput::make('rambu_gizi')->label('Rambu Gizi (N/T/O)')->placeholder('N')->disabled(fn () => !in_array(Auth::user()?->meja_tugas, ['meja_5', 'superadmin']))->dehydrated(),
                                        Forms\Components\TextInput::make('titik_pertumbuhan')->label('Titik Grafik (H/K/BGM)')->placeholder('H')->disabled(fn () => !in_array(Auth::user()?->meja_tugas, ['meja_5', 'superadmin']))->dehydrated(),
                                        Forms\Components\Select::make('pitting_edema')
                                            ->label('Pitting Edema Bilateral')
                                            ->options(['tidak ada' => 'Tidak Ada', 'derajat +1' => 'Derajat +1', 'derajat +2' => 'Derajat +2', 'derajat +3' => 'Derajat +3'])
                                            ->default('tidak ada')
                                            ->disabled(fn () => !in_array(Auth::user()?->meja_tugas, ['meja_5', 'superadmin']))
                                            ->dehydrated(),
                                    ]),
                                    
                                Forms\Components\Grid::make(4) 
                                    ->schema([
                                        Forms\Components\Toggle::make('vitamin_a')->label('Vit A?')->inline(false)->disabled(fn () => !in_array(Auth::user()?->meja_tugas, ['meja_5', 'superadmin']))->dehydrated(),
                                        Forms\Components\Toggle::make('obat_cacing')->label('Obat Cacing?')->inline(false)->disabled(fn () => !in_array(Auth::user()?->meja_tugas, ['meja_5', 'superadmin']))->dehydrated(),
                                        Forms\Components\Toggle::make('asi_eksklusif')->label('ASI Eksklusif?')->inline(false)->disabled(fn () => !in_array(Auth::user()?->meja_tugas, ['meja_5', 'superadmin']))->dehydrated(),
                                        Forms\Components\Toggle::make('pmba')->label('PMBA?')->inline(false)->disabled(fn () => !in_array(Auth::user()?->meja_tugas, ['meja_5', 'superadmin']))->dehydrated(),
                                        Forms\Components\Toggle::make('sdidtk')->label('SDIDTK?')->inline(false)->disabled(fn () => !in_array(Auth::user()?->meja_tugas, ['meja_5', 'superadmin']))->dehydrated(),
                                        Forms\Components\Toggle::make('kelas_ibu')->label('Ikut Kelas Ibu?')->inline(false)->disabled(fn () => !in_array(Auth::user()?->meja_tugas, ['meja_5', 'superadmin']))->dehydrated(),
                                        Forms\Components\Toggle::make('menerima_mbg')->label('Dapat MBG?')->inline(false)->disabled(fn () => !in_array(Auth::user()?->meja_tugas, ['meja_5', 'superadmin']))->dehydrated(),
                                    ]),
                                    
                                Forms\Components\Select::make('jenis_imunisasi')
                                    ->label('Jenis Imunisasi Hari Ini')
                                    ->multiple()
                                    ->searchable()
                                    ->disabled(fn () => !in_array(Auth::user()?->meja_tugas, ['meja_5', 'superadmin']))
                                    ->dehydrated()
                                    ->options([
                                        'HB0' => 'HB0 (0 Bulan)', 'BCG' => 'BCG (1 Bulan)', 'Polio 1' => 'Polio 1 (1 Bulan)',
                                        'DPT-HB-Hib 1' => 'DPT-HB-Hib 1 (2 Bulan)', 'Polio 2' => 'Polio 2 (2 Bulan)', 'PCV 1' => 'PCV 1 (2 Bulan)', 'Rotavirus 1' => 'Rotavirus 1 (2 Bulan)',
                                        'DPT-HB-Hib 2' => 'DPT-HB-Hib 2 (3 Bulan)', 'Polio 3' => 'Polio 3 (3 Bulan)', 'DPT-HB-Hib 3' => 'DPT-HB-Hib 3 (4 Bulan)',
                                        'Polio 4' => 'Polio 4 (4 Bulan)', 'IPV 1' => 'IPV 1 (4 Bulan)', 'Campak-MR 1' => 'Campak/MR 1 (9 Bulan)',
                                    ]),
                                    
                                Forms\Components\Textarea::make('catatan')
                                    ->label('Catatan / KIE (Konseling)')
                                    ->columnSpanFull()
                                    ->disabled(fn () => !in_array(Auth::user()?->meja_tugas, ['meja_5', 'superadmin']))
                                    ->dehydrated(),
                                    
                                Forms\Components\Grid::make(3)
                                    ->schema([
                                        Forms\Components\Toggle::make('deteksi_tbc')
                                            ->label('S. TBC (Deteksi)')
                                            ->disabled(fn () => !in_array(Auth::user()?->meja_tugas, ['meja_5', 'superadmin']))
                                            ->dehydrated()
                                            ->helperText(new \Illuminate\Support\HtmlString("<span class='text-xs text-rose-600 block mt-1'>⚠️ Aktifkan jika Batuk/Demam &ge; 2 minggu, BB 2T, atau lesu.</span>")),
                                        Forms\Components\Toggle::make('kie')->label('Sudah KIE/Konseling?')->disabled(fn () => !in_array(Auth::user()?->meja_tugas, ['meja_5', 'superadmin']))->dehydrated(),
                                        Forms\Components\Toggle::make('rujuk')->label('Rujuk Ke Puskesmas?')->disabled(fn () => !in_array(Auth::user()?->meja_tugas, ['meja_5', 'superadmin']))->dehydrated(),
                                    ]),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn ($query) => $query->with(['pasien'])) // Eager loading murni, hapus MAX(id) agar antrean berjalan berurutan
            ->columns([
                Tables\Columns\TextColumn::make('pasien.nama')->label('Nama Balita')->searchable(),
                Tables\Columns\TextColumn::make('keterangan_umur')->label('Usia')->badge()->color('success'),
                Tables\Columns\TextColumn::make('berat_badan')->label('Berat (Zona B)')->suffix(' Kg')->placeholder('⏳ Mengantre'),
                Tables\Columns\TextColumn::make('tinggi_badan')->label('Tinggi (Zona B)')->suffix(' Cm')->placeholder('⏳ Mengantre'),
                Tables\Columns\TextColumn::make('lila')->label('LiLA (Zona A)')->suffix(' Cm')->placeholder('-'),
                Tables\Columns\IconColumn::make('menerima_mbg')->label('MBG')->boolean(),
            ])
            ->poll('3s') // Layar berkedip otomatis setiap 3 detik mencari perpindahan data
            ->actions([
                // 🟢 1. AKSES ZONA B: TOMBOL POP-UP TIMBANG CEPAT
                Tables\Actions\Action::make('isi_zona_b')
                    ->label('Timbang (Zona B)')
                    ->icon('heroicon-o-scale')
                    ->color('success')
                    ->visible(fn () => in_array(Auth::user()?->meja_tugas, ['meja_2', 'meja_4', 'superadmin'])) 
                    ->form([
                        Forms\Components\TextInput::make('berat_badan')->label('Berat Badan (Kg)')->required()->numeric(),
                        Forms\Components\TextInput::make('tinggi_badan')->label('Tinggi Badan (Cm)')->required()->numeric(),
                        Forms\Components\Select::make('cara_ukur')->label('Cara Ukur')->options(['berdiri' => 'Berdiri', 'terlentang' => 'Terlentang'])->required(),
                    ])
                    ->action(function (PemeriksaanBayi $record, array $data) {
                        $pasien = $record->pasien;
                        $usia = $record->usia_bulan;
                        $jk = $pasien ? $pasien->jenis_kelamin : 'L';
                        
                        $tbKoreksi = (float) $data['tinggi_badan'];
                        if ($usia < 24 && $data['cara_ukur'] === 'berdiri') $tbKoreksi += 0.7;
                        if ($usia >= 24 && $data['cara_ukur'] === 'terlentang') $tbKoreksi -= 0.7;

                        $updateData = [
                            'berat_badan' => $data['berat_badan'],
                            'tinggi_badan' => $data['tinggi_badan'],
                            'cara_ukur' => $data['cara_ukur'],
                        ];

                        if (method_exists(\App\Helpers\AntropometriHelper::class, 'hitungBbu')) {
                            $updateData['status_gizi'] = \App\Helpers\AntropometriHelper::hitungBbu($jk, $usia, $data['berat_badan']);
                            $zscoreBbu = \App\Helpers\AntropometriHelper::hitungZScoreBBU($jk, $usia, $data['berat_badan']);
                            $updateData['zscore_bbu'] = is_null($zscoreBbu) ? 0.00 : number_format($zscoreBbu, 2);
                        }

                        if (method_exists(\App\Helpers\AntropometriHelper::class, 'hitungTbu')) {
                            $updateData['status_stunting'] = \App\Helpers\AntropometriHelper::hitungTbu($jk, $usia, $tbKoreksi);
                            $zscoreTbu = \App\Helpers\AntropometriHelper::hitungZScoreTBU($jk, $usia, $tbKoreksi);
                            $updateData['zscore_tbu'] = is_null($zscoreTbu) ? 0.00 : number_format($zscoreTbu, 2);
                        }

                        if (method_exists(\App\Helpers\AntropometriHelper::class, 'hitungBbtb')) {
                            $updateData['status_bbtb'] = \App\Helpers\AntropometriHelper::hitungBbtb($jk, $tbKoreksi, $data['berat_badan']);
                            $zscoreBbtb = \App\Helpers\AntropometriHelper::hitungZScoreBBTB($jk, $tbKoreksi, $data['berat_badan']);
                            $updateData['zscore_bbtb'] = is_null($zscoreBbtb) ? 0.00 : number_format($zscoreBbtb, 2);
                        }

                        $record->update($updateData);
                    }),

                // 🟢 2. TAMBAHAN AKSES ZONA C: TOMBOL POP-UP INTERVENSI MEDIS CEPAT (UNTUK BIDAN & SUPERADMIN)
                Tables\Actions\Action::make('isi_zona_c')
                    ->label('Evaluasi (Zona C)')
                    ->icon('heroicon-o-clipboard-document-check')
                    ->color('info')
                    ->visible(fn () => in_array(Auth::user()?->meja_tugas, ['meja_5', 'superadmin'])) 
                    ->form([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\Toggle::make('vitamin_a')->label('Berikan Vitamin A?')->inline(false),
                                Forms\Components\Toggle::make('obat_cacing')->label('Berikan Obat Cacing?')->inline(false),
                                Forms\Components\Toggle::make('asi_eksklusif')->label('ASI Eksklusif?')->inline(false),
                                Forms\Components\Toggle::make('pmba')->label('PMBA (Makanan Anak)?')->inline(false),
                            ]),

                        Forms\Components\Select::make('jenis_imunisasi')
                            ->label('Jenis Imunisasi Hari Ini')
                            ->multiple()
                            ->searchable()
                            ->placeholder('Pilih satu atau beberapa imunisasi...')
                            ->options([
                                'HB0' => 'HB0 (0 Bulan)',
                                'BCG' => 'BCG (1 Bulan)',
                                'Polio 1' => 'Polio 1 (1 Bulan)',
                                'DPT-HB-Hib 1' => 'DPT-HB-Hib 1 (2 Bulan)',
                                'Polio 2' => 'Polio 2 (2 Bulan)',
                                'PCV 1' => 'PCV 1 (2 Bulan)',
                                'Rotavirus 1' => 'Rotavirus 1 (2 Bulan)',
                                'DPT-HB-Hib 2' => 'DPT-HB-Hib 2 (3 Bulan)',
                                'Polio 3' => 'Polio 3 (3 Bulan)',
                                'DPT-HB-Hib 3' => 'DPT-HB-Hib 3 (4 Bulan)',
                                'Polio 4' => 'Polio 4 (4 Bulan)',
                                'IPV 1' => 'IPV 1 (4 Bulan)',
                                'Campak-MR 1' => 'Campak/MR 1 (9 Bulan)',
                            ]),

                        Forms\Components\Textarea::make('catatan')
                            ->label('Catatan Konseling / KIE')
                            ->placeholder('Contoh: Perkembangan normal, ingatkan ibu berikan protein hewani.')
                            ->required(),

                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\Toggle::make('deteksi_tbc')->label('Indikasi TBC?'),
                                Forms\Components\Toggle::make('kie')->label('Sudah KIE?')->default(true),
                                Forms\Components\Toggle::make('rujuk')->label('Rujuk ke Puskesmas?'),
                            ]),
                    ])
                    ->action(function (PemeriksaanBayi $record, array $data) {
                        $record->update([
                            'vitamin_a' => $data['vitamin_a'],
                            'obat_cacing' => $data['obat_cacing'],
                            'asi_eksklusif' => $data['asi_eksklusif'],
                            'pmba' => $data['pmba'],
                            'jenis_imunisasi' => $data['jenis_imunisasi'],
                            'catatan' => $data['catatan'],
                            'deteksi_tbc' => $data['deteksi_tbc'],
                            'kie' => $data['kie'],
                            'rujuk' => $data['rujuk'],
                        ]);
                    })
                    ->modalHeading('Form Evaluasi Akhir & Intervensi Medis')
                    ->modalWidth('3xl'),

                // 🟢 3. ACTION EDIT BAWAAN (DETAIL)
                Tables\Actions\EditAction::make()
                    ->label('Detail Form')
                    ->icon('heroicon-o-pencil-square')
                    ->visible(fn () => in_array(Auth::user()?->meja_tugas, ['meja_5', 'superadmin'])),
                ]);
    }

    public static function getPages(): array {
        return [
            'index' => Pages\ListPemeriksaanBayis::route('/'),
            'create' => Pages\CreatePemeriksaanBayi::route('/create'),
            'edit' => Pages\EditPemeriksaanBayi::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with(['pasien'])
            ->whereDate('tgl_periksa', \Carbon\Carbon::today()->toDateString());
    }

    public static function canCreate(): bool {
        return in_array(Auth::user()?->meja_tugas, ['meja_1', 'superadmin']);
    }

    public static function canAccess(): bool {
        return in_array('bayi', Auth::user()?->akses_menu ?? []) || Auth::user()?->meja_tugas === 'superadmin';
    }
}