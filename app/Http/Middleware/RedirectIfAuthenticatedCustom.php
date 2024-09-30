<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticatedCustom
{
    public function handle($request, Closure $next)
    {
        // Cek apakah user sudah login
        if (Auth::check()) {
            // Redirect ke halaman yang sesuai, misal ke dashboard atau home
            return redirect()->route('users.dashboard'); 
        }

        // Lanjutkan ke halaman yang diminta jika belum login
        return $next($request);
    }
}
