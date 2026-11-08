@extends('admin.template.admin')

@section('title', 'Edit Keunggulan')

@section('content-admin')
    <style>
        .icon-preview-box {
            width: 90px;
            height: 90px;
            border: 1px solid var(--bs-border-color);
            border-radius: 12px;
            background: var(--bs-light);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }

        .icon-preview-box i {
            font-size: 2.5rem;
        }

        .icon-preview-box:hover {
            transform: translateY(-2px);
            box-shadow: 0 .25rem .75rem rgba(0, 0, 0, .08);
        }

        @media (max-width: 575.98px) {

            .icon-preview-box {
                width: 80px;
                height: 80px;
            }

            .icon-preview-box i {
                font-size: 2rem;
            }

        }
    </style>
    <div class="container-fluid">

        {{-- ============================================================
            HEADER
        ============================================================ --}}
        <div class="mb-4">

            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">

                <div>
                    <h4 class="fw-bold mb-1">
                        Edit Keunggulan
                    </h4>

                    <p class="text-muted mb-0">
                        Perbarui informasi keunggulan sekolah.
                    </p>
                </div>

                <a href="{{ route('admin.berandas.keunggulan') }}"
                   class="btn btn-secondary btn-sm">

                    <i class="fa-solid fa-arrow-left me-1"></i>
                    Kembali

                </a>

            </div>

        </div>


        {{-- ============================================================
            ALERT ERROR
        ============================================================ --}}
        @if($errors->any())

            <div class="alert alert-danger alert-dismissible fade show">

                <div class="fw-semibold mb-1">
                    <i class="fa-solid fa-circle-exclamation me-1"></i>
                    Terdapat kesalahan:
                </div>

                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert">
                </button>

            </div>

        @endif


        {{-- ============================================================
            FORM
        ============================================================ --}}
        <div class="card border-0 shadow-sm">

            <div class="card-header bg-white py-3">

                <h5 class="mb-0 fw-semibold">
                    <i class="fa-solid fa-pen-to-square me-2 text-primary"></i>
                    Informasi Keunggulan
                </h5>

            </div>


            <div class="card-body">

                <form action="{{ route(
                    'admin.berandas.keunggulan.update',
                    $keunggulan->id
                ) }}"
                      method="POST">

                    @csrf
                    @method('PUT')


                    {{-- ====================================================
                        JUDUL
                    ===================================================== --}}
                    <div class="mb-4">

                        <label for="title"
                               class="form-label fw-semibold">

                            Judul Keunggulan
                            <span class="text-danger">*</span>

                        </label>

                        <input type="text"
                               id="title"
                               name="title"
                               class="form-control @error('title') is-invalid @enderror"
                               value="{{ old('title', $keunggulan->title) }}"
                               placeholder="Contoh: Fasilitas Lengkap"
                               maxlength="255"
                               required>

                        @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>


                    {{-- ====================================================
                        DESKRIPSI
                    ===================================================== --}}
                    <div class="mb-4">

                        <label for="description"
                               class="form-label fw-semibold">

                            Deskripsi
                            <span class="text-danger">*</span>

                        </label>

                        <textarea id="description"
                                  name="description"
                                  rows="5"
                                  class="form-control @error('description') is-invalid @enderror"
                                  placeholder="Masukkan deskripsi keunggulan..."
                                  required>{{ old('description', $keunggulan->description) }}</textarea>

                        @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>


                    {{-- ====================================================
                        ICON
                    ===================================================== --}}
                    <div class="mb-4">

                        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-2">

                            <label for="icon"
                                   class="form-label fw-semibold mb-0">

                                Icon Font Awesome

                            </label>

                            <a href="https://fontawesome.com/search"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="btn btn-sm btn-outline-primary">

                                <i class="fa-solid fa-magnifying-glass me-1"></i>
                                Cari Icon Font Awesome

                            </a>

                        </div>


                        <div class="row g-3 align-items-stretch">

                            {{-- ====================================================
                                PREVIEW ICON
                            ===================================================== --}}
                            <div class="col-12 col-sm-auto">

                                <div class="icon-preview-box">

                                    <span id="icon-preview">

                                        {!! old('icon', $keunggulan->icon) ?: '<i class="fa-solid fa-star"></i>' !!}

                                    </span>

                                </div>

                                <div class="text-center mt-2">

                                    <small class="text-muted">
                                        Preview
                                    </small>

                                </div>

                            </div>


                            {{-- ====================================================
                                INPUT ICON
                            ===================================================== --}}
                            <div class="col">

                                <input type="text"
                                       id="icon"
                                       name="icon"
                                       class="form-control @error('icon') is-invalid @enderror"
                                       value="{{ old('icon', $keunggulan->icon) }}"
                                       placeholder='<i class="fa-solid fa-trophy"></i>'
                                       maxlength="100"
                                       autocomplete="off">

                                @error('icon')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                                @enderror


                                <div class="form-text mt-2">

                                    <div class="mb-1">

                                        <i class="fa-solid fa-circle-info me-1"></i>

                                        Masukkan HTML icon Font Awesome.

                                    </div>

                                    <div>

                                        Contoh:

                                        <code>
                                            &lt;i class="fa-solid fa-trophy"&gt;&lt;/i&gt;
                                        </code>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- ====================================================
                        URUTAN
                    ===================================================== --}}
                    <div class="mb-4">

                        <label for="urutan"
                               class="form-label fw-semibold">

                            Urutan

                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                <i class="fa-solid fa-sort"></i>
                            </span>

                            <input type="number"
                                   id="urutan"
                                   name="urutan"
                                   min="1"
                                   class="form-control @error('urutan') is-invalid @enderror"
                                   value="{{ old('urutan', $keunggulan->urutan) }}"
                                   readonly>

                        </div>

                        <div class="form-text">
                            Urutan dapat diubah dengan cara <strong>drag &amp; drop</strong>
                            pada tabel Keunggulan.
                        </div>

                        @error('urutan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>


                    {{-- ====================================================
                        BUTTON
                    ===================================================== --}}
                    <div class="d-flex flex-wrap gap-2 pt-2">

                        <a href="{{ route('admin.berandas.keunggulan') }}"
                           class="btn btn-secondary">

                            <i class="fa-solid fa-arrow-left me-1"></i>
                            Kembali

                        </a>

                        <button type="submit"
                                class="btn btn-primary">

                            <i class="fa-solid fa-floppy-disk me-1"></i>
                            Simpan Perubahan

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    {{-- ================================================================
        LIVE ICON PREVIEW
    ================================================================= --}}
    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const iconInput = document.getElementById('icon');
            const iconPreview = document.getElementById('icon-preview');

            if (!iconInput || !iconPreview) {
                return;
            }

            iconInput.addEventListener('input', function () {

                const value = this.value.trim();

                if (value === '') {

                    iconPreview.innerHTML =
                        '<i class="fa-solid fa-star"></i>';

                    return;

                }

                iconPreview.innerHTML = value;

            });

        });

    </script>

@endsection
