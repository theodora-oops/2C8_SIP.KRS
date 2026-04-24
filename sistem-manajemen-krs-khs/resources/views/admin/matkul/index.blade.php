@extends('layouts.app')
@section('content')

@if(session('success'))
<div class="bg-green-500 text-white p-3 mb-4 rounded">
    {{ session('success') }}
</div>
@endif

<div class="flex justify-between mb-4">
    <button onclick="openModal()" class="bg-blue-500 text-white px-4 py-2 rounded">
        + Tambah Matkul
    </button>

    <!-- FILTER SEMESTER -->
    <form method="GET">
        <select name="semester" onchange="this.form.submit()" class="border px-3 py-2 rounded">
            <option value="all">Semua</option>
            @for($i=1;$i<=6;$i++)
                <option value="{{ $i }}" {{ $semester==$i?'selected':'' }}>
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
        <button 
            class="bg-yellow-400 px-2 py-1 rounded btn-edit"
            data-id="{{ $mk->id }}"
            data-kode="{{ $mk->kode_mk }}"
            data-nama="{{ $mk->nama_mk }}"
            data-sks="{{ $mk->sks }}"
            data-semester="{{ $mk->semester }}"
        >Edit</button>

        <form method="POST" action="{{ route('matkul.destroy',$mk->id) }}" class="inline">
            @csrf
            @method('DELETE')
            <button class="bg-red-500 text-white px-2 py-1 rounded">Hapus</button>
        </form>
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

<select name="semester" id="semester" class="w-full border p-2 mb-4">
    @for($i=1;$i<=6;$i++)
        <option value="{{ $i }}">Semester {{ $i }}</option>
    @endfor
</select>

<button class="bg-blue-500 text-white px-3 py-1 rounded">Simpan</button>

</form>
</div>
</div>

<script>
function openModal(){
    modal.classList.remove('hidden');
    modal.classList.add('flex');

    formMatkul.action = "{{ route('matkul.store') }}";
    methodField.value = '';

    kode.value = '';
    nama.value = '';
    sks.value = '';
}

document.querySelectorAll('.btn-edit').forEach(btn=>{
    btn.onclick = function(){
        openModal();

        formMatkul.action = '/admin/matkul/'+this.dataset.id;
        methodField.value = 'PUT';

        kode.value = this.dataset.kode;
        nama.value = this.dataset.nama;
        sks.value = this.dataset.sks;
        semester.value = this.dataset.semester;
    }
})
</script>

@endsection