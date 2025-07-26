<?php

use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => \App\Http\Middleware\CheckRole::class,
        ]);

        // Menangani PENGGUNA YANG SUDAH LOGIN mencoba akses halaman login
        $middleware->redirectUsersTo(function (Request $request) {
            $user = auth()->user();
            if ($user->role === 'admin' || $user->role === 'guru') {
                return route('filament.admin.pages.dashboard');
            }
            if ($user->role === 'siswa') {
                return route('siswa.dashboard');
            }
            return '/';
        });

        // Menangani PENGGUNA YANG BELUM LOGIN (GUEST) mencoba akses halaman terproteksi
        $middleware->redirectGuestsTo(function (Request $request) {
            if ($request->is('admin/*') || $request->is('admin') || $request->is('guru/*')) {
                return route('filament.admin.auth.login');
            }
            return route('siswa.login.form');
        });
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Ini menangani redirect saat middleware 'auth' gagal
        $exceptions->render(function (AuthenticationException $e, Request $request) {
            if ($request->is('admin/*') || $request->is('admin')) {
                return redirect()->guest(route('filament.admin.auth.login'));
            }

            return redirect()->guest(route('siswa.login.form'));
        });
    })->create();
