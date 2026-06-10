<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use App\Models\Pasien;
use App\Models\TemplatePesan;
use App\Jobs\ProsesKirimWa; // Mengintegrasikan file Job Antrean
use Carbon\Carbon;

class KirimWaMassal extends Page implements \Filament\Forms\Contracts\HasForms
{
    use \Filament\Forms\Concerns\InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationLabel = 'Kirim WA Massal';
    protected static ?string $navigationGroup = 'Pelayanan';
    protected static ?int $navigationSort = 4;

    protected static string $view = 'filament.pages.kirim-wa-massal';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Kirim Pesan Massal (Siaran)')
                    ->description('Pilih kelompok target, isi variabel jadwal, dan kirim pesan secara otomatis.')
                    ->schema([
                        Select::make('target_kategori')
                            ->label('Target Kategori Pasien / Orang Tua')
                            ->options([
                                'semua' => 'Semua Pasien',
                                'balita' => 'Khusus Orang Tua Balita',
                                'remaja' => 'Khusus Remaja',
                                'lansia' => 'Khusus Lansia',
                            ])
                            ->required(),

                        Select::make('pilihan_template')
                            ->label('Pilih Template Pesan')
                            ->options(function () {
                                return TemplatePesan::pluck('nama_template', 'id')->toArray();
                            })
                            ->placeholder('Pilih template dari database...')
                            ->live()
                            ->afterStateUpdated(function ($state, callable $set) {
                                if ($state) {
                                    $template = TemplatePesan::find($state);
                                    if ($template) {
                                        $set('isi_pesan', $template->isi_pesan);
                                    }
                                }
                            }),

                        DatePicker::make('tanggal_kegiatan')
                            ->label('Tanggal Jadwal Pelayanan')
                            ->default(now())
                            ->required(),

                        TextInput::make('lokasi_kegiatan')
                            ->label('Lokasi Pelayanan / Posyandu')
                            ->placeholder('Contoh: Gedung Olahraga Bancarkembar')
                            ->required(),

                        Textarea::make('isi_pesan')
                            ->label('Struktur Isi Pesan')
                            ->helperText('Jangan hapus kode {tanggal} dan {lokasi} karena akan otomatis diganti oleh sistem.')
                            ->rows(8)
                            ->required(),
                    ])->columns(2),
            ])
            ->statePath('data');
    }

    public function eksekusiKirim(): void
    {
        $formData = $this->form->getState();
        $kategori = $formData['target_kategori'];
        $pesanMentah = $formData['isi_pesan'];
        
        $tanggalFormat = Carbon::parse($formData['tanggal_kegiatan'])->translatedFormat('l, d F Y');
        $lokasiFormat = $formData['lokasi_kegiatan'];

        // 1. Inisialisasi Query Pasien Aktif
        $query = Pasien::query()->where('is_arsip', 0);

        // 2. SOLUSI BUG 1: Memproses Filter Kategori Sesuai Pilihan UI
        if ($kategori !== 'semua') {
            // Catatan: Sesuaikan nama kolom penanda kategori pada tabel pasien Anda (misal: 'kategori' atau 'jenis_pasien')
            $query->where('kategori', $kategori); 
        }

        // Ambil pasien yang nomor HP-nya tidak kosong
        $pasiens = $query->whereNotNull('no_hp')->where('no_hp', '!=', '')->get();

        if ($pasiens->count() === 0) {
            Notification::make()
                ->title('Gagal Mengirim')
                ->body('Tidak ditemukan nomor HP aktif untuk kategori target tersebut di database.')
                ->danger()
                ->send();
            return;
        }

        $totalAntrean = 0;
        
        foreach ($pasiens as $pasien) {
            $pesanFinal = str_replace('{nama}', $pasien->nama, $pesanMentah);
            $pesanFinal = str_replace('{tanggal}', $tanggalFormat, $pesanFinal);
            $pesanFinal = str_replace('{lokasi}', $lokasiFormat, $pesanFinal);

            // SOLUSI BUG 2: Alihkan dari synchronous API ke Queue Job Asinkronus
            ProsesKirimWa::dispatch($pasien->no_hp, $pesanFinal);
            $totalAntrean++;
        }

        if ($totalAntrean > 0) {
            Notification::make()
                ->title('Berhasil Masuk Antrean!')
                ->body("Sebanyak {$totalAntrean} pesan WhatsApp dijadwalkan dalam sistem antrean background job.")
                ->success()
                ->send();

            $this->form->fill();
        }
    }
}