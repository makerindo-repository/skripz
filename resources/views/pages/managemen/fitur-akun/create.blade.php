<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="createModalLabel">Tambah Fitur</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('fitur.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" class="required">{{ __('Nama Fitur') }}</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="key" class="required">{{ __('Key') }}</label>
                        <input id="key" type="text" class="form-control @error('key') is-invalid @enderror"
                            name="key" value="{{ old('key') }}" required autocomplete="key" autofocus>
                        @error('key')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn mb-2 btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn mb-2 btn-primary">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>
