<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\PemeriksaanBayi;

class GrafikGiziBalita extends ChartWidget
{
    protected static ?string $heading = 'Grafik Distribusi Kondisi Gizi per Kelompok Umur';
    protected int | string | array $columnSpan = 1;

    public function getType(): string
    {
        return 'bar'; // Tetap menggunakan grafik batang
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'position' => 'top',
                ],
            ],
            'scales' => [
                'x' => [
                    'stacked' => true, // Membuat batang menumpuk ke atas agar rapi
                ],
                'y' => [
                    'stacked' => true,
                    'ticks' => [
                        'stepSize' => 1, // Skala kenaikan angka grafik per 1 anak
                    ],
                ],
            ],
        ];
    }

    protected function getData(): array
    {
        // 1. Ambil rekam pemeriksaan paling terbaru dari setiap anak agar tidak double hitung
        $pemeriksaanTerbaruIds = PemeriksaanBayi::latest('tgl_periksa')
            ->get()
            ->unique('pasien_id')
            ->pluck('id');

        // 2. Definisikan 4 Kelompok Umur Bulan berdasarkan Fase Buku KIA Kemenkes
        $kelompokUmur = [
            '0-11 Bulan'  => [0, 11],
            '12-23 Bulan' => [12, 23],
            '24-35 Bulan' => [24, 35],
            '36-59 Bulan' => [36, 59],
        ];

        // Penampung array jumlah anak untuk masing-masing baris status gizi
        $dataNormal = [];
        $dataBermasalah = [];

        foreach ($kelompokUmur as $label => $range) {
            // Hitung anak yang Normal di range umur tersebut
            $dataNormal[] = PemeriksaanBayi::whereIn('id', $pemeriksaanTerbaruIds)
                ->whereBetween('usia_bulan', [$range[0], $range[1]])
                ->where('status_gizi', 'Berat Badan Normal')
                ->count();

            // Hitung anak yang Bermasalah (Sangat Kurang / Kurang / Risiko Lebih) di range umur tersebut
            $dataBermasalah[] = PemeriksaanBayi::whereIn('id', $pemeriksaanTerbaruIds)
                ->whereBetween('usia_bulan', [$range[0], $range[1]])
                ->whereIn('status_gizi', [
                    'Berat Badan Sangat Kurang',
                    'Berat Badan Kurang',
                    'Risiko Berat Badan Lebih'
                ])
                ->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'BB Normal / Ideal',
                    'data' => $dataNormal,
                    'backgroundColor' => '#34d399', // Warna Hijau Sehat
                ],
                [
                    'label' => 'BB Bermasalah (Kurang/Sangat Kurang/Lebih)',
                    'data' => $dataBermasalah,
                    'backgroundColor' => '#f87171', // Warna Merah Peringatan
                ],
            ],
            // Label bawah grafik diganti mutlak menjadi kelompok umur bulan anak
            'labels' => array_keys($kelompokUmur),
        ];
    }
}