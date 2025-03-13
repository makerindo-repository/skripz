@extends('layouts.template')

@section('content')
    <div class="container">
        <div class="d-flex align-items-center justify-content-between mb-5">
            <h6>List Pengumuman</h6>
            @can('akses tambah-pengumuman')
                <a href="{{ route('pengumuman.create') }}" class="btn btn-primary">Tambah Pengumuman</a>
            @endcan
        </div>
        <div class="list-group list-group-flush my-n3" id="list-pengumuman">
            @foreach ($pengumuman as $notification)
                <div class="list-group-item mb-2 shadow-smooth custom-card">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <span class="fe fe-info fe-24 text-success"></span>
                        </div>
                        <div class="col">
                            <small><strong>{{ $notification->data['title'] }}</strong></small>
                            <div class="my-0 text-muted small">{{ $notification->data['message'] }}</div>
                        </div>
                        <div class="col-auto">
                            <small class=" text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
