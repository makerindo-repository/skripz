<?php

namespace App\Http\Controllers\DataMaster;

use Illuminate\Http\Request;
use App\Models\BidangKeahlian;
use App\Http\Controllers\Controller;

class BidangKeahlianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bidkeahlian = BidangKeahlian::orderBy('created_at', 'DESC')->get();
        return view('pages.datamaster.data-bidkeahlian.index', compact('bidkeahlian'));
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
            'nama_keahlian' => 'required|string|max:255|unique:bidang_keahlians,nama_keahlian'
        ]);

        $bidkeahlian = new BidangKeahlian;
        $bidkeahlian->nama_keahlian = $request->nama_keahlian;
        $bidkeahlian->save();

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
            'nama_keahlian' => 'required|string|max:255|unique:bidang_keahlians,nama_keahlian,' . $id
        ]);

        $bidkeahlian = BidangKeahlian::findOrFail($id);
        $bidkeahlian->update([
            'nama_keahlian' => $request->nama_keahlian
        ]);

        return back()->with('success', 'update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (BidangKeahlian::destroy($id)) {
            return redirect()->route('bidang-keahlian.index')->with('success', 'destroy');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus data bidang keahlian.');
        }
    }
}
