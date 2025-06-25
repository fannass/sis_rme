<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\DokterController;
use App\Http\Controllers\Admin\PraktikController;
use App\Http\Controllers\Dokter\DashboardController as DokterDashboardController;
use App\Http\Controllers\Dokter\PasienController;
use App\Http\Controllers\Dokter\PemeriksaanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// Routes yang memerlukan authentication
Route::middleware(['auth'])->group(function () {
    // Route untuk profile (dari Laravel Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes untuk Admin
    Route::middleware(['auth', \App\Http\Middleware\CheckRole::class.':admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('dokter', \App\Http\Controllers\Admin\DokterController::class);
        Route::resource('praktik', \App\Http\Controllers\Admin\PraktikController::class);
    });

    // Routes untuk Dokter
    Route::middleware(['auth', \App\Http\Middleware\CheckRole::class.':dokter'])->prefix('dokter')->name('dokter.')->group(function () {
        Route::get('/dashboard', [DokterDashboardController::class, 'index'])->name('dashboard');
        
        // Route untuk pasien
        Route::get('pasien/search', [PasienController::class, 'search'])->name('pasien.search');
        Route::resource('pasien', PasienController::class);
        
        // Route untuk pemeriksaan
        Route::prefix('pemeriksaan')->name('pemeriksaan.')->group(function () {
            Route::get('/search-pasien', [PemeriksaanController::class, 'searchPasien'])->name('search_pasien');
            Route::get('/{pemeriksaan}/export-pdf', [PemeriksaanController::class, 'exportPDF'])->name('export-pdf');
        });
        
        Route::resource('pemeriksaan', PemeriksaanController::class);
    });

    // Redirect dari /dashboard ke dashboard sesuai role
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('dokter.dashboard');
    })->name('dashboard');
});

require __DIR__.'/auth.php';
