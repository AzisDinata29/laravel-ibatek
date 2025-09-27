<?php

namespace App\Http\Controllers;

use App\Models\Kepaniitiaan;
use Illuminate\Http\Request;

class KepaniitiaanController extends Controller
{
    public function index()
    {
        $kepaniitiaans = Kepaniitiaan::all();
        return view('kegiatan.kepanitiaan.index', compact('kepaniitiaans'));
    }

    public function create()
    {
        return view('kegiatan.kepanitiaan.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'event_name' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        Kepaniitiaan::create($validatedData);
        return redirect()->route('kepanitiaan')->with('success', 'Kepanitiaan berhasil ditambahkan.');
    }

    public function edit(Kepaniitiaan $kepanitiaan)
    {
        return view('kegiatan.kepanitiaan.edit', compact('kepanitiaan'));
    }

    public function update(Request $request, Kepaniitiaan $kepanitiaan)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'event_name' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $kepanitiaan->update($validatedData);

        return redirect()->route('kepanitiaan')->with('success', 'Kepanitiaan berhasil diperbarui.');
    }

    public function destroy(Kepaniitiaan $kepanitiaan)
    {
        $kepanitiaan->delete();

        return redirect()->route('kepanitiaan')->with('success', 'Kepanitiaan berhasil dihapus.');
    }
}