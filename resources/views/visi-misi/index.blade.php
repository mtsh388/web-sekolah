@extends('template.app')

@section('title', 'Visi & Misi | SMA Islam As-Syafi\'iyah 01')

@section('content')

    {{-- ============================================================
        HEADER / HERO
    ============================================================ --}}
    <section class="py-5 bg-custom-green text-white">
        <div class="container py-4">
            <div class="row align-items-center">

                <div class="col-lg-8 mx-auto text-center">

                    <div class="mb-3">
                        <span class="badge bg-white text-custom-green rounded-pill px-3 py-2">
                            <i class="bi bi-bullseye me-1"></i>
                            Profil Sekolah
                        </span>
                    </div>

                    <h1 class="display-5 fw-bold mb-3">
                        Visi & Misi
                    </h1>

                    <p class="lead mb-0 opacity-75">
                        Landasan dan arah pendidikan
                        SMA Islam As-Syafi'iyah 01
                        dalam membentuk generasi yang unggul dan berkarakter.
                    </p>

                </div>

            </div>
        </div>
    </section>


    {{-- ============================================================
        VISI
    ============================================================ --}}
    <section class="py-5">
        <div class="container">

            <div class="row justify-content-center">

                <div class="col-lg-10">

                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                        <div class="card-body p-4 p-md-5">

                            <div class="text-center mb-4">

                                <div class="d-inline-flex align-items-center justify-content-center
                                            rounded-circle bg-custom-green text-white mb-3"
                                     style="width: 70px; height: 70px;">

                                    <i class="bi bi-eye fs-2"></i>

                                </div>

                                <h2 class="fw-bold text-custom-green mb-2">
                                    {{ $visi?->judul ?? 'Visi Sekolah' }}
                                </h2>

                                <div class="mx-auto"
                                     style="width: 60px; height: 3px; background-color: var(--primary-green);">
                                </div>

                            </div>


                            @if($visi)
                                <div class="text-center">

                                    <blockquote class="mb-0">

                                        <p class="fs-4 fw-semibold text-body-emphasis lh-base mb-0">
                                            "{{ $visi->deskripsi }}"
                                        </p>

                                    </blockquote>

                                </div>
                            @else

                                <div class="text-center py-4">

                                    <i class="bi bi-info-circle fs-1 text-body-secondary"></i>

                                    <p class="text-body-secondary mt-3 mb-0">
                                        Visi sekolah belum tersedia.
                                    </p>

                                </div>

                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </section>


    {{-- ============================================================
        MISI
    ============================================================ --}}
    <section class="py-5 bg-body-tertiary">

        <div class="container">

            <div class="text-center mb-5">

                <div class="d-inline-flex align-items-center justify-content-center
                            rounded-circle bg-custom-green text-white mb-3"
                     style="width: 70px; height: 70px;">

                    <i class="bi bi-list-check fs-2"></i>

                </div>

                <h2 class="fw-bold text-custom-green">
                    Misi Sekolah
                </h2>

                <p class="text-body-secondary mb-0">
                    Langkah strategis sekolah dalam mewujudkan visi pendidikan.
                </p>

            </div>


            @if($misinya->count())

                <div class="row justify-content-center">

                    <div class="col-lg-10">

                        <div class="d-flex flex-column gap-3">

                            @foreach($misinya as $index => $misi)

                                <div class="card border-0 shadow-sm rounded-4">

                                    <div class="card-body p-4">

                                        <div class="d-flex align-items-start gap-3">

                                            {{-- Nomor --}}
                                            <div class="flex-shrink-0">

                                                <div class="d-flex align-items-center justify-content-center
                                                            rounded-circle bg-custom-green text-white fw-bold"
                                                     style="width: 48px; height: 48px;">

                                                    {{ $index + 1 }}

                                                </div>

                                            </div>


                                            {{-- Isi Misi --}}
                                            <div class="flex-grow-1">

                                                <p class="mb-0 fs-5 lh-base text-body-emphasis">
                                                    {{ $misi->deskripsi }}
                                                </p>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </div>

                </div>

            @else

                <div class="text-center py-5">

                    <i class="bi bi-list-check fs-1 text-body-secondary"></i>

                    <h5 class="mt-3 text-body-secondary">
                        Misi sekolah belum tersedia.
                    </h5>

                    <p class="text-body-secondary mb-0">
                        Informasi misi sekolah akan ditampilkan di halaman ini.
                    </p>

                </div>

            @endif

        </div>

    </section>


    {{-- ============================================================
        CALL TO ACTION
    ============================================================ --}}
    <section class="py-5">

        <div class="container">

            <div class="card border-0 shadow-sm rounded-4 bg-custom-green text-white overflow-hidden">

                <div class="card-body p-4 p-md-5">

                    <div class="row align-items-center">

                        <div class="col-lg-8">

                            <h3 class="fw-bold mb-2">
                                Mengenal Lebih Dekat Sekolah Kami
                            </h3>

                            <p class="mb-lg-0 opacity-75">
                                Temukan informasi lebih lengkap mengenai
                                SMA Islam As-Syafi'iyah 01 dan berbagai
                                kegiatan sekolah.
                            </p>

                        </div>

                        <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">

                            <a href="{{ url('/berita') }}"
                               class="btn btn-light rounded-pill px-4">

                                <i class="bi bi-newspaper me-2"></i>
                                Berita & Kegiatan

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

@endsection
