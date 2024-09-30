<?php

namespace App\Http\Controllers;

use App\Models\Ekskul;
use App\Models\Divisi;
use App\Models\User;
use Illuminate\Http\Request;

class EkskulController extends Controller
{
    public function index()
    {
        // Ambil user yang sedang login
        $user = auth()->user();
    
        if ($user->role_id === 1) {
            // Jika pengguna adalah admin, ambil semua ekskul
            $ekskuls = Ekskul::with('divisi')->get();
        } else {
            // Jika pengguna adalah pembimbing, ambil ekskul yang terkait dengan pembimbing tersebut
            $ekskuls = Ekskul::where('pembimbing_id', $user->id)->with('divisi')->get();
        }
    
        return view('ekskul.index', compact('ekskuls'));
    }
    

    

    public function create()
    {
        $divisis = Divisi::all();
        $pembimbings = User::where('role_id', 2)->get();
        return view('ekskul.create', compact('divisis', 'pembimbings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'divisi_id' => 'required|exists:divisi,id',
            'pembimbing_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'hari' => 'required|string|max:255',
            'jam' => 'required',
            'lokasi' => 'required|string|max:255',
        ]);

        Ekskul::create($validated);
        return redirect()->route('ekskul.index')->with('success', 'Ekskul created successfully.');
    }

    public function edit($id)
    {
        $ekskul = Ekskul::findOrFail($id);
        $divisis = Divisi::all();
        $pembimbings = User::where('role_id', 2)->get();
        return view('ekskul.edit', compact('ekskul', 'divisis', 'pembimbings'));
    }

    // Memperbarui ekskul di database
    public function update(Request $request, $id)
    {
        $request->validate([
            'divisi_id' => 'required|exists:divisi,id',
            'pembimbing_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'hari' => 'required|string|max:10',
            'jam' => 'required|string|max:10',
            'lokasi' => 'required|string|max:255',
        ]);

        $ekskul = Ekskul::findOrFail($id);
        $ekskul->update($request->all());
        return redirect()->route('ekskul.index')->with('success', 'Ekskul updated successfully');
    }

    // Menghapus ekskul dari database
    public function destroy($id)
    {
        $ekskul = Ekskul::findOrFail($id);
        $ekskul->delete();
        return redirect()->route('ekskul.index')->with('success', 'Ekskul deleted successfully');
    }
}
