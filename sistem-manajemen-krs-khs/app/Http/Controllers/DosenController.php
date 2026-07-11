<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matkul;
use App\Models\Krs;
use App\Models\Semester;
use App\Models\Period;
use App\Models\Nilai;
use Illuminate\Support\Facades\Auth;
    
class DosenController extends Controller
{
    public function dashboard()
    {
        $dosen = Auth::user()->dosen;

    // semester aktif
    $semester = $this->getSemesterAktif();

    $semesterAktif = $semester['semesterAktif'];
    $semesterKe = $semester['semesterKe'];
    
    $jumlahKelas = Matkul::where('dosen_id', $dosen->id)
        ->when($semesterKe, function ($q) use ($semesterKe) {
            $q->where('semester', $semesterKe);
        })
        ->count();

    // jmlh mahasiswa
    $jumlahMahasiswa = Krs::whereHas('matkul', function ($q) use ($dosen, $semesterKe) {
        $q->where('dosen_id', $dosen->id);

        if ($semesterKe) {
            $q->where('semester', $semesterKe);
        }
    })
    ->distinct('mahasiswa_id')
    ->count('mahasiswa_id');

    return view('pages.dosen.dashboard', compact(
        'semesterAktif',
        'jumlahKelas',
        'jumlahMahasiswa'
    ));

    }

    public function kelas()
    {
        $user = Auth::user();
        $semester = $this->getSemesterAktif();

        $semesterAktif = $semester['semesterAktif'];
        $semesterKe = $semester['semesterKe'];
        
        $matkuls = Matkul::where('dosen_id', $user->dosen->id)
        ->where('semester', $semesterKe) 
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
    $user = Auth::user();
    $semesters = Semester::orderBy('id', 'desc')->get();

    // cek periode input nilai
    $semesterAktif = Semester::where('is_active',1)->first();
    
    $bisaInputNilai = false;
    
    if($semesterAktif){

    $bisaInputNilai = Period::where('type','nilai')
        ->where('semester_id',$semesterAktif->id)
        ->whereDate('start_date','<=',now())
        ->whereDate('end_date','>=',now())
        ->exists();
}

    // matkul milik dosen yang sedang login
    $matkuls = Matkul::where('dosen_id', $user->dosen->id)->get();

    $mahasiswas = collect();
    $selectedMatkul = null;

    if ($request->filled('matkul_id')) {

        $selectedMatkul = Matkul::find($request->matkul_id);

        $query = Krs::where('matkul_id', $request->matkul_id)
            ->with('mahasiswa', 'nilai');

        if ($request->filled('kelas')) {

            $query->whereHas('mahasiswa', function ($q) use ($request) {
                $q->where('kelas', $request->kelas);
            });
        }

        $mahasiswas = $query->get();
    }

    return view('pages.dosen.input_nilai', compact(
        'semesters',
        'matkuls',
        'mahasiswas',
        'selectedMatkul',
        'bisaInputNilai'
    ));
}

    // SIMPAN NILAI
    public function simpanNilai(Request $request)
{
    // cek periode input nilai
    $semesterAktif = Semester::where('is_active',1)->first();

$bisaInputNilai = false;

if($semesterAktif){

    $bisaInputNilai = Period::where('type','nilai')
        ->where('semester_id',$semesterAktif->id)
        ->whereDate('start_date','<=',now())
        ->whereDate('end_date','>=',now())
        ->exists();
}

    if (!$bisaInputNilai) {
        return back()->with(
            'error',
            'Periode input nilai sudah ditutup.'
        );
    }

    $krsValid = Krs::whereIn('id', array_keys($request->tugas))
    ->where('semester_id', $semesterAktif->id)
    ->exists();
    
    if (!$krsValid) {
        return back()->with('error', 'Data semester tidak valid untuk diedit.');
    }

    if ($request->has('tugas')) {

        foreach ($request->tugas as $krs_id => $tugas) {

            $uts = (float) ($request->uts[$krs_id] ?? 0);
            $uas = (float) ($request->uas[$krs_id] ?? 0);
            $tugas = (float) $tugas;

            // hitung nilai akhir
            $nilaiAkhir = round(
                ($tugas * 0.3) +
                ($uts * 0.3) +
                ($uas * 0.4),
                2
            );

            // konversi ke huruf
            if ($nilaiAkhir >= 85) {
                $nilaiHuruf = 'A';
            } elseif ($nilaiAkhir >= 70) {
                $nilaiHuruf = 'B';
            } elseif ($nilaiAkhir >= 55) {
                $nilaiHuruf = 'C';
            } elseif ($nilaiAkhir >= 40) {
                $nilaiHuruf = 'D';
            } else {
                $nilaiHuruf = 'E';
            }

            Nilai::updateOrCreate(
                ['krs_id' => $krs_id],
                [
                    'tugas' => $tugas,
                    'uts' => $uts,
                    'uas' => $uas,
                    'nilai_akhir' => $nilaiAkhir,
                    'nilai' => $nilaiHuruf,
                ]
            );
        }
    }

    return back()->with('success', 'Nilai berhasil disimpan!');
}

    // update profil
    public function updateProfil(Request $request)
    {
        $user = Auth::user();
        $dosen = $user->dosen;

        if ($request->hasFile('foto')) {

            $namaFile = time() . '.' . $request->foto->extension();

            $request->foto->move(
                public_path('foto-profil'),
                $namaFile
            );

            $dosen->foto = $namaFile;
        }

        $dosen->no_hp = $request->no_hp;
        $dosen->alamat = $request->alamat;

        $dosen->save();

        return redirect()->route('dosen.profil');
    }

    private function getSemesterAktif()
    {
        $semesterAktif = Semester::where('is_active', 1)->first();
        
        $semesterKe = null;
        
        if ($semesterAktif) {
            $semesterKe = (int) filter_var($semesterAktif->nama, FILTER_SANITIZE_NUMBER_INT);
        }
        
        return [
            'semesterAktif' => $semesterAktif,
            'semesterKe' => $semesterKe,
        ];
    }
}