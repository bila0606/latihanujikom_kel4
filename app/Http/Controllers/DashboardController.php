<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Logika untuk halaman dashboard
        return view('dashboard.index'); // Sesuaikan dengan struktur view Anda
    }
}
