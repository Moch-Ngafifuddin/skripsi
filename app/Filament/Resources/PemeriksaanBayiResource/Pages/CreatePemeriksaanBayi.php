<?php

namespace App\Filament\Resources\PemeriksaanBayiResource\Pages;

use App\Filament\Resources\PemeriksaanBayiResource;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Pasien;
use App\Helpers\AntropometriHelper;
use Carbon\Carbon;

class CreatePemeriksaanBayi extends CreateRecord
{
    protected static string $resource = PemeriksaanBayiResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Ambil data pasien untuk tahu Jenis Kelamin dan Tanggal Lahir
        $pasien = Pasien::find($data['pasien_id']);
        
        if ($pasien) {
            $jk = $pasien->jenis_kelamin;
            
            // Hitung umur bulan secara akurat berdasarkan tanggal periksa & tanggal lahir
            $tglLahir = Carbon::parse($pasien->tgl_lahir);
            $tglPeriksa = Carbon::parse($data['tgl_periksa']);
            $umurBulan = $tglLahir->diffInMonths($tglPeriksa);
            
            // Masukkan umur bulan otomatis ke kolom database
            $data['usia_bulan'] = $umurBulan;

            // Eksekusi Kalkulator Otomatis Antropometri Kemenkes
            $data['status_gizi'] = AntropometriHelper::hitungBbu($jk, $umurBulan, $data['berat_badan']);
            $data['status_stunting'] = AntropometriHelper::hitungTbu($jk, $umurBulan, $data['tinggi_badan']);
        }

        return $data;
    }
} 