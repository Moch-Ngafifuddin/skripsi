<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PantauAnakController;

Route::get('/', function () {
    return view('welcome');
});


    Route::get('/pantau', [PantauAnakController::class, 'index'])->name('pantau.index');
    Route::post('/pantau/cari', [PantauAnakController::class, 'cari'])->name('pantau.cari');
    Route::get('/pantau/{id}', [PantauAnakController::class, 'detail'])->name('pantau.detail');
