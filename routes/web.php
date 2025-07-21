<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LandingPageController; 
use App\Http\Controllers\PendaftaranController; 

Route::get('/', [LandingPageController::class, 'index'])->name('landing');

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

// Rute untuk menampilkan detail postingan
Route::get('/berita/{post:slug}', [PostController::class, 'show'])->name('posts.show');

// Rute ini akan mengembalikan konten post sebagai JSON
Route::get('/api/posts/{post:slug}', [PostController::class, 'showJson'])->name('posts.show.json');

// Rute untuk menampilkan daftar semua berita
Route::get('/berita', [PostController::class, 'index'])->name('posts.index');

// Rute untuk menampilkan halaman galeri
Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery.index');

// Rute untuk menampilkan halaman profil
Route::get('/profil/{post:slug}', [ProfileController::class, 'show'])->name('profile.show');