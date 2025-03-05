<?php

namespace App\Http\Controllers\DataMaster;

use App\Models\Keilmuan;
use Illuminate\Http\Request;
use App\Models\KelompokKeilmuan;
use App\Http\Controllers\Controller;

class KelompokKeilmuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelilmuan = KelompokKeilmuan::orderBy('created_at', 'DESC')->get();
        $keilmuan  = Keilmuan::orderBy('created_at', 'DESC')->get();
        return view('pages.datamaster.data-kelilmuan.index', compact('kelilmuan','keilmuan'));
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
            'keilmuan_id'   => 'required',
            'bidang_kajian' => 'required|string|max:255',
            'koordinator'   => 'required|string|max:255',
            'fakultas'      => 'required|string|max:255',
            'deskripsi'     => 'required|string',
            'links'         => 'required|string',
        ]);
        $kelilmuan = new KelompokKeilmuan;

        $kelilmuan->keilmuan_id     = $request->keilmuan_id;
        $kelilmuan->bidang_kajian   = $request->bidang_kajian;
        $kelilmuan->koordinator     = $request->koordinator;
        $kelilmuan->fakultas        = $request->fakultas;
        $kelilmuan->deskripsi       = $request->deskripsi;
        $kelilmuan->links           = $request->links;
        $kelilmuan->save();

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
            'keilmuan_id'   => 'required',
            'bidang_kajian' => 'required|string|max:255',
            'koordinator'   => 'required|string|max:255',
            'fakultas'      => 'required|string|max:255',
            'deskripsi'     => 'required|string',
            'links'         => 'required|string',

        ]);
        $kelilmuan = KelompokKeilmuan::findOrFail($id);
        $kelilmuan->update([
            'keilmuan_id'   => $request->keilmuan_id,
            'bidang_kajian' => $request->bidang_kajian,
            'koordinator'   => $request->koordinator,
            'fakultas'      => $request->fakultas,
            'deskripsi'     => $request->deskripsi,
            'links'         => $request->links,
        ]);

        return back()->with('success', 'update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (KelompokKeilmuan::destroy($id)) {
            return redirect()->route('kelompok-keilmuan.index')->with('success', 'destroy');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus data topik kelompok keilmuan.');
        }
    }
}
