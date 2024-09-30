<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah user login
        if (Auth::check()) {
            // Cek role-nya Admin atau Pembimbing
            if (Auth::user()->role->name === 'Admin' || Auth::user()->role->name === 'Pembimbing') {
                return $next($request);
            }
        }

        // Redirect jika bukan Admin atau tidak login
        return redirect('/')->with('error', 'Anda tidak memiliki akses.');
    }
}
