<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaLoginController;
use App\Http\Controllers\SiswaNilaiController;
use App\Http\Controllers\SiswaTugasController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\MateriSiswaController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\SiswaDashboardController;

/*
|--------------------------------------------------------------------------
| Rute Website Publik
|--------------------------------------------------------------------------
| Rute untuk halaman yang bisa diakses oleh semua pengunjung.
*/
Route::get('/', [LandingPageController::class, 'index'])->name('landing');

Route::prefix('berita')->name('posts.')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::get('/{post:slug}', [PostController::class, 'show'])->name('show');
});

Route::get('/api/posts/{post:slug}', [PostController::class, 'showJson'])->name('posts.show.json');
Route::get('/profil/{post:slug}', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery.index');


/*
|--------------------------------------------------------------------------
| Rute Penerimaan Peserta Didik Baru (PPDB)
|--------------------------------------------------------------------------
| Rute untuk alur pendaftaran siswa baru.
*/
Route::prefix('pendaftaran')->name('pendaftaran.')->group(function () {
    Route::get('/', [PendaftaranController::class, 'create'])->name('create');
    Route::post('/', [PendaftaranController::class, 'store'])->name('store');
    Route::get('/sukses/{id}', [PendaftaranController::class, 'sukses'])->name('sukses');
    Route::get('/{id}/cetak-pdf', [PendaftaranController::class, 'cetakPdf'])->name('cetak_pdf');
});

Route::prefix('cek-status')->name('cek-status.')->group(function () {
    Route::get('/', [PendaftaranController::class, 'showCheckStatusForm'])->name('form');
    Route::post('/', [PendaftaranController::class, 'checkStatus'])->name('submit');
});


/*
|--------------------------------------------------------------------------
| Rute Portal Siswa (LMS)
|--------------------------------------------------------------------------
| Rute untuk login dan halaman-halaman di dalam LMS untuk siswa.
*/
Route::prefix('siswa')->name('siswa.')->group(function () {
    // Rute untuk halaman login & logout siswa
    Route::get('/login', [SiswaLoginController::class, 'showLoginForm'])->name('login.form');
    Route::post('/login', [SiswaLoginController::class, 'login'])->name('login.submit');
    Route::post('/logout', [SiswaLoginController::class, 'logout'])->name('logout');

    // Halaman yang dilindungi (hanya untuk siswa yang sudah login)
    Route::middleware(['auth', 'role:siswa'])->group(function () {
        Route::get('/dashboard', [SiswaDashboardController::class, 'index'])->name('dashboard');
        Route::get('/materi', [MateriSiswaController::class, 'index'])->name('materi.index');
        Route::get('/tugas', [SiswaTugasController::class, 'index'])->name('tugas.index');
        Route::get('/tugas/{tugas}', [SiswaTugasController::class, 'show'])->name('tugas.show');
        Route::post('/tugas/{tugas}/kumpulkan', [SiswaTugasController::class, 'kumpulkan'])->name('tugas.kumpulkan');
        Route::get('/nilai', [SiswaNilaiController::class, 'index'])->name('nilai.index');
    });
});


/*
|--------------------------------------------------------------------------
| Rute Admin & Guru
|--------------------------------------------------------------------------
| Rute ini hanya untuk mengarahkan ke halaman login admin/guru.
*/
Route::get('/guru/login', fn () => redirect()->route('filament.admin.auth.login'));


/*
|--------------------------------------------------------------------------
| Rute Fallback untuk Autentikasi (WORKAROUND)
|--------------------------------------------------------------------------
| Rute "palsu" yang diberi nama 'login' untuk menangkap panggilan
| default dari sistem dan mengarahkannya ke login siswa yang benar.
*/
Route::get('/login', function () {
    return redirect()->route('siswa.login.form');
})->name('login');

