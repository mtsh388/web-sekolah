@extends('admin.template.admin')

@section('title', 'Tambah Berita')

@section('content-admin')

    <div class="container-fluid mt-3">

        <div class="mb-4">

            <div class="d-flex justify-content-between align-items-center">

                <div>
                    <h4 class="fw-bold mb-1">
                        Tambah Berita
                    </h4>

                    <p class="text-muted mb-0">
                        Tambahkan berita baru untuk website sekolah.
                    </p>
                </div>

                <a href="{{ route('admin.berandas.berita') }}"
                   class="btn btn-light border">

                    <i class="fa-solid fa-arrow-left me-1"></i>
                    Kembali

                </a>

            </div>

        </div>


        @if($errors->any())

            <div class="alert alert-danger">

                <strong>
                    Terdapat kesalahan:
                </strong>

                <ul class="mb-0 mt-2">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        <form action="{{ route('admin.berita.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="row g-4">

                {{-- ====================================================
                    MAIN
                ===================================================== --}}
                <div class="col-lg-8">

                    <div class="card border-0 shadow-sm">

                        <div class="card-header bg-white">

                            <h5 class="fw-bold mb-0">
                                Informasi Berita
                            </h5>

                        </div>

                        <div class="card-body">

                            {{-- TITLE --}}
                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Judul Berita
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="text"
                                       name="title"
                                       class="form-control @error('title') is-invalid @enderror"
                                       value="{{ old('title') }}"
                                       placeholder="Masukkan judul berita"
                                       required>

                                @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror

                            </div>


                            {{-- CONTENT --}}
                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Isi Berita
                                    <span class="text-danger">*</span>
                                </label>

                                <textarea name="content"
                                          id="content"
                                          class="form-control @error('content') is-invalid @enderror"
                                          rows="15"
                                          required>{{ old('content') }}</textarea>

                                @error('content')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ====================================================
                    SIDEBAR
                ===================================================== --}}
                <div class="col-lg-4">

                    {{-- PUBLISH --}}
                    <div class="card border-0 shadow-sm mb-4">

                        <div class="card-header bg-white">

                            <h5 class="fw-bold mb-0">
                                Publikasi
                            </h5>

                        </div>

                        <div class="card-body">

                            {{-- STATUS --}}
                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Status
                                </label>

                                <select name="status"
                                        id="status"
                                        class="form-select">

                                    <option value="draft"
                                        @selected(old('status') === 'draft')>
                                        Draft
                                    </option>

                                    <option value="published"
                                        @selected(old('status', 'published') === 'published')>
                                        Published
                                    </option>

                                </select>

                            </div>


                            {{-- PUBLISHED AT --}}
                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Tanggal Publikasi
                                </label>

                                <input type="datetime-local"
                                       name="published_at"
                                       class="form-control"
                                       value="{{ old('published_at') }}">

                            </div>


                            {{-- FEATURED --}}
                            <div class="form-check">

                                <input
                                    type="checkbox"
                                    name="is_featured"
                                    value="1"
                                    class="form-check-input"
                                    id="is_featured"
                                    @checked(old('is_featured'))>

                                <label class="form-check-label"
                                       for="is_featured">

                                    Jadikan berita unggulan

                                </label>

                            </div>

                        </div>

                    </div>


                    {{-- CATEGORY --}}
                    <div class="card border-0 shadow-sm mb-4">

                        <div class="card-header bg-white">

                            <h5 class="fw-bold mb-0">
                                Kategori
                            </h5>

                        </div>

                        <div class="card-body">

                            <input type="text"
                                   name="category"
                                   class="form-control"
                                   value="{{ old('category') }}"
                                   list="categoryList"
                                   placeholder="Contoh: Akademik">

                            <datalist id="categoryList">

                                @foreach($categories as $category)

                                    <option value="{{ $category }}">

                                @endforeach

                            </datalist>

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
                                   class="form-control"
                                   accept="image/jpeg,image/png,image/webp">

                            <small class="text-muted d-block mt-2">
                                JPG, PNG atau WEBP. Maksimal 2 MB.
                            </small>

                            <div class="mt-3">

                                <img id="imagePreview"
                                     src=""
                                     class="img-fluid rounded d-none"
                                     style="max-height:220px;">

                            </div>

                        </div>

                    </div>


                    {{-- BUTTON --}}
                    <div class="d-grid">

                        <button type="submit"
                                class="btn btn-primary">

                            <i class="fa-solid fa-save me-1"></i>
                            Simpan Berita

                        </button>

                    </div>

                </div>

            </div>

        </form>

    </div>


    @push('scripts')

        <script>

            document.getElementById('image').addEventListener('change', function (event) {

                const file = event.target.files[0];
                const preview = document.getElementById('imagePreview');

                if (!file) {
                    preview.classList.add('d-none');
                    preview.src = '';
                    return;
                }

                const reader = new FileReader();

                reader.onload = function (e) {

                    preview.src = e.target.result;
                    preview.classList.remove('d-none');

                };

                reader.readAsDataURL(file);

            });

        </script>

    @endpush

@endsection
