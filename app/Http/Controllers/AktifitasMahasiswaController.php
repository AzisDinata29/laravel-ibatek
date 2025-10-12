<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipeAktifitasMahasiswa;
use App\Models\AktifitasMahasiswa;
use App\Models\User;
use App\Models\Fakultas;
use Illuminate\Support\Facades\Auth;

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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
