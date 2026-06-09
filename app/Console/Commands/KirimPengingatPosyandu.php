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
        // 1. Dapatkan tanggal besok dan JAM:MENIT saat ini
        $besok = Carbon::tomorrow()->toDateString();
        
        // Memaksa timezone WIB (Waktu Indonesia Barat) agar cocok dengan jam laptop/server Indonesia
        $jamSekarang = Carbon::now('Asia/Jakarta')->format('H:i'); 

        $this->warn("🔍 Mengecek agenda tanggal: {$besok} tepat pada jam {$jamSekarang} WIB...");

        // 2. Filter berdasarkan Tanggal Acara (Besok) DAN Jam Kirim (Sekarang)
        $jadwals = JadwalPosyandu::where('tanggal_acara', $besok)
            ->where('is_aktif', 1)
            ->where('jam_kirim_pesan', 'like', $jamSekarang . '%') // Trik membaca jam & menit, mengabaikan detik
            ->get();

        if ($jadwals->isEmpty()) {
            $this->error("❌ Standby: Tidak ada agenda jadwal posyandu untuk dikirim pada jam {$jamSekarang} WIB.");
            return;
        }

        $this->info("✅ Ditemukan {$jadwals->count()} agenda! Memulai pengiriman otomatis...");
        
        $totalTerkirim = 0;

        foreach ($jadwals as $jadwal) {
            $this->line("➤ Memproses agenda: {$jadwal->judul_agenda}");
            
            $pasiens = collect();
            if ($jadwal->kategori_target === 'balita') {
                // Tarik balita yang aktif dan Punya Nomor HP
                $pasiens = Pasien::where('is_arsip', 0)
                    ->whereNotNull('no_hp')
                    ->where('no_hp', '!=', '')
                    ->get();
            }

            if ($pasiens->isEmpty()) {
                $this->error("   ⚠️ Peringatan: Tidak ada nomor HP aktif untuk kategori {$jadwal->kategori_target}.");
                continue;
            }

            foreach ($pasiens as $pasien) {
                // 3. Format tanggal dan waktu ke bahasa Indonesia
                $tanggalFormat = Carbon::parse($jadwal->tanggal_acara)->translatedFormat('l, d F Y');
                $waktuFormat = Carbon::parse($jadwal->waktu_acara)->format('H:i') . ' WIB';

                // 4. Ganti semua variabel/shortcode dengan data aslinya
                $pesanFinal = $jadwal->isi_pesan;
                $pesanFinal = str_replace('{nama}', $pasien->nama, $pesanFinal);
                $pesanFinal = str_replace('{tanggal}', $tanggalFormat, $pesanFinal);
                $pesanFinal = str_replace('{waktu}', $waktuFormat, $pesanFinal);
                $pesanFinal = str_replace('{tempat}', $jadwal->tempat_acara, $pesanFinal);
                $pesanFinal = str_replace('{judul_agenda}', $jadwal->judul_agenda, $pesanFinal);

                // 5. Eksekusi kirim via Fonnte API
                $proses = LayananFonnte::kirimPesan($pasien->no_hp, $pesanFinal);
                
                if (is_array($proses) && isset($proses['status']) && $proses['status'] === true) {
                    $totalTerkirim++;
                    $this->info("   [TERKIRIM] Berhasil mengirim ke {$pasien->nama} ({$pasien->no_hp})");
                } else {
                    $this->error("   [GAGAL] Server Fonnte menolak nomor {$pasien->nama} ({$pasien->no_hp})");
                }
            }
        }

        $this->info("🚀 Selesai! Total pesan terkirim ke Fonnte: {$totalTerkirim}");
    }
}