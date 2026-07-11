<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $role = $request->role ?? 'all';
        $search = $request->search;

        $users = User::with(['admin', 'dosen', 'mahasiswa']);

        if ($role !== 'all') {
            $users->where('role', $role);
        }

        if ($search) {
            $users->where(function ($query) use ($search) {
                
            $query->where('email', 'like', '%' . $search . '%')

            ->orWhereHas('admin', function ($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('nomor_induk', 'like', '%' . $search . '%');
            })

            ->orWhereHas('dosen', function ($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('nomor_induk', 'like', '%' . $search . '%');
            })

            ->orWhereHas('mahasiswa', function ($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('nomor_induk', 'like', '%' . $search . '%');
            });

    });

}

        $users = $users->latest()->get();

        return view('pages.admin.pengguna.index', compact('users', 'role', 'search'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'identitas' => 'required|unique:admins,nomor_induk|unique:dosens,nomor_induk|unique:mahasiswas,nomor_induk',
            'name'       => 'required',
            'password'   => 'required|min:6',
            'role'       => 'required|in:admin,dosen,mahasiswa'
        ]);

        // buat email otomatis
        $namaDepan = strtolower(explode(' ', trim($request->name))[0]);

        if ($request->role == 'dosen') {
            $email = $namaDepan . '@dosen.kampus.id';
        } elseif ($request->role == 'mahasiswa') {
            $email = $namaDepan . '@mahasiswa.kampus.id';
        } else {
            $email = $namaDepan . '@admin.kampus.id';
        }

        // cek email dupclicate
        $counter = 1;
        while (User::where('email', $email)->exists()) {

            if ($request->role == 'dosen') {
                $email = $namaDepan . $counter . '@dosen.kampus.id';
            } elseif ($request->role == 'mahasiswa') {
                $email = $namaDepan . $counter . '@mahasiswa.kampus.id';
            } else {
                $email = $namaDepan . $counter . '@admin.kampus.id';
            }

            $counter++;
        }

        // simpan ke tabel users
        $user = User::create([
            'email'   => $email,
            'password'=> Hash::make($request->password),
            'role'    => $request->role,
            'status'  => 'active'
        ]);

        // simpan sesuai role
        if ($request->role == 'admin') {

            Admin::create([
                'user_id'       => $user->id,
                'nomor_induk'   => $request->identitas,
                'nama'          => $request->name
            ]);

        } elseif ($request->role == 'dosen') {

            Dosen::create([
                'user_id'       => $user->id,
                'nomor_induk'   => $request->identitas,
                'nama'          => $request->name
            ]);

        } else {

            Mahasiswa::create([
                'user_id'       => $user->id,
                'nomor_induk'   => $request->identitas,
                'nama'          => $request->name,
                'kelas'         => $request->kelas
            ]);
        }

        return back()->with('success', 'User berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'identitas' => 'required',
            'name'      => 'required',
            'role'      => 'required|in:admin,dosen,mahasiswa'
        ]);

        // hapus data lama kalau role berubah 
        if ($user->role != $request->role) {

            if ($user->admin) $user->admin->delete();
            if ($user->dosen) $user->dosen->delete();
            if ($user->mahasiswa) $user->mahasiswa->delete();
        }

        // buat email otomatis
        $namaDepan = strtolower(explode(' ', trim($request->name))[0]);

        if ($request->role == 'dosen') {
            $email = $namaDepan . '@dosen.kampus.id';
        } elseif ($request->role == 'mahasiswa') {
            $email = $namaDepan . '@mhs.kampus.id';
        } else {
            $email = $namaDepan . '@admin.kampus.id';
        }

        // cek jika email dipakai user lain
        $counter = 1;
        while (
            User::where('email', $email)
                ->where('id', '!=', $user->id)
                ->exists()
        ) {

            if ($request->role == 'dosen') {
                $email = $namaDepan . $counter . '@dosen.kampus.id';
            } elseif ($request->role == 'mahasiswa') {
                $email = $namaDepan . $counter . '@mhs.kampus.id';
            } else {
                $email = $namaDepan . $counter . '@admin.kampus.id';
            }

            $counter++;
        }

        // update users
        $data = [
            'email' => $email,
            'role'  => $request->role
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        // update / create sesuai role
        if ($request->role == 'admin') {

            Admin::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'nomor_induk' => $request->identitas,
                    'nama'        => $request->name
                ]
            );

        } elseif ($request->role == 'dosen') {

            Dosen::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'nomor_induk' => $request->identitas,
                    'nama'        => $request->name
                ]
            );

        } else {

            Mahasiswa::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'nomor_induk' => $request->identitas,
                    'nama'        => $request->name,
                    'kelas'       => $request->kelas
                ]
            );
        }

        return back()->with('success', 'User berhasil diupdate');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'status' => $user->status == 'active'
                ? 'inactive'
                : 'active'
        ]);

        return back()->with('success', 'Status user berhasil diubah');
    }
}
