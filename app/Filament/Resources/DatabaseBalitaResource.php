<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DatabaseBalitaResource\Pages;
use App\Models\PemeriksaanBayi;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Carbon\Carbon;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Placeholder;
use Filament\Notifications\Notification;


class DatabaseBalitaResource extends Resource
{
    protected static ?string $model = PemeriksaanBayi::class;

    protected static ?string $navigationIcon = 'heroicon-o-circle-stack'; 
    protected static ?string $navigationGroup = 'Pelayanan';
    protected static ?string $navigationLabel = 'Database Balita';
    protected static ?string $pluralModelLabel = 'Database Balita';

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn ($query) => $query
                ->with(['pasien'])
                ->whereHas('pasien', fn ($q) => $q->where('is_arsip', 0))
                ->whereIn('pemeriksaan_bayi.id', function ($subQuery) {
                    $subQuery->selectRaw('MAX(id)')
                        ->from('pemeriksaan_bayi')
                        ->groupBy('pasien_id');
                })
            )

            ->headerActions([
                Tables\Actions\Action::make('export_excel')
                    ->label('Export Excel')
                    ->icon('heroicon-o-document-text')
                    ->color('success')
                    ->action(function ($livewire) {
                        // Ambil data sesuai filter & search aktif (Eager Loading tetap terjaga)
                        $records = $livewire->getFilteredTableQuery()->with(['pasien'])->get();

                        // Jalankan fungsi download dari library Laravel Excel
                        return \Maatwebsite\Excel\Facades\Excel::download(
                            new \App\Exports\DatabaseBalitaExport($records), 
                            'database_balita_' . now()->format('Ymd_His') . '.xlsx'
                        );
                    }),
    
                // 🔴 2. EXPORT PDF (Menggunakan barryvdh/laravel-dompdf dengan Kolom Lengkap)
                Tables\Actions\Action::make('export_pdf')
                    ->label('Export PDF')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('danger')
                    ->action(function ($livewire) {
                        $records = $livewire->getFilteredTableQuery()->with(['pasien'])->get();

                        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.database-balita', [
                            'records' => $records,
                            'tgl_cetak' => now()->format('d-m-Y H:i')
                        ])->setPaper('f4', 'landscape'); // Set landscape agar 12 kolom muat sempurna

                        return response()->streamDownload(
                            fn () => print($pdf->output()),
                            'laporan_database_balita_' . now()->format('Ymd_His') . '.pdf'
                        );
                    }),
    
                // 🔵 3. FUNGSI BROADCAST REKAP DATA VIA WHATSAPP GATEWAY (FONNTE)
                Tables\Actions\Action::make('kirim_wa_massal')
                    ->label('Kirim WA')
                    ->icon('heroicon-o-paper-airplane')
                    ->color('primary')
                    ->form([
                        \Filament\Forms\Components\TextInput::make('nomor_wa_admin')
                            ->label('Nomor WhatsApp Admin Penerima')
                            ->placeholder('Contoh: 08123456789')
                            ->required()
                            ->tel()
                            ->maxLength(15),
                    ])
                    ->modalHeading('Kirim Rekap Database via WhatsApp Gateway')
                    ->modalDescription('Masukkan nomor WhatsApp tujuan. Sistem akan mengirimkan pesan otomatis melalui API Fonnte.')
                    ->modalSubmitActionLabel('Kirim via Fonnte')

                    ->action(function ($livewire, array $data) {
                        // 1. Tarik data terfilter saat ini (Eager Loading Pasien)
                        $records = $livewire->getFilteredTableQuery()->with(['pasien'])->get();
                        $total = $records->count();

                        // 2. Dapatkan status filter aktif untuk disisipkan ke dalam Link Download
                        $activeFilters = $livewire->tableFilters;
                        $statusGizi = $activeFilters['status_gizi']['value'] ?? null;
                        $statusStunting = $activeFilters['status_stunting']['value'] ?? null;
                        $dariTanggal = $activeFilters['tgl_periksa_range']['dari_tanggal'] ?? null;
                        $sampaiTanggal = $activeFilters['tgl_periksa_range']['sampai_tanggal'] ?? null;

                        // 3. Bangun Link Download Dinamis memanfaatkan url dasar sistem Anda
                        $linkDownload = \Illuminate\Support\Facades\URL::temporarySignedRoute(
                            'download.excel.wa',
                            now()->addHours(24),
                            [
                                'status_gizi' => $statusGizi,
                                'status_stunting' => $statusStunting,
                                'dari' => $dariTanggal,
                                'sampai' => $sampaiTanggal,
                            ]
                        );

                        // Hitung statistik rincian data kasus
                        $baseQuery = $livewire->getFilteredTableQuery();
                        $giziBuruk = $records->where('status_gizi', 'Gizi Buruk')->count();
                        $bbKurang  = $records->where('status_gizi', 'Gizi Kurang')->count();
                        $giziNormal = $records->where('status_gizi', 'Gizi Baik (Normal)')->count();
                        $bbLebih   = $records->where('status_gizi', 'Risiko Berat Badan Lebih')->count();
                        $pendek    = $records->where('status_stunting', 'Pendek')->count() + $records->where('status_stunting', 'Sangat Pendek')->count();

                        // 4. STRUKTUR PESAN WHATSAPP (Ditambahkan baris Link Unduhan)
                        $pesan = "*NOTIFIKASI REKAP DATABASE BALITA*\n";
                        $pesan .= "Tanggal Penarikan: " . now()->format('d-m-Y H:i') . " WIB\n";
                        $pesan .= "Posyandu: " . (auth()->user()?->nama_posyandu ?? '-') . "\n";
                        $pesan .= "----------------------------------------\n";
                        $pesan .= "Jumlah Balita Terfilter: *{$total} Anak*\n\n";

                        $pesan .= "*Rincian Kasus Gizi (BB/U):*\n";
                        $pesan .= "• Gizi Buruk: {$giziBuruk} Anak\n";
                        $pesan .= "• BB Kurang (Gizi Kurang): {$bbKurang} Anak\n";
                        $pesan .= "• BB Normal: {$giziNormal} Anak\n";
                        $pesan .= "• Risiko Obesitas: {$bbLebih} Anak\n\n";

                        $pesan .= "*Rincian Kasus Stunting (TB/U):*\n";
                        $pesan .= "• Pendek/Stunting: {$pendek} Anak\n";
                        $pesan .= "----------------------------------------\n";
                        $pesan .= "*📥 LINK DOWNLOAD DATA MENTAH EXCEL:*\n";
                        $pesan .= $linkDownload . "\n";
                        $pesan .= "----------------------------------------\n";
                        $pesan .= "_Pesan ini otomatis di kirim oleh Sistem Pelayanan Posyandu._";

                        // 📲 KIRIM DATA VIA SERVICE FONNTE
                        $kirim = \App\Services\LayananFonnte::kirimPesan($data['nomor_wa_admin'], $pesan);


                        // 🔔 SINKRONISASI NOTIFIKASI TOAST FILAMENT
                        if ($kirim) {
                            \Filament\Notifications\Notification::make()
                                ->title('Berhasil Terkirim!')
                                ->body('Laporan rekapitulasi beserta link download Excel sukses dikirim.')
                                ->success()
                                ->send();
                        } else {
                            \Filament\Notifications\Notification::make()
                                ->title('Pengiriman Gagal')
                                ->body('Gagal menghubungi API Fonnte. Periksa token Anda di file .env.')
                                ->danger()
                                ->send();
                        }
                    }),

                ])

            // 📊 SUSUNAN 12 KOLOM YANG INGIN DITAMPILKAN SECARA INTEGRATIF
            ->columns([
                // 1. Nomor Urut Otomatis
                Tables\Columns\TextColumn::make('index')
                    ->label('No')
                    ->rowIndex()
                    ->alignCenter(),

                // 2. NIK Balita
                Tables\Columns\TextColumn::make('pasien.nik')
                    ->label('NIK')
                    ->searchable()
                    ->fontFamily('mono'),

                // 3. Nama Lengkap Balita
                Tables\Columns\TextColumn::make('pasien.nama')
                    ->label('Nama')
                    ->searchable()
                    ->weight('semibold'),

                // 4. Jenis Kelamin (JK)
                Tables\Columns\TextColumn::make('pasien.jenis_kelamin')
                    ->label('JK')
                    ->alignCenter(),

                // 5. Tanggal Lahir Pasien
                Tables\Columns\TextColumn::make('pasien.tgl_lahir')
                    ->label('Tgl Lahir')
                    ->date('d-m-Y'),

                // 6. Nama Orang Tua / Ibu Kandung
                Tables\Columns\TextColumn::make('pasien.nama_ibu')
                    ->label('Nama Ortu')
                    ->searchable()
                    ->placeholder('-'),

                // 7. Provinsi (Dinamis dari akun petugas login)
                Tables\Columns\TextColumn::make('prov')
                    ->label('Prov')
                    ->state(fn () => auth()->user()?->provinsi ?? '-'),

                // 8. Kabupaten / Kota
                Tables\Columns\TextColumn::make('kab_kota')
                    ->label('Kab/Kota')
                    ->state(fn () => auth()->user()?->kabupaten_kota ?? '-'),

                // 9. Kecamatan
                Tables\Columns\TextColumn::make('kec')
                    ->label('Kec')
                    ->state(fn () => auth()->user()?->kecamatan ?? '-'),

                // 10. Nama Puskesmas Pembina
                Tables\Columns\TextColumn::make('puskesmas')
                    ->label('Puskesmas')
                    ->state(fn () => auth()->user()?->nama_puskesmas ?? '-'),

                // 11. Desa / Kelurahan
                Tables\Columns\TextColumn::make('desa_kel')
                    ->label('Desa/Kel')
                    ->state(fn () => auth()->user()?->desa_kelurahan ?? '-'),

                // 12. Nama Posyandu Terdaftar
                Tables\Columns\TextColumn::make('posyandu')
                    ->label('Posyandu')
                    ->state(fn () => auth()->user()?->nama_posyandu ?? '-'),
            ])

            // 🔍 FILTER KATEGORI DAN PERIODE WAKTU JALUR CEPAT
            ->filters([
                SelectFilter::make('status_gizi')
                    ->label('Kategori Gizi (BB/U)')
                    ->options([
                        'Gizi Buruk' => 'Gizi Buruk',
                        'Gizi Kurang' => 'Gizi Kurang',
                        'Gizi Baik (Normal)' => 'Gizi Baik (Normal)',
                        'Risiko Berat Badan Lebih' => 'Risiko Berat Badan Lebih',
                    ]),

                SelectFilter::make('status_stunting')
                    ->label('Kategori Stunting (TB/U)')
                    ->options([
                        'Sangat Pendek' => 'Sangat Pendek',
                        'Pendek' => 'Pendek',
                        'Normal' => 'Normal',
                    ]),

                Filter::make('tgl_periksa_range')
                    ->label('Periode Pemeriksaan')
                    ->form([
                        Select::make('quick_period')
                            ->label('Pilihan Periode Cepat')
                            ->options([
                                'this_week' => 'Minggu Ini',
                                'this_month' => 'Bulan Ini',
                                'this_year' => 'Tahun Ini',
                            ])->reactive()
                            ->afterStateUpdated(function ($state, $set) {
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
                            ->label('Dari Tanggal (Manual)'),
                        DatePicker::make('sampai_tanggal')
                            ->label('Sampai Tanggal (Manual)'),
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
                Tables\Actions\Action::make('hapus_atau_arsip')
                    ->label('Hapus')
                    ->icon('heroicon-m-trash')
                    ->color('danger')
                    ->modalHeading(fn (PemeriksaanBayi $record) => "Manajemen Status Data: {$record->pasien?->nama}")
                    ->modalWidth('md')
                    ->modalSubmitActionLabel('Konfirmasi & Simpan')
                    ->form([
                        Select::make('status_tindakan')
                            ->label('Alasan Penghapusan / Pengarsipan')
                            ->options([
                                'salah_input' => 'Salah Input (Hapus Permanen)',
                                'pindah' => 'Pindah Domisili / Wilayah (Arsipkan)',
                                'meninggal' => 'Meninggal Dunia (Arsipkan)',
                            ])
                            ->required()
                            ->live(), // Membuat form bersifat reaktif saat opsi dipilih

                        // Opsi 1: Salah Input (Teks Peringatan)
                        Placeholder::make('peringatan_salah_input')
                            ->label('⚠️ PERINGATAN KRITIS')
                            ->content('Data balita beserta seluruh riwayat pemeriksaan bulanan akan DIHAPUS PERMANEN dari database dan tidak dapat dikembalikan.')
                            ->visible(fn ($get) => $get('status_tindakan') === 'salah_input'),

                        // Opsi 2: Keterangan Pindah
                        Textarea::make('keterangan_pindah')
                            ->label('Keterangan Pindah')
                            ->placeholder('Masukkan alasan atau alamat lokasi posyandu tujuan yang baru...')
                            ->required()
                            ->visible(fn ($get) => $get('status_tindakan') === 'pindah'),

                        // Opsi 3: Kondisi Meninggal (Tanggal & Pemakaman)
                        DatePicker::make('tgl_meninggal')
                            ->label('Tanggal Meninggal')
                            ->required()
                            ->maxDate(now())
                            ->visible(fn ($get) => $get('status_tindakan') === 'meninggal'),

                        TextInput::make('tempat_pemakaman')
                            ->label('Tempat Pemakaman')
                            ->placeholder('Contoh: TPU Desa Tambaksari Kidul')
                            ->required()
                            ->visible(fn ($get) => $get('status_tindakan') === 'meninggal'),
                            
                        TextInput::make('penyebab_meninggal')
                            ->label('Penyebab Meninggal (Opsional)')
                            ->placeholder('Contoh: Sakit / Demam Tinggi')
                            ->visible(fn ($get) => $get('status_tindakan') === 'meninggal'),
                    ])
                    ->action(function (PemeriksaanBayi $record, array $data) {
                        $pasien = $record->pasien;

                        if (!$pasien) {
                            Notification::make()->title('Gagal')->body('Hubungan data pasien tidak ditemukan.')->danger()->send();
                            return;
                        }

                        switch ($data['status_tindakan']) {
                            case 'salah_input':
                                // Mengandalkan Database Cascade: Menghapus pasien otomatis menghapus rekam medis terkait
                                $pasien->delete();
                                Notification::make()->title('Berhasil Dihapus')->body('Data balita berhasil dihapus secara permanen dari sistem.')->success()->send();
                                break;

                            case 'pindah':
                                $pasien->update([
                                    'is_arsip' => 1,
                                    'keterangan_pindah' => $data['keterangan_pindah'],
                                ]);
                                Notification::make()->title('Berhasil Diarsipkan')->body('Data balita telah dipindahkan ke menu arsip karena pindah domisili.')->success()->send();
                                break;

                            case 'meninggal':
                                $pasien->update([
                                    'is_arsip' => 1,
                                    'tgl_meninggal' => $data['tgl_meninggal'],
                                    'tempat_pemakaman' => $data['tempat_pemakaman'],
                                    'penyebab_meninggal' => $data['penyebab_meninggal'] ?? null,
                                ]);
                                Notification::make()->title('Berhasil Diarsipkan')->body('Data balita telah dipindahkan ke menu arsip (Meninggal Dunia).')->success()->send();
                                break;
                        }
                    }),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageDatabaseBalitas::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
