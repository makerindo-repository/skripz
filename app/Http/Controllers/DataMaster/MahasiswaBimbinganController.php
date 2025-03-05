<?php

namespace App\Http\Controllers\DataMaster;

use App\Models\Mahasiswa;
use App\Models\Ruang;
use Illuminate\Http\Request;
use App\Models\DosenPembimbing;
use App\Models\MahasiswaBimbingan;
use App\Http\Controllers\Controller;

class MahasiswaBimbinganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahbim = MahasiswaBimbingan::orderBy('created_at', 'DESC')->get();
        $mahasiswa = Mahasiswa::orderBy('created_at', 'DESC')->get();
        return view('pages.datamaster.data-mahbim.index', compact('mahbim', 'mahasiswa'));
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
            'mahasiswa_id'     => 'required|unique:mahasiswa_bimbingans,mahasiswa_id',
        ]);

        $mahbim = new MahasiswaBimbingan;
        $mahbim->mahasiswa_id       = $request->mahasiswa_id;
        $mahbim->save();

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
            'mahasiswa_id'     => 'required|unique:mahasiswa_bimbingans,mahasiswa_id,' . $id,
        ]);

        $mahbim = MahasiswaBimbingan::findOrFail($id);
        $mahbim->update([
            'mahasiswa_id'     => $request->mahasiswa_id,
        ]);
        return back()->with('success', 'update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (MahasiswaBimbingan::destroy($id)) {
            return redirect()->route('mahasiswa-bimbingan.index')->with('success', 'destroy');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus data dosen.');
        }
    }
}
