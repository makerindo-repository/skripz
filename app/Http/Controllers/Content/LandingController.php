<?php

namespace App\Http\Controllers\Content;

use App\Models\Klien;
use App\Models\Paket;
use App\Models\Unduh;
use App\Models\Kontak;
use App\Models\Beranda;
use App\Models\Layanan;
use App\Models\Tentang;
use App\Models\Ekosistem;
use App\Models\ListLayanan;
use Illuminate\Http\Request;
use App\Models\ListEkosistem;
use App\Models\MitraPengguna;
use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;

class LandingController extends Controller
{
    public function index()
    {
        // SEOTools::setTitle('Home');
        SEOTools::setDescription('SkripZ adalah platform terintegrasi dengan fitur pemantauan real-time, komunikasi langsung, dan penyimpanan dokumen yang aman. Kelola skripsi dengan mudah dan transparan melalui SkripZ!');
        SEOTools::opengraph()->setUrl('https://skripz.web.id/');
        SEOTools::opengraph()->addProperty('type', 'pendidikan');
        SEOTools::opengraph()->addImage('https://skripz.web.id/assets/images/skripzz.png', [
            'type' => 'image/jpeg',
            'width' => '200',
            'height' => '200',
        ]);
        SEOTools::jsonLd()->addImage('https://skripz.web.id/assets/images/skripzz.png');
        SEOMeta::addKeyword([
            'skripsi', 
            'universitas', 
            'skrip', 
            'skripz', 
            'buat skripsi', 
            'bimbingan', 
            'bimbingan skripsi', 
            'tugas akhir', 
            'jurnal', 
            'penelitian', 
            'penulisan ilmiah', 
            'tips skripsi', 
            'contoh skripsi', 
            'jurnal ilmiah',
            'referensi skripsi',
            'proposal skripsi',
            'fokus skripsi',
            'revisi skripsi',
            'aplikasi penunjang skripsi',
            'aplikasi skripsi',
        ]);

        $beranda = Beranda::first();
        $tentang = Tentang::first();
        $unduh   = Unduh::first();
        $layanan = Layanan::first();
        $ekosistem = Ekosistem::first();
        $listlayanan = ListLayanan::all();
        $listekosistem = ListEkosistem::orderBy('created_at', 'DESC')->get();
        $mitra   = MitraPengguna::orderBy('created_at', 'DESC')->get();
        $klien   = Klien::orderBy('created_at', 'DESC')->get();
        $paket_akademisi   = Paket::where('kategori', 'Akademisi')->get();
        $paket_industri    = Paket::where('kategori', 'Industri')->get();

        return view('frontend.main', compact('beranda', 'tentang', 'mitra', 'klien', 'unduh', 'layanan', 'listlayanan', 'ekosistem', 'listekosistem', 'paket_akademisi', 'paket_industri'));
    }

    public function kontak(Request $request)
    {

        $validated = $request->validate([
            'nama_pengirim'   => 'required|string|max:255',
            'email_pengirim'  => 'required|string|max:255',
            'pesan_pengirim'  => 'required|string',
            'captcha'         => 'required|captcha',
        ], [
            'captcha.captcha'  => 'Verifikasi CAPTCHA gagal, silakan coba lagi.',
        ]);

        $kontak = Kontak::create([
            'nama_pengirim'   => $request->nama_pengirim,
            'email_pengirim'  => $request->email_pengirim,
            'pesan_pengirim'  => $request->pesan_pengirim,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pesan Berhasil Dikirim',
        ]);
    }
}
