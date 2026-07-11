<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matkul;
use App\Models\Krs;
use App\Models\Semester;
use App\Models\Period;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class KrsController extends Controller
{
    public function index()
{
    $user = Auth::user();
    $mahasiswa = $user->mahasiswa;

    // Semester aktif
    $semesterAktif = Semester::where('is_active', 1)->first();

    if (!$semesterAktif) {
        return back()->with('error', 'Belum ada semester yang aktif.');
    }

    // Mata kuliah semester aktif
    $matkuls = Matkul::where('semester', $semesterAktif->id)
        ->orderBy('kode_mk')
        ->get();

    // KRS yang sudah dipilih
    $krs = Krs::where('mahasiswa_id', $mahasiswa->id)
        ->where('semester_id', $semesterAktif->id)
        ->pluck('matkul_id')
        ->toArray();

    // Bobot nilai
    $bobot = [
        'A' => 4,
        'B' => 3,
        'C' => 2,
        'D' => 1,
        'E' => 0
    ];

    // Hitung IPK
    $riwayat = Krs::with(['matkul', 'nilai'])
        ->where('mahasiswa_id', $mahasiswa->id)
        ->get();

    $totalSks = 0;
    $totalBobot = 0;

    foreach ($riwayat as $item) {

        if (!$item->nilai) {
            continue;
        }

        $huruf = $item->nilai->nilai;
        $nilai = $bobot[$huruf] ?? 0;
        $sks = $item->matkul->sks ?? 0;

        $totalSks += $sks;
        $totalBobot += ($nilai * $sks);
    }

    $ipk = $totalSks > 0
        ? round($totalBobot / $totalSks, 2)
        : '-';

    // Hitung IPS semester sebelumnya
    $semesterLalu = $semesterAktif->id - 1;

    $krsSemesterLalu = Krs::with(['matkul', 'nilai'])
        ->where('mahasiswa_id', $mahasiswa->id)
        ->where('semester_id', $semesterLalu)
        ->get();

    $semesterSks = 0;
    $semesterBobot = 0;

    foreach ($krsSemesterLalu as $item) {

        if (!$item->nilai) {
            continue;
        }

        $huruf = $item->nilai->nilai;
        $nilai = $bobot[$huruf] ?? 0;
        $sks = $item->matkul->sks ?? 0;

        $semesterSks += $sks;
        $semesterBobot += ($nilai * $sks);
    }

    $ips = $semesterSks > 0
        ? round($semesterBobot / $semesterSks, 2)
        : '-';

    // Cek periode KRS
    $bisaIsiKrs = Period::where('type', 'krs')
        ->where('semester_id', $semesterAktif->id)
        ->whereDate('start_date', '<=', now())
        ->whereDate('end_date', '>=', now())
        ->exists();

    return view('pages.mahasiswa.krs', compact(
        'matkuls',
        'krs',
        'semesterAktif',
        'ips',
        'ipk',
        'mahasiswa',
        'bisaIsiKrs'
    ));
}

    public function store(Request $request)
{
    $mahasiswaId = Auth::user()->mahasiswa->id;

    $semesterAktif = Semester::where('is_active', 1)->first();

    if (!$semesterAktif) {
        return back()->with('error', 'Belum ada semester yang aktif.');
    }

    // Cek periode KRS
    $bisaIsiKrs = Period::where('type', 'krs')
        ->where('semester_id', $semesterAktif->id)
        ->whereDate('start_date', '<=', now())
        ->whereDate('end_date', '>=', now())
        ->exists();

    if (!$bisaIsiKrs) {
        return back()->with('error', 'Periode pengisian KRS sudah ditutup.');
    }

    $request->validate([
        'matkuls' => 'required|array'
    ]);

    // Hapus KRS semester aktif
    Krs::where('mahasiswa_id', $mahasiswaId)
        ->where('semester_id', $semesterAktif->id)
        ->delete();

    // Simpan KRS baru
    foreach ($request->matkuls as $matkul_id) {

        Krs::create([
            'mahasiswa_id' => $mahasiswaId,
            'matkul_id' => $matkul_id,
            'semester_id' => $semesterAktif->id,
            'status' => 'aktif'
        ]);
    }

    return back()->with('success', 'KRS berhasil disimpan.');
}


    public function riwayat()
    {
        $mahasiswaId = Auth::user()->mahasiswa->id;

        $krs = Krs::with(['matkul', 'semester'])
            ->where('mahasiswa_id', $mahasiswaId)
            ->get()
            ->groupBy('semester.nama');

        return view('pages.mahasiswa.riwayat-krs', compact('krs'));
    }

    public function khs()
{
    $mahasiswaId = Auth::user()->mahasiswa->id;

    $bobot = [
        'A' => 4,
        'B' => 3,
        'C' => 2,
        'D' => 1,
        'E' => 0
    ];

    $krs = Krs::with(['matkul', 'nilai', 'semester'])
        ->where('mahasiswa_id', $mahasiswaId)
        ->get();

    $hasil = [];
    $totalSksKeseluruhan = 0;
    $totalBobotKeseluruhan = 0;

    foreach ($krs->groupBy('semester.nama') as $semester => $items) {

        $totalSks = 0;
        $totalBobot = 0;

        foreach ($items as $item) {

            $huruf = $item->nilai?->nilai;

            if ($huruf) {
                $sks = $item->matkul->sks;
                $b = $bobot[$huruf] ?? 0;

                $totalSks += $sks;
                $totalBobot += ($b * $sks);

                $totalSksKeseluruhan += $sks;
                $totalBobotKeseluruhan += ($b * $sks);
            }
        }

        $hasil[$semester] = [
            'data' => $items,
            'total_sks' => $totalSks,
            'ips' => $totalSks > 0
                ? round($totalBobot / $totalSks, 2)
                : '-'
        ];
    }

    $ipk = $totalSksKeseluruhan > 0
        ? round($totalBobotKeseluruhan / $totalSksKeseluruhan, 2)
        : '-';

    return view('pages.mahasiswa.khs', compact('hasil', 'ipk'));
}
}
