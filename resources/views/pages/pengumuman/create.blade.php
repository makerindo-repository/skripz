@extends('layouts.template')

@section('content')
    <div class="container">
        <div class="card mb-5 shadow-smooth custom-card">
            <div class="card-body">
                <h6 class="mb-3">Buat Pengumuman</h6>
                <form id="pengumuman-form">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul Pengumuman</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Isi Pengumuman</label>
                        <textarea class="form-control" id="message" name="message" rows="6" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" id="submit-button-pengumuman">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"
                            style="display: none;"></span>
                        Kirim
                    </button>
                </form>
            </div>
        </div>
    </div>
    <script>
        $('#pengumuman-form').on('submit', function(e) {
            e.preventDefault();
            let pengumumanButton = $('#submit-button-pengumuman');
            let spinner = $('.spinner-border');

            pengumumanButton.prop('disabled', true);
            spinner.show();
            let formData = new FormData(this);

            $.ajax({
                url: '{{ route('pengumuman.send') }}', // Ensure the correct route name
                method: 'POST',
                data: formData,
                processData: false, // Prevent jQuery from automatically processing the data
                contentType: false, // Prevent jQuery from setting content-type header
                success: function(response) {
                    $('#pengumuman-form').trigger('reset');
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500,
                        toast: true,
                    }).then(() => {
                        window.location.href = '{{ route('pengumuman.index') }}';
                    });
                    pengumumanButton.prop('disabled', false);
                    spinner.hide();
                    window.location.href = '{{ route('pengumuman.index') }}';
                },
                error: function(err) {
                    pengumumanButton.prop('disabled', false);
                    spinner.hide();
                    alert('Terjadi kesalahan!');
                }
            });
        });
    </script>
@endsection
