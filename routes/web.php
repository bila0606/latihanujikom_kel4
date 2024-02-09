<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

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

Route::get('/', function () {
    return view('template_back.index');
});

Route::get('/crud',function(){
    return view('Buku.index');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::match(['get','post'],'/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(['auth','roleaccess:administrator,operator']);

Route::resource('/data_buku','DataBukuController')->except(['show'])->middleware(['auth','roleaccess:administrator,operator']);