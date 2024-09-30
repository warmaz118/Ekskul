<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembimbingMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah user login dan role-nya Pembimbing
        if (Auth::check() && Auth::user()->role->name === 'Pembimbing') {
            return $next($request);
        }

        // Redirect jika bukan Pembimbing
        return redirect('/')->with('error', 'Anda tidak memiliki akses.');
    }
}

