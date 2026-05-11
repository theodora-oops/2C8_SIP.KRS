<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// ================= DEFAULT =================
Route::get('/', function () {
     return redirect('/pages/home');
});

Route::get('/dashboard', function () {  
    return view('pages.dashboard');
 })->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/redirect-role', function () {
    $user = Auth::user();

    if ($user->role == 'admin') {
        return redirect('/admin/dashboard');
    } elseif ($user->role == 'dosen') {
        return redirect('/dosen/dashboard');
    } elseif ($user->role == 'mahasiswa') {
        return redirect('/mahasiswa/dashboard');
    }

    return redirect('/');
})->middleware('auth');


// ================= PROFILE =================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ================= ADMIN =================
use App\Http\Controllers\AdminController;

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->middleware('auth');

// ================= USER =================
use App\Http\Controllers\UserController;

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/pengguna', [UserController::class, 'index'])->name('pengguna.index');
    Route::post('/admin/pengguna', [UserController::class, 'store'])->name('pengguna.store');
    Route::put('/admin/pengguna/{id}', [UserController::class, 'update'])->name('pengguna.update');
    Route::delete('/admin/pengguna/{id}', [UserController::class, 'destroy'])->name('pengguna.destroy');
});

// ================= MATKUL =================
use App\Http\Controllers\Admin\MatkulController;

Route::prefix('admin')->group(function () {
    Route::get('/matkul', [MatkulController::class, 'index'])->name('matkul.index');
    Route::post('/matkul', [MatkulController::class, 'store'])->name('matkul.store');
    Route::put('/matkul/{id}', [MatkulController::class, 'update'])->name('matkul.update');
    Route::delete('/matkul/{id}', [MatkulController::class, 'destroy'])->name('matkul.destroy');
});

// ================= SEMESTER =================
use App\Http\Controllers\Admin\SemesterController;

Route::prefix('admin')->group(function () {
    Route::get('/semester', [SemesterController::class, 'index'])->name('semester.index');
    Route::post('/semester', [SemesterController::class, 'store'])->name('semester.store');
    Route::delete('/semester/{id}', [SemesterController::class, 'destroy'])->name('semester.destroy');
    Route::post('/semester/{id}/activate', [SemesterController::class, 'activate'])->name('semester.activate');
});

// ================= DOSEN =================
use App\Http\Controllers\DosenController;

Route::middleware(['auth','role:dosen'])
    ->prefix('dosen')
    ->name('dosen.')
    ->group(function () {

        Route::get('/dashboard', [DosenController::class, 'dashboard'])->name('dashboard');
        Route::get('/kelas', [DosenController::class, 'kelas'])->name('kelas');
        Route::get('/kelas/{id}', [DosenController::class, 'detailKelas'])->name('detail_kelas');
        Route::get('/nilai', [DosenController::class, 'inputNilai'])->name('nilai'); 
        Route::post('/nilai/simpan', [DosenController::class, 'simpanNilai'])->name('nilai.simpan');
});

// ================= MAHASISWA =================
Route::get('/mahasiswa/dashboard', function () {
    return view('pages.mahasiswa.dashboard');
});

use App\Http\Controllers\KrsController;

Route::middleware(['auth','role:mahasiswa'])->group(function () {
    Route::get('/mahasiswa/krs', [KrsController::class, 'index']);
    Route::post('/mahasiswa/krs', [KrsController::class, 'store']);
});

Route::get('/mahasiswa/riwayat-krs', [KrsController::class, 'riwayat']);
Route::get('/mahasiswa/khs', [KrsController::class, 'khs']);


// ================= PRAKTIKUM 6 PW =================

// PRODUCT 
use App\Http\Controllers\ProductController;
Route::get('/product', [ProductController::class, 'index']);


// ================= PAGES  =================
Route::prefix('pages')->group(function () {

    Route::get('/home', function () {
        return view('pages.home', [
            'nama' => 'Enif',
            'pekerjaan' => 'Mahasiswa',
        ]);
    });

    Route::get('/about', function () {
        return view('pages.about');
    });

    Route::get('/contact', function () {
        return view('pages.contact');
    });

    Route::get('/product', function () {
        return view('pages.product');
    });

    Route::get('/login', function () {
        return view('auth.login');
    });

    Route::get('/register', function () {
        return view('auth.register');
    });

    Route::get('/dashboard', function () {
        return view('auth.dashboard');
    });

});


// ================= AUTH =================
require __DIR__.'/auth.php';