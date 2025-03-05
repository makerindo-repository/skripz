<?php

namespace App\Http\Controllers\DataMaster;

use Illuminate\Http\Request;
use App\Models\PredikatKelulusan;
use App\Http\Controllers\Controller;

class PredikatKelulusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $predlulus = PredikatKelulusan::orderBy('created_at', 'DESC')->get();
        return view('pages.datamaster.data-predlulus.index', compact('predlulus'));
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
            'mahasiswa' => 'required|string|max:255',
            'memuaskan'   => 'required|numeric',
            'sangat_memuaskan'   => 'required|numeric',
            'cumlaude'  => 'required|string|max:255',
        ]);

        $predlulus = new PredikatKelulusan;
        $predlulus->mahasiswa = $request->mahasiswa;
        $predlulus->memuaskan = $request->memuaskan;
        $predlulus->sangat_memuaskan = $request->sangat_memuaskan;
        $predlulus->cumlaude = $request->cumlaude;
        $predlulus->save();

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
            'mahasiswa' => 'required|string|max:255',
            'memuaskan'   => 'required|numeric',
            'sangat_memuaskan'   => 'required|numeric',
            'cumlaude'  => 'required|string|max:255',
        ]);

        $predlulus = PredikatKelulusan::findOrFail($id);
        $predlulus->update([
            'mahasiswa' => $request->mahasiswa,
            'memuaskan'   => $request->memuaskan,
            'sangat_memuaskan'   => $request->sangat_memuaskan,
            'cumlaude'  => $request->cumlaude,
        ]);
        return back()->with('success', 'update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (PredikatKelulusan::destroy($id)) {
            return redirect()->route('predikat-kelulusan.index')->with('success', 'destroy');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus data.');
        }
    }
}
