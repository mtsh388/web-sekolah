@extends('template.app')

@section('title', 'Kurikulum | SMA Islam As-Syafi\'iyah 01')

@section('content')
    <style>

        /* ========================================================
           HERO
        ======================================================== */

        .kurikulum-hero {

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

            --bs-breadcrumb-divider-color: rgba(255, 255, 255, 0.5);

        }


        .breadcrumb-item + .breadcrumb-item::before {

            color: rgba(255, 255, 255, 0.5);

        }


        /* ========================================================
           MAIN SECTION
        ======================================================== */

        .kurikulum-section {

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

        .kurikulum-stat-card {

            padding: 25px 20px;

            border-radius: 20px;

            background: var(--bs-body-bg);

            border: 1px solid var(--bs-border-color);

            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);

            transition:

                transform 0.3s ease,

                box-shadow 0.3s ease;

        }


        .kurikulum-stat-card:hover {

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

        .kurikulum-card {

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


        .kurikulum-card:hover {

            transform: translateY(-10px);

            border-color: rgba(var(--bs-success-rgb), 0.25);

            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.12);

        }


        /* ========================================================
           IMAGE
        ======================================================== */

        .kurikulum-image-wrapper {

            position: relative;

            height: 250px;

            overflow: hidden;

            background: var(--bs-tertiary-bg);

        }


        .kurikulum-image {

            width: 100%;

            height: 100%;

            object-fit: cover;

            display: block;

            transition:

                transform 0.7s cubic-bezier(0.22, 1, 0.36, 1);

        }


        .kurikulum-card:hover .kurikulum-image {

            transform: scale(1.07);

        }


        .kurikulum-placeholder {

            width: 100%;

            height: 100%;

            display: flex;

            align-items: center;

            justify-content: center;

            color: var(--bs-secondary-color);

            font-size: 80px;

        }


        .kurikulum-image-overlay {

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

        .kurikulum-number {

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

        .kurikulum-image-icon {

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


        .kurikulum-card:hover .kurikulum-image-icon {

            transform: rotate(8deg) scale(1.08);

        }


        /* ========================================================
           CONTENT
        ======================================================== */

        .kurikulum-content {

            padding: 28px 25px 22px;

        }


        .kurikulum-title {

            margin: 0 0 15px;

            color: var(--bs-body-color);

            font-size: 1.2rem;

            line-height: 1.4;

            font-weight: 700;

        }


        .kurikulum-description {

            color: var(--bs-secondary-color);

            font-size: 0.88rem;

            line-height: 1.75;

        }


        .kurikulum-description p:last-child {

            margin-bottom: 0;

        }


        .kurikulum-description ul,

        .kurikulum-description ol {

            padding-left: 20px;

        }


        .kurikulum-description img {

            max-width: 100%;

            height: auto;

            border-radius: 10px;

        }


        .kurikulum-footer {

            margin-top: 20px;

            padding-top: 15px;

            border-top: 1px solid var(--bs-border-color);

        }


        .kurikulum-footer span {

            color: var(--primary-green);

            font-size: 0.78rem;

            font-weight: 600;

        }


        /* ========================================================
           EMPTY
        ======================================================== */

        .kurikulum-empty-state {

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
           PRINCIPLES
        ======================================================== */

        .kurikulum-principles {

            background: var(--primary-green);

        }


        .principle-card {

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


        .principle-card:hover {

            transform: translateY(-8px);

            background: rgba(255, 255, 255, 0.12);

        }


        .principle-icon {

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


        .principle-card h4 {

            font-size: 1.1rem;

            margin-bottom: 12px;

        }


        .principle-card p {

            font-size: 0.88rem;

            line-height: 1.75;

        }


        /* ========================================================
           CTA
        ======================================================== */

        .kurikulum-cta {

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

            .kurikulum-hero {

                min-height: 350px;

            }


            .kurikulum-hero h1 {

                font-size: 2.2rem;

            }


            .kurikulum-hero p {

                font-size: 1rem;

            }


            .kurikulum-image-wrapper {

                height: 230px;

            }


            .kurikulum-content {

                padding: 24px 20px 22px;

            }


            .principle-card {

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
    <section class="kurikulum-hero text-white position-relative overflow-hidden">

        {{-- Decorative Circle --}}
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
                            Kurikulum
                        </li>

                    </ol>

                </nav>

            </div>

            {{-- Hero Content --}}
            <div class="row justify-content-center text-center">

                <div class="col-lg-8">

                    <div class="hero-icon-wrapper mx-auto mb-4 animate-on-scroll">

                        <i class="bi bi-journal-bookmark-fill"></i>

                    </div>

                    <h1 class="display-5 fw-bold mb-3 animate-on-scroll">
                        Kurikulum
                    </h1>

                    <p class="lead mb-0 opacity-75 animate-on-scroll">
                        Kurikulum sebagai landasan pembelajaran dalam
                        mengembangkan kompetensi, karakter, dan potensi
                        peserta didik.
                    </p>

                </div>

            </div>

        </div>

    </section>


    {{-- ============================================================
        INTRODUCTION
    ============================================================ --}}
    <section class="py-5 kurikulum-section">

        <div class="container">

            <div class="row justify-content-center mb-5">

                <div class="col-lg-8 text-center animate-on-scroll">

                    <span class="section-label">

                        <i class="bi bi-mortarboard-fill me-2"></i>

                        Akademik Sekolah

                    </span>

                    <h2 class="display-6 fw-bold text-custom-green mt-3 mb-3">
                        Kurikulum Pembelajaran
                    </h2>

                    <p class="text-body-secondary mb-0">
                        SMA Islam As-Syafi'iyah 01 berkomitmen menghadirkan
                        proses pembelajaran yang relevan, bermakna, dan
                        berorientasi pada perkembangan peserta didik.
                    </p>

                </div>

            </div>


            @if($kurikulums->count())

                {{-- ====================================================
                    STATISTIC
                ==================================================== --}}
                <div class="row justify-content-center mb-5">

                    <div class="col-md-4 col-lg-3 animate-on-scroll">

                        <div class="kurikulum-stat-card text-center">

                            <div class="stat-icon mx-auto mb-3">

                                <i class="bi bi-journal-richtext"></i>

                            </div>

                            <div class="stat-number">
                                {{ $kurikulums->count() }}
                            </div>

                            <div class="stat-label">
                                Materi Kurikulum
                            </div>

                        </div>

                    </div>

                </div>


                {{-- ====================================================
                    KURIKULUM CARDS
                ==================================================== --}}
                <div class="row g-4">

                    @foreach($kurikulums as $index => $kurikulum)

                        <div
                            class="col-md-6 col-lg-4 animate-on-scroll"
                            style="transition-delay: {{ min($index * 0.08, 0.5) }}s;"
                        >

                            <article class="kurikulum-card h-100">

                                {{-- Image --}}
                                <div class="kurikulum-image-wrapper">

                                    <div class="kurikulum-number">

                                        {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}

                                    </div>


                                    @if($kurikulum->foto)

                                        <img
                                            src="{{ asset('images/kurikulum/' . $kurikulum->foto) }}"
                                            alt="{{ $kurikulum->judul }}"
                                            class="kurikulum-image"
                                            loading="lazy"
                                        >

                                    @else

                                        <div class="kurikulum-placeholder">

                                            <i class="bi bi-journal-bookmark-fill"></i>

                                        </div>

                                    @endif


                                    <div class="kurikulum-image-overlay"></div>


                                    <div class="kurikulum-image-icon">

                                        <i class="bi bi-book-half"></i>

                                    </div>

                                </div>


                                {{-- Content --}}
                                <div class="kurikulum-content">

                                    <h3 class="kurikulum-title">
                                        {{ $kurikulum->judul }}
                                    </h3>


                                    @if($kurikulum->deskripsi)

                                        <div class="kurikulum-description">

                                            {!! nl2br(e($kurikulum->deskripsi)) !!}

                                        </div>

                                    @endif


                                    <div class="kurikulum-footer">

                                        <span>
                                            <i class="bi bi-check-circle-fill me-1"></i>
                                            Program Akademik
                                        </span>

                                    </div>

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

                        <div class="kurikulum-empty-state text-center animate-on-scroll">

                            <div class="empty-icon">

                                <i class="bi bi-journal-x"></i>

                            </div>

                            <h4 class="fw-bold mb-2">
                                Data Kurikulum Belum Tersedia
                            </h4>

                            <p class="text-body-secondary mb-0">
                                Informasi mengenai kurikulum sekolah akan
                                ditampilkan di halaman ini.
                            </p>

                        </div>

                    </div>

                </div>

            @endif

        </div>

    </section>


    {{-- ============================================================
        BENEFIT / PRINCIPLES
    ============================================================ --}}
    <section class="kurikulum-principles py-5">

        <div class="container">

            <div class="row justify-content-center mb-5">

                <div class="col-lg-8 text-center animate-on-scroll">

                    <span class="section-label section-label-light">

                        <i class="bi bi-stars me-2"></i>

                        Prinsip Pembelajaran

                    </span>

                    <h2 class="display-6 fw-bold text-white mt-3 mb-3">
                        Pendidikan yang Bermakna
                    </h2>

                    <p class="text-white opacity-75 mb-0">
                        Pembelajaran dirancang untuk membantu peserta didik
                        berkembang secara akademik maupun karakter.
                    </p>

                </div>

            </div>


            <div class="row g-4">

                {{-- Card 1 --}}
                <div class="col-md-4 animate-on-scroll">

                    <div class="principle-card h-100">

                        <div class="principle-icon">

                            <i class="bi bi-lightbulb-fill"></i>

                        </div>

                        <h4 class="fw-bold">
                            Berpusat pada Peserta Didik
                        </h4>

                        <p class="mb-0 opacity-75">
                            Pembelajaran memperhatikan kebutuhan,
                            karakteristik, minat, dan potensi setiap
                            peserta didik.
                        </p>

                    </div>

                </div>


                {{-- Card 2 --}}
                <div class="col-md-4 animate-on-scroll">

                    <div class="principle-card h-100">

                        <div class="principle-icon">

                            <i class="bi bi-people-fill"></i>

                        </div>

                        <h4 class="fw-bold">
                            Kolaboratif
                        </h4>

                        <p class="mb-0 opacity-75">
                            Mendorong peserta didik untuk bekerja sama,
                            berkomunikasi, dan membangun kemampuan sosial
                            dalam proses pembelajaran.
                        </p>

                    </div>

                </div>


                {{-- Card 3 --}}
                <div class="col-md-4 animate-on-scroll">

                    <div class="principle-card h-100">

                        <div class="principle-icon">

                            <i class="bi bi-award-fill"></i>

                        </div>

                        <h4 class="fw-bold">
                            Pengembangan Karakter
                        </h4>

                        <p class="mb-0 opacity-75">
                            Pendidikan tidak hanya berfokus pada akademik,
                            tetapi juga membangun karakter, akhlak, dan
                            tanggung jawab.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- ============================================================
        CTA
    ============================================================ --}}
    <section class="kurikulum-cta py-5">

        <div class="container">

            <div class="row align-items-center justify-content-between">

                <div class="col-lg-8 mb-4 mb-lg-0 animate-on-scroll">

                    <div class="d-flex align-items-start gap-3">

                        <div class="cta-icon flex-shrink-0">

                            <i class="bi bi-mortarboard-fill"></i>

                        </div>

                        <div>

                            <h3 class="fw-bold mb-2">
                                Membangun Generasi Masa Depan
                            </h3>

                            <p class="mb-0 opacity-75">
                                Bersama kurikulum yang relevan dan tenaga
                                pendidik yang berdedikasi, kami terus
                                menghadirkan pendidikan terbaik bagi
                                peserta didik.
                            </p>

                        </div>

                    </div>

                </div>


                <div class="col-lg-auto animate-on-scroll">

                    <a
                        href="{{ url('/ppdb') }}"
                        class="btn btn-light rounded-pill px-4 py-3 fw-semibold cta-button"
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
