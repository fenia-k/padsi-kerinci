<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataPelangganController;
use App\Http\Controllers\DataPenggunaController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoyaltyProgramController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\TransaksiPenjualanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sini adalah tempat untuk mendaftarkan rute-rute web pada aplikasi.
| Rute-rute ini dimuat oleh RouteServiceProvider dalam kelompok "web".
|
*/

// Halaman utama
Route::get('/', function () {
    return view('login');
});

// Halaman dashboard utama, hanya bisa diakses setelah login dan verifikasi
Route::middleware(['auth', 'verified'])->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Grup Rute untuk Pemilik (Owner)
Route::middleware(['auth', 'role:owner'])->prefix('owner')->group(function () {
    Route::get('/dashboard', [OwnerController::class, 'index'])->name('owner.dashboard');
    
    // Rute khusus untuk data master yang hanya dapat diakses oleh owner
    Route::resource('data_pengguna', DataPenggunaController::class);
    Route::resource('laporan', LaporanController::class);
});

// Grup Rute untuk Pegawai
Route::middleware(['auth', 'role:pegawai'])->prefix('pegawai')->group(function () {
    Route::get('/dashboard', [PegawaiController::class, 'index'])->name('pegawai.dashboard');
    // Tambahkan rute lain khusus untuk pegawai di sini jika diperlukan
});

// Rute untuk Pengelolaan Profil Pengguna yang Sudah Login
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rute Resource untuk Data Master Umum yang Bisa Diakses Semua Pengguna Terverifikasi
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('data_pelanggan', DataPelangganController::class);
    Route::resource('loyalty_program', LoyaltyProgramController::class);
    Route::resource('menu', MenuController::class);
    Route::resource('stok', StokController::class);
    Route::resource('transaksi_penjualan', TransaksiPenjualanController::class);
    
    // Rute "role" jika memiliki akses CRUD, hanya untuk owner
    Route::middleware('role:owner')->resource('role', RoleController::class);
});

// Sertakan rute autentikasi default (login, register, dll.)
require __DIR__.'/auth.php';
