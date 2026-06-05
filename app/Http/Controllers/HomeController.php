<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Task;
use App\Models\User;
use App\Models\Dosen;
use App\Models\Mitra;
use App\Models\Ruang;
use App\Models\Kontak;
use App\Models\Kaprodi;
use App\Models\Pelamar;
use App\Models\Mahasiswa;
use App\Models\Penjadwalan;
use App\Models\Sekretariat;
use Illuminate\Http\Request;
use App\Models\TahunAkademik;
use App\Models\DosenPembimbing;
use App\Models\KelompokKeilmuan;
use App\Models\PredikatKelulusan;
use App\Models\MahasiswaBimbingan;
use App\Http\Controllers\Controller;
use App\Models\ManajemenLangganan;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $dosen              = Dosen::all();
        $mitra              = Mitra::all();
        $sekretariat        = Sekretariat::all();
        $mahasiswa          = Mahasiswa::all();
        $kaprodi            = Kaprodi::all();
        $dospem             = DosenPembimbing::all();
        $kelilmuan          = KelompokKeilmuan::all();
        $predlulus          = PredikatKelulusan::all();
        $predlulusS1        = PredikatKelulusan::where('mahasiswa', 'S1')->get();
        $predlulusD3        = PredikatKelulusan::where('mahasiswa', 'D3')->get();
        $penjadwalan        = Penjadwalan::all();
        $ruang              = Ruang::all();
        $akun               = User::all();
        $kontak             = Kontak::all();
        $pelamar            = Pelamar::all();
        $pengumuman         = auth()->user()->notifications;
        $thakademik         = TahunAkademik::query()->select('tahun_akademik', 'semester')->get();
        $jumlahMahasiswaS1  = Mahasiswa::join('mahasiswa_bimbingans', 'mahasiswas.id', '=', 'mahasiswa_bimbingans.mahasiswa_id')
        ->where('jenjang_pendidikan', 'S1')
        ->count();
        $jumlahMahasiswaD3  = Mahasiswa::join('mahasiswa_bimbingans', 'mahasiswas.id', '=', 'mahasiswa_bimbingans.mahasiswa_id')
        ->where('jenjang_pendidikan', 'D3')
        ->count();
        $s1 = $predlulusS1->first();
        $d3 = $predlulusD3->first();
        $today = Carbon::today();
                $langganan          = ManajemenLangganan::all();

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

        $tasks = Task::all();
        return view('dashboard', compact('penjadwalan','ruang', 'dospem','kelilmuan', 'kaprodi', 'dosen', 'mitra', 'sekretariat', 'mahasiswa',
        'predlulus', 'thakademik','jumlahMahasiswaS1','jumlahMahasiswaD3', 's1', 'd3', 'penjadwalanHariIni' , 'penjadwalanBesok', 'penjadwalanMingguIni', 'tasks', 'akun', 'kontak', 'pelamar', 'pengumuman', 'langganan'));
    }
}
