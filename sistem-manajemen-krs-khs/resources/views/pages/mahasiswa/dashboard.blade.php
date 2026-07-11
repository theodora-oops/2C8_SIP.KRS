@extends('layouts.mahasiswa')
@section('title', 'Beranda Mahasiswa')
@section('content')

<div class="mb-5 text-2xl font-bold">
    Selamat datang, {{ auth()->user()->mahasiswa->nama }} 👋
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

    <!-- BATAS WAKTU KRS -->
    <div class="bg-white p-6 rounded-xl shadow w-full col-span-2">

        <h3 class="text-lg font-semibold text-blue-600 mb-4">
            ⏰ Batas Waktu Pengisian KRS
        </h3>

        @if($periode)

        <p class="text-gray-600">
            Pengisian KRS dibuka mulai
            <span class="font-semibold">
                {{ \Carbon\Carbon::parse($periode->start_date)->translatedFormat('d F Y') }}
            </span>
            sampai
            <span class="font-semibold text-red-600">
                {{ \Carbon\Carbon::parse($periode->end_date)->translatedFormat('d F Y') }}
            </span>.
        </p>

        @else

        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 text-yellow-700">
            Saat ini belum ada periode pengisian KRS yang sedang berlangsung.
        </div>

        @endif

    </div>

</div>

@endsection
