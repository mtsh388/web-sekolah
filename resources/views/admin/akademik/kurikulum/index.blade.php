@extends('admin.template.admin')

@section('title', 'Kurikulum')

@section('content-admin')

    <style>
        /* ============================================================
           TABULATOR
        ============================================================ */

        .tabulator {
            border: 0;
            font-size: .925rem;
        }

        .tabulator .tabulator-header {
            border-bottom: 1px solid #dee2e6;
            font-weight: 600;
        }

        .tabulator .tabulator-header .tabulator-col {
            background: #f8f9fa;
            border-right: 1px solid #eee;
        }

        .tabulator-row {
            min-height: 75px;
            border-bottom: 1px solid #f1f1f1;
        }

        .tabulator-row:hover {
            background: #f8f9fa !important;
        }

        .tabulator-cell {
            display: flex;
            align-items: center;
        }

        /* ============================================================
           DRAG HANDLE
        ============================================================ */

        .drag-handle {
            cursor: grab;
            color: #6c757d;
            font-size: 1.1rem;
        }

        .drag-handle:active {
            cursor: grabbing;
        }

        /* ============================================================
           FOTO
        ============================================================ */

        .kurikulum-foto {
            width: 70px;
            height: 50px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #dee2e6;
        }

        .foto-placeholder {
            width: 70px;
            height: 50px;
            border-radius: 8px;
            background: #f1f3f5;
            border: 1px solid #dee2e6;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #adb5bd;
            font-size: 1.25rem;
        }

        /* ============================================================
           PREVIEW FOTO
        ============================================================ */

        .foto-preview-box {
            padding: 12px;
            border: 1px dashed #ced4da;
            border-radius: 8px;
            background: #f8f9fa;
        }

        .foto-preview {
            width: 150px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #dee2e6;
        }

        /* ============================================================
           ROW MOVING
        ============================================================ */

        .tabulator-row.tabulator-moving {
            opacity: .65;
        }

        /* ============================================================
           ORDER SAVING
        ============================================================ */

        #saving-order {
            display: none;
        }
    </style>


    <div class="container-fluid">

        <div class="app-content-header">

            <div class="container-fluid mt-3">

                <div class="row">

                    <div class="col-sm-6">

                        <h1 class="mb-0 fs-3">
                            Kurikulum
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
                                    Akademik
                                </li>

                                <li class="breadcrumb-item active"
                                    aria-current="page">

                                    Kurikulum

                                </li>

                            </ol>

                        </nav>

                    </div>

                </div>

            </div>

        </div>



        {{-- ============================================================
            ALERT SUCCESS
        ============================================================ --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-circle-check me-2"></i>

                {{ session('success') }}

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                ></button>
            </div>
        @endif


        {{-- ============================================================
            ALERT ERROR
        ============================================================ --}}
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-circle-exclamation me-2"></i>

                {{ session('error') }}

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                ></button>
            </div>
        @endif


        {{-- ============================================================
            VALIDATION ERROR
        ============================================================ --}}
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">

                <div class="fw-semibold mb-1">
                    <i class="fa-solid fa-circle-exclamation me-2"></i>
                    Terdapat kesalahan:
                </div>

                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                ></button>

            </div>
        @endif


        {{-- ============================================================
            CARD
        ============================================================ --}}
        <div class="card border-0 shadow-sm">

            <div class="card-header bg-white">


                <div
                    class="d-flex flex-wrap
           justify-content-between
           align-items-center
           gap-3"
                >

                    <div>

                        <div class="d-flex align-items-center">

                            {{-- ICON --}}
                            <div class="me-3">

                <span
                    class="d-flex
                           align-items-center
                           justify-content-center
                           bg-primary
                           bg-opacity-10
                           text-primary
                           rounded"
                    style="
                        width:45px;
                        height:45px;
                    "
                >
                    <i class="fa-solid fa-book-open fs-5"></i>
                </span>

                            </div>


                            {{-- TITLE & DESCRIPTION --}}
                            <div>

                                <h3 class="card-title mb-1">
                                    Data Kurikulum
                                </h3>

                                <small class="text-secondary ms-3">
                                    Kelola informasi kurikulum sekolah.
                                </small>

                            </div>

                        </div>

                    </div>


                    {{-- RIGHT SIDE --}}
                    <div class="d-flex align-items-center gap-2">

                        {{-- STATUS SAVE ORDER --}}
                        <span
                            id="saving-order"
                            class="saving-order
                   align-items-center
                   text-secondary
                   small"
                        >

            <span
                class="spinner-border spinner-border-sm me-2"
                role="status"
            ></span>

            Menyimpan urutan...

        </span>


                        {{-- ADD --}}
                        <button
                            type="button"
                            class="btn btn-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#modalTambah"
                        >

                            <i class="fa-solid fa-plus me-1"></i>

                            Tambah Kurikulum

                        </button>

                    </div>

                </div>


            </div>



            <div class="card-body p-0">

                <div class="p-3">

                    <div class="alert alert-info mb-0">

                        <div class="d-flex align-items-start">

                            <i class="fa-solid fa-circle-info mt-1 me-2"></i>

                            <div>
                                <strong>Tips:</strong>
                                Anda dapat mengubah urutan kurikulum
                                dengan melakukan
                                <strong>drag & drop</strong>
                                menggunakan ikon
                                <i class="fa-solid fa-grip-vertical"></i>.
                            </div>

                        </div>

                    </div>

                </div>

                <div id="table-kurikulum"></div>

            </div>

        </div>

    </div>


    {{-- ================================================================
        MODAL TAMBAH
    ================================================================= --}}
    <div
        class="modal fade"
        id="modalTambah"
        tabindex="-1"
        aria-hidden="true"
    >

        <div class="modal-dialog modal-lg modal-dialog-centered">

            <div class="modal-content">

                <form
                    action="{{ route('admin.akademik.kurikulum.store') }}"
                    method="POST"
                    enctype="multipart/form-data"
                >

                    @csrf

                    <div class="modal-header">

                        <h5 class="modal-title fw-bold">
                            <i class="fa-solid fa-plus me-2"></i>
                            Tambah Kurikulum
                        </h5>

                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                        ></button>

                    </div>


                    <div class="modal-body">

                        <div class="row g-3">

                            {{-- JUDUL --}}
                            <div class="col-12">

                                <label
                                    for="tambah-judul"
                                    class="form-label fw-semibold"
                                >
                                    Judul
                                    <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="text"
                                    name="judul"
                                    id="tambah-judul"
                                    class="form-control"
                                    placeholder="Contoh: Kurikulum Merdeka"
                                    value="{{ old('judul') }}"
                                    required
                                >

                            </div>


                            {{-- URUTAN --}}
                            <div class="col-md-6">

                                <label
                                    for="tambah-urutan"
                                    class="form-label fw-semibold"
                                >
                                    Urutan
                                </label>

                                <input
                                    type="number"
                                    name="urutan"
                                    id="tambah-urutan"
                                    class="form-control"
                                    min="0"
                                    value="0"
                                >

                                <div class="form-text">
                                    Isi 0 untuk menentukan urutan secara otomatis.
                                </div>

                            </div>


                            {{-- STATUS --}}
                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Status
                                </label>

                                <div class="form-check form-switch mt-2">

                                    <input
                                        type="checkbox"
                                        name="is_active"
                                        value="1"
                                        class="form-check-input"
                                        id="tambah-is-active"
                                        checked
                                    >

                                    <label
                                        class="form-check-label"
                                        for="tambah-is-active"
                                    >
                                        Aktif
                                    </label>

                                </div>

                            </div>


                            {{-- FOTO --}}
                            <div class="col-12">

                                <label
                                    for="tambah-foto"
                                    class="form-label fw-semibold"
                                >
                                    Foto
                                </label>

                                <input
                                    type="file"
                                    name="foto"
                                    id="tambah-foto"
                                    class="form-control"
                                    accept=".jpg,.jpeg,.png,.webp"
                                >

                                <div class="form-text">
                                    JPG, JPEG, PNG atau WEBP. Maksimal 2 MB.
                                </div>


                                {{-- PREVIEW --}}
                                <div
                                    id="tambah-foto-preview"
                                    class="foto-preview-box mt-3"
                                    style="display: none;"
                                >

                                    <div class="d-flex align-items-center gap-3">

                                        <img
                                            id="tambah-foto-preview-image"
                                            src=""
                                            alt="Preview Foto"
                                            class="foto-preview"
                                        >

                                        <div>
                                            <div class="fw-semibold">
                                                Preview Foto
                                            </div>

                                            <small class="text-secondary">
                                                Foto yang dipilih akan ditampilkan di sini.
                                            </small>
                                        </div>

                                    </div>

                                </div>

                            </div>


                            {{-- DESKRIPSI --}}
                            <div class="col-12">

                                <label
                                    for="tambah-deskripsi"
                                    class="form-label fw-semibold"
                                >
                                    Deskripsi
                                </label>

                                <textarea
                                    name="deskripsi"
                                    id="tambah-deskripsi"
                                    class="form-control"
                                    rows="5"
                                    placeholder="Masukkan deskripsi kurikulum..."
                                >{{ old('deskripsi') }}</textarea>

                            </div>

                        </div>

                    </div>


                    <div class="modal-footer">

                        <button
                            type="button"
                            class="btn btn-light"
                            data-bs-dismiss="modal"
                        >
                            Batal
                        </button>

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >
                            <i class="fa-solid fa-floppy-disk me-1"></i>
                            Simpan
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    {{-- ================================================================
        MODAL EDIT
    ================================================================= --}}
    <div
        class="modal fade"
        id="modalEdit"
        tabindex="-1"
        aria-hidden="true"
    >

        <div class="modal-dialog modal-lg modal-dialog-centered">

            <div class="modal-content">

                <form
                    id="formEdit"
                    method="POST"
                    enctype="multipart/form-data"
                >

                    @csrf

                    @method('PUT')

                    <div class="modal-header">

                        <h5 class="modal-title fw-bold">
                            <i class="fa-solid fa-pen-to-square me-2"></i>
                            Edit Kurikulum
                        </h5>

                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                        ></button>

                    </div>


                    <div class="modal-body">

                        <div class="row g-3">

                            {{-- JUDUL --}}
                            <div class="col-12">

                                <label
                                    for="edit-judul"
                                    class="form-label fw-semibold"
                                >
                                    Judul
                                    <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="text"
                                    name="judul"
                                    id="edit-judul"
                                    class="form-control"
                                    required
                                >

                            </div>


                            {{-- URUTAN --}}
                            <div class="col-md-6">

                                <label
                                    for="edit-urutan"
                                    class="form-label fw-semibold"
                                >
                                    Urutan
                                </label>

                                <input
                                    type="number"
                                    name="urutan"
                                    id="edit-urutan"
                                    class="form-control"
                                    min="0"
                                    required
                                >

                            </div>


                            {{-- STATUS --}}
                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Status
                                </label>

                                <div class="form-check form-switch mt-2">

                                    <input
                                        type="checkbox"
                                        name="is_active"
                                        value="1"
                                        class="form-check-input"
                                        id="edit-is-active"
                                    >

                                    <label
                                        class="form-check-label"
                                        for="edit-is-active"
                                    >
                                        Aktif
                                    </label>

                                </div>

                            </div>


                            {{-- FOTO --}}
                            <div class="col-12">

                                <label
                                    for="edit-foto"
                                    class="form-label fw-semibold"
                                >
                                    Foto
                                </label>

                                <input
                                    type="file"
                                    name="foto"
                                    id="edit-foto"
                                    class="form-control"
                                    accept=".jpg,.jpeg,.png,.webp"
                                >

                                <div class="form-text">
                                    Kosongkan jika tidak ingin mengganti foto.
                                </div>


                                {{-- PREVIEW FOTO --}}
                                <div
                                    id="edit-foto-preview"
                                    class="foto-preview-box mt-3"
                                    style="display: none;"
                                >

                                    <div class="d-flex align-items-center gap-3">

                                        <img
                                            id="edit-foto-preview-image"
                                            src=""
                                            alt="Preview Foto"
                                            class="foto-preview"
                                        >

                                        <div>

                                            <div
                                                id="edit-foto-preview-title"
                                                class="fw-semibold"
                                            >
                                                Foto Saat Ini
                                            </div>

                                            <small class="text-secondary">
                                                Foto kurikulum.
                                            </small>

                                        </div>

                                    </div>

                                </div>

                            </div>


                            {{-- DESKRIPSI --}}
                            <div class="col-12">

                                <label
                                    for="edit-deskripsi"
                                    class="form-label fw-semibold"
                                >
                                    Deskripsi
                                </label>

                                <textarea
                                    name="deskripsi"
                                    id="edit-deskripsi"
                                    class="form-control"
                                    rows="5"
                                    placeholder="Masukkan deskripsi kurikulum..."
                                ></textarea>

                            </div>

                        </div>

                    </div>


                    <div class="modal-footer">

                        <button
                            type="button"
                            class="btn btn-light"
                            data-bs-dismiss="modal"
                        >
                            Batal
                        </button>

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >
                            <i class="fa-solid fa-floppy-disk me-1"></i>
                            Simpan Perubahan
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    {{-- ================================================================
        JAVASCRIPT
    ================================================================= --}}
    <link
        href="https://unpkg.com/tabulator-tables@6.3.1/dist/css/tabulator_bootstrap5.min.css"
        rel="stylesheet"
    >

    <script src="https://unpkg.com/tabulator-tables@6.3.1/dist/js/tabulator.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            /**
             * ========================================================
             * CSRF
             * ========================================================
             */
            const csrfToken =
                document.querySelector('meta[name="csrf-token"]')
                    ?.getAttribute('content');


            /**
             * ========================================================
             * ESCAPE HTML
             * ========================================================
             */
            function escapeHtml(value) {

                if (value === null || value === undefined) {
                    return '';
                }

                return String(value)
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;')
                    .replace(/"/g, '&quot;')
                    .replace(/'/g, '&#039;');
            }


            /**
             * ========================================================
             * PREVIEW FOTO TAMBAH
             * ========================================================
             */
            const tambahFoto =
                document.getElementById('tambah-foto');

            const tambahFotoPreview =
                document.getElementById('tambah-foto-preview');

            const tambahFotoPreviewImage =
                document.getElementById('tambah-foto-preview-image');


            if (tambahFoto) {

                tambahFoto.addEventListener('change', function (event) {

                    const file =
                        event.target.files[0];

                    if (!file) {

                        tambahFotoPreview.style.display = 'none';
                        tambahFotoPreviewImage.src = '';

                        return;
                    }


                    const allowedTypes = [
                        'image/jpeg',
                        'image/png',
                        'image/webp'
                    ];


                    if (!allowedTypes.includes(file.type)) {

                        alert(
                            'Format foto harus JPG, JPEG, PNG atau WEBP.'
                        );

                        tambahFoto.value = '';
                        tambahFotoPreview.style.display = 'none';
                        tambahFotoPreviewImage.src = '';

                        return;
                    }


                    const maxSize =
                        2 * 1024 * 1024;


                    if (file.size > maxSize) {

                        alert(
                            'Ukuran foto maksimal 2 MB.'
                        );

                        tambahFoto.value = '';
                        tambahFotoPreview.style.display = 'none';
                        tambahFotoPreviewImage.src = '';

                        return;
                    }


                    const reader =
                        new FileReader();


                    reader.onload = function (e) {

                        tambahFotoPreviewImage.src =
                            e.target.result;

                        tambahFotoPreview.style.display =
                            'block';
                    };


                    reader.readAsDataURL(file);

                });

            }


            /**
             * ========================================================
             * PREVIEW FOTO EDIT
             * ========================================================
             */
            const editFoto =
                document.getElementById('edit-foto');

            const editFotoPreview =
                document.getElementById('edit-foto-preview');

            const editFotoPreviewImage =
                document.getElementById('edit-foto-preview-image');

            const editFotoPreviewTitle =
                document.getElementById('edit-foto-preview-title');


            if (editFoto) {

                editFoto.addEventListener('change', function (event) {

                    const file =
                        event.target.files[0];

                    if (!file) {
                        return;
                    }


                    const allowedTypes = [
                        'image/jpeg',
                        'image/png',
                        'image/webp'
                    ];


                    if (!allowedTypes.includes(file.type)) {

                        alert(
                            'Format foto harus JPG, JPEG, PNG atau WEBP.'
                        );

                        editFoto.value = '';

                        return;
                    }


                    const maxSize =
                        2 * 1024 * 1024;


                    if (file.size > maxSize) {

                        alert(
                            'Ukuran foto maksimal 2 MB.'
                        );

                        editFoto.value = '';

                        return;
                    }


                    const reader =
                        new FileReader();


                    reader.onload = function (e) {

                        editFotoPreviewImage.src =
                            e.target.result;

                        editFotoPreviewTitle.textContent =
                            'Preview Foto Baru';

                        editFotoPreview.style.display =
                            'block';
                    };


                    reader.readAsDataURL(file);

                });

            }


            /**
             * ========================================================
             * TABULATOR
             * ========================================================
             */
            const table =
                new Tabulator('#table-kurikulum', {

                    ajaxURL:
                        "{{ route('admin.akademik.kurikulum.data') }}",

                    ajaxConfig: 'GET',

                    layout: 'fitColumns',

                    pagination: false,

                    movableRows: true,

                    movableRowsHandle: '.drag-handle',

                    placeholder:
                        'Belum ada data kurikulum.',


                    ajaxResponse: function (
                        url,
                        params,
                        response
                    ) {

                        console.log(
                            'Response Kurikulum:',
                            response
                        );

                        return response.data ?? [];
                    },


                    columns: [

                        /**
                         * URUTAN
                         */
                        {
                            title: 'Urutan',
                            field: 'urutan',
                            width: 100,
                            hozAlign: 'center',
                            headerHozAlign: 'center',
                        },


                        /**
                         * FOTO
                         */
                        {
                            title: 'Foto',
                            field: 'foto',
                            width: 110,
                            hozAlign: 'center',
                            headerHozAlign: 'center',

                            formatter: function (cell) {

                                const foto =
                                    cell.getValue();

                                if (!foto) {

                                    return `
                                        <div class="foto-placeholder">
                                            <i class="fa-solid fa-image"></i>
                                        </div>
                                    `;
                                }


                                return `
                                    <img
                                        src="/images/kurikulum/${escapeHtml(foto)}"
                                        class="kurikulum-foto"
                                        alt="Foto Kurikulum"
                                        onerror="this.style.display='none';"
                                    >
                                `;
                            }
                        },


                        /**
                         * JUDUL
                         */
                        {
                            title: 'Judul',
                            field: 'judul',
                            minWidth: 220,

                            formatter: function (cell) {

                                return `
                                    <div class="fw-semibold">
                                        ${escapeHtml(cell.getValue())}
                                    </div>
                                `;
                            }
                        },


                        /**
                         * DESKRIPSI
                         */
                        {
                            title: 'Deskripsi',
                            field: 'deskripsi',
                            minWidth: 300,

                            formatter: function (cell) {

                                const value =
                                    cell.getValue();

                                if (!value) {
                                    return `
                                        <span class="text-secondary">
                                            -
                                        </span>
                                    `;
                                }


                                const text =
                                    String(value)
                                        .replace(/\s+/g, ' ')
                                        .trim();


                                const shortText =
                                    text.length > 100
                                        ? text.substring(0, 100) + '...'
                                        : text;


                                return `
                                    <span
                                        class="text-secondary"
                                        title="${escapeHtml(text)}"
                                    >
                                        ${escapeHtml(shortText)}
                                    </span>
                                `;
                            }
                        },


                        /**
                         * STATUS
                         */
                        {
                            title: 'Status',
                            field: 'is_active',
                            width: 110,
                            hozAlign: 'center',
                            headerHozAlign: 'center',

                            formatter: function (cell) {

                                const active =
                                    Boolean(cell.getValue());

                                if (active) {

                                    return `
                                        <span class="badge text-bg-success">
                                            <i class="fa-solid fa-check me-1"></i>
                                            Aktif
                                        </span>
                                    `;
                                }


                                return `
                                    <span class="badge text-bg-secondary">
                                        <i class="fa-solid fa-xmark me-1"></i>
                                        Nonaktif
                                    </span>
                                `;
                            }
                        },


                        /**
                         * AKSI
                         */
                        {
                            title: 'Aksi',
                            width: 145,
                            hozAlign: 'center',
                            headerHozAlign: 'center',
                            headerSort: false,

                            formatter: function () {

                                return `
                                    <div class="d-flex gap-1 justify-content-center">

                                        <button
                                            type="button"
                                            class="btn btn-sm btn-outline-primary btn-edit"
                                            title="Edit"
                                        >
                                            <i class="fa-solid fa-pen"></i>
                                        </button>

                                        <button
                                            type="button"
                                            class="btn btn-sm btn-outline-danger btn-delete"
                                            title="Hapus"
                                        >
                                            <i class="fa-solid fa-trash"></i>
                                        </button>

                                    </div>
                                `;
                            },


                            cellClick: function (
                                e,
                                cell
                            ) {

                                const data =
                                    cell.getRow().getData();


                                /**
                                 * EDIT
                                 */
                                if (
                                    e.target.closest('.btn-edit')
                                ) {

                                    openEditModal(data);

                                    return;
                                }


                                /**
                                 * DELETE
                                 */
                                if (
                                    e.target.closest('.btn-delete')
                                ) {

                                    deleteKurikulum(data);

                                    return;
                                }

                            }
                        }

                    ]

                });


            /**
             * ========================================================
             * ROW MOVED
             * ========================================================
             */
            table.on(
                'rowMoved',
                function () {

                    updateOrder();

                }
            );


            /**
             * ========================================================
             * UPDATE ORDER
             * ========================================================
             */
            function updateOrder() {

                const rows = table.getRows();

                const orders = rows.map(function (row, index) {

                    const data = row.getData();

                    return {
                        id: data.id,
                        urutan: index + 1
                    };

                });


                const savingOrder =
                    document.getElementById('saving-order');


                if (savingOrder) {
                    savingOrder.style.display = 'flex';
                }


                fetch(
                    "{{ route('admin.akademik.kurikulum.order') }}",
                    {
                        method: 'POST',

                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },

                        body: JSON.stringify({
                            orders: orders
                        })
                    }
                )
                .then(function (response) {

                    if (!response.ok) {
                        throw new Error(
                            'Gagal menyimpan urutan.'
                        );
                    }

                    return response.json();

                })
                .then(function (response) {

                    if (!response.success) {
                        throw new Error(
                            response.message ||
                            'Gagal menyimpan urutan.'
                        );
                    }


                    /*
                     * ============================================================
                     * UPDATE NILAI URUTAN DI TABULATOR
                     * ============================================================
                     */
                    rows.forEach(function (row, index) {

                        row.update({
                            urutan: index + 1
                        });

                    });


                    /*
                     * ============================================================
                     * RELOAD DATA DARI SERVER
                     * ============================================================
                     *
                     * Memastikan posisi dan nilai urutan sesuai database.
                     */
                    return table.replaceData();

                })
                .catch(function (error) {

                    console.error(error);

                    alert(
                        error.message ||
                        'Urutan gagal disimpan.'
                    );


                    /*
                     * ============================================================
                     * JIKA GAGAL, KEMBALIKAN DATA DARI SERVER
                     * ============================================================
                     */
                    table.replaceData();

                })
                .finally(function () {

                    if (savingOrder) {
                        savingOrder.style.display = 'none';
                    }

                });

            }



            /**
             * ========================================================
             * OPEN EDIT MODAL
             * ========================================================
             */
            function openEditModal(data) {

                const formEdit =
                    document.getElementById('formEdit');

                formEdit.action =
                    "{{ route('admin.akademik.kurikulum.update', ':id') }}"
                        .replace(':id', data.id);

                document.getElementById('edit-judul').value =
                    data.judul ?? '';

                document.getElementById('edit-urutan').value =
                    data.urutan ?? 0;

                document.getElementById('edit-deskripsi').value =
                    data.deskripsi ?? '';

                document.getElementById('edit-is-active').checked =
                    Boolean(data.is_active);

                document.getElementById('edit-foto').value = '';

                if (data.foto) {

                    editFotoPreviewImage.src =
                        "/images/kurikulum/" +
                        encodeURIComponent(data.foto);

                    editFotoPreviewTitle.textContent =
                        'Foto Saat Ini';

                    editFotoPreview.style.display =
                        'block';

                } else {

                    editFotoPreviewImage.src = '';

                    editFotoPreview.style.display =
                        'none';
                }

                const modal =
                    new bootstrap.Modal(
                        document.getElementById('modalEdit')
                    );

                modal.show();
            }


            /**
             * ========================================================
             * DELETE
             * ========================================================
             */
            function deleteKurikulum(data) {

                if (!data.id) {
                    return;
                }


                if (
                    !confirm(
                        `Apakah Anda yakin ingin menghapus "${data.judul}"?`
                    )
                ) {
                    return;
                }


                fetch(
                    "{{ route('admin.akademik.kurikulum.destroy', ':id') }}"
                        .replace(':id', data.id),
                    {
                        method: 'DELETE',

                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        }
                    }
                )
                    .then(function (response) {

                        if (!response.ok) {
                            throw new Error(
                                'Gagal menghapus data.'
                            );
                        }

                        return response.json();

                    })
                    .then(function (response) {

                        if (!response.success) {

                            throw new Error(
                                response.message ||
                                'Gagal menghapus data.'
                            );
                        }


                        /**
                         * Reload data Tabulator.
                         */
                        table.replaceData();

                    })
                    .catch(function (error) {

                        console.error(error);

                        alert(
                            error.message ||
                            'Data gagal dihapus.'
                        );

                    });

            }


            /**
             * ========================================================
             * RESET MODAL TAMBAH
             * ========================================================
             */
            const modalTambah =
                document.getElementById('modalTambah');


            if (modalTambah) {

                modalTambah.addEventListener(
                    'hidden.bs.modal',
                    function () {

                        const form =
                            modalTambah.querySelector('form');

                        if (form) {
                            form.reset();
                        }


                        document.getElementById(
                            'tambah-foto-preview'
                        ).style.display = 'none';


                        document.getElementById(
                            'tambah-foto-preview-image'
                        ).src = '';

                    }
                );

            }

        });
    </script>

@endsection
