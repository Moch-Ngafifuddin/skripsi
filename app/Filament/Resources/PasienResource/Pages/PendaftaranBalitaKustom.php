<?php

namespace App\Filament\Resources\PasienResource\Pages;

use App\Filament\Resources\PasienResource;
use App\Models\Pasien;
use App\Models\PemeriksaanBayi;
use App\Helpers\AntropometriHelper;
use Filament\Resources\Pages\Page;
use Filament\Forms\Form;
use Filament\Forms;
use Filament\Forms\Get;
use Filament\Notifications\Notification;
use Carbon\Carbon;

class PendaftaranBalitaKustom extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static string $resource = PasienResource::class;
    protected static string $view = 'filament.pages.pendaftaran-balita-kustom-layout';
    
    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'tipe_pendaftaran_posyandu' => 'baru_lahir',
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->statePath('data')
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Radio::make('tipe_pendaftaran_posyandu')
                            ->label('Pilih Jenis Aktivitas Pendaftaran Meja 1')
                            ->options([
                                'baru_lahir' => '1. Registrasi Balita Baru Lahir (Entri Data Master)',
                                'pemeriksaan_rutin' => '2. Registrasi Kunjungan Pemeriksaan Bulanan (Balita Lama)',
                            ])
                            ->live(),
                    ])->columnSpanFull(),

                \Filament\Forms\Components\Tabs::make('Pusat Pelayanan Terpadu Balita')
                    ->tabs([
                        // 📑 TAB 1: MEJA 1 PENDAFTARAN LENGKAP
                        \Filament\Forms\Components\Tabs\Tab::make('Meja 1: Pendaftaran & Profil')
                            ->icon('heroicon-o-user-plus')
                            ->schema([
                                
                                // OPSI 2: PENCARIAN BALITA LAMA
                                Forms\Components\Group::make([
                                    Forms\Components\Select::make('cari_pasien_id')
                                        ->label('Cari NIK / Nama Balita Lama')
                                        ->getSearchResultsUsing(function (string $search) {
                                            return Pasien::query()
                                                ->where('nik', 'like', "%{$search}%")
                                                ->orWhere('nama', 'like', "%{$search}%")
                                                ->limit(10)
                                                ->get()
                                                ->mapWithKeys(fn($p) => [$p->id => "{$p->nik} - {$p->nama} (Ibu: {$p->nama_ibu})"]);
                                        })
                                        ->getOptionLabelUsing(fn($value) => Pasien::find($value)?->nama ?? '')
                                        ->searchable()
                                        ->live()
                                        ->afterStateUpdated(function (Forms\Set $set, $state) {
                                            $p = Pasien::find($state);
                                            if ($p) {
                                                // Sinkronisasi data lama hanya untuk dibaca
                                                $set('nik_lama', $p->nik); $set('nama_lama', $p->nama);
                                            }
                                        }),
                                        
                                    // Informasi singkat balita lama
                                    Forms\Components\TextInput::make('nik_lama')->label('NIK Anak')->readOnly(),
                                    Forms\Components\TextInput::make('nama_lama')->label('Nama Anak')->readOnly(),
                                ])->visible(fn(Get $get) => $get('tipe_pendaftaran_posyandu') === 'pemeriksaan_rutin'),

                                // OPSI 1: FORM INPUT BALITA BARU LENGKAP (SESUAI REQUEST ANDA)
                                Forms\Components\Group::make([
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
                                                    ->disabled(fn (Get $get) => $get('belum_punya_nik')),
                                                Forms\Components\Checkbox::make('belum_punya_nik')
                                                    ->label('Anak belum memiliki NIK')
                                                    ->live()
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
                                                Forms\Components\Select::make('provinsi')->label('Provinsi')->options(['Jawa Tengah' => 'Jawa Tengah', 'Jawa Barat' => 'Jawa Barat', 'Jawa Timur' => 'Jawa Timur']),
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
                                ])->visible(fn(Get $get) => $get('tipe_pendaftaran_posyandu') === 'baru_lahir'),
                            ]),

                        // 📑 TAB 2: MEJA 2-5 (PELAYANAN BULANAN BALITA LAMA)
                        \Filament\Forms\Components\Tabs\Tab::make('Meja 2-5: Pelayanan Fisik')
                            ->icon('heroicon-o-plus-circle')
                            ->visible(fn (Get $get) => $get('tipe_pendaftaran_posyandu') === 'pemeriksaan_rutin')
                            ->schema([
                                Forms\Components\Grid::make(3)
                                    ->schema([
                                        Forms\Components\DatePicker::make('tgl_periksa')->label('Tanggal Periksa')->default(now())->required()->live()->afterStateUpdated(fn(Forms\Set $set, Forms\Get $get) => self::prosesZScoreDanUmur($set, $get)),
                                        Forms\Components\TextInput::make('usia_bulan')->label('Usia (Bulan)')->numeric()->readOnly(),
                                        Forms\Components\Select::make('cara_ukur')->label('Cara Ukur')->options(['berdiri' => 'Berdiri', 'terlentang' => 'Terlentang'])->live()->afterStateUpdated(fn(Forms\Set $set, Forms\Get $get) => self::prosesZScoreDanUmur($set, $get)),
                                    ]),

                                Forms\Components\Fieldset::make('Pengukuran Fisik')
                                    ->schema([
                                        Forms\Components\TextInput::make('berat_badan')->label('Berat Badan (Kg)')->numeric()->live(onBlur: true)->afterStateUpdated(fn(Forms\Set $set, Forms\Get $get) => self::prosesZScoreDanUmur($set, $get)),
                                        Forms\Components\TextInput::make('tinggi_badan')->label('Tinggi Badan (Cm)')->numeric()->live(onBlur: true)->afterStateUpdated(fn(Forms\Set $set, Forms\Get $get) => self::prosesZScoreDanUmur($set, $get)),
                                    ])->columns(2),

                                Forms\Components\Fieldset::make('Hasil Z-Score')->schema([
                                    Forms\Components\TextInput::make('status_gizi')->label('Status Gizi')->readOnly(),
                                    Forms\Components\TextInput::make('status_stunting')->label('Status Stunting')->readOnly(),
                                ])->columns(2),
                            ]),
                    ])->columnSpanFull()
            ]);
    }

    protected static function prosesZScoreDanUmur(Forms\Set $set, Forms\Get $get): void
    {
        $pasienId = $get('cari_pasien_id');
        $tglPeriksa = $get('tgl_periksa');
        $bb = $get('berat_badan'); $tb = $get('tinggi_badan'); $caraUkur = $get('cara_ukur');

        if (!$pasienId || !$tglPeriksa) return;
        $pasien = Pasien::find($pasienId);
        if (!$pasien) return;

        $lahir = Carbon::parse($pasien->tgl_lahir);
        $periksa = Carbon::parse($tglPeriksa);
        $usia = max(0, $lahir->diffInMonths($periksa, false));
        $set('usia_bulan', $usia);
        $jk = $pasien->jenis_kelamin;

        if (!empty($bb) && is_numeric($bb)) $set('status_gizi', AntropometriHelper::hitungBbu($jk, $usia, $bb));
        if (!empty($tb) && is_numeric($tb) && !empty($caraUkur)) {
            $tbKoreksi = (float) $tb + ($usia < 24 && $caraUkur === 'berdiri' ? 0.7 : ($usia >= 24 && $caraUkur === 'terlentang' ? -0.7 : 0));
            $set('status_stunting', AntropometriHelper::hitungTbu($jk, $usia, $tbKoreksi));
        }
    }

    public function simpanPendaftaran(): void
    {
        $formData = $this->form->getState();
        $tipe = $formData['tipe_pendaftaran_posyandu'] ?? 'baru_lahir';

        if ($tipe === 'baru_lahir') {
            // EKSEKUSI PENYIMPANAN DATA BALITA BARU LENGKAP
            Pasien::create([
                'nik' => !empty($formData['belum_punya_nik']) ? null : ($formData['nik'] ?? null),
                'no_kk' => $formData['no_kk'] ?? null,
                'nama' => $formData['nama'],
                'jenis_kelamin' => $formData['jenis_kelamin'],
                'tempat_lahir' => $formData['tempat_lahir'] ?? '-',
                'tgl_lahir' => $formData['tgl_lahir'],
                'anak_ke' => $formData['anak_ke'] ?? null,
                'usia_kehamilan' => $formData['usia_kehamilan'] ?? null,
                'berat_lahir' => $formData['berat_lahir'] ?? null,
                'panjang_lahir' => $formData['panjang_lahir'] ?? null,
                'lingkar_kepala_lahir' => $formData['lingkar_kepala_lahir'] ?? null,
                'imd' => $formData['imd'] ?? 0,
                'buku_kia_bayi_kecil' => $formData['buku_kia_bayi_kecil'] ?? 0,
                'tatalaksana_bblr' => $formData['tatalaksana_bblr'] ?? 0,
                'nama_ibu' => $formData['nama_ibu'] ?? null,
                'nik_ibu' => $formData['nik_ibu'] ?? null,
                'nama_ayah' => $formData['nama_ayah'] ?? null,
                'nik_ayah' => $formData['nik_ayah'] ?? null,
                'provinsi' => $formData['provinsi'] ?? null,
                'kabupaten' => $formData['kabupaten'] ?? null,
                'kecamatan' => $formData['kecamatan'] ?? null,
                'desa_kelurahan' => $formData['desa_kelurahan'] ?? null,
                'nama_puskesmas' => $formData['nama_puskesmas'] ?? null,
                'nama_posyandu' => $formData['nama_posyandu'] ?? null,
                'alamat' => $formData['alamat'] ?? '-',
                'rt' => $formData['rt'] ?? null,
                'rw' => $formData['rw'] ?? null,
                'no_hp' => $formData['no_hp'] ?? null,
            ]);

            Notification::make()->title('Sukses Mendaftarkan Balita Baru!')->success()->send();
        } else {
            // EKSEKUSI DATA KUNJUNGAN BALITA LAMA
            PemeriksaanBayi::create([
                'pasien_id' => $formData['cari_pasien_id'],
                'tgl_periksa' => $formData['tgl_periksa'] ?? now(),
                'usia_bulan' => $formData['usia_bulan'],
                'berat_badan' => $formData['berat_badan'] ?? null,
                'tinggi_badan' => $formData['tinggi_badan'] ?? null,
                'cara_ukur' => $formData['cara_ukur'] ?? null,
                'status_gizi' => $formData['status_gizi'] ?? null,
                'status_stunting' => $formData['status_stunting'] ?? null,
                'keterangan_umur' => $formData['usia_bulan'] . " Bulan",
            ]);

            Notification::make()->title('Sukses Mencatat Kunjungan!')->success()->send();
        }

        $this->redirect(PasienResource::getUrl('index'));
    }
}