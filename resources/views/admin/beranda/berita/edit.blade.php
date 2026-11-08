@extends('admin.template.admin')

@section('title', 'Edit Berita')

@section('content-admin')

    <div class="container-fluid mt-3">

        {{-- ============================================================
            HEADER
        ============================================================ --}}
        <div class="mb-4">

            <div class="d-flex justify-content-between align-items-center">

                <div>
                    <h4 class="fw-bold mb-1">
                        Edit Berita
                    </h4>

                    <p class="text-muted mb-0">
                        Perbarui informasi berita untuk website sekolah.
                    </p>
                </div>

                <a href="{{ route('admin.berandas.berita') }}"
                   class="btn btn-light border">

                    <i class="fa-solid fa-arrow-left me-1"></i>
                    Kembali

                </a>

            </div>

        </div>


        {{-- ============================================================
            ALERT SUCCESS
        ============================================================ --}}
        @if(session('success'))

            <div class="alert alert-success alert-dismissible fade show">

                <i class="fa-solid fa-circle-check me-1"></i>

                {{ session('success') }}

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert">
                </button>

            </div>

        @endif


        {{-- ============================================================
            VALIDATION ERROR
        ============================================================ --}}
        @if($errors->any())

            <div class="alert alert-danger">

                <strong>
                    <i class="fa-solid fa-triangle-exclamation me-1"></i>
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


        {{-- ============================================================
            FORM
        ============================================================ --}}
        <form action="{{ route('admin.berandas.berita.update', $berita->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

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

                            {{-- ====================================================
                                TITLE
                            ===================================================== --}}
                            <div class="mb-3">

                                <label class="form-label fw-semibold">

                                    Judul Berita

                                    <span class="text-danger">
                                        *
                                    </span>

                                </label>

                                <input type="text"
                                       name="title"
                                       class="form-control @error('title') is-invalid @enderror"
                                       value="{{ old('title', $berita->title) }}"
                                       placeholder="Masukkan judul berita"
                                       required>

                                @error('title')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                                @enderror

                            </div>


                            {{-- ====================================================
                                CONTENT
                            ===================================================== --}}
                            <div class="mb-3">

                                <label class="form-label fw-semibold">

                                    Isi Berita

                                    <span class="text-danger">
                                        *
                                    </span>

                                </label>

                                <textarea name="content"
                                          id="content"
                                          class="form-control @error('content') is-invalid @enderror"
                                          rows="15"
                                          required>{{ old('content', $berita->content) }}</textarea>

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


                    {{-- ====================================================
                        PUBLISH
                    ===================================================== --}}
                    <div class="card border-0 shadow-sm mb-4">

                        <div class="card-header bg-white">

                            <h5 class="fw-bold mb-0">
                                Publikasi
                            </h5>

                        </div>

                        <div class="card-body">

                            {{-- ====================================================
                                STATUS
                            ===================================================== --}}
                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Status
                                </label>

                                <select name="status"
                                        id="status"
                                        class="form-select @error('status') is-invalid @enderror">

                                    <option value="draft"
                                        @selected(old('status', $berita->status) === 'draft')>

                                        Draft

                                    </option>

                                    <option value="published"
                                        @selected(old('status', $berita->status) === 'published')>

                                        Published

                                    </option>

                                </select>

                                @error('status')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                                @enderror

                            </div>


                            {{-- ====================================================
                                PUBLISHED AT
                            ===================================================== --}}
                            <div class="mb-3">

                                <label class="form-label fw-semibold">

                                    Tanggal Publikasi

                                </label>

                                <input type="datetime-local"
                                       name="published_at"
                                       class="form-control @error('published_at') is-invalid @enderror"
                                       value="{{ old(
                                           'published_at',
                                           $berita->published_at
                                               ? $berita->published_at->format('Y-m-d\TH:i')
                                               : ''
                                       ) }}">

                                @error('published_at')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                                @enderror

                            </div>


                            {{-- ====================================================
                                FEATURED
                            ===================================================== --}}
                            <div class="form-check">

                                <input type="checkbox"
                                       name="is_featured"
                                       value="1"
                                       class="form-check-input"
                                       id="is_featured"
                                    @checked(old('is_featured', $berita->is_featured))>

                                <label class="form-check-label"
                                       for="is_featured">

                                    Jadikan berita unggulan

                                </label>

                            </div>

                        </div>

                    </div>


                    {{-- ====================================================
                        CATEGORY
                    ===================================================== --}}
                    <div class="card border-0 shadow-sm mb-4">

                        <div class="card-header bg-white">

                            <h5 class="fw-bold mb-0">
                                Kategori
                            </h5>

                        </div>

                        <div class="card-body">

                            <input type="text"
                                   name="category"
                                   class="form-control @error('category') is-invalid @enderror"
                                   value="{{ old('category', $berita->category) }}"
                                   list="categoryList"
                                   placeholder="Contoh: Akademik">

                            @error('category')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                            @enderror


                            <datalist id="categoryList">

                                @foreach($categories as $category)

                                    <option value="{{ $category }}">

                                @endforeach

                            </datalist>

                        </div>

                    </div>


                    {{-- ====================================================
                        IMAGE
                    ===================================================== --}}
                    <div class="card border-0 shadow-sm mb-4">

                        <div class="card-header bg-white">

                            <h5 class="fw-bold mb-0">
                                Gambar
                            </h5>

                        </div>

                        <div class="card-body">

                            {{-- CURRENT IMAGE --}}
                            @if($berita->image)

                                <div class="mb-3">

                                    <label class="form-label fw-semibold">
                                        Gambar Saat Ini
                                    </label>

                                    <div>

                                        <img id="imagePreview"
                                             src="{{ asset('storage/' . $berita->image) }}"
                                             alt="{{ $berita->title }}"
                                             class="img-fluid rounded border"
                                             style="max-height: 220px;">

                                    </div>

                                </div>

                            @else

                                <div class="mb-3">

                                    <div id="noImagePreview"
                                         class="border rounded p-4 text-center text-muted">

                                        <i class="fa-regular fa-image fa-2x mb-2"></i>

                                        <div>
                                            Belum ada gambar
                                        </div>

                                    </div>

                                    <img id="imagePreview"
                                         src=""
                                         alt="Preview"
                                         class="img-fluid rounded border d-none"
                                         style="max-height:220px;">

                                </div>

                            @endif


                            {{-- UPLOAD --}}
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


                    {{-- ====================================================
                        BUTTON
                    ===================================================== --}}
                    <div class="d-grid gap-2">

                        <button type="submit"
                                class="btn btn-primary">

                            <i class="fa-solid fa-save me-1"></i>

                            Update Berita

                        </button>


                        <a href="{{ route('admin.berandas.berita') }}"
                           class="btn btn-light border">

                            <i class="fa-solid fa-xmark me-1"></i>

                            Batal

                        </a>

                    </div>

                </div>

            </div>

        </form>

    </div>


    {{-- ================================================================
        IMAGE PREVIEW SCRIPT
    ================================================================= --}}
    @push('scripts')

        <script>

            document.addEventListener('DOMContentLoaded', function () {

                const imageInput = document.getElementById('image');
                const imagePreview = document.getElementById('imagePreview');
                const noImagePreview = document.getElementById('noImagePreview');

                if (!imageInput || !imagePreview) {
                    return;
                }

                imageInput.addEventListener('change', function (event) {

                    const file = event.target.files[0];

                    if (!file) {
                        return;
                    }

                    // Validasi tipe file
                    const allowedTypes = [
                        'image/jpeg',
                        'image/png',
                        'image/webp'
                    ];

                    if (!allowedTypes.includes(file.type)) {

                        alert('Format gambar harus JPG, PNG, atau WEBP.');

                        imageInput.value = '';

                        return;
                    }


                    // Validasi ukuran maksimal 2 MB
                    const maxSize = 2 * 1024 * 1024;

                    if (file.size > maxSize) {

                        alert('Ukuran gambar maksimal 2 MB.');

                        imageInput.value = '';

                        return;
                    }


                    // Preview gambar baru
                    const reader = new FileReader();

                    reader.onload = function (e) {

                        imagePreview.src = e.target.result;

                        imagePreview.classList.remove('d-none');

                        if (noImagePreview) {
                            noImagePreview.classList.add('d-none');
                        }

                    };

                    reader.readAsDataURL(file);

                });

            });

        </script>

    @endpush

@endsection
