@extends('layouts.template')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h5 class="mb-3 h5">Selamat Datang, {{ Auth::user()->role->name }} !</h5>
                <div class="row mb-2">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="card shadow-smooth custom-card h-100 bg-white">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h6 class="h7 text-dark font-weight-bold">Total Kaprodi</h6>
                                                <h4 class="text-dark font-weight-bold">{{ $kaprodi->count() }}</h4>
                                            </div>
                                            <div class="col-auto">
                                                <span
                                                    class="fe fe-24 bi-person-check text-dark font-weight-bold mb-0"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card shadow-smooth custom-card h-100 bg-white">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h6 class="h7 text-dark font-weight-bold">Total Sekretariat</h6>
                                                <h4 class="text-dark font-weight-bold">{{ $sekretariat->count() }}</h4>
                                            </div>
                                            <div class="col-auto">
                                                <span
                                                    class="fe fe-24 bi-person-lines-fill text-dark font-weight-bold mb-0"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card shadow-smooth custom-card h-100 bg-white">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h6 class="h7 text-dark font-weight-bold">Total Dosen</h6>
                                                <h4 class="text-dark font-weight-bold">{{ $dosen->count() }}</h4>
                                            </div>
                                            <div class="col-auto">
                                                <span
                                                    class="fe fe-24 bi-person-check text-dark font-weight-bold mb-0"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card shadow-smooth custom-card h-100 bg-white">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h6 class="h7 text-dark font-weight-bold">Total Mahasiswa</h6>
                                                <h4 class="text-dark font-weight-bold">{{ $mahasiswa->count() }}</h4>
                                            </div>
                                            <div class="col-auto">
                                                <span
                                                    class="fe fe-24 bi-mortarboard-fill text-dark font-weight-bold mb-0"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card shadow-smooth custom-card h-100 bg-white">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h6 class="h7 text-dark font-weight-bold">Total Industri</h6>
                                                <h4 class="text-dark font-weight-bold">{{ $mitra->count() }}</h4>
                                            </div>
                                            <div class="col-auto">
                                                <span class="fe fe-24 bi-tools text-dark font-weight-bold mb-0"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card shadow-smooth custom-card h-100 bg-white">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h6 class="h7 text-dark font-weight-bold">Total Akun</h6>
                                                <h4 class="text-dark font-weight-bold">{{ $akun->count() }}</h4>
                                            </div>
                                            <div class="col-auto">
                                                <span
                                                    class="fe fe-24 bi-person-fill text-dark font-weight-bold mb-0"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card shadow-smooth custom-card h-100 bg-white">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h6 class="h7 text-dark font-weight-bold">Total Pelamar</h6>
                                                <h4 class="text-dark font-weight-bold">{{ $pelamar->count() }}</h4>
                                            </div>
                                            <div class="col-auto">
                                                <span
                                                    class="fe fe-24 bi-person-badge text-dark font-weight-bold mb-0"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card shadow-smooth custom-card h-100 bg-white">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h6 class="h7 text-dark font-weight-bold">Kontak Masuk</h6>
                                                <h4 class="text-dark font-weight-bold">{{ $kontak->count() }}</h4>
                                            </div>
                                            <div class="col-auto">
                                                <span class="fe fe-24 bi-inboxes text-dark font-weight-bold mb-0"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card shadow-smooth custom-card h-100 bg-white">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h6 class="h7 text-dark font-weight-bold">Langganan</h6>
                                                <h4 class="text-dark font-weight-bold">{{ $langganan->count() }}</h4>
                                            </div>
                                            <div class="col-auto">
                                                <span class="fe fe-24 bi-inboxes text-dark font-weight-bold mb-0"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="card shadow-smooth custom-card mb-2">
                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <div class="col-md-12">
                                                <form>
                                                    <div class="card shadow-smooth custom-card mb-2">
                                                        <div class="card-body">
                                                            <h6 class="h6">Filter</h6>
                                                            <div class="form-row">
                                                                <div class="form-group col-md-2">
                                                                    <label for="tahun_akademik">Tahun Akademik</label>
                                                                    <select class="form-control " id="tahun_akademik">
                                                                        @foreach ($thakademik->groupBy('tahun_akademik') as $tahun => $semesters)
                                                                            <option value="{{ $tahun }}">
                                                                                {{ $tahun }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div> <!-- form-group -->
                                                                <div class="form-group col-md-2">
                                                                    <label for="semester">Semester</label>
                                                                    <select class="form-control " id="semester">
                                                                        @foreach ($thakademik as $item)
                                                                            <option value="{{ $item->semester }}">
                                                                                {{ $item->semester }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div> <!-- form-group -->
                                                            </div>
                                                            <button class="btn btn-primary" type="submit">Filter</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            {{-- Chart Pie Start --}}
                                            <div class="col-md-6 mb-2">
                                                <div class="card shadow h-100 bg-indigo">
                                                    <div class="card-body text-center">
                                                        <h6 class="text-white h7">Total Dosen Pembimbing</h6>
                                                        <div id="chart"></div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <h4 class="text-white">
                                                                    {{ $dospem->where('program_study', 'S1')->count() }}
                                                                </h4>
                                                                <small class="text-white">S1</small>
                                                            </div>
                                                            <div class="col">
                                                                <h4 class="text-white">
                                                                    {{ $dospem->where('program_study', 'D3')->count() }}
                                                                </h4>
                                                                <small class="text-white">D3</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- Chart Pie End --}}

                                            {{-- Chart Pie Start --}}
                                            <div class="col-md-6 mb-2">
                                                <div class="card shadow h-100 bg-aqua">
                                                    <div class="card-body text-center">
                                                        <h6 class="text-white h7">Total Mahasiswa Bimbingan</h6>
                                                        <div id="chart2"></div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <h4 class="text-white">{{ $jumlahMahasiswaS1 }}
                                                                </h4>
                                                                <small class="text-white">S1</small>
                                                            </div>
                                                            <div class="col">
                                                                <h4 class="text-white">{{ $jumlahMahasiswaD3 }}
                                                                </h4>
                                                                <small class="text-white">D3</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- Chart Pie End --}}

                                            {{-- Chart Pie Start --}}
                                            <div class="col-md-6 mb-2">
                                                <div class="card shadow h-100 bg-info">
                                                    <div class="card-body text-center">
                                                        <h6 class="text-white h7">Progres Skripsi</h6>
                                                        <div id="chart3"></div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <h4 class="text-white">
                                                                    {{ $tasks->where('status_id', 1)->count() }}
                                                                </h4>
                                                                <small class="text-white">Seminar</small>
                                                            </div>
                                                            <div class="col">
                                                                <h4 class="text-white">
                                                                    {{ $tasks->where('status_id', 3)->count() }}</h4>
                                                                <small class="text-white">Sidang</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- Chart Pie End --}}

                                            {{-- Chart Pie Start --}}
                                            <div class="col-md-6 mb-2">
                                                <div class="card shadow bg-primary h-100">
                                                    <div class="card-body text-center">
                                                        <h6 class="text-white h7">Kelompok Keilmuan</h6>
                                                        <div id="chart6"></div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <h4 class="text-white">
                                                                    {{ $kelilmuan->where('kel_keilmuan', 'Soft Computing')->count() }}
                                                                </h4>
                                                                <small class="text-white">Soft
                                                                    Computing</small>
                                                            </div>
                                                            <div class="col">
                                                                <h4 class="text-white">
                                                                    {{ $kelilmuan->where('kel_keilmuan', 'Instrumentasi')->count() }}
                                                                </h4>
                                                                <small class="text-white">Instrumentasi</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- Chart Pie End --}}

                                            {{-- Chart Pie Start --}}
                                            <div class="col-md-12 mb-2">
                                                <div class="card shadow bg-dark h-100">
                                                    <div class="card-body text-center">
                                                        <h6 class="text-white h7">Waktu Belajar Mahasiswa</h6>
                                                        <div class="row">
                                                            <div class="col">
                                                                <small class="text-white h7">Tepat Waktu</small>
                                                            </div>
                                                            <div class="col">
                                                                <small class="text-white h7">Tidak Tepat waktu</small>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div id="chart4"></div>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <h4 class="text-white">0</h4>
                                                                        <small class="text-white">S1</small>
                                                                    </div>
                                                                    <div class="col">
                                                                        <h4 class="text-white">0</h4>
                                                                        <small class="text-white">D3</small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div id="chart5"></div>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <h4 class="text-white">0</h4>
                                                                        <small class="text-white">S1</small>
                                                                    </div>
                                                                    <div class="col">
                                                                        <h4 class="text-white">0</h4>
                                                                        <small class="text-white">D3</small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- Chart Pie End --}}

                                            <div class="col-md-12">
                                                <div class="card shadow h-100 bg-blackdeep">
                                                    <div class="card-body">
                                                        <h6 class="text-white text-center h7 mb-2">Grafik Predikat
                                                            Kelulusan</h6>
                                                        <div class="row">
                                                            <div class="col-md-9">
                                                                <div id="chartCol"></div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <h6 class="text-white mb-4">Predikat Kelulusan</h6>
                                                                <h6 class="text-white mb-2 h7">Cumlaude</h6>
                                                                <h4 class="text-white mb-3">4.00</h4>
                                                                <h6 class="text-white mb-2 h7">Sangat Memuaskan</h6>
                                                                <h4 class="text-white mb-3">3.00</h4>
                                                                <h6 class="text-white mb-2 h7">Memuaskan</h6>
                                                                <h4 class="text-white mb-2">2.00</h4>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <div class="card shadow-smooth custom-card">
                                            <div class="card-body">
                                                <h6 class="text-center h6 mb-4">Top 10 Mahasiswa S1 Dengan IPK
                                                    Tertinggi
                                                </h6>
                                                <p class="small mb-3">Update Terakhir : </p>
                                                <div class="table-responsive">
                                                    <table class="table table-hover">
                                                        <thead class="thead-dark">
                                                            <tr>
                                                                <th class="col-1">#</th>
                                                                <th>Nama Mahasiswa</th>
                                                                <th class="col-1">IPK</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="card shadow-smooth custom-card">
                                            <div class="card-body">
                                                <h6 class="text-center h6 mb-4">Top 10 Mahasiswa D3 Dengan IPK
                                                    Tertinggi
                                                </h6>
                                                <p class="small mb-3">Update Terakhir : </p>
                                                <div class="table-responsive">
                                                    <table class="table table-hover">
                                                        <thead class="thead-dark">
                                                            <tr>
                                                                <th class="col-1">#</th>
                                                                <th>Nama Mahasiswa</th>
                                                                <th class="col-1">IPK</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card shadow-smooth custom-card mb-3">
                            <div class="card-body p-5">
                                <div class="calendar">
                                    <div class="header">
                                        <div class="month"></div>
                                        <div class="btns">
                                            <div class="btn today-btn">
                                                <i class="fe fe-12 bi-calendar-day"></i>
                                            </div>
                                            <div class="btn prev-btn">
                                                <i class="fe fe-12 bi-chevron-left"></i>
                                            </div>
                                            <div class="btn next-btn">
                                                <i class="fe fe-12 bi-chevron-right"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="weekdays mb-3">
                                        <div class="day">Min</div> <!-- Minggu -->
                                        <div class="day">Sen</div> <!-- Senin -->
                                        <div class="day">Sel</div> <!-- Selasa -->
                                        <div class="day">Rab</div> <!-- Rabu -->
                                        <div class="day">Kam</div> <!-- Kamis -->
                                        <div class="day">Jum</div> <!-- Jumat -->
                                        <div class="day">Sab</div> <!-- Sabtu -->
                                    </div>
                                    <div class="days">
                                        <!-- lets add days using js -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card shadow-smooth custom-card mb-3">
                            <div class="card-body p-5" data-simplebar
                                style="max-height:80%; overflow-y: auto; overflow-x: hidden;">
                                <h6 class="mb-4 h6">Hari Ini</h6>
                                @if ($penjadwalanHariIni->isEmpty())
                                    <div class="row mb-2">
                                        <div class="col-md-12">
                                            <p class="small text-muted">Tidak ada jadwal hari
                                                ini.</p>
                                        </div>
                                    </div>
                                @else
                                    @foreach ($penjadwalanHariIni as $data)
                                        <div class="row mb-2">
                                            <div class="col-md-10">
                                                <small class="text-dark font-weight-medium ml-2">
                                                    <span
                                                        class="dot dot-lg
                                                    @if ($data->jenis_kegiatan == 'Sidang') bg-primary
                                                    @elseif ($data->jenis_kegiatan == 'Seminar') bg-warning
                                                    @elseif ($data->jenis_kegiatan == 'Bimbingan') bg-purple @endif
                                                    mr-1">
                                                    </span>
                                                    {{ $data->jenis_kegiatan }}
                                                    {{ $data->mahasiswa->name }}
                                                </small>
                                            </div>
                                            <div class="col-md-auto">
                                                <small class="text-muted float-right">
                                                    {{ date('h.i', strtotime($data->jam_mulai)) }}
                                                </small>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                <h6 class="mb-3 mt-3 h6">Besok</h6>
                                @if ($penjadwalanBesok->isEmpty())
                                    <div class="row mb-2">
                                        <div class="col-md-12">
                                            <p class=" small text-muted">Tidak ada jadwal untuk
                                                besok.</p>
                                        </div>
                                    </div>
                                @else
                                    @foreach ($penjadwalanBesok as $data)
                                        <div class="row mb-2">
                                            <div class="col-md-10">
                                                <small class="text-dark font-weight-medium ml-2">
                                                    <span
                                                        class="dot dot-lg
                                                    @if ($data->jenis_kegiatan == 'Sidang') bg-primary
                                                    @elseif ($data->jenis_kegiatan == 'Seminar') bg-warning
                                                    @elseif ($data->jenis_kegiatan == 'Bimbingan') bg-purple @endif
                                                    mr-1">
                                                    </span>
                                                    {{ $data->jenis_kegiatan }}
                                                    {{ $data->mahasiswa->name }}
                                                </small>
                                            </div>
                                            <div class="col-md-auto">
                                                <small class="text-muted float-right">
                                                    {{ date('h.i', strtotime($data->jam_mulai)) }}
                                                </small>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                <h6 class="mb-3 mt-3 h6">Minggu Ini</h6>
                                @if ($penjadwalanMingguIni->isEmpty())
                                    <div class="row mb-2">
                                        <div class="col-md-12">
                                            <p class=" small text-muted">Tidak ada jadwal untuk
                                                minggu ini.</p>
                                        </div>
                                    </div>
                                @else
                                    @foreach ($penjadwalanMingguIni as $data)
                                        <div class="row mb-2">
                                            <div class="col-md-10">
                                                <small class="text-dark font-weight-medium ml-2">
                                                    <span
                                                        class="dot dot-lg
                                                    @if ($data->jenis_kegiatan == 'Sidang') bg-primary
                                                    @elseif ($data->jenis_kegiatan == 'Seminar') bg-warning
                                                    @elseif ($data->jenis_kegiatan == 'Bimbingan') bg-purple @endif
                                                    mr-1">
                                                    </span>
                                                    {{ $data->jenis_kegiatan }}
                                                    {{ $data->mahasiswa->name }}
                                                </small>
                                            </div>
                                            <div class="col-md-auto">
                                                <small class="text-muted float-right">
                                                    {{ date('h.i', strtotime($data->jam_mulai)) }}
                                                </small>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div> <!-- / .card-body -->
                        </div>
                        <div class="card shadow-smooth custom-card mb-2">
                            <div class="card-body">
                                <ul class="nav nav-pills nav-fill mb-3" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link font-weight-bold active" id="pills-home-tab"
                                            data-toggle="pill" href="#pills-home" role="tab"
                                            aria-controls="pills-home" aria-selected="true">S1</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link font-weight-bold" id="pills-profile-tab" data-toggle="pill"
                                            href="#pills-profile" role="tab" aria-controls="pills-profile"
                                            aria-selected="false">D3</a>
                                </ul>
                                <div class="tab-content mb-1" id="pills-tabContent">
                                    <div class="tab-pane fade active show" id="pills-home" role="tabpanel"
                                        aria-labelledby="pills-home-tab">
                                        <h6 class="text-center h6 mb-4 mt-5">Top 10 Mahasiswa S1 Dengan IPK
                                            Tertinggi
                                        </h6>
                                        <p class="small mb-3">Update Terakhir : </p>
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th class="col-1">#</th>
                                                        <th>Nama Mahasiswa</th>
                                                        <th class="col-1">IPK</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                        aria-labelledby="pills-profile-tab">
                                        <h6 class="text-center h6 mb-4 mt-5">Top 10 Mahasiswa D3 Dengan IPK
                                            Tertinggi
                                        </h6>
                                        <p class="small mb-3">Update Terakhir : </p>
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th class="col-1">#</th>
                                                        <th>Nama Mahasiswa</th>
                                                        <th class="col-1">IPK</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script></script>
        {{-- Dosen Pembimbing --}}
        <script>
            var options = {
                series: [{{ $dospem->where('program_study', 'S1')->count() }},
                    {{ $dospem->where('program_study', 'D3')->count() }}
                ],
                chart: {
                    height: '80%',
                    type: 'pie',
                },
                labels: ['S1', 'D3'],
                tooltip: {
                    enabled: true,
                },
                stroke: {
                    show: false,
                },
                colors: ['#353957', '#ffffff'],
                dataLabels: {
                    style: {
                        fontSize: '10px',
                        fontWeight: 'bold',
                        fontFamily: 'Montserrat, sans-serif',
                        colors: ['#ffffff', '#353957'],
                    },
                },
                plotOptions: {
                    pie: {
                        dataLabels: {
                            offset: -10,
                            minAngleToShowLabel: 10
                        },
                    },
                },
                legend: {
                    position: 'bottom',
                    fontSize: '9px',
                    fontFamily: 'Montserrat, sans-serif',
                    fontWeight: 400,
                    labels: {
                        colors: ['#ffffff', '#ffffff'],
                    },
                    markers: {
                        width: 8,
                        height: 8,
                    },
                },

                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            height: '80%'
                        },
                        legend: {
                            position: 'bottom',
                            fontSize: '8px',
                            fontFamily: 'Montserrat, sans-serif',
                            fontWeight: 400,
                            labels: {
                                colors: ['#ffffff', '#ffffff'],
                            },
                        }
                    }
                }]
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        </script>
        {{-- Mahasiswa Bimbingan --}}
        <script>
            var options = {
                series: [{{ $jumlahMahasiswaS1 }},
                    {{ $jumlahMahasiswaD3 }}
                ],
                chart: {
                    height: '80%',
                    type: 'pie',
                },
                labels: ['S1', 'D3'],
                tooltip: {
                    enabled: true,
                },
                stroke: {
                    show: false,
                },
                colors: ['#353957', '#ffffff'],
                dataLabels: {
                    style: {
                        fontSize: '10px',
                        fontWeight: 'bold',
                        fontFamily: 'Montserrat, sans-serif',
                        colors: ['#ffffff', '#353957'],
                    },
                },
                plotOptions: {
                    pie: {
                        dataLabels: {
                            offset: -10,
                            minAngleToShowLabel: 10
                        },
                    },
                },
                legend: {
                    position: 'bottom',
                    fontSize: '9px',
                    fontFamily: 'Montserrat, sans-serif',
                    fontWeight: 400,
                    labels: {
                        colors: ['#ffffff', '#ffffff'],
                    },
                    markers: {
                        width: 8,
                        height: 8,
                    },
                },

                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            height: '80%'
                        },
                        legend: {
                            position: 'bottom',
                            fontSize: '8px',
                            fontFamily: 'Montserrat, sans-serif',
                            fontWeight: 400,
                            labels: {
                                colors: ['#ffffff', '#ffffff'],
                            },
                        }
                    }
                }]
            };

            var chart = new ApexCharts(document.querySelector("#chart2"), options);
            chart.render();
        </script>
        {{-- Progress Bimbingan --}}
        <script>
            var options = {
                series: [{{ $tasks->where('status_id', 1)->count() }}, {{ $tasks->where('status_id', 3)->count() }}],
                chart: {
                    height: '80%',
                    type: 'pie',
                },
                labels: ['Seminar', 'Sidang'],
                tooltip: {
                    enabled: true,
                },
                stroke: {
                    show: false,
                },
                colors: ['#353957', '#ffffff'],
                dataLabels: {
                    style: {
                        fontSize: '10px',
                        fontWeight: 'bold',
                        fontFamily: 'Montserrat, sans-serif',
                        colors: ['#ffffff', '#353957'],
                    },
                },
                plotOptions: {
                    pie: {
                        dataLabels: {
                            offset: -10,
                            minAngleToShowLabel: 10
                        },
                    },
                },
                legend: {
                    position: 'bottom',
                    fontSize: '9px',
                    fontFamily: 'Montserrat, sans-serif',
                    fontWeight: 400,
                    labels: {
                        colors: ['#ffffff', '#ffffff'],
                    },
                    markers: {
                        width: 8,
                        height: 8,
                    },
                },

                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            height: '80%'
                        },
                        legend: {
                            position: 'bottom',
                            fontSize: '8px',
                            fontFamily: 'Montserrat, sans-serif',
                            fontWeight: 400,
                            labels: {
                                colors: ['#ffffff', '#ffffff'],
                            },
                        }
                    }
                }]
            };

            var chart = new ApexCharts(document.querySelector("#chart3"), options);
            chart.render();
        </script>
        {{-- Waktu Belajar --}}
        <script>
            var options = {
                series: [0, 0],
                chart: {
                    height: '80%',
                    type: 'pie',
                },
                labels: ['S1', 'D3'],
                tooltip: {
                    enabled: true,
                },
                stroke: {
                    show: false,
                },
                colors: ['#1b68ff', '#ffffff'],
                dataLabels: {
                    style: {
                        fontSize: '10px',
                        fontWeight: 'bold',
                        fontFamily: 'Montserrat, sans-serif',
                        colors: ['#ffffff', '#1b68ff'],
                    },
                },
                plotOptions: {
                    pie: {
                        dataLabels: {
                            offset: -10,
                            minAngleToShowLabel: 10
                        },
                    },
                },
                legend: {
                    position: 'bottom',
                    fontSize: '9px',
                    fontFamily: 'Montserrat, sans-serif',
                    fontWeight: 400,
                    labels: {
                        colors: ['#ffffff', '#ffffff'],
                    },
                    markers: {
                        width: 8,
                        height: 8,
                    },
                },

                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            height: '75%',
                        },
                        legend: {
                            position: 'bottom',
                            fontSize: '8px',
                            fontFamily: 'Montserrat, sans-serif',
                            fontWeight: 400,
                            labels: {
                                colors: ['#ffffff', '#ffffff'],
                            },
                        }
                    }
                }]
            };

            var chart = new ApexCharts(document.querySelector("#chart4"), options);
            chart.render();
        </script>
        <script>
            var options = {
                series: [0, 0],
                chart: {
                    height: '80%',
                    type: 'pie',
                },
                labels: ['S1', 'D3'],
                tooltip: {
                    enabled: true,
                },
                stroke: {
                    show: false,
                },
                colors: ['#dc3545', '#ffffff'],
                dataLabels: {
                    style: {
                        fontSize: '10px',
                        fontWeight: 'bold',
                        fontFamily: 'Montserrat, sans-serif',
                        colors: ['#ffffff', '#dc3545'],
                    },
                },
                plotOptions: {
                    pie: {
                        dataLabels: {
                            offset: -10,
                            minAngleToShowLabel: 10
                        },
                    },
                },
                legend: {
                    position: 'bottom',
                    fontSize: '9px',
                    fontFamily: 'Montserrat, sans-serif',
                    fontWeight: 400,
                    labels: {
                        colors: ['#ffffff', '#ffffff'],
                    },
                    markers: {
                        width: 8,
                        height: 8,
                    },
                },

                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            height: '75%',
                        },
                        legend: {
                            position: 'bottom',
                            fontSize: '8px',
                            fontFamily: 'Montserrat, sans-serif',
                            fontWeight: 400,
                            labels: {
                                colors: ['#ffffff', '#ffffff'],
                            },
                        }
                    }
                }]
            };

            var chart = new ApexCharts(document.querySelector("#chart5"), options);
            chart.render();
        </script>
        {{-- Kelompok Keilmuan --}}
        <script>
            var options = {
                series: [{{ $kelilmuan->where('kel_keilmuan', 'Soft Computing')->count() }},
                    {{ $kelilmuan->where('kel_keilmuan', 'Instrumentasi')->count() }}
                ],
                chart: {
                    height: '80%',
                    type: 'pie',
                },
                labels: ['Soft Computing', 'Instrumentasi'],
                tooltip: {
                    enabled: true,
                },
                stroke: {
                    show: false,
                },
                colors: ['#353957', '#ffffff'],
                dataLabels: {
                    style: {
                        fontSize: '10px',
                        fontWeight: 'bold',
                        fontFamily: 'Montserrat, sans-serif',
                        colors: ['#ffffff', '#353957'],
                    },
                },
                plotOptions: {
                    pie: {
                        dataLabels: {
                            offset: -10,
                            minAngleToShowLabel: 10
                        },
                    },
                },
                legend: {
                    position: 'bottom',
                    fontSize: '9px',
                    fontFamily: 'Montserrat, sans-serif',
                    horizontalAlign: 'center',
                    fontWeight: 400,
                    labels: {
                        colors: ['#ffffff', '#ffffff'],
                    },
                    markers: {
                        width: 8,
                        height: 8,
                    },
                },

                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            height: '80%'
                        },
                        legend: {
                            position: 'bottom',
                            horizontalAlign: 'center',
                            fontSize: '8px',
                            fontFamily: 'Montserrat, sans-serif',
                            fontWeight: 400,
                            labels: {
                                colors: ['#ffffff', '#ffffff'],
                            },
                        }
                    }
                }]
            };

            var chart = new ApexCharts(document.querySelector("#chart6"), options);
            chart.render();
        </script>
        {{-- Predikat Kelulusan Chart --}}
        <script>
            var options = {
                series: [{
                    name: 'S1',
                    data: [{{ $s1['memuaskan'] ?? 0 }}, {{ $s1['sangat_memuaskan'] ?? 0 }},
                        {{ $s1['cumlaude'] ?? 0 }}
                    ]
                }, {
                    name: 'D3',
                    data: [{{ $d3['memuaskan'] ?? 0 }}, {{ $d3['sangat_memuaskan'] ?? 0 }},
                        {{ $d3['cumlaude'] ?? 0 }}
                    ]
                }],
                chart: {
                    height: 200,
                    type: 'bar',
                    toolbar: {
                        show: false
                    },
                },
                colors: ['#2E93fA', '#E91E63'],
                legend: {
                    position: "bottom",
                    horizontalAlign: 'center',
                    fontSize: '10px',
                    fontFamily: 'Montserrat, sans-serif',
                    fontWeight: 500,
                    labels: {
                        colors: '#ffffff',
                        useSeriesColors: false
                    },
                },
                plotOptions: {
                    bar: {
                        borderRadius: 12,
                        columnWidth: '60%',
                    }
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: 'light',
                        type: "vertical",
                        shadeIntensity: 0.5,
                        gradientToColors: ['#ffffff', '#ffffff'],
                        inverseColors: false,
                        opacityFrom: 1,
                        opacityTo: 1,
                        stops: [0, 100, 50],
                        colorStops: []
                    },
                },
                grid: {
                    borderColor: '#ffffff',
                    xaxis: {
                        lines: {
                            show: false
                        }
                    },
                    yaxis: {
                        lines: {
                            show: false
                        }
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                xaxis: {
                    categories: ["Memuaskan", "Sangat Memuaskan", "Cumlaude"],
                    labels: {
                        style: {
                            colors: ['#ffffff', '#ffffff', '#ffffff'],
                            fontSize: '9px',
                            fontFamily: 'Montserrat, sans-serif',
                            fontWeight: 500,
                        },
                    },
                    axisBorder: {
                        show: true
                    },
                    axisTicks: {
                        show: false
                    },
                },
                yaxis: {
                    min: 2.00,
                    max: 5.00,
                    tickAmount: 4,
                    decimalsInFloat: 1,
                    labels: {
                        formatter: (text) => `${parseFloat(text).toFixed(0)}`,
                        style: {
                            colors: ['#ffffff'],
                            fontSize: '9px',
                            fontFamily: 'Montserrat, sans-serif',
                            fontWeight: 400,
                        },
                    },
                },
            };

            var chart = new ApexCharts(document.querySelector("#chartCol"), options);
            chart.render();
        </script>

        {{-- Kalender --}}
        <script>
            /** full calendar */
            var calendarEl = document.getElementById('calendar');
            if (calendarEl) {
                document.addEventListener('DOMContentLoaded', function() {
                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        height: 500,
                        aspectRatio: 2,
                        locale: 'id',
                        plugins: ['dayGrid', 'timeGrid', 'list', 'bootstrap'],
                        timeZone: 'UTC',
                        themeSystem: 'bootstrap',
                        header: {
                            left: 'today, prev, next',
                            center: 'title',
                            right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                        },
                        buttonText: {
                            today: 'Hari Ini',
                            month: 'Bulan',
                            week: 'Minggu',
                            day: 'Hari',
                            list: 'Daftar'
                        },
                        allDayText: 'Sepanjang Hari',
                        noEventsMessage: 'Tidak ada acara untuk ditampilkan',
                        buttonIcons: {
                            prev: 'fe-arrow-left',
                            next: 'fe-arrow-right',
                            prevYear: 'left-double-arrow',
                            nextYear: 'right-double-arrow'
                        },
                        weekNumbers: false,
                        eventLimit: true,
                        events: [
                            @foreach ($penjadwalan as $item)
                                {
                                    title: '{{ date('H:i', strtotime($item['jam_mulai'])) }} {{ $item['jenis_kegiatan'] }} {{ $item['mahasiswa']->name }}',
                                    start: '{{ $item['tanggal_mulai'] }}',
                                    @if ($item['tanggal_selesai'])
                                        end: '{{ $item['tanggal_selesai'] }}',
                                    @endif
                                    backgroundColor: getColor('{{ $item['jenis_kegiatan'] }}'),
                                    borderColor: getColor('{{ $item['jenis_kegiatan'] }}')
                                },
                            @endforeach
                        ],
                    });
                    calendar.render();
                });

                function getColor(title) {
                    switch (title) {
                        case 'Sidang':
                            return '#1b68ff';
                        case 'Seminar':
                            return '#eea303';
                        case 'Bimbingan':
                            return '#6f42c1';
                        default:
                            return '#3ad29f';
                    }
                }
            }
        </script>
        <script>
            var hariIni = new Date();

            var hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            var namaHari = hari[hariIni.getDay()];

            var tanggal = hariIni.getDate();
            var bulans = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober',
                'November', 'Desember'
            ];
            var bulan = bulans[hariIni.getMonth()];
            var tahun = hariIni.getFullYear();

            document.getElementById('dateToday').innerHTML = namaHari + ", " + tanggal + " " + bulan + " " + tahun + ".";
        </script>

    @endsection
