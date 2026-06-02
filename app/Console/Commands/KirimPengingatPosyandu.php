<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\JadwalPosyandu;
use App\Models\Pasien;
use App\Services\LayananFonnte;
use Carbon\Carbon;

class KirimPengingatPosyandu extends Command
{

    protected $signature = 'posyandu:kirim-reminder';
    protected $description = 'Mengirim pesan WA pengingat otomatis H-1 acara kepada masyarakat berdasarkan kategori target';

    public function handle()
    {

        $besok = Carbon::tomorrow()->toDateString();
        
        $jadwals = JadwalPosyandu::where('tanggal_acara', $besok)
            ->where('is_aktif', 1) 
            ->get();

        foreach ($jadwals ?? [] as $jadwal) {

            $pasiens = [];
            if ($jadwal->kategori_target === 'balita') {
                $pasiens = Pasien::where('is_arsip', 0)->get();
            }

            foreach ($pasiens ?? [] as $pasien) {
                if (empty($pasien->no_hp)) continue;

                $pesanFinal = str_replace('{nama}', $pasien->nama, $jadwal->isi_pesan);

                LayananFonnte::kirimPesan($pasien->no_hp, $pesanFinal);
            }
        }

        $this->info('Proses otomatisasi reminder H-1 selesai disiarkan.');
    }
}