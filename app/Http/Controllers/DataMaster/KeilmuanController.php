<?php

namespace App\Http\Controllers\DataMaster;

use App\Models\Keilmuan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KeilmuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keilmuan = Keilmuan::orderBy('created_at', 'DESC')->get();
        return view('pages.datamaster.data-keilmuan.index', compact('keilmuan'));
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
            'nama_keilmuan' => 'required|string|max:255|unique:keilmuans,nama_keilmuan'
        ]);
        $keilmuan = new Keilmuan;
        $keilmuan->create([
            'nama_keilmuan' => $request->nama_keilmuan
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
            'nama_keilmuan' => 'required|string|max:255|unique:keilmuans,nama_keilmuan,' . $id
        ]);
        $keilmuan = Keilmuan::findOrFail($id);
        $keilmuan->update([
            'nama_keilmuan' => $request->nama_keilmuan
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
        if (Keilmuan::destroy($id)) {
            return redirect()->route('keilmuan.index')->with('success', 'destroy');
        } else {
            return redirect()->back()->with('fail', 'destroy');
        }
    }
}
