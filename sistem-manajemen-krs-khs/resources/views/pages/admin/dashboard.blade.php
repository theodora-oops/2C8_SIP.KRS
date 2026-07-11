@extends('layouts.app')

@section('title', 'Beranda Admin')

@section('content')

<!-- WELCOME -->
<div class="mb-6">
    <h2 class="text-2xl font-bold">
        Selamat Datang, {{ auth()->user()->nama }} 👋
    </h2>
    <p class="text-gray-600">
        Sistem Informasi Akademik (KRS dan KHS)
    </p>
</div>

<!-- CARD -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

    <!-- INFO SISTEM -->
    <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition border-l-4 border-blue-500">
        <h3 class="text-lg font-semibold mb-2 text-blue-600">📌 Informasi Sistem</h3>
        <p class="text-gray-600 text-sm leading-relaxed">
            Ini adalah dashboard admin SIP.KRS. Gunakan menu di sidebar untuk mengelola data pengguna,
            mata kuliah, dan semester.
        </p>
    </div>

    <!-- SEMESTER AKTIF -->
    <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition border-l-4 border-green-500">
        <h3 class="text-lg font-semibold mb-2 text-green-600">📅 Semester Aktif</h3>

        @if($semesterAktif)
        <p class="text-gray-800 font-medium">
            {{ $semesterAktif->tahun_ajaran }} - 
            <span class="capitalize">{{ $semesterAktif->tipe }}</span>
        </p>

        <span class="inline-block mt-2 bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full">
            Aktif
        </span>
        @else
        <p class="text-red-500">
            Belum ada semester aktif
        </p>
        @endif
    </div>

</div>

<!-- STATS -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-5 rounded-2xl shadow hover:shadow-xl transition transform hover:-translate-y-1">
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-3xl font-bold">{{ $jumlahMahasiswa }}</h3>
                <p class="text-sm opacity-90">Mahasiswa</p>
            </div>
            <div class="text-4xl opacity-80">🎓</div>
        </div>
    </div>

    <div class="bg-gradient-to-r from-green-500 to-green-600 text-white p-5 rounded-2xl shadow hover:shadow-xl transition transform hover:-translate-y-1">
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-3xl font-bold">{{ $jumlahDosen }}</h3>
                <p class="text-sm opacity-90">Dosen</p>
            </div>
            <div class="text-4xl opacity-80">👨‍🏫</div>
        </div>
    </div>

    <div class="bg-gradient-to-r from-yellow-400 to-orange-400 text-white p-5 rounded-2xl shadow hover:shadow-xl transition transform hover:-translate-y-1">
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-3xl font-bold">{{ $jumlahMatkul }}</h3>
                <p class="text-sm opacity-90">Mata Kuliah</p>
            </div>
            <div class="text-4xl opacity-80">📚</div>
        </div>
    </div>

</div>

@endsection