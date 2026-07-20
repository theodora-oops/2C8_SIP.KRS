@extends('layouts.dosen')
@section('title', 'Kelas Saya')
@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

</style>

<div style="font-family: 'Inter', sans-serif;">

    <div class="grid md:grid-cols-3 gap-6">

        @forelse($matkuls as $matkul)
        <div class="bg-white p-5 rounded-2xl shadow-md hover:shadow-xl transition duration-300">

            <!-- HEADER -->
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="text-blue-600 font-bold text-lg">
                        {{ $matkul->kode_mk }}
                    </h3>

                    <p class="text-gray-700">
                        {{ $matkul->nama_mk }}
                    </p>
                </div>

                <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full">
                    Semester {{ $matkul->semester }}
                </span>
            </div>

            <!-- JUMLAH MAHASISWA -->
            <div class="mt-4 text-sm text-gray-600">
                👥 <p>{{ $matkul->krs_count }} Mahasiswa</p>
            </div>

            <!-- BUTTON -->
            <a href="{{ route('dosen.detail_kelas', $matkul->id) }}"
                class="mt-5 inline-block w-full text-center bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg transition">
                Lihat Mahasiswa →
            </a>
        </div>
        @empty
        <div class="col-span-3 text-center text-gray-500">
            Tidak ada kelas
        </div>
        @endforelse

    </div>
</div>

<<<<<<< HEAD
@endsection
=======
@endsection
>>>>>>> 33ba2a0b257578680715262f7c4346273afbdba0
