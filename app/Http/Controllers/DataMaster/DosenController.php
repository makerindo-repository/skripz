<?php

namespace App\Http\Controllers\DataMaster;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Jabatan;
use App\Models\Keilmuan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\BidangKeahlian;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dosen          = Dosen::orderBy('created_at', 'DESC')->get();
        $jabatan        = Jabatan::orderBy('created_at', 'DESC')->get();
        $bidkeahlian    = BidangKeahlian::orderBy('created_at', 'DESC')->get();
        $keilmuan       = Keilmuan::orderBy('created_at', 'DESC')->get();
        return view('pages.datamaster.data-dosen.index', compact('dosen', 'jabatan', 'bidkeahlian','keilmuan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jabatan        = Jabatan::orderBy('created_at', 'DESC')->get();
        $bidkeahlian    = BidangKeahlian::orderBy('created_at', 'DESC')->get();
        $keilmuan       = Keilmuan::orderBy('created_at', 'DESC')->get();
        return view('pages.datamaster.data-dosen.create', compact('jabatan', 'bidkeahlian','keilmuan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jabatan_id'        => 'required',
            'keilmuan_id'       => 'required',
            'nip_dosen'         => 'required|string|max:255',
            'nama_dosen'        => 'required|string|max:255',
            'tempat_lahir'      => 'required|string|max:255',
            'tanggal_lahir'     => 'required',
            'jenis_kelamin'     => 'required',
            'alamat'            => 'required|string|max:255',
            'email'             => 'required|string|max:255|unique:dosens,email',
            'no_telepon'        => 'required|string|max:255',
            'bidang_keahlian'   => 'required',
            'foto'              => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status_dosen'      => 'required|string|max:255',
            'paraf'             => 'required',

        ]);
        $dosen          = new Dosen;
        if ($request->hasFile('paraf')) {
            $signatureName = time() . '_' . $request->file('paraf')->getClientOriginalName();
            $request->file('paraf')->move(public_path('images/dosen/signatures/'), $signatureName);
        } else {
            $folderPath     = public_path('images/dosen/signatures/');
            $image_parts    = explode(";base64,", $request->paraf);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type     = $image_type_aux[1];
            $image_base64   = base64_decode($image_parts[1]);
            $signatureName  = time() . '_' . uniqid() . '.' . $image_type;
            $file           = $folderPath . $signatureName;
            file_put_contents($file, $image_base64);
        }

        // Simpan foto ke dalam folder public/images/tim
        $imageName = time() . '_' . $request->file('foto')->getClientOriginalName();
        $request->file('foto')->move(public_path('images/dosen'), $imageName);

        $user = new User();
        $user->name         = $request->nama_dosen;
        $user->email        = $request->email;
        $user->role_id      = 3;
        $user->password     = bcrypt('password');
        $user->foto         = 'images/dosen/'. $imageName;
        $user->save();

        $user->assignRole(3);

        $dosen->user_id             = $user->id;
        $dosen->univ_id             = Auth::user()->id;
        $dosen->jabatan_id          = $request->jabatan_id;
        $dosen->keilmuan_id         = $request->keilmuan_id;
        $dosen->kelompok_keilmuan   = $request->kelompok_keilmuan;
        $dosen->nip_dosen           = $request->nip_dosen;
        $dosen->nama_dosen          = $request->nama_dosen;
        $dosen->tempat_lahir        = $request->tempat_lahir;
        $dosen->tanggal_lahir       = $request->tanggal_lahir;
        $dosen->jenis_kelamin       = $request->jenis_kelamin;
        $dosen->alamat              = $request->alamat;
        $dosen->email               = $request->email;
        $dosen->no_telepon          = $request->no_telepon;
        $dosen->bidang_keahlian     = json_encode($request->bidang_keahlian);
        $dosen->foto                = 'images/dosen/'. $imageName;
        $dosen->status_dosen        = $request->status_dosen;
        $dosen->akun_link           = $request->akun_link;
        $dosen->slug                = Str::slug($request->nama_dosen, '-');
        $dosen->paraf               = 'images/dosen/signatures/'.$signatureName;
        $dosen->save();

        return redirect()->route('dosen.index')->with('success', 'store');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $dosen          = Dosen::findBySlug($slug);
        $jabatan        = Jabatan::orderBy('created_at', 'DESC')->get();
        $bidkeahlian    = BidangKeahlian::orderBy('created_at', 'DESC')->get();
        $keilmuan       = Keilmuan::orderBy('created_at', 'DESC')->get();
        return view('pages.datamaster.data-dosen.show',compact('dosen', 'jabatan', 'bidkeahlian','keilmuan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $dosen          = Dosen::findBySlug($slug);
        $jabatan        = Jabatan::orderBy('created_at', 'DESC')->get();
        $bidkeahlian    = BidangKeahlian::orderBy('created_at', 'DESC')->get();
        $keilmuan       = Keilmuan::orderBy('created_at', 'DESC')->get();
        return view('pages.datamaster.data-dosen.edit',compact('dosen', 'jabatan', 'bidkeahlian','keilmuan'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'jabatan_id'        => 'required',
            'keilmuan_id'       => 'required',
            'nip_dosen'         => 'required|string|max:255',
            'nama_dosen'        => 'required|string|max:255',
            'tempat_lahir'      => 'required|string|max:255',
            'tanggal_lahir'     => 'required',
            'jenis_kelamin'     => 'required',
            'alamat'            => 'required|string|max:255',
            'email'             => 'required|string|max:255|unique:dosens,email,' . $id,
            'no_telepon'        => 'required|string|max:255',
            'bidang_keahlian'   => 'required',
            'status_dosen'      => 'required|string|max:255',
            'foto'              => 'image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);

        $dosen = Dosen::findOrFail($id);

        if ($request->hasFile('foto')) {
            // Hapus foto sebelumnya jika ada
            if ($dosen->foto && file_exists(public_path($dosen->foto))) {
                unlink(public_path($dosen->foto));
            }

            $file = $request->file('foto');
            $imageName = strtoupper(Str::random(5)) . '-' . rand() . '-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/dosen'), $imageName);
        }
        if ($request->paraf) {
            // Hapus tanda tangan sebelumnya jika ada
            if ($dosen->paraf && file_exists(public_path($dosen->paraf))) {
                unlink(public_path($dosen->paraf));
            }

            if ($request->hasFile('paraf')) {
                $signatureName = time() . '_' . $request->file('paraf')->getClientOriginalName();
                $request->file('paraf')->move(public_path('images/dosen/signatures/'), $signatureName);
            } else {
                $folderPath     = public_path('images/dosen/signatures/');
                $image_parts    = explode(";base64,", $request->paraf);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type     = $image_type_aux[1];
                $image_base64   = base64_decode($image_parts[1]);
                $signatureName  = time() . '_' . uniqid() . '.' . $image_type;
                $file           = $folderPath . $signatureName;
                file_put_contents($file, $image_base64);
            }
        }


        $dosen->update([
            'jabatan_id'        => $request->jabatan_id,
            'keilmuan_id'       => $request->keilmuan_id,
            'nip_dosen'         => $request->nip_dosen,
            'nama_dosen'        => $request->nama_dosen,
            'tempat_lahir'      => $request->tempat_lahir,
            'tanggal_lahir'     => $request->tanggal_lahir,
            'jenis_kelamin'     => $request->jenis_kelamin,
            'alamat'            => $request->alamat,
            'email'             => $request->email,
            'no_telepon'        => $request->no_telepon,
            'bidang_keahlian'   => json_encode($request->bidang_keahlian),
            'foto'              => isset($imageName) ? 'images/dosen/' . $imageName : $dosen->foto,
            'paraf'             => isset($signatureName) ? 'images/dosen/signatures/'.$signatureName : $dosen->paraf,
            'status_dosen'      => $request->status_dosen,
            'akun_link'         => $request->akun_link,
            'slug'              => Str::slug($request->nama_dosen, '-'),
        ]);

        $user = User::findOrFail($dosen->user_id);
        $user->update([
            'name'         => $request->nama_dosen,
            'email'        => $request->email,
            'foto'         => isset($imageName) ? 'images/dosen/' . $imageName : $dosen->foto,
        ]);

        return redirect()->route('dosen.index')->with('success', 'update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Temukan dosen berdasarkan ID
        $dosen = Dosen::findOrFail($id);

        // Hapus user terkait dosen
        $user = User::findOrFail($dosen->user_id);
        $user->delete();

        // Hapus dosen dari database
        if ($dosen->delete()) {
            // Hapus file foto dosen jika ada
            if (!empty($dosen->foto) && file_exists(public_path($dosen->foto))) {
                unlink(public_path($dosen->foto));
            }

            // Hapus file paraf dosen jika ada
            if (!empty($dosen->paraf) && file_exists(public_path($dosen->paraf))) {
                unlink(public_path($dosen->paraf));
            }

            return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil dihapus.');
        } else {
            return redirect()->route('dosen.index')->with('fail', 'Gagal menghapus data dosen.');
        }
    }


}
