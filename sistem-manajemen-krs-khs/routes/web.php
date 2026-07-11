<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// ================= DEFAULT =================
Route::get('/', function () {
     return redirect('/pages/home');
});

use App\Http\Controllers\AuthController;
Route::get('/login', [AuthController::class, 'login'])
    ->name('login');

Route::post('/login', [AuthController::class, 'prosesLogin']);

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
    Route::put('/semester/{id}', [SemesterController::class, 'update'])->name('semester.update');
    Route::post('/semester', [SemesterController::class, 'store'])->name('semester.store');
    Route::delete('/semester/{id}', [SemesterController::class, 'destroy'])->name('semester.destroy');
    Route::post('/semester/{id}/activate', [SemesterController::class, 'activate'])->name('semester.activate');
});

// ================= PERIODE =================
use App\Http\Controllers\Admin\PeriodController;
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/periods', [PeriodController::class, 'index'])->name('periods.index');
    Route::post('/periods', [PeriodController::class, 'store'])->name('periods.store');
    Route::delete('/periods/{id}', [PeriodController::class, 'destroy'])->name('periods.destroy');
    Route::put('/periods/{id}', [PeriodController::class, 'update'])
    ->name('periods.update');
});

// ================= PROFIL =================
use App\Http\Controllers\ProfileController;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile.index');

    Route::put('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
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

        Route::get('/profil-dosen', [ProfileController::class, 'index'])
            ->name('profil');
    });

// ================= MAHASISWA =================
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\KrsController;

Route::middleware(['auth', 'role:mahasiswa'])
    ->prefix('mahasiswa')
    ->group(function () {

        Route::get('/dashboard', [MahasiswaController::class, 'dashboard']);

        Route::get('/krs', [KrsController::class, 'index'])
            ->name('mahasiswa.krs.index');

        Route::post('/krs', [KrsController::class, 'store'])
            ->name('mahasiswa.krs.store');

        Route::get('/riwayat-krs', [KrsController::class, 'riwayat']);
        Route::get('/khs', [KrsController::class, 'khs']);
    });

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

    Route::get('/register', function () {
        return view('auth.register');
    });

    Route::get('/dashboard', function () {
        return view('auth.dashboard');
    });

});


// ================= AUTH =================
require __DIR__.'/auth.php';