<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipeAktifitasMahasiswa;
use App\Models\AktifitasMahasiswa;
use App\Models\User;
use App\Models\Fakultas;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class AktifitasMahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with(['fakultas_detail', 'prodi_detail'])
            ->where('role', 'user');

        $hasFilter = false;

        // Filter wajib
        if ($request->filled('fakultas_id')) {
            $query->where('fakultas', $request->fakultas_id);
            $hasFilter = true;
        }

        if ($request->filled('prodi_id')) {
            $query->where('prodi', $request->prodi_id);
            $hasFilter = true;
        }

        if ($request->filled('angkatan')) {
            $query->where('angkatan', $request->angkatan);
            $hasFilter = true;
        }

        $users = ($request->filled('fakultas_id') && $request->filled('prodi_id') && $request->filled('angkatan'))
            ? $query->get()
            : collect();

        $fakultas = Fakultas::orderBy('name')->get(['id', 'name']);

        $angkatanList = User::where('role', 'user')
            ->select('angkatan')
            ->distinct()
            ->orderBy('angkatan', 'desc')
            ->pluck('angkatan');

        return view('master.aktifitas-mahasiswa.data', compact('users', 'fakultas', 'angkatanList'));
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
    public function show($id, Request $request)
    {
        $user = User::with(['fakultas_detail', 'prodi_detail'])->findOrFail($id);
        $tipeAktifitas = TipeAktifitasMahasiswa::orderBy('name')->get();
        $query = AktifitasMahasiswa::where('user_id', $user->id)
            ->where('status', 'Terima');
        if ($request->filled('semester')) {
            $query->where('semester', $request->semester);
        }
        if ($request->filled('tipe_id')) {
            $query->where('tipe_aktifitas_mahasiswa_id', $request->tipe_id);
        }
        $aktifitas = $query->orderBy('semester', 'desc')->get();
        return view('master.aktifitas-mahasiswa.detail', compact(
            'user',
            'aktifitas',
            'tipeAktifitas'
        ));
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

    public function cetak(Request $request, string $id)
    {
        $tipeId = $request->get('tipe_id');

        $user = User::with(['fakultas_detail', 'prodi_detail'])->findOrFail($id);
        $semesters = [];
        for ($s = 1; $s <= 8; $s++) {
            $rows = AktifitasMahasiswa::when(!empty($tipeId), function ($q) use ($tipeId) {
                return $q->where('tipe_aktifitas_mahasiswa_id', $tipeId);
            })
                ->where('user_id', $user->id)
                ->where('status', 'Terima')
                ->where('semester', (string) $s)
                ->orderBy('tanggal_mulai')
                ->get();

            $items = $rows->map(function ($r) {
                $tglMulai   = Carbon::parse($r->tanggal_mulai)->format('d/m/Y');
                $tglSelesai = Carbon::parse($r->tanggal_selesai)->format('d/m/Y');

                return [
                    'jenis' => $r->label,
                    'tipe' => $r->tipe->name ?? '-',
                    'tgl'   => ($r->tanggal_mulai === $r->tanggal_selesai)
                        ? $tglMulai
                        : $tglMulai . ' - ' . $tglSelesai,
                    'waktu' => $r->durasi ? $r->durasi . ' jam' : '',
                    'ket'   => $r->keterangan ?: '',
                ];
            })->values();

            for ($i = $items->count(); $i < 35; $i++) {
                $items->push(['tipe' => '', 'jenis' => '', 'tgl' => '', 'waktu' => '', 'ket' => '']);
            }

            $semesters[] = [
                'no'    => $this->toRoman((int) $s),
                'judul' => $this->angkaKeKata($s),
                'items' => $items,
            ];
        }

        $pdf = Pdf::loadView('master.aktifitas-mahasiswa.cetak', [
            'user'      => $user,
            'semesters' => $semesters,
        ])->setPaper('A4', 'portrait');

        $filename = "Buku-Aktivitas_Semester-1-8-{$user->name}.pdf";
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
