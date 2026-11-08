@extends('admin.template.admin')

@section('title', 'Videotron | Beranda')

@section('content-admin')

    <!--begin::App Content Header-->
    <div class="app-content-header">
        <div class="container-fluid">

            <div class="row">

                <div class="col-sm-6">

                    <h1 class="mb-0 fs-3">
                        Videotron
                    </h1>

                </div>

                <div class="col-sm-6">

                    <nav aria-label="breadcrumb">

                        <ol class="breadcrumb float-sm-end">

                            <li class="breadcrumb-item">
                                <a href="#">
                                    Beranda
                                </a>
                            </li>

                            <li class="breadcrumb-item active"
                                aria-current="page">

                                Videotron

                            </li>

                        </ol>

                    </nav>

                </div>

            </div>

        </div>
    </div>
    <!--end::App Content Header-->


    <!--begin::App Content-->
    <div class="app-content">

        <div class="container-fluid">

            {{-- =====================================================
                SUCCESS MESSAGE
            ====================================================== --}}
            @if(session('success'))

                <div
                    class="alert alert-success alert-dismissible fade show"
                    role="alert"
                >

                    <i class="bi bi-check-circle me-2"></i>

                    {{ session('success') }}

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                    ></button>

                </div>

            @endif


            {{-- =====================================================
                VALIDATION ERROR
            ====================================================== --}}
            @if($errors->any())

                <div
                    class="alert alert-danger alert-dismissible fade show"
                    role="alert"
                >

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

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                    ></button>

                </div>

            @endif


            <div class="row g-4">

                {{-- =================================================
                    FORM
                ================================================== --}}
                <div class="col-lg-7">

                    <div class="card border-0 shadow-sm">

                        <div class="card-header bg-white">

                            <div class="d-flex align-items-center">

                                <div class="me-3">

                                    <span
                                        class="d-flex
                                        align-items-center
                                        justify-content-center
                                        bg-primary
                                        bg-opacity-10
                                        text-primary
                                        rounded"
                                        style="
                                            width: 44px;
                                            height: 44px;
                                        "
                                    >

                                        <i class="bi bi-youtube fs-4"></i>

                                    </span>

                                </div>

                                <div>

                                    <h3 class="card-title mb-1">
                                        Pengaturan Videotron
                                    </h3>

                                    <small class="text-secondary">
                                        Atur video yang ditampilkan pada
                                        halaman beranda website.
                                    </small>

                                </div>

                            </div>

                        </div>


                        <form
                            action="{{ route('admin.berandas.videotron.update') }}"
                            method="POST"
                        >

                            @csrf

                            @method('PUT')


                            <div class="card-body">

                                {{-- TITLE --}}
                                <div class="mb-4">

                                    <label
                                        for="title"
                                        class="form-label fw-semibold"
                                    >

                                        Judul Video

                                        <span class="text-danger">
                                            *
                                        </span>

                                    </label>


                                    <input
                                        type="text"
                                        id="title"
                                        name="title"
                                        class="form-control @error('title') is-invalid @enderror"
                                        value="{{ old('title', $videotron->title ?? '') }}"
                                        placeholder="Contoh: Membangun Generasi Cerdas & Berakhlakul Karimah"
                                        required
                                    >


                                    @error('title')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                    @enderror

                                </div>


                                {{-- DESCRIPTION --}}
                                <div class="mb-4">

                                    <label
                                        for="description"
                                        class="form-label fw-semibold"
                                    >

                                        Deskripsi

                                        <span class="text-danger">
                                            *
                                        </span>

                                    </label>


                                    <textarea
                                        id="description"
                                        name="description"
                                        rows="6"
                                        class="form-control @error('description') is-invalid @enderror"
                                        placeholder="Masukkan deskripsi video..."
                                        required
                                    >{{ old('description', $videotron->description ?? '') }}</textarea>


                                    @error('description')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                    @enderror

                                </div>


                                {{-- LINK --}}
                                <div class="mb-3">

                                    <label
                                        for="link"
                                        class="form-label fw-semibold"
                                    >

                                        Link Video YouTube

                                        <span class="text-danger">
                                            *
                                        </span>

                                    </label>


                                    <div class="input-group">

                                        <span class="input-group-text">

                                            <i class="bi bi-link-45deg"></i>

                                        </span>


                                        <input
                                            type="url"
                                            id="link"
                                            name="link"
                                            class="form-control @error('link') is-invalid @enderror"
                                            value="{{ old('link', $videotron->link ?? '') }}"
                                            placeholder="https://www.youtube.com/embed/..."
                                            required
                                        >

                                    </div>


                                    @error('link')

                                    <div class="text-danger small mt-1">
                                        {{ $message }}
                                    </div>

                                    @enderror


                                    <div class="form-text">

                                        Gunakan URL embed YouTube, contoh:

                                        <code>
                                            https://www.youtube.com/embed/VIDEO_ID
                                        </code>

                                    </div>

                                </div>

                            </div>


                            <div
                                class="card-footer bg-white
                                d-flex justify-content-end"
                            >

                                <button
                                    type="submit"
                                    class="btn btn-primary"
                                >

                                    <i class="bi bi-save me-1"></i>

                                    Simpan Perubahan

                                </button>

                            </div>

                        </form>

                    </div>

                </div>


                {{-- =================================================
                    PREVIEW
                ================================================== --}}
                <div class="col-lg-5">

                    <div class="card border-0 shadow-sm">

                        <div class="card-header bg-white">

                            <h3 class="card-title mb-0">

                                <i class="bi bi-eye me-2"></i>

                                Preview

                            </h3>

                        </div>


                        <div class="card-body">

                            {{-- VIDEO --}}
                            <div
                                class="ratio ratio-16x9 rounded overflow-hidden
                                bg-dark mb-4"
                            >

                                @if(!empty($videotron?->link))

                                    <iframe
                                        id="video-preview"
                                        src="{{ $videotron->link }}"
                                        title="{{ $videotron->title }}"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        allowfullscreen
                                    ></iframe>

                                @else

                                    <div
                                        id="video-placeholder"
                                        class="d-flex
                                        align-items-center
                                        justify-content-center
                                        text-white"
                                    >

                                        <div class="text-center">

                                            <i
                                                class="bi bi-youtube fs-1"
                                            ></i>

                                            <div class="mt-2">
                                                Video belum tersedia
                                            </div>

                                        </div>

                                    </div>

                                    <iframe
                                        id="video-preview"
                                        class="d-none"
                                        src=""
                                        title="Preview"
                                        frameborder="0"
                                        allowfullscreen
                                    ></iframe>

                                @endif

                            </div>


                            {{-- TITLE --}}
                            <h5
                                id="preview-title"
                                class="fw-bold mb-2"
                            >

                                {{ $videotron->title ?? 'Judul Video' }}

                            </h5>


                            {{-- DESCRIPTION --}}
                            <div
                                id="preview-description"
                                class="text-secondary"
                                style="white-space: pre-line;"
                            >

                                {{ $videotron->description ?? 'Deskripsi video akan tampil di sini.' }}

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
    <!--end::App Content-->


    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const title =
                document.getElementById('title');

            const description =
                document.getElementById('description');

            const link =
                document.getElementById('link');


            const previewTitle =
                document.getElementById('preview-title');

            const previewDescription =
                document.getElementById('preview-description');

            const videoPreview =
                document.getElementById('video-preview');

            const videoPlaceholder =
                document.getElementById('video-placeholder');


            /**
             * Preview Title
             */
            title.addEventListener('input', function () {

                previewTitle.textContent =
                    this.value || 'Judul Video';

            });


            /**
             * Preview Description
             */
            description.addEventListener('input', function () {

                previewDescription.textContent =
                    this.value ||
                    'Deskripsi video akan tampil di sini.';

            });


            /**
             * Preview YouTube
             */
            link.addEventListener('change', function () {

                const url = this.value.trim();

                if (!url) {
                    return;
                }


                if (videoPreview) {

                    videoPreview.src = url;

                    videoPreview.classList.remove('d-none');

                }


                if (videoPlaceholder) {

                    videoPlaceholder.classList.add('d-none');

                }

            });

        });
    </script>

@endsection
