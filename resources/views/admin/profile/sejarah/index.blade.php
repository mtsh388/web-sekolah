@extends('admin.template.admin')

@section('title', 'Sejarah Sekolah')

@section('content-admin')
    <style>

        .sejarah-content {

            font-size: 1.05rem;

            line-height: 1.9;

        }


        .sejarah-content br {

            display: block;

            content: "";

            margin-bottom: .75rem;

        }


    </style>

    {{-- ============================================================
        HEADER
    ============================================================ --}}
    <div class="app-content-header">

        <div class="container-fluid mt-3">

            <div class="row">

                <div class="col-sm-6">

                    <h1 class="mb-0 fs-3">
                        Sejarah Sekolah
                    </h1>

                </div>

                <div class="col-sm-6">

                    <nav aria-label="breadcrumb">

                        <ol class="breadcrumb float-sm-end">

                            <li class="breadcrumb-item">
                                <a href="{{ url('/admin') }}">
                                    Beranda
                                </a>
                            </li>

                            <li class="breadcrumb-item">
                                Profil Sekolah
                            </li>

                            <li class="breadcrumb-item active"
                                aria-current="page">

                                Sejarah Sekolah

                            </li>

                        </ol>

                    </nav>

                </div>

            </div>

        </div>

    </div>


    {{-- ============================================================
        CONTENT
    ============================================================ --}}
    <div class="app-content">

        <div class="container-fluid">

            {{-- ====================================================
                ALERT SUCCESS
            ==================================================== --}}
            @if(session('success'))

                <div class="alert alert-success alert-dismissible fade show"
                     role="alert">

                    <i class="fa-solid fa-circle-check me-2"></i>

                    {{ session('success') }}

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert">
                    </button>

                </div>

            @endif


            {{-- ====================================================
                DATA SEJARAH
            ==================================================== --}}
            @if($sejarah)

                <div class="row g-4">

                    {{-- =================================================
                        MAIN CONTENT
                    ================================================= --}}
                    <div class="col-lg-8">

                        <div class="card border-0 shadow-sm">

                            {{-- CARD HEADER --}}
                            <div class="card-header bg-white">

                                <div class="d-flex justify-content-between align-items-center">

                                    <div>

                                        <h3 class="card-title mb-1">

                                            <i class="fa-solid fa-clock-rotate-left text-primary me-2"></i>

                                            Sejarah Sekolah

                                        </h3>

                                        <small class="text-secondary">

                                            Informasi perjalanan dan perkembangan sekolah.

                                        </small>

                                    </div>


                                    {{-- EDIT --}}
                                    <a href="{{ route('admin.profile.sejarah.edit', $sejarah) }}"
                                       class="btn btn-warning">

                                        <i class="fa-solid fa-pen me-1"></i>

                                        Edit

                                    </a>

                                </div>

                            </div>


                            {{-- CARD BODY --}}
                            <div class="card-body p-4 p-md-5">

                                {{-- =================================================
                                    JUDUL
                                ================================================== --}}
                                <div class="mb-4">

                                    <h2 class="fw-bold mb-2">

                                        {{ $sejarah->judul }}

                                    </h2>

                                    <div
                                        style="
                                        width: 60px;
                                        height: 4px;
                                        background-color: var(--bs-primary);
                                        border-radius: 10px;
                                    "
                                    ></div>

                                </div>


                                {{-- =================================================
                                    GAMBAR
                                ================================================== --}}
                                @if($sejarah->image)

                                    <div class="mb-4">

                                        <img
                                            src="{{ asset($sejarah->image) }}"
                                            alt="{{ $sejarah->judul }}"
                                            class="img-fluid rounded-3 border w-100"
                                            style="
                                            max-height: 450px;
                                            object-fit: cover;
                                        "
                                        >

                                    </div>

                                @endif


                                {{-- =================================================
                                    DESKRIPSI
                                ================================================== --}}
                                <div class="sejarah-content text-secondary">

                                    {!! nl2br(e($sejarah->deskripsi)) !!}

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                        SIDEBAR
                    ================================================= --}}
                    <div class="col-lg-4">


                        {{-- =================================================
                            STATUS
                        ================================================== --}}
                        <div class="card border-0 shadow-sm mb-4">

                            <div class="card-header bg-white">

                                <h5 class="card-title mb-0">

                                    <i class="fa-solid fa-circle-info text-primary me-2"></i>

                                    Informasi

                                </h5>

                            </div>


                            <div class="card-body">

                                {{-- STATUS --}}
                                <div class="d-flex justify-content-between align-items-center mb-3">

                                <span class="text-secondary">

                                    Status

                                </span>


                                    @if($sejarah->is_active)

                                        <span class="badge bg-success">

                                        <i class="fa-solid fa-check me-1"></i>

                                        Aktif

                                    </span>

                                    @else

                                        <span class="badge bg-secondary">

                                        <i class="fa-solid fa-xmark me-1"></i>

                                        Tidak Aktif

                                    </span>

                                    @endif

                                </div>


                                <hr>


                                {{-- DIBUAT --}}
                                <div class="d-flex justify-content-between align-items-center mb-3">

                                <span class="text-secondary">

                                    Dibuat

                                </span>

                                    <span class="fw-semibold">

                                    {{ $sejarah->created_at?->format('d M Y') ?? '-' }}

                                </span>

                                </div>


                                {{-- DIPERBARUI --}}
                                <div class="d-flex justify-content-between align-items-center">

                                <span class="text-secondary">

                                    Diperbarui

                                </span>

                                    <span class="fw-semibold">

                                    {{ $sejarah->updated_at?->format('d M Y') ?? '-' }}

                                </span>

                                </div>

                            </div>

                        </div>


                        {{-- =================================================
                            ACTION
                        ================================================== --}}
                        <div class="card border-0 shadow-sm">

                            <div class="card-header bg-white">

                                <h5 class="card-title mb-0">

                                    <i class="fa-solid fa-gear text-primary me-2"></i>

                                    Aksi

                                </h5>

                            </div>


                            <div class="card-body">

                                {{-- EDIT --}}
                                <a href="{{ route('admin.profile.sejarah.edit', $sejarah) }}"
                                   class="btn btn-warning w-100 mb-2">

                                    <i class="fa-solid fa-pen me-1"></i>

                                    Edit Sejarah

                                </a>


                                {{-- FRONTEND --}}
                                <a href="{{ route('sejarah.index') }}"
                                   target="_blank"
                                   class="btn btn-outline-primary w-100 mb-2">

                                    <i class="fa-solid fa-arrow-up-right-from-square me-1"></i>

                                    Lihat Halaman

                                </a>




                            </div>

                        </div>

                    </div>

                </div>


            @else

                {{-- ====================================================
                    EMPTY STATE
                ==================================================== --}}
                <div class="row justify-content-center">

                    <div class="col-lg-7">

                        <div class="card border-0 shadow-sm">

                            <div class="card-body text-center py-5 px-4">

                                <div
                                    class="d-inline-flex align-items-center justify-content-center
                                       rounded-circle bg-primary bg-opacity-10
                                       text-primary mb-4"
                                    style="
                                    width: 100px;
                                    height: 100px;
                                "
                                >

                                    <i class="fa-solid fa-clock-rotate-left fa-3x"></i>

                                </div>


                                <h3 class="fw-bold mb-2">

                                    Sejarah Sekolah Belum Tersedia

                                </h3>


                                <p class="text-secondary mb-4">

                                    Belum ada informasi sejarah sekolah.
                                    Silakan tambahkan sejarah sekolah untuk
                                    ditampilkan pada halaman profil.

                                </p>


                                <a href="{{ route('admin.profile.sejarah.create') }}"
                                   class="btn btn-primary">

                                    <i class="fa-solid fa-plus me-1"></i>

                                    Tambah Sejarah

                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            @endif

        </div>

    </div>
    <script>

        document.addEventListener('DOMContentLoaded', function () {

            document.addEventListener('submit', function (event) {

                if (
                    !event.target.classList.contains(
                        'delete-sejarah-form'
                    )
                ) {
                    return;
                }


                const confirmed = confirm(
                    'Apakah Anda yakin ingin menghapus sejarah sekolah ini?'
                );


                if (!confirmed) {

                    event.preventDefault();

                }

            });

        });

    </script>

@endsection
