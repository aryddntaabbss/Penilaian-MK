<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\NilaiController;
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

// resource routes for TU and Dosen roles
Route::middleware(['auth', 'role:tu,dosen'])->group(function () {
    Route::resource('mahasiswa', MahasiswaController::class);
    Route::get('mahasiswa-export', [MahasiswaController::class, 'export'])->name('mahasiswa.export');
    Route::post('mahasiswa-import', [MahasiswaController::class, 'import'])->name('mahasiswa.import');

    Route::resource('matakuliah', MatakuliahController::class);
    Route::get('matakuliah-export', [MatakuliahController::class, 'export'])->name('matakuliah.export');
    Route::post('matakuliah-import', [MatakuliahController::class, 'import'])->name('matakuliah.import');

    Route::resource('dosen', DosenController::class);
    Route::get('dosen-export', [DosenController::class, 'export'])->name('dosen.export');
    Route::post('dosen-import', [DosenController::class, 'import'])->name('dosen.import');
});
// End of resource routes for TU and Dosen roles

// resource routes for Nilai
Route::middleware(['auth', 'role:dosen'])->group(function () {
    Route::get('/nilai/filter/{matakuliah_id?}', [NilaiController::class, 'index'])->name('nilai.index');
    Route::get('/nilai-export', [NilaiController::class, 'export'])->name('nilai.export');
    Route::get('/nilai-mahasiswa/{npm}', [NilaiController::class, 'nilaiMahasiswa'])->name('nilai.mahasiswa');

    Route::get('/nilai', [NilaiController::class, 'index'])->name('nilai.index');
    Route::resource('/nilai', NilaiController::class)->except(['show']);
});

// End of resource routes for Nilai

Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::get('/nilaiku', [NilaiController::class, 'nilaiSaya'])->name('nilai.saya');
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
