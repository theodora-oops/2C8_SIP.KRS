@extends('layouts.mahasiswa')
@section('title', '')
@section('content')

<h2 class="text-2xl font-bold mb-6">Kartu Hasil Studi (KHS)</h2>

<!-- IPK -->
<div class="mb-6 bg-white p-5 rounded-xl shadow">
    <h3 class="text-lg font-semibold">IPK</h3>
    <p class="text-3xl font-bold text-blue-600">{{ $ipk }}</p>
</div>

@foreach($hasil as $semester => $item)

<div class="bg-white p-6 rounded-xl shadow mb-6">

    <h3 class="text-lg font-semibold mb-4">
        Semester {{ $semester }}
    </h3>

    <table class="w-full">
        <thead>
            <tr class="border-b bg-gray-50">
                <th class="p-3">Kode MK</th>
                <th class="p-3">Nama Mata Kuliah</th>
                <th class="p-3">SKS</th>
                <th class="p-3">Nilai</th>
            </tr>
        </thead>

        <tbody>
            @foreach($item['data'] as $k)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-3 text-blue-600">{{ $k->matkul->kode_mk }}</td>
                <td class="p-3">{{ $k->matkul->nama_mk }}</td>
                <td class="p-3">{{ $k->matkul->sks }}</td>
                <td class="p-3 font-semibold">
                    {{ $k->nilai ?? '-' }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4 flex justify-between font-semibold">
        <span>Total SKS: {{ $item['total_sks'] }}</span>
        <span>IPS: {{ $item['ips'] }}</span>
    </div>

</div>

@endforeach

@endsection