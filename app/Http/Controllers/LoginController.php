<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Menampilkan halaman login
     */
    public function showLoginForm()
    {
        return view('auth.login'); // Pastikan view ada di resources/views/auth/login.blade.php
    }

    /**
     * Proses login pengguna
     */
    public function login(Request $request)
    {
        // Validasi input dengan pesan kustom
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email tidak boleh lebih dari 255 karakter.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
        ]);

        $credentials = $request->only('email', 'password');
        
        // Coba autentikasi pengguna
        if (Auth::attempt($credentials)) {
            // Regenerasi session untuk keamanan
            $request->session()->regenerate();
            
            // Redirect ke halaman dashboard dengan pesan sukses
            return redirect()->route('dashboard')->with('loginSuccess', 'Login berhasil! Selamat datang.');
        }

        // Jika gagal login, kembali dengan pesan error
        return back()->with('loginError', 'Login gagal! Periksa kembali email dan password.');
    }

    /**
     * Proses logout pengguna
     */
    public function logout(Request $request)
    {
        Auth::logout(); // Logout pengguna

        // Hapus session dan buat ulang token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('logoutSuccess', 'Anda berhasil logout.'); // Redirect ke halaman login
    }
}
