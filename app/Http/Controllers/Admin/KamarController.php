<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kamar;
use App\Models\Hotel;
use Illuminate\Support\Facades\Storage;

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $id_hotel = $request->query('id_hotel');

        $hotel = Hotel::find($id_hotel);

        $daftar_kamar = Kamar::when($id_hotel, function ($query, $id_hotel) {
            return $query->where('id_hotel', $id_hotel);
        })->get();
        
        return view('admin.kamar.index', compact('daftar_kamar', 'hotel'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Hotel $hotel) {
        return view('admin.kamar.create', compact('hotel'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
     
        $request->validate([
            'id_hotel'        => 'required|exists:hotel,id_hotel',
            'tipe_kamar'      => 'required|string|max:255',
            'tipe_bed'        => 'required|string|max:255',
            'kode_kamar'      => 'required|string|max:50',
            'harga_per_kamar' => 'required|integer|min:0',
            'kapasitas'       => 'required|integer|min:1',
            'total_kamar'     => 'required|integer|min:1',
            'gambar'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('gambar');

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('hotel', 'public');
            $data['gambar'] = basename($path);
        }

        Kamar::create($data);

        return redirect()->route('admin.kamar.index', ['id_hotel' => $request->id_hotel])
                        ->with('success', 'Kamar berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        
        $kamar = Kamar::findOrFail($id);
        $hotel = Hotel::findOrFail($kamar->id_hotel); 

        return view('admin.kamar.edit', compact('kamar', 'hotel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $kamar)
    {
        $kamar = Kamar::findOrFail($kamar);
        
        // Ambil semua input termasuk stok
        $data = $request->except(['gambar']); 

        // Handle foto jika ada
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('hotel', 'public');
            $data['gambar'] = basename($path);
        }

        // Update semua data termasuk stok
        $kamar->update($data);

        return redirect()->route('admin.kamar.index', ['id_hotel' => $kamar->id_hotel])
                        ->with('success', 'Data kamar dan stok berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kamar = Kamar::findOrFail($id);

        Storage::disk('public')->delete($kamar->gambar);
        
        // hapus datanya
        $kamar->delete();

        return redirect()->route('admin.kamar.index', ['id_hotel' => $kamar->id_hotel])->with('success', 'Kamar berhasil dihapus!');
    }
}
