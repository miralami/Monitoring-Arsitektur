<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstansiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ArsitekturController;

// Dashboard Routes
Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
Route::prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/province/{province}', [DashboardController::class, 'province'])->name('dashboard.province');
    Route::get('/tables', [DashboardController::class, 'tables'])->name('dashboard.tables');
});

// Instansi Routes
Route::prefix('arsitektur')->group(function () {
    Route::get('/', [ArsitekturController::class, 'index'])->name('arsitektur.index');
    Route::post('/refresh-all', [ArsitekturController::class, 'refreshAll'])->name('arsitektur.refreshAll');
    Route::post('/refresh-row/{id}', [ArsitekturController::class, 'refreshRow'])->name('arsitektur.refreshRow');
});

