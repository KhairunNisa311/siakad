<?php

use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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

Route::resource('mahasiswa', MahasiswaController::class);
Route::get('/search',[MahasiswaController::class, 'search'])->name('search');
Route::get('nilai/{id}', [MahasiswaController::class, 'nilai'])->name('nilai');
Route::get('/mahasiswa/cetak_pdf/{id}',[MahasiswaController::class, 'cetak_nilai'])->name('cetak_nilai');


