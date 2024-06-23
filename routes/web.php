<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KuadranController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PenilaianPegawaiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::redirect('/', '/login');

// Rute login dan logout
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// Rute registrasi
Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [UserController::class, 'register']);

// Group rute yang memerlukan autentikasi
Route::middleware('auth')->group(function () {

    // Rute dashboard
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

    // Rute untuk Pegawai
    Route::get('/data-pegawai', [PegawaiController::class, 'index'])->name('data-pegawai');
    Route::post('/submit-data-pegawai', [PegawaiController::class, 'store']);
    Route::get('/edit-pegawai/{id}', [PegawaiController::class, 'edit'])->name('pegawai.edit');
    Route::put('/update-pegawai/{id}', [PegawaiController::class, 'update'])->name('pegawai.update');
    Route::delete('/delete-pegawai/{id}', [PegawaiController::class, 'destroy'])->name('pegawai.destroy');

    // Rute untuk Penilaian Pegawai
    Route::get('/penilaian-pegawai', [PenilaianPegawaiController::class, 'index'])->name('penilaian.index');
    Route::post('/penilaian-pegawai', [PenilaianPegawaiController::class, 'store'])->name('penilaian.store');
    Route::put('/penilaian-pegawai/{id}', [PenilaianPegawaiController::class, 'update'])->name('penilaian.update');
    Route::delete('/penilaian-pegawai/{id}', [PenilaianPegawaiController::class, 'destroy'])->name('penilaian.destroy');

    // Rute untuk Kuadran
    Route::get('/kuadran', [KuadranController::class, 'index'])->name('kuadran.index');
    Route::post('/kuadran/store', [KuadranController::class, 'store'])->name('kuadran.store');
    Route::put('/kuadran/update/{id}', [KuadranController::class, 'update'])->name('kuadran.update');
    Route::delete('/kuadran/delete/{id}', [KuadranController::class, 'destroy'])->name('kuadran.destroy');
});