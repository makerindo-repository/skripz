<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="createModalLabel">Tambah Data Kaprodi</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('kaprodi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" value="2" name="role_id">

                    <div class="form-group">
                        <label for="name" class="required">Nama Lengkap</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                            class="form-control form-control-lg @error('name') is-invalid @enderror" required>
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="jenis_kelamin" class="required">Jenis Kelamin</label>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio1" name="jenis_kelamin" class="custom-control-input"
                                value="Laki-Laki" required>
                            <label class="custom-control-label" for="customRadio1">Laki-Laki</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio2" name="jenis_kelamin" class="custom-control-input"
                                value="Perempuan" required>
                            <label class="custom-control-label" for="customRadio2">Perempuan</label>
                        </div>
                        @error('jenis_kelamin')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nip_kaprodi" class="required">NIP</label>
                        <input type="text" id="nip_kaprodi" name="nip_kaprodi" value="{{ old('nip_kaprodi') }}"
                            class="form-control form-control-lg @error('nip_kaprodi') is-invalid @enderror" required>
                        @error('nip_kaprodi')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email" class="required">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            class="form-control form-control-lg @error('email') is-invalid @enderror" required>
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="no_telepon" class="required">Nomor Telpon</label>
                        <input type="text" id="no_telepon" name="no_telepon" value="{{ old('no_telepon') }}"
                            class="form-control form-control-lg @error('no_telepon') is-invalid @enderror" required>
                        @error('no_telepon')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <?php use App\Models\PerguruanTinggi; ?>
                    <div class="form-group">
                        <label for="pt_id">Perguruan Tinggi</label>
                        <select id="simple-select2" name="pts_id"
                            class="form-control select2 @error('pts_id') is-invalid @enderror">
                            <option value="">-- Pilih Perguruan Tinggi --</option>
                            @foreach (PerguruanTinggi::all() as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('pts_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama_perguruan_tinggi }}
                                </option>
                            @endforeach
                        </select>
                        @error('pts_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="profile-picture-input" class="required">Foto</label>
                        <p class="text-muted"><small>Ukuran gambar maksimum: 2MB. Format gambar yang
                                diizinkan: JPG, JPEG, PNG.</small></p>
                        <input type="file" name="foto" id="profile-picture-input" class="form-control-file"
                            accept="image/*" onchange="previewProfilePicture()" required>
                        <br>
                        <div class="profile-picture-container">
                            <img id="profile-picture-preview" src="{{ asset('assets/images/Profiledefault.png') }}"
                                alt="Profile Picture" height="100" width="100"style="display: none;">
                        </div>
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
