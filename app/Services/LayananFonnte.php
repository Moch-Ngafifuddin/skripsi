<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LayananFonnte
{
    public static function kirimPesan($target, $pesan)
    {
        // Aman dari efek buruk config:cache produksi
        $token = config('services.fonnte.token');

        if (!$token) {
            Log::error('Fonnte Token belum diatur di file config/services.php atau .env');
            return false;
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => $token,
            ])
            // ->withoutVerifying() // Aktifkan hanya jika di localhost bermasalah dengan SSL
            ->post('https://api.fonnte.com/send', [
                'target' => $target,
                'message' => $pesan,
                'delay' => '5',
            ]);

            if ($response->failed()) {
                Log::warning('Fonnte API merespon dengan eror: ' . $response->body());
            }

            return $response->json();
        } catch (\Exception $e) {
            Log::error('Gagal menghubungi API Fonnte: ' . $e->getMessage());
            return false;
        }
    }
}