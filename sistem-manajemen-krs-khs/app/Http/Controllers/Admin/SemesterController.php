<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Semester;

class SemesterController extends Controller
{
    // =========================
    // LIST
    // =========================
    public function index()
    {
        $semesters = Semester::latest()->get();

        return view('pages.admin.semester.index', compact('semesters'));
    }

    // =========================
    // STORE
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'tahun_ajaran' => 'required|string|max:20',
            'tipe' => 'required|in:ganjil,genap',
        ]);

        Semester::create([
            'tahun_ajaran' => $request->tahun_ajaran,
            'tipe' => $request->tipe,
            'is_active' => false
        ]);

        return back()->with('success', 'Semester berhasil ditambahkan');
    }

    // =========================
    // UPDATE
    // =========================
    public function update(Request $request, $id)
    {
        $request->validate([
            'tahun_ajaran' => 'required|string|max:20',
            'tipe' => 'required|in:ganjil,genap',
        ]);

        $semester = Semester::findOrFail($id);

        $semester->update([
            'tahun_ajaran' => $request->tahun_ajaran,
            'tipe' => $request->tipe,
        ]);

        return back()->with('success', 'Semester berhasil diupdate');
    }

    // =========================
    // AKTIFKAN SEMESTER
    // =========================
    public function activate($id)
    {
        Semester::query()->update([
            'is_active' => false
        ]);

        Semester::where('id', $id)->update([
            'is_active' => true
        ]);

        return back()->with('success', 'Semester berhasil diaktifkan');
    }
}