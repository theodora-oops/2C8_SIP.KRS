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
        return view('admin.semester.index', compact('semesters'));
    }

    // =========================
    // STORE
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'tahun_ajaran' => 'required',
            'tipe' => 'required'
        ]);

        Semester::create($request->all());

        return back()->with('success', 'Semester ditambahkan');
    }

    // =========================
    // AKTIFKAN SEMESTER
    // =========================
    public function activate($id)
    {
        Semester::query()->update(['is_active' => false]);

        Semester::where('id', $id)->update([
            'is_active' => true
        ]);

        return back()->with('success', 'Semester diaktifkan');
    }

    // =========================
    // DELETE
    // =========================
    public function destroy($id)
    {
        Semester::findOrFail($id)->delete();

        return back()->with('success', 'Semester dihapus');
    }
}