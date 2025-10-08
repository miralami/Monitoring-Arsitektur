<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstansiController;

// Redirect root ke halaman Kementerian
// Route::get('/', function () {
//     return redirect()->route('instansi.index', ['kategori' => 'Kementerian']);
// });

// Route::group(['prefix' => 'instansi'], function () {
//     Route::get('/', [InstansiController::class, 'index'])->name('instansi.index');
//     Route::get('/data', [InstansiController::class, 'data'])->name('instansi.data');
// });

Route::resource('/', InstansiController::class);

// Route::get('instansi/data-json', [InstansiController::class, 'apiData'])->name('instansi.data.json');
Route::get('instansi/data-json/{kategoriId}', [InstansiController::class, 'getInstansiByKategoriId'])->name('instansi.data.json.filter');

Route::get('instansi/export-excel/{kategoriId}', [InstansiController::class, 'exportExcel'])->name('instansi.export.excel');