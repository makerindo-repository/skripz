@foreach ($fiturs as $fitur)
    <div class="modal fade" id="editModal{{ $fitur->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="editModalLabel">Edit Fitur</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('fitur.update', $fitur->id) }}">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name" class="required">{{ __('Nama Fitur') }}</label>
                            <input id="name" type="text"
                                class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ $fitur->name }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="key" class="required">{{ __('Key') }}</label>
                            <input id="key" type="text" class="form-control @error('key') is-invalid @enderror"
                                name="key" value="{{ $fitur->key }}" required autocomplete="key" autofocus>
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
@endforeach
