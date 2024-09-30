<?php

namespace App\Http\Controllers\Users;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function dashboard() {
        return view('users.dashboard');
    }

    // Display a listing of the users
    public function index()
{
    // Mengambil semua users beserta relasi dengan tabel roles
    $users = User::with('role')->get();
    
    // Mengirim data users ke view
    return view('users.index', compact('users'));
}

    // Show the form for creating a new user
    public function create()
{
    $roles = Role::whereIn('id', [1,2])->get();
    return view('users.create', compact('roles'));
}


    // Store a newly created user in storage
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'role_id' => 'required|exists:roles,id', // validasi untuk role
        'password' => 'required|string|min:8',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'role_id' => $request->role_id,  // menyimpan role berdasarkan id
        'password' => Hash::make($request->password),
    ]);

    return redirect()->route('users.index')->with('success', 'User created successfully.');
}

    // Display the specified user
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    // Show the form for editing the specified user
    public function edit($id)
    {
        $user = User::findOrFail($id); // Cari user berdasarkan ID
        $roles = Role::whereIn('id', [1,2])->get(); // Ambil semua role dari tabel roles
        return view('users.edit', compact('user', 'roles'));
    }

    // Method untuk menangani update data user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id', // Pastikan role_id ada di tabel roles
        ]);

        // Update data user
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if ($request->filled('password')) {
            $user->password = bcrypt($validated['password']);
        }

        $user->role_id = $validated['role_id'];
        $user->save();

        // Redirect ke halaman index atau menampilkan pesan sukses
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    // Remove the specified user from storage
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}

