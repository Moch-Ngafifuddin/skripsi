<?php

namespace App\Http\Controllers;

use App\Models\PemeriksaanBayi;
use App\Models\Pasien;
use App\Services\LayananFonnte;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DatabaseBalitaExport; 

class LaporanPdfController extends Controller
{
    /**
     * Fitur Cetak/Unduh PDF Rekam Medis Massal / Riwayat Pasien Tunggal
     */
    public function downloadLaporan($id)
    {
        // 🟢 PERBAIKAN: Mengaktifkan kembali inisialisasi model Pasien
        $pasien = Pasien::findOrFail($id);

        $semuaRiwayat = PemeriksaanBayi::where('pasien_id', $pasien->id)
            ->orderBy('tgl_periksa', 'asc')
            ->get();

        $pdf = Pdf::loadView('pdf.laporan', [
            'pasien' => $pasien,
            'pemeriksaan' => $semuaRiwayat
        ]);

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

        // 🟢 PERBAIKAN: Ubah array parameter dari $pemeriksaan->id menjadi $pasien->id
        $urlPdf = URL::temporarySignedRoute(
            'laporan.download', 
            now()->addMinutes(10), 
            ['id' => $pasien->id] // 👈 GANTI BAGIAN INI AGAR SINKRON DENGAN DOWNLOAD LAPORAN
        );

        $pesan = "Halo Bunda, laporan perkembangan " . $pasien->nama . " bulan ini sudah tersedia. Silakan klik link berikut untuk mendownload berkas resmi laporan PDF tumbuh kembang anak: " . $urlPdf;
        
        $response = LayananFonnte::kirimPesan($pasien->no_hp, $pesan);

        return response()->json([
            'status' => 'success',
            'message' => 'Laporan berhasil dikirim ke WhatsApp!'
        ]);
    }

    /**
     * Menangkap Tautan Unduhan Excel dari WhatsApp Gateway dengan Filter Sinkron
     */
    public function downloadExcelWa(Request $request)
    {
        $query = PemeriksaanBayi::query()
            ->with(['pasien'])
            ->whereHas('pasien', function ($q) {
                $q->where('is_arsip', 0);
            })
            ->whereRaw('pemeriksaan_bayi.id IN (
                SELECT MAX(pb.id) 
                FROM pemeriksaan_bayi pb 
                GROUP BY pb.pasien_id
            )');

        if ($request->filled('status_gizi')) {
            $query->where('status_gizi', $request->status_gizi);
        }

        if ($request->filled('status_stunting')) {
            $query->where('status_stunting', $request->status_stunting);
        }

        if ($request->filled('dari')) {
            $query->whereDate('tgl_periksa', '>=', $request->dari);
        }

        if ($request->filled('sampai')) {
            $query->whereDate('tgl_periksa', '<=', $request->sampai);
        }

        $records = $query->get();

        return Excel::download(
            new DatabaseBalitaExport($records), 
            'rekap_balita_wa_' . now()->format('dM_Y') . '.xlsx'
        );
    }

    /**
     * 🟢 BERHASIL DIINTEGRASI: Cetak Kartu Menuju Sehat (KMS) Personal + Kurva Z-Score Kemenkes
     */
    public function downloadKmsPersonal($id)
    {
        $pasien = \App\Models\Pasien::findOrFail($id);

        $pemeriksaan = \App\Models\PemeriksaanBayi::where('pasien_id', $id)
            ->orderBy('usia_bulan', 'asc')
            ->get();

        $masterData = \App\Models\MasterBbu::where('jenis_kelamin', $pasien->jenis_kelamin)
            ->whereBetween('umur_bulan', [0, 24])
            ->orderBy('umur_bulan')
            ->get();

        $pdf = Pdf::loadView('pdf.kms-personal', [
            'pasien'      => $pasien,      
            'pemeriksaan' => $pemeriksaan,
            'masterData'  => $masterData
        ]);

        return $pdf->download('KMS_Personal_' . $pasien->nama . '.pdf');
    }
}