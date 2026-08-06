<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ChildController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ExaminationController;
use App\Http\Controllers\ActivityLogController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {

    // Dashboard (Bisa diakses semua yang login)
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware(['verified'])
        ->name('dashboard');

    // ==========================================================
    // MENU UTAMA (Bisa dibuka Admin & Kader)
    // ==========================================================
    Route::prefix('admin')->group(function () {
        
        // Pemeriksaan (Akses Penuh)
        Route::resource('pemeriksaan', ExaminationController::class);
        Route::get('pemeriksaan/{id}/cetak-pdf', [ExaminationController::class, 'cetakPdf'])->name('pemeriksaan.cetak');
        
        // Balita (Kader bisa lihat)
        Route::resource('balita', ChildController::class);
        
        // Kegiatan (Kader bisa lihat & cetak)
        Route::resource('kegiatan', ActivityController::class);
        Route::get('kegiatan/{id}/cetak', [ActivityController::class, 'cetak'])->name('kegiatan.cetak');

        // Kader / Staff (Kader bisa lihat, tapi CRUD dikunci di controller/view)
        Route::resource('kader', StaffController::class);
    });

    // ==========================================================
    // MENU KHUSUS ADMIN (Kader dilarang masuk)
    // ==========================================================
    Route::middleware('admin')->prefix('admin')->group(function () {
        // Rute kader di sini sudah dihapus karena dipindah ke atas
        
        // Riwayat Aktivitas
        Route::get('riwayat-aktivitas', [ActivityLogController::class, 'index'])->name('riwayat.index');
    });

    // Profile Bawaan Laravel
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';