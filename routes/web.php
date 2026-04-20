<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListBarangController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\AdminController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/contact', [HomeController::class, 'contact']);

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/user/{id}', function ($id) {
    return 'User dengan ID ' . $id;
});

// Route::prefix('admin')->group(function () {
//     Route::get('/dashboard', function () {
//         return 'Admin Dashboard';
//     });

//     Route::get('/users', function () {
//         return 'Admin Users';
//     });
// });

// Route::get('/listbarang/{id}/{nama}', function($id, $nama){
//     return view('list_barang', compact('id', 'nama'));
// });

// Route::get('/listbarang/{id}/{nama}', [ListBarangController::class, 'tampilkan']);

Route::get('/dosen/beranda', function () {
    $dosen = [
        'nama' => 'Yohana Floreta',
        'nama_panggilan' => 'Yohana',
    ];

    $statistik = [
        'kursus' => 3,
        'mahasiswa' => 90,
    ];

    $jadwal = [
        [
            'nama' => 'Pemograman Web',
            'detail' => 'IF 314 / GU 706 /08.40–10.40',
        ],
        [
            'nama' => 'Basis Data',
            'detail' => 'IF 319/ GU 805 /13.40–15.40',
        ],
        [
            'nama' => 'Jaringan Komputer',
            'detail' => 'IF 415/ TA 10.3 /15.40–17.00',
        ],
    ];

    return view('dosen.beranda', compact('dosen', 'statistik', 'jadwal'));
})->name('dosen.beranda');

Route::get('/dosen/kursus-saya', function () {
    $dosen = [
        'nama' => 'Yohana Floreta',
        'nama_panggilan' => 'Yohana'
    ];

    $courses = [
        ['kode' => 'IF314', 'nama' => "Pemograman\nWeb"],
        ['kode' => 'IF319', 'nama' => "Basis Data"],
        ['kode' => 'IF415', 'nama' => "Jaringan\nKomputer"],
    ];

    return view('dosen.kursus', compact('dosen', 'courses'));
});

// LOGIN
Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'prosesLogin']);

// MAHASISWA
Route::get('/mahasiswa/dashboard', [MahasiswaController::class, 'dashboard'])->name('mahasiswa.dashboard');
Route::get('/mahasiswa/krs', [MahasiswaController::class, 'krs'])->name('krs.index');
Route::get('/mahasiswa/khs', [MahasiswaController::class, 'khs'])->name('khs.index');
Route::post('/mahasiswa/krs/simpan', [MahasiswaController::class, 'simpanKrs'])->name('krs.simpan');
Route::get('/mahasiswa/lihat-krs', [MahasiswaController::class, 'lihatKrs'])->name('krs.lihat');

// DOSEN
Route::get('/dosen/dashboard', [DosenController::class, 'dashboard']);
Route::get('/dosen/matkul', [DosenController::class, 'matkul']);
Route::get('/dosen/kelas/{matkul}', [DosenController::class, 'kelas']);
Route::get('/dosen/input-nilai', [DosenController::class, 'inputNilai']);

// ADMIN
Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
Route::get('/admin/dosen', [AdminController::class, 'dosen']);
Route::get('/admin/mahasiswa', [AdminController::class, 'mahasiswa']);
Route::get('/admin/matkul', [AdminController::class, 'matkul']);