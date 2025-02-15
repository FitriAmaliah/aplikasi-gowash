<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        // Validasi input dengan pesan kustom
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email tidak boleh lebih dari 255 karakter.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.confirmed' => 'Konfirmasi password wajib diisi.',  
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.string' => 'Password harus berupa teks.',
            'password.min' => 'Password minimal 8 karakter.',
          
        ]);
    
        // Generate id_member dengan angka acak 6 digit
        $id_member = 'ID-' . rand(100000, 999999);
    
        // Membuat pengguna baru dengan id_member yang sudah di-generate
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_member' => $id_member,  // Menambahkan id_member
        ]);
    
        // Login pengguna setelah registrasi
        Auth::login($user);
    
        // Redirect ke halaman login atau halaman lain yang diinginkan
        return redirect()->route('login')->with('success', 'Akun Anda berhasil dibuat. Silakan login.');
    }
    

}
