@extends('layouts.dosen')

@section('title','Profil Saya')

@section('content')

@if(session('success'))
<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-5">
    {{ session('success') }}
</div>
@endif

<div class="max-w-4xl mx-auto">

    <div class="bg-white rounded-2xl shadow p-8">

        {{-- FOTO + INFO --}}
        <div class="flex items-center gap-6 mb-8">

            @if($profile->foto)
            <img src="{{ asset('storage/foto/'.$profile->foto) }}"
                class="w-32 h-32 rounded-full object-cover border-4 border-indigo-100">
            @else
            <div
                class="w-32 h-32 rounded-full bg-indigo-100 flex items-center justify-center text-4xl font-bold text-indigo-600">
                {{ strtoupper(substr($profile->nama,0,1)) }}
            </div>
            @endif

            <div>
                <h2 class="text-3xl font-bold">
                    {{ $profile->nama }}
                </h2>

                <p class="text-gray-500 capitalize">
                    {{ $user->role }}
                </p>

                <p class="text-gray-500">
                    {{ $user->email }}
                </p>
            </div>

        </div>

        {{-- FORM --}}
        @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-5">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="grid md:grid-cols-2 gap-5">

                {{-- NOMOR INDUK --}}
                <div>
                    <label class="block mb-2 font-medium">
                        Nomor Induk
                    </label>

                    <input type="text" value="{{ $profile->nomor_induk }}"
                        class="w-full border rounded-xl px-4 py-3 bg-gray-100 cursor-not-allowed" disabled>
                </div>

                {{-- KELAS KHUSUS MAHASISWA --}}
                @if($user->role == 'mahasiswa')
                <div>
                    <label class="block mb-2 font-medium">
                        Kelas
                    </label>

                    <input type="text" value="{{ $profile->kelas }}"
                        class="w-full border rounded-xl px-4 py-3 bg-gray-100 cursor-not-allowed" disabled>
                </div>
                @endif

                {{-- NAMA --}}
                <div>
                    <label class="block mb-2 font-medium">
                        Nama
                    </label>

                    <input type="text" name="nama" value="{{ old('nama', $profile->nama) }}"
                        class="w-full border rounded-xl px-4 py-3 bg-gray-100 cursor-not-allowed" disabled>
                </div>

                {{-- EMAIL --}}
                <div>
                    <label class="block mb-2 font-medium">
                        Email Kampus
                    </label>

                    <input type="text" value="{{ $user->email }}" class="w-full border rounded-xl px-4 py-3 bg-gray-100 cursor-not-allowed"
                        disabled>
                </div>

                {{-- NO HP --}}
                <div>
                    <label class="block mb-2 font-medium">
                        No HP
                    </label>

                    <input type="text" name="no_hp" value="{{ old('no_hp', $profile->no_hp) }}"
                        class="w-full border rounded-xl px-4 py-3">
                </div>

                {{-- PASSWORD BARU --}}
                <div>
                    <label class="block mb-2 font-medium">
                        Password Baru
                    </label>

                    <div class="relative">

                        <input id="password" type="password" name="password"
                            placeholder="Isi hanya jika ingin mengganti password"
                            class="w-full border rounded-xl px-4 py-3 pr-12">

                        <button type="button" onclick="togglePassword()"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500">

                            <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>

                        </button>

                    </div>
                </div>

                {{-- FOTO --}}
                <div>
                    <label class="block mb-2 font-medium">
                        Foto Profil
                    </label>

                    <input type="file" name="foto" class="w-full border rounded-xl px-4 py-3">
                </div>

            </div>

            {{-- ALAMAT --}}
            <div class="mt-5">
                <label class="block mb-2 font-medium">
                    Alamat
                </label>

                <textarea name="alamat" rows="4"
                    class="w-full border rounded-xl px-4 py-3">{{ old('alamat', $profile->alamat) }}</textarea>
            </div>

            {{-- TOMBOL --}}
            <div class="mt-8 flex justify-end">

                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl transition">
                    Simpan Perubahan
                </button>

            </div>

        </form>

    </div>

</div>

<script>
    function togglePassword() {

        const password = document.getElementById('password');

        if (password.type === 'password') {
            password.type = 'text';
        } else {
            password.type = 'password';
        }

    }

</script>

@endsection
