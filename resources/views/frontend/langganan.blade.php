<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.script.topscript')
    <style>
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

        .bg-gradient-beranda {
            background: linear-gradient(to right, #2E7AC6 0%, #ffffff 100%);
        }

        .bg-gradient-tentang {
            background: linear-gradient(to left, #2E7AC6 0%, #ffffff 100%);
        }

        .bg-ekosistem {
            background: #DDF3FE;
        }

        .bg-unduh {
            background: #337DC8;
        }

        .btn-custom {
            background-color: #365486;
            color: white;
        }

        .btn-custom:hover {
            background-color: #2E7BC2;
            color: white;

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

        .navbar-nav .nav-link.active,
        .navbar-nav .nav-link.show {
            color: #001688 !important;
        }

        .custom-card {
            border-radius: 10px !important;
        }

        .shadow-smooth {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08) !important;

        }

        #list-fitur ul {
            list-style: none;
            padding-left: 0;
        }

        #list-fitur ul li {
            position: relative;
            padding-left: 25px;
            margin-bottom: 0.6rem;
        }

        #list-fitur ul li::before {
            content: url('data:image/svg+xml,%3Csvg xmlns%3D%22http%3A//www.w3.org/2000/svg%22 width%3D%2216%22 height%3D%2216%22 fill%3D%22%23007E00%22 class%3D%22bi bi-check-circle%22 viewBox%3D%220 0 16 16%22%3E%3Cpath d%3D%22M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16%22/%3E%3Cpath d%3D%22m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05%22/%3E%3C/svg%3E');
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 16px;
            height: 16px;
        }

        .text-blueblack {
            color: #001688 !important;
        }
    </style>
</head>


<body style="background-color: #DDF3FE;">
    <!-- Loading Screen -->
    <div id="loading-screen">
        <img src="{{ asset('assets/images/book.gif') }}">
    </div>

    <div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-root-margin="0px 0px -40%"
        data-bs-smooth-scroll="true" class="scrollspy-example" tabindex="0">
        <div class="container my-5 d-flex align-items-center" style="min-height: 90vh">
            <div class="row w-100">
                <div class="col-md-8 mb-3">
                    <div class="card shadow-smooth custom-card">
                        <div class="card-body p-4">
                            <h4 class="fw-bold text-blueblack">{{ $paket->jenis }} {{ $paket->kategori }}</h4>
                            <h4 class="fw-bold text-blueblack mb-3">Rp {{ number_format($paket->harga, 0, ',', '.') }} /
                                {{ $paket->duration }}</h4>
                            <div id="list-fitur" class="text-blueblack fw-bold">
                                {!! $paket->fitur !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card shadow-smooth custom-card">
                        <div class="card-body p-4">
                            <h5 class="fw-bold text-blueblack">Detail Pembayaran</h5>
                            <h6 class="mb-3 fst-italic text-blueblack">Paket {{ $paket->jenis }} {{ $paket->kategori }}
                                {{ $paket->duration }}</h6>
                            <form id="langganan">
                                <ul class="list-group list-group-flush mb-3">
                                    <input type="hidden" value="{{ $paket->id }}" name="paket_id">
                                    <input type="hidden" value="{{ $paket->id }}" id="total_harga"
                                        name="total_harga">
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center fw-bold text-blueblack">
                                        Jumlah Akun
                                        <div class="d-flex align-items-center">
                                            <a class="btn btn-sm btn-dark" id="decreaseBtn">
                                                <i class="bi bi-dash"></i>
                                            </a>
                                            <input type="hidden" id="jumlah" value="1">
                                            <span id="counter" style="width: 60px;" class="text-center">1</span>
                                            <a class="btn btn-sm btn-dark" id="increaseBtn">
                                                <i class="bi bi-plus"></i>
                                            </a>
                                        </div>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center fw-bold text-blueblack">
                                        Sub Total
                                        <span class="fw-bold text-blueblack">Rp <span
                                                id="subTotal">{{ number_format($paket->harga) }}</span></span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center fw-bold text-blueblack">
                                        PPN (11%)
                                        <span class="fw-bold text-blueblack">Rp <span
                                                id="ppn">{{ number_format($ppn) }}</span></span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center fw-bold text-blueblack">
                                        Total Harga
                                        <span class="fw-bold text-blueblack">Rp <span
                                                id="totalHarga">{{ number_format($totalHarga) }}</span></span>
                                    </li>
                                </ul>
                                <div class="d-grid gap-2">
                                    <button class="btn btn-custom btn-lg fw-bold" id="pay-button" type="submit">Lanjutkan</button>
                                    <a class="btn btn-danger btn-lg fw-bold" href="{{ url('/') }}">Kembali</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <a href="#" class="scrollup btn btn-dark btn-lg" id="scroll-up">
        <i class="bi bi-arrow-up fw-bold"></i>
    </a> --}}
    @include('frontend.script.botscript')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}">
    </script>
    {{-- <script type="text/javascript">
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    Swal.fire({
                        title: "Pembayaran Sukses!",
                        icon: "success"
                    });
                },
                onPending: function(result) {
                    Swal.fire({
                        title: "Pembayaran Tertunda!",
                        icon: "warning"
                    });
                },
                onError: function(result) {
                    Swal.fire({
                        title: "Pembayaran Gagal!",
                        icon: "error"
                    });
                }
            });
        });
    </script> --}}
    <script>
        // Ambil elemen yang diperlukan
        const harga = {{ $paket->harga }};
        const jumlahInput = document.getElementById('jumlah');
        const totalInput = document.getElementById('total_harga');
        const counter = document.getElementById('counter');
        const subTotalElement = document.getElementById('subTotal');
        const totalHargaElement = document.getElementById('totalHarga');
        const ppnElement = document.getElementById('ppn');
        const increaseBtn = document.getElementById('increaseBtn');
        const decreaseBtn = document.getElementById('decreaseBtn');
        const payButton = document.getElementById('pay-button');

        // Fungsi untuk memperbarui total harga
        function updateTotalHarga() {
            const jumlah = parseInt(jumlahInput.value) || 1; // Default ke 1 jika kosong
            const subTotal = harga * jumlah;
            const ppn = subTotal * 0.11; // 11% dari Sub Total
            const totalHarga = subTotal + ppn;

            // Perbarui elemen tampilan
            counter.textContent = jumlah;
            subTotalElement.textContent = new Intl.NumberFormat().format(subTotal);
            ppnElement.textContent = new Intl.NumberFormat().format(ppn);
            totalHargaElement.textContent = new Intl.NumberFormat().format(totalHarga);

            // Perbarui nilai hidden input total harga
            totalInput.value = totalHarga;
        }

        // Event listener untuk tombol penambahan
        increaseBtn.addEventListener('click', () => {
            jumlahInput.value = parseInt(jumlahInput.value) + 1;
            updateTotalHarga();
        });

        // Event listener untuk tombol pengurangan
        decreaseBtn.addEventListener('click', () => {
            if (parseInt(jumlahInput.value) > 1) { // Cegah nilai kurang dari 1
                jumlahInput.value = parseInt(jumlahInput.value) - 1;
                updateTotalHarga();
            }
        });

        // Event listener untuk perubahan nilai input
        jumlahInput.addEventListener('input', updateTotalHarga);

        // Inisialisasi tampilan awal
        updateTotalHarga();

        // Event listener untuk form submit
        $(document).ready(function () {
            $('#langganan').on('submit', function (e) {
                e.preventDefault(); // Mencegah form submit default

                // Ambil data dari form
                let formData = {
                    _token: '{{ csrf_token() }}', // Token CSRF Laravel
                    paket_id: $('input[name="paket_id"]').val(),
                    jumlah: $('#jumlah').val(),
                    total_harga: $('#total_harga').val()
                };

                // Kirim data menggunakan AJAX
                $.ajax({
                    url: '{{ route('generate.snapToken') }}', // Ganti dengan URL endpoint pembayaran
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    success: function (response) {
                        if (response.snapToken) {
                            // Integrasi Midtrans Snap:
                            window.snap.pay(response.snapToken, {
                                onSuccess: function (result) {
                                    alert("Pembayaran berhasil!");
                                    // location.reload(); // Reload halaman atau arahkan ke halaman lain
                                },
                                onPending: function (result) {
                                    alert("Pembayaran menunggu konfirmasi.");
                                },
                                onError: function (result) {
                                    alert("Terjadi kesalahan dalam pembayaran.");
                                },
                                onClose: function () {
                                    alert("Pembayaran dibatalkan.");
                                }
                            });
                        }
                    },
                    error: function (xhr) {
                        let errorMsg = xhr.responseJSON?.message || "Terjadi kesalahan, coba lagi.";
                        alert(errorMsg);
                    }
                });
            });
        });
    </script>

</body>

</html>
