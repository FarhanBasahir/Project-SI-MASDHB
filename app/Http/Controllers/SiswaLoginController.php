<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaLoginController extends Controller
{
    public function showLoginForm()
    {
        // Ganti nama view agar lebih spesifik
        return view('auth.siswa_login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            if (Auth::user()->role === 'siswa') {
                $request->session()->regenerate();
                return redirect()->route('siswa.dashboard'); // Arahkan ke dasbor siswa
            }
            Auth::logout(); // Jika bukan siswa, paksa logout
        }

        return back()->withErrors([
            'email' => 'Email atau Password salah, atau Anda bukan siswa.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/'); // Kembali ke halaman utama
    }
}