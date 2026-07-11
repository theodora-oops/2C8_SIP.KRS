@extends('layouts.app')
@section('title', 'Kelola Semester')
@section('content')

<!-- Font -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

</style>

<div style="font-family: 'Inter', sans-serif;">

    <!-- SUCCESS -->
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-5">
        {{ session('success') }}
    </div>
    @endif

    <!-- BUTTON TAMBAH -->
    <x-button type="button" onclick="openModal()" class="bg-indigo-600 hover:bg-indigo-700 px-5 py-3 mb-6">
        + Tambah
    </x-button>

    <!-- MODAL TAMBAH -->
    <div id="modal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

        <div class="bg-white rounded-2xl p-6 w-full max-w-lg">

            <div class="flex justify-between items-center mb-5">
                <h2 class="text-xl font-bold">
                    Tambah Tahun Ajaran
                </h2>

                <button type="button" onclick="closeModal()" class="text-gray-500 text-2xl">
                    &times;
                </button>
            </div>

            <form method="POST" action="{{ route('semester.store') }}">

                @csrf

                <div class="space-y-4">

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">
                            Tahun Ajaran
                        </label>

                        <input type="text" name="tahun_ajaran" placeholder="Contoh: 2025/2026"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">
                            Jenis Semester
                        </label>

                        <select name="tipe"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                            required>

                            <option value="">-- Pilih Semester --</option>
                            <option value="ganjil">Ganjil</option>
                            <option value="genap">Genap</option>

                        </select>
                    </div>

                    <div class="flex justify-end gap-2">

                        <x-button type="button" class="bg-gray-500 hover:bg-gray-600" onclick="closeModal()">
                            Batal
                        </x-button>

                        <x-button class="bg-indigo-600 hover:bg-indigo-700">
                            Simpan
                        </x-button>

                    </div>

                </div>

            </form>

        </div>

    </div>

    <!-- MODAL EDIT -->
    <div id="editModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

        <div class="bg-white rounded-2xl p-6 w-full max-w-lg">

            <div class="flex justify-between items-center mb-5">
                <h2 class="text-xl font-bold">
                    Edit Semester
                </h2>

                <button type="button" onclick="closeEditModal()" class="text-gray-500 text-2xl">
                    &times;
                </button>
            </div>

            <form method="POST" id="editForm">

                @csrf
                @method('PUT')

                <div class="space-y-4">

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">
                            Tahun Ajaran
                        </label>

                        <input type="text" name="tahun_ajaran" id="edit_tahun"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">
                            Jenis Semester
                        </label>

                        <select name="tipe" id="edit_tipe"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none">

                            <option value="ganjil">Ganjil</option>
                            <option value="genap">Genap</option>

                        </select>
                    </div>

                    <div class="flex justify-end gap-2">

                        <x-button type="button" class="bg-gray-500 hover:bg-gray-600" onclick="closeEditModal()">
                            Batal
                        </x-button>

                        <x-button class="bg-indigo-600 hover:bg-indigo-700">
                            Update
                        </x-button>

                    </div>

                </div>

            </form>

        </div>

    </div>

    <!-- ================= SCRIPT ================= -->
    <script>
        function openModal() {
            const modal = document.getElementById('modal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeModal() {
            const modal = document.getElementById('modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function openEditModal(el) {
            const modal = document.getElementById('editModal');

            modal.classList.remove('hidden');
            modal.classList.add('flex');

            document.getElementById('edit_tahun').value = el.dataset.tahun;
            document.getElementById('edit_tipe').value = el.dataset.tipe;

            // FIX: pakai route Laravel (lebih aman)
            document.getElementById('editForm').action =
                "{{ url('/semester') }}/" + el.dataset.id;
        }

        function closeEditModal() {
            const modal = document.getElementById('editModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

    </script>

    <!-- ================= LIST ================= -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">

        @foreach($semesters as $s)
        <div class="bg-white p-5 rounded-xl shadow {{ $s->is_active ? 'border-2 border-green-500' : '' }}">

            <div class="flex justify-between mb-3">
                <div>
                    <h3 class="font-bold">{{ $s->tahun_ajaran }}</h3>
                    <p class="text-sm capitalize">Semester {{ $s->tipe }}</p>
                </div>

                <span class="text-sm px-2 py-1 rounded 
                {{ $s->is_active ? 'bg-green-500 text-white' : 'bg-gray-400 text-white' }}">
                    {{ $s->is_active ? 'Aktif' : 'Nonaktif' }}
                </span>
            </div>

            <div class="flex gap-2">

                @if(!$s->is_active)
                <form action="{{ route('semester.activate', $s->id) }}" method="POST" class="w-full">
                    @csrf

                    <x-button type="submit" class="bg-green-500 w-full">
                        Aktifkan
                    </x-button>
                </form>
                @else
                <button disabled class="w-full bg-gray-300 text-white py-2 rounded">
                    Sedang Aktif
                </button>
                @endif

                <!-- EDIT -->
                <x-button type="button" class="bg-yellow-500 w-full" data-id="{{ $s->id }}"
                    data-tahun="{{ $s->tahun_ajaran }}" data-tipe="{{ $s->tipe }}" onclick="openEditModal(this)">

                    Edit
                </x-button>

            </div>

        </div>
        @endforeach

    </div>
</div>

@endsection