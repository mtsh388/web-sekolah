@extends('admin.template.admin')

@section('title', 'Edit Sejarah Sekolah')

@section('content-admin')

    <div class="container-fluid mt-3">

        {{-- HEADER --}}
        <div class="mb-4">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <h4 class="fw-bold mb-1">
                        Edit Sejarah Sekolah
                    </h4>

                    <p class="text-muted mb-0">
                        Perbarui informasi sejarah sekolah.
                    </p>

                </div>

                <a href="{{ route('admin.profile.sejarah.index') }}"
                   class="btn btn-light border">

                    <i class="fa-solid fa-arrow-left me-1"></i>

                    Kembali

                </a>

            </div>

        </div>


        {{-- ERROR --}}
        @if($errors->any())

            <div class="alert alert-danger">

                <strong>
                    Terdapat kesalahan:
                </strong>

                <ul class="mb-0 mt-2">

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        <form action="{{ route('admin.profile.sejarah.update', $sejarah->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')


            <div class="row g-4">

                {{-- MAIN --}}
                <div class="col-lg-8">

                    <div class="card border-0 shadow-sm">

                        <div class="card-header bg-white">

                            <h5 class="fw-bold mb-0">
                                Informasi Sejarah
                            </h5>

                        </div>

                        <div class="card-body">

                            {{-- JUDUL --}}
                            <div class="mb-3">

                                <label class="form-label fw-semibold">

                                    Judul

                                    <span class="text-danger">
                                        *
                                    </span>

                                </label>

                                <input type="text"
                                       name="judul"
                                       class="form-control @error('judul') is-invalid @enderror"
                                       value="{{ old('judul', $sejarah->judul) }}"
                                       required>

                                @error('judul')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                                @enderror

                            </div>


                            {{-- DESKRIPSI --}}
                            <div class="mb-3">

                                <label class="form-label fw-semibold">

                                    Deskripsi Sejarah

                                    <span class="text-danger">
                                        *
                                    </span>

                                </label>

                                <textarea name="deskripsi"
                                          id="deskripsi"
                                          rows="15"
                                          class="form-control @error('deskripsi') is-invalid @enderror"
                                          required>{{ old('deskripsi', $sejarah->deskripsi) }}</textarea>

                                @error('deskripsi')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                                @enderror

                            </div>

                        </div>

                    </div>

                </div>


                {{-- SIDEBAR --}}
                <div class="col-lg-4">


                    {{-- STATUS --}}
                    <div class="card border-0 shadow-sm mb-4">

                        <div class="card-header bg-white">

                            <h5 class="fw-bold mb-0">
                                Status
                            </h5>

                        </div>

                        <div class="card-body">

                            <div class="form-check">

                                <input type="checkbox"
                                       name="is_active"
                                       value="1"
                                       class="form-check-input"
                                       id="is_active"
                                    @checked(old('is_active', $sejarah->is_active))>

                                <label class="form-check-label"
                                       for="is_active">

                                    Aktifkan sejarah sekolah

                                </label>

                            </div>

                        </div>

                    </div>


                    {{-- IMAGE --}}
                    <div class="card border-0 shadow-sm mb-4">

                        <div class="card-header bg-white">

                            <h5 class="fw-bold mb-0">
                                Gambar
                            </h5>

                        </div>

                        <div class="card-body">

                            @if($sejarah->image)

                                <div class="mb-3">

                                    <label class="form-label fw-semibold">

                                        Gambar Saat Ini

                                    </label>

                                    <div>

                                        <img id="imagePreview"
                                             src="{{ asset('storage/' . $sejarah->image) }}"
                                             alt="{{ $sejarah->judul }}"
                                             class="img-fluid rounded border"
                                             style="max-height:220px;">

                                    </div>

                                </div>

                            @else

                                <div id="noImage"
                                     class="border rounded p-4 text-center text-muted mb-3">

                                    <i class="fa-regular fa-image fa-2x mb-2"></i>

                                    <div>
                                        Belum ada gambar
                                    </div>

                                </div>

                                <img id="imagePreview"
                                     src=""
                                     alt="Preview"
                                     class="img-fluid rounded border d-none mb-3"
                                     style="max-height:220px;">

                            @endif


                            <label for="image"
                                   class="form-label fw-semibold">

                                Ganti Gambar

                            </label>

                            <input type="file"
                                   name="image"
                                   id="image"
                                   class="form-control @error('image') is-invalid @enderror"
                                   accept="image/jpeg,image/png,image/webp">

                            @error('image')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                            @enderror

                            <small class="text-muted d-block mt-2">

                                JPG, PNG atau WEBP.
                                Maksimal 2 MB.

                            </small>

                        </div>

                    </div>


                    {{-- BUTTON --}}
                    <div class="d-grid gap-2">

                        <button type="submit"
                                class="btn btn-primary">

                            <i class="fa-solid fa-save me-1"></i>

                            Update Sejarah

                        </button>


                        <a href="{{ route('admin.profile.sejarah.index') }}"
                           class="btn btn-light border">

                            <i class="fa-solid fa-xmark me-1"></i>

                            Batal

                        </a>

                    </div>

                </div>

            </div>

        </form>

    </div>


    @push('scripts')

        <script>

            document.addEventListener('DOMContentLoaded', function () {

                const imageInput =
                    document.getElementById('image');

                const imagePreview =
                    document.getElementById('imagePreview');


                imageInput.addEventListener('change', function (event) {

                    const file =
                        event.target.files[0];


                    if (!file) {
                        return;
                    }


                    const allowedTypes = [
                        'image/jpeg',
                        'image/png',
                        'image/webp'
                    ];


                    if (!allowedTypes.includes(file.type)) {

                        alert(
                            'Format gambar harus JPG, PNG, atau WEBP.'
                        );

                        imageInput.value = '';

                        return;

                    }


                    const maxSize =
                        2 * 1024 * 1024;


                    if (file.size > maxSize) {

                        alert(
                            'Ukuran gambar maksimal 2 MB.'
                        );

                        imageInput.value = '';

                        return;

                    }


                    const reader =
                        new FileReader();


                    reader.onload = function (e) {

                        imagePreview.src =
                            e.target.result;

                        imagePreview.classList.remove(
                            'd-none'
                        );


                        const noImage =
                            document.getElementById('noImage');

                        if (noImage) {
                            noImage.classList.add('d-none');
                        }

                    };


                    reader.readAsDataURL(file);

                });

            });

        </script>

    @endpush

@endsection
