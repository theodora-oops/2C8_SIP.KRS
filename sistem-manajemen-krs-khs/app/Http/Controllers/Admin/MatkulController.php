<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Matkul;
use Illuminate\Support\Facades\DB;

class MatkulController extends Controller
{
    // LIST
    public function index(Request $request)
    {
        $semester = $request->semester;

        $query = Matkul::query();

        if ($semester && $semester != 'all') {
            $query->where('semester', $semester);
        }

        // sorting by semester and then by numeric part of kode_mk
        $matkuls = $query
            ->orderBy('semester', 'asc')
            ->orderByRaw('CAST(REGEXP_SUBSTR(kode_mk, "[0-9]+") AS UNSIGNED)')
            ->get();

        return view('admin.matkul.index', compact('matkuls', 'semester'));
    }

    // =========================
    // STORE
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'kode_mk' => 'required',
            'nama_mk' => 'required',
            'sks' => 'required|integer',
            'semester' => 'required|integer'
        ]);

        Matkul::create($request->all());

        return back()->with('success', 'Matkul berhasil ditambahkan');
    }

    // =========================
    // UPDATE
    // =========================
    public function update(Request $request, $id)
    {
        $matkul = Matkul::findOrFail($id);

        $request->validate([
            'kode_mk' => 'required',
            'nama_mk' => 'required',
            'sks' => 'required|integer',
            'semester' => 'required|integer'
        ]);

        $matkul->update($request->all());

        return back()->with('success', 'Matkul berhasil diupdate');
    }

    // =========================
    // DELETE
    // =========================
    public function destroy($id)
    {
        Matkul::findOrFail($id)->delete();

        return back()->with('success', 'Matkul dihapus');
    }
}