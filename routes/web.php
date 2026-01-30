<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParkirController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});
// Parkir
Route::get('/', [ParkirController::class, 'masuk']);
Route::post('/parkir/masuk', [ParkirController::class, 'simpanMasuk'])->name('parkir.masuk');
Route::get('/parkir/keluar/{id}', [ParkirController::class, 'keluar'])->name('parkir.keluar');
Route::post('/parkir/keluar/{id}', [ParkirController::class, 'simpanKeluar'])->name('parkir.simpanKeluar');
Route::get('/parkir/nota/{id}', [ParkirController::class, 'nota'])->name('parkir.nota');
Route::get('parkir/{id}/tiket', [ParkirController::class, 'tiket'])->name('parkir.tiket');

// Admin
Route::get('/Riwayat', [AdminController::class, 'dashboard'])->name('admin.dashboard');
