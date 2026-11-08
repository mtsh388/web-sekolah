@extends('admin.template.admin')

@section('title', 'Visi & Misi Sekolah')

@section('content-admin')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.6/Sortable.min.js"></script>
    <style>

        .visi-preview-text {

            font-size: 1.05rem;

            line-height: 1.9;

            white-space: pre-line;

        }


        .misi-description {

            line-height: 1.7;

            white-space: normal;

        }


        .misi-description br {

            display: block;

            content: "";

            margin-bottom: .5rem;

        }


        .misi-card {

            transition: transform .2s ease,
            box-shadow .2s ease;

        }


        .misi-card:hover {

            transform: translateY(-2px);

            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .08);

        }
        .misi-drag-handle {
            transition: all .2s ease;
        }

        .misi-drag-handle:hover {
            background-color: var(--bs-primary-bg-subtle) !important;
            color: var(--bs-primary) !important;
        }

        .misi-drag-handle:active {
            cursor: grabbing !important;
        }

        .sortable-ghost {
            opacity: .4;
        }

        .sortable-drag {
            cursor: grabbing;
        }

        .misi-item {
            transition: all .2s ease;
        }
    </style>
    {{-- ============================================================
        APP CONTENT HEADER
    ============================================================ --}}
    <div class="app-content-header">

        <div class="container-fluid">

            <div class="row">

                <div class="col-sm-6">

                    <h1 class="mb-0 fs-3">
                        Visi & Misi Sekolah
                    </h1>

                </div>

                <div class="col-sm-6">

                    <nav aria-label="breadcrumb">

                        <ol class="breadcrumb float-sm-end">

                            <li class="breadcrumb-item">

                                <a href="{{ url('/admin') }}">
                                    Beranda
                                </a>

                            </li>

                            <li class="breadcrumb-item">
                                Profil Sekolah
                            </li>

                            <li class="breadcrumb-item active"
                                aria-current="page">

                                Visi & Misi

                            </li>

                        </ol>

                    </nav>

                </div>

            </div>

        </div>

    </div>


    {{-- ============================================================
        APP CONTENT
    ============================================================ --}}
    <div class="app-content">

        <div class="container-fluid">


            {{-- ====================================================
                SUCCESS ALERT
            ==================================================== --}}
            @if(session('success'))

                <div class="alert alert-success alert-dismissible fade show"
                     role="alert">

                    <i class="fa-solid fa-circle-check me-2"></i>

                    {{ session('success') }}

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert">
                    </button>

                </div>

            @endif


            {{-- ====================================================
                ERROR ALERT
            ==================================================== --}}
            @if($errors->any())

                <div class="alert alert-danger alert-dismissible fade show"
                     role="alert">

                    <strong>
                        <i class="fa-solid fa-triangle-exclamation me-2"></i>
                        Terdapat kesalahan:
                    </strong>

                    <ul class="mb-0 mt-2">

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert">
                    </button>

                </div>

            @endif


            {{-- ====================================================
                PAGE DESCRIPTION
            ==================================================== --}}
            <div class="mb-4">

                <p class="text-secondary mb-0">

                    Kelola visi dan misi sekolah yang ditampilkan
                    pada halaman profil sekolah.

                </p>

            </div>


            <div class="row g-4">


                {{-- =================================================
                    VISI
                ================================================== --}}
                <div class="col-lg-5">

                    <div class="card border-0 shadow-sm h-100">

                        {{-- HEADER --}}
                        <div class="card-header bg-white">

                            <div class="d-flex align-items-center">

                                <div class="me-3">

                                <span
                                    class="d-flex align-items-center justify-content-center
                                           bg-primary bg-opacity-10
                                           text-primary rounded"
                                    style="
                                        width: 45px;
                                        height: 45px;
                                    "
                                >

                                    <i class="fa-solid fa-eye fs-5"></i>

                                </span>

                                </div>


                                <div>

                                    <h3 class="card-title mb-1">
                                        Visi Sekolah
                                    </h3>

                                    <small class="text-secondary">

                                        Gambaran cita-cita dan arah
                                        sekolah di masa depan.

                                    </small>

                                </div>

                            </div>

                        </div>


                        {{-- FORM --}}
                        <form
                            action="{{ $visi
                            ? route('admin.profile.visi-misi.visi.update', $visi)
                            : route('admin.profile.visi-misi.visi.store') }}"
                            method="POST"
                        >

                            @csrf

                            @if($visi)

                                @method('PUT')

                            @endif


                            <div class="card-body">


                                {{-- JUDUL --}}
                                <div class="mb-4">

                                    <label for="judul"
                                           class="form-label fw-semibold">

                                        Judul

                                        <span class="text-danger">
                                        *
                                    </span>

                                    </label>

                                    <input
                                        type="text"
                                        id="judul"
                                        name="judul"
                                        class="form-control @error('judul') is-invalid @enderror"
                                        value="{{ old('judul', $visi->judul ?? 'Visi Sekolah') }}"
                                        placeholder="Contoh: Visi Sekolah"
                                        required
                                    >

                                    @error('judul')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                    @enderror

                                </div>


                                {{-- DESKRIPSI --}}
                                <div class="mb-4">

                                    <label for="deskripsi-visi"
                                           class="form-label fw-semibold">

                                        Deskripsi Visi

                                        <span class="text-danger">
                                        *
                                    </span>

                                    </label>

                                    <textarea
                                        id="deskripsi-visi"
                                        name="deskripsi"
                                        rows="8"
                                        class="form-control @error('deskripsi') is-invalid @enderror"
                                        placeholder="Tuliskan visi sekolah..."
                                        required
                                    >{{ old('deskripsi', $visi->deskripsi ?? '') }}</textarea>

                                    @error('deskripsi')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                    @enderror

                                </div>


                                {{-- STATUS --}}
                                <div class="mb-2">

                                    <div class="form-check form-switch">

                                        <input
                                            type="checkbox"
                                            name="is_active"
                                            value="1"
                                            id="visi-active"
                                            class="form-check-input"
                                            @checked(old('is_active', $visi->is_active ?? true))
                                        >

                                        <label
                                            class="form-check-label"
                                            for="visi-active"
                                        >

                                            Aktifkan visi sekolah

                                        </label>

                                    </div>

                                </div>

                            </div>


                            {{-- FOOTER --}}
                            <div class="card-footer bg-white">

                                <button
                                    type="submit"
                                    class="btn btn-primary"
                                >

                                    <i class="fa-solid fa-save me-1"></i>

                                    {{ $visi ? 'Simpan Perubahan' : 'Simpan Visi' }}

                                </button>

                            </div>

                        </form>

                    </div>

                </div>


                {{-- =================================================
                    PREVIEW VISI
                ================================================== --}}
                <div class="col-lg-7">

                    <div class="card border-0 shadow-sm h-100">

                        <div class="card-header bg-white">

                            <h3 class="card-title mb-0">

                                <i class="fa-solid fa-eye text-primary me-2"></i>

                                Preview Visi

                            </h3>

                        </div>


                        <div class="card-body d-flex align-items-center">

                            <div class="w-100 text-center px-3 px-md-5">


                                <div
                                    class="d-inline-flex align-items-center
                                       justify-content-center
                                       rounded-circle
                                       bg-primary bg-opacity-10
                                       text-primary mb-4"
                                    style="
                                    width: 85px;
                                    height: 85px;
                                "
                                >

                                    <i class="fa-solid fa-bullseye fa-2x"></i>

                                </div>


                                <h3
                                    id="preview-visi-judul"
                                    class="fw-bold mb-3"
                                >

                                    {{ $visi->judul ?? 'Visi Sekolah' }}

                                </h3>


                                <div
                                    class="mx-auto mb-4"
                                    style="
                                    width: 60px;
                                    height: 4px;
                                    background-color: var(--bs-primary);
                                    border-radius: 10px;
                                "
                                ></div>


                                <p
                                    id="preview-visi-deskripsi"
                                    class="text-secondary visi-preview-text mb-0"
                                >

                                    {{ $visi->deskripsi ?? 'Deskripsi visi sekolah akan tampil di sini.' }}

                                </p>


                                <div class="mt-4">

                                    @if($visi?->is_active)

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

                            </div>

                        </div>

                    </div>

                </div>


            </div>


            {{-- ============================================================
                MISI
            ============================================================ --}}
            <div class="card border-0 shadow-sm mt-4">


                {{-- HEADER --}}
                <div class="card-header bg-white">

                    <div class="d-flex flex-wrap justify-content-between
                            align-items-center gap-2">

                        <div>

                            <div class="d-flex align-items-center">

                                <div class="me-3">

                                <span
                                    class="d-flex align-items-center
                                           justify-content-center
                                           bg-success bg-opacity-10
                                           text-success rounded"
                                    style="
                                        width: 45px;
                                        height: 45px;
                                    "
                                >

                                    <i class="fa-solid fa-list-check fs-5"></i>

                                </span>

                                </div>


                                <div>

                                    <h3 class="card-title mb-1">
                                        Misi Sekolah
                                    </h3>

                                    <small class="text-secondary ms-3">

                                        Langkah dan upaya untuk mewujudkan
                                        visi sekolah.

                                    </small>

                                </div>

                            </div>

                        </div>


                        {{-- TAMBAH MISI --}}
                        <button
                            type="button"
                            class="btn btn-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#modalTambahMisi"
                        >

                            <i class="fa-solid fa-plus me-1"></i>

                            Tambah Misi

                        </button>

                    </div>

                </div>


                {{-- BODY --}}
                <div class="card-body">


                    @if($misis->count())

                        <div class="row g-3">

                            <div class="row g-3" id="sortable-misi">

                                @foreach($misis as $misi)

                                    <div class="col-md-6 misi-item"
                                         data-id="{{ $misi->id }}">

                                        <div class="card border h-100 misi-card">

                                            <div class="card-body">

                                                <div class="d-flex gap-3">

                                                    {{-- DRAG HANDLE --}}
                                                    <div class="flex-shrink-0">

                                                        <div
                                                            class="misi-drag-handle d-flex align-items-center justify-content-center
                                       rounded-circle bg-light text-secondary"
                                                            style="
                                    width: 42px;
                                    height: 42px;
                                    cursor: grab;
                                "
                                                            title="Geser untuk mengubah urutan"
                                                        >

                                                            <i class="fa-solid fa-grip-vertical"></i>

                                                        </div>

                                                    </div>


                                                    {{-- NOMOR --}}
                                                    <div class="flex-shrink-0">

                                                        <div
                                                            class="misi-number d-flex align-items-center
                                       justify-content-center
                                       rounded-circle
                                       bg-primary
                                       text-white
                                       fw-bold"
                                                            style="
                                    width: 42px;
                                    height: 42px;
                                "
                                                        >

                                                            {{ $loop->iteration }}

                                                        </div>

                                                    </div>


                                                    {{-- CONTENT --}}
                                                    <div class="flex-grow-1">

                                                        <div class="misi-description text-secondary">

                                                            {!! nl2br(e($misi->deskripsi)) !!}

                                                        </div>


                                                        <div class="mt-3">

                                                            @if($misi->is_active)

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


                                                            <span class="badge bg-light text-dark border ms-1">

                                    Urutan:
                                    <span class="misi-order">
                                        {{ $misi->urutan }}
                                    </span>

                                </span>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>


                                            {{-- ACTION --}}
                                            <div class="card-footer bg-white">

                                                <div class="d-flex justify-content-end gap-2">

                                                    {{-- EDIT --}}
                                                    <button
                                                        type="button"
                                                        class="btn btn-sm btn-warning"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalEditMisi{{ $misi->id }}"
                                                        title="Edit"
                                                    >

                                                        <i class="fa-solid fa-pen"></i>

                                                        <span class="d-none d-sm-inline ms-1">
                                Edit
                            </span>

                                                    </button>


                                                    {{-- DELETE --}}
                                                    <form
                                                        action="{{ route('admin.profile.visi-misi.misi.destroy', $misi) }}"
                                                        method="POST"
                                                        class="delete-misi-form"
                                                    >

                                                        @csrf
                                                        @method('DELETE')

                                                        <button
                                                            type="submit"
                                                            class="btn btn-sm btn-danger"
                                                            title="Hapus"
                                                        >

                                                            <i class="fa-solid fa-trash"></i>

                                                            <span class="d-none d-sm-inline ms-1">
                                    Hapus
                                </span>

                                                        </button>

                                                    </form>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    {{-- MODAL EDIT tetap seperti sebelumnya --}}

                                @endforeach

                            </div>

                        </div>


                    @else

                        {{-- EMPTY STATE --}}
                        <div class="text-center py-5">

                            <div
                                class="d-inline-flex align-items-center
                                   justify-content-center
                                   rounded-circle
                                   bg-light
                                   text-secondary
                                   mb-4"
                                style="
                                width: 90px;
                                height: 90px;
                            "
                            >

                                <i class="fa-solid fa-list-check fa-2x"></i>

                            </div>


                            <h4 class="fw-bold">

                                Belum Ada Misi

                            </h4>


                            <p class="text-secondary mb-4">

                                Belum ada misi sekolah yang ditambahkan.

                            </p>


                            <button
                                type="button"
                                class="btn btn-primary"
                                data-bs-toggle="modal"
                                data-bs-target="#modalTambahMisi"
                            >

                                <i class="fa-solid fa-plus me-1"></i>

                                Tambah Misi

                            </button>

                        </div>

                    @endif

                </div>

            </div>


        </div>

    </div>


    <div
        class="modal fade"
        id="modalTambahMisi"
        tabindex="-1"
        aria-hidden="true"
    >

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">


                <div class="modal-header">

                    <h5 class="modal-title">

                        <i class="fa-solid fa-plus text-primary me-2"></i>

                        Tambah Misi

                    </h5>


                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                    ></button>

                </div>


                <form
                    action="{{ route('admin.profile.visi-misi.misi.store') }}"
                    method="POST"
                >

                    @csrf


                    <div class="modal-body">


                        {{-- DESKRIPSI --}}
                        <div class="mb-3">

                            <label
                                for="deskripsi-misi"
                                class="form-label fw-semibold"
                            >

                                Deskripsi Misi

                                <span class="text-danger">
                                *
                            </span>

                            </label>


                            <textarea
                                id="deskripsi-misi"
                                name="deskripsi"
                                rows="5"
                                class="form-control"
                                placeholder="Tuliskan misi sekolah..."
                                required
                            >{{ old('deskripsi') }}</textarea>


                            <div class="form-text">

                                Tuliskan satu misi dalam satu data.

                            </div>

                        </div>


                        {{-- URUTAN --}}
                        <div class="mb-3">

                            <label
                                for="urutan-misi"
                                class="form-label fw-semibold"
                            >

                                Urutan

                            </label>


                            <input
                                type="number"
                                id="urutan-misi"
                                name="urutan"
                                class="form-control"
                                value="{{ old('urutan', ($misis->max('urutan') ?? 0) + 1) }}"
                                min="0"
                            >

                            <div class="form-text">

                                Angka yang lebih kecil akan ditampilkan lebih dahulu.

                            </div>

                        </div>


                        {{-- STATUS --}}
                        <div class="form-check form-switch">

                            <input
                                type="checkbox"
                                name="is_active"
                                value="1"
                                id="new-misi-active"
                                class="form-check-input"
                                @checked(old('is_active', true))
                            >

                            <label
                                class="form-check-label"
                                for="new-misi-active"
                            >

                                Aktifkan misi

                            </label>

                        </div>

                    </div>


                    <div class="modal-footer">

                        <button
                            type="button"
                            class="btn btn-light border"
                            data-bs-dismiss="modal"
                        >

                            Batal

                        </button>


                        <button
                            type="submit"
                            class="btn btn-primary"
                        >

                            <i class="fa-solid fa-save me-1"></i>

                            Simpan Misi

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

    <script>

        document.addEventListener('DOMContentLoaded', function () {


            // ====================================================
            // LIVE PREVIEW VISI
            // ====================================================

            const judulVisi =
                document.getElementById('judul');

            const deskripsiVisi =
                document.getElementById('deskripsi-visi');

            const previewJudulVisi =
                document.getElementById('preview-visi-judul');

            const previewDeskripsiVisi =
                document.getElementById('preview-visi-deskripsi');


            if (judulVisi && previewJudulVisi) {

                judulVisi.addEventListener('input', function () {

                    previewJudulVisi.textContent =
                        this.value || 'Visi Sekolah';

                });

            }


            if (deskripsiVisi && previewDeskripsiVisi) {

                deskripsiVisi.addEventListener('input', function () {

                    previewDeskripsiVisi.textContent =
                        this.value ||
                        'Deskripsi visi sekolah akan tampil di sini.';

                });

            }


            // ====================================================
            // DELETE CONFIRMATION
            // ====================================================

            document.addEventListener('submit', function (event) {

                if (
                    !event.target.classList.contains(
                        'delete-misi-form'
                    )
                ) {

                    return;

                }


                const confirmed = confirm(
                    'Apakah Anda yakin ingin menghapus misi ini?'
                );


                if (!confirmed) {

                    event.preventDefault();

                }

            });
// ====================================================
// DRAG & DROP URUTAN MISI
// ====================================================

            const sortableMisi = document.getElementById('sortable-misi');

            if (sortableMisi) {

                new Sortable(sortableMisi, {

                    animation: 200,

                    handle: '.misi-drag-handle',

                    ghostClass: 'sortable-ghost',

                    dragClass: 'sortable-drag',

                    onEnd: function () {

                        updateMisiOrder();

                    }

                });

            }


            function updateMisiOrder() {

                const items =
                    document.querySelectorAll('#sortable-misi .misi-item');

                const orders = [];

                items.forEach(function (item, index) {

                    const id =
                        item.dataset.id;

                    const urutan =
                        index + 1;

                    orders.push({
                        id: id,
                        urutan: urutan
                    });

                    // Update nomor tampilan
                    const number =
                        item.querySelector('.misi-number');

                    if (number) {

                        number.textContent =
                            urutan;

                    }

                    // Update tulisan urutan
                    const order =
                        item.querySelector('.misi-order');

                    if (order) {

                        order.textContent =
                            urutan;

                    }

                });


                // Kirim ke Laravel
                fetch(
                    "{{ route('admin.profile.visi-misi.misi.order') }}",
                    {
                        method: 'POST',

                        headers: {

                            'Content-Type': 'application/json',

                            'X-CSRF-TOKEN':
                                document
                                    .querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content'),

                            'Accept':
                                'application/json'

                        },

                        body: JSON.stringify({

                            orders: orders

                        })

                    }
                )
                    .then(response => {

                        if (!response.ok) {

                            throw new Error(
                                'Gagal menyimpan urutan misi.'
                            );

                        }

                        return response.json();

                    })
                    .then(data => {

                        console.log(
                            'Urutan misi berhasil diperbarui.',
                            data
                        );

                    })
                    .catch(error => {

                        console.error(
                            'Error:',
                            error
                        );

                        alert(
                            'Gagal menyimpan urutan misi.'
                        );

                    });

            }
        });

    </script>


@endsection
