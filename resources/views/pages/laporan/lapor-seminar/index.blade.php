@extends('layouts.template')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                {{-- Error Validation --}}
                <x-error-validation-message errors="$errors" />

                {{-- Alert Message --}}
                @if (session()->has('success'))
                    <div class="row">
                        <div class="col-md-12">
                            <x-success-message action="{{ session()->get('success') }}" />
                        </div>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="row">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href=" {{ route('laporan.index') }} ">Laporan</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Laporan Kemajuan Seminar</li>
                        </ol>
                    </nav>
                    <div class="col-md-12">
                        <div class="card shadow-smooth custom-card">
                            <div class="card-body">
                                @if (auth()->user()->plan && auth()->user()->plan->hasFeature('progress_report'))
                                <i class="small text-danger">{{ '*Maksimal ' . auth()->user()->plan->getFeatureLimit('progress_report') . ' proposal dapat diunggah' }}
                                </i>
                            @endif
                                @can('akses tambah-laporan-kemajuan-seminar')
                                    <button class="btn btn-primary float-right mb-3" type="button" data-toggle="modal"
                                        data-target="#createModal" data-whatever="@mdo">Upload <i
                                            class="fe fe-upload fe-12 text-white"></i></button>
                                @endcan
                                <div class="table-responsive">
                                    <table class="table dataTables" id="dataTable-1">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Mahasiswa</th>
                                                <th>Nama Dosen Penguji</th>
                                                <th>Tanggal Seminar</th>
                                                <th>Hasil Seminar</th>
                                                <th>Saran Penguji</th>
                                                <th>Catatan Mahasiswa</th>
                                                {{-- <th>File Laporan</th> --}}
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($seminar as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->mahasiswa->name }}</td>
                                                    <td>{{ $item->dospeng->dosen->nama_dosen }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_seminar)->locale('id')->translatedFormat('d F Y') }}
                                                    </td>
                                                    <td>{{ $item->hasil_seminar }}</td>
                                                    <td>{{ $item->saran_penguji }}</td>
                                                    <td>{{ $item->catatan_mahasiswa }}</td>
                                                    {{-- <td><a href="{{ asset($item->file_laporan) }}" target="_blank">Lihat
                                                            File</a></td> --}}
                                                    <td>
                                                        <form
                                                            action="{{ route('laporan-kemajuan-seminar.destroy', $item->id) }}"
                                                            method="POST" id="Hapus{{ $item->id }}">
                                                            @method('DELETE')
                                                            @csrf
                                                            @can('akses hapus-laporan-kemajuan-seminar')
                                                                <button class="btn btn-outline-danger" type="submit"
                                                                    id="Hapus"
                                                                    onclick="deleteActivity({{ $item->id }})"><i
                                                                        class="fe fe-trash fe-12"></i></button>
                                                            @endcan
                                                            @can('akses edit-laporan-kemajuan-seminar')
                                                                <button class="btn btn-outline-primary" data-toggle="modal"
                                                                    data-target="#editModal{{ $item->id }}"
                                                                    data-whatever="@mdo" type="button"><i
                                                                        class="fe fe-edit-3 fe-12"></i></button>
                                                            @endcan
                                                            <a class="btn btn-outline-secondary" type="button"
                                                                href="{{ asset($item->file_laporan) }}" download> <i
                                                                    class="fe fe-download fe-12"></i></a>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
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
    @include('pages.laporan.lapor-seminar.create')
    @include('pages.laporan.lapor-seminar.edit')
@endsection
