<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TipeAktifitasMahasiswa;
use App\Models\AktifitasMahasiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UserPrintAktifitasMahasiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->role == 'user') {
                return $next($request);
            }
            return Redirect::route('login');
        });
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = User::with(['fakultas_detail', 'prodi_detail'])->findOrFail(Auth::id());
        $tipeAktifitas = TipeAktifitasMahasiswa::orderBy('name')->get();

        $statusDiterima = 'Terima';

        $base = AktifitasMahasiswa::where('user_id', $user->id)
            ->where('status', $statusDiterima);

        if ($request->filled('semester')) {
            $base->where('semester', (string) $request->semester);
        }
        if ($request->filled('tipe_id')) {
            $base->where('tipe_aktifitas_mahasiswa_id', $request->tipe_id);
        }

        $rows = $base->orderBy('tanggal_mulai')->get();

        $visibleSemesters = $request->filled('semester')
            ? [(int) $request->semester]
            : range(1, 8);

        $bySemester = collect($visibleSemesters)->mapWithKeys(function ($s) use ($rows) {
            $items = $rows->where('semester', (string) $s)->values();

            $totalDurasi = $items->sum(function ($r) {
                return (int) ($r->durasi ?? 0);
            });

            return [$s => [
                'items'             => $items,
                'total_durasi'       => $totalDurasi,
                'jumlah_kegiatan'   => $items->count(),
                'nilai'             => $this->nilaiAktivitas($totalDurasi),
            ]];
        });

        return view('user.cetak-aktifitas-mahasiswa.detail', compact(
            'user',
            'tipeAktifitas',
            'rows',
            'bySemester',
            'visibleSemesters'
        ));
    }

    private function nilaiAktivitas(int $totalJam): string
    {
        if ($totalJam >= 70) {
            return 'Baik';
        }
        if ($totalJam >= 50) {
            return 'Kurang Baik';
        }
        return 'Kurang / Tidak Aktif Kegiatan';
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
