@extends('layouts.app')

@section('content')

<h2 class="text-2xl font-bold mb-4">Kelola Semester</h2>

<!-- SUCCESS -->
@if(session('success'))
<div class="bg-green-500 text-white p-3 rounded mb-4">
    {{ session('success') }}
</div>
@endif

<!-- FORM TAMBAH -->
<form method="POST" action="{{ route('semester.store') }}" class="mb-4 flex gap-2">
    @csrf

    <input type="text" name="nama" placeholder="Semester 1" class="border p-2 rounded">
    <input type="text" name="tahun_ajaran" placeholder="2025/2026" class="border p-2 rounded">

    <select name="tipe" class="border p-2 rounded">
        <option value="ganjil">Ganjil</option>
        <option value="genap">Genap</option>
    </select>

    <button class="bg-blue-500 text-white px-4 py-2 rounded">
        Tambah
    </button>
</form>

<!-- TABLE -->
<div class="bg-white p-5 rounded shadow">
<table class="w-full text-center">

<thead>
<tr class="border-b bg-gray-50">
    <th class="p-3">Nama</th>
    <th class="p-3">Tahun</th>
    <th class="p-3">Tipe</th>
    <th class="p-3">Status</th>
    <th class="p-3">Aksi</th>
</tr>
</thead>

<tbody>
@foreach($semesters as $s)
<tr class="border-b">

    <td class="p-3">{{ $s->nama }}</td>
    <td class="p-3">{{ $s->tahun_ajaran }}</td>
    <td class="p-3 capitalize">{{ $s->tipe }}</td>

    <td class="p-3">
        @if($s->is_active)
            <span class="bg-green-500 text-white px-2 py-1 rounded">Aktif</span>
        @else
            <span class="bg-gray-400 text-white px-2 py-1 rounded">Nonaktif</span>
        @endif
    </td>

    <td class="p-3">
        <div class="flex justify-center gap-2">

            <!-- AKTIFKAN -->
            <form action="{{ route('semester.activate', $s->id) }}" method="POST">
                @csrf
                <button class="bg-green-500 text-white px-3 py-1 rounded">
                    Aktifkan
                </button>
            </form>

            <!-- DELETE -->
            <form action="{{ route('semester.destroy', $s->id) }}" method="POST">
                @csrf
                @method('DELETE')

                <button class="bg-red-500 text-white px-3 py-1 rounded">
                    Hapus
                </button>
            </form>

        </div>
    </td>

</tr>
@endforeach
</tbody>

</table>
</div>

@endsection