@extends('admin.template.admin')

@section('title', 'Running Text')

@section('content-admin')

    <link
        href="https://unpkg.com/tabulator-tables@6.3.1/dist/css/tabulator_bootstrap5.min.css"
        rel="stylesheet"
    >

    <style>

        #table-running-text {
            font-size: 14px;
        }

        .tabulator {
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            overflow: hidden;
        }

        .tabulator .tabulator-header {
            font-weight: 600;
        }

        .tabulator-row {
            min-height: 58px;
        }

        .btn-action {
            width: 34px;
            height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }

        .running-text-preview {
            max-width: 600px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .running-text-color {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            border: 1px solid #dee2e6;
            display: inline-block;
        }

        .running-preview-box {
            border-radius: 8px;
            min-height: 50px;
            display: flex;
            align-items: center;
            overflow: hidden;
        }

        .running-preview-text {
            white-space: nowrap;
            width: 100%;
        }

        .color-input {
            width: 48px !important;
            height: 38px;
            padding: 3px !important;
        }

    </style>


    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="container-fluid">

        <div class="app-content-header">

            <div class="container-fluid mt-3">

                <div class="row">

                    <div class="col-sm-6">

                        <h1 class="mb-0 fs-3">
                            Running Text
                        </h1>

                    </div>


                    <div class="col-sm-6">

                        <ol class="breadcrumb float-sm-end">

                            <li class="breadcrumb-item">
                                Beranda
                            </li>

                            <li class="breadcrumb-item active">
                                Running Text
                            </li>

                        </ol>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
             CONTENT
        ====================================================== --}}

        <div class="container-fluid">

            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white py-3">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <h5 class="mb-1 fw-semibold">
                                Data Running Text
                            </h5>

                            <small class="text-muted">
                                Kelola running text yang ditampilkan pada website
                            </small>

                        </div>


                        <button
                            type="button"
                            class="btn btn-primary"
                            id="btnTambah"
                        >

                            <i class="fa-solid fa-plus me-1"></i>

                            Tambah Running Text

                        </button>

                    </div>

                </div>


                <div class="card-body">

                    <div
                        id="table-running-text"
                    ></div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         MODAL TAMBAH
    ========================================================= --}}

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

                        <i class="fa-solid fa-plus me-2"></i>

                        Tambah Running Text

                    </h5>


                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                    ></button>

                </div>


                <form
                    id="formTambah"
                >

                    @csrf

                    <div class="modal-body">

                        <div class="row g-3">

                            {{-- ==================================================
                                 TEKS
                            =================================================== --}}

                            <div class="col-12">

                                <label class="form-label">

                                    Running Text

                                    <span class="text-danger">
                                    *
                                </span>

                                </label>


                                <textarea
                                    name="teks"
                                    id="tambah-teks"
                                    class="form-control"
                                    rows="4"
                                    placeholder="Contoh: Pendaftaran Peserta Didik Baru telah dibuka..."
                                    required
                                ></textarea>

                            </div>


                            {{-- ==================================================
                                 URUTAN
                            =================================================== --}}

                            <div class="col-md-4">

                                <label class="form-label">
                                    Urutan
                                </label>


                                <input
                                    type="number"
                                    name="urutan"
                                    id="tambah-urutan"
                                    class="form-control"
                                    value="0"
                                    min="0"
                                >

                            </div>


                            {{-- ==================================================
                                 KECEPATAN
                            =================================================== --}}

                            <div class="col-md-4">

                                <label class="form-label">

                                    Kecepatan

                                    <span class="text-danger">
                                    *
                                </span>

                                </label>


                                <input
                                    type="number"
                                    name="kecepatan"
                                    id="tambah-kecepatan"
                                    class="form-control"
                                    value="50"
                                    min="5"
                                    max="120"
                                    required
                                >


                                <small class="text-muted">
                                    Nilai 5 - 120.
                                </small>

                            </div>


                            {{-- ==================================================
                                 STATUS
                            =================================================== --}}

                            <div class="col-md-4">

                                <label class="form-label">
                                    Status
                                </label>


                                <div class="form-check form-switch mt-2">

                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        name="is_active"
                                        value="1"
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


                            {{-- ==================================================
                                 WARNA BACKGROUND
                            =================================================== --}}

                            <div class="col-md-6">

                                <label class="form-label">

                                    Warna Background

                                </label>


                                <div class="input-group">

                                    <input
                                        type="color"
                                        name="warna_background"
                                        id="tambah-warna-background"
                                        class="form-control form-control-color color-input"
                                        value="#0083b4"
                                    >


                                    <input
                                        type="text"
                                        id="tambah-warna-background-text"
                                        class="form-control"
                                        value="#0083b4"
                                        maxlength="20"
                                    >

                                </div>

                            </div>


                            {{-- ==================================================
                                 WARNA TEXT
                            =================================================== --}}

                            <div class="col-md-6">

                                <label class="form-label">

                                    Warna Text

                                </label>


                                <div class="input-group">

                                    <input
                                        type="color"
                                        name="warna_text"
                                        id="tambah-warna-text"
                                        class="form-control form-control-color color-input"
                                        value="#ffffff"
                                    >


                                    <input
                                        type="text"
                                        id="tambah-warna-text-text"
                                        class="form-control"
                                        value="#ffffff"
                                        maxlength="20"
                                    >

                                </div>

                            </div>


                            {{-- ==================================================
                                 PREVIEW
                            =================================================== --}}

                            <div class="col-12">

                                <label class="form-label">
                                    Preview
                                </label>


                                <div
                                    id="preview-tambah"
                                    class="running-preview-box px-3"
                                    style="
                                    background-color: #0083b4;
                                    color: #ffffff;
                                "
                                >

                                    <div
                                        id="preview-tambah-text"
                                        class="running-preview-text"
                                    >
                                        Preview running text...
                                    </div>

                                </div>

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


    {{-- =========================================================
         MODAL EDIT
    ========================================================= --}}

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

                        <i class="fa-solid fa-pen-to-square me-2"></i>

                        Edit Running Text

                    </h5>


                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                    ></button>

                </div>


                <form
                    id="formEdit"
                >

                    @csrf

                    @method('PUT')


                    <div class="modal-body">

                        <div class="row g-3">

                            {{-- ==================================================
                                 TEKS
                            =================================================== --}}

                            <div class="col-12">

                                <label class="form-label">

                                    Running Text

                                    <span class="text-danger">
                                    *
                                </span>

                                </label>


                                <textarea
                                    name="teks"
                                    id="edit-teks"
                                    class="form-control"
                                    rows="4"
                                    required
                                ></textarea>

                            </div>


                            {{-- ==================================================
                                 URUTAN
                            =================================================== --}}

                            <div class="col-md-4">

                                <label class="form-label">
                                    Urutan
                                </label>


                                <input
                                    type="number"
                                    name="urutan"
                                    id="edit-urutan"
                                    class="form-control"
                                    min="0"
                                >

                            </div>


                            {{-- ==================================================
                                 KECEPATAN
                            =================================================== --}}

                            <div class="col-md-4">

                                <label class="form-label">

                                    Kecepatan

                                    <span class="text-danger">
                                    *
                                </span>

                                </label>


                                <input
                                    type="number"
                                    name="kecepatan"
                                    id="edit-kecepatan"
                                    class="form-control"
                                    min="5"
                                    max="120"
                                    required
                                >

                            </div>


                            {{-- ==================================================
                                 STATUS
                            =================================================== --}}

                            <div class="col-md-4">

                                <label class="form-label">
                                    Status
                                </label>


                                <div class="form-check form-switch mt-2">

                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        name="is_active"
                                        value="1"
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


                            {{-- ==================================================
                                 WARNA BACKGROUND
                            =================================================== --}}

                            <div class="col-md-6">

                                <label class="form-label">

                                    Warna Background

                                </label>


                                <div class="input-group">

                                    <input
                                        type="color"
                                        name="warna_background"
                                        id="edit-warna-background"
                                        class="form-control form-control-color color-input"
                                        value="#0083b4"
                                    >


                                    <input
                                        type="text"
                                        id="edit-warna-background-text"
                                        class="form-control"
                                        value="#0083b4"
                                        maxlength="20"
                                    >

                                </div>

                            </div>


                            {{-- ==================================================
                                 WARNA TEXT
                            =================================================== --}}

                            <div class="col-md-6">

                                <label class="form-label">

                                    Warna Text

                                </label>


                                <div class="input-group">

                                    <input
                                        type="color"
                                        name="warna_text"
                                        id="edit-warna-text"
                                        class="form-control form-control-color color-input"
                                        value="#ffffff"
                                    >


                                    <input
                                        type="text"
                                        id="edit-warna-text-text"
                                        class="form-control"
                                        value="#ffffff"
                                        maxlength="20"
                                    >

                                </div>

                            </div>


                            {{-- ==================================================
                                 PREVIEW
                            =================================================== --}}

                            <div class="col-12">

                                <label class="form-label">
                                    Preview
                                </label>


                                <div
                                    id="preview-edit"
                                    class="running-preview-box px-3"
                                    style="
                                    background-color: #0083b4;
                                    color: #ffffff;
                                "
                                >

                                    <div
                                        id="preview-edit-text"
                                        class="running-preview-text"
                                    >
                                        Preview running text...
                                    </div>

                                </div>

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
                            id="btnUpdate"
                        >

                            <i class="fa-solid fa-save me-1"></i>

                            Update

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    {{-- =========================================================
         JAVASCRIPT
    ========================================================= --}}

    <script src="https://unpkg.com/tabulator-tables@6.3.1/dist/js/tabulator.min.js"></script>


    <script>

        document.addEventListener(
            'DOMContentLoaded',
            function () {

                /* =====================================================
                   CONFIG
                ===================================================== */

                const csrfToken =
                    document
                        .querySelector(
                            'meta[name="csrf-token"]'
                        )
                        ?.getAttribute('content')
                    || '{{ csrf_token() }}';


                const dataUrl =
                    "{{ route('admin.berandas.running-text.data') }}";


                const storeUrl =
                    "{{ route('admin.berandas.running-text.store') }}";


                const orderUrl =
                    "{{ route('admin.berandas.running-text.order') }}";


                const editUrlTemplate = @json(
                route(
                    'admin.berandas.running-text.edit',
                    ['runningText' => '__ID__']
                )
            );


                const updateUrlTemplate = @json(
                route(
                    'admin.berandas.running-text.update',
                    ['runningText' => '__ID__']
                )
            );


                const deleteUrlTemplate = @json(
                route(
                    'admin.berandas.running-text.destroy',
                    ['runningText' => '__ID__']
                )
            );


                const toggleUrlTemplate = @json(
                route(
                    'admin.berandas.running-text.toggle-status',
                    ['runningText' => '__ID__']
                )
            );


                /* =====================================================
                   ELEMENT
                ===================================================== */

                const tableElement =
                    document.getElementById(
                        'table-running-text'
                    );


                const modalTambahElement =
                    document.getElementById(
                        'modalTambah'
                    );


                const modalEditElement =
                    document.getElementById(
                        'modalEdit'
                    );


                const modalTambah =
                    new bootstrap.Modal(
                        modalTambahElement
                    );


                const modalEdit =
                    new bootstrap.Modal(
                        modalEditElement
                    );


                const formTambah =
                    document.getElementById(
                        'formTambah'
                    );


                const formEdit =
                    document.getElementById(
                        'formEdit'
                    );


                /* =====================================================
                   HELPER
                ===================================================== */

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


                function showError(error) {

                    let message =
                        'Terjadi kesalahan.';


                    if (
                        error.responseJSON &&
                        error.responseJSON.message
                    ) {

                        message =
                            error.responseJSON.message;

                    }


                    if (
                        error.responseJSON &&
                        error.responseJSON.errors
                    ) {

                        const errors =
                            error.responseJSON.errors;

                        const messages = [];


                        Object.keys(errors).forEach(
                            function (key) {

                                errors[key].forEach(
                                    function (msg) {

                                        messages.push(
                                            msg
                                        );

                                    }
                                );

                            }
                        );


                        if (messages.length) {

                            message =
                                messages.join('<br>');

                        }

                    }


                    if (typeof Swal !== 'undefined') {

                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            html: message
                        });

                    } else {

                        alert(
                            message.replace(
                                /<br>/g,
                                '\n'
                            )
                        );

                    }

                }


                function loadingButton(
                    button,
                    loading
                ) {

                    if (!button) {
                        return;
                    }


                    if (loading) {

                        button.dataset
                            .originalHtml =
                            button.innerHTML;

                        button.disabled = true;

                        button.innerHTML = `
                        <span
                            class="spinner-border spinner-border-sm me-1"
                        ></span>
                        Memproses...
                    `;

                    } else {

                        button.disabled = false;

                        if (
                            button.dataset
                                .originalHtml
                        ) {

                            button.innerHTML =
                                button.dataset
                                    .originalHtml;

                        }

                    }

                }


                function showSuccess(message) {

                    if (
                        typeof Swal !== 'undefined'
                    ) {

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: message,
                            timer: 1600,
                            showConfirmButton: false
                        });

                    }

                }


                /* =====================================================
                   COLOR SYNC
                ===================================================== */

                function setupColorSync(
                    colorId,
                    textId,
                    callback
                ) {

                    const color =
                        document.getElementById(
                            colorId
                        );


                    const text =
                        document.getElementById(
                            textId
                        );


                    color.addEventListener(
                        'input',
                        function () {

                            text.value =
                                this.value;

                            if (callback) {
                                callback();
                            }

                        }
                    );


                    text.addEventListener(
                        'input',
                        function () {

                            if (
                                /^#[0-9A-F]{6}$/i
                                    .test(
                                        this.value
                                    )
                            ) {

                                color.value =
                                    this.value;

                                if (callback) {
                                    callback();
                                }

                            }

                        }
                    );

                }


                /* =====================================================
                   PREVIEW TAMBAH
                ===================================================== */

                function updatePreviewTambah() {

                    const teks =
                        document.getElementById(
                            'tambah-teks'
                        ).value
                        || 'Preview running text...';


                    const background =
                        document.getElementById(
                            'tambah-warna-background'
                        ).value
                        || '#0083b4';


                    const textColor =
                        document.getElementById(
                            'tambah-warna-text'
                        ).value
                        || '#ffffff';


                    const preview =
                        document.getElementById(
                            'preview-tambah'
                        );


                    const previewText =
                        document.getElementById(
                            'preview-tambah-text'
                        );


                    preview.style.backgroundColor =
                        background;


                    preview.style.color =
                        textColor;


                    previewText.textContent =
                        teks;

                }


                /* =====================================================
                   PREVIEW EDIT
                ===================================================== */

                function updatePreviewEdit() {

                    const teks =
                        document.getElementById(
                            'edit-teks'
                        ).value
                        || 'Preview running text...';


                    const background =
                        document.getElementById(
                            'edit-warna-background'
                        ).value
                        || '#0083b4';


                    const textColor =
                        document.getElementById(
                            'edit-warna-text'
                        ).value
                        || '#ffffff';


                    const preview =
                        document.getElementById(
                            'preview-edit'
                        );


                    const previewText =
                        document.getElementById(
                            'preview-edit-text'
                        );


                    preview.style.backgroundColor =
                        background;


                    preview.style.color =
                        textColor;


                    previewText.textContent =
                        teks;

                }


                setupColorSync(
                    'tambah-warna-background',
                    'tambah-warna-background-text',
                    updatePreviewTambah
                );


                setupColorSync(
                    'tambah-warna-text',
                    'tambah-warna-text-text',
                    updatePreviewTambah
                );


                setupColorSync(
                    'edit-warna-background',
                    'edit-warna-background-text',
                    updatePreviewEdit
                );


                setupColorSync(
                    'edit-warna-text',
                    'edit-warna-text-text',
                    updatePreviewEdit
                );


                document
                    .getElementById(
                        'tambah-teks'
                    )
                    .addEventListener(
                        'input',
                        updatePreviewTambah
                    );


                document
                    .getElementById(
                        'edit-teks'
                    )
                    .addEventListener(
                        'input',
                        updatePreviewEdit
                    );


                /* =====================================================
                   TABULATOR
                ===================================================== */

                const table =
                    new Tabulator(
                        tableElement,
                        {

                            ajaxURL: dataUrl,

                            ajaxConfig: 'GET',

                            layout: 'fitColumns',

                            movableRows: true,

                            index: 'id',

                            placeholder:
                                'Belum ada data running text.',

                            pagination: true,

                            paginationMode: 'local',

                            paginationSize: 10,

                            paginationSizeSelector: [
                                10,
                                25,
                                50,
                                100
                            ],


                            initialSort: [
                                {
                                    column: 'urutan',
                                    dir: 'asc'
                                }
                            ],


                            ajaxResponse:
                                function (
                                    url,
                                    params,
                                    response
                                ) {

                                    return response.data
                                        || [];

                                },


                            columns: [

                                /* ======================================
                                   URUTAN
                                ====================================== */

                                {
                                    title: 'Urutan',

                                    field: 'urutan',

                                    width: 80,

                                    hozAlign: 'center',

                                    formatter:
                                        function (cell) {

                                            return `
                                            ${cell.getValue() ?? 0}
                                        `;

                                        }

                                },


                                /* ======================================
                                   RUNNING TEXT
                                ====================================== */

                                {
                                    title: 'Running Text',

                                    field: 'teks',

                                    minWidth: 350,

                                    formatter:
                                        function (cell) {

                                            const value =
                                                cell.getValue()
                                                || '';


                                            return `
                                            <div
                                                class="running-text-preview"
                                                title="${escapeHtml(value)}"
                                            >
                                                <div class="fw-semibold">
                                                    ${escapeHtml(value)}
                                                </div>
                                            </div>
                                        `;

                                        }

                                },


                                /* ======================================
                                   KECEPATAN
                                ====================================== */

                                {
                                    title: 'Kecepatan',

                                    field: 'kecepatan',

                                    width: 110,

                                    hozAlign: 'center',

                                    formatter:
                                        function (cell) {

                                            return `
                                            <span
                                                class="badge bg-light text-dark"
                                            >
                                                ${cell.getValue()}
                                            </span>
                                        `;

                                        }

                                },


                                /* ======================================
                                   WARNA
                                ====================================== */

                                {
                                    title: 'Warna',

                                    width: 100,

                                    hozAlign: 'center',

                                    headerHozAlign: 'center',

                                    headerSort: false,

                                    formatter:
                                        function (cell) {

                                            const data =
                                                cell
                                                    .getRow()
                                                    .getData();


                                            const background =
                                                data.warna_background
                                                || '#0083b4';


                                            return `
                                            <span
                                                class="running-text-color"
                                                style="
                                                    background-color:
                                                        ${escapeHtml(
                                                background
                                            )};
                                                "
                                                title="${escapeHtml(
                                                background
                                            )}"
                                            ></span>
                                        `;

                                        }

                                },


                                /* ======================================
                                   STATUS
                                ====================================== */

                                {
                                    title: 'Status',

                                    field: 'is_active',

                                    width: 100,

                                    hozAlign: 'center',

                                    formatter:
                                        function (cell) {

                                            const active =
                                                Boolean(
                                                    cell.getValue()
                                                );


                                            return active
                                                ? `
                                                <span
                                                    class="badge bg-success-subtle text-success"
                                                >
                                                    Aktif
                                                </span>
                                            `
                                                : `
                                                <span
                                                    class="badge bg-secondary-subtle text-secondary"
                                                >
                                                    Nonaktif
                                                </span>
                                            `;

                                        }

                                },


                                /* ======================================
                                   AKSI
                                ====================================== */

                                {
                                    title: 'Aksi',

                                    width: 145,

                                    hozAlign: 'center',

                                    headerHozAlign: 'center',

                                    headerSort: false,

                                    formatter:
                                        function (cell) {

                                            const data =
                                                cell
                                                    .getRow()
                                                    .getData();


                                            return `
                                            <div
                                                class="d-flex gap-1 justify-content-center"
                                            >

                                                <button
                                                    type="button"
                                                    class="btn btn-sm btn-outline-primary btn-action btn-edit"
                                                    data-id="${data.id}"
                                                    title="Edit"
                                                >

                                                    <i
                                                        class="fa-solid fa-pen"
                                                    ></i>

                                                </button>


                                                <button
                                                    type="button"
                                                    class="btn btn-sm btn-outline-${data.is_active ? 'warning' : 'success'} btn-action btn-toggle"
                                                    data-id="${data.id}"
                                                    title="${
                                                data.is_active
                                                    ? 'Nonaktifkan'
                                                    : 'Aktifkan'
                                            }"
                                                >

                                                    <i
                                                        class="fa-solid ${
                                                data.is_active
                                                    ? 'fa-eye-slash'
                                                    : 'fa-eye'
                                            }"
                                                    ></i>

                                                </button>


                                                <button
                                                    type="button"
                                                    class="btn btn-sm btn-outline-danger btn-action btn-delete"
                                                    data-id="${data.id}"
                                                    title="Hapus"
                                                >

                                                    <i
                                                        class="fa-solid fa-trash"
                                                    ></i>

                                                </button>

                                            </div>
                                        `;

                                        }

                                }

                            ]

                        }
                    );


                /* =====================================================
                   TAMBAH
                ===================================================== */

                document
                    .getElementById(
                        'btnTambah'
                    )
                    .addEventListener(
                        'click',
                        function () {

                            formTambah.reset();


                            document.getElementById(
                                'tambah-is-active'
                            ).checked = true;


                            document.getElementById(
                                'tambah-urutan'
                            ).value = 0;


                            document.getElementById(
                                'tambah-kecepatan'
                            ).value = 50;


                            document.getElementById(
                                'tambah-warna-background'
                            ).value = '#0083b4';


                            document.getElementById(
                                'tambah-warna-background-text'
                            ).value = '#0083b4';


                            document.getElementById(
                                'tambah-warna-text'
                            ).value = '#ffffff';


                            document.getElementById(
                                'tambah-warna-text-text'
                            ).value = '#ffffff';


                            updatePreviewTambah();


                            modalTambah.show();

                        }
                    );


                /* =====================================================
                   SUBMIT TAMBAH
                ===================================================== */

                formTambah.addEventListener(
                    'submit',
                    async function (e) {

                        e.preventDefault();


                        const button =
                            document.getElementById(
                                'btnSimpan'
                            );


                        const formData =
                            new FormData(
                                formTambah
                            );


                        loadingButton(
                            button,
                            true
                        );


                        try {

                            const response =
                                await fetch(
                                    storeUrl,
                                    {

                                        method: 'POST',

                                        headers: {

                                            'X-CSRF-TOKEN':
                                            csrfToken,

                                            'Accept':
                                                'application/json'

                                        },

                                        body:
                                        formData

                                    }
                                );


                            const result =
                                await response.json();


                            if (!response.ok) {

                                throw {
                                    responseJSON:
                                    result
                                };

                            }


                            modalTambah.hide();


                            await table.replaceData();


                            showSuccess(
                                result.message
                                ||
                                result.msg
                                ||
                                'Running text berhasil ditambahkan.'
                            );


                        } catch (error) {

                            showError(error);

                        } finally {

                            loadingButton(
                                button,
                                false
                            );

                        }

                    }
                );


                /* =====================================================
                   EDIT
                ===================================================== */

                async function openEditModal(id) {

                    try {

                        const url =
                            editUrlTemplate.replace(
                                '__ID__',
                                id
                            );


                        const response =
                            await fetch(
                                url,
                                {
                                    headers: {
                                        'Accept':
                                            'application/json'
                                    }
                                }
                            );


                        const result =
                            await response.json();


                        if (!response.ok) {

                            throw {
                                responseJSON:
                                result
                            };

                        }


                        /*
                         * Controller edit harus mengembalikan:
                         *
                         * {
                         *     data: {...}
                         * }
                         */

                        const data =
                            result.data
                            || result;


                        document.getElementById(
                            'edit-teks'
                        ).value =
                            data.teks
                            || '';


                        document.getElementById(
                            'edit-urutan'
                        ).value =
                            data.urutan
                            ?? 0;


                        document.getElementById(
                            'edit-kecepatan'
                        ).value =
                            data.kecepatan
                            ?? 50;


                        document.getElementById(
                            'edit-is-active'
                        ).checked =
                            Boolean(
                                data.is_active
                            );


                        const background =
                            data.warna_background
                            || '#0083b4';


                        const textColor =
                            data.warna_text
                            || '#ffffff';


                        document.getElementById(
                            'edit-warna-background'
                        ).value =
                            background;


                        document.getElementById(
                            'edit-warna-background-text'
                        ).value =
                            background;


                        document.getElementById(
                            'edit-warna-text'
                        ).value =
                            textColor;


                        document.getElementById(
                            'edit-warna-text-text'
                        ).value =
                            textColor;


                        formEdit.dataset.id =
                            data.id;


                        updatePreviewEdit();


                        modalEdit.show();


                    } catch (error) {

                        showError(error);

                    }

                }


                /* =====================================================
                   CLICK EVENT TABULATOR
                ===================================================== */

                tableElement.addEventListener(
                    'click',
                    function (e) {

                        const editButton =
                            e.target.closest(
                                '.btn-edit'
                            );


                        if (editButton) {

                            const id =
                                editButton.dataset.id;


                            if (id) {

                                openEditModal(
                                    id
                                );

                            }

                            return;

                        }


                        const deleteButton =
                            e.target.closest(
                                '.btn-delete'
                            );


                        if (deleteButton) {

                            const id =
                                deleteButton.dataset.id;


                            if (id) {

                                deleteData(
                                    id
                                );

                            }

                            return;

                        }


                        const toggleButton =
                            e.target.closest(
                                '.btn-toggle'
                            );


                        if (toggleButton) {

                            const id =
                                toggleButton.dataset.id;


                            if (id) {

                                toggleStatus(
                                    id
                                );

                            }

                            return;

                        }

                    }
                );


                /* =====================================================
                   UPDATE
                ===================================================== */

                formEdit.addEventListener(
                    'submit',
                    async function (e) {

                        e.preventDefault();


                        const id =
                            this.dataset.id;


                        if (!id) {
                            return;
                        }


                        const button =
                            document.getElementById(
                                'btnUpdate'
                            );


                        const updateUrl =
                            updateUrlTemplate.replace(
                                '__ID__',
                                id
                            );


                        const formData =
                            new FormData(
                                formEdit
                            );


                        formData.set(
                            '_method',
                            'PUT'
                        );


                        loadingButton(
                            button,
                            true
                        );


                        try {

                            const response =
                                await fetch(
                                    updateUrl,
                                    {

                                        method: 'POST',

                                        headers: {

                                            'X-CSRF-TOKEN':
                                            csrfToken,

                                            'Accept':
                                                'application/json'

                                        },

                                        body:
                                        formData

                                    }
                                );


                            const result =
                                await response.json();


                            if (!response.ok) {

                                throw {
                                    responseJSON:
                                    result
                                };

                            }


                            modalEdit.hide();


                            await table.replaceData();


                            showSuccess(
                                result.message
                                ||
                                result.msg
                                ||
                                'Running text berhasil diperbarui.'
                            );


                        } catch (error) {

                            showError(error);

                        } finally {

                            loadingButton(
                                button,
                                false
                            );

                        }

                    }
                );


                /* =====================================================
                   DELETE
                ===================================================== */

                async function deleteData(id) {

                    let confirmed = true;


                    if (
                        typeof Swal !== 'undefined'
                    ) {

                        const result =
                            await Swal.fire({

                                icon: 'warning',

                                title:
                                    'Hapus Running Text?',

                                text:
                                    'Data running text yang dihapus tidak dapat dikembalikan.',

                                showCancelButton:
                                    true,

                                confirmButtonText:
                                    'Ya, Hapus',

                                cancelButtonText:
                                    'Batal',

                                confirmButtonColor:
                                    '#dc3545'

                            });


                        confirmed =
                            result.isConfirmed;

                    } else {

                        confirmed =
                            confirm(
                                'Apakah Anda yakin ingin menghapus running text ini?'
                            );

                    }


                    if (!confirmed) {
                        return;
                    }


                    const deleteUrl =
                        deleteUrlTemplate.replace(
                            '__ID__',
                            id
                        );


                    try {

                        const response =
                            await fetch(
                                deleteUrl,
                                {

                                    method: 'DELETE',

                                    headers: {

                                        'X-CSRF-TOKEN':
                                        csrfToken,

                                        'Accept':
                                            'application/json'

                                    }

                                }
                            );


                        const result =
                            await response.json();


                        if (!response.ok) {

                            throw {
                                responseJSON:
                                result
                            };

                        }


                        await table.replaceData();


                        showSuccess(
                            result.message
                            ||
                            result.msg
                            ||
                            'Running text berhasil dihapus.'
                        );


                    } catch (error) {

                        showError(error);

                    }

                }


                /* =====================================================
                   TOGGLE STATUS
                ===================================================== */

                async function toggleStatus(id) {

                    const toggleUrl =
                        toggleUrlTemplate.replace(
                            '__ID__',
                            id
                        );


                    try {

                        const response =
                            await fetch(
                                toggleUrl,
                                {

                                    method: 'POST',

                                    headers: {

                                        'X-CSRF-TOKEN':
                                        csrfToken,

                                        'Accept':
                                            'application/json'

                                    }

                                }
                            );


                        const result =
                            await response.json();


                        if (!response.ok) {

                            throw {
                                responseJSON:
                                result
                            };

                        }


                        await table.replaceData();


                        showSuccess(
                            result.message
                            ||
                            result.msg
                            ||
                            'Status running text berhasil diperbarui.'
                        );


                    } catch (error) {

                        showError(error);

                    }

                }


                /* =====================================================
                   DRAG & DROP ORDER
                ===================================================== */

                table.on(
                    'rowMoved',
                    async function () {

                        try {

                            const rows =
                                table.getRows();


                            const items = [];


                            rows.forEach(
                                function (
                                    row,
                                    index
                                ) {

                                    const urutanBaru =
                                        index + 1;


                                    const data =
                                        row.getData();


                                    row.update({
                                        urutan:
                                        urutanBaru
                                    });


                                    items.push({
                                        id:
                                        data.id,

                                        urutan:
                                        urutanBaru
                                    });

                                }
                            );


                            const response =
                                await fetch(
                                    orderUrl,
                                    {

                                        method: 'POST',

                                        headers: {

                                            'Content-Type':
                                                'application/json',

                                            'X-CSRF-TOKEN':
                                            csrfToken,

                                            'Accept':
                                                'application/json'

                                        },

                                        body:
                                            JSON.stringify({
                                                items:
                                                items
                                            })

                                    }
                                );


                            const result =
                                await response.json();


                            if (!response.ok) {

                                throw {
                                    responseJSON:
                                    result
                                };

                            }


                        } catch (error) {

                            console.error(
                                'Gagal menyimpan urutan:',
                                error
                            );


                            showError(
                                error
                            );


                            await table.replaceData();

                        }

                    }
                );

            }
        );

    </script>


@endsection
