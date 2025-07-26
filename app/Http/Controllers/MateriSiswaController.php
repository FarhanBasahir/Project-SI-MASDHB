<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MateriSiswaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $kelasIds = $user->kelas()->pluck('kelas.id');

        $materis = Materi::whereIn('kelas_id', $kelasIds)
                        ->with(['mataPelajaran', 'user']) // Eager loading
                        ->latest()
                        ->paginate(10);

        return view('siswa.materi.index', compact('materis'));
    }
}