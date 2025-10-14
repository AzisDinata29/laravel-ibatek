<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\Controllers\HasMiddleware;

class AdminController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            'adminCheck',
        ];
    }

    public function index()
    {
        $users = User::where('role', 'admin')->get();
        return view('pengguna.admin.data', compact('users'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
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
            'nomor_telpon' => $request->nomor_telpon,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile_photo' => $profilePhotoPath,
            'role' => 'admin',
        ]);

        return response()->json(['success' => 'User created successfully.', 'user' => $user]);
    }

    public function show($id)
    {

        $user = User::findOrFail($id);
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
            'nomor_telpon' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'profile_photo' => 'nullable|image|max:2048',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $user->name = $request->name;
        $user->nomor_telpon = $request->nomor_telpon;
        $user->email = $request->email;

        if ($request->hasFile('profile_photo')) {
            $profilePhotoPath = $request->file('profile_photo')->store('profile_photos', 'public');
            $user->profile_photo = $profilePhotoPath;
        }
        if ($request->password) {
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
