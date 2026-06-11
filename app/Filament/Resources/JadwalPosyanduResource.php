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
                            ->label('Kelompok Target')
                            ->options([
                                'balita' => 'Balita (Orang Tua)',
                                'remaja' => 'Remaja',
                                'lansia' => 'Lansia / Keluarga',
                                'bumil' => 'Ibu Hamil',
                            ])
                            ->required()
                            ->live(),

                        Forms\Components\DatePicker::make('tanggal_pelaksanaan')
                            ->label('Tanggal Kegiatan')
                            ->required()
                            ->minDate(now()->toDateString()),

                        Forms\Components\TimePicker::make('jam_kirim_pesan')
                            ->label('Jam Pengiriman Pesan (H-1)')
                            ->required()
                            ->default('08:00'),

                        Forms\Components\Select::make('template_pesan_id')
                            ->label('Gunakan Template Pesan Master')
                            ->helperText('Pilih template yang sudah dibuat atau pilih kustom untuk mengetik manual.')
                            ->options(TemplatePesan::all()->pluck('nama_template', 'id'))
                            ->searchable()
                            ->reactive()
                            ->afterStateUpdated(function ($state, Set $set) {
                                if ($state) {
                                        $template = TemplatePesan::find($state);
                                        if ($template) {
                                            $set('isi_pesan_kustom', $template->isi_template);
                                        }
                                }
                            }),

                        Forms\Components\Textarea::make('isi_pesan_kustom')
                            ->label('Isi Pesan Siaran (WhatsApp Content)')
                            ->rows(6)
                            ->required()
                            ->placeholder('Tulis isi pesan pengingat di sini...')
                            ->columnSpan('full')
                            ->helperText(new HtmlString('Gunakan variabel dinamis berikut:<br><b>{nama}</b> = Nama Target, <b>{agenda}</b> = Nama Kegiatan, <b>{tanggal}</b> = Tanggal Kegiatan.')),
                            
                        Forms\Components\Toggle::make('is_aktif')
                            ->label('Aktifkan Jadwal Pengingat Ini')
                            ->default(true)
                            ->columnSpan('full'),
                    ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            // 🟢 PERBAIKAN UTAMA: OPTIMASI EAGER LOADING UNTUK MENCEGAH TIMEOUT N+1 LOOP
            ->modifyQueryUsing(fn ($query) => $query->with(['templatePesan'])) 
            
            ->columns([
                Tables\Columns\TextColumn::make('index')
                    ->label('No')
                    ->rowIndex()
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('judul_agenda')
                    ->label('Nama Kegiatan')
                    ->searchable()
                    ->wrap()
                    ->weight('semibold'),

                Tables\Columns\TextColumn::make('tanggal_pelaksanaan')
                    ->label('Tanggal Acara')
                    ->date('d-m-Y')
                    ->sortable(),

                // 🟢 PERBAIKAN 2: Pemanggilan Relasi Berbadge yang Sudah Ter-Optimasi Eager Loading
                Tables\Columns\TextColumn::make('templatePesan.nama_template')
                    ->label('Template Master')
                    ->default('Kustom (Ketik Manual)')
                    ->badge()
                    ->color(fn ($state) => $state === 'Kustom (Ketik Manual)' ? 'warning' : 'success'),

                Tables\Columns\TextColumn::make('kategori_target')
                    ->label('Target')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'balita' => 'primary',
                        'remaja' => 'warning',
                        'lansia' => 'success',
                        'bumil' => 'danger',
                        default => 'secondary',
                    }),

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