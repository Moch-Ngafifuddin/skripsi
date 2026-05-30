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
                // --- IDENTITAS UMUM ---
                Forms\Components\Section::make('Identitas Umum')
                    ->description('Data wajib untuk Balita')
                    ->schema([
                        Forms\Components\TextInput::make('nik')
                            ->label('NIK')
                            ->placeholder('3306171702880008')
                            ->required()
                            ->numeric()
                            ->length(16)
                            ->unique(ignoreRecord: true),
                        
                        Forms\Components\TextInput::make('no_kk')
                            ->label('Nomor KK')
                            ->placeholder('3322070009000190')
                            ->numeric(),

                        Forms\Components\TextInput::make('nama')
                            ->label('Nama Lengkap')
                            ->placeholder('Ega Camelia Kusworo')
                            ->required(),

                        Forms\Components\Select::make('jenis_kelamin')
                            ->options([
                                'L' => 'Laki-laki',
                                'P' => 'Perempuan',
                            ])
                            ->required(),

                        Forms\Components\TextInput::make('tempat_lahir')
                            ->required(),
                        
                        Forms\Components\DatePicker::make('tgl_lahir')
                            ->label('Tanggal Lahir')
                            ->required()
                            ->maxDate(now()),

                        Forms\Components\Textarea::make('alamat')
                            ->columnSpanFull(),
                    ])->columns(2),

                // --- DATA KHUSUS BALITA ---
                Forms\Components\Section::make('Data Khusus Balita (Buku KIA)')
                    ->description('Isi bagian ini HANYA jika mendaftarkan Balita')
                    ->icon('heroicon-o-face-smile')
                    ->collapsed()
                    ->schema([
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('nama_ayah')->label('Nama Ayah'),
                                Forms\Components\TextInput::make('nik_ayah')->label('NIK Ayah')->numeric()->length(16),
                                Forms\Components\TextInput::make('pendidikan_pekerjaan_ayah')->label('Pendidikan / Pekerjaan'),
                            ]),

                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('nama_ibu')->label('Nama Ibu'),
                                Forms\Components\TextInput::make('nik_ibu')->label('NIK Ibu')->numeric()->length(16),
                                Forms\Components\TextInput::make('pendidikan_pekerjaan_ibu')->label('Pendidikan / Pekerjaan'),
                            ]),

                        Forms\Components\Grid::make(4)
                            ->schema([
                                Forms\Components\TextInput::make('anak_ke')->label('Anak Ke-')->numeric(),
                                Forms\Components\TextInput::make('berat_lahir')->label('BB Lahir (Gram)')->numeric(),
                                Forms\Components\TextInput::make('panjang_lahir')->label('PB Lahir (Cm)')->numeric(),
                                Forms\Components\Checkbox::make('imd')->label('IMD'),
                            ]),
                            
                        Forms\Components\Radio::make('riwayat_asi')
                            ->label('Riwayat ASI Eksklusif')
                            ->options(['E1'=>'E1','E2'=>'E2','E3'=>'E3','E4'=>'E4','E5'=>'E5','E6'=>'E6'])
                            ->inline()
                            ->columnSpanFull(),
                    ]),

                // --- KONTAK ---
                Forms\Components\Section::make('Kontak (Opsional)')
                    ->schema([
                        Forms\Components\TextInput::make('nama_wali')->label('Nama Wali'),
                        Forms\Components\TextInput::make('no_hp')->label('No HP / WhatsApp')->tel(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nik')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('nama')->searchable()->weight('bold'),
                Tables\Columns\TextColumn::make('tgl_lahir')
                    ->label('Umur')
                    ->formatStateUsing(function (?string $state): string {
                        if (!$state) {
                            return '-';
                        }
                        $umur = \Carbon\Carbon::parse($state)->diff(\Carbon\Carbon::now());
                        return "{$umur->y} Tahun {$umur->m} Bulan {$umur->d} Hari";
                    }),
                Tables\Columns\TextColumn::make('jenis_kelamin')
                    ->badge()
                    ->colors(['info' => 'L', 'danger' => 'P']),
            ])
            // Filter otomatis agar pasien yang diarsipkan ("is_arsip" => true) tidak muncul di daftar aktif
            ->modifyQueryUsing(fn ($query) => $query->where('is_arsip', false))
            ->actions([
                Tables\Actions\EditAction::make()->iconButton()->label('Ubah'),
                
                // 🛠️ REFORMASI TOMBOL HAPUS & PENGARSIPAN DINAMIS
                Tables\Actions\DeleteAction::make()
                    ->iconButton()
                    ->label('Hapus')
                    ->modalHeading('Konfirmasi Penghapusan / Pengarsipan Pasien')
                    ->modalSubmitActionLabel('Proses Data')
                    ->form([
                        // 1. Pilihan Alasan Utama
                        Forms\Components\Select::make('alasan_hapus')
                            ->label('Alasan Penghapusan Data')
                            ->options([
                                'salah_input' => 'Salah Input (Hapus Permanen)',
                                'pindah' => 'Balita Pindah Domisili / Puskesmas',
                                'meninggal' => 'Balita Meninggal Dunia',
                            ])
                            ->required()
                            ->live(),

                        // 2. Form Tambahan: PINDAH DOMISILI / PUSKESMAS
                        Forms\Components\Textarea::make('keterangan_pindah')
                            ->label('Keterangan Pindah Puskesmas / Domisili')
                            ->placeholder('Masukkan lokasi puskesmas baru atau alamat domisili baru...')
                            ->required()
                            ->visible(fn (Forms\Get $get) => $get('alasan_hapus') === 'pindah'),

                        // 3. Form Tambahan: MENINGGAL DUNIA
                        Forms\Components\DatePicker::make('tgl_meninggal')
                            ->label('Tanggal Meninggal')
                            ->required()
                            ->visible(fn (Forms\Get $get) => $get('alasan_hapus') === 'meninggal'),

                        Forms\Components\TextInput::make('penyebab_meninggal')
                            ->label('Penyebab Meninggal')
                            ->required()
                            ->visible(fn (Forms\Get $get) => $get('alasan_hapus') === 'meninggal'),

                        Forms\Components\TextInput::make('tempat_pemakaman')
                            ->label('Tempat Pemakaman')
                            ->required()
                            ->visible(fn (Forms\Get $get) => $get('alasan_hapus') === 'meninggal'),
                    ])
                    ->action(function (array $data, $record) {
                        if ($data['alasan_hapus'] === 'salah_input') {
                            // JALUR 1: Hapus Permanen dari Database
                            $record->delete();

                            \Filament\Notifications\Notification::make()
                                ->title('Data Dihapus Permanen')
                                ->body('Data pasien berhasil dihapus secara permanen karena salah input.')
                                ->success()
                                ->send();
                        } else {
                            // JALUR 2 & 3: Masuk ke Sistem Arsip (is_arsip = true)
                            $record->update([
                                'is_arsip' => true,
                                'keterangan_pindah' => $data['keterangan_pindah'] ?? null,
                                'tgl_meninggal' => $data['tgl_meninggal'] ?? null,
                                'penyebab_meninggal' => $data['penyebab_meninggal'] ?? null,
                                'tempat_pemakaman' => $data['tempat_pemakaman'] ?? null,
                            ]);

                            \Filament\Notifications\Notification::make()
                                ->title('Data Berhasil Diarsipkan')
                                ->body('Pasien telah dipindahkan ke daftar arsip dan dikeluarkan dari daftar aktif.')
                                ->success()
                                ->send();
                        }
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

    // --- LOGIKA HAK AKSES MENU ---
    public static function shouldRegisterNavigation(): bool
    {
        if (Auth::user()?->email === 'admin@posyandu.com' || Auth::user()?->meja_tugas === 'superadmin') {
            return true;
        }
        $akses = Auth::user()?->akses_menu ?? [];
        return in_array('pasien', $akses);
    }
}