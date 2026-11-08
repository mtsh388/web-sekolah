@extends('admin.template.admin')

@section('title', 'Sambutan | Beranda')

@section('content-admin')

    <!--begin::App Content Header-->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0 fs-3">
                        Sambutan
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
                                Sambutan
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

            {{-- Alert Success --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show"
                     role="alert">

                    <i class="bi bi-check-circle me-2"></i>

                    {{ session('success') }}

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert">
                    </button>
                </div>
            @endif


            {{-- Validation Error --}}
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show"
                     role="alert">

                    <strong>
                        Terdapat kesalahan:
                    </strong>

                    <ul class="mb-0 mt-2">
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


            <div class="row g-4">

                {{-- =====================================================
                    FORM SAMBUTAN
                ====================================================== --}}
                <div class="col-lg-8">

                    <div class="card border-0 shadow-sm">

                        <div class="card-header bg-white">

                            <div class="d-flex align-items-center">

                                <div class="me-3">
                                    <span
                                        class="d-flex align-items-center justify-content-center
                                        bg-primary bg-opacity-10 text-primary rounded"
                                        style="width: 42px; height: 42px;">

                                        <i class="bi bi-chat-quote fs-4"></i>

                                    </span>
                                </div>

                                <div>
                                    <h3 class="card-title mb-1">
                                        Pengaturan Sambutan
                                    </h3>

                                    <small class="text-secondary">
                                        Atur sambutan kepala sekolah yang
                                        ditampilkan pada halaman beranda.
                                    </small>
                                </div>

                            </div>

                        </div>


                        <form
                            action="{{ route('admin.berandas.sambutan.update') }}"
                            method="POST"
                            enctype="multipart/form-data"
                        >

                            @csrf
                            @method('PUT')


                            <div class="card-body">

                                {{-- Nama --}}
                                <div class="mb-4">

                                    <label for="nama"
                                           class="form-label fw-semibold">

                                        Nama Kepala Sekolah

                                        <span class="text-danger">
                                            *
                                        </span>

                                    </label>

                                    <input
                                        type="text"
                                        class="form-control @error('nama') is-invalid @enderror"
                                        id="nama"
                                        name="nama"
                                        value="{{ old('nama', $sambutan->nama ?? '') }}"
                                        placeholder="Contoh: Drs. H. Ahmad Fauzi, M.Pd."
                                        required
                                    >

                                    @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                </div>


                                {{-- Title --}}
                                <div class="mb-4">

                                    <label for="title"
                                           class="form-label fw-semibold">

                                        Judul / Tagline Sambutan

                                        <span class="text-danger">
                                            *
                                        </span>

                                    </label>

                                    <input
                                        type="text"
                                        class="form-control @error('title') is-invalid @enderror"
                                        id="title"
                                        name="title"
                                        value="{{ old('title', $sambutan->title ?? '') }}"
                                        placeholder="Masukkan judul sambutan"
                                        required
                                    >

                                    @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                    <div class="form-text">
                                        Contoh: Mewujudkan Pelajar yang Unggul
                                        dalam Prestasi dan Mulia dalam Pekerti.
                                    </div>

                                </div>


                                {{-- Description --}}
                                <div class="mb-4">

                                    <label for="description"
                                           class="form-label fw-semibold">

                                        Isi Sambutan

                                        <span class="text-danger">
                                            *
                                        </span>

                                    </label>

                                    <textarea
                                        class="form-control @error('description') is-invalid @enderror"
                                        id="description"
                                        name="description"
                                        rows="10"
                                        placeholder="Tuliskan sambutan kepala sekolah..."
                                        required
                                    >{{ old('description', $sambutan->description ?? '') }}</textarea>

                                    @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                    <div class="form-text">
                                        Gunakan paragraf yang singkat,
                                        informatif, dan mudah dibaca.
                                    </div>

                                </div>


                                {{-- Image --}}
                                <div class="mb-3">

                                    <label for="image"
                                           class="form-label fw-semibold">

                                        Foto Kepala Sekolah

                                    </label>

                                    <input
                                        type="file"
                                        class="form-control @error('image') is-invalid @enderror"
                                        id="image"
                                        name="image"
                                        accept="image/jpeg,image/png,image/webp"
                                    >

                                    @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                    <div class="form-text">
                                        Format JPG, JPEG, PNG atau WEBP.
                                        Maksimal 2 MB.
                                    </div>

                                </div>

                            </div>


                            <div class="card-footer bg-white d-flex justify-content-end">

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


                {{-- =====================================================
                    PREVIEW
                ====================================================== --}}
                <div class="col-lg-4">

                    <div class="card border-0 shadow-sm">

                        <div class="card-header bg-white">

                            <h3 class="card-title mb-0">

                                <i class="bi bi-eye me-2"></i>

                                Preview

                            </h3>

                        </div>


                        <div class="card-body">

                            {{-- Image Preview --}}
                            <div class="text-center mb-4">

                                <div
                                    class="mx-auto overflow-hidden rounded-circle border"
                                    style="
                                        width: 160px;
                                        height: 160px;
                                    "
                                >

                                    @if(!empty($sambutan?->image))

                                        <img
                                            id="image-preview"
                                            src="{{ asset('images/sambutan/' . $sambutan->image) }}"
                                            alt="{{ $sambutan->nama }}"
                                            class="w-100 h-100 object-fit-cover"
                                        >

                                    @else

                                        <div
                                            id="image-placeholder"
                                            class="w-100 h-100
                                            d-flex align-items-center
                                            justify-content-center
                                            bg-light text-secondary"
                                        >

                                            <i class="bi bi-person fs-1"></i>

                                        </div>

                                        <img
                                            id="image-preview"
                                            src=""
                                            alt="Preview"
                                            class="w-100 h-100 object-fit-cover d-none"
                                        >

                                    @endif

                                </div>

                            </div>


                            {{-- Nama --}}
                            <div class="text-center">

                                <h5
                                    id="preview-nama"
                                    class="fw-bold mb-2"
                                >
                                    {{ $sambutan->nama ?? 'Nama Kepala Sekolah' }}
                                </h5>


                                {{-- Title --}}
                                <p
                                    id="preview-title"
                                    class="text-primary fw-semibold mb-3"
                                >
                                    {{ $sambutan->title ?? 'Judul sambutan kepala sekolah' }}
                                </p>

                            </div>


                            <hr>


                            {{-- Description --}}
                            <div>

                                <h6 class="fw-semibold mb-2">
                                    Sambutan
                                </h6>

                                <div
                                    id="preview-description"
                                    class="text-secondary small"
                                    style="white-space: pre-line;"
                                >
                                    {{ $sambutan->description ?? 'Isi sambutan kepala sekolah akan tampil di sini.' }}
                                </div>

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

            const nama = document.getElementById('nama');
            const title = document.getElementById('title');
            const description = document.getElementById('description');
            const image = document.getElementById('image');

            const previewNama =
                document.getElementById('preview-nama');

            const previewTitle =
                document.getElementById('preview-title');

            const previewDescription =
                document.getElementById('preview-description');

            const imagePreview =
                document.getElementById('image-preview');

            const imagePlaceholder =
                document.getElementById('image-placeholder');


            // Preview nama
            nama.addEventListener('input', function () {

                previewNama.textContent =
                    this.value || 'Nama Kepala Sekolah';

            });


            // Preview title
            title.addEventListener('input', function () {

                previewTitle.textContent =
                    this.value || 'Judul sambutan kepala sekolah';

            });


            // Preview description
            description.addEventListener('input', function () {

                previewDescription.textContent =
                    this.value ||
                    'Isi sambutan kepala sekolah akan tampil di sini.';

            });


            // Preview image
            image.addEventListener('change', function () {

                const file = this.files[0];

                if (!file) {
                    return;
                }

                if (!file.type.startsWith('image/')) {
                    return;
                }

                const reader = new FileReader();

                reader.onload = function (e) {

                    imagePreview.src = e.target.result;

                    imagePreview.classList.remove('d-none');

                    if (imagePlaceholder) {
                        imagePlaceholder.classList.add('d-none');
                    }

                };

                reader.readAsDataURL(file);

            });

        });
    </script>

@endsection
