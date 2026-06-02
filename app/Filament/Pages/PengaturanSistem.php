<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms\Form;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\ColorPicker;
use Filament\Notifications\Notification;
use App\Models\Pengaturan;

class PengaturanSistem extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'Pengaturan Tampilan';
    protected static ?string $title = 'Konfigurasi Tampilan & Branding';
    protected static ?string $navigationGroup = 'Pengaturan';
    protected static ?int $navigationSort = 5;

    protected static string $view = 'filament.pages.pengaturan-sistem';

    public ?array $data = [];

    public function mount(): void
    {
        // Ambil data ID 1, jika belum ada otomatis buat data awal (default)
        $pengaturan = Pengaturan::firstOrCreate(['id' => 1]);
        $this->form->fill($pengaturan->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Branding Sistem Informasi')
                    ->description('Sesuaikan identitas Puskesmas, teks halaman depan, dan warna dasar aplikasi.')
                    ->schema([
                        TextInput::make('nama_puskesmas')
                            ->label('Nama Puskesmas / Aplikasi')
                            ->required(),

                        Textarea::make('teks_login')
                            ->label('Teks Selamat Datang di Halaman Login')
                            ->rows(3)
                            ->required(),

                        FileUpload::make('logo')
                            ->label('Upload Logo Puskesmas Utama (Muncul di atas form login)')
                            ->image()
                            ->directory('branding-logo'),

                        FileUpload::make('background_login')
                            ->label('Upload Gambar Latar Belakang (Background Login)')
                            ->image()
                            ->imageEditor()
                            ->directory('branding-bg'),

                        ColorPicker::make('warna_tema')
                            ->label('Warna Utama Aplikasi (Theme Color)')
                            ->required(),
                    ]),

                // SECTION 2: Multi-Logo dengan Repeater dan Sizing Dinamis
                Section::make('Pengaturan Multi Logo Halaman Login')
                    ->description('Tambahkan satu atau beberapa logo instansi pendukung yang akan ditampilkan di atas judul login.')
                    ->schema([
                        Repeater::make('logos')
                            ->label('Daftar Logo Instansi Tambahan')
                            ->schema([
                                FileUpload::make('path_logo')
                                    ->label('Preview Logo Instansi')
                                    ->image()
                                    ->directory('system-logos')
                                    ->imagePreviewHeight('150') 
                                    ->maxSize(2048) 
                                    ->required(),
                                    
                                Select::make('tinggi_logo')
                                    ->label('Ukuran Tinggi Logo')
                                    ->options([
                                        'h-12' => 'Kecil (48px)',
                                        'h-16' => 'Sedang (64px)',
                                        'h-20' => 'Besar (80px)',
                                        'h-24' => 'Sangat Besar (96px)',
                                    ])
                                    ->default('h-16')
                                    ->required(),
                            ])
                            ->columns(2)
                            ->createItemButtonLabel('Tambah Logo Baru')
                            ->grid(2), // 🛠️ PENYESUAIAN: Tanda koma dipastikan berada di sini untuk memisahkan antar-komponen form
                    ]),
            ])
            ->statePath('data');
    }

    // 1. 🛠️ Hapus tulisan ': void' di sini
    public function simpan(): void
    {
        $formData = $this->form->getState();
        
        $pengaturan = Pengaturan::find(1);
        $pengaturan->update($formData);

        // Memuat ulang data secara diam-diam ke dalam form agar loading FilePond langsung berhenti
        $this->form->fill($pengaturan->fresh()->toArray());

        Notification::make()
            ->title('Logo Tersimpan')
            ->body('Perubahan berhasil diterapkan ke halaman login.')
            ->success()
            // ⏳ Mengatur agar popup notifikasi otomatis hilang persis dalam waktu 2 detik
            ->duration(2000) 
            ->send();
    }
}