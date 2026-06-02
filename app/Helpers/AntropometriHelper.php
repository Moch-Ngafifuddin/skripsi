<?php

namespace App\Helpers;

use App\Models\MasterBbu;
use App\Models\MasterTbu;

class AntropometriHelper
{
    // Wadah penampung data di memori (biar query database cuma 1 kali saja)
    private static $bbuCache = null;
    private static $tbuCache = null;

    private static function hitungZScore($nilaiRiil, $master)
    {
        if (!$master) return null;
        $median = $master->median;

        if ($nilaiRiil == $median) return 0;
        
        if ($nilaiRiil > $median) {
            $pembagi = $master->plus_1_sd - $median;
            return $pembagi != 0 ? ($nilaiRiil - $median) / $pembagi : 0;
        } else {
            $pembagi = $median - $master->minus_1_sd;
            return $pembagi != 0 ? ($nilaiRiil - $median) / $pembagi : 0;
        }
    }

    public static function hitungBbu($jk, $umurBulan, $bb)
    {
        if (is_null($bb) || is_null($umurBulan)) return null;

        // Jika cache kosong, ambil semua data master sekaligus
        if (self::$bbuCache === null) {
            self::$bbuCache = MasterBbu::all();
        }

        // Cari data menggunakan Collection PHP (Bukan Query SQL Baru!)
        $master = self::$bbuCache->where('jenis_kelamin', $jk)->where('umur_bulan', $umurBulan)->first();
        $zscore = self::hitungZScore($bb, $master);

        if (is_null($zscore)) return 'Data Master Tidak Ditemukan';

        if ($zscore < -3) return 'Berat Badan Sangat Kurang';
        if ($zscore >= -3 && $zscore < -2) return 'Berat Badan Kurang';
        if ($zscore >= -2 && $zscore <= 1) return 'Berat Badan Normal';
        return 'Risiko Berat Badan Lebih';
    }

    public static function hitungTbu($jk, $umurBulan, $tb)
    {
        if (is_null($tb) || is_null($umurBulan)) return null;

        // Jika cache kosong, ambil semua data master sekaligus
        if (self::$tbuCache === null) {
            self::$tbuCache = MasterTbu::all();
        }

        // Cari data menggunakan Collection PHP (Bukan Query SQL Baru!)
        $master = self::$tbuCache->where('jenis_kelamin', $jk)->where('umur_bulan', $umurBulan)->first();
        $zscore = self::hitungZScore($tb, $master);

        if (is_null($zscore)) return 'Data Master Tidak Ditemukan';

        if ($zscore < -3) return 'Sangat Pendek (Severely Stunted)';
        if ($zscore >= -3 && $zscore < -2) return 'Pendek (Stunted)';
        if ($zscore >= -2 && $zscore <= 3) return 'Normal';
        return 'Tinggi';
    }
}