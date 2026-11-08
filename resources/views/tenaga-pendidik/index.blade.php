@extends('template.app')

@section('title', 'Tenaga Pendidik | SMA Islam As-Syafi\'iyah 01')

@section('content')

    {{-- ============================================================
        HERO
    ============================================================ --}}
    <section class="tenaga-hero text-white position-relative overflow-hidden">

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

                        <li
                            class="breadcrumb-item active text-white"
                            aria-current="page"
                        >
                            Tenaga Pendidik
                        </li>

                    </ol>

                </nav>
            </div>


            <div class="row justify-content-center text-center">

                <div class="col-lg-8">

                    {{-- Icon --}}
                    <div class="hero-icon-wrapper mx-auto mb-4 animate-on-scroll">

                        <i class="bi bi-people-fill"></i>

                    </div>


                    {{-- Title --}}
                    <h1 class="display-5 fw-bold mb-3 animate-on-scroll">
                        Tenaga Pendidik
                    </h1>


                    {{-- Description --}}
                    <p class="lead mb-0 opacity-75 animate-on-scroll">
                        Guru dan tenaga pendidik yang berdedikasi dalam
                        mendampingi, membimbing, dan mengembangkan potensi
                        setiap peserta didik.
                    </p>

                </div>

            </div>

        </div>

    </section>


    {{-- ============================================================
        TENAGA PENDIDIK
    ============================================================ --}}
    <section class="py-5 tenaga-section">

        <div class="container">


            {{-- ========================================================
                SECTION HEADER
            ======================================================== --}}
            <div class="row justify-content-center mb-5">

                <div class="col-lg-8 text-center animate-on-scroll">

                    <span class="section-label">
                        <i class="bi bi-mortarboard-fill me-2"></i>
                        Keluarga Besar Sekolah
                    </span>

                    <h2 class="display-6 fw-bold text-custom-green mt-3 mb-3">
                        Tenaga Pendidik Kami
                    </h2>

                    <p class="text-body-secondary mb-0">
                        Para pendidik profesional yang senantiasa memberikan
                        ilmu, inspirasi, dan teladan bagi seluruh peserta didik.
                    </p>

                </div>

            </div>


            @if($tenagaPendidiks->count())

                {{-- ====================================================
                    STATISTIC
                ==================================================== --}}
                <div class="row justify-content-center mb-5">

                    <div class="col-md-4 col-lg-3 animate-on-scroll">

                        <div class="teacher-stat-card text-center">

                            <div class="stat-icon mx-auto mb-3">
                                <i class="bi bi-people-fill"></i>
                            </div>

                            <div class="stat-number">
                                {{ $tenagaPendidiks->count() }}
                            </div>

                            <div class="stat-label">
                                Tenaga Pendidik
                            </div>

                        </div>

                    </div>

                </div>


                {{-- ====================================================
                    TEACHER CARDS
                ==================================================== --}}
                <div class="row g-4">

                    @foreach($tenagaPendidiks as $index => $tenagaPendidik)

                        <div
                            class="col-sm-6 col-lg-4 animate-on-scroll"
                            style="transition-delay: {{ min($index * 0.08, 0.5) }}s;"
                        >

                            <article class="teacher-card h-100">

                                {{-- ====================================
                                    PHOTO
                                ==================================== --}}
                                <div class="teacher-photo-wrapper">

                                    {{-- Number --}}
                                    <div class="teacher-number">
                                        {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                    </div>


                                    {{-- Photo --}}
                                    @if($tenagaPendidik->foto)

                                        <img
                                            src="{{ asset('images/tenaga-pendidik/' . $tenagaPendidik->foto) }}"
                                            alt="{{ $tenagaPendidik->nama }}"
                                            class="teacher-photo"
                                            loading="lazy"
                                        >

                                    @else

                                        <div class="teacher-placeholder">

                                            <i class="bi bi-person-fill"></i>

                                        </div>

                                    @endif


                                    {{-- Photo Overlay --}}
                                    <div class="teacher-photo-overlay"></div>


                                    {{-- Bottom Icon --}}
                                    <div class="teacher-photo-icon">

                                        <i class="bi bi-mortarboard-fill"></i>

                                    </div>

                                </div>


                                {{-- ====================================
                                    CONTENT
                                ==================================== --}}
                                <div class="teacher-content">

                                    {{-- Name --}}
                                    <h3 class="teacher-name">
                                        {{ $tenagaPendidik->nama }}
                                    </h3>


                                    {{-- Position --}}
                                    @if($tenagaPendidik->jabatan)

                                        <div class="teacher-position">

                                            <span>
                                                {{ $tenagaPendidik->jabatan }}
                                            </span>

                                        </div>

                                    @endif


                                    {{-- Subject --}}
                                    @if($tenagaPendidik->mata_pelajaran)

                                        <div class="teacher-subject">

                                            <div class="subject-icon">
                                                <i class="bi bi-book-fill"></i>
                                            </div>

                                            <div>

                                                <small>
                                                    Mata Pelajaran
                                                </small>

                                                <strong>
                                                    {{ $tenagaPendidik->mata_pelajaran }}
                                                </strong>

                                            </div>

                                        </div>

                                    @endif


                                    {{-- Description --}}
                                    @if($tenagaPendidik->deskripsi)

                                        <p class="teacher-description">
                                            {{ $tenagaPendidik->deskripsi }}
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

                        <div class="teacher-empty-state text-center animate-on-scroll">

                            <div class="empty-icon">

                                <i class="bi bi-people"></i>

                            </div>

                            <h4 class="fw-bold mb-2">
                                Data Tenaga Pendidik Belum Tersedia
                            </h4>

                            <p class="text-body-secondary mb-0">
                                Informasi tenaga pendidik akan ditampilkan
                                di halaman ini.
                            </p>

                        </div>

                    </div>

                </div>

            @endif

        </div>

    </section>


    {{-- ============================================================
        CTA
    ============================================================ --}}
    @if($tenagaPendidiks->count())

        <section class="teacher-cta py-5">

            <div class="container">

                <div class="row align-items-center justify-content-between">

                    <div class="col-lg-8 mb-4 mb-lg-0 animate-on-scroll">

                        <div class="d-flex align-items-start gap-3">

                            <div class="cta-icon flex-shrink-0">

                                <i class="bi bi-stars"></i>

                            </div>

                            <div>

                                <h3 class="fw-bold mb-2">
                                    Pendidikan dengan Dedikasi
                                </h3>

                                <p class="mb-0 opacity-75">
                                    Bersama tenaga pendidik yang kompeten,
                                    kami berkomitmen memberikan pendidikan
                                    terbaik bagi generasi masa depan.
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

    @endif


@endsection
