<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penginapan;
use illuminate\Support\Facades\Storage;

class PenginapanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penginapans = Penginapan::all();
        return view('admin.penginapan.index', compact('penginapans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.penginapan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'alamat' => 'required|string',
            'deskripsi' => 'required|string',
            'star_rating' => 'required|integer|min:1|max:5',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

       $gambarPath = $request->file('gambar')->store('penginapan', 'public');
    
        Penginapan::create([
            'nama' => $request->nama,
            'kota' => $request->kota,
            'alamat' => $request->alamat,
            'deskripsi' => $request->deskripsi,
            'star_rating' => $request->star_rating,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('admin.penginapan.index')->with('success', 'Penginapan berhasil ditambahkan!');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id) {
    
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $penginapan = Penginapan::findOrFail($id);
        return view('admin.penginapan.edit', compact('penginapan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $penginapan = Penginapan::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'alamat' => 'required|string',
            'deskripsi' => 'required|string',
            'star_rating' => 'required|integer|min:1|max:5',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $gambarPath = $penginapan->gambar;
        if ($request->hasFile('gambar')) {
            Storage::disk('public')->delete($penginapan->gambar);
            $gambarPath = $request->file('gambar')->store('penginapan', 'public');
        }

        $penginapan->update([
            'nama' => $request->nama,
            'kota' => $request->kota,
            'alamat' => $request->alamat,
            'deskripsi' => $request->deskripsi,
            'star_rating' => $request->star_rating,
            'gambar' => $gambarPath,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $penginapan = Penginapan::findOrFail($id);
        Storage::disk('public')->delete($penginapan->gambar);
        $penginapan->delete();

        return redirect()->route('admin.penginapan.index')->with('success', 'Penginapan berhasil dihapus!');
    }
}
