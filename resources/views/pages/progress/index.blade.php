@extends('layouts.template')
@section('content')
    <div class="container-fluid" id="app">
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
                <div class="card shadow-smooth custom-card">
                    <div class="card-header">
                        <strong>
                            Progres Mahasiswa
                        </strong>
                    </div>
                    <div class="card-body">
                        <kanban-board :initial-data='@json($tasks)'></kanban-board>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('pages.progress.create')
    <script>
        // Safely wrap stickOnScroll to prevent errors with Vue components
        $(document).ready(function() {
            try {
                var $infoContent = $(".info-content");
                if ($infoContent.length > 0) {
                    $infoContent.stickOnScroll({topOffset:0,setWidthOnStick:true});
                }
            } catch (e) {
                console.warn('StickOnScroll initialization failed:', e);
            }
        });
    </script>
@endsection
