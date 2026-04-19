@extends('layouts.mahasiswa')
@section('title', '')
@section('content')

<h2 class="text-2xl font-bold mb-2">Pengisian KRS</h2>

<!-- INFO USER -->
<div class="mb-6 text-gray-600 bg-white p-4 rounded shadow">
    <p>Nama: <span class="font-semibold">{{ auth()->user()->name }}</span></p>
    <p>IPS Semester Lalu: <span class="font-semibold">3.90</span></p>
    <p>IPK: <span class="font-semibold">3.83</span></p>
</div>

<!-- DROPDOWN SEMESTER -->
<form method="GET" action="/mahasiswa/krs" class="mb-4">
    <select name="semester" onchange="this.form.submit()"
        class="border px-3 py-2 rounded">

        @for ($i = 1; $i <= 6; $i++)
            <option value="{{ $i }}"
                {{ $semester == $i ? 'selected' : '' }}
                {{ $i < $currentSemester ? 'disabled' : '' }}>
                
                Semester {{ $i }}
                {{ $i < $currentSemester ? '(Sudah diambil)' : '' }}
            </option>
        @endfor

    </select>
</form>

<!-- FORM KRS -->
<form method="POST" action="/mahasiswa/krs">
@csrf

<div class="bg-white p-6 rounded-xl shadow">

    <table class="w-full">

        <thead>
            <tr class="border-b bg-gray-50">
                <th class="p-3">Kode</th>
                <th class="p-3">Nama</th>
                <th class="p-3">SKS</th>
                <th class="p-3 text-center">Pilih</th>
            </tr>
        </thead>

        <tbody>
            @foreach($matkuls as $mk)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-3 text-blue-600">{{ $mk->kode_mk }}</td>
                <td class="p-3">{{ $mk->nama_mk }}</td>
                <td class="p-3">{{ $mk->sks }}</td>
                <td class="p-3 text-center">
                    <input type="checkbox"
                        name="matkuls[]"
                        value="{{ $mk->id }}"
                        data-sks="{{ $mk->sks }}"
                        class="sks-checkbox"
                        {{ in_array($mk->id, $krs) ? 'checked' : '' }}
                        {{ $semester < $currentSemester ? 'disabled' : '' }}>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>

    <!-- TOTAL SKS -->
    <div class="mt-4 font-semibold">
        Total SKS: <span id="totalSks">0</span>
    </div>

    <!-- BUTTON -->
    @if($semester >= $currentSemester)
        <button class="mt-4 bg-blue-600 text-white px-4 py-2 rounded">
            Simpan KRS
        </button>
    @else
        <button class="mt-4 bg-gray-400 text-white px-4 py-2 rounded cursor-not-allowed" disabled>
            Tidak bisa edit semester lama
        </button>
    @endif

</div>

</form>

<!-- SCRIPT TOTAL SKS -->
<script>
function hitungSKS() {
    let total = 0;

    document.querySelectorAll('.sks-checkbox:checked').forEach(cb => {
        total += parseInt(cb.dataset.sks);
    });

    document.getElementById('totalSks').innerText = total;
}

document.querySelectorAll('.sks-checkbox').forEach(cb => {
    cb.addEventListener('change', hitungSKS);
});

// auto hitung saat load
hitungSKS();
</script>

@endsection