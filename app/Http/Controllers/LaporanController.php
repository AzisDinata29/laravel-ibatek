<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\AktifitasMahasiswa;
use App\Models\TipeAktifitasMahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $tipe = TipeAktifitasMahasiswa::all();
        $prodis = Prodi::orderBy('name', 'asc')->get();
        $filters = [
            'status' => $request->get('status', ''),
            'year' => $request->get('year', ''),
            'angkatan' => $request->get('angkatan', ''),
            'prodi' => $request->get('prodi', ''),
            'tipe_id' => $request->get('tipe_id', ''),
        ];

        $data = collect();

        if ($request->filled('status') || $request->filled('year') || $request->filled('angkatan') || $request->filled('prodi') || $request->filled('tipe_id')) {
            $query = AktifitasMahasiswa::query()
                ->with(['user', 'tipe'])
                ->when($filters['status'], function ($q) use ($filters) {
                    return $q->where('status', $filters['status']);
                })
                ->when($filters['year'], function ($q) use ($filters) {
                    return $q->whereYear('tanggal_mulai', $filters['year']);
                })
                ->when($filters['tipe_id'], function ($q) use ($filters) {
                    return $q->where('tipe_aktifitas_mahasiswa_id', $filters['tipe_id']);
                })
                ->when($filters['prodi'], function ($q) use ($filters) {
                    return $q->whereHas('user', function ($u) use ($filters) {
                        $u->where('prodi', $filters['prodi']);
                    });
                })
                ->when($filters['angkatan'], function ($q) use ($filters) {
                    return $q->whereHas('user', function ($u) use ($filters) {
                        $u->where('angkatan', $filters['angkatan']);
                    });
                });

            if (Auth::user()->role === 'user') {
                $query->where('user_id', Auth::id());
            }

            $data = $query->orderBy('tanggal_mulai', 'asc')->get();
        }

        return view('laporan.index', compact('data', 'filters', 'tipe', 'prodis'));
    }

    public function cetak(Request $request)
    {
        $tipe = TipeAktifitasMahasiswa::all();

        $filters = [
            'status' => $request->get('status', ''),
            'year' => $request->get('year', ''),
            'angkatan' => $request->get('angkatan', ''),
            'prodi' => $request->get('prodi', ''),
            'tipe_id' => $request->get('tipe_id', ''),
        ];

        if (
            !$request->filled('status') &&
            !$request->filled('year') &&
            !$request->filled('angkatan') &&
            !$request->filled('prodi') &&
            !$request->filled('tipe_id')
        ) {
            return redirect()->route('laporan.index')->with('warning', 'Silakan pilih filter terlebih dahulu sebelum mencetak laporan.');
        }

        $query = AktifitasMahasiswa::query()
            ->with(['user', 'tipe'])
            ->when($filters['status'], function ($q) use ($filters) {
                return $q->where('status', $filters['status']);
            })
            ->when($filters['year'], function ($q) use ($filters) {
                return $q->whereYear('tanggal_mulai', $filters['year']);
            })
            ->when($filters['tipe_id'], function ($q) use ($filters) {
                return $q->where('tipe_aktifitas_mahasiswa_id', $filters['tipe_id']);
            })
            ->when($filters['prodi'], function ($q) use ($filters) {
                return $q->whereHas('user', function ($u) use ($filters) {
                    $u->where('prodi', $filters['prodi']);
                });
            })
            ->when($filters['angkatan'], function ($q) use ($filters) {
                return $q->whereHas('user', function ($u) use ($filters) {
                    $u->where('angkatan', $filters['angkatan']);
                });
            });

        if (Auth::user()->role === 'user') {
            $query->where('user_id', Auth::id());
        }

        $data = $query->orderBy('tanggal_mulai', 'asc')->get();

        $logoPath = public_path('/logo_teknokrat.png');
        $logoData = base64_encode(File::get($logoPath));
        $logoType = File::mimeType($logoPath);
        $logoBase64 = 'data:' . $logoType . ';base64,' . $logoData;

        $logoIbatekPath = public_path('/ibtk.png');
        $logoIbatekData = base64_encode(File::get($logoIbatekPath));
        $logoIbatekType = File::mimeType($logoIbatekPath);
        $logoIbatekBase64 = 'data:' . $logoIbatekType . ';base64,' . $logoIbatekData;

        $pdf = Pdf::loadView('laporan.cetak', [
            'data' => $data,
            'filters' => $filters,
            'tipe' => $tipe,
            'logo' => $logoBase64,
            'logo_ibatek' => $logoIbatekBase64,
        ])->setPaper('a4', 'portrait');

        $filename = 'Laporan_Aktifitas_' . now()->format('Ymd_His') . '.pdf';
        return $pdf->download($filename);
    }
}
