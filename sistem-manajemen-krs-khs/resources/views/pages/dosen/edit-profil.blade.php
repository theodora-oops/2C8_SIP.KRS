@extends('layouts.dosen')

@section('title', 'Edit Profil Dosen')

@section('content')

<div class="bg-white rounded-3xl shadow-md p-8">

    <h2 class="text-3xl font-bold mb-8">
        Edit Profil Dosen
    </h2>

    <form action="{{ route('dosen.update-profil') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- Nama (Tidak Bisa Diedit) --}}
            <div>
                <label class="font-semibold block mb-2">
                    Nama Lengkap
                </label>

                <input type="text"
                    value="{{ auth()->user()->name }}"
                    class="w-full border rounded-xl px-4 py-3 bg-gray-100"
                    readonly>
            </div>

            {{-- NIDN (Tidak Bisa Diedit) --}}
            <div>
                <label class="font-semibold block mb-2">
                    NIDN
                </label>

                <input type="text"
                    value="{{ auth()->user()->nidn }}"
                    class="w-full border rounded-xl px-4 py-3 bg-gray-100"
                    readonly>
            </div>

            {{-- Email (Tidak Bisa Diedit) --}}
            <div>
                <label class="font-semibold block mb-2">
                    Email
                </label>

                <input type="email"
                    value="{{ auth()->user()->email }}"
                    class="w-full border rounded-xl px-4 py-3 bg-gray-100"
                    readonly>
            </div>

            {{-- Nomor HP (Bisa Diedit) --}}
            <div>
                <label class="font-semibold block mb-2">
                    Nomor HP
                </label>

                <input type="text"
                    name="no_hp"
                    value="{{ auth()->user()->no_hp }}"
                    class="w-full border rounded-xl px-4 py-3">
            </div>

        </div>

        {{-- Alamat (Bisa Diedit) --}}
        <div class="mt-6">
            <label class="font-semibold block mb-2">
                Alamat
            </label>

            <textarea
                name="alamat"
                rows="4"
                class="w-full border rounded-xl px-4 py-3">{{ auth()->user()->alamat }}</textarea>
        </div>

        <div class="flex gap-3 mt-8">

            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl">
                Simpan Perubahan
            </button>

            <a href="{{ route('dosen.profil') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-xl">
                Batal
            </a>

        </div>

    </form>

</div>

@endsection