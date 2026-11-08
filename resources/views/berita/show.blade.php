@extends('template.app')

@section('title', $berita->title . ' | SMA Islam As-Syafi\'iyah 01')

@section('content')

    <!-- HEADER -->
    <section class="py-5"
             style="
                background: linear-gradient(
                    135deg,
                    var(--primary-green) 0%,
                    #0b6b39 60%,
                    #0d7a43 100%
                );
             ">

        <div class="container py-4">

            <div class="row justify-content-center">

                <div class="col-lg-9 text-center text-white">

                    @if($berita->category)

                        <span class="badge bg-custom-yellow
                                     text-dark
                                     rounded-pill
                                     px-3 py-2 mb-3">

                            {{ $berita->category }}

                        </span>

                    @endif


                    <h1 class="display-5 fw-bold mb-3">

                        {{ $berita->title }}

                    </h1>


                    <div class="d-flex
                                justify-content-center
                                align-items-center
                                flex-wrap
                                gap-3
                                text-white-50">

                        @if($berita->published_at)

                            <span>

                                <i class="bi bi-calendar3 me-1"></i>

                                {{ $berita->published_at->translatedFormat('d F Y') }}

                            </span>

                        @endif


                        <span>

                            <i class="bi bi-eye me-1"></i>

                            {{ number_format($berita->views) }} views

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- DETAIL -->
    <section class="py-5">

        <div class="container">

            <div class="row g-5">

                <!-- CONTENT -->
                <div class="col-lg-8">

                    <!-- MEDIA UTAMA (YOUTUBE / IMAGE) -->
                    @php
                        $yt_id = null;
                        if ($berita->youtube_url && preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $berita->youtube_url, $match)) {
                            $yt_id = $match[1];
                        }
                    @endphp

                    @if($yt_id)
                        <!-- Tampilkan Iframe Video YouTube -->
                        <div class="mb-4 rounded-4 overflow-hidden shadow-sm ratio ratio-16x9">
                            <iframe
                                src="https://www.youtube.com/embed/{{ $yt_id }}?rel=0"
                                title="{{ $berita->title }}"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                            </iframe>
                        </div>
                    @elseif($berita->image)
                        <!-- Tampilkan Gambar Biasa -->
                        <div class="mb-4">
                            <img src="{{ asset('images/berita/' . $berita->image) }}"
                                 alt="{{ $berita->title }}"
                                 class="img-fluid w-100 rounded-4 shadow-sm"
                                 style="max-height: 500px; object-fit: cover;">
                        </div>
                    @endif


                    <!-- ARTICLE -->
                    <article class="card card-custom
                                    border-0
                                    shadow-sm
                                    rounded-4">

                        <div class="card-body p-4 p-md-5">

                            <div class="article-content"
                                 style="
                                    font-size: 1.05rem;
                                    line-height: 1.9;
                                 ">

                                {!! $berita->content !!}

                            </div>

                        </div>

                    </article>


                    <!-- BACK -->
                    <div class="mt-4">

                        <a href="{{ route('berita.index') }}"
                           class="btn btn-outline-secondary
                                  rounded-pill
                                  px-4">

                            <i class="bi bi-arrow-left me-1"></i>

                            Kembali ke Berita

                        </a>

                    </div>

                </div>


                <!-- SIDEBAR -->
                <div class="col-lg-4">

                    <div class="position-sticky"
                         style="top: 100px;">


                        <!-- INFO -->
                        <div class="card card-custom
                                    border-0
                                    shadow-sm
                                    rounded-4
                                    mb-4">

                            <div class="card-body p-4">

                                <h5 class="fw-bold
                                           text-custom-green
                                           mb-4">

                                    Informasi Berita

                                </h5>


                                @if($berita->category)

                                    <div class="d-flex
                                                align-items-center
                                                gap-3 mb-3">

                                        <div class="rounded-circle
                                                    d-flex
                                                    align-items-center
                                                    justify-content-center"
                                             style="
                                                width: 42px;
                                                height: 42px;
                                                background: rgba(13, 92, 48, 0.1);
                                             ">

                                            <i class="bi bi-tag-fill
                                                      text-custom-green">
                                            </i>

                                        </div>

                                        <div>

                                            <small class="text-body-secondary">
                                                Kategori
                                            </small>

                                            <div class="fw-semibold">
                                                {{ $berita->category }}
                                            </div>

                                        </div>

                                    </div>

                                @endif


                                @if($berita->published_at)

                                    <div class="d-flex
                                                align-items-center
                                                gap-3 mb-3">

                                        <div class="rounded-circle
                                                    d-flex
                                                    align-items-center
                                                    justify-content-center"
                                             style="
                                                width: 42px;
                                                height: 42px;
                                                background: rgba(13, 92, 48, 0.1);
                                             ">

                                            <i class="bi bi-calendar-event-fill
                                                      text-custom-green">
                                            </i>

                                        </div>

                                        <div>

                                            <small class="text-body-secondary">
                                                Dipublikasikan
                                            </small>

                                            <div class="fw-semibold">

                                                {{ $berita->published_at->translatedFormat('d F Y') }}

                                            </div>

                                        </div>

                                    </div>

                                @endif


                                <div class="d-flex
                                            align-items-center
                                            gap-3">

                                    <div class="rounded-circle
                                                d-flex
                                                align-items-center
                                                justify-content-center"
                                         style="
                                            width: 42px;
                                            height: 42px;
                                            background: rgba(13, 92, 48, 0.1);
                                         ">

                                        <i class="bi bi-eye-fill
                                                  text-custom-green">
                                        </i>

                                    </div>

                                    <div>

                                        <small class="text-body-secondary">
                                            Jumlah Dilihat
                                        </small>

                                        <div class="fw-semibold">

                                            {{ number_format($berita->views) }} kali

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>


                        <!-- BERITA TERKAIT -->
                        @if($beritaTerkait->count())

                            <div class="card card-custom
                                        border-0
                                        shadow-sm
                                        rounded-4">

                                <div class="card-body p-4">

                                    <h5 class="fw-bold
                                               text-custom-green
                                               mb-4">

                                        Berita Terkait

                                    </h5>


                                    <div class="d-flex flex-column gap-4">

                                        @foreach($beritaTerkait as $terkait)

                                            <a href="{{ route('berita.show', $terkait->slug) }}"
                                               class="text-decoration-none text-body">

                                                <div class="d-flex gap-3 align-items-center">

                                                    <!-- MEDIA TERKAIT (THUMBNAIL) -->
                                                    <div class="flex-shrink-0 position-relative">

                                                        @php
                                                            $rel_yt_id = null;
                                                            if ($terkait->youtube_url && preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $terkait->youtube_url, $match)) {
                                                                $rel_yt_id = $match[1];
                                                            }
                                                        @endphp

                                                        @if($rel_yt_id)
                                                            {{-- Tampilan jika video (Thumbnail YouTube) --}}
                                                            <img src="https://img.youtube.com/vi/{{ $rel_yt_id }}/mqdefault.jpg"
                                                                 alt="{{ $terkait->title }}"
                                                                 class="rounded-3"
                                                                 style="width: 85px; height: 70px; object-fit: cover; filter: brightness(0.85);">

                                                            <div class="position-absolute top-50 start-50 translate-middle">
                                                                <i class="bi bi-play-circle-fill text-white fs-4 opacity-75"></i>
                                                            </div>

                                                        @elseif($terkait->image)
                                                            {{-- Tampilan jika gambar biasa (Telah disesuaikan path-nya) --}}
                                                            <img src="{{ asset('images/berita/' . $terkait->image) }}"
                                                                 alt="{{ $terkait->title }}"
                                                                 class="rounded-3"
                                                                 style="width: 85px; height: 70px; object-fit: cover;">

                                                        @else
                                                            <div class="rounded-3 bg-body-secondary d-flex align-items-center justify-content-center" style="width: 85px; height: 70px;">
                                                                <i class="bi bi-image text-body-secondary"></i>
                                                            </div>
                                                        @endif

                                                    </div>


                                                    <!-- TITLE -->
                                                    <div>
                                                        <h6 class="fw-bold mb-1 lh-sm" style="font-size: 0.95rem;">
                                                            {{ \Illuminate\Support\Str::limit($terkait->title, 55) }}
                                                        </h6>
                                                        <small class="text-body-secondary" style="font-size: 0.8rem;">
                                                            {{ $terkait->published_at ? $terkait->published_at->translatedFormat('d F Y') : '' }}
                                                        </small>
                                                    </div>

                                                </div>

                                            </a>

                                        @endforeach

                                    </div>

                                </div>

                            </div>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </section>

@endsection
