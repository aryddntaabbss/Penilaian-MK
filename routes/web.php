<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::get('/mahasiswa', function () {
        return 'Halaman Mahasiswa';
    });
});

Route::middleware(['auth', 'role:dosen'])->group(function () {
    Route::get('/dosen', function () {
        return 'Halaman Dosen';
    });
});

Route::middleware(['auth', 'role:tu'])->group(function () {
    Route::get('/tu', function () {
        return 'Halaman TU';
    });
});

// Mahasiswa resource routes for TU role}}
Route::middleware(['auth', 'role:tu'])->group(function () {
    Route::resource('mahasiswa', MahasiswaController::class);
    Route::get('mahasiswa-export', [MahasiswaController::class, 'export'])->name('mahasiswa.export');
    Route::post('mahasiswa-import', [MahasiswaController::class, 'import'])->name('mahasiswa.import');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
