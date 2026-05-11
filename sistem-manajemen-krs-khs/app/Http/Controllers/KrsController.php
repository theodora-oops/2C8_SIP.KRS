<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matkul;
use App\Models\Krs;
use Illuminate\Support\Facades\Auth;

class KrsController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $userId = $user->id;

        $currentSemester = $user->semester;
        $semester = $request->semester ?? $currentSemester;

        $matkuls = Matkul::where('semester', $semester)
            ->orderBy('kode_mk', 'asc')
            ->get();

        // ambil KRS user
        $krs = Krs::where('user_id', $userId)
            ->pluck('matkul_id')
            ->toArray();

        return view('pages.mahasiswa.krs', compact(
            'matkuls',
            'semester',
            'krs',
            'currentSemester'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'matkuls' => 'required|array'
        ]);

        $userId = Auth::id();

        // hapus KRS lama
        Krs::where('user_id', $userId)->delete();

        // simpan KRS baru
        foreach ($request->matkuls as $matkul_id) {
            Krs::create([
                'user_id' => $userId,
                'matkul_id' => $matkul_id,
            ]);
        }

        return back()->with('success', 'KRS berhasil disimpan');
    }

    public function riwayat()
    {
        $userId = \Illuminate\Support\Facades\Auth::id();
        
        // ambil semua KRS + relasi matkul
        $krs = \App\Models\Krs::with('matkul')
            ->where('user_id', $userId)
            ->get()
            ->groupBy(function ($item) {
                return $item->matkul->semester;
            });

    return view('pages.mahasiswa.riwayat-krs', compact('krs'));
    }
    
    public function khs()
    {
        $userId = Auth::id();

        $krs = Krs::with('matkul')
            ->where('user_id', $userId)
            ->get()
            ->groupBy(fn ($item) => $item->matkul->semester);

        $bobot = [
            'A' => 4,
            'B' => 3,
            'C' => 2,
            'D' => 1,
            'E' => 0
        ];

        $hasil = [];

        $totalSksAll = 0;
        $totalBobotAll = 0;

        foreach ($krs as $semester => $items) {

        $sksSemester = 0;
        $bobotSemester = 0;

        foreach ($items as $k) {

            if (empty($k->nilai)) continue;

            $sks = $k->matkul->sks;
            $nilai = $bobot[$k->nilai] ?? 0;

            $sksSemester += $sks;
            $bobotSemester += ($nilai * $sks);
        }

        $ips = $sksSemester
            ? round($bobotSemester / $sksSemester, 2)
            : 0;

        $totalSksAll += $sksSemester;
        $totalBobotAll += $bobotSemester;

        $hasil[$semester] = [
            'data' => $items,
            'ips' => $ips,
            'total_sks' => $sksSemester
        ];
    }

    $ipk = $totalSksAll
        ? round($totalBobotAll / $totalSksAll, 2)
        : 0;

    return view('pages.mahasiswa.khs', compact('hasil', 'ipk'));
}
}