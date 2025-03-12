<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Sidang;
use App\Models\Seminar;
use App\Models\Tulisan;
use App\Models\Asistensi;
use App\Models\Mahasiswa;
use App\Models\Penilaian;
use App\Models\Perbaikan;
use App\Models\Presentasi;
use App\Models\Persyaratan;
use Illuminate\Http\Request;
use App\Models\SidangPenguji;
use App\Models\KartuBimbingan;
use App\Models\KualitasProduk;
use App\Models\SeminarPenguji;
use App\Models\PenguasaanMateri;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PenilaianController extends Controller
{
    public function penilaian()
    {
        return view('pages.penilaian.index');
    }
    public function hasilpenilaianindex()
    {
        return view('pages.penilaian.menupenilaian');
    }

    public function sidang() {
        $tulisan = Tulisan::all();
        $presentasi = Presentasi::all();
        $penguasaan = PenguasaanMateri::all();
        $kualitas = KualitasProduk::all();
        $mahasiswa = Mahasiswa::all();
        $dosen = Dosen::all();

        $penilaian = Penilaian::orderBy('grup', 'DESC')->get();
        return view('pages.penilaian.sidang', compact('mahasiswa', 'tulisan', 'presentasi', 'penguasaan', 'kualitas', 'penilaian', 'dosen'));
    }
    public function seminar() {
        $tulisan = Tulisan::all();
        $presentasi = Presentasi::all();
        $penguasaan = PenguasaanMateri::all();
        $kualitas = KualitasProduk::all();
        $perbaikan = Perbaikan::all();
        $asistensi = Asistensi::all();
        $persyaratan = Persyaratan::all();
        $kartu = KartuBimbingan::first();
        $mahasiswa = Mahasiswa::all();
        $dosen = Dosen::all();

        $penilaian = Penilaian::orderBy('grup', 'DESC')->get();

        return view('pages.penilaian.seminar', compact('mahasiswa', 'perbaikan','persyaratan','tulisan','presentasi','penguasaan','kualitas','asistensi','kartu', 'penilaian', 'dosen'));
    }

    public function penilaianSidang(Request $request)
{
    DB::beginTransaction();
    try {
        // Simpan nilai penilaian sidang
        foreach ($request->penilaian_id as $id) {
            Sidang::updateOrCreate(
                [
                    'mahasiswa_id' => $request->mahasiswa_id,
                    'penilaian_id' => $id
                ],
                ['nilai' => $request->nilai[$id]]
            );
        }

        // Hapus semua dosen penguji terkait mahasiswa ini
        SidangPenguji::whereHas('sidang', function ($query) use ($request) {
            $query->where('mahasiswa_id', $request->mahasiswa_id);
        })->delete();

        // Ambil semua sidang yang baru saja disimpan
        $sidang = Sidang::where('mahasiswa_id', $request->mahasiswa_id)->first();

        // Pastikan sidang tidak null sebelum menyimpan dosen penguji
        if ($sidang) {
            foreach ($request->dosen_id as $dosen_id) {
                SidangPenguji::create([
                    'sidang_id' => $sidang->id,
                    'dosen_id' => $dosen_id
                ]);
            }
        }

        DB::commit();
        return redirect()->back()->with('success', 'Data sidang berhasil disimpan.');
    } catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}

    public function penilaianSeminar(Request $request)
    {
        // Validasi input
        $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswas,id',
            'dosen_id' => 'required|array',
            'dosen_id.*' => 'exists:dosens,id',
            'penilaian_id' => 'required|array',
            'penilaian_id.*.id' => 'exists:penilaians,id',
            'nilai' => 'required|array',
            'nilai.*.nilai' => 'integer|min:0|max:5'
        ]);

        // Simpan nilai penilaian sidang
        foreach ($request->penilaian_id as $id => $penilaian) {
            Seminar::updateOrCreate(
                [
                    'mahasiswa_id' => $request->mahasiswa_id,
                    'penilaian_id' => $penilaian['id']
                ],
                ['nilai' => $request->nilai[$id]['nilai']]
            );
        }

        // Simpan dosen penguji (hapus dulu yang lama, lalu tambahkan baru)
        SeminarPenguji::whereHas('seminar', function ($query) use ($request) {
            $query->where('mahasiswa_id', $request->mahasiswa_id);
        })->delete();

        foreach ($request->dosen_id as $dosen_id) {
            SeminarPenguji::create([
                'seminar_id' => Seminar::where('mahasiswa_id', $request->mahasiswa_id)->first()->id,
                'dosen_id' => $dosen_id
            ]);
        }

        return redirect()->back()->with('success', 'store');
    }

    public function daftarPenilaian()
    {
        $sidangs = Sidang::select(
            'mahasiswa_id',
            \DB::raw('SUM(nilai) as total_nilai'),
            \DB::raw('AVG(nilai) as rata_nilai'),
            \DB::raw('MAX(created_at) as latest_created_at') // Ambil waktu terbaru
        )
        ->groupBy('mahasiswa_id')
        ->with('mahasiswa')
        ->orderByDesc('latest_created_at') // Urutkan berdasarkan waktu terbaru
        ->get();

        return view('pages.penilaian.sidang.index', compact('sidangs'));
    }




    public function hasilPenilaian($id)
    {
        $sidangs = Sidang::with(['mahasiswa', 'pengujis.dosen', 'penilaian'])
                        ->where('mahasiswa_id', $id)
                        ->get();

        if ($sidangs->isEmpty()) {
            return redirect()->back()->with('error', 'Data sidang tidak ditemukan.');
        }
        // dd($sidangs);

        // Ambil mahasiswa dan penguji
        $mahasiswa = $sidangs->first()->mahasiswa;
        $pengujis = $sidangs->first()->pengujis;

        // Mengambil semua penilaian dengan grup "Tulisan"
        $tulisan = Penilaian::whereIn('id', $sidangs->pluck('penilaian_id'))
        ->where('grup', 'Tulisan')
        ->with('sidangs') // Load relasi sidang untuk mengambil nilai
        ->get();
        $presentasi = Penilaian::whereIn('id', $sidangs->pluck('penilaian_id'))
        ->where('grup', 'Presentasi')
        ->with('sidangs') // Load relasi sidang untuk mengambil nilai
        ->get();
        $penguasaan = Penilaian::whereIn('id', $sidangs->pluck('penilaian_id'))
        ->where('grup', 'Penguasaan')
        ->with('sidangs') // Load relasi sidang untuk mengambil nilai
        ->get();
        $kualitas = Penilaian::whereIn('id', $sidangs->pluck('penilaian_id'))
        ->where('grup', 'Kualitas')
        ->with('sidangs') // Load relasi sidang untuk mengambil nilai
        ->get();

        $totalNilai = $sidangs->sum('nilai');
        $rataRata = $sidangs->count() > 0 ? $totalNilai / $sidangs->count() : 0;

        // dd($tulisan);

        return view('pages.penilaian.sidang.hasil', compact(
            'mahasiswa', 'pengujis', 'sidangs', 'tulisan', 'presentasi', 'penguasaan', 'kualitas', 'totalNilai', 'rataRata'
        ));
    }
    public function daftarSeminar()
    {
        $seminars = Seminar::select(
            'mahasiswa_id',
            \DB::raw('SUM(nilai) as total_nilai'),
            \DB::raw('AVG(nilai) as rata_nilai'),
            \DB::raw('MAX(created_at) as latest_created_at') // Ambil waktu terbaru
        )
        ->groupBy('mahasiswa_id')
        ->with('mahasiswa')
        ->orderByDesc('latest_created_at') // Urutkan berdasarkan waktu terbaru
        ->get();

        return view('pages.penilaian.seminar.index', compact('seminars'));
    }




    public function hasilSeminar($id)
    {
        $seminars = Seminar::with(['mahasiswa', 'pengujis.dosen', 'penilaian'])
                        ->where('mahasiswa_id', $id)
                        ->get();

        if ($seminars->isEmpty()) {
            return redirect()->back()->with('error', 'Data sidang tidak ditemukan.');
        }
        // dd($seminars);

        // Ambil mahasiswa dan penguji
        $mahasiswa = $seminars->first()->mahasiswa;
        $pengujis = $seminars->first()->pengujis;

        // Mengambil semua penilaian dengan grup "Tulisan"
        $tulisan = Penilaian::whereIn('id', $seminars->pluck('penilaian_id'))
        ->where('grup', 'Tulisan')
        ->with('seminars') // Load relasi sidang untuk mengambil nilai
        ->get();
        $presentasi = Penilaian::whereIn('id', $seminars->pluck('penilaian_id'))
        ->where('grup', 'Presentasi')
        ->with('seminars') // Load relasi sidang untuk mengambil nilai
        ->get();
        $penguasaan = Penilaian::whereIn('id', $seminars->pluck('penilaian_id'))
        ->where('grup', 'Penguasaan')
        ->with('seminars') // Load relasi sidang untuk mengambil nilai
        ->get();
        $kualitas = Penilaian::whereIn('id', $seminars->pluck('penilaian_id'))
        ->where('grup', 'Kualitas')
        ->with('seminars') // Load relasi sidang untuk mengambil nilai
        ->get();

        $totalNilai = $seminars->sum('nilai');
        $rataRata = $seminars->count() > 0 ? $totalNilai / $seminars->count() : 0;

        // dd($tulisan);

        return view('pages.penilaian.sidang.hasil', compact(
            'mahasiswa', 'pengujis', 'seminars', 'tulisan', 'presentasi', 'penguasaan', 'kualitas', 'totalNilai', 'rataRata'
        ));
    }



}
