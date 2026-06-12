<?php

namespace App\Filament\Resources;
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
use Filament\Tables\Filters\SelectFilter;
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
        // ⚙️ 1. FUNGSI AUTO-FILL UMUR & USIA BULAN KE DATABASE
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
            
            $set('usia_bulan', max(0, $bulan)); // 🟢 Penting untuk Z-Score
            
            if ($tahun >= 1) {
                $sisaBulan = $bulan % 12;
                $set('keterangan_umur', $sisaBulan > 0 ? "{$tahun} Thn {$sisaBulan} Bln" : "{$tahun} Thn");
            } elseif ($bulan >= 1) {
                $set('keterangan_umur', "{$bulan} Bulan");
            } else {
                $set('keterangan_umur', "{$hari} Hari");
            }
        };

        // ⚙️ 2. FUNGSI KALKULASI Z-SCORE REAL-TIME
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

            // BB/U
            if (!empty($bb) && is_numeric($bb)) {
                if (method_exists(\App\Helpers\AntropometriHelper::class, 'hitungBbu')) {
                    $set('status_gizi', \App\Helpers\AntropometriHelper::hitungBbu($jk, $usia, $bb));
                }
                if (method_exists(\App\Helpers\AntropometriHelper::class, 'hitungZScoreBBU')) {
                    $zscoreBbu = \App\Helpers\AntropometriHelper::hitungZScoreBBU($jk, $usia, $bb);
                    $set('zscore_bbu', is_null($zscoreBbu) ? '0.00' : number_format($zscoreBbu, 2));
                }
            }

            // TB/U & BB/TB
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
                // --- MEJA 1: Pendaftaran Kunjungan ---
                Forms\Components\Section::make('Data Kunjungan Balita (Meja 1)')
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
                            ->createOptionForm([
                                // Form Ringkas untuk membuat Pasien Baru secara mendadak di meja pelayanan
                                Forms\Components\Section::make('Identitas Umum')
                                    ->schema([
                                        Forms\Components\TextInput::make('nik')->label('NIK')->required()->numeric()->length(16)->unique('pasiens', 'nik'),
                                        Forms\Components\TextInput::make('no_kk')->label('Nomor KK')->numeric(),
                                        Forms\Components\TextInput::make('nama')->label('Nama Lengkap')->required(),
                                        Forms\Components\Select::make('jenis_kelamin')->options(['L' => 'Laki-laki', 'P' => 'Perempuan'])->required(),
                                        Forms\Components\TextInput::make('tempat_lahir')->required(),
                                        Forms\Components\DatePicker::make('tgl_lahir')->label('Tanggal Lahir')->required()->maxDate(now()),
                                        Forms\Components\Textarea::make('alamat')->columnSpanFull(),
                                    ])->columns(2),
                            ])
                            ->createOptionAction(function (\Filament\Forms\Components\Actions\Action $action) {
                                return $action->modalHeading('Buat Data Balita Baru')->modalWidth('4xl');
                            }),

                        Forms\Components\DatePicker::make('tgl_periksa')
                            ->label('Tanggal Kunjungan')
                            ->default(now())
                            ->required()
                            ->live() 
                            ->afterStateUpdated(function(Forms\Set $set, Forms\Get $get) use ($hitungUmur, $kalkulasiStatusGizi) {
                                $hitungUmur($set, $get);
                                $kalkulasiStatusGizi($set, $get);
                            })
                            ->disabled(fn () => !in_array(Auth::user()?->meja_tugas, ['meja_1', 'superadmin'])),

                        Forms\Components\TextInput::make('keterangan_umur')
                            ->label('Usia Saat Diperiksa')
                            ->disabled() 
                            ->dehydrated() 
                            ->required(),
                            
                        Forms\Components\Hidden::make('usia_bulan'), // Menyimpan angka absolut bulan
                    ])->columns(3),

                // --- MEJA 2: TINGGI BADAN & CARA UKUR ---
                Forms\Components\Section::make('Data Pengukuran (Meja 2)')
                    ->visible(fn () => in_array(Auth::user()?->meja_tugas, ['meja_2', 'meja_5', 'superadmin'])) 
                    ->schema([
                        Forms\Components\TextInput::make('tinggi_badan')
                            ->label('Tinggi/Panjang Badan (Cm)')
                            ->numeric()
                            ->live(onBlur: true)
                            ->afterStateUpdated($kalkulasiStatusGizi),
                            
                        Forms\Components\Select::make('cara_ukur')
                            ->label('Cara Ukur')
                            ->options(['berdiri' => 'Berdiri', 'terlentang' => 'Terlentang'])
                            ->live()
                            ->afterStateUpdated($kalkulasiStatusGizi),
                    ])->columns(2),

                // --- MEJA 3: LINGKAR KEPALA & LILA ---
                Forms\Components\Section::make('Data Pengukuran Tambahan (Meja 3)')
                    ->visible(fn () => in_array(Auth::user()?->meja_tugas, ['meja_3', 'meja_5', 'superadmin']))
                    ->schema([
                        Forms\Components\TextInput::make('lingkar_kepala')->label('Lingkar Kepala (Cm)')->numeric(),
                        Forms\Components\TextInput::make('lila')->label('Lingkar Lengan Atas / LiLA (Cm)')->numeric(),
                    ])->columns(2),

                // --- MEJA 4: BERAT BADAN ---
                Forms\Components\Section::make('Data Penimbangan (Meja 4)')
                    ->visible(fn () => in_array(Auth::user()?->meja_tugas, ['meja_4', 'meja_5', 'superadmin']))
                    // ->schema([
                    //     Forms\Components\TextInput::make('berat_badan')
                    //         ->label('Berat Badan (Kg)')
                    //         ->numeric()
                    //         ->live(onBlur: true)
                    //         ->afterStateUpdated($kalkulasiStatusGizi),
                    // ]),
                    ->schema(
                        TextInput::make('berat_badan')
                        ->label('Berat Badan (Kg)')
                        ->numeric()
                        ->required()
                        ->live(onBlur: true) // 🟢 Memicu perhitungan otomatis begitu kader selesai mengetik angka
                        ->afterStateUpdated(function (?string $state, Get $get, Set $set) {
                            $pasienId = $get('pasien_id'); // Mengambil ID bayi yang sedang diperiksa
                            $bbSekarang = (float) $state;

                            if ($pasienId && $bbSekarang > 0) {
                                // Ambil data pemeriksaan terakhir (bulan lalu) secara instan (Anti N+1)
                                $pemeriksaanLalu = \App\Models\PemeriksaanBayi::where('pasien_id', $pasienId)
                                    ->orderBy('tgl_periksa', 'desc')
                                    ->first();

                                if ($pemeriksaanLalu && $pemeriksaanLalu->berat_badan) {
                                    $bbLalu = (float) $pemeriksaanLalu->berat_badan;
                                    
                                    // Logika Kemenkes Sederhana: Jika berat badan sekarang lebih besar dari bulan lalu, maka Naik (N)
                                    if ($bbSekarang > $bbLalu) {
                                        $set('kenaikan_bb', 'naik'); // Otomatis memilih opsi 'naik' (N)
                                        $set('keterangan_bb', "Berat badan naik " . ($bbSekarang - $bbLalu) . " Kg dari bulan lalu.");
                                    } else {
                                        $set('kenaikan_bb', 'tidak naik'); // Otomatis memilih opsi 'tidak naik' (T)
                                        $set('keterangan_bb', "Berat badan tidak naik / turun dari bulan lalu.");
                                    }
                                } else {
                                    // Jika ini adalah penimbangan pertama kali (bayi baru terdaftar)
                                    $set('kenaikan_bb', 'naik');
                                    $set('keterangan_bb', "Penimbangan pertama kali (Baru terdaftar).");
                                }
                            }
                        }),

                    // 2. Komponen Status Kenaikan BB yang akan terisi otomatis
                    Select::make('kenaikan_bb')
                        ->label('Status Kenaikan Berat Badan (N/T)')
                        ->options([
                            'naik' => 'N (Berat Badan Naik)',
                            'tidak naik' => 'T (Berat Badan Tidak Naik / Tetap / Turun)',
                        ])
                        ->required(),

                    TextInput::make('keterangan_bb')
                        ->label('Keterangan Detil Grafik KMS')
                        ->placeholder('Akan terisi otomatis oleh sistem...')
                        ->readOnly(),
                    )

                // --- MEJA 5: PELAYANAN & EVALUASI AKHIR ---
                Forms\Components\Section::make('Pelayanan, Catatan & Hasil (Meja 5)')
                    ->description('Hasil Z-Score otomatis terisi jika data Meja 1-4 lengkap.')
                    ->visible(fn () => in_array(Auth::user()?->meja_tugas, ['meja_5', 'superadmin']))
                    ->schema([
                        // 🟢 TAMPILAN READONLY HASIL Z-SCORE KEMENKES
                        Forms\Components\Fieldset::make('Kesimpulan Gizi Anak')
                            ->schema([
                                Forms\Components\TextInput::make('status_gizi')->label('Status Gizi (BB/U)')->readOnly(),
                                Forms\Components\TextInput::make('zscore_bbu')->label('Z-Score (BB/U)')->readOnly(),
                                Forms\Components\TextInput::make('status_stunting')->label('Status Stunting (TB/U)')->readOnly(),
                                Forms\Components\TextInput::make('zscore_tbu')->label('Z-Score (TB/U)')->readOnly(),
                                Forms\Components\TextInput::make('status_bbtb')->label('Status (BB/TB)')->readOnly(),
                                Forms\Components\TextInput::make('zscore_bbtb')->label('Z-Score (BB/TB)')->readOnly(),
                            ])->columns(2),

                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('rambu_gizi')->label('Rambu Gizi (N/T/O)')->placeholder('N'),
                                Forms\Components\TextInput::make('titik_pertumbuhan')->label('Titik Grafik (H/K/BGM)')->placeholder('H'),
                                Forms\Components\Select::make('pitting_edema')
                                    ->label('Pitting Edema Bilateral')
                                    ->options([
                                        'tidak ada' => 'Tidak Ada',
                                        'derajat +1' => 'Derajat +1',
                                        'derajat +2' => 'Derajat +2',
                                        'derajat +3' => 'Derajat +3',
                                    ])
                                    ->default('tidak ada'),
                            ]),
                            
                        // --- TOGGLE INTERVENSI & GIZI ---
                        Forms\Components\Grid::make(4) 
                            ->schema([
                                Forms\Components\Toggle::make('vitamin_a')->label('Vit A?')->inline(false),
                                Forms\Components\Toggle::make('obat_cacing')->label('Obat Cacing?')->inline(false),
                                Forms\Components\Toggle::make('asi_eksklusif')->label('ASI Eksklusif?')->inline(false),
                                Forms\Components\Toggle::make('pmba')->label('PMBA?')->inline(false),
                                Forms\Components\Toggle::make('sdidtk')->label('SDIDTK?')->inline(false),
                                Forms\Components\Toggle::make('kelas_ibu')->label('Ikut Kelas Ibu?')->inline(false),
                                Forms\Components\Toggle::make('menerima_mbg')->label('Dapat MBG?')->inline(false),
                            ]),
                            
                        
                        Select::make('jenis_imunisasi')
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
                                'DPT-HB-Hib Lanjutan' => 'DPT-HB-Hib Lanjutan (18 Bulan)',
                                'Campak-MR Lanjutan' => 'Campak/MR Lanjutan (18 Bulan)',
                            ]),
                            
                        Forms\Components\Textarea::make('catatan')
                            ->label('Catatan / KIE (Konseling)')
                            ->placeholder('Anak sehat, lanjutkan ASI eksklusif / Catatan intervensi...')
                            ->columnSpanFull(),
                            
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\Toggle::make('deteksi_tbc')->label('S. TBC (Deteksi)'),
                                Forms\Components\Toggle::make('kie')->label('Sudah KIE/Konseling?'),
                                Forms\Components\Toggle::make('rujuk')->label('Rujuk Ke Puskesmas?'),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
                ->modifyQueryUsing(fn ($query) => $query
                ->with(['pasien'])
                ->whereIn('pemeriksaan_bayi.id', function ($subQuery) {
                    $subQuery->selectRaw('MAX(id)')
                        ->from('pemeriksaan_bayi')
                        ->groupBy('pasien_id');
                })
                )
            ->columns([
                Tables\Columns\TextColumn::make('pasien.nama')->label('Nama Balita')->searchable(),
                Tables\Columns\TextColumn::make('keterangan_umur')->label('Usia')->badge()->color('success'),
                Tables\Columns\TextColumn::make('berat_badan')->label('Berat')->suffix(' Kg')->placeholder('-'),
                Tables\Columns\TextColumn::make('tinggi_badan')->label('Tinggi')->suffix(' Cm')->placeholder('-'),
                Tables\Columns\TextColumn::make('lila')->label('LiLA')->suffix(' Cm')->placeholder('-'),
                Tables\Columns\IconColumn::make('kelas_ibu')->label('Kls Ibu')->boolean(),
                Tables\Columns\IconColumn::make('menerima_mbg')->label('MBG')->boolean(),
            ])
            ->poll('3s')
            ->filters([
                Tables\Filters\SelectFilter::make('status_gizi')
                    ->label('Status Gizi')
                    ->options([
                        'sangat_kurang' => 'Berat Badan Sangat Kurang',
                        'kurang' => 'Berat Badan Kurang',
                        'normal' => 'Berat Badan Normal',
                        'lebih' => 'Risiko Berat Badan Lebih',
                    ])
                    ->query(function ($query, array $data) {
                        if ($data['value'] === 'sangat_kurang') $query->where('status_gizi', 'Berat Badan Sangat Kurang');
                        elseif ($data['value'] === 'kurang') $query->where('status_gizi', 'Berat Badan Kurang');
                        elseif ($data['value'] === 'normal') $query->where('status_gizi', 'Berat Badan Normal');
                        elseif ($data['value'] === 'lebih') $query->where('status_gizi', 'Risiko Berat Badan Lebih');
                    }),
    
                Tables\Filters\SelectFilter::make('status_stunting')
                    ->label('Status Stunting')
                    ->options([
                        'stunting' => 'Stunting (Pendek / Sangat Pendek)',
                        'normal' => 'Normal',
                    ])
                    ->query(function ($query, array $data) {
                        if ($data['value'] === 'stunting') $query->whereIn('status_stunting', ['Sangat Pendek (Severely Stunted)', 'Pendek (Stunted)']);
                        elseif ($data['value'] === 'normal') $query->where('status_stunting', 'Normal');
                    }),
                    Filter::make('tgl_periksa_range')
                    ->label('Periode Pemeriksaan')
                    ->form([
                        Select::make('quick_period')
                            ->label('Pilihan Periode Cepat')
                            ->options([
                                'this_week' => 'Minggu Ini',
                                'this_month' => 'Bulan Ini',
                                'this_year' => 'Tahun Ini',
                            ],)->reactive()
                            ->afterStateUpdated(function ($state, $set) {
                                // Jika kader memilih opsi cepat, otomatis isi range tanggal di bawahnya
                                if ($state === 'this_week') {
                                    $set('dari_tanggal', Carbon::now()->startOfWeek()->format('Y-m-d'));
                                    $set('sampai_tanggal', Carbon::now()->endOfWeek()->format('Y-m-d'));
                                } elseif ($state === 'this_month') {
                                    $set('dari_tanggal', Carbon::now()->startOfMonth()->format('Y-m-d'));
                                    $set('sampai_tanggal', Carbon::now()->endOfMonth()->format('Y-m-d'));
                                } elseif ($state === 'this_year') {
                                    $set('dari_tanggal', Carbon::now()->startOfYear()->format('Y-m-d'));
                                    $set('sampai_tanggal', Carbon::now()->endOfYear()->format('Y-m-d'));
                                }
                            }),
                        DatePicker::make('dari_tanggal')
                            ->label('Dari Tanggal'),
                        DatePicker::make('sampai_tanggal')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['dari_tanggal'],
                                fn (Builder $query, $date): Builder => $query->whereDate('tgl_periksa', '>=', $date),
                            )
                            ->when(
                                $data['sampai_tanggal'],
                                fn (Builder $query, $date): Builder => $query->whereDate('tgl_periksa', '<=', $date),
                            );
                    }),
            ]) 
            ->actions([
                // 🟢 TOMBOL AKSI CEPAT MEJA 2 (DENGAN INJEKSI Z-SCORE)
                Tables\Actions\Action::make('isi_tb')
                    ->label('Isi TB')
                    ->icon('heroicon-o-arrows-up-down')
                    ->color('info')
                    ->visible(fn () => in_array(Auth::user()?->meja_tugas, ['meja_2', 'superadmin'])) 
                    ->form([
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
                            'tinggi_badan' => $data['tinggi_badan'],
                            'cara_ukur' => $data['cara_ukur'],
                        ];

                        if (method_exists(\App\Helpers\AntropometriHelper::class, 'hitungTbu')) {
                            $updateData['status_stunting'] = \App\Helpers\AntropometriHelper::hitungTbu($jk, $usia, $tbKoreksi);
                        }
                        if (method_exists(\App\Helpers\AntropometriHelper::class, 'hitungZScoreTBU')) {
                            $zscoreTbu = \App\Helpers\AntropometriHelper::hitungZScoreTBU($jk, $usia, $tbKoreksi);
                            $updateData['zscore_tbu'] = is_null($zscoreTbu) ? 0.00 : number_format($zscoreTbu, 2);
                        }
                        if (!empty($record->berat_badan) && method_exists(\App\Helpers\AntropometriHelper::class, 'hitungBbtb')) {
                            $updateData['status_bbtb'] = \App\Helpers\AntropometriHelper::hitungBbtb($jk, $tbKoreksi, $record->berat_badan);
                            $zscoreBbtb = \App\Helpers\AntropometriHelper::hitungZScoreBBTB($jk, $tbKoreksi, $record->berat_badan);
                            $updateData['zscore_bbtb'] = is_null($zscoreBbtb) ? 0.00 : number_format($zscoreBbtb, 2);
                        }

                        $record->update($updateData);
                    }),

                // 🟢 TOMBOL AKSI CEPAT MEJA 3
                Tables\Actions\Action::make('isi_lk')
                    ->label('Isi LK & LiLA')
                    ->icon('heroicon-o-sparkles')
                    ->color('warning')
                    ->visible(fn () => in_array(Auth::user()?->meja_tugas, ['meja_3', 'superadmin'])) 
                    ->form([
                        Forms\Components\TextInput::make('lingkar_kepala')->label('Lingkar Kepala (Cm)')->required()->numeric(),
                        Forms\Components\TextInput::make('lila')->label('LiLA (Cm)')->required()->numeric(),
                    ])
                    ->action(function (PemeriksaanBayi $record, array $data) {
                        $record->update([
                            'lingkar_kepala' => $data['lingkar_kepala'],
                            'lila' => $data['lila'],
                        ]);
                    }),

                // 🟢 TOMBOL AKSI CEPAT MEJA 4 (DENGAN INJEKSI Z-SCORE)
                Tables\Actions\Action::make('isi_bb')
                    ->label('Isi BB')
                    ->icon('heroicon-o-scale')
                    ->color('success')
                    ->visible(fn () => in_array(Auth::user()?->meja_tugas, ['meja_4', 'superadmin'])) 
                    ->form([
                        Forms\Components\TextInput::make('berat_badan')->label('Berat Badan (Kg)')->required()->numeric(),
                    ])
                    ->action(function (PemeriksaanBayi $record, array $data) {
                        $pasien = $record->pasien;
                        $usia = $record->usia_bulan;
                        $jk = $pasien ? $pasien->jenis_kelamin : 'L';

                        $updateData = ['berat_badan' => $data['berat_badan']];

                        if (method_exists(\App\Helpers\AntropometriHelper::class, 'hitungBbu')) {
                            $updateData['status_gizi'] = \App\Helpers\AntropometriHelper::hitungBbu($jk, $usia, $data['berat_badan']);
                        }
                        if (method_exists(\App\Helpers\AntropometriHelper::class, 'hitungZScoreBBU')) {
                            $zscoreBbu = \App\Helpers\AntropometriHelper::hitungZScoreBBU($jk, $usia, $data['berat_badan']);
                            $updateData['zscore_bbu'] = is_null($zscoreBbu) ? 0.00 : number_format($zscoreBbu, 2);
                        }

                        if (!empty($record->tinggi_badan) && !empty($record->cara_ukur) && method_exists(\App\Helpers\AntropometriHelper::class, 'hitungBbtb')) {
                            $tbKoreksi = (float) $record->tinggi_badan;
                            if ($usia < 24 && $record->cara_ukur === 'berdiri') $tbKoreksi += 0.7;
                            if ($usia >= 24 && $record->cara_ukur === 'terlentang') $tbKoreksi -= 0.7;

                            $updateData['status_bbtb'] = \App\Helpers\AntropometriHelper::hitungBbtb($jk, $tbKoreksi, $data['berat_badan']);
                            $zscoreBbtb = \App\Helpers\AntropometriHelper::hitungZScoreBBTB($jk, $tbKoreksi, $data['berat_badan']);
                            $updateData['zscore_bbtb'] = is_null($zscoreBbtb) ? 0.00 : number_format($zscoreBbtb, 2);
                        }

                        $record->update($updateData);
                    }),

                   

                    Toggle::make('deteksi_tbc')
                        ->label('Indikasi / Gejala TBC Anak')
                        ->default(false)
                        ->inline(false)
                        // 🟢 Menyuntikkan panduan edukasi Kemenkes langsung ke layar form kader
                        ->helperText(new \Illuminate\Support\HtmlString("
                            <span class='text-xs text-rose-600 font-medium block mt-1'>
                                ⚠️ Aktifkan sakelar ini jika balita memenuhi salah satu gejala klinis berikut:<br>
                                1. Batuk terus-menerus selama &ge; 2 minggu.<br>
                                2. Demam &ge; 2 minggu tanpa penyebab yang jelas.<br>
                                3. Berat badan turun atau tidak naik dalam 2 bulan berturut-turut (2T).<br>
                                4. Anak tampak lesu, letih, dan tidak seaktif biasanya.
                            </span>
                        ")),

                Tables\Actions\EditAction::make()
                    ->label(fn () => Auth::user()?->meja_tugas === 'meja_5' ? 'Evaluasi (Meja 5)' : 'Ubah')
                    ->icon(fn () => Auth::user()?->meja_tugas === 'meja_5' ? 'heroicon-o-clipboard-document-check' : 'heroicon-o-pencil')
                    ->visible(fn () => in_array(Auth::user()?->meja_tugas, ['meja_5', 'superadmin'])),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPemeriksaanBayis::route('/'),
            'create' => Pages\CreatePemeriksaanBayi::route('/create'),
            'edit' => Pages\EditPemeriksaanBayi::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        // Menggunakan ::with(['pasien']) memaksa Laravel menggunakan Eager Loading.
        // Hanya akan terjadi 2 Query SQL ke database berapapun baris data yang difilter!
        return parent::getEloquentQuery()->with(['pasien']);
    }

    public static function canCreate(): bool
    {
        return in_array(Auth::user()?->meja_tugas, ['meja_1', 'superadmin']);
    }

    public static function canAccess(): bool
    {
        $akses = Auth::user()?->akses_menu ?? [];
        return in_array('bayi', $akses) || Auth::user()?->meja_tugas === 'superadmin';
    }
}