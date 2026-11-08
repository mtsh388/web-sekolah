@extends('admin.template.admin')

@section('title', 'Tambah Sejarah Sekolah')

@section('content-admin')

    <div class="container-fluid mt-3">

        {{-- HEADER --}}
        <div class="mb-4">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <h4 class="fw-bold mb-1">
                        Tambah Sejarah Sekolah
                    </h4>

                    <p class="text-muted mb-0">
                        Tambahkan informasi sejarah sekolah.
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


        <form action="{{ route('admin.profile.sejarah.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

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
                                       value="{{ old('judul', 'Sejarah Sekolah') }}"
                                       placeholder="Masukkan judul"
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
                                          placeholder="Tuliskan sejarah sekolah..."
                                          required>{{ old('deskripsi') }}</textarea>

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
                                    @checked(old('is_active', true))>

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


                            <div class="mt-3">

                                <img id="imagePreview"
                                     src=""
                                     class="img-fluid rounded border d-none"
                                     style="max-height:220px;">

                            </div>

                        </div>

                    </div>


                    {{-- BUTTON --}}
                    <div class="d-grid">

                        <button type="submit"
                                class="btn btn-primary">

                            <i class="fa-solid fa-save me-1"></i>

                            Simpan Sejarah

                        </button>

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

                        imagePreview.classList.add('d-none');

                        imagePreview.src = '';

                        return;

                    }


                    const reader =
                        new FileReader();


                    reader.onload = function (e) {

                        imagePreview.src =
                            e.target.result;

                        imagePreview.classList.remove('d-none');

                    };


                    reader.readAsDataURL(file);

                });

            });

        </script>

    @endpush

@endsection
