@extends('template.app')

@section('title', 'Sejarah Sekolah | SMA Islam As-Syafi\'iyah 01')

@section('content')

    {{-- ============================================================
        HERO / HEADER
    ============================================================ --}}
    <section class="py-5 bg-custom-green text-white">
        <div class="container py-4">
            <div class="row align-items-center">
                <div class="col-lg-8 mx-auto text-center">

                    <div class="mb-3">
                        <span class="badge bg-white text-custom-green rounded-pill px-3 py-2">
                            <i class="bi bi-clock-history me-1"></i>
                            Profil Sekolah
                        </span>
                    </div>

                    <h1 class="display-5 fw-bold mb-3">
                        Sejarah Sekolah
                    </h1>

                    <p class="lead mb-0 opacity-75">
                        Mengenal perjalanan dan perkembangan
                        SMA Islam As-Syafi'iyah 01 dari masa ke masa.
                    </p>

                </div>
            </div>
        </div>
    </section>


    {{-- ============================================================
        SEJARAH SEKOLAH
    ============================================================ --}}
    <section class="py-5">

        <div class="container">

            @if($sejarah)

                <div class="row justify-content-center">

                    <div class="col-lg-10">

                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                            {{-- ====================================================
                                GAMBAR SEJARAH
                            ==================================================== --}}
                            @if($sejarah->image)

                                <div class="position-relative">

                                    <img src="{{ asset($sejarah->image) }}"
                                         alt="{{ $sejarah->judul }}"
                                         class="w-100"
                                         style="height: 400px; object-fit: cover;">

                                </div>

                            @endif


                            {{-- ====================================================
                                CONTENT
                            ==================================================== --}}
                            <div class="card-body p-4 p-md-5">

                                {{-- Judul --}}
                                <div class="text-center mb-5">

                                    <div class="d-inline-flex align-items-center justify-content-center
                                                rounded-circle bg-custom-green text-white mb-3"
                                         style="width: 70px; height: 70px;">

                                        <i class="bi bi-building fs-2"></i>

                                    </div>

                                    <h2 class="fw-bold text-custom-green mb-2">
                                        {{ $sejarah->judul ?? 'Sejarah Sekolah' }}
                                    </h2>

                                    <div class="mx-auto"
                                         style="width: 60px; height: 3px; background-color: var(--primary-green);">
                                    </div>

                                </div>


                                {{-- Isi Sejarah --}}
                                <div class="sejarah-content text-body-secondary">

                                    {!! nl2br(e($sejarah->deskripsi)) !!}

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            @else

                {{-- ============================================================
                    EMPTY STATE
                ============================================================ --}}
                <div class="row justify-content-center">

                    <div class="col-lg-8">

                        <div class="text-center py-5">

                            <div class="d-inline-flex align-items-center justify-content-center
                                        rounded-circle bg-body-tertiary mb-4"
                                 style="width: 100px; height: 100px;">

                                <i class="bi bi-clock-history fs-1 text-body-secondary"></i>

                            </div>

                            <h4 class="fw-bold text-body-secondary">
                                Sejarah Sekolah Belum Tersedia
                            </h4>

                            <p class="text-body-secondary mb-0">
                                Informasi mengenai sejarah sekolah akan
                                ditampilkan di halaman ini.
                            </p>

                        </div>

                    </div>

                </div>

            @endif

        </div>

    </section>


    {{-- ============================================================
        INFORMASI TAMBAHAN
    ============================================================ --}}
    <section class="py-5 bg-body-tertiary">

        <div class="container">

            <div class="row justify-content-center">

                <div class="col-lg-10">

                    <div class="card border-0 shadow-sm rounded-4">

                        <div class="card-body p-4 p-md-5">

                            <div class="row align-items-center">

                                <div class="col-md-2 text-center mb-4 mb-md-0">

                                    <div class="d-inline-flex align-items-center justify-content-center
                                                rounded-circle bg-custom-green text-white"
                                         style="width: 70px; height: 70px;">

                                        <i class="bi bi-mortarboard-fill fs-2"></i>

                                    </div>

                                </div>

                                <div class="col-md-10">

                                    <h4 class="fw-bold text-custom-green mb-2">
                                        Perjalanan Pendidikan
                                    </h4>

                                    <p class="text-body-secondary mb-0">
                                        Setiap perjalanan memiliki cerita.
                                        Sejarah sekolah menjadi bagian penting
                                        dalam menjaga nilai, tradisi, dan semangat
                                        pendidikan untuk terus berkembang dari
                                        generasi ke generasi.
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

@endsection


{{-- ================================================================
    CUSTOM STYLE
================================================================ --}}
@push('styles')

    <style>
        .sejarah-content {
            font-size: 1.05rem;
            line-height: 1.9;
        }

        .sejarah-content p {
            margin-bottom: 1.25rem;
        }

        .sejarah-content h1,
        .sejarah-content h2,
        .sejarah-content h3,
        .sejarah-content h4,
        .sejarah-content h5,
        .sejarah-content h6 {
            color: var(--primary-green);
            font-weight: 700;
            margin-top: 2rem;
            margin-bottom: 1rem;
        }

        .sejarah-content img {
            max-width: 100%;
            height: auto;
            border-radius: 1rem;
        }

        .sejarah-content ul,
        .sejarah-content ol {
            padding-left: 1.5rem;
            margin-bottom: 1.25rem;
        }

        .sejarah-content li {
            margin-bottom: .5rem;
        }

        .sejarah-content blockquote {
            border-left: 4px solid var(--primary-green);
            padding: 1rem 1.25rem;
            margin: 1.5rem 0;
            background-color: var(--bs-tertiary-bg);
            border-radius: 0 .75rem .75rem 0;
        }

        .sejarah-content table {
            width: 100%;
            margin-bottom: 1.5rem;
            border-collapse: collapse;
        }

        .sejarah-content table th,
        .sejarah-content table td {
            padding: .75rem;
            border: 1px solid var(--bs-border-color);
        }
    </style>

@endpush
