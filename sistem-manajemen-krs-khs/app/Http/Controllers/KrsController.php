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
        $semester = $request->semester ?? 1;

        $matkuls = Matkul::where('semester', $semester)->orderBy('kode_mk', 'asc')->get();

        $userId = Auth::id();

        // ambil KRS user
        $krs = Krs::where('user_id', $userId)
                  ->pluck('matkul_id')
                  ->toArray();

        // semester aktif (dari database)
        $currentSemester = 3;

        return view('mahasiswa.krs', compact(
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
                'matkul_id' => $matkul_id
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

    return view('mahasiswa.riwayat-krs', compact('krs'));
    }

    public function khs()
    {
        $userId = \Illuminate\Support\Facades\Auth::id();
        
        $krs = \App\Models\Krs::with('matkul')
            ->where('user_id', $userId)
            ->get()
            ->groupBy(function ($item) {
                return $item->matkul->semester;
            });
            
        $bobotNilai = [
            'A' => 4,
            'B' => 3,
            'C' => 2,
            'D' => 1,
            'E' => 0
        ];
        
        $ipkTotal = 0;
        $totalSksAll = 0;
        
        $hasil = [];
        
        foreach ($krs as $semester => $items) {
            $totalSks = 0;
            $totalNilai = 0;
            
            foreach ($items as $k) {
                $sks = $k->matkul->sks;
                $nilai = $bobotNilai[$k->nilai] ?? 0;
                
                $totalSks += $sks;
                $totalNilai += ($nilai * $sks);
            }
            
            $ips = $totalSks ? $totalNilai / $totalSks : 0;
            
            $ipkTotal += $totalNilai;
            $totalSksAll += $totalSks;

            $hasil[$semester] = [
                'data' => $items,
                'ips' => round($ips, 2),
                'total_sks' => $totalSks
            ];
        }
        
        $ipk = $totalSksAll ? round($ipkTotal / $totalSksAll, 2) : 0;
        
        return view('mahasiswa.khs', compact('hasil', 'ipk'));
        
    }
}