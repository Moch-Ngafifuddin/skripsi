<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Section;
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
                            ->label('Upload Logo Puskesmas')
                            ->image()
                            ->directory('branding-logo')
                            ->visibility('public'),

                        ColorPicker::make('warna_tema')
                            ->label('Warna Utama Aplikasi (Theme Color)')
                            ->required(),
                    ])
            ])
            ->statePath('data');
    }

    public function simpan(): void
    {
        $formData = $this->form->getState();
        
        $pengaturan = Pengaturan::find(1);
        $pengaturan->update($formData);

        Notification::make()
            ->title('Berhasil Diperbarui')
            ->body('Perubahan visual berhasil disimpan. Silakan muat ulang halaman untuk melihat efek warna baru.')
            ->success()
            ->send();
    }
}