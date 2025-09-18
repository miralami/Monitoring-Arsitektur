<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstansiController;

// halaman utama
Route::get('/', [InstansiController::class, 'index'])->name('index');

// data JSON untuk refresh tabel
Route::get('/data/{kategori}', [InstansiController::class, 'data'])->name('data');

