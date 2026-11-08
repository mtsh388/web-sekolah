@extends('template.app')

@section('title', 'Prestasi Siswa | SMA Islam As-Syafi\'iyah 01')

@section('content')
    <style>

        /* ========================================================
           HERO
        ======================================================== */

        .prestasi-hero {

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
           SECTION
        ======================================================== */

        .prestasi-section {

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


        /* ========================================================
           STATISTIC
        ======================================================== */

        .prestasi-stat-card {

            padding: 25px 20px;

            border-radius: 20px;

            background: var(--bs-body-bg);

            border: 1px solid var(--bs-border-color);

            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);

            transition:

                transform 0.3s ease,

                box-shadow 0.3s ease;

        }


        .prestasi-stat-card:hover {

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

        .prestasi-card {

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


        .prestasi-card:hover {

            transform: translateY(-10px);

            border-color: rgba(var(--bs-success-rgb), 0.25);

            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.12);

        }


        /* ========================================================
           IMAGE
        ======================================================== */

        .prestasi-image-wrapper {

            position: relative;

            height: 250px;

            overflow: hidden;

            background: var(--bs-tertiary-bg);

        }


        .prestasi-image {

            width: 100%;

            height: 100%;

            object-fit: cover;

            display: block;

            transition:
                transform 0.7s cubic-bezier(0.22, 1, 0.36, 1);

        }


        .prestasi-card:hover .prestasi-image {

            transform: scale(1.07);

        }


        .prestasi-placeholder {

            width: 100%;

            height: 100%;

            display: flex;

            align-items: center;

            justify-content: center;

            color: var(--bs-secondary-color);

            font-size: 85px;

        }


        .prestasi-image-overlay {

            position: absolute;

            inset: 0;

            background:
                linear-gradient(
                    to bottom,
                    transparent 40%,
                    rgba(0, 0, 0, 0.55)
                );

            pointer-events: none;

        }


        /* ========================================================
           NUMBER
        ======================================================== */

        .prestasi-number {

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
           RANKING
        ======================================================== */

        .prestasi-ranking {

            position: absolute;

            z-index: 3;

            right: 18px;

            bottom: 18px;

            padding: 9px 14px;

            border-radius: 50px;

            background: var(--primary-green);

            color: #fff;

            font-size: 0.75rem;

            font-weight: 700;

            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);

        }


        /* ========================================================
           CONTENT
        ======================================================== */

        .prestasi-content {

            padding: 25px;

        }


        .prestasi-badge {

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


        .prestasi-title {

            margin: 0 0 18px;

            color: var(--bs-body-color);

            font-size: 1.2rem;

            line-height: 1.4;

            font-weight: 700;

        }


        /* ========================================================
           STUDENT
        ======================================================== */

        .student-info {

            display: flex;

            align-items: center;

            gap: 12px;

            padding: 13px;

            margin-bottom: 15px;

            border-radius: 14px;

            background: var(--bs-tertiary-bg);

        }


        .student-icon {

            flex-shrink: 0;

            width: 42px;

            height: 42px;

            border-radius: 12px;

            background: var(--primary-green);

            color: #fff;

            display: flex;

            align-items: center;

            justify-content: center;

        }


        .student-info small {

            display: block;

            margin-bottom: 2px;

            color: var(--bs-secondary-color);

            font-size: 0.68rem;

        }


        .student-info strong {

            display: block;

            color: var(--bs-body-color);

            font-size: 0.86rem;

        }


        .student-info span {

            display: block;

            color: var(--bs-secondary-color);

            font-size: 0.72rem;

            margin-top: 2px;

        }


        /* ========================================================
           DETAILS
        ======================================================== */

        .prestasi-details {

            display: flex;

            flex-direction: column;

            gap: 8px;

            margin-bottom: 15px;

        }


        .detail-item {

            display: flex;

            align-items: center;

            gap: 9px;

            color: var(--bs-secondary-color);

            font-size: 0.8rem;

        }


        .detail-item i {

            width: 18px;

            color: var(--primary-green);

            text-align: center;

        }


        /* ========================================================
           DESCRIPTION
        ======================================================== */

        .prestasi-description {

            padding-top: 15px;

            border-top: 1px solid var(--bs-border-color);

            color: var(--bs-secondary-color);

            font-size: 0.84rem;

            line-height: 1.7;

        }


        .prestasi-description p:last-child {

            margin-bottom: 0;

        }


        .prestasi-description ul,

        .prestasi-description ol {

            padding-left: 20px;

        }


        /* ========================================================
           EMPTY
        ======================================================== */

        .prestasi-empty-state {

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
           MOTIVATION
        ======================================================== */

        .prestasi-motivation {

            background: var(--primary-green);

        }


        .motivation-card {

            padding: 45px 30px;

        }


        .motivation-icon {

            width: 70px;

            height: 70px;

            border-radius: 22px;

            background: rgba(255, 255, 255, 0.12);

            display: flex;

            align-items: center;

            justify-content: center;

            color: #fff;

            font-size: 30px;

        }


        .motivation-card h2 {

            font-size: 1.8rem;

        }


        .motivation-card p {

            max-width: 700px;

            margin-left: auto;

            margin-right: auto;

            line-height: 1.8;

        }


        /* ========================================================
           CTA
        ======================================================== */

        .prestasi-cta {

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

            .prestasi-hero {

                min-height: 350px;

            }


            .prestasi-hero h1 {

                font-size: 2.2rem;

            }


            .prestasi-hero p {

                font-size: 1rem;

            }


            .prestasi-image-wrapper {

                height: 230px;

            }


            .prestasi-content {

                padding: 24px 20px 22px;

            }


            .motivation-card {

                padding: 30px 20px;

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
    <section class="prestasi-hero text-white position-relative overflow-hidden">

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
                            Prestasi Siswa
                        </li>

                    </ol>

                </nav>

            </div>


            {{-- Hero Content --}}
            <div class="row justify-content-center text-center">

                <div class="col-lg-8">

                    <div class="hero-icon-wrapper mx-auto mb-4 animate-on-scroll">

                        <i class="bi bi-trophy-fill"></i>

                    </div>

                    <h1 class="display-5 fw-bold mb-3 animate-on-scroll">
                        Prestasi Siswa
                    </h1>

                    <p class="lead mb-0 opacity-75 animate-on-scroll">
                        Apresiasi atas pencapaian dan prestasi peserta didik
                        dalam bidang akademik maupun nonakademik.
                    </p>

                </div>

            </div>

        </div>

    </section>


    {{-- ============================================================
        PRESTASI
    ============================================================ --}}
    <section class="py-5 prestasi-section">

        <div class="container">

            {{-- Section Heading --}}
            <div class="row justify-content-center mb-5">

                <div class="col-lg-8 text-center animate-on-scroll">

                    <span class="section-label">

                        <i class="bi bi-award-fill me-2"></i>

                        Prestasi & Pencapaian

                    </span>

                    <h2 class="display-6 fw-bold text-custom-green mt-3 mb-3">
                        Prestasi Membanggakan
                    </h2>

                    <p class="text-body-secondary mb-0">
                        Berbagai pencapaian peserta didik menjadi bukti
                        semangat belajar, kerja keras, dan dukungan dari
                        seluruh keluarga besar sekolah.
                    </p>

                </div>

            </div>


            @if($prestasiSiswas->count())

                {{-- ====================================================
                    STATISTICS
                ==================================================== --}}
                <div class="row justify-content-center g-4 mb-5">

                    {{-- Total Prestasi --}}
                    <div class="col-6 col-md-4 col-lg-3 animate-on-scroll">

                        <div class="prestasi-stat-card text-center">

                            <div class="stat-icon mx-auto mb-3">

                                <i class="bi bi-trophy-fill"></i>

                            </div>

                            <div class="stat-number">
                                {{ $prestasiSiswas->count() }}
                            </div>

                            <div class="stat-label">
                                Prestasi
                            </div>

                        </div>

                    </div>


                    {{-- Nasional --}}
                    <div class="col-6 col-md-4 col-lg-3 animate-on-scroll">

                        <div class="prestasi-stat-card text-center">

                            <div class="stat-icon mx-auto mb-3">

                                <i class="bi bi-globe-asia-australia"></i>

                            </div>

                            <div class="stat-number">

                                {{
                                    $prestasiSiswas
                                        ->filter(function ($item) {
                                            return strtolower($item->tingkat ?? '') === 'nasional';
                                        })
                                        ->count()
                                }}

                            </div>

                            <div class="stat-label">
                                Tingkat Nasional
                            </div>

                        </div>

                    </div>


                    {{-- Siswa --}}
                    <div class="col-6 col-md-4 col-lg-3 animate-on-scroll">

                        <div class="prestasi-stat-card text-center">

                            <div class="stat-icon mx-auto mb-3">

                                <i class="bi bi-people-fill"></i>

                            </div>

                            <div class="stat-number">

                                {{ $prestasiSiswas->pluck('nama_siswa')->unique()->count() }}

                            </div>

                            <div class="stat-label">
                                Siswa Berprestasi
                            </div>

                        </div>

                    </div>

                </div>


                {{-- ====================================================
                    PRESTASI CARDS
                ==================================================== --}}
                <div class="row g-4">

                    @foreach($prestasiSiswas as $index => $prestasi)

                        <div
                            class="col-md-6 col-lg-4 animate-on-scroll"
                            style="transition-delay: {{ min($index * 0.08, 0.5) }}s;"
                        >

                            <article class="prestasi-card h-100">

                                {{-- Image --}}
                                <div class="prestasi-image-wrapper">

                                    <div class="prestasi-number">

                                        {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}

                                    </div>


                                    @if($prestasi->foto)

                                        <img
                                            src="{{ asset('images/prestasi-siswa/' . $prestasi->foto) }}"
                                            alt="{{ $prestasi->judul }}"
                                            class="prestasi-image"
                                            loading="lazy"
                                        >

                                    @else

                                        <div class="prestasi-placeholder">

                                            <i class="bi bi-trophy-fill"></i>

                                        </div>

                                    @endif


                                    <div class="prestasi-image-overlay"></div>


                                    @if($prestasi->peringkat)

                                        <div class="prestasi-ranking">

                                            <i class="bi bi-award-fill me-1"></i>

                                            {{ $prestasi->peringkat }}

                                        </div>

                                    @endif

                                </div>


                                {{-- Content --}}
                                <div class="prestasi-content">

                                    {{-- Badge --}}
                                    @if($prestasi->tingkat)

                                        <div class="prestasi-badge">

                                            <i class="bi bi-geo-alt-fill me-1"></i>

                                            {{ $prestasi->tingkat }}

                                        </div>

                                    @else

                                        <div class="prestasi-badge">

                                            <i class="bi bi-award-fill me-1"></i>

                                            Prestasi Siswa

                                        </div>

                                    @endif


                                    {{-- Title --}}
                                    <h3 class="prestasi-title">

                                        {{ $prestasi->judul }}

                                    </h3>


                                    {{-- Student --}}
                                    <div class="student-info">

                                        <div class="student-icon">

                                            <i class="bi bi-person-fill"></i>

                                        </div>

                                        <div>

                                            <small>
                                                Nama Siswa
                                            </small>

                                            <strong>
                                                {{ $prestasi->nama_siswa }}
                                            </strong>

                                            @if($prestasi->kelas)

                                                <span>
                                                    {{ $prestasi->kelas }}
                                                </span>

                                            @endif

                                        </div>

                                    </div>


                                    {{-- Details --}}
                                    <div class="prestasi-details">

                                        @if($prestasi->bidang)

                                            <div class="detail-item">

                                                <i class="bi bi-book-fill"></i>

                                                <span>
                                                    {{ $prestasi->bidang }}
                                                </span>

                                            </div>

                                        @endif


                                        @if($prestasi->penyelenggara)

                                            <div class="detail-item">

                                                <i class="bi bi-building-fill"></i>

                                                <span>
                                                    {{ $prestasi->penyelenggara }}
                                                </span>

                                            </div>

                                        @endif


                                        @if($prestasi->tanggal)

                                            <div class="detail-item">

                                                <i class="bi bi-calendar-event-fill"></i>

                                                <span>
                                                    {{ $prestasi->tanggal->translatedFormat('d F Y') }}
                                                </span>

                                            </div>

                                        @endif

                                    </div>


                                    {{-- Description --}}
                                    @if($prestasi->deskripsi)

                                        <div class="prestasi-description">

                                            {!! nl2br(e($prestasi->deskripsi)) !!}

                                        </div>

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

                        <div class="prestasi-empty-state text-center animate-on-scroll">

                            <div class="empty-icon">

                                <i class="bi bi-trophy"></i>

                            </div>

                            <h4 class="fw-bold mb-2">
                                Data Prestasi Belum Tersedia
                            </h4>

                            <p class="text-body-secondary mb-0">
                                Informasi prestasi siswa akan ditampilkan
                                di halaman ini.
                            </p>

                        </div>

                    </div>

                </div>

            @endif

        </div>

    </section>


    {{-- ============================================================
        MOTIVATION
    ============================================================ --}}
    <section class="prestasi-motivation py-5">

        <div class="container">

            <div class="row justify-content-center">

                <div class="col-lg-9">

                    <div class="motivation-card text-center animate-on-scroll">

                        <div class="motivation-icon mx-auto mb-4">

                            <i class="bi bi-stars"></i>

                        </div>

                        <h2 class="fw-bold text-white mb-3">
                            Setiap Prestasi adalah Inspirasi
                        </h2>

                        <p class="text-white opacity-75 mb-0">
                            Prestasi bukan hanya tentang menjadi yang terbaik,
                            tetapi tentang keberanian untuk terus belajar,
                            berusaha, berkembang, dan memberikan yang terbaik.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- ============================================================
        CTA
    ============================================================ --}}
    <section class="prestasi-cta py-5">

        <div class="container">

            <div class="row align-items-center justify-content-between">

                <div class="col-lg-8 mb-4 mb-lg-0 animate-on-scroll">

                    <div class="d-flex align-items-start gap-3">

                        <div class="cta-icon flex-shrink-0">

                            <i class="bi bi-trophy-fill"></i>

                        </div>

                        <div>

                            <h3 class="fw-bold mb-2">
                                Kembangkan Potensi dan Raih Prestasi
                            </h3>

                            <p class="mb-0 text-body-secondary">
                                Jadilah bagian dari keluarga besar
                                SMA Islam As-Syafi'iyah 01 dan wujudkan
                                potensi terbaikmu.
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
