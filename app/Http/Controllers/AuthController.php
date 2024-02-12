<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller

   
{

    // Menampilkan form registrasi
    public function create()
    {
        return view('auth.register');
    }

    // Menangani proses registrasi
    public function register(Request $request)
    {
        // Menambahkan middleware guest
        $this->middleware('guest'); 

        // Logika registrasi disini
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users', // Pastikan email bersifat unik pada tabel users
            'password' => 'required|string|min:6|confirmed',
            // 'nama lengkap' 
            // 'alamat' 
            // 'hak akses' 
        ]);
    }

    // Menampilkan form login
    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    try {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Jika berhasil, redirect ke halaman setelah login
            return redirect('/dashboard');
        }
    } catch (\Exception $e) {
        // Tampilkan pesan kesalahan untuk di-debug
        dd($e->getMessage());
    }
    
    // Jika gagal, redirect kembali dengan pesan kesalahan
    return redirect('/login')->with('error', 'Email atau password salah');
    
}
}