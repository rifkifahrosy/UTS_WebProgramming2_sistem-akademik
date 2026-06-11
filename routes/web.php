<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatakuliahController;

// Root redirect
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Auth Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Protected Routes (middleware auth)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Jurusan print routes
    Route::get('/jurusan/export-excel', [JurusanController::class, 'exportExcel'])->name('jurusan.excel');
    Route::get('/jurusan/print', [JurusanController::class, 'print'])->name('jurusan.print');

    // Mahasiswa print routes
    Route::get('/mahasiswa/export-excel', [MahasiswaController::class, 'exportExcel'])->name('mahasiswa.excel');
    Route::get('/mahasiswa/export-csv', [MahasiswaController::class, 'exportCsv'])->name('mahasiswa.export-csv');
    Route::get('/mahasiswa/print', [MahasiswaController::class, 'print'])->name('mahasiswa.print');

    // Matakuliah print routes
    Route::get('/matakuliah/export-excel', [MatakuliahController::class, 'exportExcel'])->name('matakuliah.excel');
    Route::get('/matakuliah/print', [MatakuliahController::class, 'print'])->name('matakuliah.print');

    // Resources
    Route::resource('jurusan', JurusanController::class)->except(['show']);
    Route::resource('mahasiswa', MahasiswaController::class)->except(['show']);
    Route::resource('matakuliah', MatakuliahController::class)->except(['show']);

    // Profile & Password
    Route::get('/profile/password', [\App\Http\Controllers\ProfileController::class, 'editPassword'])->name('profile.password');
    Route::put('/profile/password', [\App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('profile.password.update');
});
