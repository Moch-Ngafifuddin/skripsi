<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JadwalPosyanduResource\Pages;
use App\Models\JadwalPosyandu;
use App\Models\TemplatePesan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get; 
use Filament\Forms\Set; 
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;

class JadwalPosyanduResource extends Resource
{
    protected static ?string $model = JadwalPosyandu::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationLabel = 'Kalender Pengingat';
    protected static ?string $navigationGroup = 'Pelayanan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Agenda & Penjadwalan Siaran Otomatis')
                    ->description('Tentukan jadwal kegiatan posyandu. Sistem akan menyiarkan pesan pengingat ke WhatsApp target pada H-1 acara.')
                    ->schema([
                        Forms\Components\TextInput::make('judul_agenda')
                            ->label('Nama Kegiatan / Agenda')
                            ->required()
                            ->placeholder('Contoh: Pelaksanaan Posyandu & Imunisasi Balita rutin')
                            ->columnSpan('full'), 

                        Forms\Components\Select::make('kategori_target')
                            ->label('Kelompok Target Sasaran')
                            ->options([
                                'balita' => 'Balita',
                                'remaja' => 'Remaja',
                                'lansia' => 'Lansia',
                                'bumil' => 'Ibu Hamil',
                            ])
                            ->required(),

                        Forms\Components\DatePicker::make('tanggal_acara')
                            ->label('Tanggal Pelaksanaan')
                            ->required()
                            ->native(false),

                        Forms\Components\TimePicker::make('waktu_acara')
                            ->label('Waktu / Jam Pelaksanaan')
                            ->required()
                            ->default('08:00'),

                        Forms\Components\TextInput::make('tempat_acara')
                            ->label('Tempat / Lokasi Acara')
                            ->required()
                            ->placeholder('Contoh: Balai Desa Pasirmuncang'),

                        Forms\Components\TimePicker::make('jam_kirim_pesan')
                            ->label('Jam Pengiriman Pesan (H-1)')
                            ->default('08:00')
                            ->required(),

                        Forms\Components\Select::make('template_id')
                            ->label('Gunakan Master Template Pesan (Opsional)')
                            ->relationship('templatePesan', 'nama_template')
                            ->placeholder('-- Pilih Template Master (Atau Ketik Manual Di Bawah) --')
                            ->searchable()
                            ->preload()
                            ->live() 
                            ->afterStateUpdated(function (Get $get, Set $set, ?string $state) {
                                if ($state) {
                                    $template = TemplatePesan::find($state);
                                    if ($template) {
                                        $set('isi_pesan', $template->isi_pesan);
                                    }
                                }
                            })
                            ->columnSpan('full'),

                        Forms\Components\Textarea::make('isi_pesan')
                            ->label('Konten Pesan Pengingat WhatsApp')
                            ->helperText('Gunakan {nama_ibu}, {nama_balita}, {tanggal}, {waktu}, dan {tempat} untuk memanggil data secara dinamis.')
                            ->rows(5)
                            ->required()
                            ->columnSpan('full')
                            ->placeholder("Assalamualaikum wr.wb Bapak/Ibu {nama_ibu},\nMeningatkan bahwa besok pada:\nTanggal: {tanggal}\nWaktu: {waktu}\nTempat: {tempat}\n\nAkan diadakan {judul_agenda}. Mohon kehadirannya."),

                        Forms\Components\Toggle::make('is_aktif')
                            ->label('Status Pengingat Otomatis')
                            ->helperText('Jika dinonaktifkan, pesan H-1 tidak akan dikirim oleh server.')
                            ->default(true)
                            ->onColor('success')
                            ->offColor('danger')
                            ->columnSpan('full'),
                    ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tanggal_acara')
                    ->label('Tanggal Acara')
                    ->date('d M Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('judul_agenda')
                    ->label('Agenda Kegiatan')
                    ->searchable(),

                Tables\Columns\TextColumn::make('templatePesan.nama_template')
                    ->label('Template Master')
                    ->default('Kustom (Ketik Manual)')
                    ->badge()
                    ->color(fn ($state) => $state === 'Kustom (Ketik Manual)' ? 'warning' : 'success'),

                Tables\Columns\BadgeColumn::make('kategori_target')
                    ->label('Target')
                    ->colors([
                        'primary' => 'balita',
                        'warning' => 'remaja',
                        'success' => 'lansia',
                        'danger' => 'bumil',
                    ]),

                Tables\Columns\TextColumn::make('jam_kirim_pesan')
                    ->label('Jam Kirim (H-1)'),

                Tables\Columns\ToggleColumn::make('is_aktif')
                    ->label('Sakelar Otomatis'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kategori_target')
                    ->options([
                        'balita' => 'Balita',
                        'remaja' => 'Remaja',
                        'lansia' => 'Lansia',
                        'bumil' => 'Ibu Hamil',
                    ])
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJadwalPosyandus::route('/'),
            'create' => Pages\CreateJadwalPosyandu::route('/create'),
            'edit' => Pages\EditJadwalPosyandu::route('/{record}/edit'),
        ];
    }
}