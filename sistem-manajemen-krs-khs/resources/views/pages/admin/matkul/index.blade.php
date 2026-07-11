@extends('layouts.app')
@section('title', 'Kelola Mata Kuliah')
@section('content')

<!-- Font -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

</style>

<div style="font-family: 'Inter', sans-serif;">

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-5">
        {{ session('success') }}
    </div>
    @endif


    <!-- TOOLBAR -->
    <div class="bg-white rounded-2xl shadow p-5 mb-6">

        <div class="flex justify-between items-center">

            <x-button type="button" onclick="openModal()" class="bg-indigo-600 hover:bg-indigo-700 px-5 py-3">
                + Tambah
            </x-button>

            <form method="GET">
                <select name="semester" onchange="this.form.submit()" class="border px-3 py-2 rounded">

                    <option value="all">Semua Semester</option>

                    @for($i=1;$i<=6;$i++) <option value="{{ $i }}" {{ $semester == $i ? 'selected' : '' }}>
                        Semester {{ $i }}
                        </option>
                        @endfor

                </select>
            </form>

        </div>
    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-2xl shadow overflow-x-auto">

        <table class="w-full">

            <thead class="bg-gray-50 border-b">
                <tr class="text-gray-500 uppercase tracking-wider text-sm font-semibold">
                    <th class="p-6 text-center">Kode MK</th>
                    <th class="p-6 text-center">Mata Kuliah</th>
                    <th class="p-6 text-center">SKS</th>
                    <th class="p-6 text-center">Semester</th>
                    <th class="p-6 text-center">Dosen</th>
                    <th class="p-6 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($matkuls as $mk)
                <tr class="border-b hover:bg-gray-50 transition duration-200">

                    <td class="p-4 text-center">{{ $mk->kode_mk }}</td>
                    <td class="p-4 font-semibold">{{ $mk->nama_mk }}</td>
                    <td class="p-4 text-center">{{ $mk->sks }}</td>
                    <td class="p-4 text-center">{{ $mk->semester }}</td>
                    <td class="p-4 text-center">{{ $mk->dosen->nama ?? '-' }}</td>

                    <td class="p-4">
                        <div class="flex justify-center gap-2">

                            <!-- EDIT -->
                            <x-button type="button" class="btn-edit bg-amber-400 hover:bg-amber-500 w-11 h-11 p-0"
                                data-id="{{ $mk->id }}" data-kode="{{ $mk->kode_mk }}" data-nama="{{ $mk->nama_mk }}"
                                data-sks="{{ $mk->sks }}" data-semester="{{ $mk->semester }}"
                                data-dosen="{{ $mk->dosen_id }}">

                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>

                            </x-button>

                            <!-- DELETE -->
                            <form method="POST" action="{{ route('matkul.destroy',$mk->id) }}">
                                @csrf
                                @method('DELETE')

                                <x-button type="submit" onclick="return confirm('Hapus mata kuliah ini?')"
                                    class="bg-red-500 hover:bg-red-600 w-11 h-11 p-0">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">

                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>

                                </x-button>

                            </form>

                        </div>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center p-6 text-gray-500">
                        Tidak ada data
                    </td>
                </tr>
                @endforelse

            </tbody>
        </table>

    </div>

    <!-- MODAL -->
    <div id="modal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

        <div class="bg-white rounded-2xl p-6 w-full max-w-lg">

            <!-- HEADER -->
            <div class="flex justify-between items-center mb-5">
                <h2 class="text-xl font-bold text-gray-800">
                    Form Mata Kuliah
                </h2>

                <button type="button" onclick="closeModal()" class="text-gray-500 text-2xl hover:text-gray-700">
                    &times;
                </button>
            </div>

            <form id="formMatkul" method="POST">
                @csrf
                <input type="hidden" id="methodField" name="_method">

                <div class="space-y-4">

                    <!-- KODE -->
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">
                            Kode Mata Kuliah
                        </label>

                        <input id="kode" name="kode_mk" type="text" placeholder="Contoh: IF101" class="w-full border border-gray-300 rounded-xl px-4 py-3
                        focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    </div>

                    <!-- NAMA -->
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">
                            Nama Mata Kuliah
                        </label>

                        <input id="nama" name="nama_mk" type="text" placeholder="Contoh: Pemrograman Web" class="w-full border border-gray-300 rounded-xl px-4 py-3
                        focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    </div>

                    <div class="grid grid-cols-2 gap-4">

                        <!-- SKS -->
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">
                                SKS
                            </label>

                            <input id="sks" name="sks" type="number" placeholder="3" class="w-full border border-gray-300 rounded-xl px-4 py-3
                            focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                        </div>

                        <!-- SEMESTER -->
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">
                                Semester
                            </label>

                            <input id="semester" name="semester" type="number" placeholder="1" class="w-full border border-gray-300 rounded-xl px-4 py-3
                            focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                        </div>

                    </div>

                    <!-- DOSEN -->
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">
                            Dosen Pengampu
                        </label>

                        <select id="dosen_id" name="dosen_id" class="w-full border border-gray-300 rounded-xl px-4 py-3
                        focus:ring-2 focus:ring-indigo-500 focus:outline-none">

                            <option value="">-- Pilih Dosen --</option>

                            @foreach($dosens as $d)
                            <option value="{{ $d->id }}">
                                {{ $d->nama }}
                            </option>
                            @endforeach

                        </select>
                    </div>

                    <!-- BUTTON -->
                    <div class="flex justify-end gap-2 pt-2">

                        <x-button type="button" onclick="closeModal()" class="bg-gray-500 hover:bg-gray-600 px-5 py-3">
                            Batal
                        </x-button>

                        <x-button type="submit" class="bg-indigo-600 hover:bg-indigo-700 px-5 py-3">
                            Simpan
                        </x-button>

                    </div>

                </div>

            </form>

        </div>

    </div>
</div>

<!-- SCRIPT -->
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const modal = document.getElementById('modal');
        const form = document.getElementById('formMatkul');
        const method = document.getElementById('methodField');
        const modalTitle = document.getElementById('modalTitle');

        document.querySelector('#modal h2').innerText = 'Tambah Mata Kuliah';

        window.openModal = function () {
            form.action = "{{ route('matkul.store') }}";
            method.value = '';

            form.reset();

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        window.closeModal = function () {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        document.querySelectorAll('.btn-edit').forEach(btn => {
            btn.addEventListener('click', function () {

                document.querySelector('#modal h2').innerText = 'Edit Mata Kuliah';

                form.action = '/admin/matkul/' + this.dataset.id;
                method.value = 'PUT';

                document.getElementById('kode').value = this.dataset.kode;
                document.getElementById('nama').value = this.dataset.nama;
                document.getElementById('sks').value = this.dataset.sks;
                document.getElementById('semester').value = this.dataset.semester;
                document.getElementById('dosen_id').value = this.dataset.dosen;

                modal.classList.remove('hidden');
                modal.classList.add('flex');
            });
        });

    });

</script>

@endsection