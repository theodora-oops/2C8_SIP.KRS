@extends('layouts.app')
@section('content')

<!-- ALERT -->
@if(session('success'))
<div class="bg-green-500 text-white p-3 rounded mb-4">
    {{ session('success') }}
</div>
@endif

<!-- HEADER -->
<div class="flex justify-between items-center mb-4">

    <button onclick="openModal()" class="bg-blue-500 text-white px-4 py-2 rounded">
        + Tambah Pengguna
    </button>

    <form method="GET" action="{{ route('pengguna.index') }}">
        <select name="role" onchange="this.form.submit()" class="border px-3 py-2 rounded">
            <option value="all" {{ $role == 'all' ? 'selected' : '' }}>Semua</option>
            <option value="admin" {{ $role == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="dosen" {{ $role == 'dosen' ? 'selected' : '' }}>Dosen</option>
            <option value="mahasiswa" {{ $role == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
        </select>
    </form>

</div>

<!-- TABLE -->
<div class="bg-white p-5 rounded-xl shadow overflow-x-auto">

<table class="w-full text-center">

<thead>
<tr class="border-b bg-gray-50">
    <th class="p-3">No</th>
    <th class="p-3">Nama</th>
    <th class="p-3">Email</th>
    <th class="p-3">Role</th>
    <th class="p-3">Status</th>
    <th class="p-3">Aksi</th>
</tr>
</thead>

<tbody>
@foreach($users as $user)
<tr class="border-b">

    <td class="p-3">{{ $loop->iteration }}</td>
    <td class="p-3">{{ $user->name }}</td>
    <td class="p-3">{{ $user->email }}</td>
    <td class="p-3 capitalize">{{ $user->role }}</td>

    <td class="p-3">
        @if($user->status == 'active')
            <span class="bg-green-500 text-white px-2 py-1 rounded">Aktif</span>
        @else
            <span class="bg-red-500 text-white px-2 py-1 rounded">Nonaktif</span>
        @endif
    </td>

    <td class="p-3">
        <div class="flex justify-center gap-2">

            <!-- EDIT -->
            <button class="bg-yellow-400 px-3 py-1 rounded btn-edit"
                data-id="{{ $user->id }}"
                data-name="{{ $user->name }}"
                data-email="{{ $user->email }}"
                data-role="{{ $user->role }}">
                Edit
            </button>

            <!-- NONAKTIFKAN -->
            <form action="{{ route('pengguna.destroy', $user->id) }}" method="POST">
                @csrf
                @method('DELETE')

                <button class="bg-gray-600 text-white px-3 py-1 rounded"
                    onclick="return confirm('Ubah status user ini?')">
                    Nonaktifkan
                </button>
            </form>

        </div>
    </td>

</tr>
@endforeach
</tbody>

</table>
</div>

<!-- MODAL (CENTER PERFECT) -->
<div id="modal"
     class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">

    <div class="bg-white p-6 rounded-xl w-96 shadow-lg">

        <h3 class="text-lg font-bold mb-4">Form Pengguna</h3>

        <form id="formUser" method="POST">
            @csrf
            <input type="hidden" name="_method" id="methodField">

            <input type="text" name="name" id="name" placeholder="Nama"
                   class="w-full border p-2 mb-3 rounded">

            <input type="email" name="email" id="email" placeholder="Email"
                   class="w-full border p-2 mb-3 rounded">

            <div id="passwordField">
                <input type="password" name="password" placeholder="Password"
                       class="w-full border p-2 mb-3 rounded">
            </div>

            <select name="role" id="role"
                    class="w-full border p-2 mb-4 rounded">
                <option value="">-- Role --</option>
                <option value="admin">Admin</option>
                <option value="dosen">Dosen</option>
                <option value="mahasiswa">Mahasiswa</option>
            </select>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal()"
                        class="px-3 py-1 bg-gray-300 rounded">
                    Batal
                </button>

                <button class="bg-blue-500 text-white px-3 py-1 rounded">
                    Simpan
                </button>
            </div>

        </form>
    </div>
</div>

<script>
function openModal() {
    document.getElementById('modal').classList.remove('hidden');
    document.getElementById('modal').classList.add('flex');

    document.getElementById('formUser').action = "{{ route('pengguna.store') }}";
    document.getElementById('methodField').value = '';

    document.getElementById('name').value = '';
    document.getElementById('email').value = '';
    document.getElementById('role').value = '';

    document.getElementById('passwordField').style.display = 'block';
}

function closeModal() {
    document.getElementById('modal').classList.add('hidden');
    document.getElementById('modal').classList.remove('flex');
}

// EDIT
document.querySelectorAll('.btn-edit').forEach(btn => {
    btn.addEventListener('click', function () {

        openModal();

        document.getElementById('formUser').action =
            '/admin/pengguna/' + this.dataset.id;

        document.getElementById('methodField').value = 'PUT';

        document.getElementById('name').value = this.dataset.name;
        document.getElementById('email').value = this.dataset.email;
        document.getElementById('role').value = this.dataset.role;

        document.getElementById('passwordField').style.display = 'none';
    });
});
</script>

@endsection