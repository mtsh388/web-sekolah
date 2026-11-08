@extends('template.app')

@section('title', 'Kalender Pendidikan | SMA Islam As-Syafi\'iyah 01')

@section('content')

    {{-- ============================================================
         HERO
    ============================================================ --}}
    <section class="py-5 position-relative overflow-hidden"
             style="background: var(--primary-green);">

        <div class="position-absolute top-0 end-0 opacity-10"
             style="font-size: 14rem; line-height: 1;">
            <i class="bi bi-calendar3"></i>
        </div>

        <div class="container position-relative">

            <div class="row align-items-center py-4">

                <div class="col-lg-8">

                    <nav aria-label="breadcrumb" class="mb-3">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/') }}"
                                   class="text-white text-decoration-none">
                                    Beranda
                                </a>
                            </li>

                            <li class="breadcrumb-item text-white-50">
                                Akademik
                            </li>

                            <li class="breadcrumb-item active text-white"
                                aria-current="page">
                                Kalender Pendidikan
                            </li>
                        </ol>
                    </nav>

                    <span class="badge bg-white text-custom-green rounded-pill px-3 py-2 mb-3">
                    <i class="bi bi-calendar3 me-1"></i>
                    Kalender Akademik
                </span>

                    <h1 class="display-5 fw-bold text-white mb-3">
                        Kalender Pendidikan
                    </h1>

                    <p class="lead text-white-50 mb-0"
                       style="max-width: 700px;">
                        Informasi jadwal dan kegiatan pendidikan
                        SMA Islam As-Syafi'iyah 01 dalam satu tahun ajaran.
                    </p>

                </div>

                <div class="col-lg-4 d-none d-lg-block text-center">

                    <div class="calendar-hero-icon">
                        <i class="bi bi-calendar-week"></i>
                    </div>

                </div>

            </div>

        </div>
    </section>


    {{-- ============================================================
         CONTENT
    ============================================================ --}}
    <section class="py-5">

        <div class="container">

            {{-- INTRO --}}
            <div class="text-center mb-5 animate-on-scroll">

            <span class="text-custom-green fw-semibold">
                JADWAL KEGIATAN
            </span>

                <h2 class="fw-bold mt-2 mb-3">
                    Kalender Pendidikan Sekolah
                </h2>

                <p class="text-body-secondary mx-auto mb-0"
                   style="max-width: 750px;">
                    Kalender pendidikan berisi berbagai informasi penting
                    mengenai kegiatan akademik, ujian, libur sekolah,
                    pembagian rapor, dan kegiatan pendidikan lainnya.
                </p>

            </div>


            {{-- FILTER TAHUN AJARAN --}}
            @if($tahunAjarans->count())

                <div class="row justify-content-center mb-5 animate-on-scroll">

                    <div class="col-md-5 col-lg-4">

                        <label for="filterTahunAjaran"
                               class="form-label fw-semibold">
                            <i class="bi bi-funnel me-1"></i>
                            Tahun Ajaran
                        </label>

                        <select id="filterTahunAjaran"
                                class="form-select">

                            <option value="">
                                Semua Tahun Ajaran
                            </option>

                            @foreach($tahunAjarans as $tahunAjaran)

                                <option value="{{ $tahunAjaran }}">
                                    {{ $tahunAjaran }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>

            @endif


            {{-- TIMELINE --}}
            <div class="calendar-timeline">

                @forelse($kalenderPendidikans as $index => $kalender)

                    <div class="calendar-item animate-on-scroll"
                         data-tahun-ajaran="{{ $kalender->tahun_ajaran }}">

                        {{-- TIMELINE DOT --}}
                        <div class="calendar-dot">

                            <i class="bi bi-calendar-event"></i>

                        </div>


                        {{-- CARD --}}
                        <div class="card border-0 shadow-sm rounded-4 calendar-card">

                            <div class="card-body p-4">

                                <div class="row g-4 align-items-center">

                                    {{-- TANGGAL --}}
                                    <div class="col-md-3 col-lg-2">

                                        <div class="calendar-date text-center">

                                            <div class="calendar-date-day">
                                                {{ $kalender->tanggal_mulai->format('d') }}
                                            </div>

                                            <div class="calendar-date-month">
                                                {{ $kalender->tanggal_mulai->translatedFormat('F') }}
                                            </div>

                                            <div class="calendar-date-year">
                                                {{ $kalender->tanggal_mulai->format('Y') }}
                                            </div>

                                        </div>

                                        @if($kalender->tanggal_selesai)

                                            <div class="text-center mt-2">

                                                <small class="text-body-secondary">
                                                    s/d
                                                    {{ $kalender->tanggal_selesai->translatedFormat('d F Y') }}
                                                </small>

                                            </div>

                                        @endif

                                    </div>


                                    {{-- DETAIL --}}
                                    <div class="col-md-9 col-lg-10">

                                        <div class="d-flex flex-wrap gap-2 mb-2">

                                            @if($kalender->kategori)

                                                <span class="badge rounded-pill"
                                                      style="
                                                      background: {{ $kalender->warna ?: 'var(--primary-green)' }};
                                                      color: #fff;
                                                  ">
                                                {{ $kalender->kategori }}
                                            </span>

                                            @endif

                                            @if($kalender->tahun_ajaran)

                                                <span class="badge bg-body-secondary text-body rounded-pill">
                                                <i class="bi bi-mortarboard me-1"></i>
                                                {{ $kalender->tahun_ajaran }}
                                            </span>

                                            @endif

                                        </div>


                                        <h4 class="fw-bold mb-2">
                                            {{ $kalender->judul }}
                                        </h4>


                                        @if($kalender->deskripsi)

                                            <p class="text-body-secondary mb-0">
                                                {!! nl2br(e($kalender->deskripsi)) !!}
                                            </p>

                                        @endif

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                @empty

                    {{-- EMPTY STATE --}}
                    <div class="text-center py-5">

                        <div class="empty-calendar-icon mb-4">
                            <i class="bi bi-calendar-x"></i>
                        </div>

                        <h4 class="fw-bold">
                            Belum Ada Kalender Pendidikan
                        </h4>

                        <p class="text-body-secondary mb-0">
                            Informasi kalender pendidikan akan
                            ditampilkan di halaman ini.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </section>


    {{-- ============================================================
         CTA
    ============================================================ --}}
    <section class="py-5 bg-body-tertiary">

        <div class="container">

            <div class="rounded-4 p-4 p-lg-5 text-center"
                 style="background: var(--primary-green);">

                <i class="bi bi-calendar-check display-4 text-white mb-3 d-block"></i>

                <h2 class="fw-bold text-white mb-3">
                    Tetap Ikuti Agenda Sekolah
                </h2>

                <p class="text-white-50 mx-auto mb-4"
                   style="max-width: 650px;">
                    Pantau kalender pendidikan untuk mengetahui
                    jadwal kegiatan akademik dan agenda penting
                    SMA Islam As-Syafi'iyah 01.
                </p>

                <a href="{{ url('/ppdb') }}"
                   class="btn btn-light rounded-pill px-4 py-2 fw-semibold">
                    Informasi PPDB
                    <i class="bi bi-arrow-right ms-1"></i>
                </a>

            </div>

        </div>

    </section>

@endsection

