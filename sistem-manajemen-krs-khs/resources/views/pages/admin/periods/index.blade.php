@extends('layouts.app')

@section('title', 'Periode Akademik')

@section('content')

<!-- Font -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

</style>

<div style="font-family: 'Inter', sans-serif;">

    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">
                Periode Akademik
            </h1>
            <p class="text-gray-500 mt-1">
                Atur periode pengisian KRS dan input nilai.
            </p>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-xl mb-6">
        {{ session('success') }}
    </div>
    @endif

    {{-- FORM TAMBAH --}}
    <div class="bg-white rounded-2xl shadow-sm p-6 mb-8">

        <h2 class="text-lg font-semibold text-gray-700 mb-4">
            Tambah Periode Baru
        </h2>

        <form action="{{ route('periods.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">
                        Nama Periode
                    </label>

                    <input type="text" name="name" placeholder="Contoh: KRS Semester Ganjil"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">
                        Jenis Periode
                    </label>

                    <select name="type"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none">

                        <option value="">-- Pilih Jenis --</option>
                        <option value="krs">Pengisian KRS</option>
                        <option value="nilai">Input Nilai</option>

                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">
                        Semester
                    </label>

                    <select name="semester_id" class="w-full border border-gray-300 rounded-xl px-4 py-3
        focus:ring-2 focus:ring-indigo-500 focus:outline-none">

                        <option value="">-- Pilih Semester --</option>

                        @foreach($semesters as $semester)
                        <option value="{{ $semester->id }}">
                            {{ $semester->nama }}
                        </option>
                        @endforeach

                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">
                        Tanggal Mulai
                    </label>

                    <input type="date" name="start_date"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">
                        Tanggal Selesai
                    </label>

                    <input type="date" name="end_date"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>

            </div>

            <div class="mt-6">
                <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl transition">
                    Simpan Periode
                </button>
            </div>

        </form>

    </div>

    {{-- TABEL --}}
    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">

        <div class="px-6 py-4 border-b">
            <h2 class="text-lg font-semibold text-gray-700">
                Daftar Periode
            </h2>
        </div>

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left">Nama Periode</th>
                        <th class="px-6 py-4 text-left">Jenis</th>
                        <th class="px-6 py-4 text-left">Semester</th>
                        <th class="px-6 py-4 text-left">Mulai</th>
                        <th class="px-6 py-4 text-left">Selesai</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($periods as $p)

                    <tr class="border-t hover:bg-gray-50">

                        <td class="px-6 py-4 font-medium text-gray-800">
                            {{ $p->name }}
                        </td>

                        <td class="px-6 py-4">
                            @if($p->type == 'krs')
                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold">
                                KRS
                            </span>
                            @else
                            <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-xs font-semibold">
                                Nilai
                            </span>
                            @endif
                        </td>

                        <td class="px-6 py-4">{{ $p->semester->nama ?? '-' }}</td>

                        <td class="px-6 py-4">
                            {{ \Carbon\Carbon::parse($p->start_date)->format('d M Y') }}
                        </td>

                        <td class="px-6 py-4">
                            {{ \Carbon\Carbon::parse($p->end_date)->format('d M Y') }}
                        </td>

                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center gap-2">

                                <button type="button"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg" onclick="openEditModal(
                        '{{ $p->id }}',
                        '{{ $p->name }}',
                        '{{ $p->type }}',
                        '{{ $p->semester_id }}',
                        '{{ $p->start_date }}',
                        '{{ $p->end_date }}'
                    )">
                                    Edit
                                </button>

                                <form action="{{ route('periods.destroy', $p->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus periode ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">
                                        Hapus
                                    </button>

                                </form>

                            </div>
                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="5" class="text-center py-8 text-gray-500">
                            Belum ada periode yang ditambahkan.
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    <!-- Modal Edit -->
    <div id="editModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

        <div class="bg-white rounded-2xl p-6 w-full max-w-lg">

            <div class="flex justify-between items-center mb-5">
                <h2 class="text-xl font-bold">
                    Edit Periode
                </h2>

                <button type="button" onclick="closeEditModal()" class="text-gray-500 text-2xl">
                    &times;
                </button>
            </div>

            <form id="editForm" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-4">

                    <select id="edit_semester_id" name="semester_id" class="w-full border rounded-xl px-4 py-3">
                        @foreach($semesters as $semester)

                        <option value="{{ $semester->id }}">
                            {{ $semester->nama }}
                        </option>
                        @endforeach
                    </select>

                    <input type="text" id="edit_name" name="name" class="w-full border rounded-xl px-4 py-3">

                    <select id="edit_type" name="type" class="w-full border rounded-xl px-4 py-3">

                        <option value="krs">Pengisian KRS</option>
                        <option value="nilai">Input Nilai</option>

                    </select>

                    <input type="date" id="edit_start_date" name="start_date"
                        class="w-full border rounded-xl px-4 py-3">

                    <input type="date" id="edit_end_date" name="end_date" class="w-full border rounded-xl px-4 py-3">

                    <div class="flex justify-end gap-2">

                        <x-button type="button" class="bg-gray-500 hover:bg-gray-600" onclick="closeEditModal()">
                            Batal
                        </x-button>

                        <x-button type="submit" class="bg-indigo-600 hover:bg-indigo-700">
                            Update
                        </x-button>

                    </div>

                </div>

            </form>

        </div>

    </div>
</div>

<script>
    function openEditModal(id, name, type, semesterId, startDate, endDate) {

        document.getElementById('edit_name').value = name;
        document.getElementById('edit_type').value = type;
        document.getElementById('edit_semester_id').value = semesterId;
        document.getElementById('edit_start_date').value = startDate;
        document.getElementById('edit_end_date').value = endDate;

        document.getElementById('editForm').action =
            "{{ url('/admin/periods') }}/" + id;

        document.getElementById('editModal').classList.remove('hidden');
        document.getElementById('editModal').classList.add('flex');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.remove('flex');
        document.getElementById('editModal').classList.add('hidden');
    }

</script>

@endsection