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
    /**
     * Fitur Cetak/Unduh PDF Rekam Medis (100% Offline dengan SVG Vektor Dinamis)
     */
    public function downloadLaporan($id)
    {
        // 1. Ambil data pemeriksaan beserta relasi pasien
        $pemeriksaan = PemeriksaanBayi::with('pasien')->findOrFail($id);
        $pasien = $pemeriksaan->pasien;

        // 2. Ambil semua riwayat pasien tersebut untuk tabel dan grafik
        $semuaRiwayat = PemeriksaanBayi::where('pasien_id', $pasien->id)
            ->orderBy('tgl_periksa', 'asc')
            ->get();

        // 3. Langsung render ke PDF (Data dikirim utuh, visualisasi 3 grafik dihitung mandiri di Blade)
        $pdf = Pdf::loadView('pdf.laporan', [
            'pasien' => $pasien,
            'pemeriksaan' => $semuaRiwayat
        ]);

        // Berikan hak akses parsing HTML5 standar agar DomPDF lancar membaca struktur tag
        $pdf->setOption([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true
        ]);

        return $pdf->download('Laporan_Lengkap_' . $pasien->nama . '.pdf');
    }

    /**
     * Fitur Kirim Tautan Laporan PDF Hasil Pemeriksaan Bulanan via WhatsApp Gateway (Fonnte)
     */
    public function kirimWa($pemeriksaanId)
    {
        $pemeriksaan = PemeriksaanBayi::with('pasien')->findOrFail($pemeriksaanId);
        $pasien = $pemeriksaan->pasien;

        // Generate Signed URL (Tautan aman enkripsi yang berlaku selama 10 menit)
        $urlPdf = URL::temporarySignedRoute(
            'laporan.download', 
            now()->addMinutes(10), 
            ['id' => $pemeriksaan->id]
        );

        // Struktur Notifikasi Pesan KIA
        $pesan = "Halo Bunda, laporan perkembangan " . $pasien->nama . " bulan ini sudah tersedia. Silakan klik link berikut untuk mendownload berkas resmi laporan PDF tumbuh kembang anak: " . $urlPdf;
        
        // Eksekusi pengiriman melalui Fonnte API Service
        $response = LayananFonnte::kirimPesan($pasien->no_hp, $pesan);

        return response()->json([
            'status' => 'success',
            'message' => 'Laporan berhasil dikirim ke WhatsApp!'
        ]);
    }
}