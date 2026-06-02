<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\PemeriksaanBayi;

class GrafikDonatGizi extends ChartWidget
{

    protected static ?string $heading = 'Persentase Status Gizi & Stunting Balita';
    protected int | string | array $columnSpan = 1; 

    public function getType(): string
    {
        return 'doughnut'; // Mengunci tipe grafik menjadi lingkaran donat
    }

    protected function getOptions(): array
    {
        return [
            'maintainAspectRatio' => true,
            'aspectRatio' => 2,
            'plugins' => [
                'legend' => [
                    'position' => 'bottom', // Meletakkan keterangan label di bagian bawah grafik
                ],
            ],
        ];
    }

    protected function getData(): array
    {
        // 1. Ambil rekam pemeriksaan paling terbaru dari setiap anak
        $pemeriksaanTerbaruIds = PemeriksaanBayi::latest('tgl_periksa')
            ->get()
            ->unique('pasien_id')
            ->pluck('id');

        // 2. Hitung jumlah riil balita pada masing-masing kategori
        $totalStunting = PemeriksaanBayi::whereIn('id', $pemeriksaanTerbaruIds)
            ->whereIn('status_stunting', ['Sangat Pendek (Severely Stunted)', 'Pendek (Stunted)'])
            ->count();

        $totalGiziBuruk = PemeriksaanBayi::whereIn('id', $pemeriksaanTerbaruIds)
            ->where('status_gizi', 'Berat Badan Sangat Kurang')
            ->count();

        $totalBbKurang = PemeriksaanBayi::whereIn('id', $pemeriksaanTerbaruIds)
            ->where('status_gizi', 'Berat Badan Kurang')
            ->count();

        $totalGiziNormal = PemeriksaanBayi::whereIn('id', $pemeriksaanTerbaruIds)
            ->where('status_gizi', 'Berat Badan Normal')
            ->count();

        $totalObesitas = PemeriksaanBayi::whereIn('id', $pemeriksaanTerbaruIds)
            ->where('status_gizi', 'Risiko Berat Badan Lebih')
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Persentase Balita',
                    // Data angka riil yang dimasukkan ke chart (Chart.js otomatis mengubahnya menjadi % di browser)
                    'data' => [
                        $totalStunting, 
                        $totalGiziBuruk, 
                        $totalBbKurang, 
                        $totalGiziNormal, 
                        $totalObesitas
                    ],
                    // Pengaturan warna standar klinis (Merah untuk masalah berat, Kuning/Oranye untuk waspada, Hijau untuk aman)
                    'backgroundColor' => [
                        '#ef4444', // Red-500: Balita Stunting
                        '#b91c1c', // Red-700: Gizi Buruk
                        '#f59e0b', // Amber-500: Berat Badan Kurang
                        '#10b981', // Emerald-500: Gizi Normal
                        '#3b82f6', // Blue-500: Risiko Obesitas
                    ],
                ],
            ],
            // Label penunjuk warna donat
            'labels' => [
                'Stunting (Pendek)', 
                'Gizi Buruk', 
                'Berat Badan Kurang', 
                'Gizi Normal', 
                'Risiko Obesitas'
            ],
        ];
    }
}