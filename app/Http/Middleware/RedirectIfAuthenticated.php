<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Jika pengguna sudah login di guard 'admin', arahkan ke dasbor admin
                if ($guard === 'admin') {
                    return redirect()->route('filament.admin.pages.dashboard');
                }
                
                // Jika tidak, berarti guard 'web' (untuk siswa), arahkan ke dasbor siswa
                return redirect()->route('siswa.dashboard');
            }
        }

        return $next($request);
    }
}
