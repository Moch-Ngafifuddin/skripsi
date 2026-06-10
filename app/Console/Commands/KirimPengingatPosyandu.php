<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\JadwalPosyandu;
use App\Models\Pasien;
use App\Services\LayananFonnte;
use Carbon\Carbon;
use App\Jobs\ProsesKirimWa;

class KirimPengingatPosyandu extends Command
{
    protected $signature = 'posyandu:kirim-reminder';
    protected $description = 'Mengirim pesan WA pengingat otomatis H-1 acara kepada masyarakat secara real-time';

    public function handle()
    {
        $besok = Carbon::tomorrow()->toDateString();
        $jamSekarang = Carbon::now('Asia/Jakarta')->format('H:i'); 

        $this->warn("🔍 [STANDBY] Mengecek agenda tanggal: {$besok} tepat pada jam {$jamSekarang} WIB...");

        $jadwals = JadwalPosyandu::where('tanggal_acara', $besok)
        ->where('is_aktif', 1)
        ->whereRaw("TIME_FORMAT(jam_kirim_pesan, '%H:%i') = ?", [$jamSekarang])
        ->get();

        if ($jadwals->isEmpty()) {
            return;
        }

        $this->info("✅ Ditemukan {$jadwals->count()} agenda! Memulai enkapsulasi data & pengiriman...");
        $totalTerkirim = 0;

        foreach ($jadwals as $jadwal) {
            $this->line("➤ Memproses agenda: {$jadwal->judul_agenda}");
            
            $pasiens = collect();
            if ($jadwal->kategori_target === 'balita') {
                $pasiens = Pasien::where('is_arsip', 0)
                    ->whereNotNull('no_hp')
                    ->where('no_hp', '!=', '')
                    ->get();
            }

            if ($pasiens->isEmpty()) {
                continue;
            }

            foreach ($pasiens as $pasien) {
                $tanggalFormat = Carbon::parse($jadwal->tanggal_acara)->translatedFormat('l, d F Y');
                $waktuFormat = Carbon::parse($jadwal->waktu_acara)->format('H:i') . ' WIB';

                // SINKRONISASI SHORTCODE: Mendukung variasi shortcode di form UI Filament
                $pesanFinal = $jadwal->isi_pesan;
                $pesanFinal = str_replace('{nama_ibu}', $pasien->nama_ibu ?? 'Ibu Pasien', $pesanFinal);
                $pesanFinal = str_replace('{nama_balita}', $pasien->nama, $pesanFinal);
                $pesanFinal = str_replace('{nama}', $pasien->nama, $pesanFinal); // Fallback shortcode lama
                $pesanFinal = str_replace('{tanggal}', $tanggalFormat, $pesanFinal);
                $pesanFinal = str_replace('{waktu}', $waktuFormat, $pesanFinal);
                $pesanFinal = str_replace('{tempat}', $jadwal->tempat_acara, $pesanFinal);
                $pesanFinal = str_replace('{judul_agenda}', $jadwal->judul_agenda, $pesanFinal);

                // IMPLEMENTASI DATA MASKING (Standar Keamanan Privasi Internasional / GDPR compliance)
                // Contoh: "Aditya Wijaya" menjadi "Ad**** W*****" dan nomor "081234567890" menjadi "0812****7890"
                $namaMasking = preg_replace('/(?<=\ \w)\w|(?<=\w{2})\w/i', '*', $pasien->nama);
                $noHp = $pasien->no_hp;
                $noHpMasking = substr($noHp, 0, 4) . '****' . substr($noHp, -4);

                // Eksekusi kirim via Fonnte
                ProsesKirimWa::dispatch($noHp, $pesanFinal);
                $totalTerkirim++;
                $this->info("   [QUEUE] Pesan untuk target {$namaMasking} berhasil dimasukkan ke antrean sistem.");
                
                if (is_array($proses) && isset($proses['status']) && $proses['status'] === true) {
                    $totalTerkirim++;
                    $this->info("   [TERKIRIM] Berhasil menyiarkan pesan ke target: {$namaMasking} ({$noHpMasking})");
                } else {
                    // Log kegagalan terminal aman dari pencurian data PII
                    $this->error("   [GAGAL] API Fonnte menolak enkapsulasi data nomor: {$noHpMasking}");
                }
            }
        }

        $this->info("🚀 Selesai! Total siaran pesan aman terkirim ke Gateway: {$totalTerkirim}");
    }
}