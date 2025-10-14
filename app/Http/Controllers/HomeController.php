<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\Fakultas;
use App\Models\TipeAktifitasMahasiswa;
use App\Models\AktifitasMahasiswa;
use App\Models\Prodi;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        return Auth::user()->role === 'admin'
            ? $this->homeAdmin($request)
            : view('user.home.data');
    }

    private function homeAdmin($request)
    {
        // Statistik umum
        $user = User::where('role', 'user')->count();
        $admin = User::where('role', 'admin')->count();
        $prodi = Prodi::count();
        $fakultas = Fakultas::count();

        $tipe = TipeAktifitasMahasiswa::get();
        $aktifitas_mahasiswa = AktifitasMahasiswa::where('status', 'Menunggu Validasi')->get();

        // Filter
        $year = (int) $request->query('year', now()->year);
        $tipe_id = $request->query('tipe_id', '');

        // Query dasar
        $baseQuery = AktifitasMahasiswa::where('status', 'Terima')
            ->whereYear('tanggal_mulai', $year);

        if (Auth::check() && Auth::user()->role === 'user') {
            $baseQuery->where('user_id', Auth::id());
        }

        // =============================
        // 1️⃣ CHART BAR (per bulan)
        // =============================
        if (!empty($tipe_id)) {
            // Filter satu tipe
            $q = (clone $baseQuery)->where('tipe_aktifitas_mahasiswa_id', $tipe_id);

            $map = $q->selectRaw('MONTH(tanggal_mulai) AS bulan, COUNT(*) AS total')
                ->groupBy('bulan')
                ->orderBy('bulan')
                ->pluck('total', 'bulan')
                ->toArray();

            $series = [];
            for ($m = 1; $m <= 12; $m++) {
                $series[] = $map[$m] ?? 0;
            }

            $chartData = [[
                'name' => TipeAktifitasMahasiswa::find($tipe_id)->name ?? 'Semua',
                'data' => $series,
            ]];
        } else {
            // Semua tipe = multi-series
            $chartData = [];
            foreach ($tipe as $t) {
                $q = (clone $baseQuery)->where('tipe_aktifitas_mahasiswa_id', $t->id);
                $map = $q->selectRaw('MONTH(tanggal_mulai) AS bulan, COUNT(*) AS total')
                    ->groupBy('bulan')
                    ->pluck('total', 'bulan')
                    ->toArray();

                $series = [];
                for ($m = 1; $m <= 12; $m++) {
                    $series[] = $map[$m] ?? 0;
                }

                $chartData[] = [
                    'name' => $t->name,
                    'data' => $series,
                ];
            }
        }

        // =============================
        // 2️⃣ CHART DONUT (per tipe)
        // =============================
        $donutLabels = [];
        $donutValues = [];

        if (empty($tipe_id)) {
            // Hitung total per tipe
            foreach ($tipe as $t) {
                $count = (clone $baseQuery)->where('tipe_aktifitas_mahasiswa_id', $t->id)->count();
                $donutLabels[] = $t->name;
                $donutValues[] = $count;
            }
        } else {
            // Satu tipe saja
            $t = TipeAktifitasMahasiswa::find($tipe_id);
            $count = (clone $baseQuery)->where('tipe_aktifitas_mahasiswa_id', $tipe_id)->count();
            $donutLabels[] = $t->name ?? 'Tidak diketahui';
            $donutValues[] = $count;
        }

        return view('home.data', compact(
            'fakultas',
            'prodi',
            'admin',
            'user',
            'tipe',
            'aktifitas_mahasiswa',
            'year',
            'tipe_id',
            'chartData',
            'donutLabels',
            'donutValues'
        ));
    }
}
