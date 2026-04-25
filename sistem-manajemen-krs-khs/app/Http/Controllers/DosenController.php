<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matkul;
use App\Models\Semester;
use App\Models\Krs;
use Illuminate\Support\Facades\Auth;

class DosenController extends Controller
{
    public function dashboard()
    {
        return view('dosen.dashboard');
    }

    //  INI UNTUK LIST KELAS DOSEN
    public function kelas()
    {
        $user = Auth::user();

        $semesterAktif = Semester::where('is_active', 1)->first();

        $matkuls = Matkul::where('dosen_id', $user->id)
            ->where('semester', $semesterAktif->id ?? null)
            ->get();

        return view('dosen.kelas', compact('matkuls', 'semesterAktif'));
    }

    //  INI UNTUK LIST MAHASISWA
    public function detailKelas($id)
    {
        $matkul = Matkul::findOrFail($id);

        $mahasiswas = Krs::where('matkul_id', $id)
            ->with('mahasiswa')
            ->get();

        return view('dosen.detail_kelas', compact('matkul', 'mahasiswas'));
    }

    public function inputNilai()
    {
        return view('dosen.input_nilai');
    }
}