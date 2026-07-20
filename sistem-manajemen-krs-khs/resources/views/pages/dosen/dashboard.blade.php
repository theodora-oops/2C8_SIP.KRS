@extends('layouts.dosen')

@section('title', 'Beranda Dosen')

@section('content')

<div class="mb-6">
    <h2 class="text-2xl font-bold">
        Selamat Datang, {{ auth()->user()->dosen->nama }} 👋
    </h2>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">

    <!-- Informasi Dosen -->
    <div
        class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 border-l-4 border-blue-500">
        <h3 class="text-lg font-semibold text-blue-600 mb-2">
            📌 Informasi Dosen
        </h3>

        <p class="text-gray-600 text-sm">
            Selamat datang di Beranda Dosen SIP.KRS.
            Gunakan menu Kelas Diampu untuk melihat mata kuliah yang diajar
            dan menu Input Nilai untuk mengelola nilai mahasiswa.
        </p>
    </div>

    <!-- Semester Aktif -->
    <div
        class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 border-l-4 border-blue-500">
        <h3 class="text-lg font-semibold text-green-600 mb-2">
            📅 Semester Aktif
        </h3>

        <p class="text-xl font-bold">
            {{ $semesterAktif ? $semesterAktif->tahun_ajaran . ' - ' . ucfirst($semesterAktif->tipe) : 'Belum ada semester aktif' }}
        </p>
    </div>

</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">

    <div
        class="bg-blue-500 text-white p-6 rounded-2xl shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 cursor-pointer">
        <h2 class="text-3xl font-bold">
            {{ $jumlahKelas }}
        </h2>
        <p>Kelas Diampu</p>
    </div>

    <div
        class="bg-green-500 text-white p-6 rounded-2xl shadow-lg hover:shadow-green-300 hover:-translate-y-2 transition-all duration-300">
        <h2 class="text-3xl font-bold">
            {{ $jumlahMahasiswa }}
        </h2>
        <p>Mahasiswa</p>
    </div>

</div>

@endsection