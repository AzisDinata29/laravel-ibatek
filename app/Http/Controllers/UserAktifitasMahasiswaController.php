<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipeAktifitasMahasiswa;
use App\Models\AktifitasMahasiswa;
use Illuminate\Support\Facades\Auth;
use App\Models\Organization;
use Illuminate\Routing\Controllers\HasMiddleware;

class UserAktifitasMahasiswaController extends Controller implements HasMiddleware
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
        $query = AktifitasMahasiswa::where('user_id', Auth::user()->id);

        if ($request->filled('semester')) {
            $query->where('semester', $request->semester);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('tipe')) {
            $query->whereHas('tipe', function ($q) use ($request) {
                $q->where('name', $request->tipe);
            });
        }

        $data = $query->orderBy('semester', 'desc')->get();
        $tipe = TipeAktifitasMahasiswa::get();

        return view('user.aktifitas-mahasiswa.data', compact('data', 'tipe'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tipe = TipeAktifitasMahasiswa::get(['id', 'name', 'label', 'label_detail']);
        $organizations = Organization::all();
        return view('user.aktifitas-mahasiswa.create', compact('tipe', 'organizations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'tipe_aktifitas_mahasiswa_id' => 'required|exists:tipe_aktifitas_mahasiswas,id',
            'label'           => 'required|string|max:1000',
            'label_detail'    => 'required|string|max:1000',
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'semester'        => 'required|in:1,2,3,4,5,6,7,8',
            'durasi'          => 'required|string|max:50',
            'file'            => 'required|string|max:2000',
            'keterangan'      => 'required|string|max:2000',
            'dosen_pembimbing'      => 'nullable|string|max:2000',
            'mitra'      => 'nullable|string|max:2000',
        ]);

        try {

            AktifitasMahasiswa::create([
                'user_id'                     => Auth::id(),
                'tipe_aktifitas_mahasiswa_id' => $data['tipe_aktifitas_mahasiswa_id'],
                'label'                       => $data['label'],
                'label_detail'                => $data['label_detail'],
                'tanggal_mulai'               => $data['tanggal_mulai'],
                'tanggal_selesai'             => $data['tanggal_selesai'],
                'semester'                    => (string) $data['semester'],
                'durasi'                      => $data['durasi'],
                'file'                        => $data['file'],
                'keterangan'                  => $data['keterangan'] ?? null,
                'dosen_pembimbing'                  => $data['dosen_pembimbing'] ?? null,
                'mitra'                  => $data['mitra'] ?? null,
                'validasi_user_id'            => null,
            ]);

            return redirect()
                ->route('user-aktifitas-mahasiswa.index')
                ->with('success', 'Aktifitas berhasil ditambahkan dan menunggu validasi.');
        } catch (\Throwable $e) {
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
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
        $aktifitas = AktifitasMahasiswa::with('tipe')->findOrFail($id);
        $organizations = Organization::all();
        return view('user.aktifitas-mahasiswa.edit', compact('aktifitas', 'organizations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $aktifitas = AktifitasMahasiswa::findOrFail($id);

        $data = $request->validate([
            'label'           => 'required|string|max:1000',
            'label_detail'    => 'required|string|max:1000',
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'semester'        => 'required|in:1,2,3,4,5,6,7,8',
            'durasi'          => 'required|string|max:50',
            'file'            => 'nullable|string|max:2000',
            'keterangan'      => 'required|string|max:2000',
        ]);

        try {
            $aktifitas->update([
                'label'           => $data['label'],
                'label_detail'    => $data['label_detail'],
                'tanggal_mulai'   => $data['tanggal_mulai'],
                'tanggal_selesai' => $data['tanggal_selesai'],
                'semester'        => (string) $data['semester'],
                'durasi'          => $data['durasi'],
                'dosen_pembimbing' => $request->dosen_pembimbing,
                'mitra'          => $request->mitra,
                'file'            => $data['file'],
                'status'            => 'Menunggu Validasi',
                'keterangan'      => $data['keterangan'] ?? null,
            ]);

            return redirect()
                ->route('user-aktifitas-mahasiswa.index')
                ->with('success', 'Aktifitas berhasil diperbarui.');
        } catch (\Throwable $e) {
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbarui data.');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        AktifitasMahasiswa::findOrFail($id)->delete();
        return redirect()
            ->route('user-aktifitas-mahasiswa.index')
            ->with('success', 'Aktifitas berhasil dihapus.');
    }
}
