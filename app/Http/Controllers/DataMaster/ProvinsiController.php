<?php

namespace App\Http\Controllers\DataMaster;

use App\Models\Provinsi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProvinsiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provinsi = Provinsi::all();
        return view('pages.datamaster.data-wilayah.provinsi.index', compact('provinsi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:provinsis,name',
            'code' => 'required|string|max:10|unique:provinsis,code'
        ]);

        Provinsi::create([
            'name' => $request->name,
            'code' => $request->code
        ]);

        return redirect()->back()->with('success', 'store');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:provinsis,name,' . $id,
            'code' => 'required|string|max:10|unique:provinsis,code,' . $id
        ]);

        $provinsi = Provinsi::findOrFail($id);
        $provinsi->update([
            'name' => $request->name,
            'code' => $request->code
        ]);

        return redirect()->back()->with('success', 'update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Provinsi::destroy($id)) {
            return redirect()->route('provinsi.index')->with('success', 'destroy');
        } else {
            return redirect()->back()->with('fail', 'Gagal menghapus data bidang perguruan tinggi.');
        }
    }
}
