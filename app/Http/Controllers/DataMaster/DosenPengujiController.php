<?php

namespace App\Http\Controllers\DataMaster;

use App\Models\Dosen;
use App\Models\DosenPenguji;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DosenPengujiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dosen = Dosen::orderBy('created_at', 'DESC')->get();
        $dospeng = DosenPenguji::orderBy('created_at', 'DESC')->get();
        return view('pages.datamaster.data-dospeng.index', compact('dospeng', 'dosen'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'dosen_id'         => 'required|string|max:255|unique:dosen_pengujis,id',
            'program_study'    =>  'required|string|max:255',
        ]);

        $dospeng = new DosenPenguji;

        $dospeng->dosen_id       = $request->dosen_id;
        $dospeng->program_study  = $request->program_study;
        $dospeng->save();

        return back()->with('success', 'store');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'dosen_id'         => 'required|string|max:255|unique:dosen_pengujis,id,' . $id,
            'program_study'    =>  'required|string|max:255',
        ]);

        $dospenguji = DosenPenguji::findOrFail($id);

        $dospenguji->update([
            'dosen_id'      => $request->dosen_id,
            'program_study' => $request->program_study,
        ]);

        return back()->with('success', 'store');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (DosenPenguji::destroy($id)) {
            return redirect()->route('dosen-penguji.index')->with('success', 'destroy');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus data dosen.');
        }
    }
}
