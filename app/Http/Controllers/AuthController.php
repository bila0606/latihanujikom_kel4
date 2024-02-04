<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
    public function login()
    {
        return view('login'); 
    }

    public function register()
    {
        return view('register'); 
    }

    public function authenticasting(Request $request)
    {
        $scredentials = $request->validate([
            'username'=> ['required'],
            'password'=> ['required'],
        ]);
        
        //cek apakah login valid
       
        if (Auth::attempt($credentials)) {
             //cek apakah user status = active
             if(Auth::user()->status != 'active'){
                // return redirect('login')->with('status', 'Your account is not active yet. please contact 
                // admin!');
                Session::flash('status', 'failed');
                Session::flash('message', 'Your account is not active yet. please contact 
                admin!'); 
                return redirect('/login');  
             } 
             //usenya admin 
            //  $request->session()->regenerate();
             if(Auth::user()->role_id == 1) {
                return redirect('dashboard');
             }
             
             if(Auth::user()->role_id == 2) {
                return redirect('profile');

            
           
        }
        Session::flash('status', 'failed');
        Session::flash('message', 'login Invalid');
        return redirect('/login');

        }
    }
}
