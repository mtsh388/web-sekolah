@extends('template.app')

@section('title', 'Berita & Informasi | SMA Islam As-Syafi\'iyah 01')

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

            <div class="text-center text-white">

                <span class="badge bg-custom-yellow text-dark rounded-pill px-3 py-2 mb-3">
                    <i class="bi bi-newspaper me-1"></i>
                    INFORMASI SEKOLAH
                </span>

                <h1 class="display-5 fw-bold mb-3">
                    Berita & Kegiatan
                </h1>

                <p class="lead mb-0 mx-auto"
                   style="max-width: 700px;">
                    Informasi terbaru seputar kegiatan, prestasi,
                    program, dan aktivitas SMA Islam As-Syafi'iyah 01.
                </p>

            </div>

        </div>

    </section>


    <!-- DAFTAR BERITA -->
    <section class="py-5">

        <div class="container">

            <!-- FILTER -->
            <div class="d-flex flex-column flex-md-row
                        justify-content-between
                        align-items-md-center
                        gap-3 mb-5">

                <div>
                    <h2 class="fw-bold text-custom-green mb-1">
                        Berita Terbaru
                    </h2>

                    <p class="text-body-secondary mb-0">
                        Temukan informasi terbaru dari sekolah kami.
                    </p>
                </div>


                @if($categories->count() > 0)

                    <div style="min-width: 250px;">

                        <form action="{{ route('berita.index') }}"
                              method="GET"
                              id="filterBeritaForm">

                            <select name="category"
                                    id="category"
                                    class="form-select">

                                <option value="">
                                    Semua Kategori
                                </option>

                                @foreach($categories as $category)

                                    <option value="{{ $category }}"
                                        {{ request('category') == $category ? 'selected' : '' }}>
                                        {{ $category }}
                                    </option>

                                @endforeach

                            </select>

                        </form>

                    </div>

                @endif

            </div>


            <!-- CARDS -->
            <div class="row g-4">

                @forelse($beritas as $index => $berita)

                    <div class="col-md-6 col-lg-4">

                        <article class="card card-custom h-100
                                        shadow-sm
                                        rounded-4
                                        overflow-hidden">

                            <!-- IMAGE -->
                            <div class="position-relative"
                                 style="height: 230px;">

                                {{-- Ekstrak ID YouTube dari link --}}
                                @php
                                    $yt_id = null;
                                    if ($berita->youtube_url && preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $berita->youtube_url, $match)) {
                                        $yt_id = $match[1];
                                    }
                                @endphp

                                @if($yt_id)

                                    <!-- YouTube Thumbnail & Play Button -->
                                    <img src="https://img.youtube.com/vi/{{ $yt_id }}/hqdefault.jpg"
                                         alt="{{ $berita->title }}"
                                         class="w-100 h-100"
                                         style="object-fit: cover; filter: brightness(0.9);">

                                    <div class="position-absolute top-50 start-50 translate-middle">
                                        <div class="bg-danger text-white rounded-circle d-flex align-items-center justify-content-center shadow" style="width: 60px; height: 60px; opacity: 0.9;">
                                            <i class="bi bi-play-fill ms-1" style="font-size: 2rem;"></i>
                                        </div>
                                    </div>

                                @elseif($berita->image)

                                    <!-- Gambar Biasa -->
                                    <img src="{{ asset('images/berita/' . $berita->image) }}"
                                         alt="{{ $berita->title }}"
                                         class="w-100 h-100"
                                         style="object-fit: cover;">

                                @else

                                    <!-- Placeholder -->
                                    <div class="bg-body-secondary
                                                w-100 h-100
                                                d-flex
                                                align-items-center
                                                justify-content-center">
                                        <i class="bi bi-image
                                                  fs-1
                                                  text-body-secondary">
                                        </i>
                                    </div>

                                @endif


                                <!-- CATEGORY -->
                                @if($berita->category)

                                    <div class="position-absolute
                                                top-0
                                                start-0
                                                p-3 z-1">

                                        <span class="badge bg-custom-green
                                                     rounded-pill
                                                     px-3 py-2 shadow-sm">

                                            {{ $berita->category }}

                                        </span>

                                    </div>

                                @endif

                            </div>


                            <!-- CONTENT -->
                            <div class="card-body p-4 d-flex flex-column">

                                <!-- DATE & VIEWS -->
                                <div class="d-flex
                                            justify-content-between
                                            align-items-center
                                            mb-3">

                                    @if($berita->published_at)

                                        <small class="text-body-secondary">

                                            <i class="bi bi-calendar3 me-1"></i>

                                            {{ $berita->published_at->translatedFormat('d F Y') }}

                                        </small>

                                    @endif


                                    <small class="text-body-secondary">

                                        <i class="bi bi-eye me-1"></i>

                                        {{ number_format($berita->views) }}

                                    </small>

                                </div>


                                <!-- TITLE -->
                                <h5 class="card-title fw-bold mb-3">

                                    {{ $berita->title }}

                                </h5>


                                <!-- EXCERPT -->
                                <p class="card-text
                                          text-body-secondary
                                          flex-grow-1">

                                    {!! nl2br(e(\Illuminate\Support\Str::limit(strip_tags($berita->content), 150))) !!}

                                </p>


                                <!-- BUTTON -->
                                <div class="mt-3">

                                    <a href="{{ route('berita.show', $berita->slug) }}"
                                       class="btn btn-custom-green
                                              rounded-pill
                                              px-4">
                                        Baca Selengkapnya

                                        <i class="bi bi-arrow-right ms-1"></i>

                                    </a>

                                </div>

                            </div>

                        </article>

                    </div>

                @empty

                    <div class="col-12">

                        <div class="text-center py-5">

                            <div class="mb-3">

                                <i class="bi bi-newspaper
                                          display-1
                                          text-body-secondary">
                                </i>

                            </div>

                            <h4 class="fw-bold text-body-secondary">
                                Belum Ada Berita
                            </h4>

                            <p class="text-body-secondary mb-0">
                                Belum ada berita yang dipublikasikan.
                            </p>

                        </div>

                    </div>

                @endforelse

            </div>


            <!-- PAGINATION -->
            @if($beritas->hasPages())

                <div class="d-flex
                            justify-content-center
                            mt-5">

                    {{ $beritas->links() }}

                </div>

            @endif

        </div>

    </section>

    <script>
        $(document).ready(function () {

            $('#category').select2({
                theme: 'bootstrap-5',
                width: '100%',
                placeholder: 'Semua Kategori',
                allowClear: true,
                dropdownAutoWidth: true
            });

            $('#category').on('change', function () {
                $('#filterBeritaForm').submit();
            });

        });
    </script>
@endsection
