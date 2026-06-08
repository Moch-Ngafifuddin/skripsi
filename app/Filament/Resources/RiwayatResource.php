<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RiwayatResource\Pages;
use App\Models\Pasien;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Blade;
use App\Services\LayananFonnte;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class RiwayatResource extends Resource
{
    protected static ?string $model = Pasien::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-magnifying-glass';

    protected static ?string $navigationLabel = 'Cek Riwayat Pengukuran';

    protected static ?string $navigationGroup = 'Pelayanan';

    protected static ?int $navigationSort = 3;

    public static function table(Table $table): Table
    {
        return $table
        ->modifyQueryUsing(fn ($query) => $query->with('pemeriksaanBayi'))
            ->columns([
                // 1. Kolom No (Nomor Urut Otomatis)
                Tables\Columns\TextColumn::make('no')
                    ->label('No')
                    ->rowIndex(),

                // 2. Kolom NIK
                Tables\Columns\TextColumn::make('nik')
                    ->label('NIK')
                    ->searchable()
                    ->sortable(),

                // 3. Kolom Nama Pasien
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama')
                    ->searchable()
                    ->sortable()
                    ->weight('semibold'),

                // 4. Kolom Jenis Kelamin (JK)
                Tables\Columns\TextColumn::make('jenis_kelamin')
                    ->label('JK')
                    ->alignCenter(),

                // 5. Kolom Tanggal Lahir (Format: DD-MM-YYYY)
                Tables\Columns\TextColumn::make('tgl_lahir')
                    ->label('Tgl Lahir')
                    ->date('d-m-Y')
                    ->sortable(),

                // 6. Kolom Nama Orang Tua (Mengambil data nama_ibu dari model pasien)
                Tables\Columns\TextColumn::make('nama_ibu')
                    ->label('Nama Ortu')
                    ->searchable()
                    ->placeholder('-'),

                // 7. Kolom Provinsi (Diambil dinamis dari akun petugas yang sedang login)
                Tables\Columns\TextColumn::make('prov')
                    ->label('Prov')
                    ->state(fn () => auth()->user()?->provinsi ?? '-'),

                // 8. Kolom Kab/Kota (Diambil dinamis dari akun petugas yang sedang login)
                Tables\Columns\TextColumn::make('kab_kota')
                    ->label('Kab/Kota')
                    ->state(fn () => auth()->user()?->kabupaten_kota ?? '-'),

                // 9. Kolom Kecamatan (Diambil dinamis dari akun petugas yang sedang login)
                Tables\Columns\TextColumn::make('kec')
                    ->label('Kec')
                    ->state(fn () => auth()->user()?->kecamatan ?? '-'),

                // 10. Kolom Puskesmas (Diambil dinamis dari akun petugas yang sedang login)
                Tables\Columns\TextColumn::make('puskesmas')
                    ->label('Puskesmas')
                    ->state(fn () => auth()->user()?->nama_puskesmas ?? '-'),

                // 11. Kolom Desa/Kel (Diambil dinamis dari akun petugas yang sedang login)
                Tables\Columns\TextColumn::make('desa_kel')
                    ->label('Desa/Kel')
                    ->state(fn () => auth()->user()?->desa_kelurahan ?? '-'),

                // 12. Kolom Posyandu (Diambil dinamis dari akun petugas yang sedang login)
                Tables\Columns\TextColumn::make('posyandu')
                    ->label('Posyandu')
                    ->state(fn () => auth()->user()?->nama_posyandu ?? '-'),
            ])
            ->actions([
                // Tombol Edit Bawaan
                Tables\Actions\EditAction::make(),
    
                // 1. Action Icon Jam - Riwayat Pengukuran (Modal Lebar / SlideOver)
                Tables\Actions\Action::make('lihatRiwayat')
                    ->label('Riwayat Tabel')
                    ->icon('heroicon-m-clock')
                    ->color('info')
                    ->modalHeading(fn (Pasien $record) => "Arsip Rekam Medis: {$record->nama}")
                    ->modalWidth('7xl') 
                    ->modalContent(fn (Pasien $record) => view('filament.pages.cek-riwayat', [
                        'pasien' => $record,
                        // Ambil semua riwayat pemeriksaan anak ini, urutkan dari yang paling baru
                        'pemeriksaan' => $record->pemeriksaanBayi()->orderBy('tgl_periksa', 'desc')->get(),
                    ]))
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Tutup'),

                // 1. Action Icon Jam - Riwayat Pengukuran (Modal Lebar / SlideOver)
                Tables\Actions\Action::make('kirim_wa')
                ->label('Kirim PDF via WA')
                ->icon('heroicon-o-paper-airplane')
                ->color('primary')
                ->action(function (Pasien $record) {
                    // 1. Ambil data pemeriksaan terbaru
                    $pemeriksaan = $record->pemeriksaanBayi()->latest()->first();
                    
                    if (!$pemeriksaan) {
                        Notification::make()->title('Gagal: Data pemeriksaan tidak ditemukan!')->danger()->send();
                        return;
                    }
            
                    // 2. Generate Signed URL yang aman dan kadaluwarsa dalam 15 menit
                    // Ini memastikan hanya link yang dibuat oleh sistem yang bisa diakses
                    $urlPdf = URL::temporarySignedRoute(
                        'laporan.download', 
                        now()->addMinutes(15), 
                        ['id' => $pemeriksaan->id]
                    );
            
                    // 3. Kirim via LayananFonnte
                    // Pastikan no_hp pasien diformat dengan benar (misal: 0812xxxx -> 62812xxxx)
                    $pesan = "Halo Bunda, laporan perkembangan " . $record->nama . " bulan ini sudah tersedia. Klik link berikut untuk mengunduh laporan PDF (Link hanya berlaku 15 menit): " . $urlPdf;
                    
                    // Panggil service pengiriman
                    $status = LayananFonnte::kirimPesan($record->no_hp, $pesan);
            
                    Notification::make()
                        ->title('Laporan berhasil dikirim ke WhatsApp!')
                        ->success()
                        ->send();
                }),
    
                // 2. Action Icon Buku - Grafik KMS Balita
                Tables\Actions\Action::make('lihatKms')
                    ->label('Grafik KMS')
                    ->modalHeading(fn (Pasien $record) => "Grafik KMS Personal: {$record->nama}")
                    ->icon('heroicon-o-book-open') // Icon Buku
                    ->color('success')
                    ->modalWidth('4xl')
                    ->modalContent(fn (Pasien $record) => view('filament.pages.cek-riwayat-layout', [
                        // Karena blade cek-riwayat-layout membutuhkan $getRecord()
                        // Kita kirimkan closure yang mengembalikan $record saat ini
                        'getRecord' => fn () => $record,
                    ]))
                    ->modalSubmitAction(false) // Hilangkan tombol "Save"
                    ->modalCancelActionLabel('Tutup'),
            ]);
            //->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRiwayats::route('/'),
        ];
    }
}