<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Pasien;

class GrafikKategoriPasien extends ChartWidget
{
    protected static ?string $heading = 'Komposisi Kategori Pasien';
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 1; 

    public function getType(): string
    {
        return 'doughnut';
    }
    protected function getOptions(): array
    {
        return [
            'maintainAspectRatio' => true,
            'aspectRatio' => 2,
            'plugins' => [
                'legend' => [
                    'position' => 'bottom',
                ],
            ],
        ];
    }

    protected function getData(): array
    {
        $totalBalita = Pasien::whereHas('pemeriksaanBayi')->count();
        $totalRemaja = Pasien::whereHas('pemeriksaanRemaja')->count();
        $totalLansia = Pasien::whereHas('pemeriksaanLansia')->count();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Pasien',
                    'data' => [$totalBalita, $totalRemaja, $totalLansia],
                    'backgroundColor' => ['#ec4899', '#3b82f6', '#10b981'],
                ],
            ],
            'labels' => ['Balita', 'Remaja', 'Lansia'],
        ];
    }
}