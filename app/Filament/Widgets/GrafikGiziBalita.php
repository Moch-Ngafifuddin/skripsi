<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\PemeriksaanBayi;

class GrafikGiziBalita extends ChartWidget
{
    protected static ?string $heading = 'Grafik Pemantauan Status Gizi Balita';
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 1;
    public function getType(): string
    {
        return 'bar'; // Menggunakan grafik batang
    }

    protected function getData(): array
    {
        // Hitung total kasus per indikator gizi
        $giziBaik = PemeriksaanBayi::where('status_gizi', 'Gizi Baik')->count();
        $giziKurang = PemeriksaanBayi::where('status_gizi', 'Gizi Kurang')->count();
        $giziBuruk = PemeriksaanBayi::where('status_gizi', 'Gizi Buruk')->count();
        $kurangBb = PemeriksaanBayi::where('status_gizi', 'Kurang BB')->count();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Anak',
                    'data' => [$giziBaik, $giziKurang, $giziBuruk, $kurangBb],
                    'backgroundColor' => ['#34d399', '#fbbf24', '#f87171', '#60a5fa'],
                ],
            ],
            'labels' => ['Gizi Baik', 'Gizi Kurang', 'Gizi Buruk', 'Kurang BB'],
        ];
    }
}