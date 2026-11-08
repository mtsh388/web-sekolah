@extends('admin.template.admin')

@section('title', 'Tenaga Pendidik')

@section('content-admin')

    <style>

        .tabulator {
            border: 0;
            font-size: .925rem;
        }

        .tabulator .tabulator-header {
            border-bottom: 1px solid #dee2e6;
            font-weight: 600;
        }

        .tabulator .tabulator-header .tabulator-col {
            background-color: #fff;
        }

        .tabulator-row {
            min-height: 70px;
        }

        .tabulator-row:hover {
            background-color: rgba(13, 110, 253, .035);
        }

        .tabulator-cell {
            display: flex;
            align-items: center;
        }

        .drag-handle {
            cursor: grab;
            font-size: 1rem;
        }

        .drag-handle:active {
            cursor: grabbing;
        }

        .tenaga-foto {
            width: 48px;
            height: 48px;
            object-fit: cover;
            border-radius: 50%;
            border: 1px solid #dee2e6;
        }

        .foto-placeholder {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f1f3f5;
            color: #6c757d;
        }

        .tabulator-row.tabulator-moving {
            opacity: .7;
        }

        .saving-order {
            display: none;
        }

        .saving-order.show {
            display: inline-flex;
        }

    </style>


    {{-- ============================================================
        HEADER
    ============================================================ --}}

    <div class="app-content-header">

        <div class="container-fluid">

            <div class="row">

                <div class="col-sm-6">

                    <h1 class="mb-0 fs-3">
                        Tenaga Pendidik
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

                            <li class="breadcrumb-item active">
                                Tenaga Pendidik
                            </li>

                        </ol>

                    </nav>

                </div>

            </div>

        </div>

    </div>


    {{-- ============================================================
        CONTENT
    ============================================================ --}}

    <div class="app-content">

        <div class="container-fluid">


            {{-- SUCCESS --}}

            @if(session('success'))

                <div
                    class="alert alert-success alert-dismissible fade show"
                    role="alert"
                >

                    <i class="fa-solid fa-circle-check me-2"></i>

                    {{ session('success') }}

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                    ></button>

                </div>

            @endif


            {{-- ERROR --}}

            @if($errors->any())

                <div
                    class="alert alert-danger alert-dismissible fade show"
                    role="alert"
                >

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

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                    ></button>

                </div>

            @endif


            {{-- ====================================================
                CARD
            ==================================================== --}}

            <div class="card border-0 shadow-sm">


                {{-- HEADER --}}

                <div class="card-header bg-white">

                    <div
                        class="d-flex flex-wrap
                           justify-content-between
                           align-items-center
                           gap-3"
                    >

                        <div>

                            <div class="d-flex align-items-center">

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

                                    <i class="fa-solid fa-chalkboard-user fs-5"></i>

                                </span>

                                </div>


                                <div>

                                    <h3 class="card-title mb-1">
                                        Data Tenaga Pendidik
                                    </h3>

                                    <small class="text-secondary ms-3">
                                        Kelola data guru dan tenaga pendidik sekolah.
                                    </small>

                                </div>

                            </div>

                        </div>


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

                                Tambah Tenaga Pendidik

                            </button>

                        </div>

                    </div>

                </div>


                {{-- BODY --}}

                <div class="card-body">

                    <div
                        class="alert alert-info d-flex align-items-center mb-3"
                    >

                        <i class="fa-solid fa-circle-info me-2"></i>

                        <div>
                            <strong>Tips:</strong>
                            Drag ikon
                            <i class="fa-solid fa-grip-vertical mx-1"></i>
                            untuk mengubah urutan tenaga pendidik.
                            Perubahan urutan akan otomatis disimpan.
                        </div>

                    </div>


                    {{-- TABULATOR --}}

                    <div id="table-tenaga-pendidik"></div>

                </div>

            </div>

        </div>

    </div>


    {{-- ============================================================
        MODAL TAMBAH
    ============================================================ --}}

    <div
        class="modal fade"
        id="modalTambah"
        tabindex="-1"
        aria-hidden="true"
    >

        <div class="modal-dialog modal-lg modal-dialog-centered">

            <div class="modal-content">


                <div class="modal-header">

                    <h5 class="modal-title">

                        <i class="fa-solid fa-plus text-primary me-2"></i>

                        Tambah Tenaga Pendidik

                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                    ></button>

                </div>


                <form
                    action="{{ route('admin.profile.tenaga-pendidik.store') }}"
                    method="POST"
                    enctype="multipart/form-data"
                >

                    @csrf


                    <div class="modal-body">

                        <div class="row g-3">


                            {{-- NAMA --}}

                            <div class="col-md-6">

                                <label class="form-label fw-semibold">

                                    Nama

                                    <span class="text-danger">*</span>

                                </label>

                                <input
                                    type="text"
                                    name="nama"
                                    class="form-control"
                                    placeholder="Nama lengkap"
                                    required
                                >

                            </div>


                            {{-- JABATAN --}}

                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Jabatan
                                </label>

                                <input
                                    type="text"
                                    name="jabatan"
                                    class="form-control"
                                    placeholder="Contoh: Guru"
                                >

                            </div>


                            {{-- MATA PELAJARAN --}}

                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Mata Pelajaran
                                </label>

                                <input
                                    type="text"
                                    name="mata_pelajaran"
                                    class="form-control"
                                    placeholder="Contoh: Matematika"
                                >

                            </div>


                            {{-- URUTAN --}}

                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Urutan
                                </label>

                                <input
                                    type="number"
                                    name="urutan"
                                    class="form-control"
                                    min="0"
                                    placeholder="Otomatis"
                                >

                            </div>


                            {{-- FOTO --}}

                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
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

                                {{-- PREVIEW FOTO --}}
                                <div
                                    id="tambah-foto-preview"
                                    class="mt-3"
                                    style="display: none;"
                                >

                                    <div class="d-flex align-items-center gap-3">

                                        <img
                                            id="tambah-foto-preview-image"
                                            src=""
                                            alt="Preview Foto"
                                            class="tenaga-foto"
                                        >

                                        <div>
                                            <div class="fw-semibold">
                                                Preview Foto
                                            </div>

                                            <small class="text-secondary">
                                                Foto yang dipilih
                                            </small>
                                        </div>

                                    </div>

                                </div>

                            </div>


                            {{-- STATUS --}}

                            <div class="col-md-6">

                                <label class="form-label fw-semibold d-block">
                                    Status
                                </label>

                                <div class="form-check form-switch mt-2">

                                    <input
                                        type="checkbox"
                                        name="is_active"
                                        value="1"
                                        id="tambah-active"
                                        class="form-check-input"
                                        checked
                                    >

                                    <label
                                        class="form-check-label"
                                        for="tambah-active"
                                    >
                                        Aktif
                                    </label>

                                </div>

                            </div>


                            {{-- DESKRIPSI --}}

                            <div class="col-12">

                                <label class="form-label fw-semibold">
                                    Deskripsi
                                </label>

                                <textarea
                                    name="deskripsi"
                                    rows="5"
                                    class="form-control"
                                    placeholder="Deskripsi tenaga pendidik..."
                                ></textarea>

                            </div>

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

                            Simpan

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    {{-- ============================================================
        MODAL EDIT DINAMIS
    ============================================================ --}}

    <div
        class="modal fade"
        id="modalEdit"
        tabindex="-1"
        aria-hidden="true"
    >

        <div class="modal-dialog modal-lg modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">

                        <i class="fa-solid fa-pen text-warning me-2"></i>

                        Edit Tenaga Pendidik

                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                    ></button>

                </div>


                <form
                    id="formEdit"
                    method="POST"
                    enctype="multipart/form-data"
                >

                    @csrf

                    @method('PUT')


                    <div class="modal-body">

                        <div class="row g-3">


                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Nama
                                    <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="text"
                                    name="nama"
                                    id="edit-nama"
                                    class="form-control"
                                    required
                                >

                            </div>


                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Jabatan
                                </label>

                                <input
                                    type="text"
                                    name="jabatan"
                                    id="edit-jabatan"
                                    class="form-control"
                                >

                            </div>


                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Mata Pelajaran
                                </label>

                                <input
                                    type="text"
                                    name="mata_pelajaran"
                                    id="edit-mata-pelajaran"
                                    class="form-control"
                                >

                            </div>


                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
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


                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Foto Baru
                                </label>

                                <input
                                    type="file"
                                    name="foto"
                                    class="form-control"
                                    accept=".jpg,.jpeg,.png,.webp"
                                >

                                <div
                                    id="edit-foto-preview"
                                    class="mt-2"
                                ></div>

                            </div>


                            <div class="col-md-6">

                                <label class="form-label fw-semibold d-block">
                                    Status
                                </label>

                                <div class="form-check form-switch mt-2">

                                    <input
                                        type="checkbox"
                                        name="is_active"
                                        value="1"
                                        id="edit-active"
                                        class="form-check-input"
                                    >

                                    <label
                                        class="form-check-label"
                                        for="edit-active"
                                    >
                                        Aktif
                                    </label>

                                </div>

                            </div>


                            <div class="col-12">

                                <label class="form-label fw-semibold">
                                    Deskripsi
                                </label>

                                <textarea
                                    name="deskripsi"
                                    id="edit-deskripsi"
                                    rows="5"
                                    class="form-control"
                                ></textarea>

                            </div>

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

                            Simpan Perubahan

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    {{-- ============================================================
        TABULATOR
    ============================================================ --}}

    <link
        href="https://unpkg.com/tabulator-tables@6.3.1/dist/css/tabulator_bootstrap5.min.css"
        rel="stylesheet"
    >

    <script src="https://unpkg.com/tabulator-tables@6.3.1/dist/js/tabulator.min.js"></script>


    <script>

        document.addEventListener('DOMContentLoaded', function () {

// ============================================================
// PREVIEW FOTO TAMBAH
// ============================================================

            const tambahFoto =
                document.getElementById('tambah-foto');

            const tambahFotoPreview =
                document.getElementById('tambah-foto-preview');

            const tambahFotoPreviewImage =
                document.getElementById('tambah-foto-preview-image');


            if (tambahFoto) {

                tambahFoto.addEventListener(
                    'change',
                    function (event) {

                        const file =
                            event.target.files[0];

                        // Tidak ada file
                        if (!file) {

                            tambahFotoPreview.style.display =
                                'none';

                            tambahFotoPreviewImage.src =
                                '';

                            return;
                        }


                        // ========================================================
                        // VALIDASI TIPE FILE
                        // ========================================================

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

                            tambahFotoPreview.style.display =
                                'none';

                            return;
                        }


                        // ========================================================
                        // VALIDASI UKURAN
                        // ========================================================

                        const maxSize =
                            2 * 1024 * 1024; // 2 MB


                        if (file.size > maxSize) {

                            alert(
                                'Ukuran foto maksimal 2 MB.'
                            );

                            tambahFoto.value = '';

                            tambahFotoPreview.style.display =
                                'none';

                            return;
                        }


                        // ========================================================
                        // PREVIEW
                        // ========================================================

                        const reader =
                            new FileReader();


                        reader.onload =
                            function (e) {

                                tambahFotoPreviewImage.src =
                                    e.target.result;

                                tambahFotoPreview.style.display =
                                    'block';

                            };


                        reader.readAsDataURL(file);

                    }
                );

            }
            // ============================================================
            // CSRF
            // ============================================================

            const csrfToken =
                document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute('content');


            // ============================================================
            // TABULATOR
            // ============================================================

            const table =
                new Tabulator(
                    "#table-tenaga-pendidik",
                    {

                        // ============================================================
                        // AJAX
                        // ============================================================

                        ajaxURL:
                            "{{ route('admin.profile.tenaga-pendidik.data') }}",

                        ajaxConfig: "GET",

                        /**
                         * Laravel mengembalikan:
                         *
                         * {
                         *     data: [...]
                         * }
                         *
                         * Tabulator membutuhkan array.
                         */
                        ajaxResponse: function (
                            url,
                            params,
                            response
                        ) {

                            console.log(
                                'Response Tenaga Pendidik:',
                                response
                            );

                            return response.data ?? [];
                        },


                        // ============================================================
                        // TABLE
                        // ============================================================

                        layout: "fitColumns",

                        pagination: false,

                        movableRows: true,

                        movableRowsHandle: ".drag-handle",

                        placeholder:
                            "Belum ada data tenaga pendidik.",


                        // ============================================================
                        // COLUMNS
                        // ============================================================

                        columns: [

                            // ========================================================
                            // DRAG HANDLE
                            // ========================================================

                            {
                                title: "",
                                field: "drag",
                                width: 50,
                                hozAlign: "center",
                                headerHozAlign: "center",
                                headerSort: false,
                                frozen: true,

                                formatter: function () {

                                    return `
                                                <i
                                                    class="fa-solid
                                                           fa-grip-vertical
                                                           text-secondary
                                                           drag-handle"
                                                    title="Drag untuk mengubah urutan"
                                                ></i>
                                            `;

                                }

                            },

                            // ========================================================
                            // URUTAN
                            // ========================================================

                            {
                                title: "Urutan",
                                field: "urutan",
                                width: 100,
                                hozAlign: "center",
                                headerHozAlign: "center"
                            },

                            // ========================================================
                            // FOTO
                            // ========================================================

                            {
                                title: "Foto",
                                field: "foto",
                                width: 80,
                                hozAlign: "center",
                                headerHozAlign: "center",

                                formatter: function (cell) {

                                    const foto =
                                        cell.getValue();

                                    if (!foto) {

                                        return `
                                <div
                                    class="foto-placeholder"
                                >
                                    <i
                                        class="fa-solid
                                               fa-user"
                                    ></i>
                                </div>
                            `;

                                    }

                                    return `
                                            <img
                                                    src="/images/tenaga-pendidik/${escapeHtml(foto)}"
                                                    class="tenaga-foto"
                                                    alt="Foto"
                                                    onerror="this.style.display='none';"
                                                >
                                            `;

                                }

                            },


                            // ========================================================
                            // NAMA
                            // ========================================================

                            {
                                title: "Nama",
                                field: "nama",
                                minWidth: 220,

                                formatter: function (cell) {

                                    return `
                            <div>
                                <div class="fw-semibold">
                                    ${escapeHtml(
                                        cell.getValue() || '-'
                                    )}
                                </div>
                            </div>
                        `;

                                }

                            },


                            // ========================================================
                            // JABATAN
                            // ========================================================

                            {
                                title: "Jabatan",
                                field: "jabatan",
                                minWidth: 160,

                                formatter: function (cell) {

                                    return escapeHtml(
                                        cell.getValue() || '-'
                                    );

                                }

                            },


                            // ========================================================
                            // MATA PELAJARAN
                            // ========================================================

                            {
                                title: "Mata Pelajaran",
                                field: "mata_pelajaran",
                                minWidth: 180,

                                formatter: function (cell) {

                                    return escapeHtml(
                                        cell.getValue() || '-'
                                    );

                                }

                            },


                            // ========================================================
                            // STATUS
                            // ========================================================

                            {
                                title: "Status",
                                field: "is_active",
                                width: 110,
                                hozAlign: "center",
                                headerHozAlign: "center",

                                formatter: function (cell) {

                                    const active =
                                        cell.getValue();

                                    return active

                                        ? `
                                <span
                                    class="badge bg-success"
                                >
                                    <i
                                        class="fa-solid
                                               fa-check
                                               me-1"
                                    ></i>
                                    Aktif
                                </span>
                            `

                                        : `
                                <span
                                    class="badge bg-secondary"
                                >
                                    <i
                                        class="fa-solid
                                               fa-xmark
                                               me-1"
                                    ></i>
                                    Tidak Aktif
                                </span>
                            `;

                                }

                            },





                            // ========================================================
                            // AKSI - FROZEN
                            // ========================================================

                            {
                                title: "Aksi",
                                width: 145,
                                hozAlign: "center",
                                headerHozAlign: "center",
                                headerSort: false,

                                frozen: true,

                                formatter: function () {

                                    return `
                            <div
                                class="d-flex
                                       justify-content-center
                                       gap-1"
                            >

                                <button
                                    type="button"
                                    class="btn
                                           btn-sm
                                           btn-warning
                                           btn-edit"
                                    title="Edit"
                                >
                                    <i
                                        class="fa-solid
                                               fa-pen"
                                    ></i>
                                </button>

                                <button
                                    type="button"
                                    class="btn
                                           btn-sm
                                           btn-danger
                                           btn-delete"
                                    title="Hapus"
                                >
                                    <i
                                        class="fa-solid
                                               fa-trash"
                                    ></i>
                                </button>

                            </div>
                        `;

                                },

                                cellClick: function (
                                    e,
                                    cell
                                ) {

                                    const row =
                                        cell.getRow();

                                    const data =
                                        row.getData();


                                    // EDIT

                                    if (
                                        e.target.closest(
                                            '.btn-edit'
                                        )
                                    ) {

                                        openEditModal(data);

                                    }


                                    // DELETE

                                    if (
                                        e.target.closest(
                                            '.btn-delete'
                                        )
                                    ) {

                                        deleteData(data);

                                    }

                                }

                            }

                        ]

                    }
                );


            // ============================================================
            // ROW MOVED
            // ============================================================

            table.on(
                "rowMoved",
                function (
                    row
                ) {

                    updateOrder();

                }
            );


            // ============================================================
            // UPDATE ORDER
            // ============================================================

            function updateOrder()
            {
                const rows =
                    table.getRows();

                const orders = [];


                rows.forEach(
                    function (
                        row,
                        index
                    ) {

                        const data =
                            row.getData();

                        orders.push({

                            id: data.id,

                            urutan:
                                index + 1

                        });

                    }
                );


                const saving =
                    document.getElementById(
                        'saving-order'
                    );


                saving.classList.add(
                    'show'
                );


                fetch(
                    "{{ route('admin.profile.tenaga-pendidik.order') }}",
                    {

                        method: "POST",

                        headers: {

                            "Content-Type":
                                "application/json",

                            "Accept":
                                "application/json",

                            "X-CSRF-TOKEN":
                            csrfToken

                        },

                        body: JSON.stringify({
                            orders: orders
                        })

                    }
                )
                    .then(
                        response => {

                            if (!response.ok) {

                                throw new Error(
                                    'Gagal menyimpan urutan.'
                                );

                            }

                            return response.json();

                        }
                    )
                    .then(
                        function (
                            response
                        ) {

                            if (response.success) {

                                table.getRows()
                                    .forEach(
                                        function (
                                            row,
                                            index
                                        ) {

                                            row.update({

                                                urutan:
                                                    index + 1

                                            });

                                        }
                                    );

                            }

                        }
                    )
                    .catch(
                        function (
                            error
                        ) {

                            console.error(
                                error
                            );

                            alert(
                                'Urutan gagal disimpan.'
                            );

                            table.setData();

                        }
                    )
                    .finally(
                        function () {

                            saving.classList.remove(
                                'show'
                            );

                        }
                    );
            }


            // ============================================================
            // EDIT MODAL
            // ============================================================

            function openEditModal(data)
            {

                const form =
                    document.getElementById(
                        'formEdit'
                    );


                form.action =
                    "{{ url('/admin/profile/tenaga-pendidik') }}"
                    + "/"
                    + data.id;


                document.getElementById(
                    'edit-nama'
                ).value =
                    data.nama || '';


                document.getElementById(
                    'edit-jabatan'
                ).value =
                    data.jabatan || '';


                document.getElementById(
                    'edit-mata-pelajaran'
                ).value =
                    data.mata_pelajaran || '';


                document.getElementById(
                    'edit-urutan'
                ).value =
                    data.urutan || 1;


                document.getElementById(
                    'edit-deskripsi'
                ).value =
                    data.deskripsi || '';


                document.getElementById(
                    'edit-active'
                ).checked =
                    Boolean(data.is_active);


                const preview =
                    document.getElementById(
                        'edit-foto-preview'
                    );


                if (data.foto) {

                    preview.innerHTML = `

                <img
                    src="/images/${data.foto}"
                    class="tenaga-foto"
                    alt="Foto"
                >

                <small class="text-secondary ms-2">
                    Foto saat ini
                </small>

            `;

                } else {

                    preview.innerHTML = '';

                }


                const modal =
                    bootstrap.Modal.getOrCreateInstance(
                        document.getElementById(
                            'modalEdit'
                        )
                    );


                modal.show();

            }


            // ============================================================
            // DELETE
            // ============================================================

            function deleteData(data)
            {

                if (
                    !confirm(
                        `Apakah Anda yakin ingin menghapus "${data.nama}"?`
                    )
                ) {

                    return;

                }


                fetch(
                    "{{ url('/admin/profile/tenaga-pendidik') }}"
                    + "/"
                    + data.id,
                    {

                        method: "POST",

                        headers: {

                            "Content-Type":
                                "application/json",

                            "Accept":
                                "application/json",

                            "X-CSRF-TOKEN":
                            csrfToken,

                            "X-HTTP-Method-Override":
                                "DELETE"

                        },

                        body: JSON.stringify({})

                    }
                )
                    .then(
                        response => {

                            if (!response.ok) {

                                throw new Error(
                                    'Gagal menghapus data.'
                                );

                            }

                            return response.text();

                        }
                    )
                    .then(
                        function () {

                            location.reload();

                        }
                    )
                    .catch(
                        function (
                            error
                        ) {

                            console.error(
                                error
                            );

                            alert(
                                'Data gagal dihapus.'
                            );

                        }
                    );

            }


            // ============================================================
            // ESCAPE HTML
            // ============================================================

            function escapeHtml(
                value
            ) {

                return String(value)
                    .replace(
                        /&/g,
                        '&amp;'
                    )
                    .replace(
                        /</g,
                        '&lt;'
                    )
                    .replace(
                        />/g,
                        '&gt;'
                    )
                    .replace(
                        /"/g,
                        '&quot;'
                    )
                    .replace(
                        /'/g,
                        '&#039;'
                    );

            }

        });

    </script>

@endsection
