<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Show login page
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle login
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // login dulu
        $request->authenticate();
        $request->session()->regenerate();

        // ambil user login
        $user = $request->user();

        // 🔴 CEK STATUS AKUN (WAJIB DI SINI)
        if ($user->status !== 'active') {

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/login')->withErrors([
                'email' => 'Akun Anda telah dinonaktifkan.'
            ]);
        }

        // 🔵 REDIRECT BERDASARKAN ROLE
        return match ($user->role) {
            'admin' => redirect()->intended('/admin/dashboard'),
            'dosen' => redirect()->intended('/dosen/dashboard'),
            'mahasiswa' => redirect()->intended('/mahasiswa/dashboard'),

            default => redirect('/login')->withErrors([
                'email' => 'Role tidak dikenali.'
            ]),
        };
    }

    /**
     * Logout
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}