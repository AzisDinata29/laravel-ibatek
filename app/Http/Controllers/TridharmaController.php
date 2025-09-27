<?php

namespace App\Http\Controllers;

use App\Models\Tridharma;
use Illuminate\Http\Request;

class TridharmaController extends Controller
{
    /**
     * Menampilkan daftar semua data tridharma.
     */
    public function index()
    {
        $tridharmas = Tridharma::all();
        return view('kegiatan.tridharma.index', compact('tridharmas'));
    }

    /**
     * Menampilkan form untuk membuat data tridharma baru.
     */
    public function create()
    {
        return view('kegiatan.tridharma.create');
    }

    /**
     * Menyimpan data tridharma yang baru dibuat ke database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'researcher_name' => 'nullable|string',
            'date' => 'required|date',
        ]);

        Tridharma::create($validatedData);
        return redirect()->route('tridharma')->with('success', 'Data tridharma berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit data tridharma yang ada.
     */
    public function edit(Tridharma $tridharma)
    {
        return view('kegiatan.tridharma.edit', compact('tridharma'));
    }

    /**
     * Memperbarui data tridharma yang ada di database.
     */
    public function update(Request $request, Tridharma $tridharma)
    {
        $validatedData = $request->validate([
            'type' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'researcher_name' => 'nullable|string',
            'date' => 'required|date',
        ]);

        $tridharma->update($validatedData);
        return redirect()->route('tridharma')->with('success', 'Data tridharma berhasil diperbarui.');
    }

    /**
     * Menghapus data tridharma dari database.
     */
    public function destroy(Tridharma $tridharma)
    {
        $tridharma->delete();
        return redirect()->route('tridharma')->with('success', 'Data tridharma berhasil dihapus.');
    }
}
