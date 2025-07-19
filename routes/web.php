<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PendaftaranController; // Pastikan use statement ini ada

Route::get('/', function () {
    return view('welcome');
});

// Rute untuk menampilkan formulir pendaftaran
Route::get('/pendaftaran', [PendaftaranController::class, 'create'])->name('pendaftaran.create');

// Rute untuk memproses data dari formulir
Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');

// Rute untuk halaman sukses setelah mendaftar
Route::get('/pendaftaran/sukses/{id}', [PendaftaranController::class, 'sukses'])->name('pendaftaran.sukses');

// Rute untuk menampilkan form cek status
Route::get('/cek-status', [PendaftaranController::class, 'showCheckStatusForm'])->name('cek-status.form');

// Rute untuk memproses dan menampilkan hasil cek status
Route::post('/cek-status', [PendaftaranController::class, 'checkStatus'])->name('cek-status.submit');

// Rute untuk men-generate dan mengunduh PDF
Route::get('/pendaftar/{id}/cetak-pdf', [PendaftaranController::class, 'cetakPdf'])->name('pendaftaran.cetak_pdf');