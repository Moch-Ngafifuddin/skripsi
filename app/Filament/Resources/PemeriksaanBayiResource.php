<?php

namespace App\Filament\Resources;

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

class PemeriksaanBayiResource extends Resource
{
    protected static ?string $model = PemeriksaanBayi::class;
    
    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }
    
    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $navigationIcon = 'heroicon-o-face-smile'; 
    protected static ?string $navigationGroup = 'Pemeriksaan';
    protected static ?string $navigationLabel = 'Posyandu Balita';
    protected static ?string $pluralModelLabel = 'Posyandu Balita';

    public static function form(Form $form): Form
    {
        // --- FUNGSI AUTO-FILL UMUR KE DATABASE ---
        $hitungUmur = function (Forms\Set $set, Forms\Get $get) {
            $pasienId = $get('pasien_id');
            $tglPeriksa = $get('tgl_periksa');
            
            if (!$pasienId || !$tglPeriksa) {
                $set('keterangan_umur', null);
                return;
            }
            
            $pasien = Pasien::find($pasienId);
            if (!$pasien || !$pasien->tgl_lahir) return;
            
            $lahir = Carbon::parse($pasien->tgl_lahir);
            $periksa = Carbon::parse($tglPeriksa);
            
            $hari = (int) $lahir->diffInDays($periksa);
            $bulan = (int) $lahir->diffInMonths($periksa);
            $tahun = (int) $lahir->diffInYears($periksa);
            
            if ($tahun >= 1) {
                $sisaBulan = $bulan % 12;
                $set('keterangan_umur', $sisaBulan > 0 ? "{$tahun} Thn {$sisaBulan} Bln" : "{$tahun} Thn");
            } elseif ($bulan >= 1) {
                $set('keterangan_umur', "{$bulan} Bulan");
            } else {
                $set('keterangan_umur', "{$hari} Hari");
            }
        };

        return $form
            ->schema([
                // --- MEJA 1: Pendaftaran Balita Baru ---
                Forms\Components\Section::make('Data Pendaftaran Balita Baru (Meja 1)')
                    ->schema([
                        Forms\Components\Select::make('pasien_id')
                            ->relationship('pasien', 'nama')
                            ->label('Nama Balita')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->live() 
                            ->afterStateUpdated($hitungUmur)
                            ->disabled(fn () => !in_array(Auth::user()?->meja_tugas, ['meja_1', 'superadmin']))
                            ->createOptionForm([
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
                                Forms\Components\Section::make('Data Khusus Balita (Buku KIA)')
                                    ->schema([
                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\TextInput::make('nama_ayah')->label('Nama Ayah'),
                                                Forms\Components\TextInput::make('nik_ayah')->label('NIK Ayah')->numeric()->length(16),
                                                Forms\Components\TextInput::make('nama_ibu')->label('Nama Ibu'),
                                                Forms\Components\TextInput::make('nik_ibu')->label('NIK Ibu')->numeric()->length(16),
                                            ]),
                                        Forms\Components\Grid::make(4)
                                            ->schema([
                                                Forms\Components\TextInput::make('anak_ke')->label('Anak Ke-')->numeric(),
                                                Forms\Components\TextInput::make('berat_lahir')->label('BB Lahir (Gram)')->numeric(),
                                                Forms\Components\TextInput::make('panjang_lahir')->label('PB Lahir (Cm)')->numeric(),
                                                Forms\Components\Checkbox::make('imd')->label('IMD'),
                                            ]),
                                        Forms\Components\Radio::make('riwayat_asi')
                                            ->label('Riwayat ASI Eksklusif')->options(['E1'=>'E1','E2'=>'E2','E3'=>'E3','E4'=>'E4','E5'=>'E5','E6'=>'E6'])->inline()->columnSpanFull(),
                                    ]),
                                Forms\Components\Section::make('Kontak (Opsional)')
                                    ->schema([
                                        Forms\Components\TextInput::make('nama_wali')->label('Nama Wali'),
                                        Forms\Components\TextInput::make('no_hp')->label('No HP / WhatsApp')->tel(),
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
                            ->afterStateUpdated($hitungUmur)
                            ->disabled(fn () => !in_array(Auth::user()?->meja_tugas, ['meja_1', 'superadmin'])),

                        Forms\Components\TextInput::make('keterangan_umur')
                            ->label('Usia Saat Diperiksa')
                            ->disabled() 
                            ->dehydrated() 
                            ->required(),
                    ])->columns(3),

                // --- MEJA 2: TINGGI BADAN & CARA UKUR ---
                Forms\Components\Section::make('Data Pengukuran (Meja 2)')
                    ->visible(fn () => in_array(Auth::user()?->meja_tugas, ['meja_2', 'meja_5', 'superadmin'])) 
                    ->schema([
                        Forms\Components\TextInput::make('tinggi_badan')
                            ->label('Tinggi/Panjang Badan (Cm)')
                            ->numeric(),
                        // 🟢 TAMBAHAN: Kolom Cara Ukur Kemenkes
                        Forms\Components\Select::make('cara_ukur')
                            ->label('Cara Ukur')
                            ->options([
                                'berdiri' => 'Berdiri',
                                'terlentang' => 'Terlentang',
                            ]),
                    ])->columns(2),

                // --- MEJA 3: LINGKAR KEPALA & LILA ---
                Forms\Components\Section::make('Data Pengukuran Tambahan (Meja 3)')
                    ->visible(fn () => in_array(Auth::user()?->meja_tugas, ['meja_3', 'meja_5', 'superadmin']))
                    ->schema([
                        Forms\Components\TextInput::make('lingkar_kepala')
                            ->label('Lingkar Kepala (Cm)')
                            ->numeric(),
                        // 🟢 PENYESUAIAN: Memakai kolom 'lila' standar database baru
                        Forms\Components\TextInput::make('lila')
                            ->label('Lingkar Lengan Atas / LiLA (Cm)')
                            ->numeric(),
                    ])->columns(2),

                // --- MEJA 4: BERAT BADAN ---
                Forms\Components\Section::make('Data Penimbangan (Meja 4)')
                    ->visible(fn () => in_array(Auth::user()?->meja_tugas, ['meja_4', 'meja_5', 'superadmin']))
                    ->schema([
                        Forms\Components\TextInput::make('berat_badan')
                            ->label('Berat Badan (Kg)')
                            ->numeric(),
                    ]),

                // --- MEJA 5: PELAYANAN & EVALUASI AKHIR ---
                Forms\Components\Section::make('Pelayanan, Catatan & Hasil (Meja 5)')
                    ->description('Hanya diisi oleh petugas Meja 5 setelah melihat data Meja 1-4')
                    ->visible(fn () => in_array(Auth::user()?->meja_tugas, ['meja_5', 'superadmin']))
                    ->schema([
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('rambu_gizi')
                                    ->label('Rambu Gizi (N/T/O)')
                                    ->placeholder('N'),
                                Forms\Components\TextInput::make('titik_pertumbuhan')
                                    ->label('Titik Grafik (H/K/BGM)')
                                    ->placeholder('H'),
                                // 🟢 TAMBAHAN: Kolom Pitting Edema Bilateral
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
                                // 🟢 TAMBAHAN: Toggle Kelas Ibu dan Penerima MBG
                                Forms\Components\Toggle::make('kelas_ibu')->label('Ikut Kelas Ibu?')->inline(false),
                                Forms\Components\Toggle::make('menerima_mbg')->label('Dapat MBG?')->inline(false),
                            ]),
                            
                        Forms\Components\TextInput::make('jenis_imunisasi')
                            ->label('Jenis Imunisasi (Jika Ada)'),
                            
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
            ->modifyQueryUsing(fn ($query) => $query->with('pasien'))
            ->columns([
                Tables\Columns\TextColumn::make('pasien.nama')
                    ->label('Nama Balita')
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('keterangan_umur')
                    ->label('Usia')
                    ->badge() 
                    ->color('success'),

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
                        if ($data['value'] === 'sangat_kurang') {
                            $query->where('status_gizi', 'Berat Badan Sangat Kurang');
                        } elseif ($data['value'] === 'kurang') {
                            $query->where('status_gizi', 'Berat Badan Kurang');
                        } elseif ($data['value'] === 'normal') {
                            $query->where('status_gizi', 'Berat Badan Normal');
                        } elseif ($data['value'] === 'lebih') {
                            $query->where('status_gizi', 'Risiko Berat Badan Lebih');
                        }
                    }),
    
                Tables\Filters\SelectFilter::make('status_stunting')
                    ->label('Status Stunting')
                    ->options([
                        'stunting' => 'Stunting (Pendek / Sangat Pendek)',
                        'normal' => 'Normal',
                    ])
                    ->query(function ($query, array $data) {
                        if ($data['value'] === 'stunting') {
                            $query->whereIn('status_stunting', ['Sangat Pendek (Severely Stunted)', 'Pendek (Stunted)']);
                        } elseif ($data['value'] === 'normal') {
                            $query->where('status_stunting', 'Normal');
                        }
                    }),
            ]) 
            ->actions([
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
                        $record->update([
                            'tinggi_badan' => $data['tinggi_badan'],
                            'cara_ukur' => $data['cara_ukur'],
                        ]);
                    }),

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

                Tables\Actions\Action::make('isi_bb')
                    ->label('Isi BB')
                    ->icon('heroicon-o-scale')
                    ->color('success')
                    ->visible(fn () => in_array(Auth::user()?->meja_tugas, ['meja_4', 'superadmin'])) 
                    ->form([
                        Forms\Components\TextInput::make('berat_badan')->label('Berat Badan (Kg)')->required()->numeric(),
                    ])
                    ->action(function (PemeriksaanBayi $record, array $data) {
                        $record->update(['berat_badan' => $data['berat_badan']]);
                    }),

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