<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PantauAnakController;
use App\Http\Controllers\LaporanPdfController;
use App\Models\PemeriksaanBayi;
use App\Exports\DatabaseBalitaExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

Route::get('/pantau', [PantauAnakController::class, 'index'])->name('pantau.index');
Route::post('/pantau/cari', [PantauAnakController::class, 'cari'])->name('pantau.cari');
Route::get('/pantau/{id}', [PantauAnakController::class, 'detail'])->name('pantau.detail');

Route::get('/laporan/download/{id}', [LaporanPdfController::class, 'downloadLaporan'])
    ->name('laporan.download')
    ->middleware('signed');

// 📥 Route khusus unduhan Excel via link WhatsApp (100% Sinkron Hanya Balita Aktif)
Route::get('/download-excel-wa', function (\Illuminate\Http\Request $request) {
    if (! $request->hasValidSignature()) {
        abort(403, 'Tautan unduhan tidak valid, telah dimanipulasi, atau sudah kedaluwarsa.');
    }
    
    // 🔴 REVISI: Tambahkan filter 'whereHas' agar balita Pindah/Meninggal (is_arsip=1) TIDAK IKUT TERDOWNLOAD
    $query = PemeriksaanBayi::with(['pasien'])
        ->whereHas('pasien', function ($q) {
            $q->where('is_arsip', 0); // 🟢 Hanya ambil balita yang masih aktif
        })
        ->whereIn('pemeriksaan_bayi.id', function ($subQuery) {
            $subQuery->selectRaw('MAX(id)')->from('pemeriksaan_bayi')->groupBy('pasien_id');
        });

    // Kondisikan filter gizi jika benar-benar DIISI oleh kader
    if ($request->filled('status_gizi')) {
        $query->where('status_gizi', $request->status_gizi);
    }
    
    // Kondisikan filter stunting jika benar-benar DIISI oleh kader
    if ($request->filled('status_stunting')) {
        $query->where('status_stunting', $request->status_stunting);
    }
    
    // Kondisikan filter rentang tanggal pemeriksaan jika benar-benar DIISI
    if ($request->filled('dari') && $request->filled('sampai')) {
        $query->whereBetween('tgl_periksa', [$request->dari, $request->sampai]);
    }

    $records = $query->get();

    // Jalankan eksport dokumen menggunakan class Export library Maatwebsite
    return Excel::download(
        new DatabaseBalitaExport($records), 
        'database_balita_wa_' . now()->format('Ymd_His') . '.xlsx'
    );
})->name('download.excel.wa')->middleware('signed');