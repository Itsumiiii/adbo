<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Buku
Route::resource('buku', BukuController::class)->middleware(['auth']);

// Anggota
Route::resource('anggota', AnggotaController::class)->middleware(['auth'])->parameters(['anggota' => 'anggota']);

// Peminjaman
Route::get('/peminjaman', [PeminjamanController::class, 'index'])
    ->middleware(['auth'])
    ->name('peminjaman.index');
Route::get('/peminjaman/create', [PeminjamanController::class, 'create'])
    ->middleware(['auth'])
    ->name('peminjaman.create');
Route::post('/peminjaman', [PeminjamanController::class, 'store'])
    ->middleware(['auth'])
    ->name('peminjaman.store');
Route::get('/peminjaman/riwayat', [PeminjamanController::class, 'riwayat'])
    ->middleware(['auth'])
    ->name('peminjaman.riwayat');

Route::get('/peminjaman/{peminjaman}', [PeminjamanController::class, 'show'])
    ->middleware(['auth'])
    ->name('peminjaman.show');

// Pengembalian
Route::get('/pengembalian', [PengembalianController::class, 'index'])
    ->middleware(['auth'])
    ->name('pengembalian.index');
Route::get('/pengembalian/create', [PengembalianController::class, 'create'])
    ->middleware(['auth'])
    ->name('pengembalian.create');
Route::post('/pengembalian', [PengembalianController::class, 'store'])
    ->middleware(['auth'])
    ->name('pengembalian.store');
Route::post('/pengembalian/hitung-denda', [PengembalianController::class, 'hitungDenda'])
    ->middleware(['auth'])
    ->name('pengembalian.hitung-denda');

// Laporan
Route::get('/laporan/peminjaman', [LaporanController::class, 'peminjaman'])
    ->middleware(['auth'])
    ->name('laporan.peminjaman');
Route::get('/laporan/pengembalian', [LaporanController::class, 'pengembalian'])
    ->middleware(['auth'])
    ->name('laporan.pengembalian');
Route::get('/laporan/denda', [LaporanController::class, 'denda'])
    ->middleware(['auth'])
    ->name('laporan.denda');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
