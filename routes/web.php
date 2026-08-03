<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaffController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

    // KITA TAMBAHKAN prefix('admin') DI SINI
    Route::middleware('admin')->prefix('admin')->group(function () {
        // Staff
        Route::resource('kader', StaffController::class);
        // Child
        Route::resource('balita', App\Http\Controllers\ChildController::class);
        // Activity
        Route::resource('kegiatan', App\Http\Controllers\ActivityController::class);
        // Report
        Route::resource('pemeriksaan', App\Http\Controllers\ExaminationController::class);
        // Cetak pdf
        Route::get('pemeriksaan/{id}/cetak-pdf', [\App\Http\Controllers\ExaminationController::class, 'cetakPdf'])->name('pemeriksaan.cetak');
    });

    Route::middleware('staff')->group(function () {
        // Examination (Khusus staff, mungkin URL-nya tetap /pemeriksaan)
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';