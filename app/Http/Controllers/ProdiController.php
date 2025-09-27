<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data prodi dari database
        $prodis = Prodi::with('fakultas')->get();
        return view('akademik.prodi.index', compact('prodis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fakultas = Fakultas::all();
        return view('akademik.prodi.create', compact('fakultas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'fakultas_id' => 'required|exists:fakultas,id',
            'name' => 'required|string|max:255',
        ]);

        Prodi::create($validatedData);
        return redirect()->route('prodi')->with('success', 'Program Studi berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prodi $prodi)
    {
        $fakultas = Fakultas::all();
        return view('akademik.prodi.edit', compact('prodi', 'fakultas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prodi $prodi)
    {
        $validatedData = $request->validate([
            'fakultas_id' => 'required|exists:fakultas,id',
            'name' => 'required|string|max:255',
        ]);

        $prodi->update($validatedData);
        return redirect()->route('prodi')->with('success', 'Program Studi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prodi $prodi)
    {
        $prodi->delete();
        return redirect()->route('prodi')->with('success', 'Program Studi berhasil dihapus.');
    }
}