<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Matkul;
use App\Models\Dosen;

class MatkulController extends Controller
{
    // LIST
    public function index(Request $request)
    {
        $semester = $request->semester ?? 'all';

        $query = Matkul::with('dosen');

        if ($semester != 'all') {
            $query->where('semester', $semester);
        }

        $matkuls = $query
            ->orderBy('semester', 'asc')
            ->orderByRaw('CAST(REGEXP_SUBSTR(kode_mk, "[0-9]+") AS UNSIGNED)')
            ->get();

        $dosens = Dosen::orderBy('nama')->get();

        return view(
            'pages.admin.matkul.index',
            compact('matkuls', 'semester', 'dosens')
        );
    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'kode_mk' => 'required|unique:matkuls,kode_mk',
            'nama_mk' => 'required|string|max:255',
            'sks' => 'required|integer|min:1|max:6',
            'semester' => 'required|integer|min:1|max:4',
            'dosen_id' => 'required|exists:dosens,id'
        ]);

        Matkul::create([
            'kode_mk' => strtoupper($request->kode_mk),
            'nama_mk' => $request->nama_mk,
            'sks' => $request->sks,
            'semester' => $request->semester,
            'dosen_id' => $request->dosen_id
        ]);

        return back()->with('success', 'Mata kuliah berhasil ditambahkan');
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $matkul = Matkul::findOrFail($id);

        $request->validate([
            'kode_mk' => 'required|unique:matkuls,kode_mk,' . $matkul->id,
            'nama_mk' => 'required|string|max:255',
            'sks' => 'required|integer|min:1|max:6',
            'semester' => 'required|integer|min:1|max:4',
            'dosen_id' => 'required|exists:dosens,id'
        ]);

        $matkul->update([
            'kode_mk' => strtoupper($request->kode_mk),
            'nama_mk' => $request->nama_mk,
            'sks' => $request->sks,
            'semester' => $request->semester,
            'dosen_id' => $request->dosen_id
        ]);

        return back()->with('success', 'Mata kuliah berhasil diupdate');
    }

    // DELETE
    public function destroy($id)
    {
        Matkul::findOrFail($id)->delete();

        return back()->with('success', 'Mata kuliah berhasil dihapus');
    }
}