<?php

namespace App\Http\Controllers\Users;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
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
    $roles = Role::all();
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

    return response()->json($user, 201);
}

    // Display the specified user
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    // Show the form for editing the specified user
    public function edit($id)
    {
        //
    }

    // Update the specified user in storage
    public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'name' => 'sometimes|required|string|max:255',
        'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $id,
        'role_id' => 'sometimes|required|exists:roles,id',
        'password' => 'sometimes|required|string|min:8',
    ]);

    $user->update([
        'name' => $request->name ?? $user->name,
        'email' => $request->email ?? $user->email,
        'role_id' => $request->role_id ?? $user->role_id,
        'password' => $request->password ? Hash::make($request->password) : $user->password,
    ]);

    return response()->json($user);
}

    // Remove the specified user from storage
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(null, 204);
    }
}

