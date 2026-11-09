<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Tampilkan semua data user
    public function index()
    {
        $users = User::all(); //[cite: 1]
        return view('admin.user.index', compact('users')); //[cite: 1]
    }

    // Tampilkan form tambah user
    public function create()
    {
        return view('admin.user.create'); //[cite: 1]
    }

    // Simpan data user baru dengan validasi dan hashing password
    public function store(Request $request)
    {
        // Validasi Form[cite: 3]
        $request->validate([
            'name'     => 'required|string|max:100', //[cite: 3]
            'email'    => 'required|email|unique:users,email', //[cite: 3]
            'password' => 'required|min:8|confirmed', //[cite: 3]
        ]);

        $data = $request->only(['name', 'email']);
        // Enkripsi password menggunakan Hash::make()[cite: 1]
        $data['password'] = Hash::make($request->password);

        User::create($data); //[cite: 1]

        return redirect()->route('user.index')->with('success', 'Data user berhasil ditambahkan!'); //[cite: 3]
    }

    // Tampilkan form edit user
    public function edit($id)
    {
        $user = User::findOrFail($id); //[cite: 1]
        return view('admin.user.edit', compact('user')); //[cite: 1]
    }

    // Update data user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi Form[cite: 3]
        $request->validate([
            'name'     => 'required|string|max:100', //[cite: 3]
            'email'    => 'required|email|unique:users,email,' . $id, //[cite: 3]
            'password' => 'nullable|min:8|confirmed', //[cite: 3]
        ]);

        $data = $request->only(['name', 'email']);

        // Update password jika diisi
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('user.index')->with('success', 'Data user berhasil diperbarui!'); //[cite: 3]
    }

    // Hapus data user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete(); //

        return redirect()->route('user.index')->with('success', 'Data user berhasil dihapus!'); //[cite: 3]
    }
}