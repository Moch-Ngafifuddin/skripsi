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
use App\Services\LayananFonnte;
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

                        // INPUTAN VARIABEL BARU
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
                    ])->columns(2), // Dibagi menjadi 2 kolom agar rapi
            ])
            ->statePath('data');
    }

    public function eksekusiKirim(): void
    {

        set_time_limit(0); 
        
        $formData = $this->form->getState();
        $kategori = $formData['target_kategori'];
        $pesanMentah = $formData['isi_pesan'];
        
        $tanggalFormat = Carbon::parse($formData['tanggal_kegiatan'])->translatedFormat('l, d F Y');
        $lokasiFormat = $formData['lokasi_kegiatan'];

        // Tarik Data Pasien
        $query = Pasien::query();

        // Mengambil pasien yang nomor HP-nya tidak kosong (Asumsi tabel Pasien adalah data anak balita)
        $pasiens = $query->whereNotNull('no_hp')->where('no_hp', '!=', '')->get();

        if ($pasiens->count() === 0) {
            Notification::make()
                ->title('Gagal Mengirim')
                ->body('Tidak ditemukan nomor HP aktif di database.')
                ->danger()
                ->send();
            return;
        }

        $suksesKirim = 0;
        
        foreach ($pasiens as $pasien) {
            $pesanFinal = str_replace('{nama}', $pasien->nama, $pesanMentah);
            $pesanFinal = str_replace('{tanggal}', $tanggalFormat, $pesanFinal);
            $pesanFinal = str_replace('{lokasi}', $lokasiFormat, $pesanFinal);

            $proses = LayananFonnte::kirimPesan($pasien->no_hp, $pesanFinal);
            
            // Fonnte API biasanya mengembalikan array 'status' bertipe boolean
            if (is_array($proses) && isset($proses['status']) && $proses['status'] === true) {
                $suksesKirim++;
            }
        }

        if ($suksesKirim > 0) {
            Notification::make()
                ->title('Berhasil!')
                ->body("Sebanyak {$suksesKirim} pesan WhatsApp berhasil disiarkan ke target.")
                ->success()
                ->send();

            $this->form->fill();
        } else {
            Notification::make()
                ->title('Pengiriman Gagal')
                ->body('Pesan gagal dikirim. Periksa kuota token Fonnte atau koneksi internet Anda.')
                ->danger()
                ->send();
        }
    }
}