@extends('admin.template.admin')

@section('title', 'Tambah Keunggulan')

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

        <div class="mb-4">
            <h4 class="fw-bold mb-1">
                Tambah Keunggulan
            </h4>

            <p class="text-muted mb-0">
                Tambahkan keunggulan sekolah.
            </p>
        </div>


        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <form action="{{ route('admin.berandas.keunggulan.store') }}"
                      method="POST">

                    @csrf


                    {{-- Judul --}}
                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            Judul Keunggulan
                        </label>

                        <input type="text"
                               name="title"
                               class="form-control @error('title') is-invalid @enderror"
                               value="{{ old('title') }}"
                               placeholder="Contoh: Pendidikan Berkualitas">

                        @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>


                    {{-- Deskripsi --}}
                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            Deskripsi
                        </label>

                        <textarea name="description"
                                  rows="5"
                                  class="form-control @error('description') is-invalid @enderror"
                                  placeholder="Masukkan deskripsi keunggulan...">{{ old('description') }}</textarea>

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

                                        {!! old('icon') ?: '<i class="fa-solid fa-star"></i>' !!}

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
                                       value="{{ old('icon') }}"
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


                    {{-- Urutan --}}
                    <div class="mb-4">

                        <label class="form-label fw-semibold">
                            Urutan
                        </label>

                        <input type="number"
                               name="urutan"
                               min="0"
                               class="form-control @error('urutan') is-invalid @enderror"
                               value="{{ old('urutan', 0) }}">

                        @error('urutan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>


                    <div class="d-flex gap-2">

                        <a href="{{ route('admin.berandas.keunggulan') }}"
                           class="btn btn-secondary">

                            <i class="fa-solid fa-arrow-left me-1"></i>
                            Kembali

                        </a>

                        <button type="submit"
                                class="btn btn-primary">

                            <i class="fa-solid fa-save me-1"></i>
                            Simpan

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection
