<?php

namespace App\Http\Controllers\DataMaster;

use App\Models\Ruang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RuangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ruang = Ruang::orderBy('created_at', 'DESC')->get();
        return view('pages.datamaster.data-ruang.index', compact('ruang'));
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
            'nama_ruang'      => 'required|string|max:255',
            'kapasitas'       => 'required|integer',
            'jenis_ruang'     => 'required|string|max:255',
            'lantai'          => 'required|integer',
            'gedung'          => 'required|string|max:255',
            'fasilitas'       => 'required|string|max:255',
            'ketersediaan'    => 'required|string|max:255',
        ]);

        $ruang = new Ruang;
        $linkInput = $request->input('fasilitas');
        $linkArray = explode(',', $linkInput);

        $ruang->nama_ruang     = $request->nama_ruang;
        $ruang->kapasitas      = $request->kapasitas;
        $ruang->jenis_ruang    = $request->jenis_ruang;
        $ruang->lantai         = $request->lantai;
        $ruang->gedung         = $request->gedung;
        $ruang->fasilitas      = json_encode($linkArray);
        $ruang->ketersediaan   = $request->ketersediaan;
        $ruang->save();

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
            'nama_ruang'      => 'required|string|max:255',
            'kapasitas'       => 'required|integer',
            'jenis_ruang'     => 'required|string|max:255',
            'lantai'          => 'required|integer',
            'gedung'          => 'required|string|max:255',
            'fasilitas'       => 'required|string|max:255',
            'ketersediaan'    => 'required|string|max:255',
        ]);

        $ruang = Ruang::findOrFail($id);
        $linkInput = $request->input('fasilitas');
        $linkArray = explode(',', $linkInput);
        $ruang->update([
            'nama_ruang'      => $request->nama_ruang,
            'kapasitas'       => $request->kapasitas,
            'jenis_ruang'     => $request->jenis_ruang,
            'lantai'          => $request->lantai,
            'gedung'          => $request->gedung,
            'fasilitas'       => json_encode($linkArray),
            'ketersediaan'    => $request->ketersediaan,
        ]);

        return back()->with('success', 'update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Ruang::destroy($id)) {
            return redirect()->route('ruang.index')->with('success', 'destroy');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus data ruang.');
        }
    }
}
