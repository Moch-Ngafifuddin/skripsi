<?php

namespace App\Filament\Widgets;

use App\Models\Pasien;
use App\Models\PemeriksaanBayi;
use App\Models\PemeriksaanLansia;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        // Hitung Pasien Baru Bulan Ini
        $pasienBaru = Pasien::whereMonth('created_at', Carbon::now()->month)->count();

        // Hitung Kunjungan Bayi Bulan Ini
        $bayiBulanIni = PemeriksaanBayi::whereMonth('tgl_periksa', Carbon::now()->month)->count();

        // Hitung Kunjungan Lansia Bulan Ini
        $lansiaBulanIni = PemeriksaanLansia::whereMonth('tgl_periksa', Carbon::now()->month)->count();

        return [
            // Kartu 1: Total Semua Pasien
            Stat::make('Total Pasien', Pasien::count())
                ->description($pasienBaru . ' pasien baru bulan ini')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 17]), // Grafik hiasan

            // Kartu 2: Kunjungan Balita (Bulan Ini)
            Stat::make('Posyandu Balita', $bayiBulanIni)
                ->description('Kunjungan bulan ini')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('info'),

            // Kartu 3: Kunjungan Lansia (Bulan Ini)
            Stat::make('Posyandu Lansia', $lansiaBulanIni)
                ->description('Kunjungan bulan ini')
                ->descriptionIcon('heroicon-m-heart')
                ->color('warning'),
        ];
    }
}