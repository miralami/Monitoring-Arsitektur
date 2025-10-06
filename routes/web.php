<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstansiController;

// Redirect root ke halaman Kementerian
Route::get('/', function () {
    return redirect()->route('instansi.index', ['kategori' => 'Kementerian']);
});

Route::group(['prefix' => 'instansi'], function () {
    Route::get('/', [InstansiController::class, 'index'])->name('instansi.index');
    Route::get('/data', [InstansiController::class, 'data'])->name('instansi.data');
});

