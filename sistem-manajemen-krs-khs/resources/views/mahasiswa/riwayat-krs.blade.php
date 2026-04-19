@extends('layouts.mahasiswa')

@section('content')

<h2 class="text-2xl font-bold mb-6">Riwayat KRS</h2>

<div class="space-y-6">

@forelse($krs as $semester => $items)

<div class="bg-white p-6 rounded-xl shadow">

    <h3 class="text-lg font-semibold mb-4">
        Semester {{ $semester }}
    </h3>

    <table class="w-full">

        <thead>
            <tr class="border-b bg-gray-50">
                <th class="p-3">Kode MK</th>
                <th class="p-3">Nama Mata Kuliah</th>
                <th class="p-3">SKS</th>
            </tr>
        </thead>

        <tbody>
            @php $total = 0; @endphp

            @foreach($items as $k)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-3 text-blue-600">
                    {{ $k->matkul->kode_mk }}
                </td>
                <td class="p-3">
                    {{ $k->matkul->nama_mk }}
                </td>
                <td class="p-3">
                    {{ $k->matkul->sks }}
                </td>
            </tr>

            @php $total += $k->matkul->sks; @endphp
            @endforeach
        </tbody>

    </table>

    <div class="mt-4 font-semibold text-right">
        Total SKS: {{ $total }}
    </div>

</div>

@empty

<div class="bg-white p-6 rounded-xl shadow text-center text-gray-500">
    Belum ada riwayat KRS
</div>

@endforelse

</div>

@endsection