<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Dosen;
use App\Models\Ruang;
use App\Models\Mahasiswa;
use App\Models\Penjadwalan;
use Illuminate\Http\Request;

class PenjadwalanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penjadwalan = Penjadwalan::all();
        $dosen = Dosen::all();
        $mahasiswa = Mahasiswa::all();
        $ruang = Ruang::all();
        $today = Carbon::today();
        // Mendapatkan tanggal besok
        $tomorrow = Carbon::tomorrow();
        // Mendapatkan tanggal awal minggu ini
        $thisWeekStart = Carbon::now()->startOfWeek();
        // Mendapatkan tanggal akhir minggu ini
        $thisWeekEnd = Carbon::now()->endOfWeek();
        // Mengambil data penjadwalan untuk hari ini
        $penjadwalanHariIni = Penjadwalan::whereDate('tanggal_mulai', $today)->get();
        // Mengambil data penjadwalan untuk besok
        $penjadwalanBesok = Penjadwalan::whereDate('tanggal_mulai', $tomorrow)->get();
        // Mengambil data penjadwalan untuk minggu ini
        $penjadwalanMingguIni = Penjadwalan::whereBetween('tanggal_mulai', [$thisWeekStart, $thisWeekEnd])->get();
        return view('pages.jadwal.index', compact('penjadwalan', 'ruang', 'dosen', 'mahasiswa', 'penjadwalanHariIni', 'penjadwalanBesok', 'penjadwalanMingguIni'));
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
            'mahasiswa_id'     => 'required',
            'dosen_id'         => 'required',
            'judul'            => 'required|string|max:255',
            'catatan'          => 'required|string',
            'tanggal_mulai'    => 'required',
            'jam_mulai'        => 'required',
            'ruang_id'         => 'required',
            'jenis_kegiatan'   => 'required',
        ]);

        $penjadwalan =  new Penjadwalan;
        $penjadwalan->mahasiswa_id   = $request->mahasiswa_id;
        $penjadwalan->dosen_id       = $request->dosen_id;
        $penjadwalan->judul          = $request->judul;
        $penjadwalan->catatan        = $request->catatan;
        $penjadwalan->tanggal_mulai  = $request->tanggal_mulai;
        $penjadwalan->tanggal_selesai= $request->tanggal_selesai;
        $penjadwalan->jam_mulai      = $request->jam_mulai;
        $penjadwalan->jam_selesai    = $request->jam_selesai;
        $penjadwalan->ruang_id       = $request->ruang_id;
        $penjadwalan->jenis_kegiatan = $request->jenis_kegiatan;
        $penjadwalan->save();

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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
