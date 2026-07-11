<?php

namespace App\Http\Controllers;

use App\Models\Period;
use Carbon\Carbon;

class MahasiswaController extends Controller
{
    public function dashboard()
    {
        $semesterAktif = \App\Models\Semester::where('is_active', 1)->first();
        $periode = null;
        if ($semesterAktif) {
            $periode = Period::where('type', 'krs')
                ->where('semester_id', $semesterAktif->id)
                ->whereDate('start_date', '<=', now())
                ->whereDate('end_date', '>=', now())
                ->first();
        }

        return view('pages.mahasiswa.dashboard', compact('periode', 'semesterAktif'));
    }

    public function krs()
    {
        return view('pages.mahasiswa.krs');
    }

    public function khs()
    {
        return view('pages.mahasiswa.khs');
    }
}