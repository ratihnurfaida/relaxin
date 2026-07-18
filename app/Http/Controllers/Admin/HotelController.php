<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Area;

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
        $areas = Area::all(); 
        return view('admin.hotel.create', compact('areas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255|unique:hotel,nama',
        'id_area' => 'required|exists:area,id_area',
        'kota' => 'required|string|max:255',
        'alamat' => 'required|string',
        'deskripsi' => 'required|string',
        'star_rating' => 'required|integer|min:1|max:5',
        'harga' => 'required|integer',
        'fasilitas' => 'nullable|array', 
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $data = $request->all();

    if($request->has('facilities')) {
        $data['fasilitas'] = implode(',', $request->input('facilities'));
    } else {
        $data['fasilitas'] = '';
    }

    // Logika upload gambar 
    if ($request->hasFile('gambar')) {
        $file = $request->file('gambar');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('fotohotel'), $filename);
        $data['gambar'] = $filename;
    }

    // SIMPAN DATA HOTEL 
    Hotel::create($data);

    return redirect()->route('admin.hotel.index')->with('success', 'Hotel berhasil ditambahkan!');
}
    /**
     * Display the specified resource.
     */
    public function show(string $id) {
    
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $hotel = Hotel::findOrFail($id);
        $areas = Area::all();
        
        return view('admin.hotel.edit', compact('hotel', 'areas'));
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
            'id_area' => 'required|exists:area,id_area',
        ]);

        $data = $request->all();

        if ($request->has('facilities')) {
            $data['fasilitas'] = implode(',', $request->input('facilities'));
        } else {
            $data['fasilitas'] = '';
        }

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('hotel'), $filename);
            $data['gambar'] = $filename;
        }

        $hotel->update($data);

        return redirect()->route('admin.hotel.index')->with('success', 'Data hotel berhasil diupdate!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // cari hotel
        $hotel = Hotel::findOrFail($id);

        if ($hotel->gambar && file_exists(public_path('hotel/' . $hotel->gambar))) {
            unlink(public_path('hotel/' . $hotel->gambar));
        }
        
        // hapus datanya
        $hotel->delete();

        return redirect()->route('admin.hotel.index')->with('success', 'Hotel berhasil dihapus!');
    }

    public function selectHotel()
    {
        $hotels = Hotel::all(); // Mengambil semua data hotel
        return view('admin.kamar.pilih-hotel', compact('hotels'));
    }
}
