<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Period;
use App\Models\Semester;
use Illuminate\Http\Request;

class PeriodController extends Controller
{
    public function index()
    {
        $periods = Period::with('semester')->latest()->get();
        $semesters = Semester::all();


        return view('pages.admin.periods.index', compact('periods', 'semesters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'type' => 'required|in:krs,nilai',
            'semester_id' => 'required|exists:semesters,id',
        ]);

        Period::create([
            'name' => $request->name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'type' => $request->type,
            'semester_id' => $request->semester_id,
        ]);

        return back()->with('success', 'Periode berhasil ditambahkan');
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'type' => 'required|in:krs,nilai',
            'semester_id' => 'required|exists:semesters,id',
        ]);
        
        $period = Period::findOrFail($id);
        $period->update([
            'name' => $request->name,
            'type' => $request->type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'semester_id' => $request->semester_id,
        ]);
        
        return back()->with('success', 'Periode berhasil diperbarui');
    }

    public function destroy($id)
    {
        $period = Period::findOrFail($id);
        $period->delete();

        return back()->with('success', 'Periode dihapus');
    }
}