<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//view welcome
Route::get('/', function () {
    return view('template_back.layout');
})->name('home');



use App\Http\Controllers\AuthController;

// Rute untuk menampilkan form registrasi
Route::get('/register', [AuthController::class, 'create'])->name('register');

// Rute untuk menangani proses registrasi
Route::post('/register', [AuthController::class, 'register']);

// Rute untuk menampilkan halaman login
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');

// Rute untuk mengelola proses login
Route::post('/login', [LoginController::class, 'authenticate'])->name('login')->middleware('guest');
// Rute untuk mengelola proses logout
Route::post('/logout', 'AuthController@logout')->name('logout');


Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
