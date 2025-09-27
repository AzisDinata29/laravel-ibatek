<?php

namespace App\Http\Controllers;

use App\Models\RelatedRecord;
use Illuminate\Http\Request;

class VerifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $relatedRecords = RelatedRecord::with([
            'user', 'organization', 'kepaniitiaan', 'magang', 'tridharma', 'lomba', 'fakultas', 'prodi', 'ukm', 'verifiedBy'
        ])->get();

        return view('verifikasi', compact('relatedRecords'));
    }
}
