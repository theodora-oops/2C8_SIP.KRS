<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function dashboard()
    {
        $ipk = 3.85;
        $semester = 4;
        $total_sks = 20;

        $jadwal = [
            [
                'jam' => '08.00 - 09.40',
                'matkul' => 'Pemrograman Web (Praktikum)',
                'dosen' => 'Lab Multimedia'
            ],
            [
                'jam' => '10.00 - 11.40',
                'matkul' => 'Bahasa Inggris Komunikasi',
                'dosen' => 'Ruang 2B'
            ],
            [
                'jam' => '13.40 - 14.40',
                'matkul' => 'Basis Data (Teori)',
                'dosen' => 'Ruang 305'
            ],
            [
                'jam' => '15.00 - 17.00',
                'matkul' => 'Basis Data (Praktikum)',
                'dosen' => 'Lab DB'
            ],
        ];

        return view('mahasiswa.dashboard', compact('ipk','semester','total_sks','jadwal'));
    }

    public function krs(Request $request)
    {
        $semester = $request->semester ?? 1;

        $matkuls = [
            ['id'=>1,'kode'=>'IF 1001','nama_mk'=>'Statistika','sks'=>4],
            ['id'=>2,'kode'=>'IF 1002','nama_mk'=>'Web','sks'=>3],
            ['id'=>3,'kode'=>'IF 1003','nama_mk'=>'Jaringan','sks'=>3],
        ];

        return view('mahasiswa.krs', compact('matkuls','semester'));
    }

    public function lihatKrs()
    {
        $semester = 4;

        $krs = [
            ['kode'=>'IF 314','nama_mk'=>'Statistika','sks'=>4],
            ['kode'=>'IF 317','nama_mk'=>'Web','sks'=>3],
            ['kode'=>'IF 319','nama_mk'=>'Jaringan','sks'=>3],
        ];

        $total_sks = array_sum(array_column($krs, 'sks'));

        return view('mahasiswa.lihat_krs', compact('krs','semester','total_sks'));
    }

    public function simpanKrs(Request $request)
    {
        return back()->with('success', 'KRS berhasil disimpan!');
    }

    public function khs()
{
    $semester = 4;

    $khs = [
        ['kode'=>'IF 314','nama_mk'=>'Statistika','sks'=>4,'nilai'=>'A'],
        ['kode'=>'IF 317','nama_mk'=>'Web','sks'=>3,'nilai'=>'A-'],
        ['kode'=>'IF 319','nama_mk'=>'Jaringan','sks'=>3,'nilai'=>'B+'],
    ];

    $ip = 3.85;

    return view('mahasiswa.khs', compact('khs','semester','ip'));
}
}