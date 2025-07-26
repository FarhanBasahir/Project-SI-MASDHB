<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use Illuminate\Http\Request;
use App\Models\JawabanTugas;
use Illuminate\Support\Facades\Auth;

class SiswaTugasController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $kelasIds = $user->kelas()->pluck('kelas.id');

        $tugas = Tugas::whereIn('kelas_id', $kelasIds)
                        ->with(['mataPelajaran'])
                        ->latest()
                        ->paginate(10);

        return view('siswa.tugas.index', compact('tugas'));
    }

    public function show(Tugas $tugas)
    {
        // Cek apakah siswa sudah pernah mengumpulkan jawaban untuk tugas ini
        $jawaban = JawabanTugas::where('tugas_id', $tugas->id)
                               ->where('user_id', Auth::id())
                               ->first();

        return view('siswa.tugas.show', compact('tugas', 'jawaban'));
    }

    public function kumpulkan(Request $request, Tugas $tugas)
    {
        $request->validate([
            'jawaban_teks' => 'nullable|string',
            'file_jawaban' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:5120', // Max 5MB
        ]);

        $filePath = null;
        if ($request->hasFile('file_jawaban')) {
            $filePath = $request->file('file_jawaban')->store('jawaban-tugas', 'public');
        }

        // Gunakan updateOrCreate untuk membuat atau memperbarui jawaban
        JawabanTugas::updateOrCreate(
            [
                'tugas_id' => $tugas->id,
                'user_id' => Auth::id(),
            ],
            [
                'jawaban_teks' => $request->jawaban_teks,
                'file_jawaban' => $filePath ?? null,
            ]
        );

        return redirect()->route('siswa.tugas.show', $tugas)->with('sukses', 'Jawaban berhasil dikumpulkan!');
    }
}