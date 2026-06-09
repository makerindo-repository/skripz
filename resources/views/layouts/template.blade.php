<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('assets/images/SkripZ.png') }}">
    <title>SkripZ</title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/simplebar.css') }}">
    <!-- Fonts CSS -->
    <!-- <link
        href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <!-- FullCalendar CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/fullcalendar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/select2.css') }}">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/quill.snow.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap4.css') }}">

    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/app-light.css') }}" id="lightTheme">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery.signature.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.signature.css') }}">
    <script src="{{ asset('assets/js/apexcharts.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Scripts -->

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }

        th {
            color: black;
        }

        table.dataTable thead th {
            font-weight: bold;
        }

        table.dataTable thead th,
        table.dataTable tbody td {
            text-align: center;
        }

        .kartu {
            border: 1px solid black;
        }

        .symbol-e {
            font-size: 1.6rem;
            color: black;
            margin-right: 4px;
        }

        .footer {
            bottom: 0;
            width: 100%;
            text-align: right;
            padding: 10px;
        }

        input[type="file"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        img#preview {
            display: none;
            margin-top: 15px;
            max-width: 100%;
            border-radius: 4px;
        }

        label.required::after {
            content: '*';
            color: red;
        }

        .custom-hover {
            transition: all 0.1s ease;
        }

        .custom-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08);
            cursor: pointer;
        }

        .hover:hover {
            cursor: pointer;
        }

        .custom-card {
            border-radius: 10px !important;
        }

        .badge-width {
            width: 80%;
        }

        @media (max-width: 767px) {
            .footer {
                width: 100%;
                bottom: 0;
                left: 0;
            }
        }

        .kbw-signature {
            width: 60%;
            height: 100px;
        }

        .hover-white:hover {
            color: #ffffff;
            text-decoration: underline;
        }

        .horizontal .navbar-nav>.nav-item.active,
        .horizontal.hover .navbar-nav>.nav-item.active,
        .narrow.open .navbar-nav>.nav-item.active {
            position: relative;
            border-radius: 4px;
            background-color: var(--blue2);
        }

        .shadow-smooth {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08) !important;

        }

        #pengumuman-modal .modal-dialog-scrollable {
            max-height: 100%;
        }
        #pengumuman-modal .modal-dialog-scrollable .modal-content {
            max-height: 100%;
        }
    </style>
</head>

<body class="vertical  light  ">
    <div class="wrapper">
        @include('layouts.navbar')
        @include('layouts.sidebar')
        <main role="main" class="main-content">
            @yield('content')
        </main> <!-- main -->
        @include('layouts.footer')
    </div> <!-- .wrapper -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script>
    if (!$.isWindow) {
        $.isWindow = function(obj) {
            return obj != null && obj === obj.window;
        };
    }
    </script>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.stickOnScroll.js') }}"></script>
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/tinycolor-min.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <script src="{{ asset('assets/js/apps.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/calendar.js') }}"></script>
    <script src="{{ asset('assets/js/fullcalendar.js') }}"></script>
    <script src="{{ asset('assets/js/fullcalendar.custom.js') }}"></script>
    <script>
        // Mendefinisikan objek bahasa Indonesia
        var indonesianLanguage = {
            "noResults": function() {
                return "Data tidak ditemukan";
            },
            "searching": function() {
                return "Mencari...";
            }
        };

        // Mengatur bahasa Select2 menjadi bahasa Indonesia
        $.fn.select2.amd.define('select2/i18n/id', [], function() {
            return {
                errorLoading: function() {
                    return "Gagal memuat hasil";
                },
                inputTooLong: function(args) {
                    var overChars = args.input.length - args.maximum;
                    return "Hapus " + overChars + " karakter";
                },
                inputTooShort: function(args) {
                    var remainingChars = args.minimum - args.input.length;
                    return "Masukkan " + remainingChars + " atau lebih karakter";
                },
                loadingMore: function() {
                    return "Mengambil lebih banyak hasil…";
                },
                maximumSelected: function(args) {
                    return "Anda hanya dapat memilih " + args.maximum + " pilihan";
                },
                noResults: function() {
                    return "Tidak ada hasil yang cocok";
                },
                searching: function() {
                    return "Mencari…";
                }
            };
        });

        // Mengatur bahasa Select2 menjadi bahasa Indonesia
        $('.select2').select2({
            theme: 'bootstrap4',
            language: 'id' // Menggunakan kode bahasa Indonesia 'id'
        });
    </script>

    <script>
        $('.select2-multi').select2({
            multiple: true,
            theme: 'bootstrap4',
        });
    </script>
    <script>
        $('#dataTable-1').DataTable({
            // autoWidth: true,
            "responsive": true,
            // "order": false,
            "ordering": false,
            // "lengthMenu": [
            //     [16, 32, 64, -1],
            //     [16, 32, 64, "All"]
            // ],
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
            }
        });
    </script>
    <script>
        function previewImage() {
            var input = document.getElementById('imageInput');
            var preview = document.getElementById('preview');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function previewImages() {
            var input = document.getElementById('imageInputs');
            var preview = document.getElementById('previews');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script>
        function deleteActivity(id) {
            event.preventDefault();

            const formId = `Hapus${id}`;
            const form = document.getElementById(formId);

            Swal.fire({
                title: 'Apakah Anda Yakin ?',
                text: 'Data Akan Terhapus Secara Permanen!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#2E93fA',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal',
                reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    </script>
    <script>
        function Logout() {
            event.preventDefault();
            const Logout = document.getElementById('logout-form');

            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Anda akan keluar dari akun ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#2E93fA',
                confirmButtonText: 'Keluar',
                cancelButtonText: 'Batal',
                reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#logout-form').submit();
                }
            });

        }
    </script>
    <script>
        function Notif() {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Data yang memiliki data sub tidak bisa dihapus!'
            });
        }
        @if (session()->has('fail'))
            Notif();
        @endif
    </script>
    <script>
        function hanyaAngka(event) {
            var angka = (event.which) ? event.which : event.keyCode
            if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
                return false;
            return true;
        }

        function limitDigit(event, value) {
            const maxDigits = value;

            const input = event.target;
            const inputValue = input.value.toString().replace(/\D/g, ''); // Menghapus karakter non-digit

            // Batasi panjang input menjadi maxDigits
            if (inputValue.length > maxDigits) {
                input.value = inputValue.slice(0, maxDigits);
            }
        }
    </script>
</body>

</html>
