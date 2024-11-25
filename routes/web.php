<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataPelangganController;
use App\Http\Controllers\DataPenggunaController;
use App\Http\Controllers\LaporanTransaksiController;
use App\Http\Controllers\LoyaltyProgramController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DiskonController;
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

// Halaman utama (login page)
Route::get('/', function () {
    return view('login');
})->name('login');

// Halaman dashboard utama, hanya bisa diakses setelah login dan verifikasi
Route::middleware(['auth', 'verified'])->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Grup Rute untuk Pemilik (Owner)
Route::middleware(['auth', 'role:owner'])->prefix('owner')->group(function () {
    Route::get('/dashboard', [OwnerController::class, 'index'])->name('owner.dashboard');
    
    // Rute khusus untuk data master yang hanya dapat diakses oleh owner
    Route::prefix('data_master')->group(function () {
        Route::resource('data_pengguna', DataPenggunaController::class);
        Route::resource('role', RoleController::class);
    });
});

// Grup Rute untuk Pegawai
Route::middleware(['auth', 'role:pegawai'])->prefix('pegawai')->group(function () {
    Route::get('/dashboard', [PegawaiController::class, 'index'])->name('pegawai.dashboard');
    // Tambahkan rute lain khusus untuk pegawai di sini jika diperlukan
});

// Grup Rute untuk Data Master Umum, dapat diakses oleh pegawai dan owner
Route::middleware(['auth', 'verified'])->prefix('data_master')->group(function () {
    Route::resource('data_pelanggan', DataPelangganController::class);
    Route::resource('loyalty_program', LoyaltyProgramController::class);
    Route::resource('menu', MenuController::class);
    Route::resource('stok', StokController::class);
    Route::resource('transaksi', TransaksiController::class);
    Route::resource('diskon', DiskonController::class); // Tambahkan rute diskon
    Route::get('/referral-report', [DataPelangganController::class, 'referralReport'])->name('referral.report');
    Route::get('/transaksi/{id}/detail', [TransaksiController::class, 'detail'])->name('transaksi.detail');
});

// Grup Rute untuk Laporan, hanya bisa diakses oleh owner
Route::prefix('laporan')->middleware(['auth', 'role:owner'])->group(function () {
    Route::get('/', [LaporanTransaksiController::class, 'index'])->name('laporan.index');
    Route::get('/{id}', [LaporanTransaksiController::class, 'detail'])->name('laporan.detail'); // Jika detail diperlukan
});

// Rute untuk export laporan, hanya bisa diakses oleh owner
Route::prefix('admin')->middleware(['auth', 'role:owner'])->group(function () {
    Route::get('/laporan/export', [LaporanTransaksiController::class, 'exportPDF'])->name('laporan.export');
});

// Sertakan rute autentikasi default (login, register, dll.)
require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
