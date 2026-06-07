<?php

namespace App\Filament\Resources\PasienResource\Pages;

use App\Filament\Resources\PasienResource;
use App\Models\Pasien;
use App\Models\PemeriksaanBayi;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;

class CreatePasien extends CreateRecord
{
    protected static string $resource = PasienResource::class;

    // 🚀 INTERVENSI ALUR SIMPAN FILAMENT
    protected function handleRecordCreation(array $data): Model
    {
        // 1. Ambil data asli langsung dari memori form (Termasuk yang di-readonly/disabled)
        $rawState = $this->form->getRawState();
        $tipe = $rawState['tipe_pendaftaran_posyandu'] ?? 'baru_lahir';

        // 🌟 JIKA OPSI 2 (KUNJUNGAN BALITA LAMA)
        if ($tipe === 'pemeriksaan_rutin') {
            $pasienId = $rawState['cari_pasien_id'] ?? null;
            
            if (!$pasienId) {
                Notification::make()->title('Gagal')->description('Silakan pilih data balita terlebih dahulu!')->danger()->send();
                $this->halt();
            }

            // SIMPAN LANGSUNG KE TABEL PEMERIKSAAN (Bypass tabel Pasien)
            PemeriksaanBayi::create([
                'pasien_id' => $pasienId,
                'tgl_periksa' => $rawState['tgl_periksa'] ?? now(),
                'usia_bulan' => $rawState['usia_bulan'] ?? 0,
                'berat_badan' => $rawState['berat_badan'] ?? null,
                'tinggi_badan' => $rawState['tinggi_badan'] ?? null,
                'cara_ukur' => $rawState['cara_ukur'] ?? null,
                'lila' => $rawState['lila'] ?? null,
                'lingkar_kepala' => $rawState['lingkar_kepala'] ?? null,
                'status_gizi' => $rawState['status_gizi'] ?? null,
                'zscore_bbu' => $rawState['zscore_bbu'] ?? null,
                'status_stunting' => $rawState['status_stunting'] ?? null,
                'zscore_tbu' => $rawState['zscore_tbu'] ?? null,
                'status_bbtb' => $rawState['status_bbtb'] ?? null,
                'zscore_bbtb' => $rawState['zscore_bbtb'] ?? null,
                'catatan' => $rawState['catatan'] ?? null,
            ]);

            Notification::make()
                ->title('Berhasil')
                ->description('Data Kunjungan Pemeriksaan Balita Berhasil Disimpan.')
                ->success()
                ->send();

            // 🎯 TRIK ANTI EROR: Berikan model Pasien lama ke Filament agar tidak crash
            return Pasien::find($pasienId);
        }

        // 🌟 JIKA OPSI 1 (BALITA BARU LAHIR)
        // Biarkan Filament menjalankan prosedur standarnya untuk mendaftar pasien baru
        return parent::handleRecordCreation($data);
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}