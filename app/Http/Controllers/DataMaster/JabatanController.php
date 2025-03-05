<?php

namespace App\Http\Controllers\DataMaster;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jabatan = Jabatan::orderBy('created_at', 'DESC')->get();
        return view('pages.datamaster.data-jabatan.index', compact('jabatan'));
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
            'nama_jabatan' => 'required|string|max:255|unique:jabatans,nama_jabatan'
        ]);

        $jabatan = new Jabatan;
        $jabatan->nama_jabatan = $request->nama_jabatan;
        $jabatan->save();

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
            'nama_jabatan' => 'required|string|max:255|unique:jabatans,nama_jabatan,' . $id
        ]);

        $jabatan = Jabatan::findOrFail($id);
        $jabatan->update([
            'nama_jabatan' => $request->nama_jabatan
        ]);

        return back()->with('success', 'update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (Jabatan::destroy($id)) {
            return redirect()->route('jabatan.index')->with('success', 'destroy');
        } else {
            return redirect()->back()->with('fail', 'Gagal menghapus data bidang jabatan.');
        }
    }
}
