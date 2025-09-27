<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function index()
    {
        $organizations = Organization::all();
        return view('kegiatan.organisasi.index', compact('organizations'));
    }

    public function create()
    {
        return view('kegiatan.organisasi.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Organization::create($validatedData);
        return redirect()->route('organisasi')->with('success', 'Organisasi berhasil ditambahkan.');
    }

    public function edit(Organization $organisasi)
    {
        return view('kegiatan.organisasi.edit', compact('organisasi'));
    }

    public function update(Request $request, Organization $organisasi)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $organisasi->update($validatedData);
        return redirect()->route('organisasi')->with('success', 'Organisasi berhasil diperbarui.');
    }

    public function destroy(Organization $organisasi)
    {
        $organisasi->delete();
        return redirect()->route('organisasi')->with('success', 'Organisasi berhasil dihapus.');
    }
}