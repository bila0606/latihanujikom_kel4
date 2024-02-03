<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        Session::flash('email, $request->email');
        $request->validate([
            'email'=>'required',
            'password'=>'required'

        ],[
            'email.required'=> 'Email wajib diisi',
            'password.required'=> 'password wajib diisi',

        ]);

        $infologin = [
            'email => $require->email',
            'password => $require->password'
        ];
         if (Auth::attempt($infologin)) {
            //kalau otentikasi sukses
            // return 'sukses';
            return redirect('sesi')->with('success', 'Berhasil login');
         } else {
            //kalau otentikasi gagal
            // return 'gagal';
            return redirect('sesi')->withErrors('Username dan password yang dimasukan tidak valid');
         }
        
    }
}
