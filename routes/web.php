<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParkirController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

// Auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('welcome');
});
// Parkir
Route::get('/', [ParkirController::class, 'masuk'])->name('home.dashboard');
Route::post('/parkir/masuk', [ParkirController::class, 'simpanMasuk'])->name('parkir.masuk');
Route::get('/parkir/keluar/{id}', [ParkirController::class, 'keluar'])->name('parkir.keluar');
Route::post('/parkir/keluar/{id}', [ParkirController::class, 'simpanKeluar'])->name('parkir.simpanKeluar');
Route::get('/parkir/nota/{id}', [ParkirController::class, 'nota'])->name('parkir.nota');
Route::get('parkir/{id}/tiket', [ParkirController::class, 'tiket'])->name('parkir.tiket');

// Admin
Route::get('/Riwayat', [AdminController::class, 'dashboard'])->name('admin.dashboard');

// Owner: manajemen akun
Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
Route::post('/admin/users/{id}/reset', [UserController::class, 'resetPassword'])->name('admin.users.reset');
Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');

// User profile
Route::get('/profile', [UserController::class, 'profile'])->name('profile');
Route::post('/profile', [UserController::class, 'updateProfile'])->name('profile.update');

// Owner profile khusus
Route::get('/owner/profile', [UserController::class, 'ownerProfile'])->name('owner.profile');

// Petugas profile khusus
Route::get('/petugas/profile', [UserController::class, 'petugasProfile'])->name('petugas.profile');

// Manajemen petugas (Owner only)
Route::get('/admin/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
Route::put('/admin/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
