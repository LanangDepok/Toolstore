<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlatController;
use App\Http\Controllers\PinjamController;

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

Route::get('/', function () {
    return view('welcome');
});

//Mahasiswa
Route::resource('/mahasiswa', PinjamController::class);


Route::middleware('auth')->group(function () {
    //Admin
    Route::resource('/admin', AlatController::class);
    Route::get('/daftar_pinjam', [AlatController::class, 'daftar_pinjam'])->name('admin.daftar_pinjam');
    Route::delete('/alat/{id}', [AlatController::class, 'destroy2'])->name('admin.destroy2');
    Route::get('/pinjaman', [AlatController::class, 'pinjaman'])->name('admin.pinjaman');
    Route::get('/history', [AlatController::class, 'akhir'])->name('admin.history');

    Route::get('/kurangstok', [AlatController::class, 'selesai'])->name('admin.selesai');

    //Show tambahan
    Route::get('/mahasiswa2/{mahasiswa}', [PinjamController::class, 'show2'])->name('mahasiswa.show2');
    Route::get('/mahasiswa3/{mahasiswa}', [PinjamController::class, 'show3'])->name('mahasiswa.show3');

    Route::get('/admin2/{admin}/edit', [AlatController::class, 'edit2'])->name('admin.edit2');

    // Menyimpan perubahan pada Pinjaman.blade.php
    Route::put('/admin2/{admin}', [AlatController::class, 'update2'])->name('admin.update2');
    Route::patch('/admin2/{admin}', [AlatController::class, 'update2'])->name('admin.update2');

    Route::get('/ending', [AlatController::class, 'history'])->name('admin.ending');

    Route::post('/logout', [AlatController::class, 'logout']);
});


Route::middleware('guest')->group(function () {
    Route::get('/login', [AlatController::class, 'login'])->name('login');
    Route::post('/login', [AlatController::class, 'authenticate']);
});

Route::get('/exportpdf', [AlatController::class, 'exportpdf'])->name('exportpdf');

Route::get('/main', [PinjamController::class, 'landing'])->name('mahasiswa.landing');
Route::get('/riwayat', [PinjamController::class, 'akhir'])->name('mahasiswa.history');