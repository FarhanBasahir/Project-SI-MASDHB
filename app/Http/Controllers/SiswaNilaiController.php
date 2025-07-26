<?php

namespace App\Http\Controllers;

use App\Models\JawabanTugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaNilaiController extends Controller
{
    public function index()
    {
        $jawaban = JawabanTugas::where('user_id', Auth::id())
                               ->with('tugas.mataPelajaran') // Eager loading untuk mengambil data tugas dan mapel
                               ->latest()
                               ->paginate(10);

        return view('siswa.nilai.index', compact('jawaban'));
    }
}