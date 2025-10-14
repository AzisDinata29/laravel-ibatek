<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipeAktifitasMahasiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\Controllers\HasMiddleware;

class TipeAktifitasMahasiswaController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            'adminCheck',
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipe = TipeAktifitasMahasiswa::all();
        return view('master.tipe.index', compact('tipe'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('master.tipe.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        TipeAktifitasMahasiswa::create($validatedData);
        return redirect()->route('tipe.index')->with('success', 'tipe berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tipe = TipeAktifitasMahasiswa::findorfail($id);
        return view('master.tipe.edit', compact('tipe'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $tipe = TipeAktifitasMahasiswa::findorfail($id);
        $tipe->update($validatedData);
        return redirect()->route('tipe.index')->with('success', 'tipe berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tipe = TipeAktifitasMahasiswa::findorfail($id);
        $tipe->delete();
        return redirect()->route('tipe.index')->with('success', 'tipe berhasil dihapus.');
    }
}
