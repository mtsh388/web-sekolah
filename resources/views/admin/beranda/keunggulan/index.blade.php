@extends('admin.template.admin')

@section('title', 'Keunggulan')

@section('content-admin')
<link href="{{ asset('assets/css/tabulator_bootstrap5.min.css') }}" rel="stylesheet">
<script src="{{ asset('assets/js/tabulator.min.js') }}"></script>
    <div class="container-fluid">

        <div class="card">

            {{-- ============================================================
                HEADER
            ============================================================ --}}
            <div class="card-header">

                <div class="d-flex justify-content-between align-items-center">

                    <h3 class="card-title mb-0">
                        Keunggulan Sekolah
                    </h3>

                    <a href="{{ route('admin.berandas.keunggulan.create') }}"
                       class="btn btn-primary btn-sm">

                        <i class="fa-solid fa-plus me-1"></i>
                        Tambah Keunggulan

                    </a>

                </div>

            </div>


            {{-- ============================================================
                BODY
            ============================================================ --}}
            <div class="card-body">

                {{-- Alert sukses --}}
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


                {{-- Alert error --}}
                @if($errors->any())

                    <div class="alert alert-danger alert-dismissible fade show">

                        <ul class="mb-0">

                            @foreach($errors->all() as $error)

                                <li>{{ $error }}</li>

                            @endforeach

                        </ul>

                        <button type="button"
                                class="btn-close"
                                data-bs-dismiss="alert">
                        </button>

                    </div>

                @endif


                {{-- ========================================================
                    TOOLBAR
                ========================================================= --}}
                <div class="d-flex flex-wrap gap-2 mb-3">

                    <div class="input-group input-group-sm"
                         style="width: 16rem">

                    <span class="input-group-text">

                        <i class="bi bi-search"
                           aria-hidden="true">
                        </i>

                    </span>

                        <input
                            id="table-filter"
                            type="search"
                            class="form-control"
                            placeholder="Filter rows..."
                            aria-label="Filter rows"
                        >

                    </div>


                    <button id="export-csv"
                            type="button"
                            class="btn btn-sm btn-outline-secondary">

                        <i class="bi bi-filetype-csv me-1"
                           aria-hidden="true">
                        </i>

                        Export CSV

                    </button>


                    <button id="export-json"
                            type="button"
                            class="btn btn-sm btn-outline-secondary">

                        <i class="bi bi-filetype-json me-1"
                           aria-hidden="true">
                        </i>

                        Export JSON

                    </button>


                    <button id="print-table"
                            type="button"
                            class="btn btn-sm btn-outline-secondary">

                        <i class="bi bi-printer me-1"
                           aria-hidden="true">
                        </i>

                        Print

                    </button>

                </div>


                {{-- ========================================================
                    TABULATOR
                ========================================================= --}}
                <div id="keunggulan-table"></div>

            </div>


            {{-- ============================================================
                FOOTER
            ============================================================ --}}
            <div class="card-footer text-secondary small">

                Powered by

                <a href="https://tabulator.info/"
                   target="_blank"
                   rel="noopener">

                    Tabulator

                </a>

                &mdash; vanilla JS, no jQuery required.

            </div>

        </div>

    </div>

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            // ============================================================
            // DATA DARI LARAVEL
            // ============================================================

            const dataKeunggulan = @json($keunggulans);


            // ============================================================
            // TABULATOR
            // ============================================================

            const table = new Tabulator('#keunggulan-table', {

                data: dataKeunggulan,

                layout: 'fitColumns',

                pagination: true,
                movableRows: true,

                paginationSize: 10,

                paginationSizeSelector: [5, 10, 20, 50],

                placeholder: 'Belum ada data keunggulan.',

                columns: [
                    {
                        title: '',
                        formatter: function () {
                            return '<i class="fa-solid fa-grip-vertical text-muted"></i>';
                        },
                        width: 45,
                        hozAlign: 'center',
                        headerSort: false,
                        resizable: false
                    },

                    // --------------------------------------------------------
                    // URUTAN
                    // --------------------------------------------------------

                    {
                        title: 'Urutan',

                        field: 'urutan',

                        width: 100,

                        hozAlign: 'center',

                        formatter: function (cell) {

                            return `
                        <span class="badge text-bg-secondary">
                            ${cell.getValue() ?? 0}
                        </span>
                    `;

                        }
                    },


                    // --------------------------------------------------------
                    // ICON
                    // --------------------------------------------------------

                    {
                        title: 'Icon',
                        field: 'icon',
                        width: 100,
                        hozAlign: 'center',

                        formatter: function (cell) {

                            const icon = cell.getValue();

                            if (!icon) {
                                return '<span class="text-muted">-</span>';
                            }

                            return icon.replace(
                                /class="([^"]*)"/,
                                'class="$1 fs-4"'
                            );

                        },

                        headerSort: false
                    },


                    // --------------------------------------------------------
                    // JUDUL
                    // --------------------------------------------------------

                    {
                        title: 'Judul',

                        field: 'title',

                        minWidth: 200,

                        formatter: function (cell) {

                            const value = cell.getValue() ?? '';

                            return '<strong>' +
                                escapeHtml(value) +
                                '</strong>';

                        }
                    },


                    // --------------------------------------------------------
                    // DESKRIPSI
                    // --------------------------------------------------------

                    {
                        title: 'Deskripsi',

                        field: 'description',

                        minWidth: 300,

                        formatter: function (cell) {

                            const value = cell.getValue() ?? '';

                            const text = value.length > 120
                                ? value.substring(0, 120) + '...'
                                : value;

                            return escapeHtml(text);

                        }
                    },


                    // --------------------------------------------------------
                    // AKSI
                    // --------------------------------------------------------

                    {
                        title: 'Aksi',

                        width: 130,

                        hozAlign: 'center',

                        headerSort: false,
                        frozen:true,

                        formatter: function (cell) {

                            const rowData =
                                cell.getRow().getData();

                            const id = rowData.id;

                            const editUrl =
                                "{{ url('/admin/keunggulan') }}/"
                                + id
                                + "/edit";

                            const deleteUrl =
                                "{{ url('/admin/keunggulan') }}/"
                                + id;


                            return `

                        <div class="d-flex justify-content-center gap-1">

                            <a href="${editUrl}"
                               class="btn btn-sm btn-warning"
                               title="Edit">

                                <i class="fa-solid fa-pen"></i>

                            </a>


                            <form action="${deleteUrl}"
                                  method="POST"
                                  class="delete-keunggulan-form">

                                @csrf

                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-sm btn-danger"
                                    title="Hapus">

                                <i class="fa-solid fa-trash"></i>

                            </button>

                        </form>

                    </div>

`;

                        }

                    }

                ]

            });


            // ============================================================
            // SEARCH / FILTER
            // ============================================================

            const filterInput =
                document.getElementById('table-filter');


            filterInput.addEventListener(
                'keyup',
                function () {

                    const value = this.value.trim();

                    if (value === '') {

                        table.clearFilter();

                        return;

                    }

                    table.setFilter([
                        [
                            'title',
                            'like',
                            value
                        ],

                        'or',

                        [
                            'description',
                            'like',
                            value
                        ],

                        'or',

                        [
                            'icon',
                            'like',
                            value
                        ]
                    ]);

                }
            );


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
                            'keunggulan.csv'
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
                            'keunggulan.json'
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
            // CONFIRM DELETE
            // ============================================================

            document.addEventListener(
                'submit',
                function (event) {

                    if (
                        event.target.classList.contains(
                            'delete-keunggulan-form'
                        )
                    ) {

                        const confirmed = confirm(
                            'Yakin ingin menghapus keunggulan ini?'
                        );

                        if (!confirmed) {

                            event.preventDefault();

                        }

                    }

                }
            );
            table.on('rowMoved', function (row) {

                const rows = table.getRows();

                const dataUrutan = rows.map(function (row, index) {

                    return {
                        id: row.getData().id,
                        urutan: index + 1
                    };

                });

                updateUrutan(dataUrutan);

            });

            function updateUrutan(data) {

                fetch("{{ route('admin.berandas.keunggulan.urutan') }}", {

                    method: 'POST',

                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },

                    body: JSON.stringify({
                        data: data
                    })

                })

                    .then(response => {

                        if (!response.ok) {
                            throw new Error(
                                'Gagal menghubungi server.'
                            );
                        }

                        return response.json();

                    })

                    .then(result => {

                        if (result.success) {

                            // Update angka urutan di tabel
                            table.getRows().forEach(function (row, index) {

                                row.update({
                                    urutan: index + 1
                                });

                            });

                            console.log(
                                'Urutan berhasil disimpan.'
                            );

                        } else {

                            alert(
                                result.message ??
                                'Gagal menyimpan urutan.'
                            );

                        }

                    })

                    .catch(error => {

                        console.error(
                            'Error:',
                            error
                        );

                        alert(
                            'Terjadi kesalahan saat menyimpan urutan.'
                        );

                    });

            }

            // ============================================================
            // ESCAPE HTML
            // ============================================================

            function escapeHtml(value) {

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

