<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| Berkas ini digunakan untuk mendefinisikan perintah konsol berbasis closure
| serta mendaftarkan seluruh jadwal otomatis (Task Scheduling) sistem Posyandu.
|
*/


Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


// Kirim pesan H-1 sebelum acara
Schedule::command('posyandu:kirim-reminder')->dailyAt('08:00');

// Cara menjalankan secara manual ketik " php artisan posyandu:kirim-reminder "