<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return redirect('/');
});
Route::get('/', [App\Http\Controllers\Content\LandingController::class, 'index'])->name('frontend');
Route::post('/kirim-kontak', [App\Http\Controllers\Content\LandingController::class, 'kontak'])->name('kontak.store');
Route::get('/reload-captcha', [App\Http\Controllers\CaptchaController::class, 'reloadCaptcha']);



// Route untuk autentikasi
Auth::routes();

Route::middleware(['auth', 'role:Ketua Program Studi'])->group(function () {
    Route::get('/dashboard/kaprodi', [App\Http\Controllers\DashboardController::class, 'kaprodi'])->name('kaprodi.dashboard');
});
Route::middleware(['auth', 'role:Sekretariat'])->group(function () {
    Route::get('/dashboard/sekretariat', [App\Http\Controllers\DashboardController::class, 'sekretariat'])->name('sekretariat.dashboard');
});
Route::middleware(['auth', 'role:Dosen'])->group(function () {
    Route::get('/dashboard/dosen', [App\Http\Controllers\DashboardController::class, 'dosen'])->name('dosen.dashboard');
});
Route::middleware(['auth', 'role:Mahasiswa'])->group(function () {
    Route::get('/dashboard/mahasiswa', [App\Http\Controllers\DashboardController::class, 'mahasiswa'])->name('mahasiswa.dashboard');
});
Route::middleware(['auth', 'role:Industri'])->group(function () {
    Route::get('/dashboard/industri', [App\Http\Controllers\DashboardController::class, 'industri'])->name('industri.dashboard');
});
Route::middleware(['auth', 'role:SuperAdmin'])->group(function () {
    Route::get('/dashboard/superadmin', [App\Http\Controllers\DashboardController::class, 'superadmin'])->name('superadmin.dashboard');
});

// Route untuk homepage (redirect ke dashboard setelah login)
Route::get('/dashboard', function () {
    return redirect('/dashboard');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    Route::get('/langganan', [App\Http\Controllers\LanggananController::class, 'index'])->name('langganan.index');
    Route::get('/premium/pay', [App\Http\Controllers\LanggananController::class, 'payPremium'])->name('premium.pay');
    Route::post('/pembayaran', [App\Http\Controllers\Content\LanggananController::class, 'pembayaran'])->name('generate.snapToken');

    Route::get('/bayar-langganan/{slug}', [App\Http\Controllers\Content\LanggananController::class, 'store'])->name('langganan.store');

    Route::prefix('data-utama')->middleware('can:akses data-utama')->group(function () {
        Route::get('/', [App\Http\Controllers\MenuIndexController::class, 'datautama'])->name('datautama.index');
        Route::resource('provinsi', App\Http\Controllers\DataMaster\ProvinsiController::class)->except(['create', 'edit','show']);
        Route::resource('kabupaten', App\Http\Controllers\DataMaster\KabupatenController::class)->except(['create', 'edit','show']);
        Route::resource('kecamatan', App\Http\Controllers\DataMaster\KecamatanController::class)->except(['create', 'edit','show']);
        Route::resource('kelurahan', App\Http\Controllers\DataMaster\KelurahanController::class)->except(['create', 'edit','show']);
        Route::resource('perguruan-tinggi', App\Http\Controllers\DataMaster\PerguruanTinggiController::class)->except(['create', 'edit','show']);
        Route::resource('jabatan', App\Http\Controllers\DataMaster\JabatanController::class)->except(['create', 'edit','show']);
        Route::resource('jurusan', App\Http\Controllers\DataMaster\JurusanController::class)->except(['create', 'edit','show']);
        Route::resource('bidang-keahlian', App\Http\Controllers\DataMaster\BidangKeahlianController::class)->except(['create', 'edit','show']);
        Route::resource('sumber-referensi', App\Http\Controllers\DataMaster\SumberReferensiController::class)->except(['create', 'edit','show']);
        Route::resource('keilmuan', App\Http\Controllers\DataMaster\KeilmuanController::class)->except(['create', 'edit','show']);
    });
    Route::prefix('data-induk')->middleware('can:akses data-master')->group(function () {
        Route::get('/', [App\Http\Controllers\MenuIndexController::class, 'datamaster'])->name('datamaster.index');
        Route::resource('ruang', App\Http\Controllers\DataMaster\RuangController::class)->except(['create', 'edit','show']);
        Route::resource('dosen', App\Http\Controllers\DataMaster\DosenController::class);
        Route::resource('dosen-pembimbing', App\Http\Controllers\DataMaster\DosenPembimbingController::class)->except(['create', 'edit','show']);
        Route::resource('dosen-penguji', App\Http\Controllers\DataMaster\DosenPengujiController::class)->except(['create', 'edit','show']);
        Route::resource('mahasiswa', App\Http\Controllers\DataMaster\MahasiswaController::class);
        Route::resource('mahasiswa-bimbingan', App\Http\Controllers\DataMaster\MahasiswaBimbinganController::class)->except(['create', 'edit','show']);
        Route::resource('sekretariat', App\Http\Controllers\DataMaster\SekretariatController::class)->except(['create', 'edit','show']);
        Route::resource('bimbingan', App\Http\Controllers\DataMaster\JadwalBimbinganController::class)->except(['create', 'edit','show']);
        Route::resource('topik-skripsi', App\Http\Controllers\DataMaster\TopikSkripsiController::class)->except(['create', 'edit','show']);
        Route::put('update-status-topik',[ App\Http\Controllers\DataMaster\TopikSkripsiController::class, 'updateStatus'])->name('updateStatussk');
        Route::resource('kelompok-keilmuan', App\Http\Controllers\DataMaster\KelompokKeilmuanController::class)->except(['create', 'edit','show']);
        Route::resource('mitra', App\Http\Controllers\DataMaster\MitraController::class);
        Route::resource('tahun-akademik', App\Http\Controllers\DataMaster\TahunAkademikController::class)->except(['create', 'edit','show']);
        Route::resource('kaprodi', App\Http\Controllers\DataMaster\KaprodiController::class)->except(['create', 'edit','show']);
        Route::resource('predikat-kelulusan', App\Http\Controllers\DataMaster\PredikatKelulusanController::class)->except(['create', 'edit','show']);
    });

    Route::prefix('laporan')->middleware('can:akses laporan')->group(function () {
        Route::get('/', [App\Http\Controllers\MenuIndexController::class, 'laporan'])->name('laporan.index');
        Route::resource('laporan-usulan-proposal', App\Http\Controllers\Laporan\LaporanUsulanProposalController::class)->except(['create', 'edit','show']);
        Route::patch('update-status',[ App\Http\Controllers\Laporan\LaporanUsulanProposalController::class, 'updateStatus'])->name('updateStatusProposal.update');
        Route::resource('laporan-bimbingan', App\Http\Controllers\Laporan\LaporanBimbinganController::class)->except(['create', 'edit','show']);
        Route::resource('laporan-kemajuan-seminar', App\Http\Controllers\Laporan\LaporanSeminarController::class)->except(['create', 'edit','show']);
        Route::resource('laporan-kemajuan-sidang', App\Http\Controllers\Laporan\LaporanSidangController::class)->except(['create', 'edit','show']);
        Route::resource('laporan-yudisium', App\Http\Controllers\Laporan\LaporanYudisiumController::class)->except(['create', 'edit','show']);
    });

    Route::get('/export-berkas-pdf', [App\Http\Controllers\Export\BerkasController::class, 'berkasPdf'])->name('Berkas.pdf');
    // Repository
    Route::resource('repository-skripsi', App\Http\Controllers\RepositorySkripsiController::class)->middleware('can:akses repository-skripsi');
    // Penjadwalan
    Route::resource('jadwal', App\Http\Controllers\PenjadwalanController::class)->except(['create', 'edit','show'])->middleware('can:akses jadwal');
    //Progress Skripsi
    Route::resource('progres-bimbingan', App\Http\Controllers\ProgressController::class)->except(['create', 'edit'])->middleware('can:akses progress-bimbingan');
    Route::get('/owner', [App\Http\Controllers\MenuIndexController::class, 'owner'])->name('owner.index');

    // Managemen
    Route::prefix('management-akun')->group(function () {
        Route::get('/', [App\Http\Controllers\MenuIndexController::class, 'managemen'])->name('management.index');
        Route::resource('management-role', App\Http\Controllers\ManagemenRoleController::class);
        Route::resource('management-user', App\Http\Controllers\UserController::class);
        Route::post('/users/import/mahasiswa', [ App\Http\Controllers\UserController::class, 'importMahasiswa'])->name('users.importMahasiswa');
        Route::post('/users/import/dosen', [ App\Http\Controllers\UserController::class, 'importDosen'])->name('users.importDosen');
        Route::post('/users/import/sekretariat', [ App\Http\Controllers\UserController::class, 'importSekretariat'])->name('users.importSekretariat');

    });
    Route::post('tasks', [App\Http\Controllers\TaskController::class, 'store'])->name('tasks.store');
    Route::put('tasks/sync', [App\Http\Controllers\TaskController::class, 'sync'])->name('tasks.sync');
    Route::put('tasks/{id}',  [App\Http\Controllers\TaskController::class, 'update'])->name('tasks.update');
    Route::post('tasks/{id}',  [App\Http\Controllers\TaskController::class, 'destroy'])->name('tasks.destroy');

    Route::get('profile', [App\Http\Controllers\UserController::class, 'profile'])->name('profile');
    Route::get('ubah-kata-sandi', [App\Http\Controllers\UserController::class, 'indexPassword'])->name('updatePassword.index');
    Route::post('ubah-kata-sandi', [App\Http\Controllers\UserController::class, 'updatePassword'])->name('updatePassword.update');
    Route::patch('profile/update/{id}', [App\Http\Controllers\UserController::class, 'updateProfile'])->name('profile.update');
    Route::patch('profile/mahasiswa/update/{id}', [App\Http\Controllers\UserController::class, 'updateMahasiswa'])->name('profile-mahasiswa.update');
    Route::patch('profile/sekretariat/update/{id}', [App\Http\Controllers\UserController::class, 'updateSekretariat'])->name('profile-sekretariat.update');
    Route::patch('profile/dosen/update/{id}', [App\Http\Controllers\UserController::class, 'updateDosen'])->name('profile-dosen.update');
    Route::patch('profile/mitra/update/{id}', [App\Http\Controllers\UserController::class, 'updateMitra'])->name('profile-mitra.update');
    Route::get('pengaturan-berkas', [App\Http\Controllers\MenuIndexController::class, 'berkas'])->name('berkas.index');
    // Settings
    Route::get('/setting', [App\Http\Controllers\SettingController::class, 'index'])->name('setting')->middleware('can:akses pengaturan-aplikasi');
    Route::patch('/setting', [App\Http\Controllers\SettingController::class, 'update'])->name('setting.update')->middleware('can:akses pengaturan-aplikasi');

    // About Us
    Route::get('/tentang-kami', [App\Http\Controllers\AboutController::class, 'index'])->name('tentang-kami.index');
    Route::patch('/tentang-kami', [App\Http\Controllers\AboutController::class, 'update'])->name('tentang-kami.update');

    Route::prefix('penilaian')->group(function () {
        Route::get('/', [App\Http\Controllers\PenilaianController::class, 'penilaian'])->name('penilaian.index');
        Route::get('sidang', [App\Http\Controllers\PenilaianController::class, 'sidang'])->name('sidang.index');
        Route::get('seminar', [App\Http\Controllers\PenilaianController::class, 'seminar'])->name('seminar.index');
        Route::post('/sidang/store', [App\Http\Controllers\PenilaianController::class, 'penilaianSidang'])->name('sidang.store');
        Route::post('/seminar/store', [App\Http\Controllers\PenilaianController::class, 'penilaianSeminar'])->name('seminar.store');


    });
    Route::prefix('hasil-penilaian')->group(function () {
        Route::get('/', [App\Http\Controllers\PenilaianController::class, 'hasilpenilaianindex'])->name('hasil-penilaian.index');
        Route::get('/sidang', [App\Http\Controllers\PenilaianController::class, 'daftarPenilaian'])->name('sidang.daftar');
        Route::get('/seminar', [App\Http\Controllers\PenilaianController::class, 'daftarSeminar'])->name('seminar.daftar');
        Route::get('/sidang/detail/{id}', [App\Http\Controllers\PenilaianController::class, 'hasilPenilaian'])->name('sidang.hasil');
        Route::get('/seminar/detail/{id}', [App\Http\Controllers\PenilaianController::class, 'hasilSeminar'])->name('seminar.hasil');

    });
    // Tulisan Route
    Route::get('/tulisan', [App\Http\Controllers\Berkas\TulisanController::class, 'index'])->name('tulisan.index');
    Route::post('/tulisan/create', [App\Http\Controllers\Berkas\TulisanController::class, 'store'])->name('tulisan.store');
    Route::patch('/tulisan/update/{id}', [App\Http\Controllers\Berkas\TulisanController::class, 'edit'])->name('tulisan.edit');
    Route::patch('/tulisan/nilai', [App\Http\Controllers\Berkas\TulisanController::class, 'update'])->name('tulisan.update');
    Route::delete('/tulisan/{id}', [App\Http\Controllers\Berkas\TulisanController::class, 'destroy'])->name('tulisan.destroy');

    // Presentasi Route
    Route::get('/presentasi', [App\Http\Controllers\Berkas\PresentasiController::class, 'index'])->name('presentasi.index');
    Route::post('/presentasi/create', [App\Http\Controllers\Berkas\PresentasiController::class, 'store'])->name('presentasi.store');
    Route::patch('/presentasi/update/{id}', [App\Http\Controllers\Berkas\PresentasiController::class, 'edit'])->name('presentasi.edit');
    Route::patch('/presentasi/nilai', [App\Http\Controllers\Berkas\PresentasiController::class, 'update'])->name('presentasi.update');
    Route::delete('/presentasi/{id}', [App\Http\Controllers\Berkas\PresentasiController::class, 'destroy'])->name('presentasi.destroy');

    // Penguasaan Materi Route
    Route::get('/penguasaan', [App\Http\Controllers\Berkas\PenguasaanMateriController::class, 'index'])->name('penguasaan.index');
    Route::post('/penguasaan/create', [App\Http\Controllers\Berkas\PenguasaanMateriController::class, 'store'])->name('penguasaan.store');
    Route::patch('/penguasaan/update/{id}', [App\Http\Controllers\Berkas\PenguasaanMateriController::class, 'edit'])->name('penguasaan.edit');
    Route::patch('/penguasaan/nilai', [App\Http\Controllers\Berkas\PenguasaanMateriController::class, 'update'])->name('penguasaan.update');
    Route::delete('/penguasaan/{id}', [App\Http\Controllers\Berkas\PenguasaanMateriController::class, 'destroy'])->name('penguasaan.destroy');

    // Kualitas Produk Route
    Route::get('/kualitas', [App\Http\Controllers\Berkas\KualitasProdukController::class, 'index'])->name('kualitas.index');
    Route::post('/kualitas/create', [App\Http\Controllers\Berkas\KualitasProdukController::class, 'store'])->name('kualitas.store');
    Route::patch('/kualitas/update/{id}', [App\Http\Controllers\Berkas\KualitasProdukController::class, 'edit'])->name('kualitas.edit');
    Route::patch('/kualitas/nilai', [App\Http\Controllers\Berkas\KualitasProdukController::class, 'update'])->name('kualitas.update');
    Route::delete('/kualitas/{id}', [App\Http\Controllers\Berkas\KualitasProdukController::class, 'destroy'])->name('kualitas.destroy');

    // Persyaratan Route
    Route::get('/persyaratan', [App\Http\Controllers\Berkas\PersyaratanController::class, 'index'])->name('persyaratan.index');
    Route::post('/persyaratan/create', [App\Http\Controllers\Berkas\PersyaratanController::class, 'store'])->name('persyaratan.store');
    Route::patch('/persyaratan/update/{id}', [App\Http\Controllers\Berkas\PersyaratanController::class, 'edit'])->name('persyaratan.edit');
    Route::patch('/persyaratan/status', [App\Http\Controllers\Berkas\PersyaratanController::class, 'update'])->name('persyaratan.update');
    Route::delete('/persyaratan/{id}', [App\Http\Controllers\Berkas\PersyaratanController::class, 'destroy'])->name('persyaratan.destroy');

    // Asistensi Route
    Route::get('/asistensi', [App\Http\Controllers\Berkas\AsistensiController::class, 'index'])->name('asistensi.index');
    Route::post('/asistensi/create', [App\Http\Controllers\Berkas\AsistensiController::class, 'store'])->name('asistensi.store');
    Route::patch('/asistensi/update/{id}', [App\Http\Controllers\Berkas\AsistensiController::class, 'edit'])->name('asistensi.edit');
    Route::patch('/asistensi/status', [App\Http\Controllers\Berkas\AsistensiController::class, 'update'])->name('asistensi.update');
    Route::delete('/asistensi/{id}', [App\Http\Controllers\Berkas\AsistensiController::class, 'destroy'])->name('asistensi.destroy');

    // Asistensi Route
    Route::get('/perbaikan', [App\Http\Controllers\Berkas\PerbaikanController::class, 'index'])->name('perbaikan.index');
    Route::post('/perbaikan/create', [App\Http\Controllers\Berkas\PerbaikanController::class, 'store'])->name('perbaikan.store');
    Route::patch('/perbaikan/update/{id}', [App\Http\Controllers\Berkas\PerbaikanController::class, 'edit'])->name('perbaikan.edit');
    Route::patch('/perbaikan/status', [App\Http\Controllers\Berkas\PerbaikanController::class, 'update'])->name('perbaikan.update');
    Route::delete('/perbaikan/{id}', [App\Http\Controllers\Berkas\PerbaikanController::class, 'destroy'])->name('perbaikan.destroy');

    Route::middleware('can:akses data-konten-frontend')->group(function () {
        Route::get('/konten-beranda', [App\Http\Controllers\Content\BerandaController::class, 'index'])->name('beranda.index');
        Route::post('/beranda/store', [App\Http\Controllers\Content\BerandaController::class, 'store'])->name('beranda.store');
        Route::put('/beranda/update/{id}', [App\Http\Controllers\Content\BerandaController::class, 'update'])->name('beranda.update');

        Route::get('/konten-tentang', [App\Http\Controllers\Content\TentangController::class, 'index'])->name('tentang.index');
        Route::post('/tentang/store', [App\Http\Controllers\Content\TentangController::class, 'store'])->name('tentang.store');
        Route::put('/tentang/update/{id}', [App\Http\Controllers\Content\TentangController::class, 'update'])->name('tentang.update');

        Route::get('/konten-unduh', [App\Http\Controllers\Content\UnduhController::class, 'index'])->name('unduhpage.index');
        Route::post('/unduh/store', [App\Http\Controllers\Content\UnduhController::class, 'store'])->name('unduhpage.store');
        Route::put('/unduh/update/{id}', [App\Http\Controllers\Content\UnduhController::class, 'update'])->name('unduhpage.update');

        Route::get('/konten-layanan', [App\Http\Controllers\Content\LayananController::class, 'index'])->name('layanan.index');
        Route::get('/konten-layanan/create', [App\Http\Controllers\Content\LayananController::class, 'create'])->name('layanan.create');
        Route::get('/konten-layanan/edit/{id}', [App\Http\Controllers\Content\LayananController::class, 'edit'])->name('layanan.edit');
        Route::post('/layanan/store', [App\Http\Controllers\Content\LayananController::class, 'store'])->name('layanan.store');
        Route::put('/layanan/update/{id}', [App\Http\Controllers\Content\LayananController::class, 'update'])->name('layanan.update');
        Route::resource('listlayanan', App\Http\Controllers\Content\ListLayananController::class)->except(['index','create', 'edit','show']);

        Route::get('/konten-ekosistem', [App\Http\Controllers\Content\EkosistemController::class, 'index'])->name('ekosistem.index');
        Route::get('/konten-ekosistem/create', [App\Http\Controllers\Content\EkosistemController::class, 'create'])->name('ekosistem.create');
        Route::get('/konten-ekosistem/edit/{id}', [App\Http\Controllers\Content\EkosistemController::class, 'edit'])->name('ekosistem.edit');
        Route::post('/ekosistem/store', [App\Http\Controllers\Content\EkosistemController::class, 'store'])->name('ekosistem.store');
        Route::put('/ekosistem/update/{id}', [App\Http\Controllers\Content\EkosistemController::class, 'update'])->name('ekosistem.update');
        Route::resource('listekosistem', App\Http\Controllers\Content\ListEkosistemController::class)->except(['index','create', 'edit','show']);

        Route::resource('kontak', App\Http\Controllers\Content\KontakController::class)->except(['create', 'edit', 'show', 'store', 'update']);
        Route::post('/kontak/delete-all', [App\Http\Controllers\Content\KontakController::class, 'deleteAll'])->name('kontak.deleteAll');

        Route::resource('paket', App\Http\Controllers\Content\PaketController::class);
        Route::post('/paket/delete-all', [App\Http\Controllers\Content\PaketController::class, 'deleteAll'])->name('paket.deleteAll');

        Route::resource('mitrapengguna', App\Http\Controllers\Content\MitraPenggunaController::class);
        Route::resource('klien', App\Http\Controllers\Content\KlienController::class);


    });
    Route::get('/manajemen-kerja-sama', [App\Http\Controllers\KerjaSamaController::class, 'index'])->name('kerjasama.index')->middleware('can:akses kerja-sama');
    Route::middleware('can:akses langganan')->group(function () {
        Route::resource('manajemenlangganan', App\Http\Controllers\ManajemenLanggananController::class)->except(['create', 'edit', 'show', 'store', 'update']);
        Route::post('/manajemenlangganan/delete-all', [App\Http\Controllers\ManajemenLanggananController::class, 'deleteAll'])->name('manajemenlangganan.deleteAll');
    });
    Route::resource('lowongan', App\Http\Controllers\LowonganController::class)->middleware('can:akses lowongan');;
    Route::resource('cv', App\Http\Controllers\Dokumen\CvController::class)->middleware('can:akses buat-cv');
    Route::post('/cv/data-personal', [App\Http\Controllers\Dokumen\CvController::class, 'DataPersonalStore'])->name('datapersonal.store');
    Route::post('/cv/data-personal/{id}', [App\Http\Controllers\Dokumen\CvController::class, 'DataPersonalUpdate'])->name('datapersonal.update');
    Route::post('/cv/data-education', [App\Http\Controllers\Dokumen\CvController::class, 'DataEducationStore'])->name('dataeducation.store');
    Route::post('/cv/data-education/{id}', [App\Http\Controllers\Dokumen\CvController::class, 'DataEducationUpdate'])->name('dataeducation.update');
    Route::post('/data-experiences', [App\Http\Controllers\Dokumen\CvController::class, 'DataExperienceStore'])->name('dataexperience.store');
    Route::post('/data-experiences/{id}', [App\Http\Controllers\Dokumen\CvController::class, 'DataExperienceUpdate'])->name('dataexperience.update');
    Route::post('/data-organization', [App\Http\Controllers\Dokumen\CvController::class, 'DataOrgStore'])->name('dataorg.store');
    Route::post('/data-organization/{id}', [App\Http\Controllers\Dokumen\CvController::class, 'DataOrgUpdate'])->name('dataorg.update');
    Route::get('/generate-cv', [App\Http\Controllers\Dokumen\CvController::class, 'generateCV']);

    Route::middleware('can:akses pelamar')->group(function () {
        Route::resource('pelamar', App\Http\Controllers\PelamarController::class)->except(['create', 'edit', 'show', 'store', 'update'])->middleware('can:akses pelamar');
        Route::post('/pelamar/delete-all', [App\Http\Controllers\PelamarController::class, 'deleteAll'])->name('pelamar.deleteAll');
    });

    Route::middleware('can:akses pengumuman')->group(function () {
        Route::get('/pengumuman', [App\Http\Controllers\PengumumanController::class, 'index'])->name('pengumuman.index');
        Route::post('/pengumuman/store', [App\Http\Controllers\PengumumanController::class, 'sendPengumuman'])->name('pengumuman.send');
        Route::get('/notifications', [App\Http\Controllers\PengumumanController::class, 'getNotifications'])->name('notifications.list');
        Route::post('/pengumuman/{id}/mark-read', [App\Http\Controllers\PengumumanController::class, 'markAsRead']);
    });

    Route::get('/portal-informasi', [App\Http\Controllers\PortalInformasiController::class, 'index'])->name('portal.index');
    Route::post('/cari/lowongan', [App\Http\Controllers\LowonganController::class, 'search'])->name('lowongan.cari');
    Route::post('/kirim-lamaran', [App\Http\Controllers\PortalInformasiController::class, 'lamaran'])->name('lamaran.store');
    Route::resource('kartu', App\Http\Controllers\Berkas\KartuBimbinganController::class);


Route::get('/tes', [App\Http\Controllers\AIController::class, 'index']);
Route::get('/get-kabupaten/{provinsi_id}', [App\Http\Controllers\AIController::class, 'getKabupaten']);
Route::get('/get-kecamatan/{kabupaten_id}', [App\Http\Controllers\AIController::class, 'getKecamatan']);
Route::get('/get-kelurahan/{kecamatan_id}', [App\Http\Controllers\AIController::class, 'getKelurahan']);

});
