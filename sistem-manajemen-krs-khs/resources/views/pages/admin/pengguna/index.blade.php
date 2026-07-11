@extends('layouts.app')
@section('title', 'Kelola Pengguna')
@section('content')

<!--font -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
</style>

<div style="font-family: 'Inter', sans-serif;">

    <!-- ALERT -->
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-5">
        {{ session('success') }}
    </div>
    @endif

    <!-- TOOLBAR -->
    <div class="bg-white rounded-2xl shadow p-5 mb-6">

        <div class="flex flex-col md:flex-row justify-between items-center gap-4">

            <x-button type="button" onclick="openModal()" class="bg-indigo-600 hover:bg-indigo-700 px-5 py-3">
                + Tambah
            </x-button>

            <form method="GET" action="{{ route('pengguna.index') }}"
                class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">

                <!-- SEARCH -->
                <div class="relative">

                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pengguna..." class="w-full sm:w-64 border border-gray-300
                        rounded-xl py-2.5 pl-10 pr-4
                        focus:outline-none focus:ring-2
                        focus:ring-[#2e2970]">

                    <!-- ICON SEARCH -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 absolute left-3 top-3 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35M10.5 18a7.5 7.5 0 100-15 7.5 7.5 0 000 15z" />

                    </svg>

                </div>

                <!-- FILTER ROLE -->
                <div class="relative">

                    <select name="role" class="appearance-none bg-white border border-gray-300
                    rounded-xl pl-4 pr-10 py-2.5
                    shadow-sm
                    hover:border-[#2e2970]
                    focus:outline-none
                    focus:ring-2
                    focus:ring-[#2e2970]
                    cursor-pointer">

                        <option value="all" {{ $role == 'all' ? 'selected' : '' }}>
                            Semua Role
                        </option>

                        <option value="admin" {{ $role == 'admin' ? 'selected' : '' }}>
                            Admin
                        </option>

                        <option value="dosen" {{ $role == 'dosen' ? 'selected' : '' }}>
                            Dosen
                        </option>

                        <option value="mahasiswa" {{ $role == 'mahasiswa' ? 'selected' : '' }}>
                            Mahasiswa
                        </option>

                    </select>

                    <!-- ICON PANAH -->
                    <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />

                        </svg>

                    </div>

                </div>

                <!-- BUTTON SEARCH -->
                <button
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2.5 rounded-xl transition flex items-center justify-center">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35M10.5 18a7.5 7.5 0 100-15 7.5 7.5 0 000 15z" />

                    </svg>

                </button>

            </form>

        </div>

    </div>


    <!-- TABLE -->
    <div class="bg-white rounded-2xl shadow overflow-x-auto">

        <table class="w-full">

            <thead class="bg-gray-100">

                <tr class="text-gray-700">

                    <th class="p-4 text-center">No</th>
                    <th class="p-4 text-left">Nama</th>
                    <th class="p-4 text-left">Email</th>
                    <th class="p-4 text-center">Role</th>
                    <th class="p-4 text-center">Status</th>
                    <th class="p-4 text-center">Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($users as $user)

                <tr class="border-t hover:bg-gray-50 transition">

                    <td class="p-4 text-center">
                        {{ $loop->iteration }}
                    </td>

                    <td class="p-4">

                        <div class="flex items-center gap-3">

                            <div>

                                <p class="font-semibold text-gray-800">

                                    @if($user->role == 'admin')
                                    {{ $user->admin->nama ?? '-' }}

                                    @elseif($user->role == 'dosen')
                                    {{ $user->dosen->nama ?? '-' }}

                                    @else
                                    {{ $user->mahasiswa->nama ?? '-' }}
                                    @endif

                                </p>

                            </div>

                        </div>

                    </td>

                    <td class="p-4 text-gray-600">
                        {{ $user->email }}
                    </td>

                    <td class="p-4 text-center">

                        @if($user->role == 'admin')

                        <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-sm">
                            Admin
                        </span>

                        @elseif($user->role == 'dosen')

                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">
                            Dosen
                        </span>

                        @else

                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                            Mahasiswa
                        </span>

                        @endif

                    </td>

                    <td class="p-4 text-center">

                        @if($user->status == 'active')

                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                            Aktif
                        </span>

                        @else

                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                            Nonaktif
                        </span>

                        @endif

                    </td>

                    <td class="p-4">

                        <div class="flex justify-center gap-2">

                            <!-- EDIT -->
                            <x-button class="bg-amber-400 hover:bg-amber-500 w-11 h-11 btn-edit" 
                                data-id="{{ $user->id }}" 
                                data-name="{{ $user->role == 'admin' ? ($user->admin->nama ?? '') : ($user->role == 'dosen' ? ($user->dosen->nama ?? '') : ($user->mahasiswa->nama ?? '')) }}" 
                                data-identitas="{{ $user->role == 'admin' ? ($user->admin->nomor_induk ?? '') : ($user->role == 'dosen' ? ($user->dosen->nomor_induk ?? '') : ($user->mahasiswa->nomor_induk ?? '')) }}" 
                                data-kelas="{{ $user->mahasiswa->kelas ?? '' }}"
                                data-email="{{ $user->email }}" 
                                data-role="{{ $user->role }}">

                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />

                                </svg>

                            </x-button>


                            <!-- NONAKTIFKAN -->
                            <form action="{{ route('pengguna.destroy', $user->id) }}" method="POST">

                                @csrf
                                @method('DELETE')

                                <x-button type="submit" class="bg-red-500 hover:bg-red-600 w-11 h-11" onclick="return confirm('Ubah status user ini?')">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">

                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M18.364 5.636l-12.728 12.728M6.343 6.343a8 8 0 1111.314 11.314A8 8 0 016.343 6.343z" />

                                    </svg>

                                </x-button>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="6" class="text-center p-8 text-gray-500">
                        Data pengguna tidak ditemukan.
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <!-- MODAL -->
    <div id="modal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

        <div class="bg-white rounded-2xl p-6 w-full max-w-lg">

            <div class="flex justify-between items-center mb-5">

                <h2 class="text-xl font-bold">
                    Edit Pengguna
                </h2>

                <button type="button" onclick="closeModal()" class="text-gray-500 text-2xl">
                    &times;
                </button>

            </div>

            <form id="formUser" method="POST">
                @csrf
                <input type="hidden" name="_method" id="methodField">

                <div class="space-y-4">

                    <!-- ROLE -->
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">
                            Role
                        </label>

                        <select name="role" id="role" onchange="ubahForm()" class="w-full border border-gray-300 rounded-xl px-4 py-3
                            focus:ring-2 focus:ring-indigo-500 focus:outline-none">

                            <option value="">-- Pilih Role --</option>
                            <option value="admin">Admin</option>
                            <option value="dosen">Dosen</option>
                            <option value="mahasiswa">Mahasiswa</option>

                        </select>
                    </div>

                    <!-- NIK/NIM -->
                    <div id="identitasField" style="display:none">

                        <label id="labelIdentitas" class="block text-sm font-medium text-gray-600 mb-2">
                        </label>

                        <input type="text" name="identitas" id="identitas" class="w-full border border-gray-300 rounded-xl px-4 py-3
                            focus:ring-2 focus:ring-indigo-500 focus:outline-none">

                    </div>

                    <!-- NAMA -->
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">
                            Nama Lengkap
                        </label>

                        <input type="text" name="name" id="name" placeholder="Masukkan nama lengkap" class="w-full border border-gray-300 rounded-xl px-4 py-3
                            focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    </div>

                    <!-- KELAS -->
                    <div id="kelasField" style="display:none">

                        <label class="block text-sm font-medium text-gray-600 mb-2">
                            Kelas
                        </label>

                        <select name="kelas" id="kelas" class="w-full border border-gray-300 rounded-xl px-4 py-3
                            focus:ring-2 focus:ring-indigo-500 focus:outline-none">

                            <option value="">-- Pilih Kelas --</option>
                            <option value="A">A</option>
                            <option value="B">B</option>

                        </select>

                    </div>

                    <!-- EMAIL -->
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">
                            Email
                        </label>

                        <input type="email" name="email" id="email" readonly class="w-full border border-gray-300 rounded-xl px-4 py-3
                            bg-gray-100 text-gray-600">
                    </div>

                    <!-- PASSWORD -->
                    <div id="passwordField">

                        <label class="block text-sm font-medium text-gray-600 mb-2">
                            Password
                        </label>

                        <input type="password" name="password" placeholder="Masukkan password" class="w-full border border-gray-300 rounded-xl px-4 py-3
                            focus:ring-2 focus:ring-indigo-500 focus:outline-none">

                    </div>

                    <!-- BUTTON -->
                    <div class="flex justify-end gap-2 pt-2">

                        <x-button type="button" onclick="closeModal()" class="bg-gray-500 hover:bg-gray-600 px-5 py-3">
                            Batal
                        </x-button>

                        <x-button type="submit" id="submitButton" class="bg-indigo-600 hover:bg-indigo-700 px-5 py-3">
                            Simpan
                        </x-button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div> 
<!-- PENUTUP DIV WRAPPER FONT -->

<script>
    function openModal() {

        document.getElementById('modal').classList.remove('hidden');
        document.getElementById('modal').classList.add('flex');
        document.getElementById('submitButton').innerText = 'Simpan';
        document.querySelector('#modal h2').innerText = 'Tambah Pengguna';

        document.getElementById('formUser').action =
            "{{ route('pengguna.store') }}";

        document.getElementById('methodField').value = '';

        document.getElementById('name').value = '';
        document.getElementById('email').value = '';
        document.getElementById('role').value = '';
        document.getElementById('identitas').value = '';

        document.getElementById('kelasField').style.display = 'none';
        document.getElementById('identitasField').style.display = 'none';
        document.getElementById('passwordField').style.display = 'block';
    }

    function closeModal() {

        document.getElementById('modal').classList.add('hidden');
        document.getElementById('modal').classList.remove('flex');

    }

    function ubahForm() {

        let role = document.getElementById('role').value;

        let identitasField = document.getElementById('identitasField');
        let kelasField = document.getElementById('kelasField');
        let labelIdentitas = document.getElementById('labelIdentitas');
        let email = document.getElementById('email');
        let nama = document.getElementById('name').value.trim().toLowerCase().split(' ')[0];

        identitasField.style.display = 'block';

        if (role === 'mahasiswa') {

            labelIdentitas.innerHTML = 'NIM';
            kelasField.style.display = 'block';

            email.value = nama + '@mhs.kampus.id';

        } else if (role === 'dosen') {

            labelIdentitas.innerHTML = 'NIK';
            kelasField.style.display = 'none';

            email.value = nama + '@dosen.kampus.id';

        } else if (role === 'admin') {

            labelIdentitas.innerHTML = 'NIK';
            kelasField.style.display = 'none';

            email.value = nama + '@admin.kampus.id';

        } else {

            identitasField.style.display = 'none';
            kelasField.style.display = 'none';
            email.value = '';
        }
    }

    document.getElementById('name').addEventListener('keyup', ubahForm);


    // EDIT
    document.querySelectorAll('.btn-edit').forEach(btn => {

        btn.addEventListener('click', function () {

            openModal();

            document.getElementById('submitButton').innerText = 'Update';
            document.querySelector('#modal h2').innerText = 'Edit Pengguna';

            document.getElementById('formUser').action =
                '/admin/pengguna/' + this.dataset.id;

            document.getElementById('methodField').value = 'PUT';

            document.getElementById('name').value =
                this.dataset.name;

            document.getElementById('email').value =
                this.dataset.email;

            document.getElementById('role').value =
                this.dataset.role;

            ubahForm();

            document.getElementById('identitas').value =
                this.dataset.identitas;

            if (this.dataset.role === 'mahasiswa') {
                document.getElementById('kelas').value =
                    this.dataset.kelas;
            }

            document.getElementById('passwordField').style.display =
                'none';

        });

    });

</script>

@endsection