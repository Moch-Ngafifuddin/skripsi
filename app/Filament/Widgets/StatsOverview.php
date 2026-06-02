<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Pasien;
use App\Models\PemeriksaanBayi;
use App\Filament\Resources\PemeriksaanBayiResource;

class StatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '10s';

    protected function getStats(): array
    {
        // 1. Ambil data pemeriksaan terbaru untuk setiap anak agar tidak double hitung jika anak diperiksa beberapa kali
        $pemeriksaanTerbaruIds = PemeriksaanBayi::latest('tgl_periksa')
            ->get()
            ->unique('pasien_id')
            ->pluck('id');

        // 2. Hitung statistik berdasarkan standar Kemenkes RI
        $totalBalitaAktif = Pasien::where('is_arsip', 0)->count();

        $giziBuruk = PemeriksaanBayi::whereIn('id', $pemeriksaanTerbaruIds)->where('status_gizi', 'Berat Badan Sangat Kurang')->count();
        $bbKurang  = PemeriksaanBayi::whereIn('id', $pemeriksaanTerbaruIds)->where('status_gizi', 'Berat Badan Kurang')->count();
        $giziNormal = PemeriksaanBayi::whereIn('id', $pemeriksaanTerbaruIds)->where('status_gizi', 'Berat Badan Normal')->count();
        $giziLebih  = PemeriksaanBayi::whereIn('id', $pemeriksaanTerbaruIds)->where('status_gizi', 'Risiko Berat Badan Lebih')->count();

        $stunting  = PemeriksaanBayi::whereIn('id', $pemeriksaanTerbaruIds)->whereIn('status_stunting', [
            'Sangat Pendek (Severely Stunted)', 
            'Pendek (Stunted)'
        ])->count();

        // 3. Ambil URL index PemeriksaanBayiResource sebagai basic link drill-down
        $resourceUrl = PemeriksaanBayiResource::getUrl('index');

        return [
            // --- TOTAL BALITA ---
            Stat::make('Total Balita Aktif', $totalBalitaAktif . ' Anak')
                ->description('Semua balita terdaftar aktif')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('info')
                ->url($resourceUrl), // Klik untuk melihat semua data pemeriksaan

            // --- KLASIFIKASI STUNTING (TB/U) ---
            Stat::make('Balita Stunting', $stunting . ' Anak')
                ->description('Kategori Pendek & Sangat Pendek')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color($stunting > 0 ? 'danger' : 'success')
                ->url($resourceUrl . '?tableFilters[status_stunting][value]=stunting'), // 🔗 Link Filter Stunting

            // --- KLASIFIKASI STATUS GIZI (BB/U) ---
            Stat::make('Gizi Buruk', $giziBuruk . ' Anak')
                ->description('Berat Badan Sangat Kurang')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color($giziBuruk > 0 ? 'danger' : 'success')
                ->url($resourceUrl . '?tableFilters[status_gizi][value]=sangat_kurang'), // 🔗 Link Filter Gizi Buruk

            Stat::make('Berat Badan Kurang', $bbKurang . ' Anak')
                ->description('Kategori BB Kurang')
                ->descriptionIcon('heroicon-m-minus-circle')
                ->color($bbKurang > 0 ? 'warning' : 'success')
                ->url($resourceUrl . '?tableFilters[status_gizi][value]=kurang'), // 🔗 Link Filter BB Kurang

            Stat::make('Gizi Normal', $giziNormal . ' Anak')
                ->description('Berat Badan Sehat & Ideal')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success')
                ->url($resourceUrl . '?tableFilters[status_gizi][value]=normal'), // 🔗 Link Filter Gizi Normal

            Stat::make('Risiko Obesitas', $giziLebih . ' Anak')
                ->description('Risiko Berat Badan Lebih')
                ->descriptionIcon('heroicon-m-plus')
                ->color($giziLebih > 0 ? 'warning' : 'success')
                ->url($resourceUrl . '?tableFilters[status_gizi][value]=lebih'), // 🔗 Link Filter Risiko Obesitas
        ];
    }
}