<?php

namespace App\Http\Controllers;

use App\Models\PemeriksaanBayi;
use App\Models\Pasien;
use App\Services\LayananFonnte;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class LaporanPdfController extends Controller
{

    public function downloadLaporan($id)
    {
        // 1. Ambil data pemeriksaan beserta relasi pasien
        $pemeriksaan = PemeriksaanBayi::with('pasien')->findOrFail($id);
        $pasien = $pemeriksaan->pasien;
    
        // 2. Ambil semua riwayat pasien tersebut untuk tabel dan grafik
        $semuaRiwayat = PemeriksaanBayi::where('pasien_id', $pasien->id)
            ->orderBy('tgl_periksa', 'asc')
            ->get();
    
        // 3. Siapkan data untuk grafik
        $chartData = [
            'type' => 'line',
            'data' => [
                'labels' => $semuaRiwayat->pluck('tgl_periksa')->toArray(),
                'datasets' => [[
                    'label' => 'Berat Badan (Kg)',
                    'data' => $semuaRiwayat->pluck('berat_badan')->toArray(),
                    'borderColor' => '#3b82f6',
                    'fill' => false
                ]]
            ]
        ];
        $chartImage = "https://quickchart.io/chart?c=" . urlencode(json_encode($chartData));
    
        // 4. Render ke PDF (Mengirim data pasien, riwayat lengkap, dan gambar grafik)
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.laporan', [
            'pasien' => $pasien,
            'pemeriksaan' => $semuaRiwayat, // Menggunakan seluruh riwayat
            'chartImage' => $chartImage
        ]);
    
        return $pdf->download('Laporan_Lengkap_'.$pasien->nama.'.pdf');
    }

    // Fungsi untuk aksi kirim via WA dari Filament
    public function kirimWa($pemeriksaanId)
    {
        $pemeriksaan = PemeriksaanBayi::with('pasien')->findOrFail($pemeriksaanId);
        $pasien = $pemeriksaan->pasien;

        // 1. Generate Signed URL (Link aman berlaku 10 menit)
        $urlPdf = URL::temporarySignedRoute(
            'laporan.download', 
            now()->addMinutes(10), 
            ['id' => $pemeriksaan->id]
        );

        // 2. Kirim via LayananFonnte
        $pesan = "Halo Bunda, laporan perkembangan ".$pasien->nama." bulan ini sudah tersedia. Klik link berikut untuk mendownload laporan PDF: " . $urlPdf;
        
        $response = LayananFonnte::kirimPesan($pasien->no_hp, $pesan);

        return response()->json([
            'status' => 'success',
            'message' => 'Laporan berhasil dikirim ke WhatsApp!'
        ]);
    }
}