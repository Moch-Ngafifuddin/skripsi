<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LayananFonnte
{
    public static function kirimPesan($target, $pesan)
    {
        $token = config('services.fonnte.token');

        if (!$token) {
            Log::error('Fonnte Token belum diatur di file config/services.php atau .env');
            return false;
        }


        // 1. Hapus semua karakter yang bukan angka (spasi, tanda plus, strip, dll)
        $targetBersih = preg_replace('/[^0-9]/', '', $target);
        
        // 2. Jika nomor diawali angka '0', ubah menjadi '62' (Standar Fonnte/Internasional)
        if (substr($targetBersih, 0, 1) === '0') {
            $targetBersih = '62' . substr($targetBersih, 1);
        }

        // Jika setelah dibersihkan nomor terlalu pendek, batalkan kirim
        if (strlen($targetBersih) < 10) {
            return false;
        }

        try {
            //$response = Http::withHeaders([
                $response = Http::withoutVerifying()->withHeaders([
                'Authorization' => $token,
            ])
            ->post('https://api.fonnte.com/send', [
                'target' => $targetBersih,
                'message' => $pesan,
                'delay' => '2', 
            ]);

            if ($response->failed()) {
                Log::warning('Fonnte API merespon eror: ' . $response->body());
                return false;
            }

            return $response->json();
        } catch (\Exception $e) {
            Log::error('Gagal menghubungi API Fonnte: ' . $e->getMessage());
            return false;
        }
    }
}