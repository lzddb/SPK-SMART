<?php

use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\HitungController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\SubKriteriaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/penilaian', [PenilaianController::class, 'index'])->name('penilaian');
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::post('/logout', [LoginController::class, 'keluar'])->name('keluar');
    Route::get('/perangkingan', [HitungController::class, 'rangking'])->name('rangking');

    Route::middleware(['isAdmin'])->group(function () {
        Route::get('/kriteria', [kriteriaController::class, 'index'])->name('kriteria');
        Route::POST('/kriteria', [kriteriaController::class, 'store'])->name('tambah-kriteria');
        Route::put('/kriteria/{id}', [kriteriaController::class, 'update'])->name('update-kriteria');
        Route::get('/kriteria/delete/{id}', [kriteriaController::class, 'destroy'])->name('delete-kriteria');

        Route::get('/sub-kriteria', [SubKriteriaController::class, 'index'])->name('subkriteria');
        Route::POST('/sub-kriteria', [SubKriteriaController::class, 'store'])->name('tambah-sub-kriteria');
        Route::put('/sub-kriteria/{id}', [SubKriteriaController::class, 'update'])->name('update-sub-kriteria');
        Route::get('/sub-kriteria/delete/{id}', [SubKriteriaController::class, 'destroy'])->name('delete-sub-kriteria');

        Route::get('/alternatif', [AlternatifController::class, 'index'])->name('alternatif');
        Route::post('/alternatif', [AlternatifController::class, 'store'])->name('tambah-alternatif');
        Route::put('/alternatif/{id}', [AlternatifController::class, 'update'])->name('update-alternatif');
        Route::get('/alternatif/delete/{id}', [AlternatifController::class, 'destroy'])->name('delete-alternatif');

        Route::post('penilaian', [PenilaianController::class, 'store'])->name('tambah-penilaian');

        Route::get('/perhitungan', [HitungController::class, 'hitung'])->name('perhitungan');

        Route::post('/user', [UserController::class, 'store'])->name('tambah-user');
        Route::put('/user/{id}', [UserController::class, 'update'])->name('update-user');
        Route::get('/user/delete/{id}', [UserController::class, 'destroy'])->name('delete-user');
    });
});
