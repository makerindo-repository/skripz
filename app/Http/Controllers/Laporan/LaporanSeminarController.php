<?php

namespace App\Http\Controllers\Laporan;

use App\Models\Mahasiswa;
use Illuminate\Support\Str;
use App\Models\DosenPenguji;
use Illuminate\Http\Request;
use App\Models\LaporanSeminar;
use App\Http\Controllers\Controller;

class LaporanSeminarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dospeng = DosenPenguji::all();
        $mahasiswas = Mahasiswa::all();
        $seminar = LaporanSeminar::orderBy('created_at', 'DESC')->get();
        return view('pages.laporan.lapor-seminar.index', compact('seminar', 'dospeng', 'mahasiswas'));
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
            'dosen_penguji_id'      => 'required',
            'mahasiswa_id'          => 'required',
            'tanggal_seminar'       => 'required',
            'hasil_seminar'         => 'required',
            'saran_penguji'         => 'required|string|max:255',
            'catatan_mahasiswa'     => 'required|string',
            'file_laporan'          => 'required|mimes:pdf,doc,docx|max:4096',
        ]);
        $user = auth()->user();
        $maxSubmissions = $user->plan ? $user->plan->getFeatureLimit('progress_report') : null;

        $submissionCount = LaporanSeminar::where('mahasiswa_id', $user->id)->count();
        if ($maxSubmissions && $submissionCount >= $maxSubmissions) {
            return back()->with('error', 'Maksimal ' . $maxSubmissions . ' Laporan Kemajuan Seminar dapat diunggah');
        }
        $seminar =  new LaporanSeminar;
        $fileName = time() . '_' . $request->file('file_laporan')->getClientOriginalName();
        $request->file('file_laporan')->move(public_path('files/laporan-kemajuan-seminar'), $fileName);

        $seminar->dosen_penguji_id     = $request->dosen_penguji_id;
        $seminar->mahasiswa_id         = $request->mahasiswa_id;
        $seminar->tanggal_seminar      = $request->tanggal_seminar;
        $seminar->hasil_seminar        = $request->hasil_seminar;
        $seminar->saran_penguji        = $request->saran_penguji;
        $seminar->catatan_mahasiswa    = $request->catatan_mahasiswa;
        $seminar->file_laporan         = 'files/laporan-kemajuan-seminar/' . $fileName;
        $seminar->save();

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
            'dosen_penguji_id'      => 'required',
            'mahasiswa_id'          => 'required',
            'tanggal_seminar'       => 'required',
            'hasil_seminar'         => 'required',
            'saran_penguji'         => 'required|string|max:255',
            'catatan_mahasiswa'     => 'required|string',
        ]);
        $seminar = LaporanSeminar::findOrFail($id);
        if ($request->hasFile('file_laporan')) {
            // Hapus file_laporan sebelumnya jika ada
            if ($seminar->file_laporan && file_exists(public_path($seminar->file_laporan))) {
                unlink(public_path($seminar->file_laporan));
            }

            $file = $request->file('file_laporan');
            $fileName = strtoupper(Str::random(5)) . '-' . rand() . '-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('files/laporan-kemajuan-seminar'), $fileName);
        }
        $seminar->update([
            'dosen_penguji_id'      => $request->dosen_penguji_id,
            'mahasiswa_id'          => $request->mahasiswa_id,
            'tanggal_seminar'       => $request->tanggal_seminar,
            'hasil_seminar'         => $request->hasil_seminar,
            'saran_penguji'         => $request->saran_penguji,
            'catatan_mahasiswa'     => $request->catatan_mahasiswa,
            'file_laporan'          => isset($fileName) ? 'files/laporan-kemajuan-seminar/' . $fileName : $seminar->file_laporan,
        ]);

        return back()->with('success', 'update');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $seminar = LaporanSeminar::findOrFail($id);

        if (LaporanSeminar::destroy($id)) {
            // Menghapus file terkait jika ada
            if (!empty($seminar->file_laporan)) {
                if (file_exists(public_path($seminar->file_laporan))) {
                    unlink(public_path($seminar->file_laporan));
            }
        }
            return redirect()->route('laporan-kemajuan-seminar.index')->with('success', 'destroy');
        } else {
            return redirect()->route('laporan-kemajuan-seminar.index')->with('fail', 'destroy');
        }
    }
}
