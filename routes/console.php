<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule; // Kelompokkan di atas sini

// Perintah bawaan Laravel untuk quote inspiratif
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Perintah otomatis untuk bot pengingat WhatsApp Posyandu (Setiap jam 06:00 pagi)
Schedule::command('posyandu:kirim-pengingat')->dailyAt('06:00');