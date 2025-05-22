<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApotekerController;
use App\Http\Controllers\AdministrasiController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\AntrianController;
use App\Http\Controllers\ResepDokterController;
use App\Http\Controllers\LaporanController;


Route::get('/apoteker', function () {
    return view('apoteker');
})->name('apoteker');

Route::get('/administrasi', function () {
    return view('administrasi');
})->name('administrasi');

Route::get('/formdokter', function () {
    return view('formdokter');
})->name('formdokter');




// Halaman Utama
Route::get('/', function () {
    return view('welcome');
});

// Halaman Login
Route::get('/login', function () {
    return view('login'); 
})->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('proses.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 🔹 Dashboard untuk Apoteker, Administrasi, dan Dokter
Route::get('/apoteker/dashboard', function () {
    return view('apoteker.dashboard'); 
})->name('apoteker.dashboard');

Route::get('/administrasi/dashboard', [AntrianController::class, 'getAntrian'])->name('administrasi.dashboard');

Route::get('/dokter/dashboard', function () {
    return view('dokters.dokter'); 
})->name('dokter.dashboard');

// 🔹 Antrian
// Route untuk halaman daftar antrian
Route::get('/antrian', [AntrianController::class, 'index'])->name('antrian.index');
Route::get('/antrian/{id}', [AntrianController::class, 'detail'])->name('antrian.detail');
Route::get('/administrasi/dashboard', [AntrianController::class, 'getAntrian'])->name('administrasi.dashboard');
Route::get('/dokter/dashboard', [AntrianController::class, 'getAntrian'])->name('dokter.dashboard');
// routes/web.php
Route::get('/dokter/antrian/detail/{id}', [AntrianController::class, 'getDetail'])->name('dokter.antrian.getDetail');
Route::get('/dokter/dashboard', [DokterController::class, 'index'])->name('dokter.dashboard');

Route::get('/dokter/antrian/{nomor_antrian}', [DokterController::class, 'showDetail'])->name('dokter.antrian.detail');
Route::get('/dokters', [DokterController::class, 'index'])->name('dokters.dokter');
Route::post('/antrian/proses/{nomor_antrian}', [AntrianController::class, 'proses'])->name('dokter.antrian.proses');
Route::get('/filter-resep', [DokterController::class, 'filterResep'])->name('filterResep');
Route::get('/apoteker/dashboard', [ApotekerController::class, 'index'])->name('apoteker.dashboard');



Route::get('/apoteker/dashboard', [ApotekerController::class, 'index'])->name('apoteker.dashboard');
Route::post('/resep', [ResepDokterController::class, 'store'])->name('resep.store');



Route::post('/dokter/antrian/{nomor_antrian}/selesai', [AntrianController::class, 'selesai'])->name('dokter.antrian.selesai');
Route::get('/history', [DokterController::class, 'index'])->name('resep.history');

// 🔹 Register Akun
Route::post('/apoteker/register', [ApotekerController::class, 'registerApoteker'])->name('apoteker.register');
Route::post('/administrasi/register', [AdministrasiController::class, 'registerAdministrasi'])->name('administrasi.register');
Route::post('/dokter/register', [DokterController::class, 'registerDokter'])->name('dokter.register');

// 🔹 Tambah Data Pasien
Route::post('/administrasi/store', [PasienController::class, 'store'])->name('pasien.store');
Route::post('/laporan/kirim', [LaporanController::class, 'simpanLaporan'])->name('laporan.kirim');


