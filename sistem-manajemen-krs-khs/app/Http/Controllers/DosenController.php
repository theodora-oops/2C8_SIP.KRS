<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matkul;
use App\Models\Krs;
use App\Models\Semester;
use Illuminate\Support\Facades\Auth;
    
class DosenController extends Controller
{
    public function dashboard()
    {
        return view('pages.dosen.dashboard');
    }

    public function kelas()
    {
        $user = Auth::user();
        $semesterAktif = \App\Models\Semester::where('is_active', 1)->first();
        
        $matkuls = \App\Models\Matkul::where('dosen_id', $user->id) 
        ->where('semester', $semesterAktif->id ?? null) 
        ->withCount('krs') 
        ->get();

    return view('pages.dosen.kelas', compact('matkuls', 'semesterAktif'));
    }

    public function detailKelas(int $id)
    {
        $matkul = Matkul::where('id', $id)->firstOrFail();
        $mahasiswas = Krs::where('matkul_id', $id)->with('mahasiswa')->get();
        return view('pages.dosen.detail_kelas', compact('matkul', 'mahasiswas'));
    }

    // INPUT NILAI
    public function inputNilai(Request $request)
    {
        $user     = Auth::user();
        $semesters = Semester::orderBy('id', 'desc')->get();

        // matkuls milik dosen yang sedang login
        $matkuls = Matkul::where('dosen_id', $user->id)->get();

        $mahasiswas    = collect();
        $selectedMatkul = null;

        if ($request->filled('matkul_id')) {
            $selectedMatkul = Matkul::find($request->matkul_id);

            $query = Krs::where('matkul_id', $request->matkul_id)
                        ->with('mahasiswa');

            if ($request->filled('kelas')) {
                $query->where('kelas', $request->kelas);
            }

            $mahasiswas = $query->get();
        }

        return view('pages.dosen.input_nilai', compact(
            'semesters', 'matkuls', 'mahasiswas', 'selectedMatkul'
        ));
    }

    // SIMPAN NILAI
    public function simpanNilai(Request $request)
    {
        if ($request->has('tugas')) {
            foreach ($request->tugas as $krs_id => $tugas) {
                $uts   = (float)($request->uts[$krs_id] ?? 0);
                $uas   = (float)($request->uas[$krs_id] ?? 0);
                $tugas = (float)$tugas;

                // Rumus: 30% Tugas + 30% UTS + 40% UAS
                $nilai = round(($tugas * 0.3) + ($uts * 0.3) + ($uas * 0.4), 2);

                Krs::where('id', $krs_id)->update([
                    'tugas' => $tugas,
                    'uts'   => $uts,
                    'uas'   => $uas,
                    'nilai' => $nilai,
                ]);
            }
        }

        return back()->with('success', 'Nilai berhasil disimpan!');
    }
}
