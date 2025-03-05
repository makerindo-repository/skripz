<?php

namespace App\Http\Controllers\DataMaster;

use App\Models\User;
use App\Models\Jabatan;
use App\Models\Sekretariat;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SekretariatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sekretariat = Sekretariat::orderBy('created_at', 'DESC')->get();
        $jabatan = Jabatan::orderBy('created_at', 'DESC')->get();
        return view('pages.datamaster.data-sekretariat.index', compact('sekretariat', 'jabatan'));
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
            'nama_sekretariat'    => 'required|string|max:255',
            'nip'                 => 'required|string|max:255',
            'jabatan_id'          => 'required|string|max:255',
            'email'               => 'required|string|max:255|unique:sekretariats,email',
            'no_telepon'          => 'required|string|max:255',
            'foto'                => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $sekretariat =  new Sekretariat;

        // Simpan foto ke dalam folder public/images/tim
        $imageName = time() . '_' . $request->file('foto')->getClientOriginalName();
        $request->file('foto')->move(public_path('images/sekretariat'), $imageName);

        $user = new User();
        $user->name         = $request->nama_sekretariat;
        $user->email        = $request->email;
        $user->role_id      = 5;
        $user->foto         = 'images/sekretariat/'. $imageName;
        $user->password     = bcrypt('password');
        $user->save();
        $user->assignRole(5);


        $sekretariat->user_id          = $user->id;
        $sekretariat->univ_id          = Auth::user()->id;
        $sekretariat->nama_sekretariat = $request->nama_sekretariat;
        $sekretariat->nip              = $request->nip;
        $sekretariat->jabatan_id       = $request->jabatan_id;
        $sekretariat->email            = $request->email;
        $sekretariat->no_telepon       = $request->no_telepon;
        $sekretariat->foto             = 'images/sekretariat/'. $imageName;
        $sekretariat->save();

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
            'nama_sekretariat'    => 'required|string|max:255',
            'nip'                 => 'required|string|max:255',
            'jabatan_id'          => 'required|string|max:255',
            'email'               => 'required|string|max:255|unique:sekretariats,email,' . $id,
            'no_telepon'          => 'required|string|max:255',
            'foto'                => 'image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);

        $sekretariat = Sekretariat::findOrFail($id);
        if ($request->hasFile('foto')) {
            // Hapus foto sebelumnya jika ada
            if ($sekretariat->foto && file_exists(public_path($sekretariat->foto))) {
                unlink(public_path($sekretariat->foto));
            }

            $file = $request->file('foto');
            $imageName = strtoupper(Str::random(5)) . '-' . rand() . '-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/sekretariat'), $imageName);
        }
        $sekretariat->update([
            'nama_sekretariat'    => $request->nama_sekretariat,
            'nip'                 => $request->nip,
            'jabatan_id'          => $request->jabatan_id,
            'email'               => $request->email,
            'no_telepon'          => $request->no_telepon,
            'foto'                => isset($imageName) ? 'images/sekretariat/' . $imageName : $sekretariat->foto,
        ]);
        $user = User::findOrFail($sekretariat->user_id);
        $user->update([
            'name'         => $request->nama_sekretariat,
            'email'        => $request->email,
            'foto'         => isset($imageName) ? 'images/sekretariat/' . $imageName : $sekretariat->foto,
        ]);
        return back()->with('success', 'update');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $sekretariat = Sekretariat::findOrFail($id);
        $user = User::findOrFail($sekretariat->user_id);
        $user->delete();

        // Menghapus file terkait jika ada
        if (!empty($sekretariat->foto)) {
            if (file_exists(public_path($sekretariat->foto))) {
                unlink(public_path($sekretariat->foto));
            }
        }

        if ($sekretariat->delete()) {
            return redirect()->route('sekretariat.index')->with('success', 'destroy');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus data sekretariat.');
        }
    }
}
