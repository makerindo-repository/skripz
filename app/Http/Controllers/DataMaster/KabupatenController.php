<?php

namespace App\Http\Controllers\DataMaster;

use App\Models\Provinsi;
use App\Models\Kabupaten;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KabupatenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kabupaten = Kabupaten::with('provinsi')
        ->orderByDesc('created_at') // Menampilkan kabupaten terbaru lebih dulu dalam provinsi
        ->get()
        ->groupBy('provinsi_id'); // Mengelompokkan hasil berdasarkan Provinsi di Collection
            $kabupatens = Kabupaten::all();
            $provinsi = Provinsi::all();
        return view('pages.datamaster.data-wilayah.kabupaten.index', compact('kabupaten','kabupatens', 'provinsi'));
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
            'provinsi_id' => 'required|exists:provinsis,id',
            'type' => 'required|string|max:50',
            'name' => 'required|string|max:255|unique:kabupatens,name',
            'code' => 'required|string|max:10|unique:kabupatens,code',
            'full_code' => 'required|string|max:20|unique:kabupatens,full_code'
        ]);

        Kabupaten::create($request->all());

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
            'provinsi_id' => 'required|exists:provinsis,id',
            'type' => 'required|string|max:50',
            'name' => 'required|string|max:255|unique:kabupatens,name,' . $id,
            'code' => 'required|string|max:10|unique:kabupatens,code,' . $id,
            'full_code' => 'required|string|max:20|unique:kabupatens,full_code,' . $id
        ]);

        $kabupaten = Kabupaten::findOrFail($id);
        $kabupaten->update($request->all());

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
        if (Kabupaten::destroy($id)) {
            return redirect()->route('kabupaten.index')->with('success', 'destroy');
        } else {
            return redirect()->back()->with('fail', 'Gagal menghapus data bidang perguruan tinggi.');
        }
    }
}
