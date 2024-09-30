<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Coba autentikasi user
        if (Auth::attempt($request->only('email', 'password'))) {
            // Autentikasi berhasil
            return redirect()->route('users.dashboard')->with('success', 'Login berhasil!');
            
            // return redirect()->route('siswa.index')->with('success', 'Login berhasil!');
        }

        // Autentikasi gagal
        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        if (Auth::check()) {
            dd('User masih login');
        }
    
        // Hapus semua sesi pengguna saat logout
        $request->session()->invalidate();
    
        // Regenerasi token untuk keamanan
        $request->session()->regenerateToken();
    
        return redirect()->route('login')->with('success', 'Logout berhasil!');
    }
}
