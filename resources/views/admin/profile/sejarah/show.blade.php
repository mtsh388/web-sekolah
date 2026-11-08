@extends('admin.template.admin')

@section('title', 'Detail Sejarah Sekolah')

@section('content-admin')

    <div class="container-fluid mt-3">

        {{-- HEADER --}}
        <div class="mb-4">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <h4 class="fw-bold mb-1">
                        Detail Sejarah Sekolah
                    </h4>

                    <p class="text-muted mb-0">
                        Informasi lengkap sejarah sekolah.
                    </p>

                </div>

                <div class="d-flex gap-2">

                    <a href="{{ route('admin.profile.sejarah.edit', $sejarah->id) }}"
                       class="btn btn-warning">

                        <i class="fa-solid fa-pen me-1"></i>

                        Edit

                    </a>

                    <a href="{{ route('admin.profile.sejarah.index') }}"
                       class="btn btn-light border">

                        <i class="fa-solid fa-arrow-left me-1"></i>

                        Kembali

                    </a>

                </div>

            </div>

        </div>


        <div class="row g-4">

            {{-- CONTENT --}}
            <div class="col-lg-8">

                <div class="card border-0 shadow-sm">

                    <div class="card-header bg-white">

                        <h5 class="fw-bold mb-0">
                            {{ $sejarah->judul }}
                        </h5>

                    </div>

                    <div class="card-body">

                        <div style="line-height: 1.8;">

                            {!! nl2br(e($sejarah->deskripsi)) !!}

                        </div>

                    </div>

                </div>

            </div>


            {{-- SIDEBAR --}}
            <div class="col-lg-4">

                {{-- IMAGE --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white">

                        <h5 class="fw-bold mb-0">
                            Gambar
                        </h5>

                    </div>

                    <div class="card-body">

                        @if($sejarah->image)

                            <img src="{{ asset($sejarah->image) }}"
                                 alt="{{ $sejarah->judul }}"
                                 class="img-fluid rounded">

                        @else

                            <div class="text-center text-muted py-4">

                                <i class="fa-regular fa-image fa-3x mb-2"></i>

                                <div>
                                    Belum ada gambar
                                </div>

                            </div>

                        @endif

                    </div>

                </div>


                {{-- STATUS --}}
                <div class="card border-0 shadow-sm">

                    <div class="card-header bg-white">

                        <h5 class="fw-bold mb-0">
                            Informasi
                        </h5>

                    </div>

                    <div class="card-body">

                        <div class="mb-3">

                            <div class="text-muted small">
                                Status
                            </div>

                            @if($sejarah->is_active)

                                <span class="badge bg-success">

                                    <i class="fa-solid fa-check me-1"></i>

                                    Aktif

                                </span>

                            @else

                                <span class="badge bg-secondary">

                                    <i class="fa-solid fa-xmark me-1"></i>

                                    Tidak Aktif

                                </span>

                            @endif

                        </div>


                        <div class="mb-3">

                            <div class="text-muted small">
                                Dibuat
                            </div>

                            <div class="fw-semibold">

                                {{ $sejarah->created_at?->translatedFormat('d F Y H:i') }}

                            </div>

                        </div>


                        <div>

                            <div class="text-muted small">
                                Terakhir diperbarui
                            </div>

                            <div class="fw-semibold">

                                {{ $sejarah->updated_at?->translatedFormat('d F Y H:i') }}

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
