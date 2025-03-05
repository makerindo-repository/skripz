<?php

namespace App\Http\Controllers\DataMaster;

use App\Models\User;
use App\Models\Jurusan;
use App\Models\Mahasiswa;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswa = Mahasiswa::orderBy('created_at', 'DESC')->get();
        $jurusan   = Jurusan::orderBy('created_at', 'DESC')->get();
        return view('pages.datamaster.data-mahasiswa.index', compact('mahasiswa', 'jurusan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jurusan   = Jurusan::orderBy('created_at', 'DESC')->get();
        return view('pages.datamaster.data-mahasiswa.create', compact('jurusan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'                => 'required|string|max:255',
            'email'               => 'required|string|email|max:255|unique:mahasiswas,email',
            'tempat_lahir'        => 'required|string|max:255',
            'tanggal_lahir'       => 'required|date',
            'tanggal_masuk'       => 'required|date',
            'jenis_kelamin'       => 'required|string|in:Laki-Laki,Perempuan',
            'alamat'              => 'required|string|max:255',
            'nim'                 => 'required|string|max:255',
            'jurusan_id'          => 'required',
            'jenjang_pendidikan'  => 'required|string|max:255',
            'no_telepon'          => 'required|string|max:255',
            'foto'                => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);
        // Simpan foto ke dalam folder public/images/tim
        $imageName = time() . '_' . $request->file('foto')->getClientOriginalName();
        $request->file('foto')->move(public_path('images/mahasiswa'), $imageName);

        $user = User::create([
            'role_id'             => 4,
            'foto'                => 'images/mahasiswa/'. $imageName,
            'name'                => $request->name,
            'email'               => $request->email,
            'password'            => Hash::make('password'),
        ]);

        $user->assignRole(4);

        Mahasiswa::create([
            'user_id'             => $user->id,
            'univ_id'             => Auth::user()->id,
            'foto'                => 'images/mahasiswa/'. $imageName,
            'name'                => $request->name,
            'email'               => $request->email,
            'tempat_lahir'        => $request->tempat_lahir,
            'tanggal_lahir'       => $request->tanggal_lahir,
            'tanggal_masuk'       => $request->tanggal_masuk,
            'jenis_kelamin'       => $request->jenis_kelamin,
            'alamat'              => $request->alamat,
            'nim'                 => $request->nim,
            'jurusan_id'          => $request->jurusan_id,
            'jenjang_pendidikan'  => $request->jenjang_pendidikan,
            'no_telepon'          => $request->no_telepon,
            'slug'                => Str::slug($request->name, '-'),
        ]);
        return redirect()->route('mahasiswa.index')->with('success', 'store');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $mahasiswa = Mahasiswa::findBySlug($slug);
        $jurusan   = Jurusan::orderBy('created_at', 'DESC')->get();
        return view('pages.datamaster.data-mahasiswa.show', compact('mahasiswa', 'jurusan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $mahasiswa = Mahasiswa::findBySlug($slug);
        $jurusan   = Jurusan::orderBy('created_at', 'DESC')->get();
        return view('pages.datamaster.data-mahasiswa.edit', compact('mahasiswa', 'jurusan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'                => 'required|string|max:255',
            'email'               => 'required|string|email|max:255|unique:mahasiswas,email,' . $id,
            'tempat_lahir'        => 'required|string|max:255',
            'tanggal_lahir'       => 'required|date',
            'tanggal_masuk'       => 'required|date',
            'jenis_kelamin'       => 'required|string|in:Laki-Laki,Perempuan',
            'alamat'              => 'required|string|max:255',
            'nim'                 => 'required|string|max:255',
            'jurusan_id'          => 'required',
            'jenjang_pendidikan'  => 'required|string|max:255',
            'no_telepon'          => 'required|string|max:255',
            'foto'                => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $mahasiswa = Mahasiswa::findOrFail($id);
        if ($request->hasFile('foto')) {
            // Hapus foto sebelumnya jika ada
            if ($mahasiswa->foto && file_exists(public_path($mahasiswa->foto))) {
                unlink(public_path($mahasiswa->foto));
            }

            $file = $request->file('foto');
            $imageName = strtoupper(Str::random(5)) . '-' . rand() . '-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/mahasiswa'), $imageName);
        }
        $mahasiswa->update([
            'foto'                => isset($imageName) ? 'images/mahasiswa/' . $imageName : $mahasiswa->foto,
            'name'                => $request->name,
            'email'               => $request->email,
            'tempat_lahir'        => $request->tempat_lahir,
            'tanggal_lahir'       => $request->tanggal_lahir,
            'tanggal_masuk'       => $request->tanggal_masuk,
            'jenis_kelamin'       => $request->jenis_kelamin,
            'alamat'              => $request->alamat,
            'nim'                 => $request->nim,
            'jurusan_id'          => $request->jurusan_id,
            'jenjang_pendidikan'  => $request->jenjang_pendidikan,
            'no_telepon'          => $request->no_telepon,
            'slug'                => Str::slug($request->name, '-'),
        ]);
        $user = User::findOrFail($mahasiswa->user_id);
        $user->update([
            'foto'                => isset($imageName) ? 'images/mahasiswa/' . $imageName : $mahasiswa->foto,
            'name'                => $request->name,
            'email'               => $request->email,
        ]);
        return redirect()->route('mahasiswa.index')->with('success', 'update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $user = User::findOrFail($mahasiswa->user_id);
        $user->delete();

        if ($mahasiswa->delete()) {
            if (!empty($mahasiswa->foto) && file_exists(public_path($mahasiswa->foto))) {
                unlink(public_path($mahasiswa->foto));
            }
            return redirect()->route('mahasiswa.index')->with('success', 'destroy');
        } else {
            return redirect()->route('mahasiswa.index')->with('fail', 'destroy');
        }
    }
}
