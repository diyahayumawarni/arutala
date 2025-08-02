<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// ROUTE LOGIN & LOGOUT
Route::get('/masuk', [AuthenticatedSessionController::class, 'create'])->name('masuk');
Route::post('/masuk', [AuthenticatedSessionController::class, 'store']);
Route::post('/keluar', [AuthenticatedSessionController::class, 'destroy'])->name('keluar');

// ROUTE YANG HANYA BISA DIAKSES SETELAH LOGIN
Route::middleware('auth')->group(function () {
    // Halaman awal setelah login
    Route::get('/', function () {
        return view('welcome');
    })->name('dashboard');

    // CRUD Booking Lengkap (termasuk show)
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show'); // ✅ TAMBAHKAN INI
    Route::get('/bookings/{booking}/edit', [BookingController::class, 'edit'])->name('bookings.edit');
    Route::put('/bookings/{booking}', [BookingController::class, 'update'])->name('bookings.update');
    Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');
});

// WAJIB: Pastikan file ini tetap di-include agar route login Laravel Breeze/Fortify berfungsi
require __DIR__.'/auth.php';
