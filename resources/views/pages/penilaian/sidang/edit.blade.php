@extends('layouts.template')

@section('content')
    <div class="container-fluid">
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
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href=" {{ route('penilaian.index') }} ">Penilaian</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Penilaian Sidang</li>
                        </ol>
                    </nav>
                    <!-- Striped rows -->
                    <div class="col-md-12">
                        <div class="card shadow-smooth custom-card">
                            <div class="card-body">
                                <h6 class="card-title mb-3">Form Penilaian Mahasiswa Sidang</h6>
                                <form action="{{ route('sidang.store') }}" method="POST">
                                    @csrf
                                    {{-- @method('Patch') --}}
                                    <div class="row mb-2">
                                        <div class="col-md-6 mb-2">
                                            <label for="mahasiswa_id" class="required">Mahasiswa</label>
                                            <select name="mahasiswa_id" id="mahasiswa_id" class="form-control select2"
                                                required>
                                                @foreach ($mahasiswa as $data)
                                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label for="dosen_id" class="required">Dosen Penguji</label>
                                            <select name="dosen_id[]" id="dosen_id" class="form-control select2-multi"
                                                multiple required>
                                                @foreach ($dosen as $data)
                                                    <option value="{{ $data->id }}">{{ $data->nama_dosen }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <div class="table-responsive mb-3">
                                                <table class="table table-bordered table-hover mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center font-weight-bold col-1">No</th>
                                                            <th class="text-center font-weight-bold">Aspek Yang Di
                                                                Nilai</th>
                                                            <th class="text-center font-weight-bold">Kategori</th>
                                                            <th class="text-center font-weight-bold col-1">Nilai
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($penilaian as $item)
                                                            <tr>
                                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                                <td><input type="hidden"
                                                                        name="penilaian_id[{{ $item->id }}][id]"
                                                                        value="{{ $item->id }}">
                                                                    {{ $item->judul }}
                                                                </td>
                                                                <td class="text-center">{{ $item->grup }}</td>

                                                                <td><input type="number" min="0" max="5"
                                                                        class="form-control form-control-sm"
                                                                        name="nilai[{{ $item->id }}][nilai]"
                                                                        value="{{ $item->nilai }}" required></td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <button type="submit" class="btn btn-primary float-right">Simpan</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div> <!-- simple table -->
                </div> <!-- end section -->
            </div>
        </div>
    </div>
@endsection
