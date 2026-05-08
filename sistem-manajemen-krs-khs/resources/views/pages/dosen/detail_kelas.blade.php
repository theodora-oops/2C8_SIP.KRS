@extends('layouts.dosen')

@section('title', 'Detail Kelas')

@section('content')

{{-- BACK BUTTON --}}
<a href="{{ route('dosen.kelas') }}"
   class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-blue-600 font-medium mb-5 transition">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
    </svg>
    Kembali ke Kelas Diampu
</a>

<h2 class="text-2xl font-bold mb-4">{{ $matkul->nama_mk }}</h2>

<div class="bg-white p-5 rounded-xl shadow">

    <h3 class="font-semibold mb-3">Daftar Mahasiswa</h3>

    @if($mahasiswas->count() > 0)
        <table class="w-full border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 border">No</th>
                    <th class="p-2 border">Nama</th>
                    <th class="p-2 border">Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mahasiswas as $index => $krs)
                <tr>
                    <td class="p-2 border">{{ $index + 1 }}</td>
                    <td class="p-2 border">{{ $krs->mahasiswa->name }}</td>
                    <td class="p-2 border">{{ $krs->mahasiswa->email }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-gray-500">Belum ada mahasiswa</p>
    @endif

</div>

@endsection
