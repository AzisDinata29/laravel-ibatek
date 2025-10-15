<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Fakultas;
use App\Models\Prodi;
use App\Models\Magang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\Controllers\HasMiddleware;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

class MagangController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            'adminCheck',
        ];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function index(Request $request)
    {
        $query = User::query()
            ->with(['fakultas_detail', 'prodi_detail', 'magang_detail'])
            ->where('role', 'user')
            ->whereHas('magang_detail');

        if ($request->filled('fakultas_id')) {
            $query->where('fakultas', $request->fakultas_id);
        }

        if ($request->filled('prodi_id')) {
            $query->where('prodi', $request->prodi_id);
        }

        if ($request->filled('angkatan')) {
            $query->where('angkatan', $request->angkatan);
        }


        $users = $query->get();

        $fakultas = Fakultas::orderBy('name')->get(['id', 'name']);
        $angkatanList = User::where('role', 'user')
            ->whereHas('magang_detail')
            ->whereNotNull('angkatan')
            ->select('angkatan')
            ->distinct()
            ->orderByDesc('angkatan')
            ->pluck('angkatan');

        $mahasiswa = User::where('role', 'user')->get();

        return view('master.magang.data', compact('users', 'fakultas', 'angkatanList', 'mahasiswa'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'no_magang' => 'required|string|max:255',
            'user_id' => 'required|string|max:255|unique:users',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = Magang::create([
            'user_id' => $request->user_id,
            // 'no_magang' => $request->no_magang,
        ]);

        return response()->json(['success' => 'Magang User created successfully.', 'user' => $user]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Magang::findOrFail($id);
        return response()->json($user);
    }

    public function edit(string $id)
    {
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
        $html = view('master.magang.cetak', compact('name', 'fontSize', 'bgBase64'))->render();
        Pdf::setOptions([
            'dpi' => 300,
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
        ]);
        $pdf = Pdf::loadHTML($html)->setPaper('a4', 'landscape');
        return $pdf->download('sertifikat-magang-' . Str::slug($name) . '.pdf');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $user = Magang::findOrFail($id);
        // $validator = Validator::make($request->all(), [
        //     'no_magang' => 'required|string|max:255',
        // ]);
        // if ($validator->fails()) {
        //     return response()->json(['errors' => $validator->errors()], 422);
        // }
        // $user->no_magang = $request->no_magang;
        // $user->save();

        // return response()->json(['success' => 'Magang updated successfully.', 'user' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Magang::findOrFail($id);
        $user->delete();

        return response()->json(['success' => 'User deleted successfully.']);
    }
}
