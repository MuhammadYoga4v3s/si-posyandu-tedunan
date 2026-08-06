<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // <-- Ini penerjemah yang bikin errornya hilang

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Kita ganti auth()->check() pakai Auth::check() biar sistem nggak bingung
        if (Auth::check() && Auth::user()->role === 'administrator') {
            return $next($request);
        }

        abort(403, 'Akses Ditolak: Halaman ini khusus Administrator.');
    }
}