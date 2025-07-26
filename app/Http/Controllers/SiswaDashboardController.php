<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $kelasIds = $user->kelas()->pluck('kelas.id');

        // Hitung jumlah materi untuk kelas siswa
        $jumlahMateri = Materi::whereIn('kelas_id', $kelasIds)->count();

        // Hitung jumlah tugas untuk kelas siswa
        $jumlahTugas = Tugas::whereIn('kelas_id', $kelasIds)->count();

        // (Nilai rata-rata bisa ditambahkan nanti setelah fitur nilai jadi)

        return view('siswa.dashboard', [
            'user' => $user,
            'jumlahMateri' => $jumlahMateri,
            'jumlahTugas' => $jumlahTugas,
        ]);
    }
}