<?php

namespace App\Http\Controllers\DataMaster;

use App\Models\User;
use App\Models\Kaprodi;
use Illuminate\Http\Request;
use App\Models\PerguruanTinggi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class KaprodiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kaprodi = Kaprodi::orderBy('created_at', 'DESC')->get();
        $pts = PerguruanTinggi::orderBy('created_at', 'DESC')->get();
        return view('pages.datamaster.data-kaprodi.index', compact('kaprodi', 'pts'));
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
        // Validasi data
        $request->validate([
            'role_id'        => 'required|integer',
            'name'           => 'required|string|max:255',
            'jenis_kelamin'  => 'required|in:Laki-Laki,Perempuan',
            'nip_kaprodi'    => 'required|string|max:50|unique:kaprodis,nip_kaprodi',
            'email'          => [
                    'required',
                    'email',
                    'max:255',
                    'unique:users,email',
                    // 'regex:/^[a-zA-Z0-9._%+-]+@(example\.com|anotherdomain\.com|[a-zA-Z0-9.-]+\.co\.id)$/',
                ],
            'no_telepon'     => 'required|string|max:15',
            'pts_id'         => 'nullable|exists:perguruan_tinggis,id',
        ]);

        // Simpan data user
        $user = User::create([
            'role_id'   => $request->role_id,
            'pts_id'    => $request->pts_id,
            'foto'      => 'assets/images/Profiledefault.png',
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make('password1234'),
        ]);
        $user->assignRole($request->role_id);

        // Simpan data Kaprodi
        Kaprodi::create([
            'user_id'       => $user->id,
            'name'          => $request->name,
            'email'         => $request->email,
            'nip_kaprodi'   => $request->nip_kaprodi,
            'no_telepon'    => $request->no_telepon,
            'jenis_kelamin' => $request->jenis_kelamin,
            'foto'          => 'assets/images/Profiledefault.png',
        ]);

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
        // Cari data Kaprodi berdasarkan ID
        $kaprodi = Kaprodi::findOrFail($id);

        // Update data user terkait
        $user = User::findOrFail($kaprodi->user_id);
        // Validasi data
        $request->validate([
            'name'           => 'required|string|max:255',
            'jenis_kelamin'  => 'required|in:Laki-Laki,Perempuan',
            'nip_kaprodi'    => "required|string|max:50|unique:kaprodis,nip_kaprodi,{$id}",
            'email'          => [
                'required',
                'email',
                'max:255',
                "unique:users,email,{$user->id}",
                // 'regex:/^[a-zA-Z0-9._%+-]+@(example\.com|anotherdomain\.com|[a-zA-Z0-9.-]+\.co\.id)$/',
            ],
            'no_telepon'     => 'required|string|max:15',
            'pts_id'         => 'nullable|exists:perguruan_tinggis,id',
        ]);

        $user->update([
            'pts_id'    => $request->pts_id,
            'name'      => $request->name,
            'email'     => $request->email,
        ]);

        // Update data Kaprodi
        $kaprodi->update([
            'name'          => $request->name,
            'email'         => $request->email,
            'nip_kaprodi'   => $request->nip_kaprodi,
            'no_telepon'    => $request->no_telepon,
            'jenis_kelamin' => $request->jenis_kelamin,
        ]);

        return back()->with('success', 'update');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kaprodi = Kaprodi::findOrFail($id);

        if (Kaprodi::destroy($id)) {
            return redirect()->route('kaprodi.index')->with('success', 'destroy');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus data kaprodi.');
        }
    }
}
