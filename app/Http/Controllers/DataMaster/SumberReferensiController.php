<?php

namespace App\Http\Controllers\DataMaster;

use Illuminate\Http\Request;
use App\Models\SumberReferensi;
use App\Http\Controllers\Controller;

class SumberReferensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sumber = SumberReferensi::orderBy('created_at', 'DESC')->get();
        return view('pages.datamaster.data-sumber.index', compact('sumber'));

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
            'sumber_referensi' => 'required|string|max:255|unique:sumber_referensis,sumber_referensi'
        ]);
        $sumber = new SumberReferensi;
        $sumber->create([
            'sumber_referensi' => $request->sumber_referensi
        ]);
        return back()->with('success', 'store');
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
            'sumber_referensi' => 'required|string|max:255|unique:sumber_referensis,sumber_referensi,' . $id
        ]);
        $sumber = SumberReferensi::findOrFail($id);
        $sumber->update([
            'sumber_referensi' => $request->sumber_referensi
        ]);
        return back()->with('success', 'update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (SumberReferensi::destroy($id)) {
            return redirect()->route('sumber-referensi.index')->with('success', 'destroy');
        } else {
            return redirect()->back()->with('fail', 'destroy');
        }
    }
}
