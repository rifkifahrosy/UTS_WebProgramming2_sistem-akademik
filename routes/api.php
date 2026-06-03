<?php

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaApi;
use App\Http\Controllers\JurusanApi;

// Mahasiswa API Routes
Route::apiResource('mahasiswa', MahasiswaApi::class);

// Jurusan API Routes
Route::apiResource('jurusan', JurusanApi::class);
