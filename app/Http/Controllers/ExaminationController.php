<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExaminationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil data pemeriksaan beserta data balita, petugas, dan kegiatan yang berelasi
        // latest() digunakan agar data terbaru muncul paling atas
        $pemeriksaan = \App\Models\Examination::with(['child', 'staff', 'activity'])->latest()->get();
        return view('examination.index', compact('pemeriksaan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mengambil data untuk ditampilkan di dropdown form
        $balita = \App\Models\Child::all();
        $kader = \App\Models\Staff::all();
        // Mengurutkan kegiatan dari yang paling baru
        $kegiatan = \App\Models\Activity::orderBy('activity_date', 'desc')->get();

        return view('examination.create', compact('balita', 'kader', 'kegiatan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi inputan (Maksimal angka dibatasi 999 agar tidak error Out of Range)
        $request->validate([
            'activity_id'             => 'required|exists:activities,id',
            'child_id'                => 'required|exists:children,id',
            'staff_id'                => 'required|exists:staff,id',
            'weight'                  => 'required|numeric|min:0|max:999',
            'height'                  => 'required|numeric|min:0|max:999',
            'head_circumference'      => 'nullable|numeric|min:0|max:999',
            'upper_arm_circumference' => 'nullable|numeric|min:0|max:999',
            'immunization'            => 'nullable|string|max:255',
            'illness_symptoms'        => 'nullable|string',
            'referral'                => 'nullable|string',
            'notes'                   => 'nullable|string',
        ]);

        $data = $request->all();

        // 2. Mengubah nilai checkbox HTML menjadi Boolean (True/False) untuk Database
        $checkboxes = [
            'development_check', 'cough_two_weeks', 'fever_two_weeks', 
            'weight_not_increasing', 'tb_contact', 'exclusive_breastfeeding', 
            'complementary_feeding', 'vitamin_a', 'deworming', 
            'local_food_program', 'health_education'
        ];

        foreach ($checkboxes as $field) {
            $data[$field] = $request->has($field) ? true : false;
        }

        // 3. Simpan ke database
        \App\Models\Examination::create($data);

        // Merekam aktivitas ke Activity Log
        \App\Models\ActivityLog::create([
            'user_id'       => Auth::id(),
            'activity'      => 'Tambah Pemeriksaan',
            'activity_time' => now(),
            'description'   => 'Menambahkan data pemeriksaan baru untuk balita ID: ' . $request->child_id,
        ]);
        return redirect()->route('pemeriksaan.index')->with('success', 'Data pemeriksaan balita berhasil disimpan!');
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
        // Mencari data pemeriksaan yang mau diedit
        $pemeriksaan = \App\Models\Examination::findOrFail($id);
        
        // Memanggil kembali data balita, kader, dan kegiatan untuk dropdown
        $balita = \App\Models\Child::all();
        $kader = \App\Models\Staff::all();
        $kegiatan = \App\Models\Activity::orderBy('activity_date', 'desc')->get();

        return view('examination.edit', compact('pemeriksaan', 'balita', 'kader', 'kegiatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // 1. Validasi inputan (sama persis dengan saat tambah data)
        $request->validate([
            'activity_id'             => 'required|exists:activities,id',
            'child_id'                => 'required|exists:children,id',
            'staff_id'                => 'required|exists:staff,id',
            'weight'                  => 'required|numeric|min:0|max:999',
            'height'                  => 'required|numeric|min:0|max:999',
            'head_circumference'      => 'nullable|numeric|min:0|max:999',
            'upper_arm_circumference' => 'nullable|numeric|min:0|max:999',
            'immunization'            => 'nullable|string|max:255',
            'illness_symptoms'        => 'nullable|string',
            'referral'                => 'nullable|string',
            'notes'                   => 'nullable|string',
        ]);

        $data = $request->all();

        // 2. Mengubah nilai checkbox HTML menjadi Boolean lagi
        $checkboxes = [
            'development_check', 'cough_two_weeks', 'fever_two_weeks', 
            'weight_not_increasing', 'tb_contact', 'exclusive_breastfeeding', 
            'complementary_feeding', 'vitamin_a', 'deworming', 
            'local_food_program', 'health_education'
        ];

        foreach ($checkboxes as $field) {
            $data[$field] = $request->has($field) ? true : false;
        }

        // 3. Update data ke database
        $pemeriksaan = \App\Models\Examination::findOrFail($id);
        $pemeriksaan->update($data);

        // Merekam aktivitas ke Activity Log
        \App\Models\ActivityLog::create([
            'user_id'       => Auth::id(),
            'activity'      => 'Ubah Pemeriksaan',
            'activity_time' => now(),
            'description'   => 'Mengubah data pemeriksaan dengan ID: ' . $id,
        ]);

        return redirect()->route('pemeriksaan.index')->with('success', 'Data pemeriksaan balita berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Menghapus data pemeriksaan
        $pemeriksaan = \App\Models\Examination::findOrFail($id);
        $pemeriksaan->delete();

        // Merekam aktivitas ke Activity Log
        \App\Models\ActivityLog::create([
            'user_id'       => Auth::id(),
            'activity'      => 'Hapus Pemeriksaan',
            'activity_time' => now(),
            'description'   => 'Menghapus data pemeriksaan dengan ID: ' . $id,
        ]);

        return redirect()->route('pemeriksaan.index')->with('success', 'Data pemeriksaan balita berhasil dihapus!');
    }

    public function cetakPdf($id)
    {
        // 1. Ambil data pemeriksaan beserta relasinya
        $pemeriksaan = \App\Models\Examination::with(['child', 'staff', 'activity'])->findOrFail($id);

        // 2. Siapkan file PDF menggunakan tampilan dari 'examination.pdf'
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('examination.pdf', compact('pemeriksaan'));

        // 3. Download file-nya dengan nama yang otomatis menyesuaikan nama balita
        $namaFile = 'Hasil_Pemeriksaan_' . str_replace(' ', '_', $pemeriksaan->child->full_name) . '.pdf';
        return $pdf->download($namaFile);
    }
}
