<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TipeAktifitasMahasiswa;
use App\Models\AktifitasMahasiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\HasMiddleware;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class UserPrintAktifitasMahasiswaController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            'userCheck',
        ];
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

    public function cetak(Request $request, string $id)
    {
        $data = $request->validate([
            'semester' => 'nullable|integer|between:1,8',
        ]);
        $user = User::with(['fakultas_detail', 'prodi_detail'])->findOrFail($id);
        $loopSemesters = !empty($data['semester'])
            ? [(int) $data['semester']]
            : range(1, 8);

        $semesters = [];

        foreach ($loopSemesters as $s) {
            $rows = AktifitasMahasiswa::where('user_id', $user->id)
                ->where('status', 'Terima')
                ->where('semester', (string) $s)
                ->orderBy('tanggal_mulai')
                ->get();

            $totalDurasi = (int) $rows->sum('durasi');

            $items = $rows->map(function ($r) {
                $tglMulai   = Carbon::parse($r->tanggal_mulai)->format('d/m/Y');
                $tglSelesai = Carbon::parse($r->tanggal_selesai)->format('d/m/Y');

                return [
                    'jenis' => $r->label . ' - ' . $r->label_detail,
                    'tipe'  => $r->tipe->name ?? '-',
                    'tgl'   => ($r->tanggal_mulai === $r->tanggal_selesai) ? $tglMulai : $tglMulai . ' - ' . $tglSelesai,
                    'waktu' => $r->durasi ? $r->durasi . ' jam' : '',
                    'ket'   => $r->keterangan ?: '',
                ];
            })->values();

            for ($i = $items->count(); $i < 35; $i++) {
                $items->push(['tipe' => '', 'jenis' => '', 'tgl' => '', 'waktu' => '', 'ket' => '']);
            }

            $semesters[] = [
                'no'         => $this->toRoman($s),
                'judul'      => $this->angkaKeKata($s),
                'items'      => $items,
                'total'      => $totalDurasi,
                'kesimpulan' => $this->nilaiAktivitas($totalDurasi),
            ];
        }

        $pdf = Pdf::loadView('master.aktifitas-mahasiswa.cetak', [
            'user'      => $user,
            'semesters' => $semesters,
        ])->setPaper('A4', 'portrait');

        if (count($loopSemesters) === 1) {
            $rom = $this->toRoman($loopSemesters[0]);
            $filename = "Buku-Aktivitas-Semester-{$rom}-{$user->name}-{$user->npm}.pdf";
        } else {
            $filename = "Buku-Aktivitas-Semester-1-sampai-8-{$user->name}-{$user->npm}.pdf";
        }

        return $pdf->download($filename);
    }

    private function toRoman(int $num): string
    {
        if ($num <= 0 || $num >= 4000) {
            return (string) $num;
        }
        $map = [
            'M'  => 1000,
            'CM' => 900,
            'D'  => 500,
            'CD' => 400,
            'C'  => 100,
            'XC' => 90,
            'L'  => 50,
            'XL' => 40,
            'X'  => 10,
            'IX' => 9,
            'V'  => 5,
            'IV' => 4,
            'I'  => 1,
        ];
        $res = '';
        foreach ($map as $roman => $val) {
            while ($num >= $val) {
                $res .= $roman;
                $num -= $val;
            }
        }
        return $res;
    }

    private function angkaKeKata($n)
    {
        $map = [1 => 'Satu', 2 => 'Dua', 3 => 'Tiga', 4 => 'Empat', 5 => 'Lima', 6 => 'Enam', 7 => 'Tujuh', 8 => 'Delapan'];
        return isset($map[(int)$n]) ? $map[(int)$n] : (string)$n;
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
