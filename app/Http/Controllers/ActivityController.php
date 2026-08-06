<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data kegiatan dari database
        $activities = \App\Models\Activity::all();
        // Membuka file tampilan daftar kegiatan
        return view('activity.index', compact('activities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Kunci: Hanya Administrator
        if (Auth::user()->role !== 'administrator') {
            abort(403, 'Akses Ditolak: Hanya Administrator.');
        }

        // Membuka file tampilan form tambah kegiatan
        return view('activity.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Kunci: Hanya Administrator
        if (Auth::user()->role !== 'administrator') {
            abort(403, 'Akses Ditolak: Hanya Administrator.');
        }

        // 1. Mengecek dan memastikan data yang diisi sudah sesuai aturan (Validasi)
        $request->validate([
            'month'         => 'required|integer|between:1,12',
            'year'          => 'required|integer',
            'activity_date' => 'required|date',
            'location'      => 'required|string|max:255',
            'description'   => 'nullable|string',
        ]);

        // 2. Menyimpan data yang sudah valid ke dalam tabel 'activities' di database
        \App\Models\Activity::create($request->all());
        // Merekam aktivitas
        \App\Models\ActivityLog::create([
            'user_id'       => Auth::id(),
            'activity'      => 'Tambah Kegiatan',
            'activity_time' => now(),
            'description'   => 'Menambahkan data kegiatan Posyandu pada tanggal: ' . $request->activity_date,
        ]);

        // 3. Mengembalikan pengguna ke halaman daftar kegiatan sambil membawa pesan sukses
        return redirect()->route('kegiatan.index')->with('success', 'Data kegiatan Posyandu berhasil ditambahkan!');
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
        // Kunci: Hanya Administrator
        if (Auth::user()->role !== 'administrator') {
            abort(403, 'Akses Ditolak: Hanya Administrator.');
        }

        // Mencari data kegiatan berdasarkan ID
        $kegiatan = \App\Models\Activity::findOrFail($id);
        
        // Membuka form edit sambil membawa data lama
        return view('activity.edit', compact('kegiatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Kunci: Hanya Administrator
        if (Auth::user()->role !== 'administrator') {
            abort(403, 'Akses Ditolak: Hanya Administrator.');
        }

        // Validasi data baru (sama seperti saat menambah data)
        $request->validate([
            'month'         => 'required|integer|between:1,12',
            'year'          => 'required|integer',
            'activity_date' => 'required|date',
            'location'      => 'required|string|max:255',
            'description'   => 'nullable|string',
        ]);

        // Mencari data yang mau diedit, lalu menyimpannya dengan data baru
        $kegiatan = \App\Models\Activity::findOrFail($id);
        $kegiatan->update($request->all());
        // Merekam aktivitas
        \App\Models\ActivityLog::create([
            'user_id'       => Auth::id(),
            'activity'      => 'Ubah Kegiatan',
            'activity_time' => now(),
            'description'   => 'Mengubah data kegiatan dengan ID: ' . $id,
        ]);

        return redirect()->route('kegiatan.index')->with('success', 'Data kegiatan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Kunci: Hanya Administrator
        if (Auth::user()->role !== 'administrator') {
            abort(403, 'Akses Ditolak: Hanya Administrator.');
        }

        // Mencari data lalu menghapusnya
        $kegiatan = \App\Models\Activity::findOrFail($id);
        $kegiatan->delete();
        // Merekam aktivitas
        \App\Models\ActivityLog::create([
            'user_id'       => Auth::id(),
            'activity'      => 'Hapus Kegiatan',
            'activity_time' => now(),
            'description'   => 'Menghapus data kegiatan dengan ID: ' . $id,
        ]);

        return redirect()->route('kegiatan.index')->with('success', 'Data kegiatan berhasil dihapus!');
    }

    public function cetak($id)
    {
        // Ambil data kegiatan beserta hasil pemeriksaan balita dan data balitanya
        $kegiatan = \App\Models\Activity::with(['examinations.child', 'examinations.staff'])->findOrFail($id);

        // Render file view menjadi PDF
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('activity.cetak', compact('kegiatan'))
              ->setPaper('A4', 'landscape'); // Menggunakan kertas A4 format memanjang (Landscape) agar tabel muat

        // Langsung paksa browser untuk mendownload filenya
        $namaFile = 'Laporan-Posyandu-' . \Carbon\Carbon::parse($kegiatan->activity_date)->format('Y-m-d') . '.pdf';
        
        return $pdf->download($namaFile);
    }
}