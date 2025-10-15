<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Fakultas;
use App\Models\Prodi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\Controllers\HasMiddleware;

class UserController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            'adminCheck',
        ];
    }

    public function index(Request $request)
    {
        $query = User::with(['fakultas_detail', 'prodi_detail'])
            ->where('role', 'user');

        $hasFilter = false;

        if ($request->filled('fakultas_id')) {
            $query->where('fakultas', $request->fakultas_id);
            $hasFilter = true;
        }

        if ($request->filled('prodi_id')) {
            $query->where('prodi', $request->prodi_id);
            $hasFilter = true;
        }

        if ($request->filled('angkatan')) {
            $query->where('angkatan', $request->angkatan);
            $hasFilter = true;
        }

        $users = ($request->filled('fakultas_id') && $request->filled('prodi_id') && $request->filled('angkatan'))
            ? $query->get()
            :  $query->get();

        $fakultas = Fakultas::orderBy('name')->get(['id', 'name']);

        $angkatanList = User::where('role', 'user')
            ->select('angkatan')
            ->distinct()
            ->orderBy('angkatan', 'desc')
            ->pluck('angkatan');

        return view('pengguna.user.data', compact('users', 'fakultas', 'angkatanList'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'npm' => 'required|string|max:255|unique:users',
            'fakultas' => 'required|string|max:255',
            'prodi' => 'required|string|max:255',
            'angkatan' => 'required|integer|min:1900|max:' . (date('Y') + 10),
            'nomor_telpon' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'profile_photo' => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $profilePhotoPath = null;
        if ($request->hasFile('profile_photo')) {
            $profilePhotoPath = $request->file('profile_photo')->store('profile_photos', 'public');
        }

        $user = User::create([
            'name' => $request->name,
            'npm' => $request->npm,
            'fakultas' => $request->fakultas,
            'prodi' => $request->prodi,
            'angkatan' => $request->angkatan,
            'nomor_telpon' => $request->nomor_telpon,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile_photo' => $profilePhotoPath,
            'role' => 'user',
        ]);

        return response()->json(['success' => 'User created successfully.', 'user' => $user]);
    }

    public function show($id)
    {
        $user = User::with(['fakultas_detail', 'prodi_detail'])->findOrFail($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if ($request->has('password') && $request->password === '') {
            $request->merge(['password' => null]);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'npm' => 'required|string|max:255|unique:users,npm,' . $id,
            'fakultas' => 'required|string|max:255',
            'prodi' => 'required|string|max:255',
            'angkatan' => 'required|integer|min:1900|max:' . (date('Y') + 10),
            'nomor_telpon' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'profile_photo' => 'nullable|image|max:2048',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $user->name = $request->name;
        $user->npm = $request->npm;
        $user->fakultas = $request->fakultas;
        $user->prodi = $request->prodi;
        $user->angkatan = $request->angkatan;
        $user->nomor_telpon = $request->nomor_telpon;
        $user->email = $request->email;
        $user->role = 'user';

        if ($request->hasFile('profile_photo')) {
            $profilePhotoPath = $request->file('profile_photo')->store('profile_photos', 'public');
            $user->profile_photo = $profilePhotoPath;
        }
        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return response()->json(['success' => 'User updated successfully.', 'user' => $user]);
    }

    public function destroy($id)
    {

        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['success' => 'User deleted successfully.']);
    }
}
