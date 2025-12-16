<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ServisController;
use App\Http\Controllers\MotorController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\MekanikController;
use App\Http\Controllers\SparepartController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaymentController;

// Public routes (guest)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    Route::get('/', function () {
        return redirect()->route('login');
    });
});

// Protected routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Payment routes
    Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');
    Route::get('/payment/receipt/{servisId}', [PaymentController::class, 'receipt'])->name('payment.receipt');

    // Admin routes
    Route::middleware('admin')->group(function () {
        Route::resource('servis', ServisController::class);
        Route::resource('motor', MotorController::class);
        Route::resource('pelanggan', PelangganController::class);
        Route::resource('mekanik', MekanikController::class);
        Route::resource('sparepart', SparepartController::class);
    });
});


