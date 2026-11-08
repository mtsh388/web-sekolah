@extends('admin.template.admin')

@section('title', 'Ekstrakurikuler')

@section('content-admin')

    <div class="container-fluid">

        <div class="app-content-header">

            <div class="container-fluid mt-3">

                <div class="row">

                    <div class="col-sm-6">

                        <h1 class="mb-0 fs-3">
                            Ekstrakurikuler
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

                                    Ekstrakurikuler

                                </li>

                            </ol>

                        </nav>

                    </div>

                </div>

            </div>

        </div>


        {{-- ============================================================
            HEADER
        ============================================================ --}}

        <div class="card mb-4 border-0 shadow-sm">

            <div class="card-header bg-white border-bottom">

                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">

                    <div>

                        <div class="d-flex align-items-center">

                            <div class="me-3">

                                <span
                                    class="d-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary rounded"
                                    style="width:45px;height:45px;"
                                >

                                    <i class="fa-solid fa-puzzle-piece fs-5"></i>

                                </span>

                            </div>

                            <div>

                                <h3 class="card-title mb-1 fw-semibold">
                                    Ekstrakurikuler
                                </h3>

                                <small class="text-secondary ms-1">
                                    Kelola data ekstrakurikuler sekolah. Geser baris untuk mengubah urutan.
                                </small>

                            </div>

                        </div>

                    </div>


                    <div class="d-flex align-items-center gap-2">

                        <span
                            id="saving-order"
                            class="align-items-center text-secondary small"
                            style="display:none;"
                        >

                            <span
                                class="spinner-border spinner-border-sm me-2"
                                role="status"
                            ></span>

                            Menyimpan urutan...

                        </span>


                        <button
                            type="button"
                            class="btn btn-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#modalTambah"
                        >

                            <i class="fa-solid fa-plus me-1"></i>

                            Tambah Ekstrakurikuler

                        </button>

                    </div>

                </div>

            </div>


            {{-- ========================================================
                TABLE
            ========================================================= --}}

            <div class="card-body">

                <div id="table-ekstrakurikuler"></div>

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


                {{-- HEADER --}}

                <div class="modal-header">

                    <h5 class="modal-title fw-bold">

                        <i class="fa-solid fa-plus-circle me-2 text-primary"></i>

                        Tambah Ekstrakurikuler

                    </h5>


                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                    ></button>

                </div>


                {{-- FORM --}}

                <form
                    id="formTambah"
                    method="POST"
                    action="{{ route('admin.akademik.ekstrakurikuler.store') }}"
                    enctype="multipart/form-data"
                >

                    @csrf


                    <div class="modal-body">

                        <div class="row g-3">


                            {{-- ====================================================
                                NAMA
                            ===================================================== --}}

                            <div class="col-12">

                                <label
                                    for="tambah_nama"
                                    class="form-label fw-semibold"
                                >

                                    Nama Ekstrakurikuler

                                    <span class="text-danger">*</span>

                                </label>


                                <input
                                    type="text"
                                    id="tambah_nama"
                                    name="nama"
                                    class="form-control"
                                    placeholder="Contoh: Pramuka"
                                    required
                                >

                            </div>


                            {{-- ====================================================
                                PEMBINA
                            ===================================================== --}}

                            <div class="col-md-6">

                                <label
                                    for="tambah_pembina"
                                    class="form-label fw-semibold"
                                >
                                    Pembina
                                </label>


                                <input
                                    type="text"
                                    id="tambah_pembina"
                                    name="pembina"
                                    class="form-control"
                                    placeholder="Nama pembina"
                                >

                            </div>


                            {{-- ====================================================
                                JADWAL
                            ===================================================== --}}

                            <div class="col-md-6">

                                <label
                                    for="tambah_jadwal"
                                    class="form-label fw-semibold"
                                >
                                    Jadwal
                                </label>


                                <input
                                    type="text"
                                    id="tambah_jadwal"
                                    name="jadwal"
                                    class="form-control"
                                    placeholder="Contoh: Sabtu, 08.00 - 10.00"
                                >

                            </div>


                            {{-- ====================================================
                                DESKRIPSI
                            ===================================================== --}}

                            <div class="col-12">

                                <label
                                    for="tambah_deskripsi"
                                    class="form-label fw-semibold"
                                >
                                    Deskripsi
                                </label>


                                <textarea
                                    id="tambah_deskripsi"
                                    name="deskripsi"
                                    class="form-control"
                                    rows="5"
                                    placeholder="Deskripsi ekstrakurikuler..."
                                ></textarea>

                            </div>


                            {{-- ====================================================
                                FOTO
                            ===================================================== --}}

                            <div class="col-md-8">

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
                                    accept="image/jpeg,image/png,image/webp"
                                >


                                <small class="text-secondary">

                                    JPG, JPEG, PNG atau WEBP. Maksimal 2 MB.

                                </small>

                            </div>


                            {{-- ====================================================
                                PREVIEW
                            ===================================================== --}}

                            <div class="col-md-4 text-center">

                                <label class="form-label fw-semibold d-block text-start">
                                    Preview
                                </label>


                                <div
                                    id="previewTambahContainer"
                                    class="d-none"
                                >

                                    <img
                                        id="previewTambah"
                                        src=""
                                        alt="Preview"
                                        class="img-thumbnail"
                                        style="width: 150px; height: 100px; object-fit: cover;"
                                    >

                                </div>


                                <div
                                    id="tambahNoFoto"
                                    class="border rounded d-flex align-items-center justify-content-center bg-light text-secondary small mx-auto"
                                    style="width: 150px; height: 100px;"
                                >
                                    Belum ada foto
                                </div>

                            </div>


                            {{-- ====================================================
                                STATUS
                            ===================================================== --}}

                            <div class="col-12">

                                <div class="form-check form-switch">

                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        role="switch"
                                        id="tambah_is_active"
                                        name="is_active"
                                        value="1"
                                        checked
                                    >


                                    <label
                                        class="form-check-label fw-semibold"
                                        for="tambah_is_active"
                                    >
                                        Aktif
                                    </label>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- FOOTER --}}

                    <div class="modal-footer">

                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal"
                        >

                            <i class="fa-solid fa-xmark me-1"></i>

                            Batal

                        </button>


                        <button
                            type="submit"
                            class="btn btn-primary"
                            id="btnSimpan"
                        >

                            <i class="fa-solid fa-save me-1"></i>

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


                {{-- HEADER --}}

                <div class="modal-header">

                    <h5 class="modal-title fw-bold">

                        <i class="fa-solid fa-pen-to-square me-2 text-primary"></i>

                        Edit Ekstrakurikuler

                    </h5>


                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                    ></button>

                </div>


                {{-- FORM --}}

                <form
                    id="formEdit"
                    method="POST"
                    enctype="multipart/form-data"
                >

                    @csrf

                    @method('PUT')


                    <div class="modal-body">

                        <div class="row g-3">


                            {{-- ====================================================
                                NAMA
                            ===================================================== --}}

                            <div class="col-12">

                                <label
                                    for="edit_nama"
                                    class="form-label fw-semibold"
                                >

                                    Nama Ekstrakurikuler

                                    <span class="text-danger">*</span>

                                </label>


                                <input
                                    type="text"
                                    name="nama"
                                    id="edit_nama"
                                    class="form-control"
                                    required
                                >

                            </div>


                            {{-- ====================================================
                                PEMBINA
                            ===================================================== --}}

                            <div class="col-md-6">

                                <label
                                    for="edit_pembina"
                                    class="form-label fw-semibold"
                                >
                                    Pembina
                                </label>


                                <input
                                    type="text"
                                    name="pembina"
                                    id="edit_pembina"
                                    class="form-control"
                                >

                            </div>


                            {{-- ====================================================
                                JADWAL
                            ===================================================== --}}

                            <div class="col-md-6">

                                <label
                                    for="edit_jadwal"
                                    class="form-label fw-semibold"
                                >
                                    Jadwal
                                </label>


                                <input
                                    type="text"
                                    name="jadwal"
                                    id="edit_jadwal"
                                    class="form-control"
                                >

                            </div>


                            {{-- ====================================================
                                DESKRIPSI
                            ===================================================== --}}

                            <div class="col-12">

                                <label
                                    for="edit_deskripsi"
                                    class="form-label fw-semibold"
                                >
                                    Deskripsi
                                </label>


                                <textarea
                                    name="deskripsi"
                                    id="edit_deskripsi"
                                    class="form-control"
                                    rows="5"
                                ></textarea>

                            </div>


                            {{-- ====================================================
                                FOTO
                            ===================================================== --}}

                            <div class="col-md-8">

                                <label
                                    for="edit-foto"
                                    class="form-label fw-semibold"
                                >
                                    Ganti Foto
                                </label>


                                <input
                                    type="file"
                                    name="foto"
                                    id="edit-foto"
                                    class="form-control"
                                    accept="image/jpeg,image/png,image/webp"
                                >


                                <small class="text-secondary">

                                    Kosongkan jika tidak ingin mengganti foto.

                                </small>

                            </div>


                            {{-- ====================================================
                                PREVIEW
                            ===================================================== --}}

                            <div class="col-md-4 text-center">

                                <label class="form-label fw-semibold d-block text-start">
                                    Foto Saat Ini
                                </label>


                                <img
                                    id="previewEdit"
                                    src=""
                                    alt="Foto"
                                    class="img-thumbnail d-none mx-auto"
                                    style="width: 150px; height: 100px; object-fit: cover;"
                                >


                                <div
                                    id="editNoFoto"
                                    class="text-secondary small mt-2 d-none"
                                >
                                    Belum ada foto
                                </div>

                            </div>


                            {{-- ====================================================
                                STATUS
                            ===================================================== --}}

                            <div class="col-12">

                                <div class="form-check form-switch">

                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        role="switch"
                                        name="is_active"
                                        id="edit_is_active"
                                        value="1"
                                    >


                                    <label
                                        class="form-check-label fw-semibold"
                                        for="edit_is_active"
                                    >
                                        Aktif
                                    </label>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- FOOTER --}}

                    <div class="modal-footer">

                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal"
                        >

                            <i class="fa-solid fa-xmark me-1"></i>

                            Batal

                        </button>


                        <button
                            type="submit"
                            class="btn btn-primary"
                            id="btnUpdate"
                        >

                            <i class="fa-solid fa-save me-1"></i>

                            Simpan Perubahan

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>



    {{-- ================================================================
        TABULATOR
    ================================================================= --}}

    <link
        href="https://unpkg.com/tabulator-tables@6.3.1/dist/css/tabulator_bootstrap5.min.css"
        rel="stylesheet"
    >


    <script
        src="https://unpkg.com/tabulator-tables@6.3.1/dist/js/tabulator.min.js"
    ></script>



    {{-- ================================================================
        STYLE
    ================================================================= --}}

    <style>

        #saving-order {
            display: none;
        }

        .drag-handle {
            cursor: grab;
        }

        .drag-handle:active {
            cursor: grabbing;
        }

        .ekstrakurikuler-image {
            width: 70px;
            height: 50px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid rgba(0, 0, 0, .1);
        }

        .ekstrakurikuler-image-placeholder {
            width: 70px;
            height: 50px;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            border: 1px solid rgba(0, 0, 0, .1);
        }

    </style>



    {{-- ================================================================
        JAVASCRIPT
    ================================================================= --}}

    <script>

        document.addEventListener('DOMContentLoaded', function () {


            /*
            |--------------------------------------------------------------------------
            | CSRF
            |--------------------------------------------------------------------------
            */

            const csrfToken =
                document
                    .querySelector('meta[name="csrf-token"]')
                    ?.getAttribute('content');


            /*
            |--------------------------------------------------------------------------
            | URL
            |--------------------------------------------------------------------------
            */

            const dataUrl =
                "{{ route('admin.akademik.ekstrakurikuler.data') }}";

            const orderUrl =
                "{{ route('admin.akademik.ekstrakurikuler.order') }}";


            /*
            |--------------------------------------------------------------------------
            | Modal
            |--------------------------------------------------------------------------
            */

            const modalTambahElement =
                document.getElementById('modalTambah');

            const modalEditElement =
                document.getElementById('modalEdit');


            const modalTambah =
                bootstrap.Modal.getOrCreateInstance(
                    modalTambahElement
                );

            const modalEdit =
                bootstrap.Modal.getOrCreateInstance(
                    modalEditElement
                );


            /*
            |--------------------------------------------------------------------------
            | FORM
            |--------------------------------------------------------------------------
            */

            const formTambah =
                document.getElementById('formTambah');

            const formEdit =
                document.getElementById('formEdit');


            /*
            |--------------------------------------------------------------------------
            | TABULATOR
            |--------------------------------------------------------------------------
            */

            const table =
                new Tabulator(
                    "#table-ekstrakurikuler",
                    {

                        layout: "fitColumns",

                        placeholder:
                            "Belum ada data ekstrakurikuler.",

                        ajaxURL: dataUrl,

                        ajaxConfig: {
                            method: "GET",
                            headers: {
                                "Accept":
                                    "application/json"
                            }
                        },


                        /*
                        |--------------------------------------------------------------------------
                        | Response
                        |--------------------------------------------------------------------------
                        */

                        ajaxResponse:
                            function (url, params, response) {

                                return response.data ?? [];

                            },


                        /*
                        |--------------------------------------------------------------------------
                        | Drag & Drop
                        |--------------------------------------------------------------------------
                        */

                        movableRows: true,

                        movableRowsHandle:
                            ".drag-handle",


                        /*
                        |--------------------------------------------------------------------------
                        | Columns
                        |--------------------------------------------------------------------------
                        */

                        columns: [

                            {
                                title: 'Urutan',
                                field: 'urutan',
                                width: 100,
                                hozAlign: 'center',

                                formatter:
                                    function (cell) {

                                        return `
                                        ${cell.getValue() ?? 0}
                                `;

                                    }
                            },


                            {
                                title: "Foto",
                                field: "foto",
                                width: 100,
                                hozAlign: "center",
                                headerHozAlign: "center",
                                headerSort: false,

                                formatter: function (cell) {

                                    const foto =
                                        cell.getValue();

                                    if (!foto) {

                                        return `
                                            <span
                                                class="ekstrakurikuler-image-placeholder"
                                            >
                                                <i
                                                    class="fa-solid fa-image text-secondary"
                                                ></i>
                                            </span>
                                        `;

                                    }


                                    return `
                                        <img
                                            src="{{ asset('images/ekstrakurikuler') }}/${encodeURIComponent(foto)}"
                                            class="ekstrakurikuler-image"
                                            alt="Foto Ekstrakurikuler"
                                            onerror="this.onerror=null;this.parentElement.innerHTML='<span class=&quot;ekstrakurikuler-image-placeholder&quot;><i class=&quot;fa-solid fa-image text-secondary&quot;></i></span>';"
                                        >
                                    `;

                                }

                            },


                            {
                                title: "Ekstrakurikuler",
                                field: "nama",
                                minWidth: 220,

                                formatter:
                                    function (cell) {

                                        const data =
                                            cell.getRow().getData();

                                        let html = `
                                            <div class="fw-semibold">
                                                ${escapeHtml(data.nama ?? '')}
                                            </div>
                                        `;

                                        if (data.pembina) {
                                            html += `
                                                <div class="small text-secondary mt-1">
                                                    <i class="fa-solid fa-user-tie me-1"></i>
                                                    ${escapeHtml(data.pembina)}
                                                </div>
                                            `;
                                        }

                                        return html;

                                    }

                            },


                            {
                                title: "Jadwal",
                                field: "jadwal",
                                minWidth: 180,

                                formatter:
                                    function (cell) {

                                        const value =
                                            cell.getValue();

                                        if (!value) {
                                            return '-';
                                        }

                                        return `
                                            <span>
                                                <i class="fa-regular fa-calendar me-1 text-secondary"></i>
                                                ${escapeHtml(value)}
                                            </span>
                                        `;

                                    }

                            },


                            {
                                title: "Deskripsi",
                                field: "deskripsi",
                                minWidth: 250,

                                formatter:
                                    function (cell) {

                                        const value =
                                            cell.getValue();

                                        if (!value) {
                                            return '-';
                                        }

                                        const text =
                                            value.length > 100
                                                ? value.substring(0, 100) + '...'
                                                : value;

                                        return `
                                            <span
                                                title="${escapeHtml(value)}"
                                            >
                                                ${escapeHtml(text)}
                                            </span>
                                        `;

                                    }

                            },


                            {
                                title: "Status",
                                field: "is_active",
                                width: 120,
                                hozAlign: "center",
                                headerHozAlign: "center",

                                formatter:
                                    function (cell) {

                                        const active =
                                            Boolean(
                                                cell.getValue()
                                            );

                                        return active
                                            ? `
                                                <span
                                                    class="badge text-bg-success"
                                                >
                                                    <i
                                                        class="fa-solid fa-check me-1"
                                                    ></i>
                                                    Aktif
                                                </span>
                                              `
                                            : `
                                                <span
                                                    class="badge text-bg-secondary"
                                                >
                                                    <i
                                                        class="fa-solid fa-xmark me-1"
                                                    ></i>
                                                    Nonaktif
                                                </span>
                                              `;

                                    }

                            },


                            {
                                title: "Aksi",
                                width: 130,
                                hozAlign: "center",
                                headerHozAlign: "center",
                                headerSort: false,
                                frozen: true,

                                formatter:
                                    function () {

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
                                                           btn-outline-primary
                                                           btn-edit"
                                                    title="Edit"
                                                >

                                                    <i
                                                        class="fa-solid fa-pen"
                                                    ></i>

                                                </button>


                                                <button
                                                    type="button"
                                                    class="btn
                                                           btn-sm
                                                           btn-outline-danger
                                                           btn-delete"
                                                    title="Hapus"
                                                >

                                                    <i
                                                        class="fa-solid fa-trash"
                                                    ></i>

                                                </button>

                                            </div>
                                        `;

                                    },


                                cellClick:
                                    function (
                                        e,
                                        cell
                                    ) {

                                        const row =
                                            cell.getRow();

                                        const data =
                                            row.getData();


                                        if (
                                            e.target.closest(
                                                '.btn-edit'
                                            )
                                        ) {

                                            openEdit(data);

                                        }


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


            /*
            |--------------------------------------------------------------------------
            | Row Moved
            |--------------------------------------------------------------------------
            */

            table.on(
                "rowMoved",
                function () {

                    saveOrder();

                }
            );


            /*
            |--------------------------------------------------------------------------
            | SAVE ORDER
            |--------------------------------------------------------------------------
            */

            async function saveOrder() {

                const rows =
                    table.getRows();

                const orders =
                    rows.map(
                        function (row, index) {

                            return {
                                id: row.getData().id,
                                urutan: index + 1
                            };

                        }
                    );

                const savingOrder =
                    document.getElementById('saving-order');

                savingOrder.style.display = 'flex';


                try {

                    const response =
                        await fetch(
                            orderUrl,
                            {

                                method: "POST",

                                headers: {

                                    "Accept":
                                        "application/json",

                                    "Content-Type":
                                        "application/json",

                                    "X-CSRF-TOKEN":
                                    csrfToken

                                },

                                body:
                                    JSON.stringify({
                                        orders: orders
                                    })

                            }
                        );


                    const result =
                        await response.json();


                    if (!response.ok) {

                        throw new Error(
                            result.message ??
                            "Gagal menyimpan urutan."
                        );

                    }


                    rows.forEach(
                        function (row, index) {
                            row.update({
                                urutan: index + 1
                            });
                        }
                    );

                } catch (error) {

                    console.error(error);

                    if (
                        typeof Swal !== 'undefined'
                    ) {

                        Swal.fire({

                            icon: "error",

                            title: "Gagal",

                            text:
                                error.message ??
                                "Gagal menyimpan urutan."

                        });

                    }

                    table.setData();

                } finally {

                    savingOrder.style.display = 'none';

                }

            }


            /*
            |--------------------------------------------------------------------------
            | TAMBAH DATA
            |--------------------------------------------------------------------------
            */

            formTambah.addEventListener(
                "submit",
                async function (e) {

                    e.preventDefault();


                    const button =
                        document.getElementById(
                            'btnSimpan'
                        );


                    button.disabled = true;

                    button.innerHTML = `
                        <span
                            class="spinner-border
                                   spinner-border-sm
                                   me-1"
                        ></span>

                        Menyimpan...
                    `;


                    try {

                        const formData =
                            new FormData(formTambah);


                        const response =
                            await fetch(
                                formTambah.action,
                                {

                                    method: "POST",

                                    headers: {

                                        "Accept":
                                            "application/json",

                                        "X-CSRF-TOKEN":
                                        csrfToken

                                    },

                                    body: formData

                                }
                            );


                        const result =
                            await response.json();


                        if (!response.ok) {

                            throwValidationError(
                                result
                            );

                        }


                        if (!result.success) {

                            throw new Error(
                                result.message ??
                                "Gagal menambahkan data."
                            );

                        }


                        modalTambah.hide();

                        formTambah.reset();

                        document
                            .getElementById(
                                'tambah_is_active'
                            )
                            .checked = true;

                        document
                            .getElementById(
                                'previewTambahContainer'
                            )
                            .classList.add('d-none');

                        document
                            .getElementById(
                                'tambahNoFoto'
                            )
                            .classList.remove('d-none');


                        table.setData(dataUrl);


                        showSuccess(
                            result.message
                        );


                    } catch (error) {

                        console.error(error);

                        showError(
                            error.message
                        );

                    } finally {

                        button.disabled = false;

                        button.innerHTML = `
                            <i
                                class="fa-solid fa-save me-1"
                            ></i>

                            Simpan
                        `;

                    }

                }
            );


            /*
            |--------------------------------------------------------------------------
            | OPEN EDIT
            |--------------------------------------------------------------------------
            */

            function openEdit(data) {

                formEdit.action =
                    "{{ route('admin.akademik.ekstrakurikuler.update', ':id') }}"
                        .replace(
                            ':id',
                            data.id
                        );


                document
                    .getElementById('edit_nama')
                    .value =
                    data.nama ?? '';


                document
                    .getElementById('edit_pembina')
                    .value =
                    data.pembina ?? '';


                document
                    .getElementById('edit_jadwal')
                    .value =
                    data.jadwal ?? '';


                document
                    .getElementById('edit_deskripsi')
                    .value =
                    data.deskripsi ?? '';


                document
                    .getElementById('edit_is_active')
                    .checked =
                    Boolean(data.is_active);


                const preview =
                    document.getElementById(
                        'previewEdit'
                    );

                const noFoto =
                    document.getElementById(
                        'editNoFoto'
                    );


                if (data.foto) {

                    preview.src =
                        "{{ asset('images/ekstrakurikuler') }}/"
                        + encodeURIComponent(data.foto);

                    preview.classList.remove(
                        'd-none'
                    );

                    noFoto.classList.add(
                        'd-none'
                    );

                } else {

                    preview.src = '';

                    preview.classList.add(
                        'd-none'
                    );

                    noFoto.classList.remove(
                        'd-none'
                    );

                }


                document
                    .getElementById('edit-foto')
                    .value = '';


                modalEdit.show();

            }


            /*
            |--------------------------------------------------------------------------
            | UPDATE DATA
            |--------------------------------------------------------------------------
            */

            formEdit.addEventListener(
                "submit",
                async function (e) {

                    e.preventDefault();


                    const button =
                        document.getElementById(
                            'btnUpdate'
                        );


                    button.disabled = true;

                    button.innerHTML = `
                        <span
                            class="spinner-border
                                   spinner-border-sm
                                   me-1"
                        ></span>

                        Menyimpan...
                    `;


                    try {

                        const formData =
                            new FormData(formEdit);


                        const response =
                            await fetch(
                                formEdit.action,
                                {

                                    method: "POST",

                                    headers: {

                                        "Accept":
                                            "application/json",

                                        "X-CSRF-TOKEN":
                                        csrfToken

                                    },

                                    body: formData

                                }
                            );


                        const result =
                            await response.json();


                        if (!response.ok) {

                            throwValidationError(
                                result
                            );

                        }


                        if (!result.success) {

                            throw new Error(
                                result.message ??
                                "Gagal memperbarui data."
                            );

                        }


                        modalEdit.hide();


                        table.setData(
                            dataUrl
                        );


                        showSuccess(
                            result.message
                        );


                    } catch (error) {

                        console.error(error);

                        showError(
                            error.message
                        );

                    } finally {

                        button.disabled = false;

                        button.innerHTML = `
                            <i
                                class="fa-solid fa-save me-1"
                            ></i>

                            Simpan Perubahan
                        `;

                    }

                }
            );


            /*
            |--------------------------------------------------------------------------
            | DELETE
            |--------------------------------------------------------------------------
            */

            async function deleteData(data) {

                let confirmed = false;


                if (
                    typeof Swal !== 'undefined'
                ) {

                    const result =
                        await Swal.fire({

                            icon: "warning",

                            title: "Hapus Ekstrakurikuler?",

                            html:
                                `Data <strong>${escapeHtml(
                                    data.nama
                                )}</strong> akan dihapus secara permanen.`,

                            showCancelButton: true,

                            confirmButtonText:
                                "Ya, Hapus",

                            cancelButtonText:
                                "Batal",

                            confirmButtonColor:
                                '#dc3545',

                            reverseButtons: true

                        });


                    confirmed =
                        result.isConfirmed;

                } else {

                    confirmed =
                        confirm(
                            `Hapus ${data.nama}?`
                        );

                }


                if (!confirmed) {
                    return;
                }


                const url =
                    "{{ route('admin.akademik.ekstrakurikuler.destroy', ':id') }}"
                        .replace(
                            ':id',
                            data.id
                        );


                try {

                    const response =
                        await fetch(
                            url,
                            {

                                method: "DELETE",

                                headers: {

                                    "Accept":
                                        "application/json",

                                    "X-CSRF-TOKEN":
                                    csrfToken

                                }

                            }
                        );


                    const result =
                        await response.json();


                    if (!response.ok) {

                        throw new Error(
                            result.message ??
                            "Gagal menghapus data."
                        );

                    }


                    table.setData(
                        dataUrl
                    );


                    showSuccess(
                        result.message
                    );


                } catch (error) {

                    console.error(error);

                    showError(
                        error.message
                    );

                }

            }


            /*
            |--------------------------------------------------------------------------
            | PREVIEW FOTO TAMBAH
            |--------------------------------------------------------------------------
            */

            document
                .getElementById('tambah-foto')
                .addEventListener(
                    'change',
                    function (e) {

                        const file =
                            e.target.files[0];

                        const preview =
                            document.getElementById(
                                'previewTambah'
                            );

                        const container =
                            document.getElementById(
                                'previewTambahContainer'
                            );

                        const noFoto =
                            document.getElementById(
                                'tambahNoFoto'
                            );


                        if (!file) {

                            preview.src = '';

                            container.classList.add(
                                'd-none'
                            );

                            noFoto.classList.remove(
                                'd-none'
                            );

                            return;

                        }


                        const reader =
                            new FileReader();


                        reader.onload =
                            function (event) {

                                preview.src =
                                    event.target.result;

                                container.classList.remove(
                                    'd-none'
                                );

                                noFoto.classList.add(
                                    'd-none'
                                );

                            };


                        reader.readAsDataURL(
                            file
                        );

                    }
                );


            /*
            |--------------------------------------------------------------------------
            | PREVIEW FOTO EDIT
            |--------------------------------------------------------------------------
            */

            document
                .getElementById('edit-foto')
                .addEventListener(
                    'change',
                    function (e) {

                        const file =
                            e.target.files[0];

                        if (!file) {
                            return;
                        }


                        const reader =
                            new FileReader();


                        reader.onload =
                            function (event) {

                                const preview =
                                    document.getElementById(
                                        'previewEdit'
                                    );

                                const noFoto =
                                    document.getElementById(
                                        'editNoFoto'
                                    );


                                preview.src =
                                    event.target.result;

                                preview.classList.remove(
                                    'd-none'
                                );

                                noFoto.classList.add(
                                    'd-none'
                                );

                            };


                        reader.readAsDataURL(
                            file
                        );

                    }
                );


            /*
            |--------------------------------------------------------------------------
            | RESET MODAL TAMBAH
            |--------------------------------------------------------------------------
            */

            modalTambahElement.addEventListener(
                'hidden.bs.modal',
                function () {

                    formTambah.reset();


                    document
                        .getElementById(
                            'tambah_is_active'
                        )
                        .checked = true;


                    document
                        .getElementById(
                            'previewTambahContainer'
                        )
                        .classList.add(
                        'd-none'
                    );

                    document
                        .getElementById(
                            'tambahNoFoto'
                        )
                        .classList.remove(
                        'd-none'
                    );


                    document
                        .getElementById(
                            'previewTambah'
                        )
                        .src = '';

                }
            );


            /*
            |--------------------------------------------------------------------------
            | HELPER SUCCESS
            |--------------------------------------------------------------------------
            */

            function showSuccess(message) {

                if (
                    typeof Swal !== 'undefined'
                ) {

                    Swal.fire({

                        icon: "success",

                        title: "Berhasil",

                        text: message,

                        timer: 1500,

                        showConfirmButton: false

                    });

                } else {

                    alert(message);

                }

            }


            /*
            |--------------------------------------------------------------------------
            | HELPER ERROR
            |--------------------------------------------------------------------------
            */

            function showError(message) {

                if (
                    typeof Swal !== 'undefined'
                ) {

                    Swal.fire({

                        icon: "error",

                        title: "Gagal",

                        text:
                            message ??
                            "Terjadi kesalahan."

                    });

                } else {

                    alert(
                        message ??
                        "Terjadi kesalahan."
                    );

                }

            }


            /*
            |--------------------------------------------------------------------------
            | VALIDATION ERROR
            |--------------------------------------------------------------------------
            */

            function throwValidationError(result) {

                if (
                    result.errors
                ) {

                    const messages =
                        Object.values(
                            result.errors
                        )
                            .flat();


                    throw new Error(
                        messages.join('\n')
                    );

                }


                throw new Error(
                    result.message ??
                    "Data tidak valid."
                );

            }


            /*
            |--------------------------------------------------------------------------
            | ESCAPE HTML
            |--------------------------------------------------------------------------
            */

            function escapeHtml(value) {

                if (
                    value === null ||
                    value === undefined
                ) {

                    return '';

                }


                return String(value)
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;')
                    .replace(/"/g, '&quot;')
                    .replace(/'/g, '&#039;');

            }

        });

    </script>

@endsection
