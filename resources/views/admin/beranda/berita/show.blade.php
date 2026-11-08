@extends('admin.template.admin')

@section('title', $berita->title)

@section('content-admin')

    <div class="container-fluid mt-3">

        <div class="mb-4">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <h4 class="fw-bold mb-1">
                        Detail Berita
                    </h4>

                    <p class="text-muted mb-0">
                        Informasi lengkap berita.
                    </p>

                </div>

                <div class="d-flex gap-2">

                    <a href="{{ route('admin.berita.edit', $berita) }}"
                       class="btn btn-warning">

                        <i class="fa-solid fa-pen me-1"></i>
                        Edit

                    </a>

                    <a href="{{ route('admin.berandas.berita') }}"
                       class="btn btn-light border">

                        <i class="fa-solid fa-arrow-left me-1"></i>
                        Kembali

                    </a>

                </div>

            </div>

        </div>


        <div class="card border-0 shadow-sm">

            <div class="card-body">

                @if($berita->image)

                    <div class="text-center mb-4">

                        <img
                            src="{{ asset('storage/' . $berita->image) }}"
                            alt="{{ $berita->title }}"
                            class="img-fluid rounded"
                            style="max-height:400px;">

                    </div>

                @endif


                <div class="mb-3">

                    @if($berita->is_featured)

                        <span class="badge bg-primary mb-2">

                        <i class="fa-solid fa-star me-1"></i>
                        Berita Unggulan

                    </span>

                    @endif

                    <h2 class="fw-bold">
                        {{ $berita->title }}
                    </h2>

                </div>


                <div class="d-flex flex-wrap gap-2 mb-4">

                    @if($berita->category)

                        <span class="badge bg-secondary">
                        {{ $berita->category }}
                    </span>

                    @endif

                    @if($berita->status === 'published')

                        <span class="badge bg-success">
                        Published
                    </span>

                    @else

                        <span class="badge bg-warning text-dark">
                        Draft
                    </span>

                    @endif

                    <span class="badge bg-light text-dark border">

                    <i class="fa-regular fa-eye me-1"></i>

                    {{ number_format($berita->views) }} views

                </span>

                </div>


                @if($berita->published_at)

                    <div class="text-muted small mb-4">

                        <i class="fa-regular fa-calendar me-1"></i>

                        {{ $berita->published_at->translatedFormat('d F Y H:i') }}

                    </div>

                @endif


                <hr>


                <div class="mt-4">

                    {!! $berita->content !!}

                </div>

            </div>

        </div>

    </div>

@endsection
