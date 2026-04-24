<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
        public function login()
    {
        return view('auth.login');
    }

    public function prosesLogin(Request $request)
    {
        $role = $request->role;

        if ($role == 'admin') {
            return redirect('/admin/dashboard');
        } elseif ($role == 'dosen') {
            return redirect('/dosen/dashboard');
        } else {
            return redirect('/mahasiswa/dashboard');
        }
    }
}
