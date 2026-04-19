<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
        public function dashboard()
    {
        return view('mahasiswa.dashboard');
    }

    public function krs()
    {
        return view('mahasiswa.krs');
    }

    public function khs()
    {
        return view('mahasiswa.khs');
    }
}
