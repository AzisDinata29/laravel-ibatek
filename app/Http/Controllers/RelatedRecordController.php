<?php

namespace App\Http\Controllers;

use App\Models\RelatedRecord;
use App\Models\User;
use App\Models\Organization;
use App\Models\Kepaniitiaan;
use App\Models\Magang;
use App\Models\Tridharma;
use App\Models\Lomba;
use App\Models\Fakultas;
use App\Models\Prodi;
use App\Models\Ukm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class RelatedRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $relatedRecords = RelatedRecord::where('user_id', auth()->id())->with([
            'user', 'organization', 'kepaniitiaan', 'magang', 'tridharma', 'lomba', 'fakultas', 'prodi', 'ukm', 'verifiedBy'
        ])->get();

        return view('cetak', compact('relatedRecords'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $organizations = Organization::all();
        $kepaniitiaans = Kepaniitiaan::all();
        $magangs = Magang::all();
        $tridharmas = Tridharma::all();
        $lombas = Lomba::all();
        $ukms = Ukm::all();

        $user = auth()->user();
        $relatedRecords = RelatedRecord::where('user_id', $user->id)->with(['organization', 'kepaniitiaan', 'magang', 'tridharma', 'lomba', 'ukm'])->get();

        return view('related-records.create', compact(
            'organizations', 'kepaniitiaans', 'magangs', 'tridharmas', 'lombas', 'ukms', 'relatedRecords'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'organization_id' => 'nullable|exists:organizations,id',
            'kepaniitiaan_id' => 'nullable|exists:kepaniitiaans,id',
            'magang_id' => 'nullable|exists:magangs,id',
            'tridharma_id' => 'nullable|exists:tridharmas,id',
            'lomba_id' => 'nullable|exists:lombas,id',
            'ukm_id' => 'nullable|exists:ukms,id',
            'bukti_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();
        $user = auth()->user();
        $data['user_id'] = $user->id;
        $data['fakultas_id'] = Fakultas::where('name', $user->fakultas)->first()->id ?? null;
        $data['prodi_id'] = Prodi::where('name', $user->prodi)->first()->id ?? null;

        if ($request->hasFile('bukti_file')) {
            $path = $request->file('bukti_file')->store('bukti_files', 'public');
            $data['bukti_file'] = $path;
        }

        RelatedRecord::create($data);

        return redirect()->route('related-records.index')->with('success', 'Related record created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $relatedRecord = RelatedRecord::with([
            'user', 'organization', 'kepaniitiaan', 'magang', 'tridharma', 'lomba', 'fakultas', 'prodi', 'ukm'
        ])->findOrFail($id);

        return view('related-records.show', compact('relatedRecord'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $relatedRecord = RelatedRecord::findOrFail($id);
        $organizations = Organization::all();
        $kepaniitiaans = Kepaniitiaan::all();
        $magangs = Magang::all();
        $tridharmas = Tridharma::all();
        $lombas = Lomba::all();
        $ukms = Ukm::all();

        $user = auth()->user();
        $relatedRecords = RelatedRecord::where('user_id', $user->id)->with(['organization', 'kepaniitiaan', 'magang', 'tridharma', 'lomba', 'ukm'])->get();

        return view('related-records.edit', compact(
            'relatedRecord', 'organizations', 'kepaniitiaans', 'magangs', 'tridharmas', 'lombas', 'ukms', 'relatedRecords'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'organization_id' => 'nullable|exists:organizations,id',
            'kepaniitiaan_id' => 'nullable|exists:kepaniitiaans,id',
            'magang_id' => 'nullable|exists:magangs,id',
            'tridharma_id' => 'nullable|exists:tridharmas,id',
            'lomba_id' => 'nullable|exists:lombas,id',
            'ukm_id' => 'nullable|exists:ukms,id',
            'bukti_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();
        $user = auth()->user();
        $data['user_id'] = $user->id;
        $data['fakultas_id'] = Fakultas::where('name', $user->fakultas)->first()->id ?? null;
        $data['prodi_id'] = Prodi::where('name', $user->prodi)->first()->id ?? null;

        if ($request->hasFile('bukti_file')) {
            $path = $request->file('bukti_file')->store('bukti_files', 'public');
            $data['bukti_file'] = $path;
        }

        $relatedRecord = RelatedRecord::findOrFail($id);
        $relatedRecord->update($data);

        return redirect()->route('related-records.index')->with('success', 'Related record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $relatedRecord = RelatedRecord::findOrFail($id);
        $relatedRecord->delete();

        return redirect()->route('related-records.index')->with('success', 'Related record deleted successfully.');
    }

    /**
     * Verify the specified resource.
     */
    public function verify(string $id)
    {
        $relatedRecord = RelatedRecord::findOrFail($id);
        $relatedRecord->update([
            'is_verified' => true,
            'verified_by' => auth()->id(),
            'verified_at' => now(),
        ]);

        return redirect()->route('related-records.index')->with('success', 'Related record verified successfully.');
    }
}
