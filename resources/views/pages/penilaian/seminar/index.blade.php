@extends('layouts.template')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href=" {{ route('hasil-penilaian.index') }} ">Hasil Penilaian</a></li>
            <li class="breadcrumb-item active" aria-current="page">Seminar</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-body">
            <h6 class="mb-4">Daftar Hasil Penilaian Seminar</h6>
            <div class="table-responsive">
                <table class="table datatables dataTable" id="dataTable-1">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">No</th>
                            <th>Nama Mahasiswa</th>
                            <th class="text-center">Total Nilai</th>
                            <th class="text-center">Rata-rata Nilai</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($seminars as $key => $seminar)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $seminar->mahasiswa->name }}</td>
                                <td class="text-center">{{ $seminar->total_nilai }}</td>
                                <td class="text-center">{{ number_format($seminar->rata_nilai, 2) }}</td>
                                <td class="text-center">
                                    <a href="{{ route('seminar.hasil', $seminar->mahasiswa_id) }}" class="btn btn-info btn-sm">
                                        Lihat Detail
                                    </a>
                                    {{-- <a href="{{ route('sidang.hasil', $sidang->mahasiswa_id) }}" class="btn btn-info btn-sm">
                                        Edit Nilai
                                    </a> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
