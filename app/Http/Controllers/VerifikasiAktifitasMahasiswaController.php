<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TipeAktifitasMahasiswa;
use App\Models\AktifitasMahasiswa;
use Illuminate\Support\Facades\Auth;
use App\Models\Organization;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\Controllers\HasMiddleware;

class VerifikasiAktifitasMahasiswaController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            'adminCheck',
        ];
    }

    public function index(Request $request)
    {
        $query = AktifitasMahasiswa::query();

        if ($request->filled('semester')) {
            $query->where('semester', $request->semester);
        }

        if ($request->filled('tipe')) {
            $query->whereHas('tipe', function ($q) use ($request) {
                $q->where('name', $request->tipe);
            });
        }

        if ($request->filled('name')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'LIKE', '%' . trim($request->name) . '%');
            });
        }

        if ($request->filled('angkatan')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('role', 'user')
                    ->where('angkatan', $request->angkatan);
            });
        }
        $data = $query->with(['user', 'tipe'])->where('status', 'Menunggu Validasi')->orderBy('semester', 'desc')->get();
        $tipe = TipeAktifitasMahasiswa::get();

        $angkatanList = User::where('role', 'user')
            ->select('angkatan')
            ->distinct()
            ->orderBy('angkatan', 'desc')
            ->pluck('angkatan');

        return view('master.verifikasi-aktifitas-mahasiswa.data', compact('data', 'tipe', 'angkatanList'));
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
        $aktifitas = AktifitasMahasiswa::with(['tipe', 'user'])->findOrFail($id);
        $organizations = Organization::all();
        return view('master.verifikasi-aktifitas-mahasiswa.edit', compact('aktifitas', 'organizations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $aktifitas = AktifitasMahasiswa::findOrFail($id);

        $data = $request->validate([
            'label' => 'required|string|max:255',
            'label_detail' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'semester' => 'required|string',
            'durasi' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
            'status' => 'required|in:Terima,Tidak Diterima',
            'keterangan_validasi' => 'nullable|string|max:255',
        ]);

        try {
            $aktifitas->update([
                'label' => $data['label'],
                'label_detail' => $data['label_detail'],
                'tanggal_mulai' => $data['tanggal_mulai'],
                'tanggal_selesai' => $data['tanggal_selesai'],
                'semester' => (string) $data['semester'],
                'durasi' => $data['durasi'] ?? null,
                'keterangan' => $data['keterangan'] ?? null,
                'status' => $data['status'],
                'keterangan_validasi' => $data['keterangan_validasi'] ?? null,
                'validasi_user_id' => Auth::id(),
            ]);

            return redirect()
                ->route('verifikasi-aktifitas-mahasiswa.index')
                ->with('success', 'Aktifitas berhasil diperbarui.');
        } catch (\Throwable $e) {
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
