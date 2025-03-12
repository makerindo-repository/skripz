@extends('layouts.template')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href=" {{ route('hasil-penilaian.index') }} ">Hasil Penilaian</a></li>
                <li class="breadcrumb-item"><a href=" {{ route('sidang.daftar') }} ">Sidang</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail</li>
            </ol>
        </nav>
        <div class="card mb-4">
            <div class="card-body">
                <h6 class="text-center font-weight-bold mb-3">Detail Hasil Penilaian Sidang</h6>
                <table class="mb-3">
                    <tr>
                        <th>Nama Mahasiswa</th>
                        <th>: {{ $mahasiswa->name }}</th>
                    </tr>
                    <tr>
                        <th>NIM</th>
                        <th>: {{ $mahasiswa->nim }}</th>
                    </tr>
                    <tr>
                        <th>Dosen Penguji</th>
                        <th>
                            :
                            @foreach ($pengujis as $penguji)
                                {{ $penguji->dosen->nama_dosen }}@if (!$loop->last)
                                    ,
                                @endif
                            @endforeach
                        </th>
                    </tr>
                </table>
                {{-- Hasil Penilaian --}}
                <div class="table-responsive">
                    <table class="table table-bordered mb-5">
                        <thead>
                            <tr>
                                <th class="text-center font-weight-bold text-dark">No</th>
                                <th colspan="2" class="text-center font-weight-bold text-dark">Aspek yang dinilai</th>
                                <th colspan="2" class="text-center font-weight-bold text-dark">Nilai</th>
                                <th class="text-center font-weight-bold text-dark">Total Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Tulisan --}}
                            <tr>
                                <th class="text-center"><b>I</b></th>
                                <th colspan="2"><b>Tulisan</b></th>
                                <th class="text-center" colspan="2"><b>{{ $tulisan->sum(fn($item) => $item->sidangs->nilai ?? 0) }}</b></th>
                                <th rowspan="{{ $tulisan->count() + 1 }}"></th>

                            </tr>
                            @foreach ($tulisan as $item)
                                <tr>
                                    <td></td>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $item->judul }}</td>
                                    <td class="text-center">{{ $item->sidangs->nilai }}</td>
                                    <td class="text-center"></td>
                                </tr>
                            @endforeach
                            {{-- Presentasi --}}
                            <tr>
                                <th class="text-center"><b>II</b></th>
                                <th colspan="2"><b>Presentasi</b></th>
                                <th class="text-center" colspan="2"><b>{{ $presentasi->sum(fn($item) => $item->sidangs->nilai ?? 0) }}</b></th>
                                <th rowspan="{{ $presentasi->count() + 1 }}"></th>
                            </tr>
                            @foreach ($presentasi as $item)
                                <tr>
                                    <td></td>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $item->judul }}</td>
                                    <td class="text-center">{{ $item->sidangs->nilai }}</td>
                                    <td class="text-center"></td>
                                </tr>
                            @endforeach
                            {{-- Penguasaan Materi --}}
                            <tr>
                                <th class="text-center"><b>III</b></th>
                                <th colspan="2"><b>Penguasaan Materi</b></th>
                                <th class="text-center" colspan="2"><b>{{ $penguasaan->sum(fn($item) => $item->sidangs->nilai ?? 0) }}</b></th>
                                <th rowspan="{{ $penguasaan->count() + 1 }}"></th>
                            </tr>
                            @foreach ($penguasaan as $item)
                                <tr>
                                    <td></td>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $item->judul }}</td>
                                    <td class="text-center">{{ $item->sidangs->nilai }}</td>
                                    <td class="text-center"></td>
                                </tr>
                            @endforeach
                            {{-- Kualitas Produk --}}
                            <tr>
                                <th class="text-center"><b>IV</b></th>
                                <th colspan="2"><b>Kualitas Produk</b></th>
                                <th class="text-center" colspan="2"><b>{{ $kualitas->sum(fn($item) => $item->sidangs->nilai ?? 0) }}</b></th>
                                <th rowspan="{{ $kualitas->count() + 1 }}"></th>
                            </tr>
                            @foreach ($kualitas as $item)
                                <tr>
                                    <td></td>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $item->judul }}</td>
                                    <td class="text-center">{{ $item->sidangs->nilai }}</td>
                                    <td class="text-center"></td>
                                </tr>
                            @endforeach

                            {{-- Total Keseluruhan --}}
                            <tr class="bg-light">
                                {{-- <th class="text-center" rowspan="5"></th> --}}
                                <th class="text-center" colspan="5">
                                    Rata Rata
                                </th>
                                <th rowspan="" class="text-center"><b>{{ number_format($rataRata, 2) }}</b></th>
                            </tr>
                            <tr class="bg-light">

                                <th class="text-center" colspan="5">
                                    Total Nilai
                                    {{-- <span class="symbol-e">∑</span> <i>Total Nilai</i> --}}
                                </th>
                                <th rowspan="" class="text-center"><b>{{ $totalNilai }}</b></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>



    </div>
@endsection
