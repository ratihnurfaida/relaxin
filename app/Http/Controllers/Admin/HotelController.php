<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotel;
use Illuminate\Support\Facades\Storage;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hotels = Hotel::all();
        return view('admin.hotel.index', compact('hotels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.hotel.create');
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
            'harga' => 'required|integer',
            'fasilitas' => 'nullable|array', 
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();

        //trik untuk fasilitas yang berupa array, kita ubah dulu menjadi string dengan implode
        if($request->has('facilities')) {
            $data['fasilitas'] = implode(',', $request->input('facilities'));
        } else {
            $data['fasilitas'] = '';
        }

        //logika upload gambar
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('assets/hotel', 'public');
        }

        //simpan data hotel ke database
        Hotel::create($data);

       $gambarPath = $request->file('gambar')->store('assets/hotel', 'public');
    
        Hotel::create([
            'nama' => $request->nama,
            'kota' => $request->kota,
            'alamat' => $request->alamat,
            'deskripsi' => $request->deskripsi,
            'star_rating' => $request->star_rating,
            'harga' => $request->harga,
            'fasilitas' => isset($data['fasilitas']) ? $data['fasilitas'] : '',
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('admin.hotel.index')->with('success', 'Hotel berhasil ditambahkan!');
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
        $hotel = Hotel::findOrFail($id);
        return view('admin.hotel.edit', compact('hotel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $hotel = Hotel::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'alamat' => 'required|string',
            'deskripsi' => 'required|string',
            'star_rating' => 'required|integer|min:1|max:5',
            'harga' => 'required|integer',
            'fasilitas' => 'nullable|array', 
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $hotel = Hotel::findOrFail($id);
        $data = $request->all();

        $gambarPath = $hotel->gambar;

         if($request->has('facilities')) {
            $data['fasilitas'] = implode(',', $request->input('facilities'));
        } else {
            $data['fasilitas'] = '';
        }

        //logika upload gambar
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('assets/hotel', 'public');
        }

        $hotel->update($data);

        return redirect()->route('admin.hotel.index')->with('success', 'Data hotel berhasil diupdatee!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // cari hotel
        $hotel = Hotel::findOrFail($id);

        Storage::disk('public')->delete($hotel->gambar);
        
        // hapus datanya
        $hotel->delete();

        return redirect()->route('admin.hotel.index')->with('success', 'Hotel berhasil dihapus!');
    }
}
