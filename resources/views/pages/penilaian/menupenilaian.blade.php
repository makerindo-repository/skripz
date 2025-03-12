@extends('layouts.template')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h5 class="mb-4">Hasil Penilaian</h5>
                <div class="row mb-4">
                    {{-- @can('akses penilaian-sidang') --}}
                        <div class="col-md-3 mb-4">
                            <a class="hover-white" href="{{ route('sidang.daftar') }}">
                                <div class="card shadow-smooth bg-white custom-hover custom-card">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <i class="fe bi-clipboard-data-fill fe-22 text-blueblack"></i>
                                        </div>
                                        <h6 class="text-blueblack h6">Hasil Penilaian Sidang</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    {{-- @endcan
                    @can('akses penilaian-sidang') --}}
                        <div class="col-md-3 mb-4">
                            <a class="hover-white" href="{{ route('seminar.daftar') }}">
                                <div class="card shadow-smooth bg-white custom-hover custom-card">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <i class="fe bi-clipboard-data-fill fe-22 text-blueblack"></i>
                                        </div>
                                        <h6 class="text-blueblack h6">Hasil Penilaian Seminar</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    {{-- @endcan --}}
                </div>
            </div>
        </div>
    </div>
@endsection
