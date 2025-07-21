<?php

namespace App\Http\Controllers;

use App\Models\Gallery; 
use App\Models\Post;    
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        // ... (kode untuk status pendaftaran tetap sama)
        $settings = Setting::all()->pluck('value', 'key');
        $tanggalBuka = $settings->get('tanggal_buka');
        $tanggalTutup = $settings->get('tanggal_tutup');
        $statusPendaftaran = 'Ditutup';
        $sekarang = Carbon::now();
        if ($tanggalBuka && $tanggalTutup) {
            $tglBuka = Carbon::parse($tanggalBuka);
            $tglTutup = Carbon::parse($tanggalTutup)->endOfDay();
            if ($sekarang->between($tglBuka, $tglTutup)) {
                $statusPendaftaran = 'Dibuka';
            } elseif ($sekarang->isBefore($tglBuka)) {
                $statusPendaftaran = 'Akan Datang';
            }
        }
        // --- Akhir kode status pendaftaran ---

        // Ambil data baru untuk halaman beranda
        $latestPosts = Post::where('status', 'published')
                            ->latest()
                            ->take(3) // Ambil 3 postingan terbaru
                            ->get();

        $galleryPhotos = Gallery::latest()
                                ->take(8) // Ambil 8 foto terbaru
                                ->get();


        return view('landing', [
            // Data pendaftaran
            'status_pendaftaran' => $statusPendaftaran,
            'tanggal_buka' => $tanggalBuka ? Carbon::parse($tanggalBuka)->isoFormat('D MMMM Y') : 'N/A',
            'tanggal_tutup' => $tanggalTutup ? Carbon::parse($tanggalTutup)->isoFormat('D MMMM Y') : 'N/A',
            
            // Data baru untuk konten
            'posts' => $latestPosts,
            'photos' => $galleryPhotos,
        ]);
    }
}