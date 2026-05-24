<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Pasien;
use App\Services\FonnteService;

class KirimPengingatPosyandu extends Command
{
    // Nama perintah yang akan dijalankan oleh sistem cron job
    protected $signature = 'posyandu:kirim-pengingat';
    protected $description = 'Mengecek jadwal posyandu hari ini dan mengirimkan WA pengingat otomatis via Fonnte';

    public function handle()
    {
        $hariIni = now()->toDateString();
        $jadwal = DB::table('jadwal_posyandu')->where('tanggal_kegiatan', $hariIni)->first();

        if (!$jadwal) {
            $this->info('Tidak ada jadwal posyandu untuk hari ini.');
            return 0;
        }


        $query = Pasien::query();

        if ($jadwal->kategori_target !== 'semua') {
            if ($jadwal->kategori_target === 'balita') {
                $query->whereHas('pemeriksaanBayi');
            } elseif ($jadwal->kategori_target === 'remaja') {
                $query->whereHas('pemeriksaanRemaja');
            } elseif ($jadwal->kategori_target === 'lansia') {
                $query->whereHas('pemeriksaanLansia');
            }
        }

        $nomorHp = $query->whereNotNull('no_hp')->where('no_hp', '!=', '')->pluck('no_hp')->toArray();

        if (count($nomorHp) === 0) {
            $this->warn('Ada jadwal, tetapi tidak ada nomor HP sasaran di database.');
            return 0;
        }

        // 3. Susun Template Pesan Otomatis
        $pesanTemplate = "📢 *PENGINGAT KEGIATAN POSYANDU* 📢\n\n" .
                         "Halo Bapak/Ibu/Saudara,\n" .
                         "Mengingatkan bahwa HARI INI akan dilaksanakan kegiatan: *{$jadwal->nama_kegiatan}*.\n\n" .
                         "📅 Tanggal: " . now()->format('d M Y') . "\n" .
                         "⏰ Waktu: 08:00 WIB s/d Selesai\n\n" .
                         "Mohon kehadirannya dengan membawa berkas/buku KIA/KMS yang diperlukan. Terima kasih.";

        $targetBlast = implode(',', $nomorHp);

        // 4. Kirim otomatis via Fonnte
        FonnteService::kirimPesan($targetBlast, $pesanTemplate);
        
        $this->info('Pesan otomatis jadwal posyandu berhasil dikirim ke ' . count($nomorHp) . ' target.');
        return 0;
    }
}