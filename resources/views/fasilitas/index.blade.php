@extends('template.app')

@section('title', 'Fasilitas Sekolah | SMA Islam As-Syafi\'iyah 01')

@section('content')
    <style>

        /* ============================================================
           HERO
        ============================================================ */

        .fasilitas-hero {
            position: relative;
            overflow: hidden;
            background:
                linear-gradient(
                    135deg,
                    var(--primary-green) 0%,
                    color-mix(
                        in srgb,
                        var(--primary-green) 75%,
                        #000 25%
                    ) 100%
                );
        }

        .min-vh-50 {
            min-height: 430px;
        }


        .hero-icon-wrapper {
            width: 220px;
            height: 220px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background: rgba(255, 255, 255, 0.08);

            border: 1px solid rgba(255, 255, 255, 0.12);

            box-shadow:
                0 20px 60px rgba(0, 0, 0, 0.15);

            backdrop-filter: blur(10px);
        }

        .hero-icon-wrapper i {
            font-size: 7rem;
            color: rgba(255, 255, 255, 0.9);
        }


        /* ============================================================
           SECTION
        ============================================================ */

        .section-label {
            display: inline-block;

            font-size: 0.75rem;
            font-weight: 700;

            letter-spacing: 0.12em;

            color: var(--primary-green);

            margin-bottom: 0.75rem;
        }


        /* ============================================================
           STATISTIC
        ============================================================ */

        .facility-stat-card {
            display: flex;
            align-items: center;
            gap: 1.25rem;

            padding: 1.5rem;

            background: var(--bs-body-bg);

            border: 1px solid var(--bs-border-color);

            border-radius: 1.25rem;

            box-shadow:
                0 10px 30px rgba(0, 0, 0, 0.06);
        }

        .facility-stat-icon {
            width: 64px;
            height: 64px;

            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 1rem;

            background: color-mix(
                in srgb,
                var(--primary-green) 10%,
                transparent
            );

            color: var(--primary-green);

            font-size: 1.75rem;
        }


        /* ============================================================
           FACILITY CARD
        ============================================================ */

        .facility-card {
            transition:
                transform 0.3s ease,
                box-shadow 0.3s ease;
        }

        .facility-card:hover {
            transform: translateY(-8px);

            box-shadow:
                0 20px 45px rgba(0, 0, 0, 0.12) !important;
        }


        /* ============================================================
           IMAGE
        ============================================================ */

        .facility-image-wrapper {
            position: relative;

            height: 240px;

            overflow: hidden;

            background:
                color-mix(
                    in srgb,
                    var(--primary-green) 8%,
                    var(--bs-tertiary-bg)
                );
        }

        .facility-image {
            width: 100%;
            height: 100%;

            object-fit: cover;

            transition:
                transform 0.5s ease;
        }

        .facility-card:hover .facility-image {
            transform: scale(1.06);
        }


        .facility-image-placeholder {
            width: 100%;
            height: 100%;

            display: flex;
            align-items: center;
            justify-content: center;

            color: color-mix(
                in srgb,
                var(--primary-green) 45%,
                var(--bs-secondary-color)
            );

            font-size: 5rem;
        }


        /* ============================================================
           NUMBER
        ============================================================ */

        .facility-number {
            position: absolute;

            top: 1rem;
            left: 1rem;

            width: 48px;
            height: 48px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background: rgba(255, 255, 255, 0.92);

            color: var(--primary-green);

            font-weight: 800;

            box-shadow:
                0 5px 15px rgba(0, 0, 0, 0.12);
        }


        /* ============================================================
           FACILITY INFO
        ============================================================ */

        .facility-info {
            display: flex;
            align-items: center;

            gap: 0.75rem;

            padding: 0.75rem 0;

            border-top: 1px solid var(--bs-border-color);
        }

        .facility-info-icon {
            width: 38px;
            height: 38px;

            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 0.75rem;

            background:
                color-mix(
                    in srgb,
                    var(--primary-green) 10%,
                    transparent
                );

            color: var(--primary-green);
        }


        /* ============================================================
           BENEFIT
        ============================================================ */

        .benefit-card {
            height: 100%;

            padding: 2rem;

            text-align: center;

            background: var(--bs-body-bg);

            border: 1px solid var(--bs-border-color);

            border-radius: 1.25rem;

            transition:
                transform 0.3s ease,
                box-shadow 0.3s ease;
        }

        .benefit-card:hover {
            transform: translateY(-6px);

            box-shadow:
                0 15px 35px rgba(0, 0, 0, 0.08);
        }


        .benefit-icon {
            width: 70px;
            height: 70px;

            margin: 0 auto 1.25rem;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 1.25rem;

            background:
                color-mix(
                    in srgb,
                    var(--primary-green) 10%,
                    transparent
                );

            color: var(--primary-green);

            font-size: 2rem;
        }


        /* ============================================================
           EMPTY STATE
        ============================================================ */

        .empty-state {
            padding: 5rem 1.5rem;

            text-align: center;

            border: 1px dashed var(--bs-border-color);

            border-radius: 1.5rem;

            background: var(--bs-tertiary-bg);
        }

        .empty-state-icon {
            width: 90px;
            height: 90px;

            margin: auto;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background:
                color-mix(
                    in srgb,
                    var(--primary-green) 10%,
                    transparent
                );

            color: var(--primary-green);

            font-size: 3rem;
        }


        /* ============================================================
           CTA
        ============================================================ */

        .cta-card {
            padding: 3rem;

            border-radius: 1.5rem;

            background:
                linear-gradient(
                    135deg,
                    var(--primary-green),
                    color-mix(
                        in srgb,
                        var(--primary-green) 75%,
                        #000 25%
                    )
                );

            box-shadow:
                0 20px 50px
                color-mix(
                    in srgb,
                    var(--primary-green) 20%,
                    transparent
                );
        }


        /* ============================================================
           ANIMATION
        ============================================================ */

        .animate-on-scroll {
            opacity: 0;

            transform: translateY(25px);

            transition:
                opacity 0.7s ease,
                transform 0.7s ease;
        }

        .animate-on-scroll.is-visible {
            opacity: 1;

            transform: translateY(0);
        }


        /* ============================================================
           RESPONSIVE
        ============================================================ */

        @media (max-width: 767.98px) {

            .min-vh-50 {
                min-height: 380px;
            }

            .fasilitas-hero {
                padding: 2rem 0;
            }

            .facility-image-wrapper {
                height: 220px;
            }

            .cta-card {
                padding: 2rem;
            }

        }


        /* ============================================================
           REDUCED MOTION
        ============================================================ */

        @media (prefers-reduced-motion: reduce) {

            .animate-on-scroll {
                opacity: 1;

                transform: none;

                transition: none;
            }

            .facility-card,
            .benefit-card,
            .facility-image {
                transition: none;
            }

        }

    </style>
    {{-- ============================================================
        HERO
    ============================================================ --}}
    <section class="fasilitas-hero">
        <div class="container">
            <div class="row align-items-center min-vh-50">
                <div class="col-lg-8">

                    {{-- Breadcrumb --}}
                    <nav aria-label="breadcrumb" class="mb-4 animate-on-scroll">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/') }}"
                                   class="text-white text-decoration-none">
                                    Beranda
                                </a>
                            </li>

                            <li class="breadcrumb-item">
                                Akademik
                            </li>

                            <li class="breadcrumb-item active text-white"
                                aria-current="page">
                                Fasilitas
                            </li>
                        </ol>
                    </nav>

                    <div class="animate-on-scroll">

                    <span class="badge bg-white bg-opacity-10 text-white rounded-pill px-3 py-2 mb-3">
                        <i class="bi bi-building me-2"></i>
                        Fasilitas Sekolah
                    </span>

                        <h1 class="display-4 fw-bold text-white mb-3">
                            Fasilitas
                            <span class="text-warning">
                            Sekolah
                        </span>
                        </h1>

                        <p class="lead text-white text-opacity-75 mb-0"
                           style="max-width: 700px;">
                            Berbagai fasilitas yang disediakan untuk mendukung
                            kegiatan belajar, pengembangan potensi, dan kenyamanan
                            seluruh warga sekolah.
                        </p>

                    </div>
                </div>

                {{-- Icon --}}
                <div class="col-lg-4 d-none d-lg-flex justify-content-center">
                    <div class="hero-icon-wrapper animate-on-scroll">
                        <i class="bi bi-building"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- ============================================================
        INTRODUCTION
    ============================================================ --}}
    <section class="py-5 bg-body-tertiary">

        <div class="container">

            <div class="row align-items-center g-4">

                {{-- Text --}}
                <div class="col-lg-8">

                    <div class="animate-on-scroll">

                    <span class="section-label">
                        SARANA & PRASARANA
                    </span>

                        <h2 class="fw-bold text-custom-green mb-3">
                            Mendukung Pembelajaran yang Optimal
                        </h2>

                        <p class="text-body-secondary fs-5 mb-0">
                            SMA Islam As-Syafi'iyah 01 menyediakan berbagai fasilitas
                            yang dapat menunjang proses pembelajaran, kegiatan
                            akademik, pengembangan bakat, serta aktivitas siswa
                            di lingkungan sekolah.
                        </p>

                    </div>

                </div>

                {{-- Statistic --}}
                <div class="col-lg-4">

                    <div class="facility-stat-card animate-on-scroll">

                        <div class="facility-stat-icon">
                            <i class="bi bi-buildings"></i>
                        </div>

                        <div>
                            <div class="display-6 fw-bold text-custom-green">
                                {{ $fasilitas->count() }}
                            </div>

                            <div class="text-body-secondary">
                                Fasilitas Tersedia
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- ============================================================
        DAFTAR FASILITAS
    ============================================================ --}}
    <section class="py-5">

        <div class="container">

            <div class="text-center mb-5 animate-on-scroll">

            <span class="section-label">
                SARANA SEKOLAH
            </span>

                <h2 class="fw-bold text-custom-green mb-2">
                    Fasilitas yang Kami Miliki
                </h2>

                <p class="text-body-secondary mb-0 mx-auto"
                   style="max-width: 700px;">
                    Jelajahi berbagai fasilitas yang tersedia untuk mendukung
                    aktivitas pembelajaran dan kegiatan siswa.
                </p>

            </div>


            @if($fasilitas->count())

                <div class="row g-4">

                    @foreach($fasilitas as $index => $item)

                        <div class="col-md-6 col-lg-4 animate-on-scroll"
                             style="transition-delay: {{ ($index % 3) * 0.1 }}s;">

                            <div class="card facility-card h-100 border-0 shadow-sm rounded-4 overflow-hidden">

                                {{-- Image --}}
                                <div class="facility-image-wrapper">

                                    @if($item->foto)

                                        <img
                                            src="{{ asset('images/fasilitas/' . $item->foto) }}"
                                            alt="{{ $item->nama }}"
                                            class="facility-image"
                                            loading="lazy"
                                        >

                                    @else

                                        <div class="facility-image-placeholder">
                                            <i class="bi bi-building"></i>
                                        </div>

                                    @endif


                                    {{-- Number --}}
                                    <div class="facility-number">
                                        {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                    </div>

                                </div>


                                {{-- Content --}}
                                <div class="card-body p-4 d-flex flex-column">

                                    <h4 class="fw-bold mb-2">
                                        {{ $item->nama }}
                                    </h4>


                                    @if($item->deskripsi)

                                        <p class="text-body-secondary mb-4">
                                            {{ $item->deskripsi }}
                                        </p>

                                    @endif


                                    {{-- Additional Information --}}
                                    <div class="mt-auto">

                                        @if($item->lokasi)

                                            <div class="facility-info">

                                                <div class="facility-info-icon">
                                                    <i class="bi bi-geo-alt"></i>
                                                </div>

                                                <div>
                                                    <small class="text-body-secondary d-block">
                                                        Lokasi
                                                    </small>

                                                    <span class="fw-semibold">
                                                    {{ $item->lokasi }}
                                                </span>
                                                </div>

                                            </div>

                                        @endif


                                        @if($item->jumlah)

                                            <div class="facility-info">

                                                <div class="facility-info-icon">
                                                    <i class="bi bi-grid-3x3-gap"></i>
                                                </div>

                                                <div>
                                                    <small class="text-body-secondary d-block">
                                                        Jumlah
                                                    </small>

                                                    <span class="fw-semibold">
                                                    {{ $item->jumlah }}
                                                </span>
                                                </div>

                                            </div>

                                        @endif

                                    </div>

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                {{-- Empty State --}}
                <div class="empty-state animate-on-scroll">

                    <div class="empty-state-icon">
                        <i class="bi bi-building"></i>
                    </div>

                    <h4 class="fw-bold text-body-secondary mt-4">
                        Data Fasilitas Belum Tersedia
                    </h4>

                    <p class="text-body-secondary mb-0">
                        Informasi fasilitas sekolah akan ditampilkan
                        di halaman ini.
                    </p>

                </div>

            @endif

        </div>

    </section>


    {{-- ============================================================
        KEUNGGULAN FASILITAS
    ============================================================ --}}
    <section class="py-5 bg-body-tertiary">

        <div class="container">

            <div class="text-center mb-5 animate-on-scroll">

            <span class="section-label">
                UNTUK SISWA
            </span>

                <h2 class="fw-bold text-custom-green mb-2">
                    Fasilitas untuk Mendukung Potensi Siswa
                </h2>

                <p class="text-body-secondary mx-auto mb-0"
                   style="max-width: 700px;">
                    Lingkungan sekolah yang nyaman membantu siswa belajar,
                    berkarya, dan mengembangkan berbagai potensi yang dimiliki.
                </p>

            </div>


            <div class="row g-4">

                {{-- Card 1 --}}
                <div class="col-md-4">

                    <div class="benefit-card animate-on-scroll">

                        <div class="benefit-icon">
                            <i class="bi bi-mortarboard"></i>
                        </div>

                        <h5 class="fw-bold">
                            Pembelajaran
                        </h5>

                        <p class="text-body-secondary mb-0">
                            Fasilitas pembelajaran yang mendukung kegiatan
                            akademik dan proses belajar siswa.
                        </p>

                    </div>

                </div>


                {{-- Card 2 --}}
                <div class="col-md-4">

                    <div class="benefit-card animate-on-scroll">

                        <div class="benefit-icon">
                            <i class="bi bi-stars"></i>
                        </div>

                        <h5 class="fw-bold">
                            Pengembangan Potensi
                        </h5>

                        <p class="text-body-secondary mb-0">
                            Mendukung siswa dalam mengembangkan bakat,
                            minat, kreativitas, dan prestasi.
                        </p>

                    </div>

                </div>


                {{-- Card 3 --}}
                <div class="col-md-4">

                    <div class="benefit-card animate-on-scroll">

                        <div class="benefit-icon">
                            <i class="bi bi-heart"></i>
                        </div>

                        <h5 class="fw-bold">
                            Lingkungan Nyaman
                        </h5>

                        <p class="text-body-secondary mb-0">
                            Menciptakan lingkungan sekolah yang nyaman,
                            aman, dan mendukung aktivitas siswa.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- ============================================================
        CTA
    ============================================================ --}}
    <section class="py-5">

        <div class="container">

            <div class="cta-card animate-on-scroll">

                <div class="row align-items-center g-4">

                    <div class="col-lg-8">

                    <span class="badge bg-white bg-opacity-10 text-white rounded-pill px-3 py-2 mb-3">
                        <i class="bi bi-info-circle me-2"></i>
                        Informasi Sekolah
                    </span>

                        <h2 class="fw-bold text-white mb-2">
                            Kenali Lebih Dekat SMA Islam As-Syafi'iyah 01
                        </h2>

                        <p class="text-white text-opacity-75 mb-0">
                            Temukan berbagai program dan kegiatan yang tersedia
                            untuk mendukung perkembangan peserta didik.
                        </p>

                    </div>

                    <div class="col-lg-4 text-lg-end">

                        <a href="{{ route('ppdb.index') }}"
                           class="btn btn-light btn-lg rounded-pill px-4 fw-semibold">

                            <i class="bi bi-arrow-right-circle me-2"></i>

                            Informasi PPDB

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const elements = document.querySelectorAll(
                '.animate-on-scroll'
            );

            if (!elements.length) {
                return;
            }

            const observer = new IntersectionObserver(
                function (entries) {

                    entries.forEach(function (entry) {

                        if (entry.isIntersecting) {

                            entry.target.classList.add('is-visible');

                            observer.unobserve(entry.target);

                        }

                    });

                },
                {
                    threshold: 0.1
                }
            );

            elements.forEach(function (element) {
                observer.observe(element);
            });

        });
    </script>
@endsection
