@extends('template.app')

@section('title', 'Program Unggulan | SMA Islam As-Syafi\'iyah 01')

@section('content')
    <style>

        /* ========================================================
           HERO
        ======================================================== */

        .program-hero {

            background: var(--primary-green);

            min-height: 390px;

            display: flex;

            align-items: center;

        }


        .hero-circle {

            position: absolute;

            border-radius: 50%;

            pointer-events: none;

            background: rgba(255, 255, 255, 0.05);

        }


        .hero-circle-1 {

            width: 420px;

            height: 420px;

            top: -250px;

            left: -120px;

            animation: heroFloat 8s ease-in-out infinite;

        }


        .hero-circle-2 {

            width: 300px;

            height: 300px;

            right: -120px;

            bottom: -190px;

            background: rgba(255, 255, 255, 0.04);

            animation: heroFloat 10s ease-in-out infinite reverse;

        }


        .hero-circle-3 {

            width: 100px;

            height: 100px;

            right: 15%;

            top: 15%;

            background: rgba(255, 255, 255, 0.035);

            animation: heroFloatSmall 5s ease-in-out infinite;

        }


        .hero-icon-wrapper {

            width: 82px;

            height: 82px;

            border: 1px solid rgba(255, 255, 255, 0.25);

            background: rgba(255, 255, 255, 0.1);

            border-radius: 24px;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 38px;

            backdrop-filter: blur(8px);

            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);

            animation: iconFloat 4s ease-in-out infinite;

        }


        .breadcrumb {

            --bs-breadcrumb-divider-color:
                rgba(255, 255, 255, 0.5);

        }


        .breadcrumb-item + .breadcrumb-item::before {

            color: rgba(255, 255, 255, 0.5);

        }


        /* ========================================================
           MAIN
        ======================================================== */

        .program-section {

            background: var(--bs-body-bg);

        }


        .section-label {

            display: inline-flex;

            align-items: center;

            padding: 8px 16px;

            border-radius: 50px;

            background: rgba(var(--bs-success-rgb), 0.08);

            color: var(--primary-green);

            font-size: 0.85rem;

            font-weight: 600;

        }


        .section-label-light {

            color: #fff;

            background: rgba(255, 255, 255, 0.12);

        }


        /* ========================================================
           STATISTIC
        ======================================================== */

        .program-stat-card {

            padding: 25px 20px;

            border-radius: 20px;

            background: var(--bs-body-bg);

            border: 1px solid var(--bs-border-color);

            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);

            transition:

                transform 0.3s ease,

                box-shadow 0.3s ease;

        }


        .program-stat-card:hover {

            transform: translateY(-5px);

            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.09);

        }


        .stat-icon {

            width: 55px;

            height: 55px;

            border-radius: 16px;

            background: var(--primary-green);

            color: #fff;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 24px;

        }


        .stat-number {

            color: var(--primary-green);

            font-size: 2rem;

            line-height: 1;

            font-weight: 800;

        }


        .stat-label {

            margin-top: 6px;

            color: var(--bs-secondary-color);

            font-size: 0.9rem;

        }


        /* ========================================================
           CARD
        ======================================================== */

        .program-card {

            position: relative;

            background: var(--bs-body-bg);

            border: 1px solid var(--bs-border-color);

            border-radius: 24px;

            overflow: hidden;

            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);

            transition:

                transform 0.4s ease,

                box-shadow 0.4s ease,

                border-color 0.4s ease;

        }


        .program-card:hover {

            transform: translateY(-10px);

            border-color: rgba(var(--bs-success-rgb), 0.25);

            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.12);

        }


        /* ========================================================
           IMAGE
        ======================================================== */

        .program-image-wrapper {

            position: relative;

            height: 260px;

            overflow: hidden;

            background: var(--bs-tertiary-bg);

        }


        .program-image {

            width: 100%;

            height: 100%;

            object-fit: cover;

            display: block;

            transition:

                transform 0.7s cubic-bezier(0.22, 1, 0.36, 1);

        }


        .program-card:hover .program-image {

            transform: scale(1.07);

        }


        .program-placeholder {

            width: 100%;

            height: 100%;

            display: flex;

            align-items: center;

            justify-content: center;

            color: var(--bs-secondary-color);

            font-size: 85px;

        }


        .program-image-overlay {

            position: absolute;

            inset: 0;

            background:
                linear-gradient(
                    to bottom,
                    transparent 45%,
                    rgba(0, 0, 0, 0.45)
                );

            opacity: 0.75;

            pointer-events: none;

        }


        /* ========================================================
           NUMBER
        ======================================================== */

        .program-number {

            position: absolute;

            z-index: 3;

            top: 18px;

            left: 18px;

            min-width: 45px;

            height: 45px;

            padding: 0 10px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 14px;

            background: rgba(255, 255, 255, 0.92);

            color: var(--primary-green);

            font-size: 0.85rem;

            font-weight: 800;

            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);

            backdrop-filter: blur(8px);

        }


        /* ========================================================
           IMAGE ICON
        ======================================================== */

        .program-image-icon {

            position: absolute;

            z-index: 3;

            right: 18px;

            bottom: 18px;

            width: 46px;

            height: 46px;

            border-radius: 50%;

            background: var(--primary-green);

            color: #fff;

            display: flex;

            align-items: center;

            justify-content: center;

            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);

            transition:

                transform 0.3s ease;

        }


        .program-card:hover .program-image-icon {

            transform: rotate(8deg) scale(1.08);

        }


        /* ========================================================
           CONTENT
        ======================================================== */

        .program-content {

            padding: 25px 25px 22px;

        }


        .program-badge {

            display: inline-flex;

            align-items: center;

            padding: 6px 11px;

            margin-bottom: 13px;

            border-radius: 50px;

            background: rgba(var(--bs-success-rgb), 0.08);

            color: var(--primary-green);

            font-size: 0.72rem;

            font-weight: 700;

        }


        .program-title {

            margin: 0 0 13px;

            color: var(--bs-body-color);

            font-size: 1.2rem;

            line-height: 1.4;

            font-weight: 700;

        }


        .program-description {

            color: var(--bs-secondary-color);

            font-size: 0.88rem;

            line-height: 1.75;

        }


        .program-description p:last-child {

            margin-bottom: 0;

        }


        .program-description ul,

        .program-description ol {

            padding-left: 20px;

        }


        .program-description img {

            max-width: 100%;

            height: auto;

            border-radius: 10px;

        }


        /* ========================================================
           EMPTY
        ======================================================== */

        .program-empty-state {

            padding: 60px 30px;

            border-radius: 24px;

            background: var(--bs-tertiary-bg);

            border: 1px dashed var(--bs-border-color);

        }


        .empty-icon {

            width: 80px;

            height: 80px;

            margin: 0 auto 20px;

            border-radius: 24px;

            background: var(--bs-body-bg);

            color: var(--bs-secondary-color);

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 40px;

        }


        /* ========================================================
           FOCUS
        ======================================================== */

        .program-focus {

            background: var(--primary-green);

        }


        .focus-card {

            padding: 30px;

            border-radius: 24px;

            border: 1px solid rgba(255, 255, 255, 0.12);

            background: rgba(255, 255, 255, 0.08);

            color: #fff;

            backdrop-filter: blur(8px);

            transition:

                transform 0.35s ease,

                background 0.35s ease;

        }


        .focus-card:hover {

            transform: translateY(-8px);

            background: rgba(255, 255, 255, 0.12);

        }


        .focus-icon {

            width: 58px;

            height: 58px;

            margin-bottom: 22px;

            border-radius: 17px;

            background: rgba(255, 255, 255, 0.12);

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 25px;

        }


        .focus-card h4 {

            font-size: 1.1rem;

            margin-bottom: 12px;

        }


        .focus-card p {

            font-size: 0.88rem;

            line-height: 1.75;

        }


        /* ========================================================
           CTA
        ======================================================== */

        .program-cta {

            background: var(--bs-tertiary-bg);

        }


        .cta-icon {

            width: 55px;

            height: 55px;

            border-radius: 16px;

            background: var(--primary-green);

            color: #fff;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 25px;

        }


        .cta-button {

            transition:

                transform 0.3s ease,

                box-shadow 0.3s ease;

        }


        .cta-button:hover {

            transform: translateY(-3px);

            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);

        }


        /* ========================================================
           ANIMATION
        ======================================================== */

        .animate-on-scroll {

            opacity: 0;

            transform: translateY(35px);

            transition:

                opacity 0.7s ease,

                transform 0.7s ease;

        }


        .animate-on-scroll.show {

            opacity: 1;

            transform: translateY(0);

        }


        @keyframes heroFloat {

            0%, 100% {

                transform: translateY(0);

            }

            50% {

                transform: translateY(20px);

            }

        }


        @keyframes heroFloatSmall {

            0%, 100% {

                transform: translateY(0) rotate(0deg);

            }

            50% {

                transform: translateY(-15px) rotate(10deg);

            }

        }


        @keyframes iconFloat {

            0%, 100% {

                transform: translateY(0);

            }

            50% {

                transform: translateY(-7px);

            }

        }


        /* ========================================================
           RESPONSIVE
        ======================================================== */

        @media (max-width: 767.98px) {

            .program-hero {

                min-height: 350px;

            }


            .program-hero h1 {

                font-size: 2.2rem;

            }


            .program-hero p {

                font-size: 1rem;

            }


            .program-image-wrapper {

                height: 230px;

            }


            .program-content {

                padding: 24px 20px 22px;

            }


            .focus-card {

                padding: 25px;

            }

        }


        /* ========================================================
           REDUCED MOTION
        ======================================================== */

        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {

                animation-duration: 0.01ms !important;

                animation-iteration-count: 1 !important;

                transition-duration: 0.01ms !important;

            }


            .animate-on-scroll {

                opacity: 1;

                transform: none;

            }

        }

    </style>
    {{-- ============================================================
        HERO
    ============================================================ --}}
    <section class="program-hero text-white position-relative overflow-hidden">

        <div class="hero-circle hero-circle-1"></div>
        <div class="hero-circle hero-circle-2"></div>
        <div class="hero-circle hero-circle-3"></div>

        <div class="container position-relative py-5">

            {{-- Breadcrumb --}}
            <div class="mb-4 animate-on-scroll">

                <nav aria-label="breadcrumb">

                    <ol class="breadcrumb mb-0 justify-content-center">

                        <li class="breadcrumb-item">

                            <a
                                href="{{ url('/') }}"
                                class="text-white text-decoration-none opacity-75"
                            >
                                Beranda
                            </a>

                        </li>

                        <li class="breadcrumb-item">

                            <span class="text-white opacity-75">
                                Akademik
                            </span>

                        </li>

                        <li
                            class="breadcrumb-item active text-white"
                            aria-current="page"
                        >
                            Program Unggulan
                        </li>

                    </ol>

                </nav>

            </div>


            {{-- Hero Content --}}
            <div class="row justify-content-center text-center">

                <div class="col-lg-8">

                    <div class="hero-icon-wrapper mx-auto mb-4 animate-on-scroll">

                        <i class="bi bi-stars"></i>

                    </div>

                    <h1 class="display-5 fw-bold mb-3 animate-on-scroll">
                        Program Unggulan
                    </h1>

                    <p class="lead mb-0 opacity-75 animate-on-scroll">
                        Berbagai program unggulan yang dirancang untuk
                        mengembangkan potensi, prestasi, karakter, dan
                        keterampilan peserta didik.
                    </p>

                </div>

            </div>

        </div>

    </section>


    {{-- ============================================================
        INTRODUCTION
    ============================================================ --}}
    <section class="py-5 program-section">

        <div class="container">

            <div class="row justify-content-center mb-5">

                <div class="col-lg-8 text-center animate-on-scroll">

                    <span class="section-label">

                        <i class="bi bi-award-fill me-2"></i>

                        Keunggulan Sekolah

                    </span>

                    <h2 class="display-6 fw-bold text-custom-green mt-3 mb-3">
                        Program Unggulan Kami
                    </h2>

                    <p class="text-body-secondary mb-0">
                        Program unggulan SMA Islam As-Syafi'iyah 01
                        menjadi bagian dari upaya sekolah dalam memberikan
                        pengalaman pendidikan yang berkualitas dan
                        berkesinambungan.
                    </p>

                </div>

            </div>


            @if($programUnggulans->count())

                {{-- ====================================================
                    STATISTIC
                ==================================================== --}}
                <div class="row justify-content-center mb-5">

                    <div class="col-md-4 col-lg-3 animate-on-scroll">

                        <div class="program-stat-card text-center">

                            <div class="stat-icon mx-auto mb-3">

                                <i class="bi bi-stars"></i>

                            </div>

                            <div class="stat-number">
                                {{ $programUnggulans->count() }}
                            </div>

                            <div class="stat-label">
                                Program Unggulan
                            </div>

                        </div>

                    </div>

                </div>


                {{-- ====================================================
                    PROGRAM CARDS
                ==================================================== --}}
                <div class="row g-4">

                    @foreach($programUnggulans as $index => $program)

                        <div
                            class="col-md-6 col-lg-4 animate-on-scroll"
                            style="transition-delay: {{ min($index * 0.08, 0.5) }}s;"
                        >

                            <article class="program-card h-100">

                                {{-- Image --}}
                                <div class="program-image-wrapper">

                                    <div class="program-number">

                                        {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}

                                    </div>


                                    @if($program->foto)

                                        <img
                                            src="{{ asset('images/program-unggulan/' . $program->foto) }}"
                                            alt="{{ $program->judul }}"
                                            class="program-image"
                                            loading="lazy"
                                        >

                                    @else

                                        <div class="program-placeholder">

                                            <i class="bi bi-stars"></i>

                                        </div>

                                    @endif


                                    <div class="program-image-overlay"></div>


                                    <div class="program-image-icon">

                                        <i class="bi bi-award-fill"></i>

                                    </div>

                                </div>


                                {{-- Content --}}
                                <div class="program-content">

                                    <div class="program-badge">

                                        <i class="bi bi-check-circle-fill me-1"></i>

                                        Program Unggulan

                                    </div>


                                    <h3 class="program-title">

                                        {{ $program->judul }}

                                    </h3>


                                    @if($program->deskripsi)

                                        <div class="program-description">

                                            {!! nl2br(e($program->deskripsi)) !!}

                                        </div>

                                    @else

                                        <p class="program-description mb-0">

                                            Program unggulan sekolah untuk
                                            mendukung perkembangan dan potensi
                                            peserta didik.

                                        </p>

                                    @endif

                                </div>

                            </article>

                        </div>

                    @endforeach

                </div>

            @else

                {{-- ====================================================
                    EMPTY STATE
                ==================================================== --}}
                <div class="row justify-content-center">

                    <div class="col-md-7 col-lg-6">

                        <div class="program-empty-state text-center animate-on-scroll">

                            <div class="empty-icon">

                                <i class="bi bi-stars"></i>

                            </div>

                            <h4 class="fw-bold mb-2">
                                Program Unggulan Belum Tersedia
                            </h4>

                            <p class="text-body-secondary mb-0">
                                Informasi mengenai program unggulan sekolah
                                akan ditampilkan di halaman ini.
                            </p>

                        </div>

                    </div>

                </div>

            @endif

        </div>

    </section>


    {{-- ============================================================
        NILAI / FOCUS PROGRAM
    ============================================================ --}}
    <section class="program-focus py-5">

        <div class="container">

            <div class="row justify-content-center mb-5">

                <div class="col-lg-8 text-center animate-on-scroll">

                    <span class="section-label section-label-light">

                        <i class="bi bi-lightning-charge-fill me-2"></i>

                        Fokus Pengembangan

                    </span>

                    <h2 class="display-6 fw-bold text-white mt-3 mb-3">
                        Mengembangkan Potensi Peserta Didik
                    </h2>

                    <p class="text-white opacity-75 mb-0">
                        Setiap program dirancang untuk memberikan ruang
                        kepada peserta didik dalam mengembangkan kemampuan
                        akademik, karakter, dan keterampilan.
                    </p>

                </div>

            </div>


            <div class="row g-4">

                {{-- Akademik --}}
                <div class="col-md-4 animate-on-scroll">

                    <div class="focus-card h-100">

                        <div class="focus-icon">

                            <i class="bi bi-book-fill"></i>

                        </div>

                        <h4 class="fw-bold">
                            Akademik
                        </h4>

                        <p class="mb-0 opacity-75">
                            Mendorong peserta didik untuk meningkatkan
                            kemampuan akademik, berpikir kritis, dan
                            mencapai prestasi terbaik.
                        </p>

                    </div>

                </div>


                {{-- Karakter --}}
                <div class="col-md-4 animate-on-scroll">

                    <div class="focus-card h-100">

                        <div class="focus-icon">

                            <i class="bi bi-heart-fill"></i>

                        </div>

                        <h4 class="fw-bold">
                            Karakter
                        </h4>

                        <p class="mb-0 opacity-75">
                            Membentuk pribadi yang berakhlak, disiplin,
                            bertanggung jawab, dan memiliki kepedulian
                            terhadap sesama.
                        </p>

                    </div>

                </div>


                {{-- Prestasi --}}
                <div class="col-md-4 animate-on-scroll">

                    <div class="focus-card h-100">

                        <div class="focus-icon">

                            <i class="bi bi-trophy-fill"></i>

                        </div>

                        <h4 class="fw-bold">
                            Prestasi
                        </h4>

                        <p class="mb-0 opacity-75">
                            Memberikan kesempatan kepada peserta didik
                            untuk mengembangkan bakat dan meraih berbagai
                            prestasi.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- ============================================================
        CTA
    ============================================================ --}}
    <section class="program-cta py-5">

        <div class="container">

            <div class="row align-items-center justify-content-between">

                <div class="col-lg-8 mb-4 mb-lg-0 animate-on-scroll">

                    <div class="d-flex align-items-start gap-3">

                        <div class="cta-icon flex-shrink-0">

                            <i class="bi bi-stars"></i>

                        </div>

                        <div>

                            <h3 class="fw-bold mb-2">
                                Wujudkan Potensi Terbaik
                            </h3>

                            <p class="mb-0 text-body-secondary">
                                Bergabunglah bersama SMA Islam
                                As-Syafi'iyah 01 dan kembangkan potensi
                                melalui berbagai program unggulan sekolah.
                            </p>

                        </div>

                    </div>

                </div>


                <div class="col-lg-auto animate-on-scroll">

                    <a
                        href="{{ url('/ppdb') }}"
                        class="btn btn-custom-green rounded-pill px-4 py-3 fw-semibold cta-button"
                    >

                        <i class="bi bi-arrow-right-circle me-2"></i>

                        Daftar PPDB

                    </a>

                </div>

            </div>

        </div>

    </section>
    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const elements =
                document.querySelectorAll('.animate-on-scroll');


            if (!elements.length) {

                return;

            }


            const observer = new IntersectionObserver(

                function (entries, observer) {

                    entries.forEach(function (entry) {

                        if (entry.isIntersecting) {

                            entry.target.classList.add('show');

                            observer.unobserve(entry.target);

                        }

                    });

                },

                {

                    threshold: 0.12,

                    rootMargin: '0px 0px -40px 0px'

                }

            );


            elements.forEach(function (element) {

                observer.observe(element);

            });

        });

    </script>



@endsection
