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
                            <li class="breadcrumb-item active" aria-current="page">Data Kaprodi</li>
                        </ol>
                    </nav>
                    <div class="col-md-12">
                        <div class="card shadow-smooth custom-card">
                            <div class="card-body">
                                @can('akses tambah-kaprodi')
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
                                                <th>Foto</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($kaprodi as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <div class="avatar avatar-sm">
                                                            <img alt="foto{{ $item->id }}"
                                                                class="avatar-img rounded-circle"
                                                                src="{{ asset($item->foto) }}">
                                                        </div>
                                                    </td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->email }}</td>
                                                    <td class="text-center">
                                                        <form action="{{ route('kaprodi.destroy', $item->id) }}"
                                                            method="POST" id="Hapus{{ $item->id }}">
                                                            @method('DELETE')
                                                            @csrf
                                                            @can('akses hapus-kaprodi')
                                                                <button class="btn btn-outline-danger" type="submit"
                                                                    id="Hapus"
                                                                    onclick="deleteActivity({{ $item->id }})"><i
                                                                        class="fe fe-trash fe-12"></i></button>
                                                            @endcan
                                                            @can('akses edit-kaprodi')
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
    @include('pages.datamaster.data-kaprodi.create')
    @include('pages.datamaster.data-kaprodi.edit')
    <script>
        // Fungsi untuk memeriksa apakah input file kosong dan menampilkan gambar default jika ya
        window.onload = function() {
            var input = document.getElementById('profile-picture-input');
            var preview = document.getElementById('profile-picture-preview');

            if (!input.value) {
                preview.src = "{{ asset('assets/images/Profiledefault.png') }}";
            }
        }

        // Fungsi untuk memperbarui pratinjau gambar saat gambar baru dipilih
        function previewProfilePicture() {
            var input = document.getElementById('profile-picture-input');
            var preview = document.getElementById('profile-picture-preview');

            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = "{{ asset('assets/images/Profiledefault.png') }}";
            }
        }
    </script>
@endsection
