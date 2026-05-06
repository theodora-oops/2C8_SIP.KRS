@extends('layouts.list')

@section('title', 'Home')

@section('content')

<div class="max-w-5xl mx-auto py-10">
{{-- USER INFO CARD --}}
    <div class="grid md:grid-cols-2 gap-6">

        {{-- LEFT CARD --}}
        <div class="bg-gradient-to-r from-blue-500 to-blue-700 text-white rounded-xl p-6 shadow-lg">
            <h2 class="text-lg font-semibold mb-3">
                👋 Selamat Datang
            </h2>

            <p class="text-sm opacity-90">
                Halo, <span class="font-bold">{{ $nama }}</span>
            </p>

            <p class="text-sm mt-2 opacity-90">
                Anda terdaftar sebagai:
            </p>

            <div class="mt-3">
                <span class="bg-white text-blue-600 px-3 py-1 rounded-full text-sm font-semibold">
                    {{ $pekerjaan }}
                </span>
            </div>
        </div>

        {{-- RIGHT CARD (INFO SIAKAD STYLE) --}}
        <div class="bg-white rounded-xl shadow-md p-6 border">

            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                📌 Informasi Akademik
            </h3>

            <ul class="space-y-3 text-gray-600 text-sm">

                <li class="flex items-center gap-2">
                    <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                    Sistem KRS & KHS Online
                </li>

                <li class="flex items-center gap-2">
                    <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                    Monitoring nilai realtime
                </li>

                <li class="flex items-center gap-2">
                    <span class="w-2 h-2 bg-yellow-500 rounded-full"></span>
                    Pengisian KRS semester aktif
                </li>

                <li class="flex items-center gap-2">
                    <span class="w-2 h-2 bg-purple-500 rounded-full"></span>
                    Akses dosen & mahasiswa
                </li>

            </ul>

        </div>

    </div>

    {{-- ACTION BUTTON --}}
    <div class="mt-8 text-center">
        <a href="/pages/contact"
           class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-700 transition">
            Hubungi Admin Akademik
        </a>
    </div>

</div>

@endsection