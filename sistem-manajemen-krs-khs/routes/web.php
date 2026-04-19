<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware('auth');

use App\Http\Controllers\UserController;
//admin
Route::middleware(['auth'])->group(function () {

    Route::get('/admin/pengguna', [UserController::class, 'index'])->name('pengguna.index');
    Route::post('/admin/pengguna', [UserController::class, 'store'])->name('pengguna.store');
    Route::put('/admin/pengguna/{id}', [UserController::class, 'update'])->name('pengguna.update');
    Route::delete('/admin/pengguna/{id}', [UserController::class, 'destroy'])->name('pengguna.destroy');

});

//dosen
    Route::get('/dosen/dashboard', function () {
        return view('dosen.dashboard');
    });

//mhs
    Route::get('/mahasiswa/dashboard', function () {
        return view('mahasiswa.dashboard');
    });

use App\Http\Controllers\KrsController;

Route::middleware(['auth','role:mahasiswa'])->group(function () {
    Route::get('/mahasiswa/krs', [KrsController::class, 'index']);
    Route::post('/mahasiswa/krs', [KrsController::class, 'store']);
});
Route::get('/mahasiswa/riwayat-krs', [KrsController::class, 'riwayat']);
Route::get('/mahasiswa/khs', [KrsController::class, 'khs']);

require __DIR__.'/auth.php';
