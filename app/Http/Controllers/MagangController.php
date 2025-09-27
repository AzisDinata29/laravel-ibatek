<?php

namespace App\Http\Controllers;

use App\Models\Magang;
use Illuminate\Http\Request;

class MagangController extends Controller
{
    /**
     * Menampilkan daftar semua data magang.
     */
    public function index()
    {
        $magangs = Magang::all();
        return view('kegiatan.magang.index', compact('magangs'));
    }

    /**
     * Menampilkan form untuk membuat data magang baru.
     */
    public function create()
    {
        return view('kegiatan.magang.create');
    }

    /**
     * Menyimpan data magang yang baru dibuat ke database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'company_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        Magang::create($validatedData);
        return redirect()->route('magang')->with('success', 'Data magang berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit data magang yang ada.
     */
    public function edit(Magang $magang)
    {
        return view('kegiatan.magang.edit', compact('magang'));
    }

    /**
     * Memperbarui data magang yang ada di database.
     */
    public function update(Request $request, Magang $magang)
    {
        $validatedData = $request->validate([
            'company_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $magang->update($validatedData);
        return redirect()->route('magang')->with('success', 'Data magang berhasil diperbarui.');
    }

    /**
     * Menghapus data magang dari database.
     */
    public function destroy(Magang $magang)
    {
        $magang->delete();
        return redirect()->route('magang')->with('success', 'Data magang berhasil dihapus.');
    }
}