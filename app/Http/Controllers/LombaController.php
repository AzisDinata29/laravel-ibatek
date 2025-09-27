<?php

namespace App\Http\Controllers;

use App\Models\Lomba;
use Illuminate\Http\Request;

class LombaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lombas = Lomba::all();
        return view('kegiatan.lomba.index', compact('lombas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kegiatan.lomba.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'organizer' => 'required|string|max:255',
            'date' => 'required|date',
        ]);

        Lomba::create($validatedData);

        return redirect()->route('lomba')->with('success', 'Data lomba berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lomba $lomba)
    {
        return view('kegiatan.lomba.edit', compact('lomba'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lomba $lomba)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'organizer' => 'required|string|max:255',
            'date' => 'required|date',
        ]);

        $lomba->update($validatedData);

        return redirect()->route('lomba')->with('success', 'Data lomba berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lomba $lomba)
    {
        $lomba->delete();

        return redirect()->route('lomba')->with('success', 'Data lomba berhasil dihapus.');
    }
}