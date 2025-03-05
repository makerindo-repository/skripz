<?php

namespace App\Http\Controllers\DataMaster;

use App\Models\Ruang;
use Illuminate\Http\Request;
use App\Models\DosenPembimbing;
use App\Models\JadwalBimbingan;
use App\Models\MahasiswaBimbingan;
use App\Http\Controllers\Controller;

class JadwalBimbinganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahbim = MahasiswaBimbingan::orderBy('created_at', 'DESC')->get();
        $jadbim = JadwalBimbingan::orderBy('created_at', 'DESC')->get();
        $dospem = DosenPembimbing::orderBy('created_at', 'DESC')->get();
        $ruang = Ruang::where('ketersediaan', 'Tersedia')->get();
        return view('pages.datamaster.data-jadbim.index', compact('jadbim', 'mahbim', 'ruang', 'dospem'));
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
            'dosen_id'         => 'required|string|max:255',
            'mahbim_id'        => 'required|string|max:255',
            'ruang_id'         => 'required|string|max:255',
            'prodi'            => 'required',
            'tanggal_mulai'    => 'required',
            'tanggal_selesai'  => 'required',
            'jam_mulai'        => 'required',
            'jam_selesai'      => 'required',
            'status_bimbingan' => 'required|string|max:255',
        ]);

        $jadbim = new JadwalBimbingan;

        $jadbim->dosen_id           = $request->dosen_id;
        $jadbim->mahbim_id          = $request->mahbim_id;
        $jadbim->ruang_id           = $request->ruang_id;
        $jadbim->prodi              = $request->prodi;
        $jadbim->tanggal_mulai      = $request->tanggal_mulai;
        $jadbim->tanggal_selesai    = $request->tanggal_selesai;
        $jadbim->jam_mulai          = $request->jam_mulai;
        $jadbim->jam_selesai        = $request->jam_selesai;
        $jadbim->status_bimbingan   = $request->status_bimbingan;
        $jadbim->save();

        $ruangan = Ruang::find($request->ruang_id);
        $ruangan->ketersediaan = 'Digunakan';
        $ruangan->save();

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
            'dosen_id'         => 'required|string|max:255',
            'mahbim_id'        => 'required|string|max:255',
            'ruang_id'         => 'required|string|max:255',
            'prodi'            => 'required',
            'tanggal_mulai'    => 'required',
            'tanggal_selesai'  => 'required',
            'jam_mulai'        => 'required',
            'jam_selesai'      => 'required',
            'status_bimbingan' => 'required|string|max:255',
        ]);


        $jadbim = JadwalBimbingan::findOrFail($id);
        $jadbim->update([
            'dosen_id'              => $request->dosen_id,
            'mahbim_id'             => $request->mahbim_id,
            'ruang_id'              => $request->ruang_id,
            'prodi'                 => $request->prodi,
            'tanggal_mulai'         => $request->tanggal_mulai,
            'tanggal_selesai'       => $request->tanggal_selesai,
            'jam_mulai'             => $request->jam_mulai,
            'jam_selesai'           => $request->jam_selesai,
            'status_bimbingan'      => $request->status_bimbingan,
        ]);

        return back()->with('success', 'update');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (JadwalBimbingan::destroy($id)) {
            return redirect()->route('bimbingan.index')->with('success', 'destroy');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus data dosen.');
        }
    }
}
