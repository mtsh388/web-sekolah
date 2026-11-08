@extends('admin.template.admin')

@section('title', 'Berita')

@section('content-admin')

    {{-- =========================================================
         TABULATOR CSS
    ========================================================== --}}
    <link
        href="https://unpkg.com/tabulator-tables@6.3.1/dist/css/tabulator_bootstrap5.min.css"
        rel="stylesheet">


    {{-- =========================================================
         SUMMERNOTE CSS
    ========================================================== --}}
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css">


    {{-- =========================================================
         CUSTOM CSS
    ========================================================== --}}
    <style>

        /* =========================================================
         * SUMMERNOTE
        ========================================================= */

        .note-editor {
            border-radius: 0.375rem;
            border: 1px solid #dee2e6;
        }

        .note-editor .note-toolbar {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
        }

        .note-editor .note-editable {
            background-color: #ffffff;
            color: #212529;
            min-height: 400px;
            font-size: 1rem;
            line-height: 1.8;
        }

        .note-editor .note-statusbar {
            background-color: #f8f9fa;
        }

        /*
         * Penting untuk dialog Summernote di dalam
         * Bootstrap Modal
         */

        .note-modal-backdrop {
            z-index: 1055 !important;
        }

        .note-modal {
            z-index: 1060 !important;
        }

        .note-popover {
            z-index: 1070 !important;
        }

        .note-editor .note-editable a {
            color: #0083b4;
            text-decoration: underline;
        }

        .note-editor .note-editable img {
            max-width: 100%;
            height: auto;
        }


        /* =========================================================
         * FORM SECTION
        ========================================================== */

        .berita-form-section {
            background: #fff;
            border: 1px solid #e9ecef;
            border-radius: 0.75rem;
            padding: 1.25rem;
            height: 100%;
        }

        .berita-form-section-title {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1.25rem;
            padding-bottom: 0.85rem;
            border-bottom: 1px solid #e9ecef;
        }

        .berita-form-section-title .section-icon {
            width: 40px;
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.5rem;
            background: rgba(0, 131, 180, 0.1);
            color: #0083b4;
            flex-shrink: 0;
        }

        .berita-form-section-title strong {
            display: block;
            font-size: 0.95rem;
        }

        .berita-form-section-title small {
            display: block;
            color: #6c757d;
            margin-top: 0.15rem;
        }


        /* =========================================================
         * UPLOAD
        ========================================================== */

        .berita-upload-box {
            border: 1px dashed #ced4da;
            border-radius: 0.75rem;
            padding: 1rem;
            background: #f8f9fa;
        }

        .image-preview-box {
            margin-top: 1rem;
            text-align: center;
            padding: 0.75rem;
            border: 1px solid #dee2e6;
            border-radius: 0.5rem;
            background: #fff;
        }

        .image-preview-box img {
            max-width: 100%;
            max-height: 250px;
            object-fit: contain;
            border-radius: 0.5rem;
        }


        /* =========================================================
         * STATUS
        ========================================================== */

        .berita-status-box {
            padding: 0.75rem;
            border-radius: 0.5rem;
            background: #f8f9fa;
            border: 1px solid #e9ecef;
        }


        /* =========================================================
         * FEATURED
        ========================================================== */

        .berita-featured-box {
            padding: 0.85rem 1rem;
            border-radius: 0.5rem;
            background: #fff9e6;
            border: 1px solid #ffe69c;
        }


        /* =========================================================
         * MODAL
        ========================================================== */

        .modal-berita .modal-dialog {
            width: calc(100% - 2rem);
            max-width: 1400px;
            height: calc(100vh - 2rem);
            margin: 1rem auto;
        }

        .modal-berita .modal-content {
            height: 100%;
            max-height: 100%;
            border: 0;
            border-radius: 0.85rem;
            overflow: hidden;

            display: flex;
            flex-direction: column;
        }


        /* =========================================================
         * MODAL HEADER
        ========================================================== */

        .modal-berita .modal-header {
            flex-shrink: 0;
            background: #fff;
            border-bottom: 1px solid #e9ecef;
        }


        /* =========================================================
         * MODAL BODY
        ========================================================== */

        .modal-berita .modal-body {
            flex: 1 1 auto;
            min-height: 0;
            overflow-y: auto;
            overflow-x: hidden;
            padding: 1.25rem;
        }


        /* =========================================================
         * SCROLLBAR
        ========================================================== */

        .modal-berita .modal-body::-webkit-scrollbar {
            width: 8px;
        }

        .modal-berita .modal-body::-webkit-scrollbar-track {
            background: #f1f3f5;
        }

        .modal-berita .modal-body::-webkit-scrollbar-thumb {
            background: #adb5bd;
            border-radius: 10px;
        }

        .modal-berita .modal-body::-webkit-scrollbar-thumb:hover {
            background: #868e96;
        }


        /* =========================================================
         * MODAL FOOTER
        ========================================================== */

        .modal-berita .modal-footer {
            flex-shrink: 0;
            background: #f8f9fa;
            border-top: 1px solid #e9ecef;
            padding: 0.75rem 1.25rem;
            position: relative;
            z-index: 10;
        }


        /* =========================================================
         * FORM SECTION
        ========================================================== */

        .modal-berita .berita-form-section {
            height: auto;
            min-height: 100%;
        }


        /* =========================================================
         * SUMMERNOTE
        ========================================================== */

        .modal-berita .note-editor {
            width: 100%;
        }

        .modal-berita .note-editor .note-editable {
            min-height: 300px;
            max-height: 450px;
            overflow-y: auto;
        }


        /* =========================================================
         * MOBILE
        ========================================================== */

        @media (max-width: 768px) {

            .modal-berita .modal-dialog {
                width: calc(100% - 1rem);
                height: calc(100vh - 1rem);
                margin: 0.5rem auto;
            }

            .modal-berita .modal-body {
                padding: 1rem;
            }

            .modal-berita .note-editor .note-editable {
                min-height: 250px;
                max-height: 350px;
            }

            .berita-form-section {
                padding: 1rem;
            }

        }

    </style>


    {{-- =========================================================
         MAIN CONTAINER
    ========================================================== --}}

    <div class="container-fluid">

        {{-- =====================================================
             HEADER
        ====================================================== --}}

        <div class="app-content-header">

            <div class="container-fluid mt-3">

                <div class="row">

                    <div class="col-sm-6">

                        <h1 class="mb-0 fs-3">
                            Berita
                        </h1>

                    </div>

                    <div class="col-sm-6">

                        <ol class="breadcrumb float-sm-end">

                            <li class="breadcrumb-item">
                                Admin
                            </li>

                            <li class="breadcrumb-item active">
                                Berita
                            </li>

                        </ol>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
             CONTENT
        ====================================================== --}}

        <div class="app-content">

            <div class="container-fluid">

                <div class="card border-0 shadow-sm">

                    {{-- =================================================
                         CARD HEADER
                    ================================================== --}}

                    <div class="card-header bg-white">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <h5 class="mb-1">

                                    <i class="fa-solid fa-newspaper me-2"></i>

                                    Data Berita

                                </h5>

                                <small class="text-muted">
                                    Kelola berita website
                                </small>

                            </div>

                            <button
                                type="button"
                                class="btn btn-primary"
                                id="btnTambah">

                                <i class="fa-solid fa-plus me-1"></i>

                                Tambah Berita

                            </button>

                        </div>

                    </div>


                    {{-- =================================================
                         TABLE
                    ================================================== --}}

                    <div class="card-body">

                        <div id="table-berita"></div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         MODAL TAMBAH
    ========================================================== --}}

    <form
        id="formTambah"
        enctype="multipart/form-data">

        <div
            class="modal fade modal-berita"
            id="modalTambah"
            tabindex="-1"
            aria-labelledby="modalTambahLabel"
            aria-hidden="true">

            <div class="modal-dialog modal-xl modal-dialog-centered">

                <div class="modal-content">

                    {{-- HEADER --}}

                    <div class="modal-header">

                        <div>

                            <h5
                                class="modal-title mb-1"
                                id="modalTambahLabel">

                                <i class="fa-solid fa-plus me-1"></i>

                                Tambah Berita

                            </h5>

                            <small class="text-muted">
                                Tambahkan berita baru untuk website
                            </small>

                        </div>

                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                        </button>

                    </div>


                    {{-- BODY --}}

                    <div class="modal-body">

                        <div class="row g-3">

                            {{-- KOLOM KIRI --}}

                            <div class="col-lg-8">

                                <div class="berita-form-section">

                                    <div class="berita-form-section-title">

                                    <span class="section-icon">
                                        <i class="fa-solid fa-newspaper"></i>
                                    </span>

                                        <div>

                                            <strong>
                                                Informasi Berita
                                            </strong>

                                            <small>
                                                Isi informasi utama berita
                                            </small>

                                        </div>

                                    </div>


                                    {{-- JUDUL --}}

                                    <div class="mb-3">

                                        <label class="form-label">

                                            Judul Berita

                                            <span class="text-danger">
                                            *
                                        </span>

                                        </label>

                                        <input
                                            type="text"
                                            name="title"
                                            class="form-control"
                                            maxlength="255"
                                            placeholder="Masukkan judul berita..."
                                            required>

                                    </div>


                                    {{-- KATEGORI --}}

                                    <div class="mb-3">

                                        <label class="form-label">
                                            Kategori
                                        </label>

                                        <input
                                            type="text"
                                            name="category"
                                            class="form-control"
                                            maxlength="255"
                                            placeholder="Contoh: Pendidikan, Prestasi, Kegiatan">

                                    </div>


                                    {{-- CONTENT --}}

                                    <div>

                                        <label class="form-label">

                                            Isi Berita

                                            <span class="text-danger">
                                            *
                                        </span>

                                        </label>

                                        <textarea
                                            name="content"
                                            id="tambah-content"
                                            class="form-control"
                                            placeholder="Tulis isi berita di sini..."
                                            required></textarea>

                                        <div class="form-text">

                                            Anda dapat menggunakan format teks, link, gambar,
                                            video, tabel, daftar dan lainnya.

                                        </div>

                                    </div>

                                </div>

                            </div>


                            {{-- KOLOM KANAN --}}

                            <div class="col-lg-4">

                                <div class="berita-form-section">

                                    <div class="berita-form-section-title">

                                    <span class="section-icon">
                                        <i class="fa-solid fa-sliders"></i>
                                    </span>

                                        <div>

                                            <strong>
                                                Pengaturan
                                            </strong>

                                            <small>
                                                Atur media, gambar, dan publikasi
                                            </small>

                                        </div>

                                    </div>


                                    {{-- LINK YOUTUBE --}}
                                    <div class="mb-4">

                                        <label class="form-label">
                                            <i class="fa-brands fa-youtube text-danger me-1"></i>
                                            Link Video YouTube
                                        </label>

                                        <input
                                            type="url"
                                            name="youtube_url"
                                            id="tambah-youtube-url"
                                            class="form-control"
                                            placeholder="https://youtube.com/watch?v=...">

                                        <div class="form-text">
                                            Opsional. Jika diisi, akan diprioritaskan sebagai media utama berita.
                                        </div>

                                    </div>


                                    {{-- GAMBAR --}}

                                    <div class="mb-4">

                                        <label class="form-label">
                                            Gambar Utama
                                        </label>

                                        <div class="berita-upload-box">

                                            <input
                                                type="file"
                                                name="image"
                                                id="tambah-image"
                                                class="form-control"
                                                accept="image/jpeg,image/png,image/webp">

                                            <div class="form-text">

                                                JPG, PNG, WEBP.
                                                Maksimal 2 MB.

                                            </div>

                                            <div
                                                class="image-preview-box d-none"
                                                id="tambah-preview-container">

                                                <img
                                                    id="tambah-preview"
                                                    src=""
                                                    alt="Preview gambar">

                                            </div>

                                        </div>

                                    </div>


                                    {{-- STATUS --}}

                                    <div class="mb-3">

                                        <label class="form-label">
                                            Status Berita
                                        </label>

                                        <div class="berita-status-box">

                                            <select
                                                name="status"
                                                id="tambah-status"
                                                class="form-select">

                                                <option value="draft">
                                                    Draft
                                                </option>

                                                <option value="published">
                                                    Published
                                                </option>

                                                <option value="archived">
                                                    Archived
                                                </option>

                                            </select>

                                        </div>

                                    </div>


                                    {{-- PUBLISHED AT --}}

                                    <div class="mb-3">

                                        <label class="form-label">
                                            Tanggal Publikasi
                                        </label>

                                        <input
                                            type="datetime-local"
                                            name="published_at"
                                            id="tambah-published-at"
                                            class="form-control">

                                        <div class="form-text">
                                            Kosongkan jika belum dipublikasikan.
                                        </div>

                                    </div>


                                    {{-- FEATURED --}}

                                    <div class="berita-featured-box">

                                        <div class="form-check">

                                            <input
                                                type="checkbox"
                                                name="is_featured"
                                                value="1"
                                                class="form-check-input"
                                                id="tambah-featured">

                                            <label
                                                class="form-check-label"
                                                for="tambah-featured">

                                                <i class="fa-solid fa-star text-warning me-1"></i>

                                                Jadikan berita unggulan

                                            </label>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- FOOTER --}}

                    <div class="modal-footer">

                        <button
                            type="button"
                            class="btn btn-light border"
                            data-bs-dismiss="modal">

                            <i class="fa-solid fa-xmark me-1"></i>

                            Batal

                        </button>

                        <button
                            type="submit"
                            class="btn btn-primary">

                            <i class="fa-solid fa-save me-1"></i>

                            Simpan Berita

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </form>


    {{-- =========================================================
         MODAL EDIT
    ========================================================== --}}

    <form
        id="formEdit"
        enctype="multipart/form-data">

        <div
            class="modal fade modal-berita"
            id="modalEdit"
            tabindex="-1"
            aria-labelledby="modalEditLabel"
            aria-hidden="true">

            <div class="modal-dialog modal-xl modal-dialog-centered">

                <div class="modal-content">

                    {{-- HEADER --}}

                    <div class="modal-header">

                        <div class="modal-title-wrapper">

                            <div class="modal-title-icon">

                                <i class="fa-solid fa-pen-to-square"></i>

                            </div>

                            <div>

                                <h5
                                    class="modal-title"
                                    id="modalEditLabel">

                                    Edit Berita

                                </h5>

                                <span class="modal-subtitle">
                                Perbarui informasi berita
                            </span>

                            </div>

                        </div>

                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Tutup">
                        </button>

                    </div>


                    {{-- BODY --}}

                    <div class="modal-body">

                        <div class="row g-3">

                            {{-- KOLOM KIRI --}}

                            <div class="col-lg-8">

                                <div class="berita-form-section">

                                    <div class="berita-form-section-title">

                                    <span class="section-icon">
                                        <i class="fa-solid fa-newspaper"></i>
                                    </span>

                                        <div>

                                            <strong>
                                                Informasi Berita
                                            </strong>

                                            <small>
                                                Perbarui informasi utama berita
                                            </small>

                                        </div>

                                    </div>


                                    {{-- JUDUL --}}

                                    <div class="mb-3">

                                        <label class="form-label">

                                            Judul Berita

                                            <span class="text-danger">
                                            *
                                        </span>

                                        </label>

                                        <input
                                            type="text"
                                            name="title"
                                            id="edit-title"
                                            class="form-control"
                                            maxlength="255"
                                            placeholder="Masukkan judul berita..."
                                            required>

                                    </div>


                                    {{-- KATEGORI --}}

                                    <div class="mb-3">

                                        <label class="form-label">
                                            Kategori
                                        </label>

                                        <input
                                            type="text"
                                            name="category"
                                            id="edit-category"
                                            class="form-control"
                                            maxlength="255"
                                            placeholder="Contoh: Pendidikan, Prestasi, Kegiatan">

                                    </div>


                                    {{-- CONTENT --}}

                                    <div>

                                        <label class="form-label">

                                            Isi Berita

                                            <span class="text-danger">
                                            *
                                        </span>

                                        </label>

                                        <textarea
                                            name="content"
                                            id="edit-content"
                                            class="form-control"
                                            placeholder="Tulis isi berita di sini..."
                                            required></textarea>

                                        <div class="form-text">

                                            Anda dapat menggunakan format teks, link, gambar,
                                            video, tabel, daftar dan lainnya.

                                        </div>

                                    </div>

                                </div>

                            </div>


                            {{-- KOLOM KANAN --}}

                            <div class="col-lg-4">

                                <div class="berita-form-section">

                                    <div class="berita-form-section-title">

                                    <span class="section-icon">
                                        <i class="fa-solid fa-sliders"></i>
                                    </span>

                                        <div>

                                            <strong>
                                                Pengaturan
                                            </strong>

                                            <small>
                                                Atur media, gambar, dan publikasi
                                            </small>

                                        </div>

                                    </div>


                                    {{-- LINK YOUTUBE --}}
                                    <div class="mb-4">

                                        <label class="form-label">
                                            <i class="fa-brands fa-youtube text-danger me-1"></i>
                                            Link Video YouTube
                                        </label>

                                        <input
                                            type="url"
                                            name="youtube_url"
                                            id="edit-youtube-url"
                                            class="form-control"
                                            placeholder="https://youtube.com/watch?v=...">

                                        <div class="form-text">
                                            Opsional. Jika diisi, akan diprioritaskan sebagai media utama berita.
                                        </div>

                                    </div>


                                    {{-- GAMBAR --}}

                                    <div class="mb-4">

                                        <label class="form-label">
                                            Gambar Utama
                                        </label>

                                        <div class="berita-upload-box">

                                            <input
                                                type="file"
                                                name="image"
                                                id="edit-image"
                                                class="form-control"
                                                accept="image/jpeg,image/png,image/webp">

                                            <div class="form-text">

                                                Kosongkan jika tidak ingin mengganti gambar.

                                            </div>

                                            <div
                                                class="image-preview-box d-none"
                                                id="edit-preview-container">

                                                <img
                                                    id="edit-preview"
                                                    src=""
                                                    alt="Preview gambar">

                                            </div>

                                        </div>

                                    </div>


                                    {{-- STATUS --}}

                                    <div class="mb-3">

                                        <label class="form-label">
                                            Status Berita
                                        </label>

                                        <div class="berita-status-box">

                                            <select
                                                name="status"
                                                id="edit-status"
                                                class="form-select">

                                                <option value="draft">
                                                    Draft
                                                </option>

                                                <option value="published">
                                                    Published
                                                </option>

                                                <option value="archived">
                                                    Archived
                                                </option>

                                            </select>

                                        </div>

                                    </div>


                                    {{-- TANGGAL --}}

                                    <div class="mb-3">

                                        <label class="form-label">
                                            Tanggal Publikasi
                                        </label>

                                        <input
                                            type="datetime-local"
                                            name="published_at"
                                            id="edit-published-at"
                                            class="form-control">

                                    </div>


                                    {{-- FEATURED --}}

                                    <div class="berita-featured-box">

                                        <div class="form-check">

                                            <input
                                                type="checkbox"
                                                name="is_featured"
                                                value="1"
                                                class="form-check-input"
                                                id="edit-featured">

                                            <label
                                                class="form-check-label"
                                                for="edit-featured">

                                                <i class="fa-solid fa-star text-warning me-1"></i>

                                                Jadikan berita unggulan

                                            </label>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- FOOTER --}}

                    <div class="modal-footer">

                        <button
                            type="button"
                            class="btn btn-light border"
                            data-bs-dismiss="modal">

                            <i class="fa-solid fa-xmark me-1"></i>

                            Batal

                        </button>

                        <button
                            type="submit"
                            class="btn btn-primary">

                            <i class="fa-solid fa-save me-1"></i>

                            Simpan Perubahan

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </form>


    {{-- =========================================================
         SUMMERNOTE JS
    ========================================================== --}}

    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>


    {{-- =========================================================
         TABULATOR JS
    ========================================================== --}}

    <script src="https://unpkg.com/tabulator-tables@6.3.1/dist/js/tabulator.min.js"></script>


    {{-- =========================================================
         MAIN JAVASCRIPT
    ========================================================== --}}

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            /* =====================================================
             * CHECK DEPENDENCIES
             * ===================================================== */

            if (typeof $ === 'undefined') {
                console.error('jQuery belum dimuat.');
                return;
            }

            if (typeof $.fn.summernote === 'undefined') {
                console.error('Summernote belum dimuat.');
                return;
            }

            if (typeof Tabulator === 'undefined') {
                console.error('Tabulator belum dimuat.');
                return;
            }

            if (
                typeof bootstrap === 'undefined' ||
                typeof bootstrap.Modal === 'undefined'
            ) {
                console.error('Bootstrap Modal belum dimuat.');
                return;
            }

            if (typeof Swal === 'undefined') {
                console.error('SweetAlert2 belum dimuat.');
                return;
            }


            /* =====================================================
             * CSRF
             * ===================================================== */

            const csrfElement =
                document.querySelector(
                    'meta[name="csrf-token"]'
                );


            if (!csrfElement) {
                console.error('Meta csrf-token tidak ditemukan.');
                return;
            }

            const csrfToken =
                csrfElement.getAttribute('content');


            /* =====================================================
             * URL
             * ===================================================== */

            const dataUrl =
                @json(route('admin.berita.data'));

            const storeUrl =
                @json(route('admin.berita.store'));

            const summernoteUploadUrl =
                @json(route('admin.berita.upload-summernote-image'));

            const editUrlTemplate =
                @json(
                    route(
                        'admin.berita.edit',
                        ['berita' => '__ID__']
                    )
                );

            const updateUrlTemplate =
                @json(
                    route(
                        'admin.berita.update',
                        ['berita' => '__ID__']
                    )
                );

            const deleteUrlTemplate =
                @json(
                    route(
                        'admin.berita.destroy',
                        ['berita' => '__ID__']
                    )
                );

            const toggleStatusUrlTemplate =
                @json(
                    route(
                        'admin.berita.toggle-status',
                        ['berita' => '__ID__']
                    )
                );

            const toggleFeaturedUrlTemplate =
                @json(
                    route(
                        'admin.berita.toggle-featured',
                        ['berita' => '__ID__']
                    )
                );


            /* =====================================================
             * URL REPLACE
             * ===================================================== */

            function urlReplace(template, id) {
                return template.replace('__ID__', String(id));
            }


            /* =====================================================
             * SUMMERNOTE IMAGE UPLOAD
             * ===================================================== */

            function uploadSummernoteImage(file, editor) {

                const data = new FormData();
                data.append('image', file);

                $.ajax({
                    url: summernoteUploadUrl,
                    type: 'POST',
                    data: data,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    beforeSend: function () {
                        console.log('Uploading Summernote image:', file.name);
                    },
                    success: function (response) {
                        console.log('Summernote upload success:', response);
                        if (response.success && response.url) {
                            $(editor).summernote('insertImage', response.url, function ($image) {
                                $image.attr('alt', file.name);
                                $image.css({
                                    'max-width': '100%',
                                    'height': 'auto'
                                });
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Upload Gagal',
                                text: 'URL gambar tidak ditemukan.'
                            });
                        }
                    },
                    error: function (xhr) {
                        console.error('Summernote upload error:', xhr);
                        let message = 'Gagal mengupload gambar.';

                        if (xhr.responseJSON) {
                            if (xhr.responseJSON.message) {
                                message = xhr.responseJSON.message;
                            }
                            if (xhr.responseJSON.errors) {
                                const errors = xhr.responseJSON.errors;
                                const messages = Object.values(errors).flat();
                                if (messages.length) {
                                    message = messages.join('\n');
                                }
                            }
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Upload Gagal',
                            text: message
                        });
                    }
                });
            }


            /* =====================================================
             * SUMMERNOTE OPTIONS
             * ===================================================== */

            const summernoteOptions = {
                height: 300,
                minHeight: 250,
                maxHeight: 450,
                placeholder: 'Tulis isi berita di sini...',
                dialogsInBody: true,
                dialogsFade: false,
                tabsize: 4,
                disableDragAndDrop: false,
                fontNames: [
                    'Arial', 'Arial Black', 'Comic Sans MS', 'Courier New',
                    'Helvetica', 'Impact', 'Tahoma', 'Times New Roman', 'Verdana'
                ],
                fontSizes: [
                    '8', '9', '10', '11', '12', '14', '16', '18',
                    '20', '24', '28', '32', '36', '48'
                ],
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video', 'hr']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                callbacks: {
                    onInit: function () {
                        console.log('Summernote initialized:', this);
                    },
                    onImageUpload: function (files) {
                        const editor = this;
                        if (!files || !files.length) return;
                        for (let i = 0; i < files.length; i++) {
                            uploadSummernoteImage(files[i], editor);
                        }
                    },
                    onMediaDelete: function (target) {
                        console.log('Image removed from editor:', target.attr('src'));
                    }
                }
            };


            /* =====================================================
             * INITIALIZE SUMMERNOTE
             * ===================================================== */

            $('#tambah-content').summernote(summernoteOptions);
            $('#edit-content').summernote(summernoteOptions);


            /* =====================================================
             * ESCAPE HTML
             * ===================================================== */

            function escapeHtml(value) {
                return String(value ?? '')
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;')
                    .replace(/"/g, '&quot;')
                    .replace(/'/g, '&#039;');
            }


            /* =====================================================
             * FORMAT DATE
             * ===================================================== */

            function formatDate(value) {
                if (!value) return '-';
                const date = new Date(value);
                if (Number.isNaN(date.getTime())) return '-';
                return date.toLocaleString('id-ID', {
                    day: '2-digit',
                    month: '2-digit',
                    year: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });
            }


            /* =====================================================
             * FORMAT DATETIME LOCAL
             * ===================================================== */

            function formatDateTimeLocal(value) {
                if (!value) return '';
                const date = new Date(value);
                if (Number.isNaN(date.getTime())) return '';

                const year = date.getFullYear();
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const day = String(date.getDate()).padStart(2, '0');
                const hours = String(date.getHours()).padStart(2, '0');
                const minutes = String(date.getMinutes()).padStart(2, '0');

                return (year + '-' + month + '-' + day + 'T' + hours + ':' + minutes);
            }


            /* =====================================================
             * IMAGE URL
             * ===================================================== */

            const imageBaseUrl = @json(asset('images/berita'));

            function getImageUrl(image) {
                if (!image) return '';
                return (imageBaseUrl + '/' + encodeURIComponent(image));
            }


            /* =====================================================
             * VALIDATION ERROR
             * ===================================================== */

            function showValidationError(error) {
                console.error('Error:', error);
                let message = 'Terjadi kesalahan. Silakan coba lagi.';

                if (error && error.responseJSON && error.responseJSON.errors) {
                    const errors = error.responseJSON.errors;
                    const messages = Object.values(errors).flat();
                    message = messages.join('<br>');
                } else if (error && error.responseJSON && error.responseJSON.msg) {
                    message = error.responseJSON.msg;
                } else if (error && error.responseJSON && error.responseJSON.message) {
                    message = error.responseJSON.message;
                } else if (error && error.message) {
                    message = error.message;
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    html: message
                });
            }


            /* =====================================================
             * FETCH JSON
             * ===================================================== */

            async function fetchJson(url, options = {}) {
                const response = await fetch(url, options);
                let result = null;

                try {
                    result = await response.json();
                } catch (jsonError) {
                    result = { msg: 'Response server tidak valid.' };
                }

                if (!response.ok) {
                    throw {
                        responseJSON: result,
                        message: result.msg || result.message || 'Request gagal.'
                    };
                }

                return result;
            }


            /* =====================================================
             * TABLE ELEMENT
             * ===================================================== */

            const tableElement = document.getElementById('table-berita');
            if (!tableElement) {
                console.error('Element #table-berita tidak ditemukan.');
                return;
            }


            /* =====================================================
             * TABULATOR
             * ===================================================== */

            const table = new Tabulator(tableElement, {
                ajaxURL: dataUrl,
                ajaxConfig: 'GET',
                layout: 'fitColumns',
                placeholder: 'Belum ada data berita.',
                pagination: true,
                paginationMode: 'local',
                paginationSize: 10,
                paginationSizeSelector: [10, 25, 50, 100],
                ajaxResponse: function (url, params, response) {
                    return (response.data || []);
                },
                columns: [
                    /* =================================================
                     * NO
                    ================================================== */
                    {
                        title: 'No',
                        formatter: 'rownum',
                        width: 60,
                        hozAlign: 'center',
                        headerHozAlign: 'center',
                        headerSort: false
                    },

                    /* =================================================
                     * GAMBAR / MEDIA
                    ================================================== */
                    {
                        title: 'Media',
                        field: 'image',
                        width: 110,
                        hozAlign: 'center',
                        headerHozAlign: 'center',
                        headerSort: false,
                        formatter: function (cell) {
                            const data = cell.getRow().getData();
                            const image = cell.getValue();

                            if (data.youtube_url) {
                                return `
                                    <div class="text-danger mt-1 text-center" title="Video YouTube">
                                        <i class="fa-brands fa-youtube fa-2xl"></i>
                                    </div>
                                `;
                            }

                            if (!image) {
                                return `
                                    <div class="text-muted mt-1 text-center">
                                        <i class="fa-regular fa-image fa-xl"></i>
                                    </div>
                                `;
                            }

                            return `
                                <img
                                    src="${getImageUrl(image)}"
                                    class="img-fluid rounded"
                                    style="max-height:50px; object-fit:cover;"
                                    alt="Berita">
                            `;
                        }
                    },

                    /* =================================================
                     * JUDUL
                    ================================================== */
                    {
                        title: 'Judul',
                        field: 'title',
                        minWidth: 220,
                        formatter: function (cell) {
                            const row = cell.getRow();
                            const data = row.getData();
                            const title = cell.getValue() || '-';
                            let featured = '';

                            if (Boolean(data.is_featured)) {
                                featured = `
                                    <span class="badge bg-warning text-dark featured-badge ms-1" title="Berita unggulan">
                                        <i class="fa-solid fa-star"></i>
                                    </span>
                                `;
                            }

                            return `
                                <div>
                                    <div class="fw-semibold">
                                        ${escapeHtml(title)}
                                        ${featured}
                                    </div>
                                    <small class="text-muted">
                                        ${escapeHtml(data.category || 'Tanpa kategori')}
                                    </small>
                                </div>
                            `;
                        }
                    },

                    /* =================================================
                     * STATUS
                    ================================================== */
                    {
                        title: 'Status',
                        field: 'status',
                        width: 120,
                        hozAlign: 'center',
                        headerHozAlign: 'center',
                        formatter: function (cell) {
                            const status = cell.getValue() || 'draft';
                            let badge = 'secondary';

                            if (status === 'published') {
                                badge = 'success';
                            } else if (status === 'draft') {
                                badge = 'warning';
                            }

                            return `
                                <span class="badge bg-${badge} status-badge">
                                    ${escapeHtml(status)}
                                </span>
                            `;
                        }
                    },

                    /* =================================================
                     * PUBLIKASI
                    ================================================== */
                    {
                        title: 'Publikasi',
                        field: 'published_at',
                        width: 160,
                        formatter: function (cell) {
                            return formatDate(cell.getValue());
                        }
                    },

                    /* =================================================
                     * VIEWS
                    ================================================== */
                    {
                        title: 'Views',
                        field: 'views',
                        width: 90,
                        hozAlign: 'center',
                        headerHozAlign: 'center',
                        formatter: function (cell) {
                            const value = Number(cell.getValue() || 0);
                            return value.toLocaleString('id-ID');
                        }
                    },

                    /* =================================================
                     * AKSI
                    ================================================== */
                    {
                        title: 'Aksi',
                        width: 180,
                        hozAlign: 'center',
                        headerHozAlign: 'center',
                        headerSort: false,
                        frozen: true,
                        formatter: function (cell) {
                            const data = cell.getRow().getData();
                            let statusButton = '';

                            if (data.status === 'published') {
                                statusButton = `
                                    <button type="button" class="btn btn-sm btn-outline-warning btn-toggle-status" title="Jadikan Draft">
                                        <i class="fa-solid fa-eye-slash"></i>
                                    </button>
                                `;
                            } else {
                                statusButton = `
                                    <button type="button" class="btn btn-sm btn-outline-success btn-toggle-status" title="Publikasikan">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                `;
                            }

                            return `
                                <div class="d-flex justify-content-center gap-1">
                                    <button type="button" class="btn btn-sm btn-outline-primary btn-edit" title="Edit">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>
                                    ${statusButton}
                                    <button type="button" class="btn btn-sm btn-outline-warning btn-toggle-featured" title="Toggle Unggulan">
                                        <i class="fa-solid fa-star"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-danger btn-delete" title="Hapus">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            `;
                        }
                    }
                ]
            });


            /* =====================================================
             * BUTTON TAMBAH
             * ===================================================== */

            const btnTambah = document.getElementById('btnTambah');
            const formTambah = document.getElementById('formTambah');
            const modalTambahElement = document.getElementById('modalTambah');
            const modalTambah = bootstrap.Modal.getOrCreateInstance(modalTambahElement, { focus: false });

            btnTambah.addEventListener('click', function () {
                formTambah.reset();
                $('#tambah-content').summernote('code', '');
                document.getElementById('tambah-preview').src = '';
                document.getElementById('tambah-youtube-url').value = '';
                document.getElementById('tambah-preview-container').classList.add('d-none');
                modalTambah.show();
            });


            /* =====================================================
             * PREVIEW TAMBAH
             * ===================================================== */

            document.getElementById('tambah-image').addEventListener('change', function () {
                const file = this.files && this.files[0];
                const previewContainer = document.getElementById('tambah-preview-container');
                const preview = document.getElementById('tambah-preview');

                if (!file) {
                    preview.src = '';
                    previewContainer.classList.add('d-none');
                    return;
                }

                if (!file.type.startsWith('image/')) {
                    this.value = '';
                    preview.src = '';
                    previewContainer.classList.add('d-none');
                    Swal.fire({
                        icon: 'warning',
                        title: 'File tidak valid',
                        text: 'Silakan pilih file gambar.'
                    });
                    return;
                }

                const url = URL.createObjectURL(file);
                preview.src = url;
                previewContainer.classList.remove('d-none');
            });


            /* =====================================================
             * SUBMIT TAMBAH
             * ===================================================== */

            formTambah.addEventListener('submit', async function (event) {
                event.preventDefault();
                const form = this;
                const submitButton = form.querySelector('button[type="submit"]');
                const originalButtonHtml = submitButton.innerHTML;

                submitButton.disabled = true;
                submitButton.innerHTML = `
                    <span class="spinner-border spinner-border-sm me-1" role="status"></span>
                    Menyimpan...
                `;

                try {
                    const formData = new FormData(form);
                    formData.set('content', $('#tambah-content').summernote('code'));

                    const result = await fetchJson(storeUrl, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: formData
                    });

                    modalTambah.hide();
                    form.reset();
                    $('#tambah-content').summernote('code', '');
                    document.getElementById('tambah-preview').src = '';
                    document.getElementById('tambah-youtube-url').value = '';
                    document.getElementById('tambah-preview-container').classList.add('d-none');

                    await table.replaceData();

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: result.msg || 'Berita berhasil ditambahkan.',
                        timer: 1200,
                        showConfirmButton: false
                    });

                } catch (error) {
                    showValidationError(error);
                } finally {
                    submitButton.disabled = false;
                    submitButton.innerHTML = originalButtonHtml;
                }
            });


            /* =====================================================
             * CELL CLICK
             * ===================================================== */

            table.on('cellClick', async function (event, cell) {
                const target = event.target;
                const row = cell.getRow();
                const data = row.getData();

                /* =================================================
                 * EDIT
                ================================================== */
                const editButton = target.closest('.btn-edit');

                if (editButton) {
                    try {
                        const result = await fetchJson(urlReplace(editUrlTemplate, data.id), {
                            method: 'GET',
                            headers: { 'Accept': 'application/json' }
                        });

                        const item = result.data || result;

                        /* DATA DASAR */
                        document.getElementById('edit-title').value = item.title || '';
                        document.getElementById('edit-category').value = item.category || '';
                        document.getElementById('edit-status').value = item.status || 'draft';
                        document.getElementById('edit-featured').checked = Boolean(item.is_featured);
                        document.getElementById('edit-published-at').value = formatDateTimeLocal(item.published_at);

                        /* YOUTUBE URL */
                        document.getElementById('edit-youtube-url').value = item.youtube_url || '';

                        /* SUMMERNOTE */
                        $('#edit-content').summernote('code', item.content || '');

                        /* IMAGE */
                        const editPreview = document.getElementById('edit-preview');
                        const editPreviewContainer = document.getElementById('edit-preview-container');

                        if (item.image) {
                            editPreview.src = getImageUrl(item.image);
                            editPreviewContainer.classList.remove('d-none');
                        } else {
                            editPreview.src = '';
                            editPreviewContainer.classList.add('d-none');
                        }

                        document.getElementById('edit-image').value = '';

                        /* ID */
                        formEdit.dataset.id = item.id;

                        /* MODAL */
                        const modalEditElement = document.getElementById('modalEdit');
                        const modalEdit = bootstrap.Modal.getOrCreateInstance(modalEditElement, { focus: false });

                        modalEdit.show();

                    } catch (error) {
                        showValidationError(error);
                    }
                    return;
                }


                /* =================================================
                 * TOGGLE STATUS
                ================================================== */
                const statusButton = target.closest('.btn-toggle-status');

                if (statusButton) {
                    const action = data.status === 'published' ? 'menjadikan draft' : 'mempublikasikan';
                    const confirmResult = await Swal.fire({
                        icon: 'question',
                        title: 'Konfirmasi',
                        text: `Yakin ingin ${action} berita ini?`,
                        showCancelButton: true,
                        confirmButtonText: 'Ya',
                        cancelButtonText: 'Batal'
                    });

                    if (!confirmResult.isConfirmed) return;

                    try {
                        await fetchJson(urlReplace(toggleStatusUrlTemplate, data.id), {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            }
                        });
                        await table.replaceData();
                    } catch (error) {
                        showValidationError(error);
                    }
                    return;
                }


                /* =================================================
                 * TOGGLE FEATURED
                ================================================== */
                const featuredButton = target.closest('.btn-toggle-featured');

                if (featuredButton) {
                    try {
                        await fetchJson(urlReplace(toggleFeaturedUrlTemplate, data.id), {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            }
                        });
                        await table.replaceData();
                    } catch (error) {
                        showValidationError(error);
                    }
                    return;
                }


                /* =================================================
                 * DELETE
                ================================================== */
                const deleteButton = target.closest('.btn-delete');

                if (deleteButton) {
                    const confirmResult = await Swal.fire({
                        icon: 'warning',
                        title: 'Hapus Berita?',
                        text: 'Data berita dan gambar akan dihapus permanen.',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Hapus',
                        cancelButtonText: 'Batal',
                        confirmButtonColor: '#dc3545'
                    });

                    if (!confirmResult.isConfirmed) return;

                    try {
                        const result = await fetchJson(urlReplace(deleteUrlTemplate, data.id), {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            }
                        });

                        await table.replaceData();

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: result.msg || 'Berita berhasil dihapus.',
                            timer: 1200,
                            showConfirmButton: false
                        });

                    } catch (error) {
                        showValidationError(error);
                    }
                    return;
                }
            });


            /* =====================================================
             * PREVIEW GAMBAR EDIT
             * ===================================================== */

            document.getElementById('edit-image').addEventListener('change', function () {
                const file = this.files && this.files[0];
                const preview = document.getElementById('edit-preview');
                const previewContainer = document.getElementById('edit-preview-container');

                if (!file) return;

                if (!file.type.startsWith('image/')) {
                    this.value = '';
                    Swal.fire({
                        icon: 'warning',
                        title: 'File tidak valid',
                        text: 'Silakan pilih file gambar.'
                    });
                    return;
                }

                const url = URL.createObjectURL(file);
                preview.src = url;
                previewContainer.classList.remove('d-none');
            });


            /* =====================================================
             * FORM EDIT
            ================================================== */

            const formEdit = document.getElementById('formEdit');

            formEdit.addEventListener('submit', async function (event) {
                event.preventDefault();
                const form = this;
                const id = form.dataset.id;

                if (!id) {
                    Swal.fire({ icon: 'error', title: 'Gagal', text: 'ID berita tidak ditemukan.' });
                    return;
                }

                const submitButton = form.querySelector('button[type="submit"]');
                const originalButtonHtml = submitButton.innerHTML;

                submitButton.disabled = true;
                submitButton.innerHTML = `
                    <span class="spinner-border spinner-border-sm me-1" role="status"></span>
                    Menyimpan...
                `;

                try {
                    const formData = new FormData(form);
                    formData.set('content', $('#edit-content').summernote('code'));

                    const result = await fetchJson(urlReplace(updateUrlTemplate, id), {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: formData
                    });

                    const modalEditElement = document.getElementById('modalEdit');
                    const modalEdit = bootstrap.Modal.getInstance(modalEditElement);

                    if (modalEdit) modalEdit.hide();

                    await table.replaceData();

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: result.msg || 'Berita berhasil diperbarui.',
                        timer: 1200,
                        showConfirmButton: false
                    });

                } catch (error) {
                    showValidationError(error);
                } finally {
                    submitButton.disabled = false;
                    submitButton.innerHTML = originalButtonHtml;
                }
            });


            /* =====================================================
             * RESET EDIT MODAL
            ================================================== */

            document.getElementById('modalEdit').addEventListener('hidden.bs.modal', function () {
                formEdit.reset();
                formEdit.dataset.id = '';
                $('#edit-content').summernote('code', '');
                document.getElementById('edit-preview').src = '';
                document.getElementById('edit-youtube-url').value = '';
                document.getElementById('edit-preview-container').classList.add('d-none');
            });


            /* =====================================================
             * RESET TAMBAH MODAL
            ================================================== */

            document.getElementById('modalTambah').addEventListener('hidden.bs.modal', function () {
                formTambah.reset();
                $('#tambah-content').summernote('code', '');
                document.getElementById('tambah-preview').src = '';
                document.getElementById('tambah-youtube-url').value = '';
                document.getElementById('tambah-preview-container').classList.add('d-none');
            });

        });

    </script>

@endsection
