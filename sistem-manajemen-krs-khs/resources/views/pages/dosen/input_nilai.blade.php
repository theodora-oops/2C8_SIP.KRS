@extends('layouts.dosen')

@section('title', 'Input Nilai Mahasiswa')

@section('content')

{{-- SUCCESS ALERT --}}
@if(session('success'))
<div class="mb-5 flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 px-5 py-3 rounded-xl text-sm font-medium">
    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
    </svg>
    {{ session('success') }}
</div>
@endif

{{-- FILTER CARD --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
    <h2 class="text-xl font-bold text-gray-800 mb-5">Input Nilai Mahasiswa</h2>

    <form method="GET" action="{{ route('dosen.nilai') }}" id="filterForm">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-5">

            {{-- SEMESTER --}}
            <form method="GET" action="{{ route('dosen.nilai') }}" id="filterForm">

            <input type="hidden" name="semester_id" value="2">

            {{-- MATA KULIAH --}}
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1.5">Mata Kuliah</label>
                <select name="matkul_id" id="matkulSelect"
                        class="w-full border border-gray-200 rounded-lg px-3.5 py-2.5 text-sm text-gray-700
                               focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white">
                    <option value="">-- Pilih Mata Kuliah --</option>
                    @foreach($matkuls as $mk)
                    <option value="{{ $mk->id }}"
                            data-semester="{{ $mk->semester }}"
                            {{ request('matkul_id') == $mk->id ? 'selected' : '' }}>
                        {{ $mk->nama_mk }} ({{ $mk->kode_mk }})
                    </option>
                    @endforeach
                </select>
            </div>

            {{-- KELAS --}}
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1.5">Kelas</label>
                <select name="kelas"
                        class="w-full border border-gray-200 rounded-lg px-3.5 py-2.5 text-sm text-gray-700
                               focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white">
                    <option value="">-- Semua Kelas --</option>

                    <option value="1" {{ request('kelas') == '1' ? 'selected' : '' }}>
                        Kelas A
                    </option>

                    <option value="2" {{ request('kelas') == '2' ? 'selected' : '' }}>
                        Kelas B
                    </option>

                    <option value="3" {{ request('kelas') == '3' ? 'selected' : '' }}>
                        Kelas C
                    </option>

                    <option value="4" {{ request('kelas') == '4' ? 'selected' : '' }}>
                        Kelas D
                    </option>
                </select>
            </div>

        </div>

        <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2.5 rounded-lg text-sm transition">
            Tampilkan
        </button>
    </form>
</div>

{{-- TABEL NILAI --}}
@if(request('matkul_id'))
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

    @if($mahasiswas->isEmpty())
    <div class="px-8 py-16 text-center text-gray-400">
        <svg class="w-12 h-12 mx-auto mb-3 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                  d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
        </svg>
        <p class="text-sm font-medium">Belum ada mahasiswa yang terdaftar</p>
        <p class="text-xs mt-1">Coba ubah filter kelas atau mata kuliah</p>
    </div>
    @else

    <form method="POST" action="{{ route('dosen.nilai.simpan') }}" id="nilaiForm">
        @csrf
        <input type="hidden" name="matkul_id" value="{{ request('matkul_id') }}">
        <input type="hidden" name="kelas" value="{{ request('kelas') }}">

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-blue-50 border-b border-blue-100">
                        <th class="text-left px-6 py-3.5 font-semibold text-gray-600 uppercase tracking-wide text-xs w-36">EMAIL</th>
                        <th class="text-left px-6 py-3.5 font-semibold text-gray-600 uppercase tracking-wide text-xs">NAMA</th>
                        <th class="text-center px-4 py-3.5 font-semibold text-gray-600 uppercase tracking-wide text-xs w-32">TUGAS</th>
                        <th class="text-center px-4 py-3.5 font-semibold text-gray-600 uppercase tracking-wide text-xs w-32">UTS</th>
                        <th class="text-center px-4 py-3.5 font-semibold text-gray-600 uppercase tracking-wide text-xs w-32">UAS</th>
                        <th class="text-center px-4 py-3.5 font-semibold text-gray-600 uppercase tracking-wide text-xs w-32">NILAI</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100" id="tableBody">
                    @foreach($mahasiswas as $i => $krs)
                    <tr class="hover:bg-gray-50 transition">
                        {{-- EMAIL --}}
                        <td class="px-6 py-4 text-gray-600 font-mono text-xs">
                            {{ $krs->mahasiswa->email ?? $krs->mahasiswa->email ?? '-' }}
                        </td>

                        {{-- NAMA --}}
                        <td class="px-6 py-4 font-medium text-gray-800">
                            {{ $krs->mahasiswa->name }}
                        </td>

                        {{-- TUGAS --}}
                        <td class="px-4 py-3 text-center">
                            <input type="number" name="tugas[{{ $krs->id }}]"
                                   value="{{ old('tugas.'.$krs->id, $krs->tugas) }}"
                                   min="0" max="100" step="0.5"
                                   placeholder="0"
                                   class="nilai-input tugas-input w-full border border-gray-200 rounded-lg px-3 py-2 text-center text-sm
                                          focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent
                                          bg-white disabled:bg-gray-50 disabled:text-gray-400 transition"
                                   data-row="{{ $krs->id }}"
                                   readonly>
                        </td>

                        {{-- UTS --}}
                        <td class="px-4 py-3 text-center">
                            <input type="number" name="uts[{{ $krs->id }}]"
                                   value="{{ old('uts.'.$krs->id, $krs->uts) }}"
                                   min="0" max="100" step="0.5"
                                   placeholder="0"
                                   class="nilai-input uts-input w-full border border-gray-200 rounded-lg px-3 py-2 text-center text-sm
                                          focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent
                                          bg-white disabled:bg-gray-50 disabled:text-gray-400 transition"
                                   data-row="{{ $krs->id }}"
                                   readonly>
                        </td>

                        {{-- UAS --}}
                        <td class="px-4 py-3 text-center">
                            <input type="number" name="uas[{{ $krs->id }}]"
                                   value="{{ old('uas.'.$krs->id, $krs->uas) }}"
                                   min="0" max="100" step="0.5"
                                   placeholder="0"
                                   class="nilai-input uas-input w-full border border-gray-200 rounded-lg px-3 py-2 text-center text-sm
                                          focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent
                                          bg-white disabled:bg-gray-50 disabled:text-gray-400 transition"
                                   data-row="{{ $krs->id }}"
                                   readonly>
                        </td>

                        {{-- NILAI AKHIR (auto-computed, readonly) --}}
                        <td class="px-4 py-3 text-center">
                            <input type="text" id="nilai_{{ $krs->id }}"
                                   value="{{ $krs->nilai ?? '-' }}"
                                   class="w-full border border-gray-200 rounded-lg px-3 py-2 text-center text-sm font-semibold
                                          bg-gray-50 text-gray-600"
                                   readonly>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- ACTION BUTTONS --}}
        <div class="flex justify-end items-center gap-3 px-6 py-4 border-t border-gray-100 bg-gray-50">
            <button type="button" id="btnEdit"
                    class="px-5 py-2.5 rounded-lg border border-gray-300 text-gray-700 text-sm font-semibold hover:bg-gray-100 transition">
                Edit Nilai
            </button>
            <button type="submit" id="btnSimpan" disabled
                    class="px-5 py-2.5 rounded-lg bg-blue-600 text-white text-sm font-semibold
                           hover:bg-blue-700 transition disabled:opacity-40 disabled:cursor-not-allowed">
                Simpan Nilai
            </button>
        </div>
    </form>

    @endif
</div>
@endif

<script>
    const btnEdit   = document.getElementById('btnEdit');
    const btnSimpan = document.getElementById('btnSimpan');
    const inputs    = document.querySelectorAll('.nilai-input');

    // Toggle readonly mode
    btnEdit?.addEventListener('click', function () {
        const isLocked = inputs[0]?.hasAttribute('readonly');

        inputs.forEach(inp => {
            if (isLocked) {
                inp.removeAttribute('readonly');
                inp.classList.remove('bg-white');
                inp.classList.add('bg-white');
            } else {
                inp.setAttribute('readonly', '');
            }
        });

        btnEdit.textContent   = isLocked ? 'Kunci' : 'Edit Nilai';
        btnSimpan.disabled    = !isLocked;
    });

    // Auto-hitung nilai akhir: 30% Tugas + 30% UTS + 40% UAS
    function hitungNilai(rowId) {
        const tugas = parseFloat(document.querySelector(`input[name="tugas[${rowId}]"]`)?.value) || 0;
        const uts   = parseFloat(document.querySelector(`input[name="uts[${rowId}]"]`)?.value)   || 0;
        const uas   = parseFloat(document.querySelector(`input[name="uas[${rowId}]"]`)?.value)   || 0;
        const hasil = ((tugas * 0.3) + (uts * 0.3) + (uas * 0.4)).toFixed(2);
        const nilaiEl = document.getElementById(`nilai_${rowId}`);
        if (nilaiEl) nilaiEl.value = hasil;
    }

    document.querySelectorAll('.nilai-input').forEach(inp => {
        inp.addEventListener('input', function () {
            hitungNilai(this.dataset.row);
        });
    });
</script>

@endsection
