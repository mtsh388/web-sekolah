@extends('admin.template.admin')

@section('title', 'Program Unggulan')

@section('content-admin')

    <div class="container-fluid">

        {{-- ============================================================
            PAGE HEADER
        ============================================================ --}}

        <div class="app-content-header">

            <div class="container-fluid mt-3">

                <div class="row">

                    <div class="col-sm-6">

                        <h1 class="mb-0 fs-3">
                            Program Unggulan
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

                                    Program Unggulan

                                </li>

                            </ol>

                        </nav>

                    </div>

                </div>

            </div>

        </div>


        {{-- ============================================================
            MAIN CARD
        ============================================================ --}}

        <div class="card mb-4">

            <div class="card-header bg-white">

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

                                <h3 class="card-title mb-1">
                                    Program Unggulan
                                </h3>

                                <small class="text-secondary">
                                    Kelola Program Unggulan sekolah.
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

                            Tambah Program Unggulan

                        </button>

                    </div>

                </div>

            </div>


            {{-- ========================================================
                TABLE
            ========================================================= --}}

            <div class="card-body">

                <div id="table-program-unggulan"></div>

            </div>

        </div>

    </div>



    {{-- ================================================================
        MODAL TAMBAH
    ================================================================ --}}

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

                        <i class="fa-solid fa-puzzle-piece me-2 text-primary"></i>

                        Tambah Program Unggulan

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
                    action="{{ route('admin.akademik.program-unggulan.store') }}"
                    enctype="multipart/form-data"
                >

                    @csrf


                    <div class="modal-body">

                        <div class="row g-3">

                            {{-- ====================================================
                                JUDUL
                            ===================================================== --}}

                            <div class="col-12">

                                <label class="form-label fw-semibold">

                                    Judul Program Unggulan

                                    <span class="text-danger">*</span>

                                </label>

                                <input
                                    type="text"
                                    name="judul"
                                    class="form-control"
                                    placeholder="Contoh: Tahfidz Al-Qur'an"
                                    maxlength="255"
                                    required
                                >

                            </div>


                            {{-- ====================================================
                                DESKRIPSI
                            ===================================================== --}}

                            <div class="col-12">

                                <label class="form-label fw-semibold">
                                    Deskripsi
                                </label>

                                <textarea
                                    name="deskripsi"
                                    class="form-control"
                                    rows="5"
                                    placeholder="Deskripsi Program Unggulan..."
                                ></textarea>

                            </div>


                            {{-- ====================================================
                                FOTO
                            ===================================================== --}}

                            <div class="col-md-8">

                                <label class="form-label fw-semibold">
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

                                    Format JPG, JPEG, PNG, WEBP.
                                    Maksimal 2 MB.

                                </small>

                            </div>


                            {{-- ====================================================
                                PREVIEW
                            ===================================================== --}}

                            <div class="col-md-4">

                                <label class="form-label fw-semibold">
                                    Preview
                                </label>

                                <div
                                    id="preview-tambah"
                                    class="border rounded d-flex align-items-center justify-content-center bg-light"
                                    style="
                                    height:120px;
                                    overflow:hidden;
                                "
                                >

                                <span class="text-secondary small">
                                    Belum ada foto
                                </span>

                                </div>

                            </div>


                            {{-- ====================================================
                                URUTAN
                            ===================================================== --}}

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

                                <small class="text-secondary">
                                    Kosongkan untuk urutan otomatis.
                                </small>

                            </div>


                            {{-- ====================================================
                                STATUS
                            ===================================================== --}}

                            <div class="col-md-6 d-flex align-items-end">

                                <div class="form-check form-switch mb-2">

                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        name="is_active"
                                        value="1"
                                        checked
                                    >

                                    <label class="form-check-label">
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



    {{-- ================================================================
        MODAL EDIT
    ================================================================ --}}

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

                        Edit Program Unggulan

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
                                JUDUL
                            ===================================================== --}}

                            <div class="col-12">

                                <label class="form-label fw-semibold">

                                    Judul Program Unggulan

                                    <span class="text-danger">*</span>

                                </label>

                                <input
                                    type="text"
                                    name="judul"
                                    id="edit-judul"
                                    class="form-control"
                                    maxlength="255"
                                    required
                                >

                            </div>


                            {{-- ====================================================
                                DESKRIPSI
                            ===================================================== --}}

                            <div class="col-12">

                                <label class="form-label fw-semibold">
                                    Deskripsi
                                </label>

                                <textarea
                                    name="deskripsi"
                                    id="edit-deskripsi"
                                    class="form-control"
                                    rows="5"
                                ></textarea>

                            </div>


                            {{-- ====================================================
                                FOTO
                            ===================================================== --}}

                            <div class="col-md-8">

                                <label class="form-label fw-semibold">
                                    Foto
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
                                    Maksimal 2 MB.

                                </small>

                            </div>


                            {{-- ====================================================
                                PREVIEW
                            ===================================================== --}}

                            <div class="col-md-4">

                                <label class="form-label fw-semibold">
                                    Foto Saat Ini
                                </label>

                                <div
                                    id="preview-edit"
                                    class="border rounded d-flex align-items-center justify-content-center bg-light"
                                    style="
                                    height:120px;
                                    overflow:hidden;
                                "
                                >

                                <span class="text-secondary small">
                                    Tidak ada foto
                                </span>

                                </div>

                            </div>


                            {{-- ====================================================
                                URUTAN
                            ===================================================== --}}

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
                                >

                            </div>


                            {{-- ====================================================
                                STATUS
                            ===================================================== --}}

                            <div class="col-md-6 d-flex align-items-end">

                                <div class="form-check form-switch mb-2">

                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        name="is_active"
                                        id="edit-is-active"
                                        value="1"
                                    >

                                    <label class="form-check-label">
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



    {{-- ================================================================
        TABULATOR
    ================================================================ --}}

    <link
        href="https://unpkg.com/tabulator-tables@6.3.1/dist/css/tabulator_bootstrap5.min.css"
        rel="stylesheet"
    >

    <script
        src="https://unpkg.com/tabulator-tables@6.3.1/dist/js/tabulator.min.js"
    ></script>



    {{-- ================================================================
        STYLE
    ================================================================ --}}

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

        .program-unggulan-image {
            width: 70px;
            height: 50px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid rgba(0, 0, 0, .1);
        }

        .program-unggulan-image-placeholder {
            width: 70px;
            height: 50px;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            border: 1px solid rgba(0, 0, 0, .1);
        }

        .preview-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

    </style>



    {{-- ================================================================
        JAVASCRIPT
    ================================================================ --}}

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            /*
            |--------------------------------------------------------------------------
            | CSRF TOKEN
            |--------------------------------------------------------------------------
            */

            const csrfElement = document.querySelector(
                'meta[name="csrf-token"]'
            );

            if (!csrfElement) {

                console.error(
                    'CSRF token tidak ditemukan.'
                );

                return;
            }

            const csrfToken =
                csrfElement.getAttribute('content');


            /*
            |--------------------------------------------------------------------------
            | ELEMENT
            |--------------------------------------------------------------------------
            */

            const tableElement =
                document.getElementById(
                    'table-program-unggulan'
                );

            const formTambah =
                document.getElementById(
                    'formTambah'
                );

            const formEdit =
                document.getElementById(
                    'formEdit'
                );

            const tambahFoto =
                document.getElementById(
                    'tambah-foto'
                );

            const editFoto =
                document.getElementById(
                    'edit-foto'
                );

            const previewTambah =
                document.getElementById(
                    'preview-tambah'
                );

            const previewEdit =
                document.getElementById(
                    'preview-edit'
                );


            if (!tableElement) {

                console.error(
                    '#table-program-unggulan tidak ditemukan.'
                );

                return;
            }


            if (!formTambah) {

                console.error(
                    '#formTambah tidak ditemukan.'
                );

                return;
            }


            if (!formEdit) {

                console.error(
                    '#formEdit tidak ditemukan.'
                );

                return;
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


            /*
            |--------------------------------------------------------------------------
            | IMAGE URL
            |--------------------------------------------------------------------------
            */

            function getImageUrl(foto) {

                if (!foto) {

                    return '';

                }

                return "{{ asset('images/program-unggulan') }}/"
                    + encodeURIComponent(foto);

            }


            /*
            |--------------------------------------------------------------------------
            | PREVIEW IMAGE
            |--------------------------------------------------------------------------
            */

            function previewImage(
                input,
                previewElement
            ) {

                if (
                    !input ||
                    !previewElement
                ) {

                    return;

                }


                const file =
                    input.files?.[0];


                if (!file) {

                    return;

                }


                /*
                | Validasi format
                */

                const allowedTypes = [
                    'image/jpeg',
                    'image/png',
                    'image/webp'
                ];


                if (
                    !allowedTypes.includes(
                        file.type
                    )
                ) {

                    Swal.fire({

                        icon:
                            'warning',

                        title:
                            'File tidak valid',

                        text:
                            'Format foto harus JPG, JPEG, PNG, atau WEBP.'

                    });


                    input.value =
                        '';


                    return;

                }


                /*
                | Validasi ukuran
                */

                if (
                    file.size >
                    2 * 1024 * 1024
                ) {

                    Swal.fire({

                        icon:
                            'warning',

                        title:
                            'File terlalu besar',

                        text:
                            'Ukuran foto maksimal 2 MB.'

                    });


                    input.value =
                        '';


                    return;

                }


                /*
                | Preview
                */

                const reader =
                    new FileReader();


                reader.onload =
                    function (e) {

                        previewElement.innerHTML = `

                    <img
                        src="${e.target.result}"
                        class="preview-image"
                        alt="Preview"
                    >

                `;

                    };


                reader.readAsDataURL(
                    file
                );

            }


            /*
            |--------------------------------------------------------------------------
            | PREVIEW TAMBAH
            |--------------------------------------------------------------------------
            */

            if (tambahFoto) {

                tambahFoto.addEventListener(
                    'change',
                    function () {

                        previewImage(
                            this,
                            previewTambah
                        );

                    }
                );

            }


            /*
            |--------------------------------------------------------------------------
            | PREVIEW EDIT
            |--------------------------------------------------------------------------
            */

            if (editFoto) {

                editFoto.addEventListener(
                    'change',
                    function () {

                        previewImage(
                            this,
                            previewEdit
                        );

                    }
                );

            }


            /*
            |--------------------------------------------------------------------------
            | TABULATOR
            |--------------------------------------------------------------------------
            */

            const table =
                new Tabulator(
                    '#table-program-unggulan',
                    {

                        ajaxURL:
                            "{{ route('admin.akademik.program-unggulan.data') }}",

                        ajaxConfig:
                            'GET',

                        layout:
                            'fitColumns',

                        pagination:
                            false,

                        movableRows:
                            true,

                        movableRowsHandle:
                            '.drag-handle',

                        placeholder:
                            'Belum ada data Program Unggulan.',


                        /*
                        | ID ROW
                        */

                        index:
                            'id',


                        /*
                        |--------------------------------------------------------------------------
                        | AJAX RESPONSE
                        |--------------------------------------------------------------------------
                        */

                        ajaxResponse:
                            function (
                                url,
                                params,
                                response
                            ) {

                                console.log(
                                    'Response Program Unggulan:',
                                    response
                                );


                                return response.data ?? [];

                            },


                        /*
                        |--------------------------------------------------------------------------
                        | COLUMNS
                        |--------------------------------------------------------------------------
                        */

                        columns: [

                            /*
                            |--------------------------------------------------------------------------
                            | NO / URUTAN
                            |--------------------------------------------------------------------------
                            */

                            {

                                title:
                                    'Urutan',

                                field:
                                    'urutan',

                                width:
                                    70,

                                hozAlign:
                                    'center',

                                headerHozAlign:
                                    'center',

                                headerSort:
                                    false,

                                formatter:
                                    function (cell) {

                                        const value =
                                            cell.getValue();


                                        return value ??
                                            '-';

                                    }

                            },


                            /*
                            |--------------------------------------------------------------------------
                            | FOTO
                            |--------------------------------------------------------------------------
                            */

                            {

                                title:
                                    'Foto',

                                field:
                                    'foto',

                                width:
                                    100,

                                hozAlign:
                                    'center',

                                headerHozAlign:
                                    'center',

                                headerSort:
                                    false,

                                formatter:
                                    function (cell) {

                                        const foto =
                                            cell.getValue();


                                        if (!foto) {

                                            return `

                                        <span
                                            class="program-unggulan-image-placeholder"
                                        >

                                            <i
                                                class="fa-solid fa-image text-secondary"
                                            ></i>

                                        </span>

                                    `;

                                        }


                                        const imageUrl =
                                            getImageUrl(
                                                foto
                                            );


                                        return `

                                    <img
                                        src="${escapeHtml(imageUrl)}"
                                        class="program-unggulan-image"
                                        alt="Foto Program Unggulan"
                                        onerror="
                                            this.onerror=null;
                                            this.outerHTML='<span class=&quot;program-unggulan-image-placeholder&quot;><i class=&quot;fa-solid fa-image text-secondary&quot;></i></span>';
                                        "
                                    >

                                `;

                                    }

                            },


                            /*
                            |--------------------------------------------------------------------------
                            | JUDUL
                            |--------------------------------------------------------------------------
                            */

                            {

                                title:
                                    'Program Unggulan',

                                field:
                                    'judul',

                                minWidth:
                                    250,

                                formatter:
                                    function (cell) {

                                        const value =
                                            cell.getValue();


                                        if (!value) {

                                            return '-';

                                        }


                                        return `

                                    <div class="fw-semibold">

                                        ${escapeHtml(value)}

                                    </div>

                                `;

                                    }

                            },


                            /*
                            |--------------------------------------------------------------------------
                            | DESKRIPSI
                            |--------------------------------------------------------------------------
                            */

                            {

                                title:
                                    'Deskripsi',

                                field:
                                    'deskripsi',

                                minWidth:
                                    300,

                                formatter:
                                    function (cell) {

                                        const value =
                                            cell.getValue();


                                        if (!value) {

                                            return '-';

                                        }


                                        const stringValue =
                                            String(value);


                                        const text =
                                            stringValue.length > 150
                                                ? stringValue.substring(
                                                0,
                                                150
                                            ) + '...'
                                                : stringValue;


                                        return `

                                    <span
                                        title="${escapeHtml(stringValue)}"
                                    >

                                        ${escapeHtml(text)}

                                    </span>

                                `;

                                    }

                            },


                            /*
                            |--------------------------------------------------------------------------
                            | STATUS
                            |--------------------------------------------------------------------------
                            */

                            {

                                title:
                                    'Status',

                                field:
                                    'is_active',

                                width:
                                    120,

                                hozAlign:
                                    'center',

                                headerHozAlign:
                                    'center',

                                headerSort:
                                    false,

                                formatter:
                                    function (cell) {

                                        const value =
                                            cell.getValue();


                                        const active =
                                            value === true ||
                                            value === 1 ||
                                            value === '1';


                                        if (active) {

                                            return `

                                        <span
                                            class="badge text-bg-success"
                                        >

                                            <i
                                                class="fa-solid fa-check me-1"
                                            ></i>

                                            Aktif

                                        </span>

                                    `;

                                        }


                                        return `

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


                            /*
                            |--------------------------------------------------------------------------
                            | AKSI
                            |--------------------------------------------------------------------------
                            */

                            {

                                title:
                                    'Aksi',

                                width:
                                    130,

                                hozAlign:
                                    'center',

                                headerHozAlign:
                                    'center',

                                headerSort:
                                    false,

                                frozen:
                                    true,

                                formatter:
                                    function (cell) {

                                        const data =
                                            cell
                                                .getRow()
                                                .getData();


                                        return `

                                    <div
                                        class="d-flex justify-content-center gap-1"
                                    >

                                        <button
                                            type="button"
                                            class="btn btn-sm btn-outline-primary btn-edit"
                                            data-id="${escapeHtml(data.id)}"
                                            title="Edit"
                                        >

                                            <i
                                                class="fa-solid fa-pen"
                                            ></i>

                                        </button>


                                        <button
                                            type="button"
                                            class="btn btn-sm btn-outline-danger btn-delete"
                                            data-id="${escapeHtml(data.id)}"
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


            /*
            |--------------------------------------------------------------------------
            | EVENT CLICK EDIT / DELETE
            |--------------------------------------------------------------------------
            */

            tableElement.addEventListener(
                'click',
                function (e) {

                    /*
                    |--------------------------------------------------------------------------
                    | EDIT
                    |--------------------------------------------------------------------------
                    */

                    const editButton =
                        e.target.closest(
                            '.btn-edit'
                        );


                    if (editButton) {

                        e.preventDefault();

                        e.stopPropagation();


                        const rowElement =
                            editButton.closest(
                                '.tabulator-row'
                            );


                        if (!rowElement) {

                            console.error(
                                'Row Tabulator tidak ditemukan.'
                            );

                            return;

                        }


                        let row;


                        try {

                            row =
                                table.getRow(
                                    rowElement
                                );

                        } catch (error) {

                            console.error(
                                'Gagal mengambil row:',
                                error
                            );

                            return;

                        }


                        if (!row) {

                            console.error(
                                'Data row tidak ditemukan.'
                            );

                            return;

                        }


                        const data =
                            row.getData();


                        console.log(
                            'EDIT DATA:',
                            data
                        );


                        openEditModal(
                            data
                        );


                        return;

                    }


                    /*
                    |--------------------------------------------------------------------------
                    | DELETE
                    |--------------------------------------------------------------------------
                    */

                    const deleteButton =
                        e.target.closest(
                            '.btn-delete'
                        );


                    if (deleteButton) {

                        e.preventDefault();

                        e.stopPropagation();


                        const rowElement =
                            deleteButton.closest(
                                '.tabulator-row'
                            );


                        if (!rowElement) {

                            console.error(
                                'Row Tabulator tidak ditemukan.'
                            );

                            return;

                        }


                        let row;


                        try {

                            row =
                                table.getRow(
                                    rowElement
                                );

                        } catch (error) {

                            console.error(
                                'Gagal mengambil row:',
                                error
                            );

                            return;

                        }


                        if (!row) {

                            console.error(
                                'Data row tidak ditemukan.'
                            );

                            return;

                        }


                        const data =
                            row.getData();


                        console.log(
                            'DELETE DATA:',
                            data
                        );


                        deleteData(
                            data
                        );

                    }

                }
            );


            /*
            |--------------------------------------------------------------------------
            | UPDATE ORDER
            |--------------------------------------------------------------------------
            */

            function updateOrder() {

                const rows =
                    table.getRows();


                const orders =
                    rows.map(
                        function (
                            row,
                            index
                        ) {

                            const data =
                                row.getData();


                            return {

                                id:
                                data.id,

                                urutan:
                                    index + 1

                            };

                        }
                    );


                const savingOrder =
                    document.getElementById(
                        'saving-order'
                    );


                if (savingOrder) {

                    savingOrder.style.display =
                        'flex';

                }


                fetch(
                    "{{ route('admin.akademik.program-unggulan.order') }}",
                    {

                        method:
                            'POST',

                        headers: {

                            'Content-Type':
                                'application/json',

                            'Accept':
                                'application/json',

                            'X-CSRF-TOKEN':
                            csrfToken

                        },

                        body:
                            JSON.stringify({
                                orders:
                                orders
                            })

                    }
                )

                    .then(
                        async function (response) {

                            const result =
                                await response.json();


                            if (!response.ok) {

                                throw new Error(
                                    result.message ||
                                    'Gagal menyimpan urutan.'
                                );

                            }


                            return result;

                        }
                    )

                    .then(
                        function () {

                            rows.forEach(
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
                    )

                    .catch(
                        function (error) {

                            console.error(
                                'UPDATE ORDER ERROR:',
                                error
                            );


                            Swal.fire({

                                icon:
                                    'error',

                                title:
                                    'Gagal',

                                text:
                                    error.message ||
                                    'Urutan gagal disimpan.'

                            });


                            table.setData();

                        }
                    )

                    .finally(
                        function () {

                            if (savingOrder) {

                                savingOrder.style.display =
                                    'none';

                            }

                        }
                    );

            }


            /*
            |--------------------------------------------------------------------------
            | ROW MOVED
            |--------------------------------------------------------------------------
            */

            table.on(
                'rowMoved',
                function () {

                    updateOrder();

                }
            );


            /*
            |--------------------------------------------------------------------------
            | TAMBAH DATA
            |--------------------------------------------------------------------------
            */

            formTambah.addEventListener(
                'submit',
                function (e) {

                    e.preventDefault();


                    const form =
                        this;


                    const formData =
                        new FormData(
                            form
                        );


                    const activeCheckbox =
                        form.querySelector(
                            '[name="is_active"]'
                        );


                    if (activeCheckbox) {

                        formData.set(
                            'is_active',
                            activeCheckbox.checked
                                ? '1'
                                : '0'
                        );

                    }


                    const submitButton =
                        form.querySelector(
                            'button[type="submit"]'
                        );


                    const originalButtonHtml =
                        submitButton
                            ? submitButton.innerHTML
                            : '';


                    if (submitButton) {

                        submitButton.disabled =
                            true;


                        submitButton.innerHTML = `

                    <span
                        class="spinner-border spinner-border-sm me-1"
                    ></span>

                    Menyimpan...

                `;

                    }


                    fetch(
                        form.action,
                        {

                            method:
                                'POST',

                            headers: {

                                'Accept':
                                    'application/json',

                                'X-CSRF-TOKEN':
                                csrfToken

                            },

                            body:
                            formData

                        }
                    )

                        .then(
                            async function (response) {

                                const result =
                                    await response.json();


                                if (!response.ok) {

                                    if (
                                        response.status === 422
                                    ) {

                                        const errors =
                                            Object.values(
                                                result.errors || {}
                                            )
                                                .flat()
                                                .join('\n');


                                        throw new Error(
                                            errors ||
                                            'Data yang dimasukkan tidak valid.'
                                        );

                                    }


                                    throw new Error(
                                        result.message ||
                                        'Gagal menyimpan data.'
                                    );

                                }


                                return result;

                            }
                        )

                        .then(
                            function (result) {

                                bootstrap.Modal
                                    .getOrCreateInstance(
                                        document.getElementById(
                                            'modalTambah'
                                        )
                                    )
                                    .hide();


                                form.reset();


                                if (activeCheckbox) {

                                    activeCheckbox.checked =
                                        true;

                                }


                                if (previewTambah) {

                                    previewTambah.innerHTML = `

                            <span
                                class="text-secondary small"
                            >

                                Belum ada foto

                            </span>

                        `;

                                }


                                table.setData();


                                Swal.fire({

                                    icon:
                                        'success',

                                    title:
                                        'Berhasil',

                                    text:
                                        result.message ||
                                        'Program Unggulan berhasil ditambahkan.',

                                    timer:
                                        1800,

                                    showConfirmButton:
                                        false

                                });

                            }
                        )

                        .catch(
                            function (error) {

                                console.error(
                                    'TAMBAH ERROR:',
                                    error
                                );


                                Swal.fire({

                                    icon:
                                        'error',

                                    title:
                                        'Gagal',

                                    text:
                                        error.message ||
                                        'Terjadi kesalahan.'

                                });

                            }
                        )

                        .finally(
                            function () {

                                if (submitButton) {

                                    submitButton.disabled =
                                        false;

                                    submitButton.innerHTML =
                                        originalButtonHtml;

                                }

                            }
                        );

                }
            );


            /*
            |--------------------------------------------------------------------------
            | OPEN EDIT MODAL
            |--------------------------------------------------------------------------
            */

            function openEditModal(data) {

                console.log(
                    'openEditModal:',
                    data
                );


                if (
                    !data ||
                    !data.id
                ) {

                    Swal.fire({

                        icon:
                            'error',

                        title:
                            'Data tidak ditemukan',

                        text:
                            'ID Program Unggulan tidak ditemukan.'

                    });


                    return;

                }


                /*
                |--------------------------------------------------------------------------
                | UPDATE URL
                |--------------------------------------------------------------------------
                |
                | ROUTE ANDA:
                |
                | /admin/akademik/program-unggulan/{programUnggulan}
                |
                */

                const updateUrl =
                    "{{ route('admin.akademik.program-unggulan.update', ['programUnggulan' => '__ID__']) }}";


                formEdit.action =
                    updateUrl.replace(
                        '__ID__',
                        data.id
                    );


                console.log(
                    'FORM EDIT ACTION:',
                    formEdit.action
                );


                /*
                |--------------------------------------------------------------------------
                | JUDUL
                |--------------------------------------------------------------------------
                */

                const editJudul =
                    document.getElementById(
                        'edit-judul'
                    );


                if (editJudul) {

                    editJudul.value =
                        data.judul ?? '';

                }


                /*
                |--------------------------------------------------------------------------
                | DESKRIPSI
                |--------------------------------------------------------------------------
                */

                const editDeskripsi =
                    document.getElementById(
                        'edit-deskripsi'
                    );


                if (editDeskripsi) {

                    editDeskripsi.value =
                        data.deskripsi ?? '';

                }


                /*
                |--------------------------------------------------------------------------
                | URUTAN
                |--------------------------------------------------------------------------
                */

                const editUrutan =
                    document.getElementById(
                        'edit-urutan'
                    );


                if (editUrutan) {

                    editUrutan.value =
                        data.urutan ?? 0;

                }


                /*
                |--------------------------------------------------------------------------
                | STATUS
                |--------------------------------------------------------------------------
                */

                const editIsActive =
                    document.getElementById(
                        'edit-is-active'
                    );


                if (editIsActive) {

                    editIsActive.checked =
                        data.is_active === true ||
                        data.is_active === 1 ||
                        data.is_active === '1';

                }


                /*
                |--------------------------------------------------------------------------
                | RESET FILE
                |--------------------------------------------------------------------------
                */

                if (editFoto) {

                    editFoto.value =
                        '';

                }


                /*
                |--------------------------------------------------------------------------
                | PREVIEW FOTO
                |--------------------------------------------------------------------------
                */

                if (previewEdit) {

                    if (data.foto) {

                        const imageUrl =
                            getImageUrl(
                                data.foto
                            );


                        previewEdit.innerHTML = `

                    <img
                        src="${escapeHtml(imageUrl)}"
                        class="preview-image"
                        alt="Foto Program Unggulan"
                        onerror="
                            this.onerror=null;
                            this.parentElement.innerHTML='<span class=&quot;text-secondary small&quot;>Foto tidak ditemukan</span>';
                        "
                    >

                `;

                    } else {

                        previewEdit.innerHTML = `

                    <span
                        class="text-secondary small"
                    >

                        Tidak ada foto

                    </span>

                `;

                    }

                }


                /*
                |--------------------------------------------------------------------------
                | SHOW MODAL
                |--------------------------------------------------------------------------
                */

                const modalElement =
                    document.getElementById(
                        'modalEdit'
                    );


                if (!modalElement) {

                    console.error(
                        '#modalEdit tidak ditemukan.'
                    );

                    return;

                }


                const modal =
                    bootstrap.Modal
                        .getOrCreateInstance(
                            modalElement
                        );


                modal.show();


                /*
                |--------------------------------------------------------------------------
                | FOCUS JUDUL
                |--------------------------------------------------------------------------
                */

                modalElement.addEventListener(
                    'shown.bs.modal',
                    function focusEdit() {

                        if (editJudul) {

                            editJudul.focus();

                        }


                        modalElement.removeEventListener(
                            'shown.bs.modal',
                            focusEdit
                        );

                    }
                );

            }


            /*
            |--------------------------------------------------------------------------
            | EDIT DATA
            |--------------------------------------------------------------------------
            */

            formEdit.addEventListener(
                'submit',
                function (e) {

                    e.preventDefault();


                    const form =
                        this;


                    if (!form.action) {

                        Swal.fire({

                            icon:
                                'error',

                            title:
                                'URL tidak ditemukan',

                            text:
                                'URL update belum tersedia.'

                        });


                        return;

                    }


                    const formData =
                        new FormData(
                            form
                        );


                    /*
                    | Laravel Method Spoofing
                    */

                    formData.set(
                        '_method',
                        'PUT'
                    );


                    /*
                    | Checkbox
                    */

                    const activeCheckbox =
                        form.querySelector(
                            '[name="is_active"]'
                        );


                    if (activeCheckbox) {

                        formData.set(
                            'is_active',
                            activeCheckbox.checked
                                ? '1'
                                : '0'
                        );

                    }


                    /*
                    | Loading button
                    */

                    const submitButton =
                        form.querySelector(
                            'button[type="submit"]'
                        );


                    const originalButtonHtml =
                        submitButton
                            ? submitButton.innerHTML
                            : '';


                    if (submitButton) {

                        submitButton.disabled =
                            true;


                        submitButton.innerHTML = `

                    <span
                        class="spinner-border spinner-border-sm me-1"
                    ></span>

                    Menyimpan...

                `;

                    }


                    console.log(
                        'UPDATE:',
                        form.action
                    );


                    fetch(
                        form.action,
                        {

                            method:
                                'POST',

                            headers: {

                                'Accept':
                                    'application/json',

                                'X-CSRF-TOKEN':
                                csrfToken

                            },

                            body:
                            formData

                        }
                    )

                        .then(
                            async function (response) {

                                const contentType =
                                    response.headers.get(
                                        'content-type'
                                    ) || '';


                                let result = {};


                                if (
                                    contentType.includes(
                                        'application/json'
                                    )
                                ) {

                                    result =
                                        await response.json();

                                } else {

                                    const text =
                                        await response.text();


                                    console.error(
                                        'Response UPDATE bukan JSON:',
                                        text
                                    );


                                    throw new Error(
                                        'Server tidak mengembalikan JSON. Periksa Controller update.'
                                    );

                                }


                                if (!response.ok) {

                                    if (
                                        response.status === 422
                                    ) {

                                        const errors =
                                            Object.values(
                                                result.errors || {}
                                            )
                                                .flat()
                                                .join('\n');


                                        throw new Error(
                                            errors ||
                                            'Data yang dimasukkan tidak valid.'
                                        );

                                    }


                                    throw new Error(
                                        result.message ||
                                        'Gagal memperbarui data.'
                                    );

                                }


                                return result;

                            }
                        )

                        .then(
                            function (result) {

                                /*
                                | Tutup modal
                                */

                                bootstrap.Modal
                                    .getOrCreateInstance(
                                        document.getElementById(
                                            'modalEdit'
                                        )
                                    )
                                    .hide();


                                /*
                                | Refresh data
                                */

                                table.setData();


                                /*
                                | Success
                                */

                                Swal.fire({

                                    icon:
                                        'success',

                                    title:
                                        'Berhasil',

                                    text:
                                        result.message ||
                                        'Program Unggulan berhasil diperbarui.',

                                    timer:
                                        1800,

                                    showConfirmButton:
                                        false

                                });

                            }
                        )

                        .catch(
                            function (error) {

                                console.error(
                                    'EDIT ERROR:',
                                    error
                                );


                                Swal.fire({

                                    icon:
                                        'error',

                                    title:
                                        'Gagal',

                                    text:
                                        error.message ||
                                        'Terjadi kesalahan.'

                                });

                            }
                        )

                        .finally(
                            function () {

                                if (submitButton) {

                                    submitButton.disabled =
                                        false;

                                    submitButton.innerHTML =
                                        originalButtonHtml;

                                }

                            }
                        );

                }
            );


            /*
            |--------------------------------------------------------------------------
            | DELETE
            |--------------------------------------------------------------------------
            */

            function deleteData(data) {

                if (
                    !data ||
                    !data.id
                ) {

                    Swal.fire({

                        icon:
                            'error',

                        title:
                            'Data tidak ditemukan',

                        text:
                            'ID Program Unggulan tidak ditemukan.'

                    });


                    return;

                }


                Swal.fire({

                    title:
                        'Hapus Program Unggulan?',

                    html: `

                Data

                <strong>
                    ${escapeHtml(data.judul)}
                </strong>

                akan dihapus secara permanen.

            `,

                    icon:
                        'warning',

                    showCancelButton:
                        true,

                    confirmButtonText:
                        'Ya, Hapus',

                    cancelButtonText:
                        'Batal',

                    confirmButtonColor:
                        '#dc3545'

                })

                    .then(
                        function (result) {

                            if (
                                !result.isConfirmed
                            ) {

                                return;

                            }


                            /*
                            |--------------------------------------------------------------------------
                            | DELETE URL
                            |--------------------------------------------------------------------------
                            |
                            | ROUTE:
                            |
                            | /{programUnggulan}
                            |
                            */

                            const deleteUrl =
                                "{{ route('admin.akademik.program-unggulan.destroy', ['programUnggulan' => '__ID__']) }}"
                                    .replace(
                                        '__ID__',
                                        data.id
                                    );


                            console.log(
                                'DELETE URL:',
                                deleteUrl
                            );


                            fetch(
                                deleteUrl,
                                {

                                    method:
                                        'DELETE',

                                    headers: {

                                        'Accept':
                                            'application/json',

                                        'X-CSRF-TOKEN':
                                        csrfToken

                                    }

                                }
                            )

                                .then(
                                    async function (response) {

                                        const contentType =
                                            response.headers.get(
                                                'content-type'
                                            ) || '';


                                        let result = {};


                                        if (
                                            contentType.includes(
                                                'application/json'
                                            )
                                        ) {

                                            result =
                                                await response.json();

                                        } else {

                                            const text =
                                                await response.text();


                                            console.error(
                                                'Response DELETE bukan JSON:',
                                                text
                                            );


                                            throw new Error(
                                                'Server tidak mengembalikan JSON.'
                                            );

                                        }


                                        if (!response.ok) {

                                            throw new Error(
                                                result.message ||
                                                'Gagal menghapus data.'
                                            );

                                        }


                                        return result;

                                    }
                                )

                                .then(
                                    function (result) {

                                        table.setData();


                                        Swal.fire({

                                            icon:
                                                'success',

                                            title:
                                                'Berhasil',

                                            text:
                                                result.message ||
                                                'Program Unggulan berhasil dihapus.',

                                            timer:
                                                1800,

                                            showConfirmButton:
                                                false

                                        });

                                    }
                                )

                                .catch(
                                    function (error) {

                                        console.error(
                                            'DELETE ERROR:',
                                            error
                                        );


                                        Swal.fire({

                                            icon:
                                                'error',

                                            title:
                                                'Gagal',

                                            text:
                                                error.message ||
                                                'Terjadi kesalahan.'

                                        });

                                    }
                                );

                        }
                    );

            }


            /*
            |--------------------------------------------------------------------------
            | INITIALIZED
            |--------------------------------------------------------------------------
            */

            console.log(
                'Program Unggulan script berhasil diinisialisasi.'
            );

        });

    </script>

@endsection
