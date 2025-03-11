<!DOCTYPE html>
<html lang="en">
<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

<head>
    {!! SEO::generate() !!}

    @include('frontend.script.topscript')
    <style>
        body{
            font-family: 'Montserrat', sans-serif;
        }
        /*========== SCROLL UP ==========*/
        .scrollup {
            position: fixed;
            right: 1rem;
            bottom: -20%;
            opacity: .8;
            z-index: var(--z-tooltip);
            transition: .4s;
        }

        /* Show scroll */
        .show-scroll {
            bottom: 5rem;
        }

        .bg-transparent-blur {
            background-color: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .bg-transparent-blur.sticky-top {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar-nav.mx-auto {
            justify-content: center;
            width: 100%;
        }

        .nav-item {
            text-align: center;
        }

        .bg-form-kontak {
            background-color: #365486;
            border: none;
        }

        #loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: white;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-custom {
            background-color: #365486;
            color: white;
        }

        .btn-custom:hover {
            background-color: #2E7BC7;
            color: white;

        }

        .navbar-nav .nav-link.active,
        .navbar-nav .nav-link.show {
            color: #001688 !important;
        }

        .owl-carousel .item img {
            max-width: 200px;
            display: block;
            margin: auto;
            object-fit: contain;
        }
        #mitra-carousel .item img {
            max-height: 100px;
        }
        #klien-carousel .item img {
            max-height: 300px;
        }



    </style>
</head>


<body style="background-color: #DDF3FE;">
    <!-- Loading Screen -->
    {{-- <div id="loading-screen">
        <img src="{{ asset('assets/images/book.gif') }}">
    </div> --}}

    @include('frontend.partials.navbar')
    <div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-root-margin="0px 0px -40%"
        data-bs-smooth-scroll="true" class="scrollspy-example" tabindex="0">
        @include('frontend.components.beranda')
        @include('frontend.components.tentang')
        @include('frontend.components.layanan')
        {{-- @include('frontend.components.ekosistem') --}}
        @include('frontend.components.paket')
        {{-- @include('frontend.components.unduh') --}}
        {{-- @include('frontend.components.mitra') --}}
        @include('frontend.components.kontak')
        @include('frontend.partials.footer')
    </div>
    {{-- <a href="#" class="scrollup btn btn-dark btn-lg" id="scroll-up">
        <i class="bi bi-arrow-up fw-bold"></i>
    </a> --}}
    @include('frontend.script.botscript')
</body>
</html>
