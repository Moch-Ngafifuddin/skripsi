<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Pasien;
use App\Models\PemeriksaanBayi;
use App\Models\PemeriksaanRemaja;
use App\Models\PemeriksaanLansia;

class StatistikUtama extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Pasien Terdaftar', Pasien::count() . ' Orang')
                ->description('Jumlah seluruh warga di database')
                ->descriptionIcon('heroicon-m-users')
                ->color('info'),

            Stat::make('Kasus Balita Stunting', PemeriksaanBayi::where('status_stunting', 'Stunting')->count() . ' Anak')
                ->description('Memerlukan perhatian gizi khusus')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('danger'),

            Stat::make('Remaja Indikasi Anemia', PemeriksaanRemaja::where('kadar_hb', '<', 12.0)->count() . ' Orang')
                ->description('Berdasarkan screening Hb < 12')
                ->descriptionIcon('heroicon-m-heart')
                ->color('warning'),

            Stat::make('Lansia Hipertensi', PemeriksaanLansia::where('sistole', '>=', 140)->count() . ' Orang')
                ->description('Berdasarkan Tensi >= 140 mmHg')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('danger'),
        ];
    }
}