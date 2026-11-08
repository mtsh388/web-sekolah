@extends('admin.template.admin')

@section('title', 'Berita')

@section('content-admin')

    {{-- ============================================================
        SUMMERNOTE
    ============================================================ --}}
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.css">

    <link href="{{ asset('assets/css/tabulator_bootstrap5.min.css') }}"
          rel="stylesheet">


    <div class="container-fluid mt-3">

        <div class="card">

            {{-- ========================================================
                HEADER
            ========================================================= --}}
            <div class="card-header">

                <div class="d-flex justify-content-between align-items-center">

                    <h3 class="card-title mb-0">
                        Berita Sekolah
                    </h3>

                    <button type="button"
                            class="btn btn-primary btn-sm"
                            id="btn-tambah-berita">

                        <i class="fa-solid fa-plus me-1"></i>

                        Tambah Berita

                    </button>

                </div>

            </div>


            {{-- ========================================================
                BODY
            ========================================================= --}}
            <div class="card-body">

                {{-- SUCCESS --}}
                @if(session('success'))

                    <div class="alert alert-success alert-dismissible fade show">

                        <i class="fa-solid fa-circle-check me-2"></i>

                        {{ session('success') }}

                        <button type="button"
                                class="btn-close"
                                data-bs-dismiss="alert">
                        </button>

                    </div>

                @endif


                {{-- ERROR --}}
                @if($errors->any())

                    <div class="alert alert-danger alert-dismissible fade show">

                        <ul class="mb-0">

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
                    TOOLBAR
                ==================================================== --}}
                <div class="d-flex flex-wrap gap-2 mb-3">

                    {{-- SEARCH --}}
                    <div class="input-group input-group-sm"
                         style="width: 16rem;">

                        <span class="input-group-text">

                            <i class="bi bi-search"></i>

                        </span>

                        <input type="search"
                               id="table-filter"
                               class="form-control"
                               placeholder="Filter rows..."
                               aria-label="Filter rows">

                    </div>


                    {{-- STATUS --}}
                    <select id="filter-status"
                            class="form-select form-select-sm"
                            style="width: 150px;">

                        <option value="">
                            Semua Status
                        </option>

                        <option value="published">
                            Published
                        </option>

                        <option value="draft">
                            Draft
                        </option>

                    </select>


                    {{-- FEATURED --}}
                    <select id="filter-featured"
                            class="form-select form-select-sm"
                            style="width: 150px;">

                        <option value="">
                            Semua Berita
                        </option>

                        <option value="1">
                            Featured
                        </option>

                        <option value="0">
                            Biasa
                        </option>

                    </select>


                    {{-- CSV --}}
                    <button id="export-csv"
                            type="button"
                            class="btn btn-sm btn-outline-secondary">

                        <i class="bi bi-filetype-csv me-1"></i>

                        Export CSV

                    </button>


                    {{-- JSON --}}
                    <button id="export-json"
                            type="button"
                            class="btn btn-sm btn-outline-secondary">

                        <i class="bi bi-filetype-json me-1"></i>

                        Export JSON

                    </button>


                    {{-- PRINT --}}
                    <button id="print-table"
                            type="button"
                            class="btn btn-sm btn-outline-secondary">

                        <i class="bi bi-printer me-1"></i>

                        Print

                    </button>

                </div>


                {{-- ====================================================
                    TABULATOR
                ==================================================== --}}
                <div id="berita-table"></div>

            </div>


            {{-- ========================================================
                FOOTER
            ========================================================= --}}
            <div class="card-footer text-secondary small">

                Powered by

                <a href="https://tabulator.info/"
                   target="_blank"
                   rel="noopener">

                    Tabulator

                </a>

                &mdash; vanilla JS.

            </div>

        </div>

    </div>


    {{-- ================================================================
        MODAL TAMBAH / EDIT BERITA
    ================================================================= --}}
    <div class="modal fade"
         id="modalBerita"
         tabindex="-1"
         aria-hidden="true">

        <div class="modal-dialog modal-xl modal-dialog-scrollable">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title"
                        id="modalBeritaTitle">

                        Tambah Berita

                    </h5>

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal">
                    </button>

                </div>


                <form id="formBerita"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf

                    <input type="hidden"
                           id="form-method"
                           value="POST">


                    <div class="modal-body">

                        <div class="row">

                            {{-- ==================================================
                                JUDUL
                            =================================================== --}}
                            <div class="col-md-8">

                                <div class="mb-3">

                                    <label for="title"
                                           class="form-label fw-semibold">

                                        Judul Berita

                                        <span class="text-danger">
                                            *
                                        </span>

                                    </label>

                                    <input type="text"
                                           name="title"
                                           id="title"
                                           class="form-control"
                                           maxlength="255"
                                           required>

                                </div>

                            </div>


                            {{-- ==================================================
                                KATEGORI
                            =================================================== --}}
                            <div class="col-md-4">

                                <div class="mb-3">

                                    <label for="category"
                                           class="form-label fw-semibold">

                                        Kategori

                                    </label>

                                    <input type="text"
                                           name="category"
                                           id="category"
                                           class="form-control"
                                           maxlength="255">

                                </div>

                            </div>


                            {{-- ==================================================
                                SLUG
                            =================================================== --}}
                            <div class="col-md-8">

                                <div class="mb-3">

                                    <label for="slug"
                                           class="form-label fw-semibold">

                                        Slug

                                    </label>

                                    <input type="text"
                                           name="slug"
                                           id="slug"
                                           class="form-control"
                                           maxlength="255">

                                </div>

                            </div>


                            {{-- ==================================================
                                STATUS
                            =================================================== --}}
                            <div class="col-md-4">

                                <div class="mb-3">

                                    <label for="status"
                                           class="form-label fw-semibold">

                                        Status

                                    </label>

                                    <select name="status"
                                            id="status"
                                            class="form-select">

                                        <option value="draft">
                                            Draft
                                        </option>

                                        <option value="published">
                                            Published
                                        </option>

                                    </select>

                                </div>

                            </div>


                            {{-- ==================================================
                                CONTENT / SUMMERNOTE
                            =================================================== --}}
                            <div class="col-12">

                                <div class="mb-3">

                                    <label for="content"
                                           class="form-label fw-semibold">

                                        Isi Berita

                                        <span class="text-danger">
                                            *
                                        </span>

                                    </label>

                                    <textarea name="content"
                                              id="content"
                                              class="form-control"
                                              required></textarea>

                                    <div class="form-text">

                                        Anda dapat menggunakan format teks,
                                        gambar, video, tabel, dan link.

                                    </div>

                                </div>

                            </div>


                            {{-- ==================================================
                                GAMBAR
                            =================================================== --}}
                            <div class="col-md-8">

                                <div class="mb-3">

                                    <label for="image"
                                           class="form-label fw-semibold">

                                        Gambar Berita

                                    </label>

                                    <input type="file"
                                           name="image"
                                           id="image"
                                           class="form-control"
                                           accept="image/*">

                                    <div class="form-text">

                                        Format JPG, JPEG, PNG, WEBP.

                                    </div>

                                    <div id="current-image"
                                         class="mt-2">
                                    </div>

                                </div>

                            </div>


                            {{-- ==================================================
                                PUBLISHED AT
                            =================================================== --}}
                            <div class="col-md-4">

                                <div class="mb-3">

                                    <label for="published_at"
                                           class="form-label fw-semibold">

                                        Tanggal Publikasi

                                    </label>

                                    <input type="datetime-local"
                                           name="published_at"
                                           id="published_at"
                                           class="form-control">

                                </div>

                            </div>


                            {{-- ==================================================
                                FEATURED
                            =================================================== --}}
                            <div class="col-md-6">

                                <div class="form-check form-switch">

                                    <input type="checkbox"
                                           name="is_featured"
                                           value="1"
                                           class="form-check-input"
                                           id="is_featured">

                                    <label class="form-check-label"
                                           for="is_featured">

                                        Jadikan Berita Featured

                                    </label>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- ====================================================
                        FOOTER MODAL
                    ===================================================== --}}
                    <div class="modal-footer">

                        <button type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal">

                            <i class="fa-solid fa-xmark me-1"></i>

                            Batal

                        </button>

                        <button type="submit"
                                class="btn btn-primary"
                                id="btn-simpan-berita">

                            <i class="fa-solid fa-save me-1"></i>

                            Simpan Berita

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    {{-- ================================================================
        JAVASCRIPT
    ================================================================= --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.js"></script>

    <script src="{{ asset('assets/js/tabulator.min.js') }}"></script>


    <script>

        document.addEventListener('DOMContentLoaded', function () {

            // ============================================================
            // URL
            // ============================================================

            const storeUrl =
                "{{ route('admin.berandas.berita.store') }}";

            const indexUrl =
                "{{ route('admin.berandas.berita.index') }}";


            // ============================================================
            // BOOTSTRAP MODAL
            // ============================================================

            const modalElement =
                document.getElementById('modalBerita');

            const modalBerita =
                new bootstrap.Modal(modalElement);


            // ============================================================
            // SUMMERNOTE
            // ============================================================

            $('#content').summernote({

                height: 500,

                minHeight: 300,

                placeholder:
                    'Tulis isi berita di sini...',

                dialogsInBody: true,

                toolbar: [

                    ['style', [
                        'style'
                    ]],

                    ['font', [
                        'bold',
                        'italic',
                        'underline',
                        'strikethrough',
                        'clear'
                    ]],

                    ['fontname', [
                        'fontname'
                    ]],

                    ['fontsize', [
                        'fontsize'
                    ]],

                    ['color', [
                        'color'
                    ]],

                    ['para', [
                        'ul',
                        'ol',
                        'paragraph'
                    ]],

                    ['table', [
                        'table'
                    ]],

                    ['insert', [
                        'link',
                        'picture',
                        'video'
                    ]],

                    ['view', [
                        'fullscreen',
                        'codeview',
                        'help'
                    ]]

                ]

            });


            // ============================================================
            // DATA
            // ============================================================

            const dataBerita =
                @json($beritas);


            // ============================================================
            // TABULATOR
            // ============================================================

            const table =
                new Tabulator('#berita-table', {

                    data: dataBerita,

                    layout: 'fitColumns',

                    pagination: true,

                    paginationSize: 10,

                    paginationSizeSelector: [
                        5,
                        10,
                        20,
                        50
                    ],

                    placeholder:
                        'Belum ada berita.',

                    columns: [

                        {
                            title: '#',

                            width: 55,

                            hozAlign: 'center',

                            headerSort: false,

                            formatter: function (cell) {

                                return cell
                                    .getRow()
                                    .getPosition(true);

                            }

                        },


                        // =================================================
                        // GAMBAR
                        // =================================================

                        {
                            title: 'Gambar',

                            field: 'image',

                            width: 110,

                            hozAlign: 'center',

                            headerHozAlign: 'center',

                            headerSort: false,

                            formatter: function (cell) {

                                const image =
                                    cell.getValue();

                                if (!image) {

                                    return `
                                        <div
                                            class="d-flex
                                                   align-items-center
                                                   justify-content-center
                                                   bg-light
                                                   rounded"
                                            style="
                                                width:75px;
                                                height:55px;
                                                margin:auto;
                                            "
                                        >

                                            <i class="
                                                fa-regular
                                                fa-image
                                                text-muted">
                                            </i>

                                        </div>
                                    `;

                                }

                                return `
                                    <img
                                        src="{{ asset('storage') }}/${escapeHtml(image)}"
                                        alt="Gambar berita"
                                        class="rounded"
                                        style="
                                            width:75px;
                                            height:55px;
                                            object-fit:cover;
                                        "
                                    >
                                `;

                            }

                        },


                        // =================================================
                        // JUDUL
                        // =================================================

                        {
                            title: 'Judul',

                            field: 'title',

                            minWidth: 250,

                            formatter: function (cell) {

                                const row =
                                    cell.getRow().getData();

                                return `
                                    <div>

                                        <div class="fw-semibold">
                                            ${escapeHtml(row.title ?? '')}
                                        </div>

                                        <small class="text-muted">
                                            ${escapeHtml(row.slug ?? '')}
                                        </small>

                                    </div>
                                `;

                            }

                        },


                        // =================================================
                        // KATEGORI
                        // =================================================

                        {
                            title: 'Kategori',

                            field: 'category',

                            width: 150,

                            formatter: function (cell) {

                                const value =
                                    cell.getValue();

                                if (!value) {

                                    return `
                                        <span class="text-muted">
                                            -
                                        </span>
                                    `;

                                }

                                return `
                                    <span class="badge text-bg-secondary">

                                        ${escapeHtml(value)}

                                    </span>
                                `;

                            }

                        },


                        // =================================================
                        // STATUS
                        // =================================================

                        {
                            title: 'Status',

                            field: 'status',

                            width: 120,

                            hozAlign: 'center',

                            formatter: function (cell) {

                                const status =
                                    cell.getValue();

                                if (
                                    status === 'published'
                                ) {

                                    return `
                                        <span class="badge text-bg-success">

                                            <i class="
                                                fa-solid
                                                fa-circle-check
                                                me-1">
                                            </i>

                                            Published

                                        </span>
                                    `;

                                }

                                return `
                                    <span class="badge text-bg-warning">

                                        <i class="
                                            fa-solid
                                            fa-file-pen
                                            me-1">
                                        </i>

                                        Draft

                                    </span>
                                `;

                            }

                        },


                        // =================================================
                        // FEATURED
                        // =================================================

                        {
                            title: 'Featured',

                            field: 'is_featured',

                            width: 110,

                            hozAlign: 'center',

                            formatter: function (cell) {

                                const featured =
                                    cell.getValue();

                                if (
                                    featured === true ||
                                    featured === 1 ||
                                    featured === '1'
                                ) {

                                    return `
                                        <span class="badge text-bg-primary">

                                            <i class="
                                                fa-solid
                                                fa-star
                                                me-1">
                                            </i>

                                            Ya

                                        </span>
                                    `;

                                }

                                return `
                                    <span class="text-muted">
                                        Tidak
                                    </span>
                                `;

                            }

                        },


                        // =================================================
                        // VIEWS
                        // =================================================

                        {
                            title: 'Views',

                            field: 'views',

                            width: 100,

                            hozAlign: 'center',

                            formatter: function (cell) {

                                const value =
                                    Number(
                                        cell.getValue() ?? 0
                                    );

                                return `
                                    <i class="
                                        fa-regular
                                        fa-eye
                                        text-muted
                                        me-1">
                                    </i>

                                    ${value.toLocaleString('id-ID')}
                                `;

                            }

                        },


                        // =================================================
                        // PUBLISHED
                        // =================================================

                        {
                            title: 'Published',

                            field: 'published_at',

                            width: 150,

                            formatter: function (cell) {

                                const value =
                                    cell.getValue();

                                if (!value) {

                                    return `
                                        <span class="text-muted">
                                            -
                                        </span>
                                    `;

                                }

                                const date =
                                    new Date(value);

                                return date.toLocaleDateString(
                                    'id-ID',
                                    {
                                        day: '2-digit',
                                        month: 'short',
                                        year: 'numeric'
                                    }
                                );

                            }

                        },


                        // =================================================
                        // AKSI
                        // =================================================

                        {
                            title: 'Aksi',

                            width: 150,

                            minWidth: 150,

                            hozAlign: 'center',

                            headerHozAlign: 'center',

                            frozen: true,

                            headerSort: false,

                            formatter: function (cell) {

                                const rowData =
                                    cell.getRow().getData();

                                const id =
                                    rowData.id;

                                return `
                                    <div class="
                                        d-flex
                                        justify-content-center
                                        gap-1">

                                        <a
                                            href="{{ url('/admin/berandas/berita') }}/${id}"
                                            class="btn btn-sm btn-info"
                                            title="Detail">

                                            <i class="
                                                fa-solid
                                                fa-eye">
                                            </i>

                                        </a>


                                        <button
                                            type="button"
                                            class="btn btn-sm btn-warning btn-edit-berita"
                                            data-id="${id}"
                                            title="Edit">

                                            <i class="
                                                fa-solid
                                                fa-pen">
                                            </i>

                                        </button>


                                        <button
                                            type="button"
                                            class="btn btn-sm btn-danger btn-delete-berita"
                                            data-id="${id}"
                                            title="Hapus">

                                            <i class="
                                                fa-solid
                                                fa-trash">
                                            </i>

                                        </button>

                                    </div>
                                `;

                            }

                        }

                    ]

                });


            // ============================================================
            // TAMBAH BERITA
            // ============================================================

            document
                .getElementById('btn-tambah-berita')
                .addEventListener(
                    'click',
                    function () {

                        resetForm();

                        document
                            .getElementById('modalBeritaTitle')
                            .textContent =
                            'Tambah Berita';

                        document
                            .getElementById('formBerita')
                            .action =
                            storeUrl;

                        document
                            .getElementById('form-method')
                            .value =
                            'POST';

                        modalBerita.show();

                    }
                );


            // ============================================================
            // EDIT
            // ============================================================

            document.addEventListener(
                'click',
                async function (event) {

                    const button =
                        event.target.closest(
                            '.btn-edit-berita'
                        );

                    if (!button) {
                        return;
                    }

                    const id =
                        button.dataset.id;

                    try {

                        const response =
                            await fetch(
                                `${indexUrl}/${id}/edit`,
                                {
                                    headers: {
                                        'Accept':
                                            'application/json'
                                    }
                                }
                            );

                        const result =
                            await response.json();

                        if (!result.success) {

                            throw new Error(
                                result.message ??
                                'Gagal mengambil data berita.'
                            );

                        }

                        const data =
                            result.data;

                        document
                            .getElementById('modalBeritaTitle')
                            .textContent =
                            'Edit Berita';

                        document
                            .getElementById('formBerita')
                            .action =
                            `${indexUrl}/${id}`;

                        document
                            .getElementById('form-method')
                            .value =
                            'PUT';

                        document
                            .getElementById('title')
                            .value =
                            data.title ?? '';

                        document
                            .getElementById('slug')
                            .value =
                            data.slug ?? '';

                        document
                            .getElementById('category')
                            .value =
                            data.category ?? '';

                        document
                            .getElementById('status')
                            .value =
                            data.status ?? 'draft';

                        document
                            .getElementById('published_at')
                            .value =
                            formatDateTimeLocal(
                                data.published_at
                            );

                        document
                            .getElementById('is_featured')
                            .checked =
                            data.is_featured == 1 ||
                            data.is_featured === true;

                        $('#content')
                            .summernote(
                                'code',
                                data.content ?? ''
                            );


                        // CURRENT IMAGE

                        const currentImage =
                            document.getElementById(
                                'current-image'
                            );

                        if (data.image) {

                            currentImage.innerHTML = `
                                <div class="small text-muted mb-1">
                                    Gambar saat ini:
                                </div>

                                <img
                                    src="{{ asset('storage') }}/${escapeHtml(data.image)}"
                                    class="rounded"
                                    style="
                                        max-width:150px;
                                        max-height:100px;
                                        object-fit:cover;
                                    "
                                >
                            `;

                        } else {

                            currentImage.innerHTML = '';

                        }


                        modalBerita.show();

                    } catch (error) {

                        console.error(error);

                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: error.message
                        });

                    }

                }
            );


            // ============================================================
            // SUBMIT FORM
            // ============================================================

            document
                .getElementById('formBerita')
                .addEventListener(
                    'submit',
                    async function (event) {

                        event.preventDefault();

                        const form =
                            this;

                        const method =
                            document
                                .getElementById('form-method')
                                .value;

                        const formData =
                            new FormData(form);

                        formData.set(
                            'content',
                            $('#content').summernote('code')
                        );

                        if (method === 'PUT') {

                            formData.append(
                                '_method',
                                'PUT'
                            );

                        }

                        const button =
                            document.getElementById(
                                'btn-simpan-berita'
                            );

                        button.disabled = true;

                        button.innerHTML = `
                            <span
                                class="spinner-border
                                       spinner-border-sm
                                       me-1">
                            </span>

                            Menyimpan...
                        `;


                        try {

                            const response =
                                await fetch(
                                    form.action,
                                    {
                                        method: 'POST',

                                        body: formData,

                                        headers: {
                                            'Accept':
                                                'application/json',

                                            'X-CSRF-TOKEN':
                                                document
                                                    .querySelector(
                                                        'meta[name="csrf-token"]'
                                                    )
                                                    ?.getAttribute(
                                                        'content'
                                                    ) ??
                                                '{{ csrf_token() }}'
                                        }
                                    }
                                );

                            const result =
                                await response.json();


                            if (!response.ok) {

                                if (
                                    result.errors
                                ) {

                                    const messages =
                                        Object.values(
                                            result.errors
                                        )
                                            .flat()
                                            .join('\n');

                                    throw new Error(
                                        messages
                                    );

                                }

                                throw new Error(
                                    result.message ??
                                    'Gagal menyimpan berita.'
                                );

                            }


                            await Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text:
                                    result.message ??
                                    'Berita berhasil disimpan.',
                                timer: 1500,
                                showConfirmButton: false
                            });


                            modalBerita.hide();

                            window.location.reload();


                        } catch (error) {

                            console.error(error);

                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: error.message
                            });

                        } finally {

                            button.disabled = false;

                            button.innerHTML = `
                                <i class="fa-solid fa-save me-1"></i>
                                Simpan Berita
                            `;

                        }

                    }
                );


            // ============================================================
            // DELETE
            // ============================================================

            document.addEventListener(
                'click',
                async function (event) {

                    const button =
                        event.target.closest(
                            '.btn-delete-berita'
                        );

                    if (!button) {
                        return;
                    }

                    const id =
                        button.dataset.id;


                    const confirmation =
                        await Swal.fire({

                            icon: 'warning',

                            title: 'Hapus Berita?',

                            text:
                                'Berita yang dihapus tidak dapat dikembalikan.',

                            showCancelButton: true,

                            confirmButtonText:
                                'Ya, Hapus',

                            cancelButtonText:
                                'Batal',

                            confirmButtonColor:
                                '#dc3545'

                        });


                    if (!confirmation.isConfirmed) {
                        return;
                    }


                    try {

                        const formData =
                            new FormData();

                        formData.append(
                            '_method',
                            'DELETE'
                        );


                        const response =
                            await fetch(
                                `${indexUrl}/${id}`,
                                {
                                    method: 'POST',

                                    body: formData,

                                    headers: {
                                        'Accept':
                                            'application/json',

                                        'X-CSRF-TOKEN':
                                            document
                                                .querySelector(
                                                    'meta[name="csrf-token"]'
                                                )
                                                ?.getAttribute(
                                                    'content'
                                                ) ??
                                            '{{ csrf_token() }}'
                                    }
                                }
                            );


                        const result =
                            await response.json();


                        if (!response.ok) {

                            throw new Error(
                                result.message ??
                                'Gagal menghapus berita.'
                            );

                        }


                        await Swal.fire({

                            icon: 'success',

                            title: 'Berhasil',

                            text:
                                result.message ??
                                'Berita berhasil dihapus.',

                            timer: 1500,

                            showConfirmButton: false

                        });


                        window.location.reload();


                    } catch (error) {

                        console.error(error);

                        Swal.fire({

                            icon: 'error',

                            title: 'Gagal',

                            text: error.message

                        });

                    }

                }
            );


            // ============================================================
            // SEARCH
            // ============================================================

            document
                .getElementById('table-filter')
                .addEventListener(
                    'keyup',
                    function () {

                        applyFilters();

                    }
                );


            // ============================================================
            // STATUS
            // ============================================================

            document
                .getElementById('filter-status')
                .addEventListener(
                    'change',
                    function () {

                        applyFilters();

                    }
                );


            // ============================================================
            // FEATURED
            // ============================================================

            document
                .getElementById('filter-featured')
                .addEventListener(
                    'change',
                    function () {

                        applyFilters();

                    }
                );


            // ============================================================
            // FILTER
            // ============================================================

            function applyFilters() {

                const search =
                    document
                        .getElementById('table-filter')
                        .value
                        .trim()
                        .toLowerCase();


                const status =
                    document
                        .getElementById('filter-status')
                        .value;


                const featured =
                    document
                        .getElementById('filter-featured')
                        .value;


                table.clearFilter();


                table.setFilter(function (data) {

                    if (search) {

                        const title =
                            (data.title ?? '')
                                .toLowerCase();

                        const slug =
                            (data.slug ?? '')
                                .toLowerCase();

                        const category =
                            (data.category ?? '')
                                .toLowerCase();

                        const content =
                            (data.content ?? '')
                                .toLowerCase();

                        if (
                            !title.includes(search) &&
                            !slug.includes(search) &&
                            !category.includes(search) &&
                            !content.includes(search)
                        ) {

                            return false;

                        }

                    }


                    if (
                        status &&
                        data.status !== status
                    ) {

                        return false;

                    }


                    if (featured !== '') {

                        const isFeatured =
                            data.is_featured == 1
                                ? '1'
                                : '0';

                        if (
                            isFeatured !== featured
                        ) {

                            return false;

                        }

                    }


                    return true;

                });

            }


            // ============================================================
            // EXPORT CSV
            // ============================================================

            document
                .getElementById('export-csv')
                .addEventListener(
                    'click',
                    function () {

                        table.download(
                            'csv',
                            'berita.csv'
                        );

                    }
                );


            // ============================================================
            // EXPORT JSON
            // ============================================================

            document
                .getElementById('export-json')
                .addEventListener(
                    'click',
                    function () {

                        table.download(
                            'json',
                            'berita.json'
                        );

                    }
                );


            // ============================================================
            // PRINT
            // ============================================================

            document
                .getElementById('print-table')
                .addEventListener(
                    'click',
                    function () {

                        table.print(
                            false,
                            true
                        );

                    }
                );


            // ============================================================
            // RESET FORM
            // ============================================================

            function resetForm() {

                const form =
                    document.getElementById(
                        'formBerita'
                    );

                form.reset();

                document
                    .getElementById('form-method')
                    .value =
                    'POST';

                document
                    .getElementById('formBerita')
                    .action =
                    storeUrl;

                document
                    .getElementById('current-image')
                    .innerHTML =
                    '';

                $('#content')
                    .summernote(
                        'code',
                        ''
                    );

                document
                    .getElementById('status')
                    .value =
                    'draft';

            }


            // ============================================================
            // FORMAT DATETIME
            // ============================================================

            function formatDateTimeLocal(value) {

                if (!value) {
                    return '';
                }

                const date =
                    new Date(value);

                if (isNaN(date.getTime())) {
                    return '';
                }

                const year =
                    date.getFullYear();

                const month =
                    String(
                        date.getMonth() + 1
                    ).padStart(2, '0');

                const day =
                    String(
                        date.getDate()
                    ).padStart(2, '0');

                const hours =
                    String(
                        date.getHours()
                    ).padStart(2, '0');

                const minutes =
                    String(
                        date.getMinutes()
                    ).padStart(2, '0');

                return `${year}-${month}-${day}T${hours}:${minutes}`;

            }


            // ============================================================
            // ESCAPE HTML
            // ============================================================

            function escapeHtml(value) {

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
