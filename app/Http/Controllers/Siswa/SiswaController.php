<?php

namespace App\Http\Controllers\Siswa;

use App\Models\Role;
use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiswaController extends Controller
{
    // Tampilkan halaman index siswa
    public function index()
    {
        $siswa = Siswa::with('role')->get();
        return view('siswa.index', compact('siswa'));
    }

    // Tampilkan halaman create siswa
    public function create()
    {
        $roles = Role::where('id', 3)->get();
        return view('siswa.create', compact('roles'));
    }

    // Simpan data siswa baru
    public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'nis' => 'required|unique:siswa,nis|max:255',
        'name' => 'required',
        'kelas' => 'required',
        'alamat' => 'required',
        'password' => 'required|min:8',
        'role_id' => 'required|exists:roles,id',
    ]);

    // Buat siswa baru
    Siswa::create([
        'nis' => $request->nis,
        'name' => $request->name,
        'kelas' => $request->kelas,
        'alamat' => $request->alamat,
        'password' => bcrypt($request->password), // Hash password
        'role_id' => $request->role_id,
    ]);

    return redirect()->route('siswa.index')->with('success', 'Siswa berhasil ditambahkan.');
}


    // Tampilkan halaman edit siswa
    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        $roles = Role::where('id', 3)->get();
        return view('siswa.edit', compact('siswa', 'roles'));
    }

    // Update data siswa
    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);

        $validated = $request->validate([
            'nis' => 'required|unique:siswa,nis,' . $id,
            'name' => 'required',
            'kelas' => 'required',
            'alamat' => 'required',
            'password' => 'nullable|min:8|confirmed',
            'role_id' => 'required|exists:roles,id',
        ]);

        if ($request->filled('password')) {
            $siswa->update($validated);
        } else {
            $siswa->update($request->except('password'));
        }

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil diperbarui.');
    }

    // Hapus data siswa
    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil dihapus.');
    }
}
