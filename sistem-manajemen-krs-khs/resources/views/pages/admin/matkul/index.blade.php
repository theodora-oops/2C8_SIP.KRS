@extends('layouts.app')
@section('title', 'Kelola Mata Kuliah')
@section('content')

@if(session('success'))
<div class="bg-green-500 text-white p-3 mb-4 rounded">
    {{ session('success') }}
</div>
@endif

<div class="flex justify-between mb-4">
    <x-button class="bg-blue-500" onclick="openModal()">
        + Tambah Matkul
    </x-button>

    <!-- FILTER SEMESTER -->
    <form method="GET">
        <select name="semester" onchange="this.form.submit()" class="border px-3 py-2 rounded">
            <option value="all">Semua</option>
            @for($i=1;$i<=6;$i++) <option value="{{ $i }}" {{ $semester==$i?'selected':'' }}>
                Semester {{ $i }}
                </option>
                @endfor
        </select>
    </form>
</div>

<div class="bg-white p-5 rounded shadow">
    <table class="w-full text-center">
        <thead>
            <tr class="border-b">
                <th class="p-3">Kode</th>
                <th class="p-3">Nama</th>
                <th class="p-3">SKS</th>
                <th class="p-3">Semester</th>
                <th class="p-3">Dosen</th>
                <th class="p-3">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($matkuls as $mk)
            <tr class="border-b">
                <td class="p-3">{{ $mk->kode_mk }}</td>
                <td class="p-3">{{ $mk->nama_mk }}</td>
                <td class="p-3">{{ $mk->sks }}</td>
                <td class="p-3">{{ $mk->semester }}</td>

                <td class="p-3">
                    {{ $mk->dosen->name ?? '-' }}
                </td>

                <td class="p-3">
                    <div class="flex gap-2 justify-center">
                        <x-button class="bg-yellow-400 text-sm px-5 py-2 btn-edit" data-id="{{ $mk->id }}"
                            data-kode="{{ $mk->kode_mk }}" data-nama="{{ $mk->nama_mk }}" data-sks="{{ $mk->sks }}"
                            data-semester="{{ $mk->semester }}" data-dosen="{{ $mk->dosen_id }}">
                            Edit
                        </x-button>

                        <form method="POST" action="{{ route('matkul.destroy',$mk->id) }}">
                            @csrf
                            @method('DELETE')
                            <x-button class="bg-red-500 text-sm px-5 py-2">
                                Hapus
                            </x-button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- MODAL -->
<div id="modal" class="fixed inset-0 hidden items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white p-6 rounded w-96">

        <form id="formMatkul" method="POST">
            @csrf
            <input type="hidden" name="_method" id="methodField">

            <input type="text" name="kode_mk" id="kode" placeholder="Kode MK" class="w-full border p-2 mb-2">
            <input type="text" name="nama_mk" id="nama" placeholder="Nama MK" class="w-full border p-2 mb-2">
            <input type="number" name="sks" id="sks" placeholder="SKS" class="w-full border p-2 mb-2">

            <!-- SEMESTER -->
            <select name="semester" id="semester" class="w-full border p-2 mb-2 rounded text-gray-500">
                <option value="" disabled selected>Pilih Semester</option>
                @for($i=1;$i<=6;$i++) <option value="{{ $i }}">Semester {{ $i }}</option>
                    @endfor
            </select>

            <!-- DOSEN -->
            <select name="dosen_id" id="dosen_id" class="w-full border p-2 mb-4">
                <option value="">-- Pilih Dosen --</option>
                @foreach($dosens as $dosen)
                <option value="{{ $dosen->id }}">
                    {{ $dosen->name }}
                </option>
                @endforeach
            </select>

            <x-button class="bg-blue-500 text-white px-3 py-1 rounded w-full">
                Simpan
            </x-button>

        </form>
    </div>
</div>

<script>
    const modal = document.getElementById('modal');
    const formMatkul = document.getElementById('formMatkul');
    const methodField = document.getElementById('methodField');

    const kode = document.getElementById('kode');
    const nama = document.getElementById('nama');
    const sks = document.getElementById('sks');
    const semester = document.getElementById('semester');
    const dosen_id = document.getElementById('dosen_id');

    function openModal() {
        modal.classList.remove('hidden');
        modal.classList.add('flex');

        formMatkul.action = "{{ route('matkul.store') }}";
        methodField.value = '';

        kode.value = '';
        nama.value = '';
        sks.value = '';
        semester.value = '';
        dosen_id.value = '';
    }

    document.querySelectorAll('.btn-edit').forEach(btn => {
        btn.onclick = function () {
            openModal();

            formMatkul.action = '/admin/matkul/' + this.dataset.id;
            methodField.value = 'PUT';

            kode.value = this.dataset.kode;
            nama.value = this.dataset.nama;
            sks.value = this.dataset.sks;
            semester.value = this.dataset.semester;
            dosen_id.value = this.dataset.dosen;
        }
    });

</script>

@endsection
