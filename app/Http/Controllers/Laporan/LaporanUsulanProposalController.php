<?php

namespace App\Http\Controllers\Laporan;

use App\Models\Mahasiswa;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\DosenPembimbing;
use App\Models\LaporanProposal;
use App\Http\Controllers\Controller;

class LaporanUsulanProposalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dospem = DosenPembimbing::all();
        $mahasiswas = Mahasiswa::all();
        $proposal = LaporanProposal::orderBy('created_at', 'DESC')->get();
        return view('pages.laporan.lapor-usulanproposal.index', compact('dospem', 'proposal', 'mahasiswas'));
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
            'dosen_pembimbing_id'   => 'required',
            'mahasiswa_id'          => 'required',
            'judul_proposal'        => 'required|string|max:255',
            'bidang_kajian'         => 'required|string|max:255',
            'tanggal_pengajuan'     => 'required',
            'file_laporan'          => 'required|mimes:pdf,doc,docx|max:4096',
        ]);
        $user = auth()->user();
        $maxSubmissions = $user->plan ? $user->plan->getFeatureLimit('submission_proposal') : null;

        $submissionCount = LaporanProposal::where('mahasiswa_id', $user->id)->count();
        if ($maxSubmissions && $submissionCount >= $maxSubmissions) {
            return back()->with('error', 'Maksimal ' . $maxSubmissions . ' proposal dapat diunggah');
        }
        $proposal =  new LaporanProposal;
        $fileName = time() . '_' . $request->file('file_laporan')->getClientOriginalName();
        $request->file('file_laporan')->move(public_path('files/laporan-usulan-proposal'), $fileName);

        $proposal->dosen_pembimbing_id  = $request->dosen_pembimbing_id;
        $proposal->mahasiswa_id         = $request->mahasiswa_id;
        $proposal->judul_proposal       = $request->judul_proposal;
        $proposal->bidang_kajian        = $request->bidang_kajian;
        $proposal->tanggal_pengajuan    = $request->tanggal_pengajuan;
        $proposal->file_laporan         = 'files/laporan-usulan-proposal/' . $fileName;
        $proposal->save();

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
            'dosen_pembimbing_id'   => 'required',
            'mahasiswa_id'          => 'required',
            'judul_proposal'        => 'required|string|max:255',
            'bidang_kajian'         => 'required|string|max:255',
            'tanggal_pengajuan'     => 'required',
        ]);

        $proposal = LaporanProposal::findOrFail($id);
        if ($request->hasFile('file_laporan')) {
            // Hapus file_laporan sebelumnya jika ada
            if ($proposal->file_laporan && file_exists(public_path($proposal->file_laporan))) {
                unlink(public_path($proposal->file_laporan));
            }

            $file = $request->file('file_laporan');
            $fileName = strtoupper(Str::random(5)) . '-' . rand() . '-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('files/laporan-usulan-proposal'), $fileName);
        }
        $proposal->update([
            'dosen_pembimbing_id'   => $request->dosen_pembimbing_id,
            'mahasiswa_id'          => $request->mahasiswa_id,
            'judul_proposal'        => $request->judul_proposal,
            'bidang_kajian'         => $request->bidang_kajian,
            'tanggal_pengajuan'     => $request->tanggal_pengajuan,
            'file_laporan'          => isset($fileName) ? 'files/laporan-usulan-proposal/' . $fileName : $proposal->file_laporan,
        ]);

        return back()->with('success', 'update');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $proposal = LaporanProposal::findOrFail($id);

        if (LaporanProposal::destroy($id)) {
            // Menghapus file terkait jika ada
            if (!empty($proposal->file_laporan)) {
                if (file_exists(public_path($proposal->file_laporan))) {
                    unlink(public_path($proposal->file_laporan));
            }
        }
            return redirect()->route('laporan-usulan-proposal.index')->with('success', 'destroy');
        } else {
            return redirect()->route('laporan-usulan-proposal.index')->with('fail', 'destroy');
        }
    }

    public function updateStatus(Request $request)
    {
        foreach ($request->judul_proposal as $id => $data) {
            $topik = LaporanProposal::findOrFail($id);
            $topik->update([
                'status_laporan' => $data['status_laporan']
            ]);
        }

        return redirect()->back()->with('success', 'update');
    }
}
