@extends('admin.template.admin')

@section('title', 'Kalender Pendidikan')

@section('content-admin')

    <div class="container-fluid">

        <div class="app-content-header">

            <div class="container-fluid mt-3">

                <div class="row">

                    <div class="col-sm-6">

                        <h1 class="mb-0 fs-3">
                            Kalender Pendidikan
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

                                    Kalender Pendidikan

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
                                <i class="fa-solid fa-calendar-days fs-5"></i>
                            </span>

                            </div>

                            <div>

                                <h3 class="card-title mb-1">
                                    Kalender Pendidikan
                                </h3>

                                <small class="text-secondary ms-3">
                                    Kelola kalender dan kegiatan pendidikan sekolah.
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
                            Tambah Kalender
                        </button>

                    </div>

                </div>

            </div>

            {{-- ========================================================
                FILTER
            ========================================================= --}}
            <div class="card-body border-bottom">

                <div class="row g-3">

                    <div class="col-md-4">

                        <label class="form-label fw-semibold">
                            Tahun Ajaran
                        </label>

                        <select
                            id="filter-tahun-ajaran"
                            class="form-select"
                        >

                            <option value="">
                                Semua Tahun Ajaran
                            </option>

                            @foreach($tahunAjaran as $tahun)
                                <option value="{{ $tahun }}">
                                    {{ $tahun }}
                                </option>
                            @endforeach

                        </select>

                    </div>

                    <div class="col-md-4">

                        <label class="form-label fw-semibold">
                            Kategori
                        </label>

                        <select
                            id="filter-kategori"
                            class="form-select"
                        >

                            <option value="">
                                Semua Kategori
                            </option>

                            <option value="Akademik">
                                Akademik
                            </option>

                            <option value="Ujian">
                                Ujian
                            </option>

                            <option value="Libur">
                                Libur
                            </option>

                            <option value="Kegiatan">
                                Kegiatan
                            </option>

                            <option value="Lainnya">
                                Lainnya
                            </option>

                        </select>

                    </div>

                    <div class="col-md-4 d-flex align-items-end">

                        <button
                            type="button"
                            id="btn-reset-filter"
                            class="btn btn-outline-secondary"
                        >
                            <i class="fa-solid fa-rotate-left me-1"></i>
                            Reset Filter
                        </button>

                    </div>

                </div>

            </div>

            {{-- ========================================================
                TABLE
            ========================================================= --}}
            <div class="card-body">

                <div id="table-kalender-pendidikan"></div>

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

                <div class="modal-header">

                    <h5 class="modal-title fw-bold">
                        <i class="fa-solid fa-calendar-plus me-2 text-primary"></i>
                        Tambah Kalender Pendidikan
                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                    ></button>

                </div>

                <form
                    id="formTambah"
                    method="POST"
                    action="{{ route('admin.akademik.kalender-pendidikan.store') }}"
                >

                    @csrf

                    <div class="modal-body">

                        <div class="row g-3">

                            {{-- Tahun Ajaran --}}
                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Tahun Ajaran
                                    <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="text"
                                    name="tahun_ajaran"
                                    class="form-control"
                                    placeholder="2026/2027"
                                    maxlength="20"
                                    required
                                >

                            </div>

                            {{-- Kategori --}}
                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Kategori
                                </label>

                                <select
                                    name="kategori"
                                    class="form-select"
                                >

                                    <option value="">
                                        Pilih Kategori
                                    </option>

                                    <option value="Akademik">
                                        Akademik
                                    </option>

                                    <option value="Ujian">
                                        Ujian
                                    </option>

                                    <option value="Libur">
                                        Libur
                                    </option>

                                    <option value="Kegiatan">
                                        Kegiatan
                                    </option>

                                    <option value="Lainnya">
                                        Lainnya
                                    </option>

                                </select>

                            </div>

                            {{-- Judul --}}
                            <div class="col-12">

                                <label class="form-label fw-semibold">
                                    Judul Kegiatan
                                    <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="text"
                                    name="judul"
                                    class="form-control"
                                    placeholder="Contoh: Penilaian Tengah Semester"
                                    required
                                >

                            </div>

                            {{-- Deskripsi --}}
                            <div class="col-12">

                                <label class="form-label fw-semibold">
                                    Deskripsi
                                </label>

                                <textarea
                                    name="deskripsi"
                                    class="form-control"
                                    rows="3"
                                    placeholder="Deskripsi kegiatan..."
                                ></textarea>

                            </div>

                            {{-- Tanggal Mulai --}}
                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Tanggal Mulai
                                    <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="date"
                                    name="tanggal_mulai"
                                    class="form-control"
                                    required
                                >

                            </div>

                            {{-- Tanggal Selesai --}}
                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Tanggal Selesai
                                </label>

                                <input
                                    type="date"
                                    name="tanggal_selesai"
                                    class="form-control"
                                >

                            </div>

                            {{-- Warna --}}
                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Warna Kalender
                                </label>

                                <input
                                    type="color"
                                    name="warna"
                                    class="form-control form-control-color"
                                    value="#0d6efd"
                                    title="Pilih warna"
                                >

                            </div>

                            {{-- Urutan --}}
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

                            {{-- Status --}}
                            <div class="col-12">

                                <div class="form-check form-switch">

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

                <div class="modal-header">

                    <h5 class="modal-title fw-bold">
                        <i class="fa-solid fa-pen-to-square me-2 text-primary"></i>
                        Edit Kalender Pendidikan
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
                >

                    @csrf
                    @method('PUT')

                    <div class="modal-body">

                        <div class="row g-3">

                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Tahun Ajaran
                                    <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="text"
                                    name="tahun_ajaran"
                                    id="edit-tahun-ajaran"
                                    class="form-control"
                                    maxlength="20"
                                    required
                                >

                            </div>

                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Kategori
                                </label>

                                <select
                                    name="kategori"
                                    id="edit-kategori"
                                    class="form-select"
                                >

                                    <option value="">
                                        Pilih Kategori
                                    </option>

                                    <option value="Akademik">
                                        Akademik
                                    </option>

                                    <option value="Ujian">
                                        Ujian
                                    </option>

                                    <option value="Libur">
                                        Libur
                                    </option>

                                    <option value="Kegiatan">
                                        Kegiatan
                                    </option>

                                    <option value="Lainnya">
                                        Lainnya
                                    </option>

                                </select>

                            </div>

                            <div class="col-12">

                                <label class="form-label fw-semibold">
                                    Judul Kegiatan
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

                            <div class="col-12">

                                <label class="form-label fw-semibold">
                                    Deskripsi
                                </label>

                                <textarea
                                    name="deskripsi"
                                    id="edit-deskripsi"
                                    class="form-control"
                                    rows="3"
                                ></textarea>

                            </div>

                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Tanggal Mulai
                                    <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="date"
                                    name="tanggal_mulai"
                                    id="edit-tanggal-mulai"
                                    class="form-control"
                                    required
                                >

                            </div>

                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Tanggal Selesai
                                </label>

                                <input
                                    type="date"
                                    name="tanggal_selesai"
                                    id="edit-tanggal-selesai"
                                    class="form-control"
                                >

                            </div>

                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Warna Kalender
                                </label>

                                <input
                                    type="color"
                                    name="warna"
                                    id="edit-warna"
                                    class="form-control form-control-color"
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
                                >

                            </div>

                            <div class="col-12">

                                <div class="form-check form-switch">

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

    <script src="https://unpkg.com/tabulator-tables@6.3.1/dist/js/tabulator.min.js"></script>


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

        .calendar-color {
            width: 28px;
            height: 28px;
            border-radius: 6px;
            border: 1px solid rgba(0, 0, 0, .15);
            display: inline-block;
        }

    </style>


    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const csrfToken =
                document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            /*
            |--------------------------------------------------------------------------
            | Helpers
            |--------------------------------------------------------------------------
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


            function formatTanggal(dateString) {

                if (!dateString) {
                    return '-';
                }

                const date = new Date(dateString);

                if (isNaN(date.getTime())) {
                    return dateString;
                }

                return date.toLocaleDateString('id-ID', {
                    day: '2-digit',
                    month: 'short',
                    year: 'numeric'
                });
            }


            /*
            |--------------------------------------------------------------------------
            | Tabulator
            |--------------------------------------------------------------------------
            */

            const table = new Tabulator(
                '#table-kalender-pendidikan',
                {

                    ajaxURL:
                        "{{ route('admin.akademik.kalender-pendidikan.data') }}",

                    ajaxConfig: 'GET',

                    layout: 'fitColumns',

                    pagination: false,

                    movableRows: true,

                    movableRowsHandle: '.drag-handle',

                    placeholder: 'Belum ada data kalender pendidikan.',

                    ajaxParams: {},

                    ajaxResponse: function (url, params, response) {

                        return response.data ?? [];

                    },

                    columns: [


                        {
                            title: 'Urutan',
                            field: 'urutan',
                            width: 100,
                            hozAlign: 'center',
                            headerHozAlign: 'center',
                            headerSort: false,
                            formatter: function (cell) {

                                return cell.getValue() ?? '-';

                            }
                        },

                        {
                            title: 'Tahun Ajaran',
                            field: 'tahun_ajaran',
                            minWidth: 120,
                        },

                        {
                            title: 'Kegiatan',
                            field: 'judul',
                            minWidth: 220,

                            formatter: function (cell) {

                                const data = cell.getRow().getData();

                                let html = `
                            <div class="fw-semibold">
                                ${escapeHtml(data.judul)}
                            </div>
                        `;

                                if (data.deskripsi) {

                                    html += `
                                <div class="small text-secondary mt-1">
                                    ${escapeHtml(data.deskripsi)}
                                </div>
                            `;

                                }

                                return html;

                            }
                        },

                        {
                            title: 'Periode',
                            minWidth: 190,

                            formatter: function (cell) {

                                const data = cell.getRow().getData();

                                const mulai =
                                    formatTanggal(data.tanggal_mulai);

                                const selesai =
                                    data.tanggal_selesai
                                        ? formatTanggal(data.tanggal_selesai)
                                        : mulai;

                                if (
                                    !data.tanggal_selesai ||
                                    data.tanggal_mulai === data.tanggal_selesai
                                ) {

                                    return mulai;

                                }

                                return `
                            <div>
                                ${mulai}
                                <span class="text-secondary mx-1">
                                    s/d
                                </span>
                                ${selesai}
                            </div>
                        `;

                            }
                        },

                        {
                            title: 'Kategori',
                            field: 'kategori',
                            width: 130,
                            hozAlign: 'center',
                            headerHozAlign: 'center',

                            formatter: function (cell) {

                                const kategori = cell.getValue();

                                if (!kategori) {
                                    return '-';
                                }

                                return `
                            <span class="badge bg-light text-dark border">
                                ${escapeHtml(kategori)}
                            </span>
                        `;

                            }
                        },

                        {
                            title: 'Warna',
                            field: 'warna',
                            width: 75,
                            hozAlign: 'center',
                            headerHozAlign: 'center',

                            formatter: function (cell) {

                                const warna =
                                    cell.getValue() || '#0d6efd';

                                return `
                            <span
                                class="calendar-color"
                                style="background-color:${escapeHtml(warna)}"
                                title="${escapeHtml(warna)}"
                            ></span>
                        `;

                            }
                        },

                        {
                            title: 'Status',
                            field: 'is_active',
                            width: 120,
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

                        {
                            title: 'Aksi',
                            width: 155,
                            hozAlign: 'center',
                            headerHozAlign: 'center',
                            headerSort: false,

                            formatter: function () {

                                return `
                            <div class="d-flex justify-content-center gap-1">

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

                            cellClick: function (e, cell) {

                                const row =
                                    cell.getRow();

                                const data =
                                    row.getData();

                                /*
                                |--------------------------------------------------------------------------
                                | Edit
                                |--------------------------------------------------------------------------
                                */

                                if (
                                    e.target.closest('.btn-edit')
                                ) {

                                    openEditModal(data);

                                    return;
                                }


                                /*
                                |--------------------------------------------------------------------------
                                | Delete
                                |--------------------------------------------------------------------------
                                */

                                if (
                                    e.target.closest('.btn-delete')
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
            | Filter
            |--------------------------------------------------------------------------
            */

            function loadData() {

                const tahunAjaran =
                    document.getElementById('filter-tahun-ajaran').value;

                const kategori =
                    document.getElementById('filter-kategori').value;

                const params = {};

                if (tahunAjaran) {
                    params.tahun_ajaran = tahunAjaran;
                }

                if (kategori) {
                    params.kategori = kategori;
                }

                table.setData(
                    "{{ route('admin.akademik.kalender-pendidikan.data') }}",
                    params
                );

            }


            document
                .getElementById('filter-tahun-ajaran')
                .addEventListener('change', loadData);


            document
                .getElementById('filter-kategori')
                .addEventListener('change', loadData);


            document
                .getElementById('btn-reset-filter')
                .addEventListener('click', function () {

                    document.getElementById(
                        'filter-tahun-ajaran'
                    ).value = '';

                    document.getElementById(
                        'filter-kategori'
                    ).value = '';

                    loadData();

                });


            /*
            |--------------------------------------------------------------------------
            | Update Order
            |--------------------------------------------------------------------------
            */

            function updateOrder() {

                const rows =
                    table.getRows();

                const orders =
                    rows.map(function (row, index) {

                        const data =
                            row.getData();

                        return {
                            id: data.id,
                            urutan: index + 1
                        };

                    });


                const savingOrder =
                    document.getElementById('saving-order');

                savingOrder.style.display = 'flex';


                fetch(
                    "{{ route('admin.akademik.kalender-pendidikan.order') }}",
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

                    .then(async function (response) {

                        const result =
                            await response.json();

                        if (!response.ok) {

                            throw new Error(
                                result.message ||
                                'Gagal menyimpan urutan.'
                            );

                        }

                        return result;

                    })

                    .then(function (result) {

                        /*
                        |--------------------------------------------------------------------------
                        | Update tampilan nomor tanpa reload
                        |--------------------------------------------------------------------------
                        */

                        rows.forEach(function (row, index) {

                            row.update({
                                urutan: index + 1
                            });

                        });

                    })

                    .catch(function (error) {

                        console.error(error);

                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: error.message ||
                                'Urutan gagal disimpan.'
                        });

                        /*
                        |--------------------------------------------------------------------------
                        | Reload jika server gagal
                        |--------------------------------------------------------------------------
                        */

                        table.setData(
                            "{{ route('admin.akademik.kalender-pendidikan.data') }}"
                        );

                    })

                    .finally(function () {

                        savingOrder.style.display = 'none';

                    });

            }


            table.on('rowMoved', function () {

                updateOrder();

            });


            /*
            |--------------------------------------------------------------------------
            | Tambah Data
            |--------------------------------------------------------------------------
            */

            document
                .getElementById('formTambah')
                .addEventListener('submit', function (e) {

                    e.preventDefault();

                    const form =
                        this;

                    const formData =
                        new FormData(form);


                    fetch(
                        form.action,
                        {
                            method: 'POST',

                            headers: {
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': csrfToken
                            },

                            body: formData
                        }
                    )

                        .then(async function (response) {

                            const result =
                                await response.json();

                            if (!response.ok) {

                                if (response.status === 422) {

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

                        })

                        .then(function (result) {

                            bootstrap.Modal
                                .getOrCreateInstance(
                                    document.getElementById('modalTambah')
                                )
                                .hide();

                            form.reset();

                            /*
                            |--------------------------------------------------------------------------
                            | Checkbox aktif kembali checked
                            |--------------------------------------------------------------------------
                            */

                            form.querySelector(
                                '[name="is_active"]'
                            ).checked = true;

                            table.setData();

                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: result.message,
                                timer: 1800,
                                showConfirmButton: false
                            });

                        })

                        .catch(function (error) {

                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: error.message
                            });

                        });

                });


            /*
            |--------------------------------------------------------------------------
            | Open Edit Modal
            |--------------------------------------------------------------------------
            */

            function openEditModal(data) {

                const formEdit =
                    document.getElementById('formEdit');


                formEdit.action =
                    "{{ route('admin.akademik.kalender-pendidikan.update', ':id') }}"
                        .replace(':id', data.id);


                document.getElementById(
                    'edit-tahun-ajaran'
                ).value =
                    data.tahun_ajaran || '';


                document.getElementById(
                    'edit-kategori'
                ).value =
                    data.kategori || '';


                document.getElementById(
                    'edit-judul'
                ).value =
                    data.judul || '';


                document.getElementById(
                    'edit-deskripsi'
                ).value =
                    data.deskripsi || '';


                document.getElementById(
                    'edit-tanggal-mulai'
                ).value =
                    data.tanggal_mulai
                        ? String(data.tanggal_mulai).substring(0, 10)
                        : '';


                document.getElementById(
                    'edit-tanggal-selesai'
                ).value =
                    data.tanggal_selesai
                        ? String(data.tanggal_selesai).substring(0, 10)
                        : '';


                document.getElementById(
                    'edit-warna'
                ).value =
                    data.warna || '#0d6efd';


                document.getElementById(
                    'edit-urutan'
                ).value =
                    data.urutan ?? 0;


                document.getElementById(
                    'edit-is-active'
                ).checked =
                    Boolean(data.is_active);


                bootstrap.Modal
                    .getOrCreateInstance(
                        document.getElementById('modalEdit')
                    )
                    .show();

            }


            /*
            |--------------------------------------------------------------------------
            | Edit Data
            |--------------------------------------------------------------------------
            */

            document
                .getElementById('formEdit')
                .addEventListener('submit', function (e) {

                    e.preventDefault();

                    const form =
                        this;

                    const formData =
                        new FormData(form);

                    /*
                    |--------------------------------------------------------------------------
                    | Laravel method spoofing
                    |--------------------------------------------------------------------------
                    */

                    formData.set('_method', 'PUT');


                    fetch(
                        form.action,
                        {
                            method: 'POST',

                            headers: {
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': csrfToken
                            },

                            body: formData
                        }
                    )

                        .then(async function (response) {

                            const result =
                                await response.json();

                            if (!response.ok) {

                                if (response.status === 422) {

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

                        })

                        .then(function (result) {

                            bootstrap.Modal
                                .getOrCreateInstance(
                                    document.getElementById('modalEdit')
                                )
                                .hide();

                            table.setData();

                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: result.message,
                                timer: 1800,
                                showConfirmButton: false
                            });

                        })

                        .catch(function (error) {

                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: error.message
                            });

                        });

                });


            /*
            |--------------------------------------------------------------------------
            | Delete
            |--------------------------------------------------------------------------
            */

            function deleteData(data) {

                Swal.fire({

                    title: 'Hapus Kalender?',

                    html: `
                Data
                <strong>${escapeHtml(data.judul)}</strong>
                akan dihapus secara permanen.
            `,

                    icon: 'warning',

                    showCancelButton: true,

                    confirmButtonText: 'Ya, Hapus',

                    cancelButtonText: 'Batal',

                    confirmButtonColor: '#dc3545'

                })

                    .then(function (result) {

                        if (!result.isConfirmed) {
                            return;
                        }


                        fetch(
                            "{{ route('admin.akademik.kalender-pendidikan.destroy', ':id') }}"
                                .replace(':id', data.id),
                            {
                                method: 'DELETE',

                                headers: {
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': csrfToken
                                }
                            }
                        )

                            .then(async function (response) {

                                const result =
                                    await response.json();

                                if (!response.ok) {

                                    throw new Error(
                                        result.message ||
                                        'Gagal menghapus data.'
                                    );

                                }

                                return result;

                            })

                            .then(function (result) {

                                table.setData();

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: result.message,
                                    timer: 1800,
                                    showConfirmButton: false
                                });

                            })

                            .catch(function (error) {

                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: error.message
                                });

                            });

                    });

            }

        });

    </script>

@endsection

