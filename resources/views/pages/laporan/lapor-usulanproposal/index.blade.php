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
                            <li class="breadcrumb-item active" aria-current="page">Laporan Usulan Proposal</li>
                        </ol>
                    </nav>
                    <div class="col-md-12">
                        <div class="card shadow-smooth custom-card">
                            <div class="card-body">
                                @if (auth()->user()->plan && auth()->user()->plan->hasFeature('submission_proposal'))
                                    <i class="small text-danger">{{ '*Maksimal ' . auth()->user()->plan->getFeatureLimit('submission_proposal') . ' proposal dapat diunggah' }}
                                    </i>
                                @endif
                                @can('akses tambah-laporan-usulan-proposal')
                                    <button class="btn btn-primary float-right mb-3" type="button" data-toggle="modal"
                                        data-target="#createModal" data-whatever="@mdo">Upload <i
                                            class="fe fe-upload fe-12 text-white"></i></button>
                                @endcan
                                @if (Auth::user()->role_id == 2)
                                    <form action="{{ route('updateStatusProposal.update') }}" method="POST">
                                        @csrf
                                        @method('PATCH')

                                        <div class="toolbar row mb-3">
                                            <div class="col ml-auto">
                                                <div class="dropdown float-right">
                                                    <button class="btn btn-primary float-right ml-3"
                                                        type="submit">Simpan</button>
                                                </div>
                                            </div>
                                        </div>
                                @endif
                                <div class="table-responsive">
                                    <table class="table dataTables" id="dataTable-1">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Mahasiswa</th>
                                                <th>Nama Pembimbing</th>
                                                <th>Judul Proposal</th>
                                                <th>Bidang Kajian</th>
                                                <th>File Laporan</th>
                                                <th>Tanggal Pengajuan</th>
                                                <th>Status Laporan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($proposal as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->mahasiswa->name }}</td>
                                                    <td>{{ $item->dospem->dosen->nama_dosen }}</td>
                                                    <td>{{ $item->judul_proposal }}</td>
                                                    <td>{{ $item->bidang_kajian }}</td>
                                                    <td><a href="{{ asset($item->file_laporan) }}" target="_blank">Lihat
                                                            File</a></td>
                                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_pengajuan)->locale('id')->translatedFormat('d F Y') }}
                                                    </td>
                                                    <td>
                                                        @if (Auth::user()->role_id == 2)
                                                            <input type="hidden"
                                                                name="judul_proposal[{{ $item->id }}][id]"
                                                                value="{{ $item->id }}">
                                                            <select
                                                                name="judul_proposal[{{ $item->id }}][status_laporan]"
                                                                class="form-control form-control-sm"
                                                                id="judul_proposal[{{ $item->id }}][status_laporan]">
                                                                <option value="Diajukan"
                                                                    @if ($item->status_laporan == 'Diajukan') selected @endif>
                                                                    Diajukan</option>
                                                                <option value="Disetujui"
                                                                    @if ($item->status_laporan == 'Disetujui') selected @endif>
                                                                    Disetujui</option>
                                                                <option value="Ditolak"
                                                                    @if ($item->status_laporan == 'Ditolak') selected @endif>
                                                                    Ditolak</option>
                                                            </select>
                                                            </form>
                                                        @else
                                                            <span
                                                                class="badge rounded-pill bg-lightdark mr-2 badge-width">{{ $item->status_laporan }}
                                                                <span
                                                                    class="dot dot-md
                                                                        @if ($item->status_laporan == 'Disetujui') bg-success
                                                                        @elseif($item->status_laporan == 'Ditolak') bg-danger
                                                                        @elseif($item->status_laporan == 'Diajukan') bg-warning @endif"></span></span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <form
                                                            action="{{ route('laporan-usulan-proposal.destroy', $item->id) }}"
                                                            method="POST" id="Hapus{{ $item->id }}">
                                                            @method('DELETE')
                                                            @csrf
                                                            @can('akses hapus-laporan-usulan-proposal')
                                                                <button class="btn btn-outline-danger" type="submit"
                                                                    id="Hapus"
                                                                    onclick="deleteActivity({{ $item->id }})"><i
                                                                        class="fe fe-trash fe-12"></i></button>
                                                            @endcan
                                                            @can('akses edit-laporan-usulan-proposal')
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
    </div>
    @include('pages.laporan.lapor-usulanproposal.create')
    @include('pages.laporan.lapor-usulanproposal.edit')
@endsection
