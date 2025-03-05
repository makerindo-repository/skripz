<?php

namespace App\Http\Controllers\DataMaster;

use App\Models\Dosen;
use Illuminate\Http\Request;
use App\Models\DosenPembimbing;
use App\Http\Controllers\Controller;

class DosenPembimbingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dosen = Dosen::orderBy('created_at', 'DESC')->get();
        $dospem = DosenPembimbing::orderBy('created_at', 'DESC')->get();
        return view('pages.datamaster.data-dospem.index', compact('dospem', 'dosen'));
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
            'dosen_id'         => 'required|string|max:255|unique:dosen_pembimbings,id',
            'program_study'    => 'required|string|max:255',
        ]);

        $dospem = new DosenPembimbing;

        $dospem->dosen_id       = $request->dosen_id;
        $dospem->program_study  = $request->program_study;
        $dospem->save();

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
            'dosen_id'         => 'required|string|max:255|unique:dosen_pembimbings,id,' . $id,
            'program_study'    =>  'required|string|max:255',
        ]);

        $dospem = DosenPembimbing::findOrFail($id);

        $dospem->update([
            'dosen_id' => $request->dosen_id,
            'program_study' => $request->program_study,
        ]);

        return back()->with('success', 'update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (DosenPembimbing::destroy($id)) {
            return redirect()->route('dosen-pembimbing.index')->with('success', 'destroy');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus data dosen.');
        }
    }
}
