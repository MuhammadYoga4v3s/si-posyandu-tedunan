<?php

namespace App\Http\Controllers;

use App\Models\Child; 
use Illuminate\Http\Request;

class ChildController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data balita, diurutkan dari yang terbaru
        $children = Child::latest()->get();
        
        // Mengirim data ke halaman daftar balita
        return view('child.index', compact('children'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Menampilkan form tambah balita
        return view('child.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi Data (Memastikan form diisi dengan benar)
        $request->validate([
            'full_name'           => 'required|string|max:255',
            'national_id'         => 'nullable|string|max:20',
            'birth_place'         => 'required|string|max:255',
            'birth_date'          => 'required|date',
            'gender'              => 'required|in:Male,Female',
            'card_tag'            => 'nullable|string|max:255',
            'family_card_number'  => 'required|string|max:20',
            'father_name'         => 'required|string|max:255',
            'mother_name'         => 'required|string|max:255',
            'religion'            => 'required|string|max:50',
            'marital_status'      => 'nullable|string|max:50',
            'education'           => 'nullable|string|max:100',
            'occupation'          => 'nullable|string|max:100',
            'family_relationship' => 'nullable|string|max:50',
            'address'             => 'required|string',
            'rt'                  => 'required|string|max:10',
            'rw'                  => 'required|string|max:10',
            'is_resident'         => 'required|boolean',
        ]);

        // 2. Simpan Data ke Tabel Balita
        Child::create([
            'full_name'           => $request->full_name,
            'national_id'         => $request->national_id,
            'birth_place'         => $request->birth_place,
            'birth_date'          => $request->birth_date,
            'gender'              => $request->gender,
            'card_tag'            => $request->card_tag,
            'family_card_number'  => $request->family_card_number,
            'father_name'         => $request->father_name,
            'mother_name'         => $request->mother_name,
            'religion'            => $request->religion,
            'marital_status'      => $request->marital_status,
            'education'           => $request->education,
            'occupation'          => $request->occupation,
            'family_relationship' => $request->family_relationship,
            'address'             => $request->address,
            'rt'                  => $request->rt,
            'rw'                  => $request->rw,
            'is_resident'         => $request->is_resident,
        ]);

        // 3. Kembali ke Halaman Daftar Balita
        return redirect()->route('balita.index');
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
    public function edit(string $id)
    {
        // 1. Cari data balita yang mau diedit
        $child = Child::findOrFail($id);
        
        // 2. Tampilkan halaman edit dan kirimkan datanya
        return view('child.edit', compact('child'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // 1. Cari data balita yang mau diupdate
        $child = Child::findOrFail($id);

        // 2. Validasi Input (Sama persis dengan saat fungsi Tambah)
        $request->validate([
            'full_name'           => 'required|string|max:255',
            'national_id'         => 'nullable|string|max:20',
            'birth_place'         => 'required|string|max:255',
            'birth_date'          => 'required|date',
            'gender'              => 'required|in:Male,Female',
            'card_tag'            => 'nullable|string|max:255',
            'family_card_number'  => 'required|string|max:20',
            'father_name'         => 'required|string|max:255',
            'mother_name'         => 'required|string|max:255',
            'religion'            => 'required|string|max:50',
            'marital_status'      => 'nullable|string|max:50',
            'education'           => 'nullable|string|max:100',
            'occupation'          => 'nullable|string|max:100',
            'family_relationship' => 'nullable|string|max:50',
            'address'             => 'required|string',
            'rt'                  => 'required|string|max:10',
            'rw'                  => 'required|string|max:10',
            'is_resident'         => 'required|boolean',
        ]);

        // 3. Simpan perubahan ke database
        // Karena kita sudah pakai protected $guarded = [] di Model, kodenya bisa dipersingkat:
        $child->update($request->all());

        // 4. Balikkan ke halaman Daftar Balita
        return redirect()->route('balita.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // 1. Cari data balita berdasarkan ID
        $child = Child::findOrFail($id);
        // 2. Hapus data balita dari database
        $child->delete();
        // 3. Kembali ke halaman daftar balita dengan pesan (opsional)
        return redirect()->route('balita.index');
    }
}