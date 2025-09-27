<?php

namespace App\Http\Controllers;

use App\Models\Ukm;
use Illuminate\Http\Request;

class UkmController extends Controller
{
    public function index()
    {
        $ukms = Ukm::all();
        return view('kegiatan.ukm.index', compact('ukms'));
    }

    public function create()
    {
        return view('kegiatan.ukm.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Ukm::create($validatedData);
        return redirect()->route('ukm.index')->with('success', 'UKM berhasil ditambahkan.');
    }

    public function edit(Ukm $ukm)
    {
        return view('kegiatan.ukm.edit', compact('ukm'));
    }

    public function update(Request $request, Ukm $ukm)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $ukm->update($validatedData);
        return redirect()->route('ukm.index')->with('success', 'UKM berhasil diperbarui.');
    }

    public function destroy(Ukm $ukm)
    {
        $ukm->delete();
        return redirect()->route('ukm.index')->with('success', 'UKM berhasil dihapus.');
    }
}
