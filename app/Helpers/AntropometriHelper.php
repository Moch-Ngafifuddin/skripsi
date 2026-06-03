<?php

namespace App\Helpers;

use App\Models\MasterBbu;
use App\Models\MasterTbu;
use Illuminate\Support\Facades\Cache;

class AntropometriHelper
{
    // Fungsi internal matematika rujukan Kemenkes/WHO
    private static function hitungZScore($nilaiRiil, $master)
    {
        if (!$master) return null;
        
        $median = (float) $master->median;
        $nilaiRiil = (float) $nilaiRiil;

        if ($nilaiRiil == $median) return 0;
        
        if ($nilaiRiil > $median) {
            $pembagi = (float) $master->plus_1_sd - $median;
            return $pembagi != 0 ? ($nilaiRiil - $median) / $pembagi : 0;
        } else {
            $pembagi = $median - (float) $master->minus_1_sd;
            return $pembagi != 0 ? ($nilaiRiil - $median) / $pembagi : 0;
        }
    }

    // 🟢 AKSES PUBLIK: Mendapatkan nilai angka desimal Z-Score BB/U
    public static function hitungZScoreBBU($jk, $umurBulan, $bb)
    {
        if (!is_numeric($bb) || !is_numeric($umurBulan) || empty($jk)) return null;
        
        $umurBulan = (int) $umurBulan;
        $bbuCache = Cache::rememberForever('master_bbu_all', function () {
            return MasterBbu::all();
        });

        $master = $bbuCache->where('jenis_kelamin', $jk)->where('umur_bulan', $umurBulan)->first();
        return self::hitungZScore($bb, $master);
    }

    // 🟢 AKSES PUBLIK: Mendapatkan nilai angka desimal Z-Score TB/U
    public static function hitungZScoreTBU($jk, $umurBulan, $tb)
    {
        if (!is_numeric($tb) || !is_numeric($umurBulan) || empty($jk)) return null;
        
        $umurBulan = (int) $umurBulan;
        $tbuCache = Cache::rememberForever('master_tbu_all', function () {
            return MasterTbu::all();
        });

        $master = $tbuCache->where('jenis_kelamin', $jk)->where('umur_bulan', $umurBulan)->first();
        return self::hitungZScore($tb, $master);
    }

    // Mendapatkan Klasifikasi Teks Status Gizi (BB/U)
    public static function hitungBbu($jk, $umurBulan, $bb)
    {
        $zscore = self::hitungZScoreBBU($jk, $umurBulan, $bb);

        if (is_null($zscore)) return 'Data Master Tidak Ditemukan';

        if ($zscore < -3) return 'Berat Badan Sangat Kurang';
        if ($zscore >= -3 && $zscore < -2) return 'Berat Badan Kurang';
        if ($zscore >= -2 && $zscore <= 1) return 'Berat Badan Normal';
        return 'Risiko Berat Badan Lebih';
    }

    // Mendapatkan Klasifikasi Teks Status Stunting (TB/U)
    public static function hitungTbu($jk, $umurBulan, $tb)
    {
        $zscore = self::hitungZScoreTBU($jk, $umurBulan, $tb);

        if (is_null($zscore)) return 'Data Master Tidak Ditemukan';

        if ($zscore < -3) return 'Sangat Pendek (Severely Stunted)';
        if ($zscore >= -3 && $zscore < -2) return 'Pendek (Stunted)';
        if ($zscore >= -2 && $zscore <= 3) return 'Normal';
        return 'Tinggi';
    }
}