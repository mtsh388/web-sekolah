@extends('admin.template.admin')

@section('title', 'Fasilitas')

@section('content-admin')
    <link
        href="https://unpkg.com/tabulator-tables@6.3.1/dist/css/tabulator_bootstrap5.min.css"
        rel="stylesheet"
    >

    <style>

        #table-fasilitas {
            font-size: 14px;
        }

        .fasilitas-foto {
            width: 75px;
            height: 58px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
        }

        .fasilitas-no-foto {
            width: 75px;
            height: 58px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f5f6f8;
            color: #9ca3af;
            border-radius: 8px;
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
            min-height: 68px;
        }

        .btn-action {
            width: 34px;
            height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }

    </style>
    <div class="container-fluid">

        {{-- =====================================================
             HEADER
        ====================================================== --}}

        <div class="app-content-header">

            <div class="container-fluid mt-3">

                <div class="row">

                    <div class="col-sm-6">

                        <h1 class="mb-0 fs-3">
                            Fasilitas
                        </h1>

                    </div>

                    <div class="col-sm-6">

                        <ol class="breadcrumb float-sm-end">

                            <li class="breadcrumb-item">
                                Akademik
                            </li>

                            <li class="breadcrumb-item active">
                                Fasilitas
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
                                Data Fasilitas
                            </h5>

                            <small class="text-muted">
                                Kelola fasilitas sekolah
                            </small>

                        </div>


                        <button
                            type="button"
                            class="btn btn-primary"
                            id="btnTambah"
                        >
                            <i class="fa-solid fa-plus me-1"></i>
                            Tambah Fasilitas
                        </button>

                    </div>

                </div>


                <div class="card-body">

                    <div id="table-fasilitas"></div>

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

                        <i class="fa-solid fa-building me-2"></i>

                        Tambah Fasilitas

                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                    ></button>

                </div>


                <form
                    id="formTambah"
                    enctype="multipart/form-data"
                >

                    @csrf

                    <div class="modal-body">

                        <div class="row g-3">

                            {{-- Nama --}}
                            <div class="col-md-8">

                                <label class="form-label">

                                    Nama Fasilitas

                                    <span class="text-danger">*</span>

                                </label>

                                <input
                                    type="text"
                                    name="nama"
                                    class="form-control"
                                    placeholder="Contoh: Laboratorium Komputer"
                                    required
                                >

                            </div>


                            {{-- Jumlah --}}
                            <div class="col-md-4">

                                <label class="form-label">
                                    Jumlah
                                </label>

                                <input
                                    type="text"
                                    name="jumlah"
                                    class="form-control"
                                    placeholder="Contoh: 2 Ruang"
                                >

                            </div>


                            {{-- Lokasi --}}
                            <div class="col-md-6">

                                <label class="form-label">
                                    Lokasi
                                </label>

                                <input
                                    type="text"
                                    name="lokasi"
                                    class="form-control"
                                    placeholder="Contoh: Gedung A Lantai 2"
                                >

                            </div>


                            {{-- Urutan --}}
                            <div class="col-md-3">

                                <label class="form-label">
                                    Urutan
                                </label>

                                <input
                                    type="number"
                                    name="urutan"
                                    class="form-control"
                                    value="0"
                                    min="0"
                                >

                            </div>


                            {{-- Status --}}
                            <div class="col-md-3">

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


                            {{-- Deskripsi --}}
                            <div class="col-md-7">

                                <label class="form-label">
                                    Deskripsi
                                </label>

                                <textarea
                                    name="deskripsi"
                                    class="form-control"
                                    rows="6"
                                    placeholder="Deskripsi fasilitas..."
                                ></textarea>

                            </div>


                            {{-- Foto --}}
                            <div class="col-md-5">

                                <label class="form-label">
                                    Foto
                                </label>

                                <input
                                    type="file"
                                    name="foto"
                                    id="tambah-foto"
                                    class="form-control"
                                    accept="image/jpeg,image/png,image/webp"
                                >

                                <small class="text-muted">
                                    JPG, PNG atau WEBP. Maksimal 2 MB.
                                </small>


                                <div
                                    id="preview-tambah-wrapper"
                                    class="mt-3 text-center"
                                    style="display:none;"
                                >

                                    <img
                                        id="preview-tambah"
                                        src=""
                                        class="img-fluid rounded border"
                                        style="max-height:220px;"
                                    >

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

                        Edit Fasilitas

                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                    ></button>

                </div>


                <form
                    id="formEdit"
                    enctype="multipart/form-data"
                >

                    @csrf

                    @method('PUT')

                    <div class="modal-body">

                        <div class="row g-3">

                            {{-- Nama --}}
                            <div class="col-md-8">

                                <label class="form-label">

                                    Nama Fasilitas

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


                            {{-- Jumlah --}}
                            <div class="col-md-4">

                                <label class="form-label">
                                    Jumlah
                                </label>

                                <input
                                    type="text"
                                    name="jumlah"
                                    id="edit-jumlah"
                                    class="form-control"
                                >

                            </div>


                            {{-- Lokasi --}}
                            <div class="col-md-6">

                                <label class="form-label">
                                    Lokasi
                                </label>

                                <input
                                    type="text"
                                    name="lokasi"
                                    id="edit-lokasi"
                                    class="form-control"
                                >

                            </div>


                            {{-- Urutan --}}
                            <div class="col-md-3">

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


                            {{-- Status --}}
                            <div class="col-md-3">

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


                            {{-- Deskripsi --}}
                            <div class="col-md-7">

                                <label class="form-label">
                                    Deskripsi
                                </label>

                                <textarea
                                    name="deskripsi"
                                    id="edit-deskripsi"
                                    class="form-control"
                                    rows="6"
                                ></textarea>

                            </div>


                            {{-- Foto --}}
                            <div class="col-md-5">

                                <label class="form-label">
                                    Foto
                                </label>

                                <input
                                    type="file"
                                    name="foto"
                                    id="edit-foto"
                                    class="form-control"
                                    accept="image/jpeg,image/png,image/webp"
                                >

                                <small class="text-muted">
                                    Kosongkan jika tidak ingin mengganti foto.
                                </small>


                                <div class="mt-3 text-center">

                                    <img
                                        id="preview-edit"
                                        src=""
                                        class="img-fluid rounded border"
                                        style="
                                        max-height:220px;
                                        display:none;
                                    "
                                    >

                                    <div
                                        id="preview-edit-empty"
                                        class="text-muted border rounded p-5"
                                    >

                                        <i class="fa-regular fa-image fa-2x mb-2"></i>

                                        <div>
                                            Tidak ada foto
                                        </div>

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
    <script src="https://unpkg.com/tabulator-tables@6.3.1/dist/js/tabulator.min.js"></script>

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const tableElement =
                document.getElementById('table-fasilitas');

            if (!tableElement) {
                return;
            }


            /* =====================================================
               CONFIG
            ===================================================== */

            const csrfToken =
                document.querySelector(
                    'meta[name="csrf-token"]'
                )?.getAttribute('content')
                || '{{ csrf_token() }}';


            const dataUrl =
                "{{ route('admin.akademik.fasilitas.data') }}";


            const storeUrl =
                "{{ route('admin.akademik.fasilitas.store') }}";


            /*
             * PENTING:
             * Route menggunakan {fasilitas}
             */

            const editUrlTemplate = @json(
        route(
            'admin.akademik.fasilitas.edit',
            ['fasilitas' => '__ID__']
        )
    );


            const updateUrlTemplate = @json(
        route(
            'admin.akademik.fasilitas.update',
            ['fasilitas' => '__ID__']
        )
    );


            const deleteUrlTemplate = @json(
        route(
            'admin.akademik.fasilitas.destroy',
            ['fasilitas' => '__ID__']
        )
    );


            const toggleUrlTemplate = @json(
        route(
            'admin.akademik.fasilitas.toggle-status',
            ['fasilitas' => '__ID__']
        )
    );


            const orderUrl =
                "{{ route('admin.akademik.fasilitas.order') }}";


            /* =====================================================
               ELEMENT
            ===================================================== */

            const modalTambahElement =
                document.getElementById('modalTambah');

            const modalEditElement =
                document.getElementById('modalEdit');


            const modalTambah =
                new bootstrap.Modal(
                    modalTambahElement
                );


            const modalEdit =
                new bootstrap.Modal(
                    modalEditElement
                );


            const formTambah =
                document.getElementById('formTambah');


            const formEdit =
                document.getElementById('formEdit');


            const btnTambah =
                document.getElementById('btnTambah');


            const tambahFoto =
                document.getElementById('tambah-foto');


            const editFoto =
                document.getElementById('edit-foto');


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


            function imageUrl(filename) {

                if (!filename) {
                    return null;
                }

                return "{{ asset('images/fasilitas') }}/"
                    + encodeURIComponent(filename);
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
                                    messages.push(msg);
                                }
                            );

                        }
                    );


                    if (messages.length) {

                        message =
                            messages.join('<br>');
                    }
                }


                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    html: message
                });
            }


            function loadingButton(
                button,
                loading
            ) {

                if (!button) {
                    return;
                }


                if (loading) {

                    button.dataset.originalHtml =
                        button.innerHTML;

                    button.disabled = true;

                    button.innerHTML =
                        '<span class="spinner-border spinner-border-sm me-1"></span>' +
                        'Memproses...';

                } else {

                    button.disabled = false;

                    if (button.dataset.originalHtml) {

                        button.innerHTML =
                            button.dataset.originalHtml;
                    }
                }
            }


            /* =====================================================
               PREVIEW FOTO
            ===================================================== */

            if (tambahFoto) {

                tambahFoto.addEventListener(
                    'change',
                    function () {

                        if (
                            !this.files ||
                            !this.files[0]
                        ) {
                            return;
                        }


                        const file =
                            this.files[0];


                        if (
                            !file.type.startsWith('image/')
                        ) {

                            Swal.fire({
                                icon: 'warning',
                                title: 'File tidak valid',
                                text: 'Silakan pilih file gambar.'
                            });

                            this.value = '';

                            return;
                        }


                        const reader =
                            new FileReader();


                        reader.onload =
                            function (e) {

                                document.getElementById(
                                    'preview-tambah'
                                ).src = e.target.result;


                                document.getElementById(
                                    'preview-tambah-wrapper'
                                ).style.display = 'block';

                            };


                        reader.readAsDataURL(file);

                    }
                );
            }


            if (editFoto) {

                editFoto.addEventListener(
                    'change',
                    function () {

                        if (
                            !this.files ||
                            !this.files[0]
                        ) {
                            return;
                        }


                        const reader =
                            new FileReader();


                        reader.onload =
                            function (e) {

                                const image =
                                    document.getElementById(
                                        'preview-edit'
                                    );

                                const empty =
                                    document.getElementById(
                                        'preview-edit-empty'
                                    );


                                image.src =
                                    e.target.result;

                                image.style.display =
                                    'block';

                                empty.style.display =
                                    'none';

                            };


                        reader.readAsDataURL(
                            this.files[0]
                        );

                    }
                );
            }


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
                            'Belum ada data fasilitas.',

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

                                return response.data || [];

                            },


                        columns: [

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

                            {
                                title: 'Foto',
                                field: 'foto',
                                width: 100,
                                hozAlign: 'center',
                                headerSort: false,

                                formatter:
                                    function (cell) {

                                        const foto =
                                            cell.getValue();


                                        if (!foto) {

                                            return `
                                        <div class="fasilitas-no-foto">
                                            <i class="fa-regular fa-image"></i>
                                        </div>
                                    `;
                                        }


                                        return `
                                    <img
                                        src="${imageUrl(foto)}"
                                        class="fasilitas-foto"
                                        alt="Foto Fasilitas"
                                    >
                                `;

                                    }
                            },


                            {
                                title: 'Nama Fasilitas',
                                field: 'nama',
                                minWidth: 220,

                                formatter:
                                    function (cell) {

                                        const data =
                                            cell.getRow()
                                                .getData();


                                        return `
                                    <div>
                                        <div class="fw-semibold">
                                            ${escapeHtml(data.nama)}
                                        </div>

                                        ${
                                            data.deskripsi
                                                ? `
                                                <div class="small text-muted mt-1">
                                                    ${escapeHtml(
                                                    data.deskripsi
                                                        .substring(0, 100)
                                                )}
                                                    ${
                                                    data.deskripsi.length > 100
                                                        ? '...'
                                                        : ''
                                                }
                                                </div>
                                            `
                                                : ''
                                        }
                                    </div>
                                `;

                                    }
                            },


                            {
                                title: 'Lokasi',
                                field: 'lokasi',
                                minWidth: 150,

                                formatter:
                                    function (cell) {

                                        return cell.getValue()
                                            ? escapeHtml(
                                                cell.getValue()
                                            )
                                            : '-';

                                    }
                            },


                            {
                                title: 'Jumlah',
                                field: 'jumlah',
                                width: 100,
                                hozAlign: 'center',

                                formatter:
                                    function (cell) {

                                        return cell.getValue()
                                            ? `
                                        <span class="badge bg-light text-dark">
                                            ${escapeHtml(
                                                cell.getValue()
                                            )}
                                        </span>
                                    `
                                            : '-';

                                    }
                            },





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
                                        <span class="badge bg-success-subtle text-success">
                                            Aktif
                                        </span>
                                    `
                                            : `
                                        <span class="badge bg-secondary-subtle text-secondary">
                                            Nonaktif
                                        </span>
                                    `;

                                    }
                            },


                            {
                                title: 'Aksi',
                                width: 145,
                                hozAlign: "center",
                                headerHozAlign: "center",
                                headerSort: false,

                                formatter:
                                    function (cell) {

                                        const data =
                                            cell.getRow()
                                                .getData();


                                        return `
                                    <div class="d-flex gap-1 justify-content-center">

                                        <button
                                            type="button"
                                            class="btn btn-sm btn-outline-primary btn-action btn-edit"
                                            data-id="${data.id}"
                                            title="Edit"
                                        >
                                            <i class="fa-solid fa-pen"></i>
                                        </button>


                                        <button
                                            type="button"
                                            class="btn btn-sm btn-outline-${data.is_active ? 'warning' : 'success'} btn-action btn-toggle"
                                            data-id="${data.id}"
                                            title="${data.is_active ? 'Nonaktifkan' : 'Aktifkan'}"
                                        >
                                            <i class="fa-solid ${
                                            data.is_active
                                                ? 'fa-eye-slash'
                                                : 'fa-eye'
                                        }"></i>
                                        </button>


                                        <button
                                            type="button"
                                            class="btn btn-sm btn-outline-danger btn-action btn-delete"
                                            data-id="${data.id}"
                                            title="Hapus"
                                        >
                                            <i class="fa-solid fa-trash"></i>
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

            btnTambah.addEventListener(
                'click',
                function () {

                    formTambah.reset();


                    document.getElementById(
                        'tambah-is-active'
                    ).checked = true;


                    document.getElementById(
                        'preview-tambah-wrapper'
                    ).style.display = 'none';


                    document.getElementById(
                        'preview-tambah'
                    ).src = '';


                    modalTambah.show();

                }
            );


            formTambah.addEventListener(
                'submit',
                async function (e) {

                    e.preventDefault();


                    const button =
                        document.getElementById(
                            'btnSimpan'
                        );


                    const formData =
                        new FormData(formTambah);


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

                                    body: formData
                                }
                            );


                        const result =
                            await response.json();


                        if (!response.ok) {

                            throw {
                                responseJSON: result
                            };
                        }


                        modalTambah.hide();


                        await table.replaceData();


                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text:
                                result.msg ||
                                'Fasilitas berhasil ditambahkan.',
                            timer: 1800,
                            showConfirmButton: false
                        });


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
                            responseJSON: result
                        };
                    }


                    const data =
                        result.data;


                    document.getElementById(
                        'edit-nama'
                    ).value =
                        data.nama || '';


                    document.getElementById(
                        'edit-jumlah'
                    ).value =
                        data.jumlah || '';


                    document.getElementById(
                        'edit-lokasi'
                    ).value =
                        data.lokasi || '';


                    document.getElementById(
                        'edit-deskripsi'
                    ).value =
                        data.deskripsi || '';


                    document.getElementById(
                        'edit-urutan'
                    ).value =
                        data.urutan ?? 0;


                    document.getElementById(
                        'edit-is-active'
                    ).checked =
                        Boolean(
                            data.is_active
                        );


                    editFoto.value = '';


                    const image =
                        document.getElementById(
                            'preview-edit'
                        );


                    const empty =
                        document.getElementById(
                            'preview-edit-empty'
                        );


                    if (data.foto) {

                        image.src =
                            imageUrl(data.foto);

                        image.style.display =
                            'block';

                        empty.style.display =
                            'none';

                    } else {

                        image.src = '';

                        image.style.display =
                            'none';

                        empty.style.display =
                            'block';
                    }


                    formEdit.dataset.id =
                        data.id;


                    modalEdit.show();


                } catch (error) {

                    showError(error);
                }
            }


            /* =====================================================
               CLICK EVENT
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
                            openEditModal(id);
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
                            deleteData(id);
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
                            toggleStatus(id);
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
                        new FormData(formEdit);


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

                                    body: formData
                                }
                            );


                        const result =
                            await response.json();


                        if (!response.ok) {

                            throw {
                                responseJSON: result
                            };
                        }


                        modalEdit.hide();


                        await table.replaceData();


                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text:
                                result.msg ||
                                'Fasilitas berhasil diperbarui.',
                            timer: 1800,
                            showConfirmButton: false
                        });


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

                const confirm =
                    await Swal.fire({

                        icon: 'warning',

                        title: 'Hapus Fasilitas?',

                        text:
                            'Data fasilitas yang dihapus tidak dapat dikembalikan.',

                        showCancelButton: true,

                        confirmButtonText:
                            'Ya, Hapus',

                        cancelButtonText:
                            'Batal',

                        confirmButtonColor:
                            '#dc3545'

                    });


                if (!confirm.isConfirmed) {
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
                            responseJSON: result
                        };
                    }


                    await table.replaceData();


                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text:
                            result.msg ||
                            'Fasilitas berhasil dihapus.',
                        timer: 1800,
                        showConfirmButton: false
                    });


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
                            responseJSON: result
                        };
                    }


                    await table.replaceData();


                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text:
                            result.msg ||
                            'Status fasilitas berhasil diperbarui.',
                        timer: 1500,
                        showConfirmButton: false
                    });


                } catch (error) {

                    showError(error);
                }
            }


            /* =========================================================
             * DRAG & DROP ORDER
             * ========================================================= */

            table.on(
                'rowMoved',
                async function () {

                    try {

                        /*
                         * =====================================================
                         * Ambil seluruh row dari Tabulator
                         * =====================================================
                         */
                        const rows = table.getRows();

                        const items = [];


                        /*
                         * =====================================================
                         * Update urutan di tampilan + siapkan data server
                         * =====================================================
                         */
                        rows.forEach(
                            function (row, index) {

                                const urutanBaru = index + 1;

                                const data = row.getData();


                                /*
                                 * Update nilai URUTAN langsung di Tabulator
                                 */
                                row.update({
                                    urutan: urutanBaru
                                });


                                /*
                                 * Data yang dikirim ke server
                                 */
                                items.push({
                                    id: data.id,
                                    urutan: urutanBaru
                                });

                            }
                        );


                        /*
                         * =====================================================
                         * Kirim ke server
                         * =====================================================
                         */
                        const response = await fetch(
                            orderUrl,
                            {
                                method: 'POST',

                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': csrfToken,
                                    'Accept': 'application/json'
                                },

                                body: JSON.stringify({
                                    items: items
                                })
                            }
                        );


                        /*
                         * =====================================================
                         * Ambil response JSON
                         * =====================================================
                         */
                        const result = await response.json();


                        /*
                         * =====================================================
                         * Cek response server
                         * =====================================================
                         */
                        if (!response.ok) {

                            throw {
                                responseJSON: result
                            };

                        }


                        /*
                         * =====================================================
                         * BERHASIL
                         *
                         * Tidak menampilkan Swal.
                         * =====================================================
                         */

                    } catch (error) {

                        console.error(
                            'Gagal menyimpan urutan:',
                            error
                        );


                        /*
                         * =====================================================
                         * HANYA JIKA GAGAL
                         * =====================================================
                         */
                        showValidationError(error);


                        /*
                         * Kembalikan data sesuai database
                         */
                        await table.replaceData();

                    }

                }
            );

        });

    </script>
@endsection
