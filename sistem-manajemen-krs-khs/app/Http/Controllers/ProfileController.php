<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        switch ($user->role) {
            case 'admin':
                $profile = $user->admin;
                $view = 'pages.admin.profile.index';
                break;

            case 'dosen':
                $profile = $user->dosen;
                $view = 'pages.dosen.profile.index';
                break;
            
            case 'mahasiswa':
                $profile = $user->mahasiswa;
                $view = 'pages.mahasiswa.profile.index';
                break;

            default:
            abort(403, 'Role tidak dikenali');
        }
        
        return view($view, compact('user', 'profile'));
    }

    public function update(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $request->validate([
            'no_hp' => 'nullable|max:20',
            'alamat' => 'nullable',
            'password' => 'nullable|min:8',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        if ($user->role == 'admin') {
            $profile = $user->admin;
        } elseif ($user->role == 'dosen') {
            $profile = $user->dosen;
        } else {
            $profile = $user->mahasiswa;
        }

        if ($request->hasFile('foto')) {

            if ($profile->foto &&
                Storage::disk('public')->exists('foto/'.$profile->foto)) {

                Storage::disk('public')
                    ->delete('foto/'.$profile->foto);
            }

            $filename = time().'.'.$request->foto->extension();

            $request->foto
                ->storeAs('foto', $filename, 'public');

            $profile->foto = $filename;
        }

        $profile->no_hp = $request->no_hp;
        $profile->alamat = $request->alamat;

        $profile->save();

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        return back()->with('success', 'Profil berhasil diperbarui');
    }
}