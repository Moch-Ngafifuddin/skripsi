<?php

namespace App\Helpers;

use App\Models\MasterBbu;
use App\Models\MasterTbu;
use App\Models\MasterBbtb;

class AntropometriHelper
{
    /**
     * Hitung Rumus Baku Z-Score Kemenkes / WHO
     */
    private static function hitungZScore($nilaiRiil, $master)
    {
        if (!$master) return null;

        $median = $master->median;

        if ($nilaiRiil == $median) {
            return 0;
        } elseif ($nilaiRiil > $median) {
            // Jika nilai anak di atas median, pembaginya adalah (+1 SD - Median)
            return ($nilaiRiil - $median) / ($master->plus_1_sd - $median);
        } else {
            // Jika nilai anak di bawah median, pembaginya adalah (Median - -1 SD)
            return ($nilaiRiil - $median) / ($median - $master->minus_1_sd);
        }
    }

    /**
     * 1. Klasifikasi BB/U (Status Berat Badan)
     */
    public static function hitungBbu($jk, $umurBulan, $bb)
    {
        if (is_null($bb) || is_null($umurBulan)) return null;

        $master = MasterBbu::where('jenis_kelamin', $jk)->where('umur_bulan', $umurBulan)->first();
        $zscore = self::hitungZScore($bb, $master);

        if (is_null($zscore)) return 'Data Master Tidak Ditemukan';

        if ($zscore < -3) return 'Berat Badan Sangat Kurang';
        if ($zscore >= -3 && $zscore < -2) return 'Berat Badan Kurang';
        if ($zscore >= -2 && $zscore <= 1) return 'Berat Badan Normal';
        return 'Risiko Berat Badan Lebih';
    }

    /**
     * 2. Klasifikasi TB/U atau PB/U (Status Stunting)
     */
    public static function hitungTbu($jk, $umurBulan, $tb)
    {
        if (is_null($tb) || is_null($umurBulan)) return null;

        $master = MasterTbu::where('jenis_kelamin', $jk)->where('umur_bulan', $umurBulan)->first();
        $zscore = self::hitungZScore($tb, $master);

        if (is_null($zscore)) return 'Data Master Tidak Ditemukan';

        if ($zscore < -3) return 'Sangat Pendek (Severely Stunted)';
        if ($zscore >= -3 && $zscore < -2) return 'Pendek (Stunted)';
        if ($zscore >= -2 && $zscore <= 3) return 'Normal';
        return 'Tinggi';
    }
}