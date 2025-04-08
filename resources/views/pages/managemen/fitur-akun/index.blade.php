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
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        {{-- <li class="breadcrumb-item"><a href=" {{ route('management.index') }} ">Fitur</a></li> --}}
                        {{-- <li class="breadcrumb-item active" aria-current="page">Fitur</li> --}}
                    </ol>
                </nav>
                <div class="card shadow-smooth custom-card">
                    <div class="card-body">
                        {{-- @can('akses tambah-fitur') --}}
                        <button class="btn mb-0 btn-primary float-right mb-3" type="button" data-toggle="modal"
                            data-target="#createModal" data-whatever="@mdo">
                            Tambah <span class="fe fe-plus fe-15"></span>
                        </button>
                        {{-- @endcan --}}
                        <div class="table-responsive">
                            <table class="table dataTables" id="dataTable-1">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Jenis Akun</th>
                                        <th>Fitur</th>
                                        <th>Limit</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fiturAkuns as $fitur)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $fitur->akunStatus->name }}</td>
                                            <td>{{ $fitur->fitur->name }}</td>
                                            <td>{{ $fitur->limit }}</td>
                                            <td class="text-center">
                                                <form action="{{ route('fitur.destroy', $fitur->id) }}" method="POST"
                                                    id="Hapus{{ $fitur->id }}">
                                                    @method('DELETE')
                                                    @csrf
                                                    {{-- @can('akses hapus-fitur') --}}
                                                        <button class="btn btn-outline-danger" type="submit" id="Hapus"
                                                            onclick="deleteActivity({{ $fitur->id }})"><i
                                                                class="fe fe-trash fe-12"></i></button>
                                                    {{-- @endcan --}}
                                                    {{-- @can('akses edit-fitur') --}}
                                                        <button class="btn btn-outline-primary" type="button"
                                                            data-toggle="modal" data-target="#editModal{{ $fitur->id }}"
                                                            data-whatever="@mdo"><i class="fe fe-edit fe-12"></i></button>
                                                    {{-- @endcan --}}
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
    @include('pages.managemen.fitur-akun.create')
    {{-- @include('pages.managemen.fitur-akun.edit') --}}
@endsection
