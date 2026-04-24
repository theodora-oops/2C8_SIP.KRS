@extends('layouts.mahasiswa')
@section('title', 'Dashboard Mahasiswa')
@section('content')

<div class="bg-white p-4 rounded shadow mb-5 text-2xl font-bold">👋
    Selamat datang, {{ auth()->user()->name }}
</div>

<div class="grid grid-cols-2 gap-4">

    <div class="bg-blue-500 text-white p-5 rounded shadow text-center">
        <h3 class="text-xl font-bold">KRS</h3>
        <p>Ambil Mata Kuliah</p>
        <a href="/mahasiswa/krs" class="bg-white text-blue-500 px-3 py-1 rounded inline-block mt-2">
            Masuk
        </a>
    </div>

    <div class="bg-green-500 text-white p-5 rounded shadow text-center">
        <h3 class="text-xl font-bold">KHS</h3>
        <p>Lihat Nilai</p>
        <a href="/mahasiswa/khs" class="bg-white text-green-500 px-3 py-1 rounded inline-block mt-2">
            Masuk
        </a>
    </div>

    <!-- INFO CARD -->
    <div class="bg-white p-6 rounded-xl shadow w-full col-span-2">
        <h3 class="text-lg font-semibold mb-2">Informasi Sistem</h3>
        <p class="text-gray-600">
            Ini adalah dashboard mahasiswa. Gunakan menu di sidebar untuk melihat informasi terkait KRS dan KHS.
        </p>
    </div>

</div>

@endsection
