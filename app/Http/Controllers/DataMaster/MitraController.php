<?php

namespace App\Http\Controllers\DataMaster;

use App\Models\User;
use App\Models\Mitra;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MitraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mitra = Mitra::all();
        return view('pages.datamaster.data-mitra.index', compact('mitra'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.datamaster.data-mitra.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_mitra'        => 'required|string|max:255',
            'bidang_usaha'      => 'required|string|max:255',
            'alamat_mitra'      => 'required|string|max:255',
            'email_mitra'       => 'required|string|email|max:255|unique:users,email',
            'no_telepon_mitra'  => 'required|string|max:255',
            'website'           => 'nullable|string|max:255',
            'penanggung_jawab'  => 'required|string|max:255',
            'jabatan_pj'        => 'required|string|max:255',
            'email_pj'          => 'required|string|email|max:255',
            'no_telepon_pj'     => 'required|string|max:255',
            'deskripsi'         => 'required|string|max:1000',
            'logo'              => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = User::where('email', $request->email_mitra)->first();
        if ($user) {
            return redirect()->back()->with('error', 'Email sudah terdaftar. Gunakan email lain.');
        }

        $imageName = time() . '_' . $request->file('logo')->getClientOriginalName();
        $request->file('logo')->move(public_path('images/mitra'), $imageName);

        $user = User::create([
            'name'     => $request->nama_mitra,
            'email'    => $request->email_mitra,
            'role_id'  => 4,
            'foto'     => 'images/mitra/' . $imageName,
            'password' => Hash::make('password'),
        ]);

        Mitra::create([
            'user_id'            => $user->id,
            'nama_mitra'         => $request->nama_mitra,
            'bidang_usaha'       => $request->bidang_usaha,
            'alamat_mitra'       => $request->alamat_mitra,
            'email_mitra'        => $request->email_mitra,
            'no_telepon_mitra'   => $request->no_telepon_mitra,
            'website'            => $request->website,
            'penanggung_jawab'   => $request->penanggung_jawab,
            'jabatan_pj'         => $request->jabatan_pj,
            'email_pj'           => $request->email_pj,
            'no_telepon_pj'      => $request->no_telepon_pj,
            'deskripsi'          => $request->deskripsi,
            'slug'               => Str::slug($request->nama_mitra, '-'),
            'logo'               => 'images/mitra/' . $imageName,
        ]);

        return redirect()->route('mitra.index')->with('success', 'store');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $mitra = Mitra::findOrFail($id);
        return view('pages.datamaster.data-mitra.show', compact('mitra'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $mitra = Mitra::findOrFail($id);
        return view('pages.datamaster.data-mitra.edit', compact('mitra'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_mitra'        => 'required|string|max:255',
            'bidang_usaha'      => 'required|string|max:255',
            'alamat_mitra'      => 'required|string|max:255',
            'email_mitra'       => 'required|string|email|max:255|unique:mitras,email_mitra,' . $id,
            'no_telepon_mitra'  => 'required|string|max:255',
            'website'           => 'nullable|string|max:255',
            'penanggung_jawab'  => 'required|string|max:255',
            'jabatan_pj'        => 'required|string|max:255',
            'email_pj'          => 'required|string|email|max:255',
            'no_telepon_pj'     => 'required|string|max:255',
            'deskripsi'         => 'required|string|max:255',
            'logo'              => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $mitra = Mitra::findOrFail($id);
        $imageName = $mitra->logo; // Default pakai logo lama

        if ($request->hasFile('logo')) {
            // Hapus logo lama jika ada
            if ($mitra->logo && file_exists(public_path($mitra->logo))) {
                unlink(public_path($mitra->logo));
            }

            $file = $request->file('logo');
            $imageName = 'images/mitra/' . strtoupper(Str::random(5)) . '-' . rand() . '-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/mitra'), $imageName);
        }

        $mitra->update([
            'nama_mitra'        => $request->nama_mitra,
            'bidang_usaha'      => $request->bidang_usaha,
            'alamat_mitra'      => $request->alamat_mitra,
            'email_mitra'       => $request->email_mitra,
            'no_telepon_mitra'  => $request->no_telepon_mitra,
            'website'           => $request->website ?? '',
            'penanggung_jawab'  => $request->penanggung_jawab,
            'jabatan_pj'        => $request->jabatan_pj,
            'email_pj'          => $request->email_pj,
            'no_telepon_pj'     => $request->no_telepon_pj,
            'deskripsi'         => $request->deskripsi,
            'slug'              => Str::slug($request->nama_mitra, '-'),
            'logo'              => $imageName,
        ]);

        $user = User::findOrFail($mitra->user_id);
        $user->update([
            'name' => $request->nama_mitra,
            'email' => $request->email_mitra,
            'foto' => $imageName,
        ]);

        return redirect()->route('mitra.index')->with('success', 'update');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $mitra = Mitra::findOrFail($id);
        $user = User::findOrFail($mitra->user_id);
        $user->delete();

        // Menghapus file terkait jika ada
        if (!empty($mitra->logo)) {
            if (file_exists(public_path($mitra->logo))) {
                unlink(public_path($mitra->logo));
            }
        }

        if ($mitra->delete()) {
            return redirect()->route('mitra.index')->with('success', 'destroy');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus data mitra.');
        }
    }
}
