<?php

namespace App\Http\Controllers\DataMaster;

use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Http\Request;
use App\Models\PerguruanTinggi;
use App\Http\Controllers\Controller;

class PerguruanTinggiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perguruan_tinggi = PerguruanTinggi::with(['provinsi', 'kabupaten', 'kecamatan', 'kelurahan'])->orderBy('provinsi_id')->orderBy('kabupaten_id')->get();
        $provinsis  = Provinsi::all();
        $kabupatens = Kabupaten::all();
        $kecamatans = Kecamatan::all();
        $kelurahans = Kelurahan::all();
        return view('pages.datamaster.perguruan-tinggi.index', compact('perguruan_tinggi', 'provinsis', 'kabupatens', 'kecamatans', 'kelurahans'));
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
        $validated = $request->validate([
            'nama_perguruan_tinggi'          => 'required|string|max:255',
            'provinsi_id'                    => 'required|exists:provinsis,id',
            'kabupaten_id'                   => 'required|exists:kabupatens,id',
            // 'kecamatan_id'                   => 'required|exists:kecamatans,id',
            // 'kelurahan_id'                   => 'required|exists:kelurahans,id',
        ]);

        PerguruanTinggi::create($validated);

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
        $validated = $request->validate([
            'nama_perguruan_tinggi'          => 'required|string|max:255',
            'provinsi_id'                    => 'required|exists:provinsis,id',
            'kabupaten_id'                   => 'required|exists:kabupatens,id',
            // 'kecamatan_id'                   => 'required|exists:kecamatans,id',
            // 'kelurahan_id'                   => 'required|exists:kelurahans,id',
        ]);

        $perguruanTinggi = PerguruanTinggi::findOrFail($id);

        $perguruanTinggi->update($validated);

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
        if (PerguruanTinggi::destroy($id)) {
            return redirect()->route('perguruan-tinggi.index')->with('success', 'destroy');
        } else {
            return redirect()->back()->with('fail', 'Gagal menghapus data bidang perguruan tinggi.');
        }
    }
}
