<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\TransaksiMasukKeluarController;
use App\Http\Controllers\PenyesuaianStokController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\UserController;

Route::get('/', fn() => redirect()->route('barangs.index'));

Route::resource('barangs', BarangController::class);
Route::resource('transaksi', TransaksiMasukKeluarController::class);
Route::resource('penyesuaian-stok', PenyesuaianStokController::class);
Route::resource('laporans', LaporanController::class);
Route::resource('users', UserController::class);
