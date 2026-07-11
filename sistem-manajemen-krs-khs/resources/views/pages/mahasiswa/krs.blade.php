@extends('layouts.mahasiswa')

@section('title', 'Pengisian KRS')

@section('content')

<div class="bg-white p-4 rounded-xl shadow mb-6">
    <p>
        Nama:
        <span class="font-semibold">
            {{ $mahasiswa->nama }}
        </span>
    </p>

    <p>
        Semester Aktif:
        <span class="font-semibold">
            {{ $semesterAktif->nama }}
        </span>
    </p>

    <p>
        IPS Semester Lalu:
        <span class="font-semibold">
            {{ $ips }}
        </span>
    </p>

    <p>
        IPK:
        <span class="font-semibold">
            {{ $ipk }}
        </span>
    </p>
</div>


@if(session('success'))
<div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-xl mb-6">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-xl mb-6">
    {{ session('error') }}
</div>
@endif


<form method="POST" action="{{ route('mahasiswa.krs.store') }}">
    @csrf

    <div class="bg-white p-6 rounded-xl shadow">

        <table class="w-full">
            <thead>
                <tr class="border-b bg-gray-50">
                    <th class="p-3">Kode</th>
                    <th class="p-3">Nama Mata Kuliah</th>
                    <th class="p-3">SKS</th>
                    <th class="p-3 text-center">Pilih</th>
                </tr>
            </thead>

            <tbody>
                @forelse($matkuls as $mk)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3">
                        {{ $mk->kode_mk }}
                    </td>

                    <td class="p-3">
                        {{ $mk->nama_mk }}
                    </td>

                    <td class="p-3">
                        {{ $mk->sks }}
                    </td>

                    <td class="p-3 text-center">
                        <input type="checkbox" name="matkuls[]" value="{{ $mk->id }}" data-sks="{{ $mk->sks }}"
                            class="sks-checkbox" {{ in_array($mk->id, $krs) ? 'checked' : '' }}>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center p-4">
                        Belum ada mata kuliah tersedia.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4 font-semibold">
            Total SKS :
            <span id="totalSks">0</span>
        </div>

        <div class="mt-4 flex gap-2">

            @if($bisaIsiKrs)

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Simpan KRS
            </button>

            <button type="reset" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Batal
            </button>

            @else
            <button type="button" disabled class="bg-gray-400 text-white px-4 py-2 rounded cursor-not-allowed">
                Periode KRS Ditutup
            </button>
            @endif

        </div>

    </div>
</form>


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

    hitungSKS();

</script>

@endsection
