<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProdiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->role == 'admin') {
                return $next($request);
            }
            return Redirect::route('login');
        });
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Prodi::with('fakultas');


        if ($request->filled('fakultas')) {
            $query->whereHas('fakultas', function ($q) use ($request) {
                $q->where('name', $request->fakultas);
            });
        }

        $prodis = $query->get();

        return view('master.prodi.index', compact('prodis'));
    }

    public function create()
    {
        $fakultas = Fakultas::all();
        return view('master.prodi.create', compact('fakultas'));
    }

    public function byFakultas($id)
    {
        return Prodi::where('fakultas_id', $id)
            ->orderBy('name')
            ->get(['id', 'name']);
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
        return view('master.prodi.edit', compact('prodi', 'fakultas'));
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
