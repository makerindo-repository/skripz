<?php

namespace App\Http\Controllers\DataMaster;

use App\Models\Keilmuan;
use App\Models\TopikSkripsi;
use Illuminate\Http\Request;
use App\Models\SumberReferensi;
use App\Http\Controllers\Controller;

class TopikSkripsiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $topiksk    = TopikSkripsi::orderBy('created_at', 'DESC')->get();
        $keilmuan   = Keilmuan::orderBy('created_at', 'DESC')->get();
        $sumber     = SumberReferensi::orderBy('created_at', 'DESC')->get();
        return view('pages.datamaster.data-topiksk.index', compact('topiksk','keilmuan','sumber'));
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
            'keilmuan_id'           => 'required',
            'sumber_id'             => 'required',
            'judul_topik'           => 'required|string|max:255',
            'kata_kunci'            => 'required|string|max:255',
            'deskripsi'             => 'required',
            'link'                  => 'required',
        ]);
        $linkInput = $request->input('link');
        $linkArray = explode(',', $linkInput);

        $topiksk = new TopikSkripsi;
        $topiksk->keilmuan_id           = $request->keilmuan_id;
        $topiksk->sumber_id             = $request->sumber_id;
        $topiksk->judul_topik           = $request->judul_topik;
        $topiksk->kata_kunci            = $request->kata_kunci;
        $topiksk->deskripsi             = $request->deskripsi;
        $topiksk->link                  = json_encode($linkArray);
        $topiksk->save();

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
            'keilmuan_id'           => 'required',
            'sumber_id'                => 'required',
            'judul_topik'           => 'required|string|max:255',
            'kata_kunci'            => 'required|string|max:255',
            'deskripsi'             => 'required',
            'link'                  => 'required',
        ]);

        $topiksk = TopikSkripsi::findOrFail($id);
        $linkInput = $request->input('link');
        $linkArray = explode(',', $linkInput);
        $topiksk->update([
            'judul_topik'        => $request->judul_topik,
            'keilmuan_id'        => $request->keilmuan_id,
            'sumber_id'          => $request->sumber_id,
            'kata_kunci'         => $request->kata_kunci,
            'deskripsi'          => $request->deskripsi,
            'link'               => json_encode($linkArray),
        ]);

        return back()->with('success', 'update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (TopikSkripsi::destroy($id)) {
            return redirect()->route('topik-skripsi.index')->with('success', 'destroy');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus data topik skripsi.');
        }
    }

    public function updateStatus(Request $request)
    {
        foreach ($request->judul_topik as $id => $data) {
            $topik = TopikSkripsi::findOrFail($id);
            $topik->update([
                'status_topik' => $data['status_topik']
            ]);
        }

        return redirect()->back()->with('success', 'update');
    }

}
