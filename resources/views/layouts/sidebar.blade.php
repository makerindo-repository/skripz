<aside class="sidebar-left border-right bg-white shadow-smooth" id="leftSidebar" data-simplebar>
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-dark ml-2 mt-3" data-toggle="toggle">
        <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>
    <nav class="vertnav navbar navbar-light">
        <!-- nav bar -->
        <div class="w-100 mb-4 mt-4 d-flex">
            <a class="navbar-brand mx-auto flex-fill text-center" href="">
                <img src="{{ asset(setting('logo')) }}" id="logo" class="navbar-brand-img brand-md"
                    alt="Image-Logo">
                </img>
            </a>
        </div>
        <ul class="navbar-nav flex-fill w-100 mb-2">
            @switch(auth()->user()->role->name)
                @case('Ketua Program Studi')
                    <li class="nav-item w-100 {{ Route::currentRouteNamed('kaprodi.dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('kaprodi.dashboard') }}">
                            <i class="fe fe-home fe-16"></i>
                            <span class="ml-3 item-text font-weight-bold">Dasbor</span>
                        </a>
                    </li>
                @break

                @case('Sekretariat')
                    <li class="nav-item w-100 {{ Route::currentRouteNamed('sekretariat.dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('sekretariat.dashboard') }}">
                            <i class="fe fe-home fe-16"></i>
                            <span class="ml-3 item-text font-weight-bold">Dasbor</span>
                        </a>
                    </li>
                @break

                @case('Dosen')
                    <li class="nav-item w-100 {{ Route::currentRouteNamed('dosen.dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('dosen.dashboard') }}">
                            <i class="fe fe-home fe-16"></i>
                            <span class="ml-3 item-text font-weight-bold">Dasbor</span>
                        </a>
                    </li>
                @break

                @case('Mahasiswa')
                    <li class="nav-item w-100 {{ Route::currentRouteNamed('mahasiswa.dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('mahasiswa.dashboard') }}">
                            <i class="fe fe-home fe-16"></i>
                            <span class="ml-3 item-text font-weight-bold">Dasbor</span>
                        </a>
                    </li>
                @break

                @case('Industri')
                    <li class="nav-item w-100 {{ Route::currentRouteNamed('industri.dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('industri.dashboard') }}">
                            <i class="fe fe-home fe-16"></i>
                            <span class="ml-3 item-text font-weight-bold">Dasbor</span>
                        </a>
                    </li>
                @break

                @case('SuperAdmin')
                    <li class="nav-item w-100 {{ Route::currentRouteNamed('superadmin.dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('superadmin.dashboard') }}">
                            <i class="fe fe-home fe-16"></i>
                            <span class="ml-3 item-text font-weight-bold">Dasbor</span>
                        </a>
                    </li>
                @break
            @endswitch
        </ul>

        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100 {{ Route::currentRouteNamed('portal.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('portal.index') }}">
                    <i class="fe bi-newspaper fe-16"></i>
                    <span class="ml-3 item-text font-weight-bold">Portal Informasi</span>
                </a>
            </li>
        </ul>
        @can('akses data-master')
            <p>Menu utama</p>
            <ul class="navbar-nav flex-fill w-100 mb-2">
                <li class="nav-item w-100 {{ Route::currentRouteNamed('datautama.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('datautama.index') }}">
                        <i class="fe bi-stack fe-16"></i>
                        <span class="ml-3 item-text font-weight-bold">Data Utama</span>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav flex-fill w-100 mb-2">
                <li
                    class="nav-item w-100 {{ Route::currentRouteNamed('datamaster.index', 'dosen.index', 'dosen.create', 'dosen.edit', 'dosen.show', 'dosen-pembimbing.index', 'mahasiswa-bimbingan.index', 'sekretariat.index', 'bimbingan.index', 'topik-skripsi.index', 'kelompok-keilmuan.index', 'mitra.index', 'mitra.create', 'mitra.edit', 'ruang.index', 'tahun-akademik.index', 'jabatan.index', 'jurusan.index', 'kaprodi.index', 'predikat-kelulusan.index', 'bidang-keahlian.index', 'keilmuan.index', 'sumber-referensi.index', 'mahasiswa.index', 'mahasiswa.create', 'mahasiswa.edit', 'mahasiswa.show') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('datamaster.index') }}">
                        <i class="fe bi-grid fe-16"></i>
                        <span class="ml-3 item-text font-weight-bold">Data Induk</span>
                    </a>
                </li>
            </ul>
        @endcan
        @can('akses jadwal')
            <ul class="navbar-nav flex-fill w-100 mb-2">
                <li class="nav-item w-100 {{ Route::currentRouteNamed('jadwal.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('jadwal.index') }}">
                        <i class="fe bi-calendar-range fe-16"></i>
                        <span class="ml-3 item-text font-weight-bold">Jadwal</span>
                    </a>
                </li>
            </ul>
        @endcan
        @can('akses progress-bimbingan')
            <ul class="navbar-nav flex-fill w-100 mb-2">
                <li class="nav-item w-100 {{ Route::currentRouteNamed('progres-bimbingan.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('progres-bimbingan.index') }}">
                        <i class="fe bi-arrow-repeat fe-16 "></i>
                        <span class="ml-3 item-text font-weight-bold">Progres Bimbingan</span>
                    </a>
                </li>
            </ul>
        @endcan
        @can('akses repository-skripsi')
            <ul class="navbar-nav flex-fill w-100 mb-2">
                <li class="nav-item w-100 {{ Route::currentRouteNamed('repository-skripsi.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('repository-skripsi.index') }}">
                        <i class="fe bi-folder fe-16 "></i>
                        <span class="ml-3 item-text font-weight-bold">Repositori Skripsi</span>
                    </a>
                </li>
            </ul>
        @endcan
        @can('akses penilaian')
            <ul class="navbar-nav flex-fill w-100 mb-2">
                <li
                    class="nav-item w-100 {{ Route::currentRouteNamed('penilaian.index', 'sidang.index', 'seminar.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('penilaian.index') }}">
                        <i class="fe bi-pencil-square fe-16 "></i>
                        <span class="ml-3 item-text font-weight-bold">Penilaian</span>
                    </a>
                </li>
            </ul>
        @endcan
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li
                class="nav-item w-100 {{ Route::currentRouteNamed('sidang.daftar', 'sidang.hasil') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('sidang.daftar') }}">
                    <i class="fe bi-bar-chart-steps fe-16 "></i>
                    <span class="ml-3 item-text font-weight-bold">Hasil Penilaian Sidang</span>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li
                class="nav-item w-100 {{ Route::currentRouteNamed('seminar.daftar', 'seminar.hasil') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('seminar.daftar') }}">
                    <i class="fe bi-bar-chart-steps fe-16 "></i>
                    <span class="ml-3 item-text font-weight-bold">Hasil Penilaian Seminar</span>
                </a>
            </li>
        </ul>
        @can('akses laporan')
            <ul class="navbar-nav flex-fill w-100 mb-2">
                <li
                    class="nav-item w-100 {{ Route::currentRouteNamed('laporan.index', 'laporan-usulan-proposal.index', 'laporan-kemajuan-seminar.index', 'laporan-bimbingan.index', 'laporan-kemajuan-sidang.index', 'laporan-yudisium.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('laporan.index') }}">
                        <i class="fe bi-file-text fe-16"></i>
                        <span class="ml-3 item-text font-weight-bold">Laporan</span>
                    </a>
                </li>
            </ul>
        @endcan
        @can('akses manajemen')
            <p>Manajemen</p>
            <ul class="navbar-nav flex-fill w-100 mb-2">
                <li
                    class="nav-item w-100 {{ Route::currentRouteNamed('management.index', 'management-role.index', 'management-role.create', 'management-role.edit', 'management-user.index', 'management-user.create', 'management-user.edit') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('management.index') }}">
                        <i class="fe bi-shield-lock fe-16"></i>
                        <span class="ml-3 item-text font-weight-bold">Manajemen Akun</span>
                    </a>
                </li>
            </ul>
        @endcan
        {{-- @can('akses kerja-sama')
            <ul class="navbar-nav flex-fill w-100 mb-2">
                <li class="nav-item w-100 {{ Route::currentRouteNamed('kerjasama.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('kerjasama.index') }}">
                        <i class="fe bi-briefcase fe-16"></i>
                        <span class="ml-3 item-text font-weight-bold">Manajemen Kerjasama</span>
                    </a>
                </li>
            </ul>
        @endcan --}}
        @can('akses langganan')
            <ul class="navbar-nav flex-fill w-100 mb-2">
                <li class="nav-item w-100 {{ Route::currentRouteNamed('manajemenlangganan.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('manajemenlangganan.index') }}">
                        <i class="fe bi-bookmarks fe-16"></i>
                        <span class="ml-3 item-text font-weight-bold">Manajemen Langganan</span>
                    </a>
                </li>
            </ul>
        @endcan
        @can('akses pelamar')
            <ul class="navbar-nav flex-fill w-100 mb-2">
                <li class="nav-item w-100 {{ Route::currentRouteNamed('pelamar.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('pelamar.index') }}">
                        <i class="fe bi-person-badge fe-16"></i>
                        <span class="ml-3 item-text font-weight-bold">Manajemen Pelamar</span>
                    </a>
                </li>
            </ul>
        @endcan
        @can('akses pengaturan-aplikasi')
            <p>Extra</p>
            <ul class="navbar-nav flex-fill w-100 mb-2">
                <li
                    class="nav-item w-100 {{ Route::currentRouteNamed('lowongan.index', 'lowongan.create', 'lowongan.edit', 'lowongan.show') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('lowongan.index') }}">
                        <i class="fe bi-diagram-2 fe-16"></i>
                        <span class="ml-3 item-text font-weight-bold">Lowongan</span>
                    </a>
                </li>
            </ul>
        @endcan
        {{-- @can('akses buat-cv')
            <ul class="navbar-nav flex-fill w-100 mb-2">
                <li class="nav-item w-100">
                    <a class="nav-link" href="{{ route('cv.index') }}">
                        <i class="fe bi-file-pdf fe-16"></i>
                        <span class="ml-3 item-text font-weight-bold">Buat CV</span>
                    </a>
                </li>
            </ul>
        @endcan --}}
        @can('akses pengumuman')
            <ul class="navbar-nav flex-fill w-100 mb-2">
                <li class="nav-item w-100">
                    <a class="nav-link" href="{{ route('pengumuman.index') }}">
                        <i class="fe bi-megaphone fe-16"></i>
                        <span class="ml-3 item-text font-weight-bold">Pegumuman</span>
                    </a>
                </li>
            </ul>
        @endcan
        @can('akses pengaturan-berkas')
            <p>Pengaturan</p>
            <ul class="navbar-nav flex-fill w-100 mb-2">
                <li class="nav-item w-100 {{ Route::currentRouteNamed('berkas.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('berkas.index') }}">
                        <i class="fe bi-archive fe-16"></i>
                        <span class="ml-3 item-text font-weight-bold">Pengaturan Berkas</span>
                    </a>
                </li>
            </ul>
        @endcan
        @can('akses pengaturan-aplikasi')
            <ul class="navbar-nav flex-fill w-100 mb-2">
                <li class="nav-item w-100 {{ Route::currentRouteNamed('setting') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('setting') }}">
                        <i class="fe fe-settings fe-16"></i>
                        <span class="ml-3 item-text font-weight-bold">Pengaturan Aplikasi</span>
                    </a>
                </li>
            </ul>
        @endcan
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100 {{ Route::currentRouteNamed('tentang-kami.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('tentang-kami.index') }}">
                    <i class="fe bi-exclamation-circle fe-16"></i>
                    <span class="ml-3 item-text font-weight-bold">Tentang Kami</span>
                </a>
            </li>
        </ul>
        @can('akses data-konten-frontend')
            <p>Data konten FE</p>
            <ul class="navbar-nav flex-fill w-100 mb-2">
                <li class="nav-item w-100 {{ Route::currentRouteNamed('beranda.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('beranda.index') }}">
                        <i class="fe bi-card-heading fe-16"></i>
                        <span class="ml-3 item-text font-weight-bold">Beranda</span>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav flex-fill w-100 mb-2">
                <li class="nav-item w-100 {{ Route::currentRouteNamed('tentang.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('tentang.index') }}">
                        <i class="fe bi-collection fe-16"></i>
                        <span class="ml-3 item-text font-weight-bold">Tentang</span>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav flex-fill w-100 mb-2">
                <li class="nav-item w-100 {{ Route::currentRouteNamed('layanan.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('layanan.index') }}">
                        <i class="fe bi-distribute-vertical fe-16"></i>
                        <span class="ml-3 item-text font-weight-bold">Layanan</span>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav flex-fill w-100 mb-2">
                <li class="nav-item w-100 {{ Route::currentRouteNamed('ekosistem.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('ekosistem.index') }}">
                        <i class="fe bi-hdd-network fe-16"></i>
                        <span class="ml-3 item-text font-weight-bold">Ekosistem</span>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav flex-fill w-100 mb-2">
                <li class="nav-item w-100 {{ Route::currentRouteNamed('paket.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('paket.index') }}">
                        <i class="fe bi-diagram-3 fe-16"></i>
                        <span class="ml-3 item-text font-weight-bold">Paket</span>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav flex-fill w-100 mb-2">
                <li class="nav-item w-100 {{ Route::currentRouteNamed('mitrapengguna.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('mitrapengguna.index') }}">
                        <i class="fe bi-app-indicator fe-16"></i>
                        <span class="ml-3 item-text font-weight-bold">Mitra</span>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav flex-fill w-100 mb-2">
                <li class="nav-item w-100 {{ Route::currentRouteNamed('klien.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('klien.index') }}">
                        <i class="fe bi-textarea fe-16"></i>
                        <span class="ml-3 item-text font-weight-bold">Klien</span>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav flex-fill w-100 mb-2">
                <li class="nav-item w-100 {{ Route::currentRouteNamed('unduhpage.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('unduhpage.index') }}">
                        <i class="fe bi-download fe-16"></i>
                        <span class="ml-3 item-text font-weight-bold">Halaman Unduh</span>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav flex-fill w-100 mb-2">
                <li class="nav-item w-100 {{ Route::currentRouteNamed('kontak.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('kontak.index') }}">
                        <i class="fe bi-inboxes fe-16"></i>
                        <span class="ml-3 item-text font-weight-bold">Kontak</span>
                    </a>
                </li>
            </ul>
        @endcan
        <div class="btn-box w-100 mb-3">
            <a href="{{ url('/') }}" target="_blank" class="btn btn-primary  btn-block">
                <i class="fe fe-arrow-left mr-1"></i>Landing Page
            </a>
        </div>
    </nav>
</aside>
