@extends('admin.template.admin')

@section('title', 'Tambah Program Unggulan')

@section('content-admin')

    <div class="container-fluid">

        {{-- HEADER --}}
        <div class="mb-4">

            <div class="d-flex justify-content-between align-items-center">

                <div>
                    <h4 class="fw-bold mb-1">
                        Tambah Program Unggulan
                    </h4>

                    <p class="text-muted mb-0">
                        Tambahkan program unggulan sekolah.
                    </p>
                </div>

                <a
                    href="{{ route('admin.akademik.program-unggulan.index') }}"
                    class="btn btn-secondary"
                >
                    <i class="fa-solid fa-arrow-left me-1"></i>
                    Kembali
                </a>

            </div>

        </div>


        <form
            action="{{ route('admin.akademik.program-unggulan.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf

            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white">
                    <h5 class="mb-0 fw-semibold">
                        Informasi Program
                    </h5>
                </div>


                <div class="card-body">

                    {{-- JUDUL --}}
                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            Judul Program
                            <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="judul"
                            value="{{ old('judul') }}"
                            class="form-control @error('judul') is-invalid @enderror"
                            placeholder="Contoh: Program Tahfidz Al-Qur'an"
                            required
                        >

                        @error('judul')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>


                    {{-- DESKRIPSI --}}
                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            Deskripsi
                        </label>

                        <textarea
                            name="deskripsi"
                            rows="6"
                            class="form-control @error('deskripsi') is-invalid @enderror"
                            placeholder="Deskripsi program unggulan..."
                        >{{ old('deskripsi') }}</textarea>

                        @error('deskripsi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>


                    <div class="row">

                        {{-- FOTO --}}
                        <div class="col-md-8">

                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Foto
                                </label>

                                <input
                                    type="file"
                                    name="foto"
                                    id="foto"
                                    accept="image/jpeg,image/png,image/webp"
                                    class="form-control @error('foto') is-invalid @enderror"
                                >

                                <small class="text-muted">
                                    JPG, JPEG, PNG, WEBP. Maksimal 2 MB.
                                </small>

                                @error('foto')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror

                            </div>

                            {{-- PREVIEW --}}
                            <div id="preview-container" class="d-none mb-3">

                                <label class="form-label fw-semibold">
                                    Preview
                                </label>

                                <div>
                                    <img
                                        id="preview"
                                        src="#"
                                        class="rounded border"
                                        style="
                                        width: 250px;
                                        height: 160px;
                                        object-fit: cover;
                                    "
                                    >
                                </div>

                            </div>

                        </div>


                        {{-- URUTAN --}}
                        <div class="col-md-2">

                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Urutan
                                </label>

                                <input
                                    type="number"
                                    name="urutan"
                                    value="{{ old('urutan', $nextUrutan) }}"
                                    min="0"
                                    class="form-control @error('urutan') is-invalid @enderror"
                                >

                                @error('urutan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror

                            </div>

                        </div>


                        {{-- STATUS --}}
                        <div class="col-md-2">

                            <div class="mb-3">

                                <label class="form-label fw-semibold d-block">
                                    Status
                                </label>

                                <div class="form-check form-switch mt-2">

                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        name="is_active"
                                        value="1"
                                        id="is_active"
                                        checked
                                    >

                                    <label
                                        class="form-check-label"
                                        for="is_active"
                                    >
                                        Aktif
                                    </label>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <div class="card-footer bg-white text-end">

                    <a
                        href="{{ route('admin.akademik.program-unggulan.index') }}"
                        class="btn btn-secondary"
                    >
                        Batal
                    </a>

                    <button
                        type="submit"
                        class="btn btn-success"
                    >
                        <i class="fa-solid fa-save me-1"></i>
                        Simpan
                    </button>

                </div>

            </div>

        </form>

    </div>
    <script>
        document.getElementById('foto').addEventListener('change', function (event) {

            const file = event.target.files[0];

            if (!file) {
                document.getElementById('preview-container')
                    .classList.add('d-none');

                return;
            }

            const reader = new FileReader();

            reader.onload = function (e) {

                document.getElementById('preview').src = e.target.result;

                document.getElementById('preview-container')
                    .classList.remove('d-none');

            };

            reader.readAsDataURL(file);

        });
    </script>
@endsection

