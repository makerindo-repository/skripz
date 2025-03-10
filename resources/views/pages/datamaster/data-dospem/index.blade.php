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
                <div class="row">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href=" {{ route('datamaster.index') }} ">Data Induk</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Dosen Pembimbing</li>
                        </ol>
                    </nav>
                    <div class="col-md-12">
                        <div class="card shadow-smooth custom-card">
                            <div class="card-body">
                                @can('akses tambah-dospem')
                                    <button class="btn mb-0 btn-primary float-right mb-3" type="button" data-toggle="modal"
                                        data-target="#createModal" data-whatever="@mdo">
                                        Tambah <span class="fe fe-plus fe-15"></span>
                                    </button>
                                @endcan
                                <div class="table-responsive">
                                    <table class="table dataTables" id="dataTable-1">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Bidang Keahlian</th>
                                                <th>NIP</th>
                                                <th>Email Dosen</th>
                                                <th>No Telepon</th>
                                                <th>Pembimbing Program Study</th>
                                                <th>Status</th>
                                                <th>Foto</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dospem as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->dosen->nama_dosen }}</td>
                                                    <td>
                                                        @foreach (json_decode($item->dosen->bidang_keahlian ) ?? [] as $bidkeahlian)
                                                            {{ $bidkeahlian }},
                                                        @endforeach
                                                    </td>
                                                    <td>{{ $item->dosen->nip_dosen }}</td>
                                                    <td>{{ $item->dosen->email }}</td>
                                                    <td>{{ $item->dosen->no_telepon }}</td>
                                                    <td>Mahasiswa {{ $item->program_study }}</td>
                                                    <td><span
                                                            class="badge rounded-pill bg-lightdark mr-2 badge-width">{{ $item->dosen->status_dosen }}
                                                            <span class="dot dot-md bg-success"></span></span></td>
                                                    <td>
                                                        <div class="avatar avatar-sm">
                                                            <img alt="..." class="avatar-img rounded-circle"
                                                                src="{{ asset($item->dosen->foto) }}">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('dosen-pembimbing.destroy', $item->id) }}"
                                                            method="POST" id="Hapus{{ $item->id }}">
                                                            @method('DELETE')
                                                            @csrf
                                                            @can('akses hapus-dospem')
                                                                <button class="btn btn-outline-danger" type="submit"
                                                                    id="Hapus"
                                                                    onclick="deleteActivity({{ $item->id }})"><i
                                                                        class="fe fe-trash fe-12"></i></button>
                                                            @endcan
                                                            @can('akses edit-dospem')
                                                                <button class="btn btn-outline-primary" data-toggle="modal"
                                                                    data-target="#editModal{{ $item->id }}"
                                                                    data-whatever="@mdo" type="button"><i
                                                                        class="fe fe-edit-3 fe-12"></i></button>
                                                            @endcan
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
    @include('pages.datamaster.data-dospem.create')
    @include('pages.datamaster.data-dospem.edit')
@endsection
