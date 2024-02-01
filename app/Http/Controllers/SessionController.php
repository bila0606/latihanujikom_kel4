<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{
    // akan menampilkan form untuk memasukan email dan password
    function index()
    {
        return view("sesi/index");
    }
    // akan melakukan otentikasi dari email dan password di bagian fungsi index
    function login(Request $request)
    {
        Session::flash('email' ,$request->email);
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ],[
            //menampilkan pesan error
            'email.required'=>'Email wajib diisi',
            'password.required'=>'Password wajib diisi',
        ]);

        //otentikasi 
        $infologin = [
            'email'=>$request->email,
            'password'=>$request->password
            
        ];

        if(Auth::attempt($infologin)){
            //kalau otentikasi sukses (g d pke)
            // return 'sukses';
            return redirect('siswa')->with('success', 'Berhasil login');

        } else {
            //kalau otentikasi gagal(g d pke)
            // return 'gagal';
            return redirect('sesi')->withErrors('Username dan password yang dimasukkan tidak valid');
        }
    }
}

