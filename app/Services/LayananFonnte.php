<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LayananFonnte
{

    public static function kirimPesan($target, $pesan)
    {
        $token = env('FONNTE_TOKEN');

        if (!$token) {
            Log::error('Fonnte Token belum diatur di file .env');
            return false;
        }

        $response = Http::withHeaders([
            'Authorization' => $token,
        ])
        ->withoutVerifying()
        ->post('https://api.fonnte.com/send', [
            'target' => $target,
            'message' => $pesan,
            'delay' => '5',
        ]);

        return $response->json();
    }
}