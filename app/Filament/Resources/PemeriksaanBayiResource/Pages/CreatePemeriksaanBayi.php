<?php

namespace App\Filament\Resources\PemeriksaanBayiResource\Pages;

use App\Filament\Resources\PemeriksaanBayiResource;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Pasien;
use Carbon\Carbon;

class CreatePemeriksaanBayi extends CreateRecord
{
    protected static string $resource = PemeriksaanBayiResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $pasien = Pasien::find($data['pasien_id']);
        
        if ($pasien) {
            $tglLahir = Carbon::parse($pasien->tgl_lahir);
            $tglPeriksa = Carbon::parse($data['tgl_periksa']);
            $data['usia_bulan'] = $tglLahir->diffInMonths($tglPeriksa);
        }

        // Amankan nilai kosong dari Zona B dan C agar database MySQL tidak menolak saat disimpan pertama kali
        $data['berat_badan'] = $data['berat_badan'] ?? null;
        $data['tinggi_badan'] = $data['tinggi_badan'] ?? null;
        $data['status_gizi'] = null;
        $data['status_stunting'] = null;

        return $data;
    }

    // Setelah Zona A klik Simpan, otomatis lempar balik ke halaman tabel antrean utama
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}