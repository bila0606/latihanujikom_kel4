<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataBukuController;

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

// Route::get('/', function () {
//     return view('template_back.index');
// });

// Route::get('/crud',function(){
//     return view('Buku.index');
// });

// Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// Route::match(['get','post'],'/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(['auth','roleaccess:administrator,operator']);

// Route::resource('/data_buku','DataBukuController')->except(['show'])->middleware(['auth','roleaccess:administrator,operator']);

Route::get('/', [LoginController::class, 'index'])->middleware('guest');

//AUTH MANUAL
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login')->middleware('guest');
Route::match(['get','post'],'/logout', [LoginController::class, 'logout'])->name('logout');

//BACK OFFICE
Route::resource('/dashboard','DashboardController')->except(['show'])->middleware(['auth','roleaccess:administrator,operator']);
Route::match(['get','post'],'/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(['auth']);

Route::resource('/data_buku','DataBarangController')->except(['show'])->middleware(['auth','roleaccess:administrator,operator']);
Route::match(['get','post'],'/data_buku', [DataBukuController::class, 'index'])->name('data_buku')->middleware(['auth','roleaccess:administrator,operator']);
Route::get('/data_buku/input', [DataBukuController::class, 'input'])->name('data_buku.input')->middleware(['auth','roleaccess:administrator,operator']);
Route::post('/data_buku/create', [DataBukuController::class, 'create'])->name('data_buku.create')->middleware(['auth','roleaccess:administrator,operator']);
Route::get('/data_buku/edit/{id}', [DataBukuController::class, 'edit'])->name('data_buku.edit')->middleware(['auth','roleaccess:administrator,operator']);
Route::put('/data_buku/update/{id}', [DataBukuController::class, 'update'])->name('data_buku.update')->middleware(['auth','roleaccess:administrator,operator']);
Route::delete('/data_buku/destroy/{id}', [DataBukuController::class, 'destroy'])->name('data_buku.destroy')->middleware(['auth','roleaccess:administrator,operator']);
Route::post('/data_buku/import_excel', [DataBukuController::class, 'import_excel'])->name('data_buku.import_excel')->middleware(['auth','roleaccess:administrator,operator']);
Route::get('/data_buku/export_excel', [DataBukuController::class, 'export_excel'])->name('data_buku.export_excel')->middleware(['auth','roleaccess:administrator,operator']);
Route::get('/data_buku/export_pdf', [DataBukuController::class, 'export_pdf'])->name('data_buku.export_pdf')->middleware(['auth','roleaccess:administrator,operator']);

// Route::group(['middleware'=>['auth','roleaccess:administrator']], function(){
//     Route::resource('/data_pengguna','DataPenggunaController')->except(['show']);
//     Route::match(['get','post'],'/data_pengguna', [DataPenggunaController::class, 'index'])->name('data_pengguna');
//     Route::get('/data_pengguna/input', [DataPenggunaController::class, 'input'])->name('data_pengguna.input');
//     Route::post('/data_pengguna/create', [DataPenggunaController::class, 'create'])->name('data_pengguna.create');
//     Route::get('/data_pengguna/edit/{id}', [DataPenggunaController::class, 'edit'])->name('data_pengguna.edit');
//     Route::put('/data_pengguna/update/{id}', [DataPenggunaController::class, 'update'])->name('data_pengguna.update');
//     Route::delete('/data_pengguna/destroy/{id}', [DataPenggunaController::class, 'destroy'])->name('data_pengguna.destroy');



//     Route::post('/data_pengguna/import_excel', [DataPenggunaController::class, 'import_excel'])->name('data_pengguna.import_excel')->middleware(['auth','roleaccess:administrator,operator']);
//     Route::get('/data_pengguna/export_excel', [DataPenggunaController::class, 'export_excel'])->name('data_pengguna.export_excel')->middleware(['auth','roleaccess:administrator,operator']);
//     Route::get('/data_pengguna/export_pdf', [DataPenggunaController::class, 'export_pdf'])->name('data_pengguna.export_pdf')->middleware(['auth','roleaccess:administrator,operator']);
// });
