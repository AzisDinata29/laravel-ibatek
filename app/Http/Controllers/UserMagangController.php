<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use App\Models\Magang;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

class UserMagangController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            'userCheck',
        ];
    }

    public function index()
    {
        $magang = Magang::where("user_id", Auth::user()->id)->get();
        return view('user.magang.data', compact('magang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($encryptedId)
    {
        $id = decrypt($encryptedId);
        $user = Magang::findorfail($id);
        $name = mb_strtoupper(trim(preg_replace('/\s+/', ' ', $user->user->name)));
        $bgPath = public_path('magang.png');
        if (!file_exists($bgPath)) {
            abort(404, 'Background sertifikat tidak ditemukan.');
        }
        $bgBase64 = 'data:image/png;base64,' . base64_encode(file_get_contents($bgPath));
        $len = mb_strlen($name);
        $fontSize = 38;
        if ($len > 40) {
            $fontSize = 26;
        } elseif ($len > 32) {
            $fontSize = 30;
        } elseif ($len > 26) {
            $fontSize = 34;
        }
        $html = view('user.magang.cetak', compact('name', 'fontSize', 'bgBase64'))->render();
        Pdf::setOptions([
            'dpi' => 300,
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
        ]);
        $pdf = Pdf::loadHTML($html)->setPaper('a4', 'landscape');
        return $pdf->download('sertifikat-magang-' . Str::slug($name) . '.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
