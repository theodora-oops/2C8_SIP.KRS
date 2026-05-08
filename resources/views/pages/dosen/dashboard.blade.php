@extends('layouts.dosen')

@section('title', 'Dashboard Dosen')

@section('content')

<div class="mb-6">
    <h2 class="text-2xl font-bold">
        Selamat Datang, {{ auth()->user()->name }} 👋
    </h2>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    <div class="bg-white p-6 rounded-2xl shadow border-l-4 border-blue-500">
        <h3 class="text-lg font-semibold text-blue-600 mb-2">📚 Kelas Diampu</h3>
        <p class="text-gray-600 text-sm">
            Lihat daftar mata kuliah yang Anda ajar pada semester aktif.
        </p>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow border-l-4 border-green-500">
        <h3 class="text-lg font-semibold text-green-600 mb-2">📝 Input Nilai</h3>
        <p class="text-gray-600 text-sm">
            Input nilai mahasiswa untuk setiap kelas yang Anda ajar.
        </p>
    </div>

</div>

@endsection