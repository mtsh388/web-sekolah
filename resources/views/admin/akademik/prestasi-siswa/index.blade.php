@extends('admin.template.admin')

@section('title', 'Prestasi Siswa')

@section('content-admin')
    <link
        href="https://unpkg.com/tabulator-tables@6.3.1/dist/css/tabulator_bootstrap5.min.css"
        rel="stylesheet"
    >

    <style>

        #table-prestasi-siswa {
            font-size: 14px;
        }

        .prestasi-foto {
            width: 70px;
            height: 55px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
        }

        .prestasi-no-foto {
            width: 70px;
            height: 55px;
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
            min-height: 65px;
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

        <div class="app-content-header">

            <div class="container-fluid mt-3">

                <div class="row">

                    <div class="col-sm-6">
                        <h1 class="mb-0 fs-3">
                            Prestasi Siswa
                        </h1>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                Akademik
                            </li>
                            <li class="breadcrumb-item active">
                                Prestasi Siswa
                            </li>
                        </ol>
                    </div>

                </div>

            </div>

        </div>


        <div class="container-fluid">

            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white py-3">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <h5 class="mb-1 fw-semibold">
                                Data Prestasi Siswa
                            </h5>

                            <small class="text-muted">
                                Kelola data prestasi dan penghargaan siswa
                            </small>
                        </div>

                        <button
                            type="button"
                            class="btn btn-primary"
                            id="btnTambah"
                        >
                            <i class="fa-solid fa-plus me-1"></i>
                            Tambah Prestasi
                        </button>

                    </div>

                </div>


                <div class="card-body">

                    <div id="table-prestasi-siswa"></div>

                </div>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- MODAL TAMBAH --}}
    {{-- ========================================================= --}}

    <div
        class="modal fade"
        id="modalTambah"
        tabindex="-1"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-xl modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">
                        <i class="fa-solid fa-trophy me-2"></i>
                        Tambah Prestasi Siswa
                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                    ></button>

                </div>


                <form id="formTambah" enctype="multipart/form-data">

                    @csrf

                    <div class="modal-body">

                        <div class="row g-3">

                            {{-- Judul --}}
                            <div class="col-md-8">

                                <label class="form-label">
                                    Judul Prestasi
                                    <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="text"
                                    name="judul"
                                    class="form-control"
                                    placeholder="Contoh: Juara 1 Olimpiade Matematika"
                                    required
                                >

                            </div>


                            {{-- Nama Siswa --}}
                            <div class="col-md-4">

                                <label class="form-label">
                                    Nama Siswa
                                    <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="text"
                                    name="nama_siswa"
                                    class="form-control"
                                    placeholder="Nama lengkap siswa"
                                    required
                                >

                            </div>


                            {{-- Kelas --}}
                            <div class="col-md-3">

                                <label class="form-label">
                                    Kelas
                                </label>

                                <input
                                    type="text"
                                    name="kelas"
                                    class="form-control"
                                    placeholder="Contoh: IX-A"
                                >

                            </div>


                            {{-- Bidang --}}
                            <div class="col-md-3">

                                <label class="form-label">
                                    Bidang
                                </label>

                                <input
                                    type="text"
                                    name="bidang"
                                    class="form-control"
                                    placeholder="Contoh: Matematika"
                                >

                            </div>


                            {{-- Tingkat --}}
                            <div class="col-md-3">

                                <label class="form-label">
                                    Tingkat
                                </label>

                                <select
                                    name="tingkat"
                                    class="form-select"
                                >
                                    <option value="">
                                        - Pilih Tingkat -
                                    </option>
                                    <option value="Sekolah">
                                        Sekolah
                                    </option>
                                    <option value="Kecamatan">
                                        Kecamatan
                                    </option>
                                    <option value="Kabupaten/Kota">
                                        Kabupaten/Kota
                                    </option>
                                    <option value="Provinsi">
                                        Provinsi
                                    </option>
                                    <option value="Nasional">
                                        Nasional
                                    </option>
                                    <option value="Internasional">
                                        Internasional
                                    </option>
                                </select>

                            </div>


                            {{-- Peringkat --}}
                            <div class="col-md-3">

                                <label class="form-label">
                                    Peringkat
                                </label>

                                <input
                                    type="text"
                                    name="peringkat"
                                    class="form-control"
                                    placeholder="Contoh: Juara 1"
                                >

                            </div>


                            {{-- Penyelenggara --}}
                            <div class="col-md-6">

                                <label class="form-label">
                                    Penyelenggara
                                </label>

                                <input
                                    type="text"
                                    name="penyelenggara"
                                    class="form-control"
                                    placeholder="Nama penyelenggara lomba"
                                >

                            </div>


                            {{-- Tanggal --}}
                            <div class="col-md-3">

                                <label class="form-label">
                                    Tanggal
                                </label>

                                <input
                                    type="date"
                                    name="tanggal"
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
                                    class="form-control"
                                    value="0"
                                    min="0"
                                >

                            </div>


                            {{-- Deskripsi --}}
                            <div class="col-md-8">

                                <label class="form-label">
                                    Deskripsi
                                </label>

                                <textarea
                                    name="deskripsi"
                                    class="form-control"
                                    rows="7"
                                    placeholder="Deskripsi prestasi..."
                                ></textarea>

                            </div>


                            {{-- Foto --}}
                            <div class="col-md-4">

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
                                    JPG, PNG, WEBP. Maksimal 2 MB.
                                </small>

                                <div
                                    class="mt-3 text-center"
                                    id="preview-tambah-wrapper"
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


                            {{-- Status --}}
                            <div class="col-md-12">

                                <div class="form-check form-switch">

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


    {{-- ========================================================= --}}
    {{-- MODAL EDIT --}}
    {{-- ========================================================= --}}

    <div
        class="modal fade"
        id="modalEdit"
        tabindex="-1"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-xl modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">
                        <i class="fa-solid fa-pen-to-square me-2"></i>
                        Edit Prestasi Siswa
                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                    ></button>

                </div>


                <form id="formEdit" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="modal-body">

                        <div class="row g-3">

                            <div class="col-md-8">

                                <label class="form-label">
                                    Judul Prestasi
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


                            <div class="col-md-4">

                                <label class="form-label">
                                    Nama Siswa
                                    <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="text"
                                    name="nama_siswa"
                                    id="edit-nama-siswa"
                                    class="form-control"
                                    required
                                >

                            </div>


                            <div class="col-md-3">

                                <label class="form-label">
                                    Kelas
                                </label>

                                <input
                                    type="text"
                                    name="kelas"
                                    id="edit-kelas"
                                    class="form-control"
                                >

                            </div>


                            <div class="col-md-3">

                                <label class="form-label">
                                    Bidang
                                </label>

                                <input
                                    type="text"
                                    name="bidang"
                                    id="edit-bidang"
                                    class="form-control"
                                >

                            </div>


                            <div class="col-md-3">

                                <label class="form-label">
                                    Tingkat
                                </label>

                                <select
                                    name="tingkat"
                                    id="edit-tingkat"
                                    class="form-select"
                                >
                                    <option value="">
                                        - Pilih Tingkat -
                                    </option>
                                    <option value="Sekolah">
                                        Sekolah
                                    </option>
                                    <option value="Kecamatan">
                                        Kecamatan
                                    </option>
                                    <option value="Kabupaten/Kota">
                                        Kabupaten/Kota
                                    </option>
                                    <option value="Provinsi">
                                        Provinsi
                                    </option>
                                    <option value="Nasional">
                                        Nasional
                                    </option>
                                    <option value="Internasional">
                                        Internasional
                                    </option>
                                </select>

                            </div>


                            <div class="col-md-3">

                                <label class="form-label">
                                    Peringkat
                                </label>

                                <input
                                    type="text"
                                    name="peringkat"
                                    id="edit-peringkat"
                                    class="form-control"
                                >

                            </div>


                            <div class="col-md-6">

                                <label class="form-label">
                                    Penyelenggara
                                </label>

                                <input
                                    type="text"
                                    name="penyelenggara"
                                    id="edit-penyelenggara"
                                    class="form-control"
                                >

                            </div>


                            <div class="col-md-3">

                                <label class="form-label">
                                    Tanggal
                                </label>

                                <input
                                    type="date"
                                    name="tanggal"
                                    id="edit-tanggal"
                                    class="form-control"
                                >

                            </div>


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


                            <div class="col-md-8">

                                <label class="form-label">
                                    Deskripsi
                                </label>

                                <textarea
                                    name="deskripsi"
                                    id="edit-deskripsi"
                                    class="form-control"
                                    rows="7"
                                ></textarea>

                            </div>


                            <div class="col-md-4">

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

                                <div
                                    class="mt-3 text-center"
                                    id="preview-edit-wrapper"
                                >
                                    <img
                                        id="preview-edit"
                                        src=""
                                        class="img-fluid rounded border"
                                        style="max-height:220px; display:none;"
                                    >

                                    <div
                                        id="preview-edit-empty"
                                        class="text-muted py-4 border rounded"
                                    >
                                        Tidak ada foto
                                    </div>
                                </div>

                            </div>


                            <div class="col-md-12">

                                <div class="form-check form-switch">

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

    <script
        src="https://unpkg.com/tabulator-tables@6.3.1/dist/js/tabulator.min.js">
    </script>

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const tableElement = document.getElementById(
                'table-prestasi-siswa'
            );

            if (!tableElement) {
                return;
            }


            /* =========================================================
             * CONFIG
             * ========================================================= */

            const csrfToken =
                document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                || '{{ csrf_token() }}';


            const dataUrl =
                "{{ route('admin.akademik.prestasi-siswa.data') }}";

            const storeUrl =
                "{{ route('admin.akademik.prestasi-siswa.store') }}";

            /*
             * PENTING:
             * Parameter route adalah {prestasiSiswa}
             */
            const editUrlTemplate = @json(
        route(
            'admin.akademik.prestasi-siswa.edit',
            ['prestasiSiswa' => '__ID__']
        )
    );

            const updateUrlTemplate = @json(
        route(
            'admin.akademik.prestasi-siswa.update',
            ['prestasiSiswa' => '__ID__']
        )
    );

            const deleteUrlTemplate = @json(
        route(
            'admin.akademik.prestasi-siswa.destroy',
            ['prestasiSiswa' => '__ID__']
        )
    );

            const toggleUrlTemplate = @json(
        route(
            'admin.akademik.prestasi-siswa.toggle-status',
            ['prestasiSiswa' => '__ID__']
        )
    );

            const orderUrl =
                "{{ route('admin.akademik.prestasi-siswa.order') }}";


            /* =========================================================
             * ELEMENT
             * ========================================================= */

            const modalTambahElement =
                document.getElementById('modalTambah');

            const modalEditElement =
                document.getElementById('modalEdit');

            const modalTambah =
                new bootstrap.Modal(modalTambahElement);

            const modalEdit =
                new bootstrap.Modal(modalEditElement);

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


            /* =========================================================
             * HELPER
             * ========================================================= */

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


            function imageUrl(filename) {

                if (!filename) {
                    return null;
                }

                return "{{ asset('images/prestasi-siswa') }}/"
                    + encodeURIComponent(filename);
            }


            function showValidationError(xhr) {

                let message = 'Terjadi kesalahan.';

                if (
                    xhr.responseJSON &&
                    xhr.responseJSON.message
                ) {
                    message = xhr.responseJSON.message;
                }

                if (
                    xhr.responseJSON &&
                    xhr.responseJSON.errors
                ) {

                    const errors =
                        xhr.responseJSON.errors;

                    const messages = [];

                    Object.keys(errors).forEach(function (key) {

                        errors[key].forEach(function (error) {
                            messages.push(error);
                        });

                    });

                    if (messages.length) {
                        message = messages.join('<br>');
                    }
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    html: message
                });
            }


            function loadingButton(button, loading) {

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


            /* =========================================================
             * PREVIEW FOTO
             * ========================================================= */

            function previewFile(input, imageElement, wrapperElement) {

                if (
                    !input.files ||
                    !input.files[0]
                ) {
                    return;
                }

                const file = input.files[0];

                if (!file.type.startsWith('image/')) {

                    Swal.fire({
                        icon: 'warning',
                        title: 'File tidak valid',
                        text: 'Silakan pilih file gambar.'
                    });

                    input.value = '';

                    return;
                }

                const reader = new FileReader();

                reader.onload = function (e) {

                    imageElement.src = e.target.result;

                    if (wrapperElement) {
                        wrapperElement.style.display = 'block';
                    }

                };

                reader.readAsDataURL(file);
            }


            if (tambahFoto) {

                tambahFoto.addEventListener(
                    'change',
                    function () {

                        previewFile(
                            this,
                            document.getElementById('preview-tambah'),
                            document.getElementById(
                                'preview-tambah-wrapper'
                            )
                        );

                    }
                );
            }


            if (editFoto) {

                editFoto.addEventListener(
                    'change',
                    function () {

                        const image =
                            document.getElementById('preview-edit');

                        const empty =
                            document.getElementById('preview-edit-empty');

                        if (!this.files || !this.files[0]) {
                            return;
                        }

                        const reader =
                            new FileReader();

                        reader.onload = function (e) {

                            image.src = e.target.result;
                            image.style.display = 'block';

                            empty.style.display = 'none';

                        };

                        reader.readAsDataURL(
                            this.files[0]
                        );

                    }
                );
            }


            /* =========================================================
             * TABULATOR
             * ========================================================= */

            const table = new Tabulator(
                tableElement,
                {
                    ajaxURL: dataUrl,

                    ajaxConfig: 'GET',

                    layout: 'fitColumns',

                    movableRows: true,

                    index: 'id',

                    placeholder: 'Belum ada data prestasi.',

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

                    ajaxResponse: function (
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
                            title: 'Foto',
                            field: 'foto',
                            width: 95,
                            hozAlign: 'center',
                            headerSort: false,

                            formatter: function (
                                cell
                            ) {

                                const foto =
                                    cell.getValue();

                                if (!foto) {

                                    return `
                                <div class="prestasi-no-foto">
                                    <i class="fa-regular fa-image"></i>
                                </div>
                            `;
                                }

                                return `
                            <img
                                src="${imageUrl(foto)}"
                                class="prestasi-foto"
                                alt="Foto Prestasi"
                            >
                        `;
                            }
                        },


                        {
                            title: 'Prestasi',
                            field: 'judul',
                            minWidth: 220,

                            formatter: function (
                                cell
                            ) {

                                const data =
                                    cell.getRow().getData();

                                return `
                            <div>
                                <div class="fw-semibold">
                                    ${escapeHtml(data.judul)}
                                </div>

                                <div class="small text-muted mt-1">
                                    ${escapeHtml(data.nama_siswa)}
                                </div>

                                ${
                                    data.kelas
                                        ? `
                                        <span class="badge bg-light text-dark mt-1">
                                            ${escapeHtml(data.kelas)}
                                        </span>
                                    `
                                        : ''
                                }
                            </div>
                        `;
                            }
                        },


                        {
                            title: 'Bidang',
                            field: 'bidang',
                            minWidth: 130,

                            formatter: function (cell) {

                                return escapeHtml(
                                    cell.getValue() || '-'
                                );
                            }
                        },


                        {
                            title: 'Tingkat',
                            field: 'tingkat',
                            minWidth: 130,

                            formatter: function (cell) {

                                return cell.getValue()
                                    ? `
                                <span class="badge bg-info-subtle text-info-emphasis">
                                    ${escapeHtml(cell.getValue())}
                                </span>
                            `
                                    : '-';
                            }
                        },


                        {
                            title: 'Peringkat',
                            field: 'peringkat',
                            minWidth: 100,

                            formatter: function (cell) {

                                return cell.getValue()
                                    ? `
                                <span class="badge bg-warning-subtle text-warning-emphasis">
                                    ${escapeHtml(cell.getValue())}
                                </span>
                            `
                                    : '-';
                            }
                        },


                        {
                            title: 'Tanggal',
                            field: 'tanggal',
                            width: 110,

                            formatter: function (cell) {

                                const value =
                                    cell.getValue();

                                if (!value) {
                                    return '-';
                                }

                                const date =
                                    new Date(value);

                                if (isNaN(date.getTime())) {
                                    return escapeHtml(value);
                                }

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


                        {
                            title: 'Status',
                            field: 'is_active',
                            width: 100,
                            hozAlign: 'center',

                            formatter: function (cell) {

                                const active =
                                    Boolean(cell.getValue());

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


                        {
                            title: 'Aksi',
                            width: 145,
                            hozAlign: "center",
                            headerHozAlign: "center",
                            headerSort: false,
                            frozen: true,
                            formatter: function (cell) {

                                const data =
                                    cell.getRow().getData();

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
                                    <i class="fa-solid ${data.is_active ? 'fa-eye-slash' : 'fa-eye'}"></i>
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


            /* =========================================================
             * TAMBAH
             * ========================================================= */

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
                        document.getElementById('btnSimpan');

                    const formData =
                        new FormData(formTambah);

                    loadingButton(button, true);

                    try {

                        const response =
                            await fetch(
                                storeUrl,
                                {
                                    method: 'POST',

                                    headers: {
                                        'X-CSRF-TOKEN': csrfToken,
                                        'Accept': 'application/json'
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
                            text: result.msg ||
                                'Data berhasil ditambahkan.',
                            timer: 1800,
                            showConfirmButton: false
                        });

                    } catch (error) {

                        showValidationError(error);

                    } finally {

                        loadingButton(button, false);
                    }
                }
            );


            /* =========================================================
             * EDIT
             * ========================================================= */

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
                                    'Accept': 'application/json'
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
                        'edit-judul'
                    ).value = data.judul || '';


                    document.getElementById(
                        'edit-nama-siswa'
                    ).value = data.nama_siswa || '';


                    document.getElementById(
                        'edit-kelas'
                    ).value = data.kelas || '';


                    document.getElementById(
                        'edit-bidang'
                    ).value = data.bidang || '';


                    document.getElementById(
                        'edit-tingkat'
                    ).value = data.tingkat || '';


                    document.getElementById(
                        'edit-peringkat'
                    ).value = data.peringkat || '';


                    document.getElementById(
                        'edit-penyelenggara'
                    ).value = data.penyelenggara || '';


                    document.getElementById(
                        'edit-tanggal'
                    ).value = data.tanggal
                        ? String(data.tanggal).substring(0, 10)
                        : '';


                    document.getElementById(
                        'edit-deskripsi'
                    ).value = data.deskripsi || '';


                    document.getElementById(
                        'edit-urutan'
                    ).value = data.urutan ?? 0;


                    document.getElementById(
                        'edit-is-active'
                    ).checked = Boolean(
                        data.is_active
                    );


                    const image =
                        document.getElementById(
                            'preview-edit'
                        );

                    const empty =
                        document.getElementById(
                            'preview-edit-empty'
                        );


                    editFoto.value = '';


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

                    showValidationError(error);

                }
            }


            /* =========================================================
             * CLICK ACTION
             * ========================================================= */

            tableElement.addEventListener(
                'click',
                function (e) {

                    const editButton =
                        e.target.closest('.btn-edit');

                    if (editButton) {

                        const id =
                            editButton.dataset.id;

                        if (id) {
                            openEditModal(id);
                        }

                        return;
                    }


                    const deleteButton =
                        e.target.closest('.btn-delete');

                    if (deleteButton) {

                        const id =
                            deleteButton.dataset.id;

                        if (id) {
                            deleteData(id);
                        }

                        return;
                    }


                    const toggleButton =
                        e.target.closest('.btn-toggle');

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


            /* =========================================================
             * UPDATE
             * ========================================================= */

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
                        document.getElementById('btnUpdate');

                    const updateUrl =
                        updateUrlTemplate.replace(
                            '__ID__',
                            id
                        );

                    const formData =
                        new FormData(formEdit);

                    /*
                     * Karena form menggunakan method spoofing Laravel
                     */
                    formData.set(
                        '_method',
                        'PUT'
                    );

                    loadingButton(button, true);

                    try {

                        const response =
                            await fetch(
                                updateUrl,
                                {
                                    method: 'POST',

                                    headers: {
                                        'X-CSRF-TOKEN': csrfToken,
                                        'Accept': 'application/json'
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
                            text: result.msg ||
                                'Data berhasil diperbarui.',
                            timer: 1800,
                            showConfirmButton: false
                        });

                    } catch (error) {

                        showValidationError(error);

                    } finally {

                        loadingButton(button, false);
                    }

                }
            );


            /* =========================================================
             * DELETE
             * ========================================================= */

            async function deleteData(id) {

                const confirm =
                    await Swal.fire({

                        icon: 'warning',

                        title: 'Hapus Prestasi?',

                        text:
                            'Data prestasi yang dihapus tidak dapat dikembalikan.',

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
                                    'X-CSRF-TOKEN': csrfToken,
                                    'Accept': 'application/json'
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
                        text: result.msg ||
                            'Data berhasil dihapus.',
                        timer: 1800,
                        showConfirmButton: false
                    });


                } catch (error) {

                    showValidationError(error);
                }
            }


            /* =========================================================
             * TOGGLE STATUS
             * ========================================================= */

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
                                    'X-CSRF-TOKEN': csrfToken,
                                    'Accept': 'application/json'
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
                        text: result.msg ||
                            'Status berhasil diperbarui.',
                        timer: 1500,
                        showConfirmButton: false
                    });


                } catch (error) {

                    showValidationError(error);
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


