@extends('template.app')

@section('title', "Beranda | SMA Islam As-Syafi'iyah 01")

@section('content')
<style>
    /* ============================================================
   SEKILAS AKADEMIK
============================================================ */

    .academic-section {
        background:
            radial-gradient(
                circle at 10% 20%,
                rgba(0, 131, 84, 0.05),
                transparent 28%
            ),
            radial-gradient(
                circle at 90% 80%,
                rgba(255, 194, 14, 0.07),
                transparent 28%
            ),
            var(--bs-tertiary-bg);
    }


    /* ============================================================
       HEADER
    ============================================================ */

    .academic-section-header {
        max-width: 780px;
        margin: 0 auto 55px;
    }

    .academic-kicker {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        color: #008354;
        font-size: 0.78rem;
        font-weight: 800;
        letter-spacing: 0.18em;
        margin-bottom: 14px;
    }

    .academic-kicker-line {
        width: 28px;
        height: 2px;
        background: #ffc20e;
        border-radius: 10px;
    }

    .academic-main-title {
        color: #008354;
        font-size: clamp(2rem, 4vw, 3rem);
        font-weight: 800;
        line-height: 1.15;
        margin-bottom: 16px;
    }

    .academic-main-title span {
        color: #ffc20e;
    }

    .academic-main-description {
        max-width: 680px;
        color: var(--bs-secondary-color);
        font-size: 1rem;
        line-height: 1.8;
    }


    /* ============================================================
       FEATURE CARD
    ============================================================ */

    .academic-feature-card {
        position: relative;
        overflow: hidden;
        background: var(--bs-body-bg);
        border: 1px solid rgba(0, 131, 84, 0.09);
        border-radius: 24px;
        padding: 30px;
        margin-bottom: 24px;
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.055);
        transition:
            transform 0.35s ease,
            box-shadow 0.35s ease;
    }

    .academic-feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 45px rgba(0, 0, 0, 0.09);
    }


    /* Accent */

    .academic-feature-card::before {
        content: "";
        position: absolute;
        left: 0;
        top: 25px;
        bottom: 25px;
        width: 5px;
        border-radius: 0 8px 8px 0;
        background: #008354;
    }

    .program-card::before {
        background: #ffc20e;
    }

    .extracurricular-card::before {
        background: #008354;
    }


    /* ============================================================
       FEATURE CONTENT
    ============================================================ */

    .academic-feature-content {
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 10px 20px 10px 10px;
    }

    .academic-feature-icon {
        width: 58px;
        height: 58px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(0, 131, 84, 0.09);
        color: #008354;
        border-radius: 17px;
        font-size: 1.65rem;
        margin-bottom: 18px;
    }

    .program-card .academic-feature-icon {
        background: rgba(255, 194, 14, 0.16);
        color: #d69e00;
    }

    .academic-feature-label {
        color: var(--bs-secondary-color);
        font-size: 0.68rem;
        font-weight: 800;
        letter-spacing: 0.15em;
        margin-bottom: 6px;
    }

    .academic-feature-content h3 {
        color: #008354;
        font-size: 1.55rem;
        font-weight: 800;
        margin-bottom: 12px;
    }

    .academic-feature-content p {
        color: var(--bs-secondary-color);
        line-height: 1.7;
        font-size: 0.92rem;
        margin-bottom: 20px;
    }

    .academic-feature-button {
        display: inline-flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        width: fit-content;
        min-width: 170px;
        color: #008354;
        font-size: 0.86rem;
        font-weight: 700;
        text-decoration: none;
        transition: gap 0.25s ease;
    }

    .academic-feature-button span {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #008354;
        color: #fff;
        transition: transform 0.25s ease;
    }

    .academic-feature-button:hover {
        color: #008354;
        gap: 20px;
    }

    .academic-feature-button:hover span {
        transform: rotate(5deg);
    }


    /* ============================================================
       LIST WRAPPER
    ============================================================ */

    .academic-list-wrapper {
        height: 100%;
        padding: 8px;
    }

    .academic-list-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 8px 5px 18px;
    }

    .academic-list-header small {
        color: var(--bs-secondary-color);
        font-size: 0.67rem;
        font-weight: 800;
        letter-spacing: 0.12em;
    }

    .academic-list-header h5 {
        color: var(--bs-body-color);
        font-size: 1rem;
        font-weight: 700;
        margin: 3px 0 0;
    }

    .academic-count {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: rgba(0, 131, 84, 0.09);
        color: #008354;
        font-size: 0.85rem;
        font-weight: 800;
    }


    /* ============================================================
       CONTENT ITEM
    ============================================================ */

    .academic-content-item {
        position: relative;
        height: 100%;
        min-height: 175px;
        padding: 20px;
        border-radius: 17px;
        background: var(--bs-tertiary-bg);
        border: 1px solid rgba(0, 131, 84, 0.07);
        transition:
            transform 0.3s ease,
            background 0.3s ease,
            border-color 0.3s ease;
    }

    .academic-content-item:hover {
        transform: translateY(-4px);
        background: var(--bs-body-bg);
        border-color: rgba(0, 131, 84, 0.18);
    }

    .academic-number {
        position: absolute;
        right: 15px;
        top: 12px;
        color: rgba(0, 131, 84, 0.12);
        font-size: 1.4rem;
        font-weight: 900;
    }

    .academic-content-icon {
        width: 34px;
        height: 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: #008354;
        color: #fff;
        margin-bottom: 15px;
        font-size: 0.9rem;
    }

    .academic-content-item h6 {
        color: var(--bs-body-color);
        font-size: 0.94rem;
        line-height: 1.4;
        margin-bottom: 8px;
    }

    .academic-content-item p {
        color: var(--bs-secondary-color);
        font-size: 0.78rem;
        line-height: 1.6;
        margin: 0;
    }


    /* ============================================================
       PROGRAM UNGGULAN
    ============================================================ */

    .program-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 14px;
        height: 100%;
    }

    .program-item {
        position: relative;
        min-height: 215px;
        padding: 20px;
        border-radius: 18px;
        background: linear-gradient(
            145deg,
            rgba(255, 194, 14, 0.10),
            var(--bs-tertiary-bg)
        );
        border: 1px solid rgba(255, 194, 14, 0.18);
        overflow: hidden;
        transition:
            transform 0.3s ease,
            box-shadow 0.3s ease;
    }

    .program-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.07);
    }

    .program-item-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 25px;
    }

    .program-number {
        color: rgba(0, 131, 84, 0.35);
        font-size: 0.72rem;
        font-weight: 900;
    }

    .program-icon {
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: #ffc20e;
        color: #fff;
        font-size: 0.9rem;
    }

    .program-item h5 {
        color: #008354;
        font-size: 0.96rem;
        font-weight: 800;
        line-height: 1.4;
        margin-bottom: 9px;
    }

    .program-item p {
        color: var(--bs-secondary-color);
        font-size: 0.77rem;
        line-height: 1.6;
        margin: 0;
    }

    .program-arrow {
        position: absolute;
        right: 17px;
        bottom: 15px;
        color: rgba(0, 131, 84, 0.4);
        font-size: 0.9rem;
    }


    /* ============================================================
       EKSTRAKURIKULER
    ============================================================ */

    .extracurricular-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }

    .extracurricular-item {
        display: flex;
        align-items: center;
        gap: 13px;
        padding: 14px;
        border-radius: 15px;
        background: var(--bs-tertiary-bg);
        border: 1px solid rgba(0, 131, 84, 0.07);
        transition:
            transform 0.3s ease,
            border-color 0.3s ease,
            background 0.3s ease;
    }

    .extracurricular-item:hover {
        transform: translateX(4px);
        background: var(--bs-body-bg);
        border-color: rgba(0, 131, 84, 0.18);
    }

    .extracurricular-icon {
        flex: 0 0 42px;
        width: 42px;
        height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: rgba(0, 131, 84, 0.09);
        color: #008354;
    }

    .extracurricular-info {
        min-width: 0;
        flex: 1;
    }

    .extracurricular-info h6 {
        color: var(--bs-body-color);
        font-size: 0.88rem;
        font-weight: 800;
        margin: 0;
    }

    .extracurricular-info p {
        color: var(--bs-secondary-color);
        font-size: 0.72rem;
        line-height: 1.5;
        margin: 4px 0 0;
    }

    .extracurricular-arrow {
        color: var(--bs-secondary-color);
        font-size: 0.75rem;
    }


    /* ============================================================
       EMPTY
    ============================================================ */

    .academic-empty {
        min-height: 150px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        gap: 8px;
        color: var(--bs-secondary-color);
    }

    .academic-empty i {
        font-size: 2rem;
        opacity: 0.4;
    }

    .academic-empty p {
        margin: 0;
        font-size: 0.85rem;
    }


    /* ============================================================
       BOTTOM LINK
    ============================================================ */

    .academic-bottom-link {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        padding: 20px 5px 0;
        color: var(--bs-secondary-color);
        font-size: 0.82rem;
    }

    .academic-bottom-link > div {
        flex-wrap: wrap;
    }

    .academic-bottom-link a {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #008354;
        font-weight: 700;
        text-decoration: none;
        transition: gap 0.2s ease;
    }

    .academic-bottom-link a:hover {
        color: #008354;
        gap: 9px;
    }


    /* ============================================================
       RESPONSIVE
    ============================================================ */

    @media (max-width: 991.98px) {

        .academic-feature-content {
            padding: 5px 5px 15px;
        }

        .program-grid {
            grid-template-columns: repeat(2, 1fr);
        }

    }

    @media (max-width: 767.98px) {

        .academic-section-header {
            margin-bottom: 35px;
        }

        .academic-feature-card {
            padding: 22px;
            border-radius: 20px;
        }

        .academic-feature-card::before {
            top: 20px;
            bottom: 20px;
        }

        .program-grid {
            grid-template-columns: 1fr;
        }

        .program-item {
            min-height: 175px;
        }

        .extracurricular-grid {
            grid-template-columns: 1fr;
        }

        .academic-bottom-link {
            align-items: flex-start;
            flex-direction: column;
        }

    }

    @media (max-width: 575.98px) {

        .academic-main-title {
            font-size: 2rem;
        }

        .academic-feature-card {
            padding: 18px;
        }

        .academic-content-item {
            min-height: auto;
        }

        .academic-list-wrapper {
            padding: 0;
        }

        .academic-feature-icon {
            width: 52px;
            height: 52px;
        }

    }
</style>
    {{-- ============================================================
        1. HERO VIDEO
    ============================================================ --}}
    <section class="hero-video-section position-relative overflow-hidden">

        <div class="video-container">
            @if($videotron)
                <iframe
                    id="ytIframe"
                    src="{{ $videotron->link }}&autoplay=1&mute=1&controls=0&rel=0&loop=1&playlist=0M3uF7qgG4w"
                    allow="autoplay; encrypted-media"
                    allowfullscreen
                    title="{{ $videotron->title }}">
                </iframe>
            @else
                <div class="hero-video-placeholder">
                    <i class="bi bi-building"></i>
                </div>
            @endif
        </div>

        <div class="hero-overlay"></div>

        <div class="hero-content">
            <div class="container text-center text-white">

                <div class="hero-badge animate-slide-down">
                    <i class="bi bi-mortarboard-fill me-2"></i>
                    SMA Islam As-Syafi'iyah 01
                </div>

                <h1 class="display-3 fw-bold mb-3 animate-slide-down hero-title">
                    {{ $videotron?->title ?? "Membentuk Generasi Unggul dan Berkarakter" }}
                </h1>

                <p class="lead mx-auto mb-4 animate-slide-down hero-subtitle">
                    {{ $videotron?->description ?? 'Membangun generasi yang berilmu, berakhlak, berprestasi, dan siap menghadapi masa depan.' }}
                </p>

                <div class="d-flex flex-column flex-sm-row justify-content-center gap-3 animate-slide-down">

                    <a href="#keunggulan"
                       class="btn btn-custom-yellow btn-lg rounded-pill px-4 shadow">
                        <i class="bi bi-compass me-2"></i>
                        Jelajahi Sekolah
                    </a>

                    <a href="{{ route('ppdb.index') }}"
                       class="btn btn-outline-light btn-lg rounded-pill px-4 shadow">
                        <i class="bi bi-pencil-square me-2"></i>
                        Pendaftaran Murid
                    </a>

                </div>

            </div>
        </div>

        <div class="hero-scroll-indicator">
            <span>Scroll untuk menjelajah</span>
            <i class="bi bi-chevron-down"></i>
        </div>

    </section>


    {{-- ============================================================
        2. SAMBUTAN KEPALA SEKOLAH
    ============================================================ --}}
    @if($sambutan)

        <section class="section-sambutan py-5 position-relative overflow-hidden">

            <div class="sambutan-decoration sambutan-decoration-one"></div>
            <div class="sambutan-decoration sambutan-decoration-two"></div>

            <div class="container py-4 position-relative">

                <div class="row align-items-center g-5">

                    {{-- FOTO --}}
                    <div class="col-lg-5 animate-on-scroll">

                        <div class="principal-photo-wrapper mx-auto">

                            <div class="principal-decoration"></div>

                            <div class="principal-photo-card">

                                <div class="principal-photo-inner">

                                    <img
                                        src="{{ asset('images/sambutan/' . $sambutan->image) }}"
                                        alt="{{ $sambutan->nama }}"
                                        class="principal-photo"
                                    >

                                    <div class="principal-gradient"></div>

                                    <div class="principal-name">

                                        <div class="d-flex align-items-center gap-2 mb-2">

                                    <span class="principal-icon">
                                        <i class="bi bi-person-fill"></i>
                                    </span>

                                            <small class="fw-semibold">
                                                Kepala Sekolah
                                            </small>

                                        </div>

                                        <h4 class="fw-bold mb-0">
                                            {{ $sambutan->nama }}
                                        </h4>

                                    </div>

                                </div>

                            </div>

                            <div class="principal-circle-one"></div>
                            <div class="principal-circle-two"></div>

                        </div>

                    </div>


                    {{-- SAMBUTAN --}}
                    <div class="col-lg-7 animate-on-scroll">

                        <div class="quote-symbol">
                            <i class="bi bi-quote"></i>
                        </div>

                        <div class="section-kicker">

                            <span></span>

                            PESAN PIMPINAN

                        </div>

                        <h2 class="section-heading text-custom-green">
                            {{ $sambutan->title }}
                        </h2>

                        <div class="principal-message">
                            {!! nl2br(e($sambutan->description)) !!}
                        </div>

                        <div class="principal-signature">

                            <div class="signature-icon">
                                <i class="bi bi-person-badge-fill"></i>
                            </div>

                            <div>
                                <h6 class="fw-bold text-custom-green mb-1">
                                    {{ $sambutan->nama }}
                                </h6>

                                <small class="principal-message-body ">
                                    Kepala Sekolah SMA Islam As-Syafi'iyah 01
                                </small>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

    @endif


    {{-- ============================================================
        3. KEUNGGULAN
    ============================================================ --}}
    <section id="keunggulan" class="py-5">

        <div class="container">

            <div class="section-header text-center animate-on-scroll">

            <span class="section-kicker-center">
                MENGAPA MEMILIH KAMI
            </span>

                <h2 class="fw-bold text-custom-green">
                    Keunggulan Kami
                </h2>

                <p class="text-body-secondary mx-auto">
                    Komitmen kami dalam memberikan pendidikan terbaik
                    untuk mendukung perkembangan potensi setiap siswa.
                </p>

                <div class="section-line"></div>

            </div>


            <div class="position-relative animate-on-scroll">

                <button
                    id="btnScrollLeft"
                    type="button"
                    class="slider-button slider-button-left d-none d-md-flex">
                    <i class="bi bi-chevron-left"></i>
                </button>


                <div
                    id="keunggulanSlider"
                    class="d-flex flex-nowrap gap-4 overflow-auto hide-scrollbar py-3 px-2"
                    style="scroll-snap-type: x mandatory;">

                    @forelse($keunggulans as $keunggulan)

                        <div
                            class="keunggulan-item flex-shrink-0"
                            style="width: 320px; scroll-snap-align: start;">

                            <div class="feature-card h-100">

                                <div class="feature-icon">

                                    {!! $keunggulan->icon !!}

                                </div>

                                <h4 class="fw-bold text-custom-green">
                                    {{ $keunggulan->title }}
                                </h4>

                                <p class="text-body-secondary mb-0">
                                    {!! nl2br(e($keunggulan->deskripsi)) !!}
                                </p>

                            </div>

                        </div>

                    @empty

                        <div class="col-12 text-center py-4">
                            <p class="text-body-secondary">
                                Belum ada data keunggulan.
                            </p>
                        </div>

                    @endforelse

                </div>


                <button
                    id="btnScrollRight"
                    type="button"
                    class="slider-button slider-button-right d-none d-md-flex">

                    <i class="bi bi-chevron-right"></i>

                </button>

            </div>

        </div>

    </section>


    {{-- ============================================================
    4. SEKILAS AKADEMIK
    ============================================================ --}}
    <section class="academic-section py-5">

        <div class="container">

            {{-- ========================================================
                HEADER
            ========================================================= --}}
            <div class="academic-section-header text-center animate-on-scroll">

                <div class="academic-kicker">
                    <span class="academic-kicker-line"></span>
                    <span>AKADEMIK</span>
                    <span class="academic-kicker-line"></span>
                </div>

                <h2 class="academic-main-title">
                    Pendidikan untuk
                    <span>Masa Depan</span>
                </h2>

                <p class="academic-main-description mx-auto">
                    Berbagai program akademik dan kegiatan pengembangan diri
                    dirancang untuk membantu siswa tumbuh menjadi pribadi
                    yang unggul, berkarakter, dan berprestasi.
                </p>

            </div>


            {{-- ========================================================
                KURIKULUM
            ========================================================= --}}
            <div class="academic-feature-card curriculum-card animate-on-scroll">

                <div class="row g-4 align-items-stretch">

                    {{-- LEFT --}}
                    <div class="col-lg-4">

                        <div class="academic-feature-content">

                            <div class="academic-feature-icon">
                                <i class="bi bi-book-half"></i>
                            </div>

                            <div class="academic-feature-label">
                                PEMBELAJARAN
                            </div>

                            <h3>
                                Kurikulum
                            </h3>

                            <p>
                                Kurikulum sekolah dirancang untuk memberikan
                                pengalaman belajar yang relevan, aktif, dan
                                mendukung perkembangan potensi setiap siswa.
                            </p>

                            <a href="{{ route('kurikulum.index') }}"
                               class="academic-feature-button">

                                Lihat Kurikulum

                                <span>
                                <i class="bi bi-arrow-up-right"></i>
                            </span>

                            </a>

                        </div>

                    </div>


                    {{-- RIGHT --}}
                    <div class="col-lg-8">

                        <div class="academic-list-wrapper">

                            <div class="academic-list-header">

                                <div>
                                    <small>
                                        INFORMASI KURIKULUM
                                    </small>

                                    <h5>
                                        Pembelajaran yang Terarah
                                    </h5>
                                </div>

                                <span class="academic-count">
                                {{ $kurikulums->count() }}
                            </span>

                            </div>


                            <div class="row g-3">

                                @forelse($kurikulums as $index => $kurikulum)

                                    <div class="col-md-4">

                                        <div class="academic-content-item">

                                            <div class="academic-number">
                                                {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                            </div>

                                            <div class="academic-content-icon">
                                                <i class="bi bi-check2"></i>
                                            </div>

                                            <h6>
                                                {{ $kurikulum->judul }}
                                            </h6>

                                            @if($kurikulum->deskripsi)

                                                <p>
                                                    {{ \Illuminate\Support\Str::limit(
                                                        strip_tags($kurikulum->deskripsi),
                                                        110
                                                    ) }}
                                                </p>

                                            @endif

                                        </div>

                                    </div>

                                @empty

                                    <div class="col-12">

                                        <div class="academic-empty">

                                            <i class="bi bi-book"></i>

                                            <p>
                                                Belum ada informasi kurikulum.
                                            </p>

                                        </div>

                                    </div>

                                @endforelse

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ========================================================
                PROGRAM UNGGULAN
            ========================================================= --}}
            <div class="academic-feature-card program-card animate-on-scroll">

                <div class="row g-4 align-items-stretch">

                    {{-- LEFT --}}
                    <div class="col-lg-4">

                        <div class="academic-feature-content">

                            <div class="academic-feature-icon">
                                <i class="bi bi-stars"></i>
                            </div>

                            <div class="academic-feature-label">
                                PROGRAM PILIHAN
                            </div>

                            <h3>
                                Program Unggulan
                            </h3>

                            <p>
                                Program unggulan sekolah menjadi wadah bagi
                                siswa untuk mengembangkan kemampuan, karakter,
                                prestasi, dan potensi terbaiknya.
                            </p>

                            <a href="{{ route('program-unggulan.index') }}"
                               class="academic-feature-button">

                                Lihat Semua Program

                                <span>
                                <i class="bi bi-arrow-up-right"></i>
                            </span>

                            </a>

                        </div>

                    </div>


                    {{-- RIGHT --}}
                    <div class="col-lg-8">

                        <div class="program-grid">

                            @forelse($programUnggulans as $index => $program)

                                <div class="program-item">

                                    <div class="program-item-top">

                                    <span class="program-number">
                                        {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                    </span>

                                        <div class="program-icon">
                                            <i class="bi bi-star-fill"></i>
                                        </div>

                                    </div>

                                    <h5>
                                        {{ $program->judul }}
                                    </h5>

                                    @if($program->deskripsi)

                                        <p>
                                            {{ \Illuminate\Support\Str::limit(
                                                strip_tags($program->deskripsi),
                                                120
                                            ) }}
                                        </p>

                                    @endif

                                    <div class="program-arrow">
                                        <i class="bi bi-arrow-right"></i>
                                    </div>

                                </div>

                            @empty

                                <div class="academic-empty">

                                    <i class="bi bi-stars"></i>

                                    <p>
                                        Belum ada program unggulan.
                                    </p>

                                </div>

                            @endforelse

                        </div>

                    </div>

                </div>

            </div>


            {{-- ========================================================
                EKSTRAKURIKULER
            ========================================================= --}}
            <div class="academic-feature-card extracurricular-card animate-on-scroll">

                <div class="row g-4 align-items-center">

                    {{-- HEADER --}}
                    <div class="col-lg-4">

                        <div class="academic-feature-content">

                            <div class="academic-feature-icon">
                                <i class="bi bi-palette-fill"></i>
                            </div>

                            <div class="academic-feature-label">
                                PENGEMBANGAN DIRI
                            </div>

                            <h3>
                                Ekstrakurikuler
                            </h3>

                            <p>
                                Beragam kegiatan ekstrakurikuler membantu siswa
                                mengembangkan minat, bakat, kreativitas,
                                kepemimpinan, dan keterampilan sosial.
                            </p>

                            <a href="{{ route('ekstrakurikuler.index') }}"
                               class="academic-feature-button">

                                Semua Ekskul

                                <span>
                                <i class="bi bi-arrow-up-right"></i>
                            </span>

                            </a>

                        </div>

                    </div>


                    {{-- LIST EKSKUL --}}
                    <div class="col-lg-8">

                        <div class="extracurricular-grid">

                            @forelse($ekstrakurikulers as $index => $ekskul)

                                <div class="extracurricular-item">

                                    <div class="extracurricular-icon">

                                        <i class="bi bi-activity"></i>

                                    </div>

                                    <div class="extracurricular-info">

                                        <h6>
                                            {{ $ekskul->nama }}
                                        </h6>

                                        @if($ekskul->deskripsi)

                                            <p>
                                                {{ \Illuminate\Support\Str::limit(
                                                    strip_tags($ekskul->deskripsi),
                                                    75
                                                ) }}
                                            </p>

                                        @endif

                                    </div>

                                    <i class="bi bi-chevron-right extracurricular-arrow"></i>

                                </div>

                            @empty

                                <div class="academic-empty">

                                    <i class="bi bi-palette"></i>

                                    <p>
                                        Belum ada kegiatan ekstrakurikuler.
                                    </p>

                                </div>

                            @endforelse

                        </div>

                    </div>

                </div>

            </div>


            {{-- ========================================================
                BOTTOM NAVIGATION
            ========================================================= --}}
            <div class="academic-bottom-link animate-on-scroll">

            <span>
                Jelajahi informasi akademik sekolah
            </span>

                <div class="d-flex gap-2">

                    <a href="{{ route('kurikulum.index') }}">
                        Kurikulum
                        <i class="bi bi-arrow-right"></i>
                    </a>

                    <a href="{{ route('program-unggulan.index') }}">
                        Program Unggulan
                        <i class="bi bi-arrow-right"></i>
                    </a>

                    <a href="{{ route('ekstrakurikuler.index') }}">
                        Ekstrakurikuler
                        <i class="bi bi-arrow-right"></i>
                    </a>

                </div>

            </div>

        </div>

    </section>


    {{-- ============================================================
        5. PRESTASI SISWA
    ============================================================ --}}
    <section class="py-5">

        <div class="container">

            <div class="section-header text-center animate-on-scroll">

            <span class="section-kicker-center">
                PRESTASI
            </span>

                <h2 class="fw-bold text-custom-green">
                    Prestasi Siswa
                </h2>

                <p class="text-body-secondary mx-auto">
                    Berbagai pencapaian siswa menjadi bagian dari semangat
                    kami untuk terus berkembang dan berprestasi.
                </p>

                <div class="section-line"></div>

            </div>


            <div class="row g-4">

                @forelse($prestasiSiswas as $index => $prestasi)

                    <div class="col-md-6 col-lg-4 animate-on-scroll"
                         style="transition-delay: {{ $index * 0.1 }}s;">

                        <div class="achievement-card h-100">

                            {{-- Foto --}}
                            <div class="achievement-image-wrapper">

                                @if($prestasi->foto)

                                    <img
                                        src="{{ asset('images/prestasi-siswa/' . $prestasi->foto) }}"
                                        alt="{{ $prestasi->judul }}"
                                        class="achievement-image"
                                        loading="lazy"
                                    >

                                @else

                                    <div class="achievement-placeholder">
                                        <i class="bi bi-trophy"></i>
                                    </div>

                                @endif


                                {{-- Ranking --}}
                                @if($prestasi->peringkat)

                                    <div class="achievement-rank">
                                        <i class="bi bi-award-fill me-1"></i>
                                        {{ $prestasi->peringkat }}
                                    </div>

                                @endif

                            </div>


                            <div class="p-4">

                                @if($prestasi->tingkat)

                                    <span class="badge bg-custom-green rounded-pill mb-3">
                                    {{ $prestasi->tingkat }}
                                </span>

                                @endif

                                <h5 class="fw-bold mb-2">
                                    {{ $prestasi->judul }}
                                </h5>

                                <div class="achievement-student mb-3">

                                    <i class="bi bi-person-fill"></i>

                                    <span>
                                    {{ $prestasi->nama_siswa }}

                                        @if($prestasi->kelas)
                                            · {{ $prestasi->kelas }}
                                        @endif
                                </span>

                                </div>

                                @if($prestasi->bidang)

                                    <small class="text-body-secondary d-block mb-2">

                                        <i class="bi bi-bookmark me-1"></i>

                                        {{ $prestasi->bidang }}

                                    </small>

                                @endif

                                @if($prestasi->penyelenggara)

                                    <small class="text-body-secondary d-block">

                                        <i class="bi bi-building me-1"></i>

                                        {{ $prestasi->penyelenggara }}

                                    </small>

                                @endif

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="col-12">

                        <div class="empty-home-section">

                            <i class="bi bi-trophy"></i>

                            <h5 class="fw-bold mt-3">
                                Belum Ada Data Prestasi
                            </h5>

                            <p class="text-body-secondary mb-0">
                                Prestasi siswa akan ditampilkan di sini.
                            </p>

                        </div>

                    </div>

                @endforelse

            </div>


            @if($prestasiSiswas->count())

                <div class="text-center mt-5 animate-on-scroll">

                    <a href="{{ route('prestasi-siswa.index') }}"
                       class="btn btn-outline-success rounded-pill px-4">

                        Lihat Semua Prestasi

                        <i class="bi bi-arrow-right ms-2"></i>

                    </a>

                </div>

            @endif

        </div>

    </section>


    {{-- ============================================================
        6. FASILITAS
    ============================================================ --}}
    <section class="py-5 bg-body-tertiary">

        <div class="container">

            <div class="row align-items-end mb-5">

                <div class="col-lg-8 animate-on-scroll">

                <span class="section-kicker">
                    <span></span>
                    SARANA & PRASARANA
                </span>

                    <h2 class="fw-bold text-custom-green mb-2">
                        Fasilitas Sekolah
                    </h2>

                    <p class="text-body-secondary mb-0">
                        Fasilitas yang disediakan untuk menciptakan lingkungan
                        belajar yang nyaman dan mendukung aktivitas siswa.
                    </p>

                </div>

                <div class="col-lg-4 text-lg-end mt-3 mt-lg-0 animate-on-scroll">

                    <a href="{{ route('fasilitas.index') }}"
                       class="btn btn-outline-success rounded-pill px-4">

                        Semua Fasilitas
                        <i class="bi bi-arrow-right ms-2"></i>

                    </a>

                </div>

            </div>


            <div class="row g-4">

                @forelse($fasilitas as $index => $item)

                    <div class="col-md-6 col-lg-3 animate-on-scroll">

                        <a href="{{ route('fasilitas.index') }}"
                           class="facility-home-card">

                            <div class="facility-home-image">

                                @if($item->foto)

                                    <img
                                        src="{{ asset('images/fasilitas/' . $item->foto) }}"
                                        alt="{{ $item->nama }}"
                                        loading="lazy"
                                    >

                                @else

                                    <div class="facility-home-placeholder">
                                        <i class="bi bi-building"></i>
                                    </div>

                                @endif

                            </div>

                            <div class="facility-home-content">

                                <h5 class="fw-bold mb-2">
                                    {{ $item->nama }}
                                </h5>

                                @if($item->lokasi)

                                    <small class="text-body-secondary">

                                        <i class="bi bi-geo-alt me-1"></i>

                                        {{ $item->lokasi }}

                                    </small>

                                @endif

                            </div>

                        </a>

                    </div>

                @empty

                    <div class="col-12">

                        <div class="empty-home-section">

                            <i class="bi bi-building"></i>

                            <h5 class="fw-bold mt-3">
                                Belum Ada Data Fasilitas
                            </h5>

                        </div>

                    </div>

                @endforelse

            </div>

        </div>

    </section>


    {{-- ============================================================
            7. BERITA
        ============================================================ --}}
    <section class="py-5">

        <div class="container">

            <div class="d-flex justify-content-between align-items-end mb-5 animate-on-scroll">

                <div>

                    <span class="section-kicker">
                        <span></span>
                        INFORMASI TERBARU
                    </span>

                    <h2 class="fw-bold text-custom-green mb-2">
                        Berita & Kegiatan
                    </h2>

                    <p class="text-body-secondary mb-0">
                        Informasi seputar aktivitas dan agenda sekolah terkini.
                    </p>

                </div>

                <a href="{{ route('berita.index') }}"
                   class="btn btn-outline-success rounded-pill px-4 d-none d-md-inline-flex">

                    Lihat Semua
                    <i class="bi bi-arrow-right ms-2"></i>

                </a>

            </div>


            <div class="row g-4">

                @forelse($beritas as $index => $berita)

                    <div class="col-md-4 animate-on-scroll"
                         style="transition-delay: {{ $index * 0.1 }}s;">

                        <article class="news-home-card h-100">

                            <div class="news-image-wrapper position-relative">

                                {{-- Ekstrak ID YouTube dari link --}}
                                @php
                                    $yt_id = null;
                                    if ($berita->youtube_url && preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $berita->youtube_url, $match)) {
                                        $yt_id = $match[1];
                                    }
                                @endphp

                                @if($yt_id)
                                    {{-- Tampilan jika ada YouTube URL (Thumbnail YouTube + Tombol Play) --}}
                                    <img
                                        src="https://img.youtube.com/vi/{{ $yt_id }}/hqdefault.jpg"
                                        alt="{{ $berita->title }}"
                                        loading="lazy"
                                        style="width: 100%; height: 100%; object-fit: cover;"
                                    >
                                    <div class="position-absolute top-50 start-50 translate-middle">
                                        <div class="bg-danger text-white rounded-circle d-flex align-items-center justify-content-center shadow" style="width: 55px; height: 55px; opacity: 0.9;">
                                            <i class="bi bi-play-fill fs-2 ms-1"></i>
                                        </div>
                                    </div>
                                @elseif($berita->image)
                                    {{-- Tampilan biasa jika hanya ada gambar --}}
                                    <img
                                        src="{{ asset('images/berita/' . $berita->image) }}"
                                        alt="{{ $berita->title }}"
                                        loading="lazy"
                                        style="width: 100%; height: 100%; object-fit: cover;"
                                    >
                                @else
                                    {{-- Placeholder jika tidak ada media --}}
                                    <div class="news-placeholder" style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background-color: #f8f9fa;">
                                        <i class="bi bi-newspaper fs-1 text-secondary"></i>
                                    </div>
                                @endif

                                @if($berita->category)
                                    <span class="news-category position-absolute top-0 start-0 m-3 z-1">
                                            {{ $berita->category }}
                                        </span>
                                @endif

                            </div>


                            <div class="p-4 d-flex flex-column h-100">

                                @if($berita->published_at)

                                    <small class="text-body-secondary mb-2">

                                        <i class="bi bi-calendar3 me-1"></i>

                                        {{ $berita->published_at->translatedFormat('d F Y') }}

                                    </small>

                                @endif


                                <h5 class="fw-bold mb-3">
                                    {{ $berita->title }}
                                </h5>


                                <p class="text-body-secondary small flex-grow-1">
                                    {!! nl2br(e(\Illuminate\Support\Str::limit(strip_tags($berita->content), 120))) !!}
                                </p>


                                <a
                                    href="{{ route('berita.show', $berita->slug) }}"
                                    class="news-read-more mt-3">

                                    Baca Selengkapnya

                                    <i class="bi bi-arrow-right"></i>

                                </a>

                            </div>

                        </article>

                    </div>

                @empty

                    <div class="col-12">

                        <div class="empty-home-section">

                            <i class="bi bi-newspaper"></i>

                            <h5 class="fw-bold mt-3">
                                Belum Ada Berita
                            </h5>

                            <p class="text-body-secondary mb-0">
                                Berita dan kegiatan sekolah akan ditampilkan di sini.
                            </p>

                        </div>

                    </div>

                @endforelse

            </div>


            <div class="text-center d-md-none mt-4">

                <a href="{{ route('berita.index') }}"
                   class="btn btn-outline-success rounded-pill px-4">

                    Lihat Semua Berita

                    <i class="bi bi-arrow-right ms-2"></i>

                </a>

            </div>

        </div>

    </section>


    {{-- ============================================================
        8. LOKASI & KONTAK
    ============================================================ --}}
    <section class="py-5 bg-body-tertiary">

        <div class="container">

            <div class="section-header text-center animate-on-scroll">

            <span class="section-kicker-center">
                HUBUNGI KAMI
            </span>

                <h2 class="fw-bold text-custom-green">
                    Lokasi & Kontak Kami
                </h2>

                <p class="text-body-secondary">
                    Kunjungi sekolah kami atau hubungi melalui informasi
                    yang tersedia.
                </p>

                <div class="section-line"></div>

            </div>


            <div class="row g-4 align-items-stretch">

                {{-- CONTACT --}}
                <div class="col-lg-5 animate-on-scroll">

                    <div class="contact-home-card h-100">

                        <h4 class="fw-bold text-custom-green mb-4">
                            {{ $master_sekolah->nama }}
                        </h4>


                        <div class="contact-list">

                            @if($master_sekolah->alamat)

                                <div class="contact-item">

                                    <div class="contact-icon">
                                        <i class="bi bi-geo-alt-fill"></i>
                                    </div>

                                    <div>
                                        <small class="text-body-secondary">
                                            Alamat
                                        </small>

                                        <p class="mb-0">
                                            {{ $master_sekolah->alamat }}
                                        </p>
                                    </div>

                                </div>

                            @endif


                            @if($master_sekolah->no_telp)

                                <div class="contact-item">

                                    <div class="contact-icon">
                                        <i class="bi bi-telephone-fill"></i>
                                    </div>

                                    <div>
                                        <small class="text-body-secondary">
                                            Telepon
                                        </small>

                                        <p class="mb-0">
                                            {{ $master_sekolah->no_telp }}
                                        </p>
                                    </div>

                                </div>

                            @endif


                            @if($master_sekolah->whatsapp)

                                <div class="contact-item">

                                    <div class="contact-icon">
                                        <i class="bi bi-whatsapp"></i>
                                    </div>

                                    <div>
                                        <small class="text-body-secondary">
                                            WhatsApp
                                        </small>

                                        <p class="mb-0">
                                            {{ $master_sekolah->whatsapp }}
                                        </p>
                                    </div>

                                </div>

                            @endif


                            @if($master_sekolah->instagram)

                                <div class="contact-item">

                                    <div class="contact-icon">
                                        <i class="bi bi-instagram"></i>
                                    </div>

                                    <div>
                                        <small class="text-body-secondary">
                                            Instagram
                                        </small>

                                        <p class="mb-0">
                                            {{ $master_sekolah->instagram }}
                                        </p>
                                    </div>

                                </div>

                            @endif

                        </div>

                    </div>

                </div>


                {{-- MAP --}}
                <div class="col-lg-7 animate-on-scroll">

                    <div class="map-home-card">

                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.32614135991!2d106.8534687!3d-6.220654!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3861dbad71f%3A0x1632ae98669f654c!2sSekolah%20Menengah%20Atas%20Islam%20As-Syafi'iyah%2001!5e0!3m2!1sid!2sid!4v1787720650330!5m2!1sid!2sid"
                            width="100%"
                            height="100%"
                            style="border:0;"
                            allowfullscreen
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- ============================================================
        9. CTA PPDB
    ============================================================ --}}
    <section class="py-5">

        <div class="container">

            <div class="ppdb-home-cta animate-on-scroll">

                <div class="row align-items-center g-4">

                    <div class="col-lg-8">

                    <span class="cta-badge">

                        <i class="bi bi-pencil-square me-2"></i>

                        PENERIMAAN PESERTA DIDIK BARU

                    </span>

                        <h2 class="fw-bold text-white mt-3 mb-2">
                            Siap Menjadi Bagian dari
                            SMA Islam As-Syafi'iyah 01?
                        </h2>

                        <p class="text-white text-opacity-75 mb-0">
                            Daftarkan putra-putri Anda dan bergabung bersama
                            lingkungan pendidikan yang mendukung prestasi,
                            karakter, dan masa depan siswa.
                        </p>

                    </div>

                    <div class="col-lg-4 text-lg-end">

                        <a href="{{ route('ppdb.index') }}"
                           class="btn btn-light btn-lg rounded-pill px-4 fw-semibold">

                            Daftar Sekarang

                            <i class="bi bi-arrow-right ms-2"></i>

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </section>

@endsection



