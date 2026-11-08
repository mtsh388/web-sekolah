<?php

namespace App\Http\Controllers\Admin;

use App\Exports\PpdbExport;
use App\Http\Controllers\Controller;
use App\Models\Ppdb;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PpdbAdminController extends Controller
{
    /**
     * Menampilkan daftar PPDB
     */
    public function index(Request $request)
    {
        $query = Ppdb::query();

        // Filter tahun
        if ($request->filled('tahun')) {
            $query->where(
                'tahun_pendaftaran',
                $request->tahun
            );
        }

        // Filter status
        if ($request->filled('status')) {
            $query->where(
                'status',
                $request->status
            );
        }

        // Search
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where(
                    'nomor_pendaftaran',
                    'like',
                    "%{$search}%"
                )

                    ->orWhere(
                        'nama_lengkap',
                        'like',
                        "%{$search}%"
                    )

                    ->orWhere(
                        'nisn',
                        'like',
                        "%{$search}%"
                    )

                    ->orWhere(
                        'nik',
                        'like',
                        "%{$search}%"
                    )

                    ->orWhere(
                        'sekolah_asal',
                        'like',
                        "%{$search}%"
                    );
            });
        }

        $ppdbs = $query
            ->orderByDesc('tahun_pendaftaran')
            ->orderByDesc('created_at')
            ->paginate(15)
            ->withQueryString();

        // Daftar tahun yang tersedia
        $tahunPendaftarans = Ppdb::query()
            ->select('tahun_pendaftaran')
            ->distinct()
            ->orderByDesc('tahun_pendaftaran')
            ->pluck('tahun_pendaftaran');

        // Statistik
        $totalPendaftar = Ppdb::count();

        $totalMenunggu = Ppdb::where(
            'status',
            'menunggu'
        )->count();

        $totalDiverifikasi = Ppdb::where(
            'status',
            'diverifikasi'
        )->count();

        $totalDiterima = Ppdb::where(
            'status',
            'diterima'
        )->count();

        $totalDitolak = Ppdb::where(
            'status',
            'ditolak'
        )->count();

        return view(
            'admin.ppdb.index',
            compact(
                'ppdbs',
                'tahunPendaftarans',
                'totalPendaftar',
                'totalMenunggu',
                'totalDiverifikasi',
                'totalDiterima',
                'totalDitolak'
            )
        );
    }

    /**
     * Download Excel
     */
    public function downloadExcel()
    {
        $filename = 'Data-PPDB-' . now()->format('Y-m-d-His') . '.xlsx';

        return Excel::download(
            new PpdbExport,
            $filename
        );
    }
}
