<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ExaminationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pemeriksaan = \App\Models\Examination::with(['child', 'staff', 'activity'])->latest()->get();
        return view('examination.index', compact('pemeriksaan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $balita = \App\Models\Child::all();
        $kader = \App\Models\Staff::all();
        $kegiatan = \App\Models\Activity::orderBy('activity_date', 'desc')->get();

        return view('examination.create', compact('balita', 'kader', 'kegiatan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'activity_id'             => 'required|exists:activities,id',
            'child_id'                => 'required|exists:children,id',
            'staff_id'                => 'required|exists:staff,id',
            'weight'                  => 'required|numeric|min:0|max:999',
            'height'                  => 'required|numeric|min:0|max:999',
            'head_circumference'      => 'nullable|numeric|min:0|max:999',
            'upper_arm_circumference' => 'nullable|numeric|min:0|max:999',
            'immunization'            => 'nullable|string|max:255',
            'pmt_portion'             => 'nullable|string|max:255', // <-- PERBAIKAN: Ditambahkan
            'illness_symptoms'        => 'nullable|string',
            'referral'                => 'nullable|string',         // <-- PERBAIKAN: Ditambahkan
            'notes'                   => 'nullable|string',
        ]);

        $data = $request->all();

        $checkboxes = [
            'development_check', 'cough_two_weeks', 'fever_two_weeks', 
            'weight_not_increasing', 'tb_contact', 'exclusive_breastfeeding', 
            'complementary_feeding', 'vitamin_a', 'deworming', 
            'local_food_program', 'health_education'
        ];

        foreach ($checkboxes as $field) {
            $data[$field] = $request->has($field) ? true : false;
        }

        // --- KALKULASI STATUS GIZI WHO OTOMATIS ---
        $child = \App\Models\Child::find($request->child_id);
        $activity = \App\Models\Activity::find($request->activity_id);
        
        $statusGizi = $this->calculateWHOStatus(
            $child, 
            $request->weight, 
            $request->height, 
            $request->head_circumference, 
            $request->upper_arm_circumference, 
            $activity->activity_date
        );

        // Memasukkan hasil hitungan ke dalam data yang akan di-save
        $data['weight_for_age']            = $statusGizi['weight_for_age'];
        $data['height_for_age']            = $statusGizi['height_for_age'];
        $data['weight_for_height']         = $statusGizi['weight_for_height'];
        $data['head_circumference_status'] = $statusGizi['head_circumference_status'];
        $data['upper_arm_status']          = $statusGizi['upper_arm_status'];
        // ------------------------------------------

        \App\Models\Examination::create($data);

        \App\Models\ActivityLog::create([
            'user_id'       => Auth::id(),
            'activity'      => 'Tambah Pemeriksaan',
            'activity_time' => now(),
            'description'   => 'Menambahkan data pemeriksaan baru untuk balita ID: ' . $request->child_id,
        ]);
        
        return redirect()->route('pemeriksaan.index')->with('success', 'Data pemeriksaan balita berhasil disimpan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pemeriksaan = \App\Models\Examination::findOrFail($id);
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
        $request->validate([
            'activity_id'             => 'required|exists:activities,id',
            'child_id'                => 'required|exists:children,id',
            'staff_id'                => 'required|exists:staff,id',
            'weight'                  => 'required|numeric|min:0|max:999',
            'height'                  => 'required|numeric|min:0|max:999',
            'head_circumference'      => 'nullable|numeric|min:0|max:999',
            'upper_arm_circumference' => 'nullable|numeric|min:0|max:999',
            'immunization'            => 'nullable|string|max:255',
            'pmt_portion'             => 'nullable|string|max:255', // <-- PERBAIKAN: Ditambahkan
            'illness_symptoms'        => 'nullable|string',
            'referral'                => 'nullable|string',         // <-- PERBAIKAN: Ditambahkan
            'notes'                   => 'nullable|string',
        ]);

        $data = $request->all();

        $checkboxes = [
            'development_check', 'cough_two_weeks', 'fever_two_weeks', 
            'weight_not_increasing', 'tb_contact', 'exclusive_breastfeeding', 
            'complementary_feeding', 'vitamin_a', 'deworming', 
            'local_food_program', 'health_education'
        ];

        foreach ($checkboxes as $field) {
            $data[$field] = $request->has($field) ? true : false;
        }

        // --- KALKULASI STATUS GIZI WHO OTOMATIS ---
        $child = \App\Models\Child::find($request->child_id);
        $activity = \App\Models\Activity::find($request->activity_id);
        
        $statusGizi = $this->calculateWHOStatus(
            $child, 
            $request->weight, 
            $request->height, 
            $request->head_circumference, 
            $request->upper_arm_circumference, 
            $activity->activity_date
        );

        $data['weight_for_age']            = $statusGizi['weight_for_age'];
        $data['height_for_age']            = $statusGizi['height_for_age'];
        $data['weight_for_height']         = $statusGizi['weight_for_height'];
        $data['head_circumference_status'] = $statusGizi['head_circumference_status'];
        $data['upper_arm_status']          = $statusGizi['upper_arm_status'];
        // ------------------------------------------

        $pemeriksaan = \App\Models\Examination::findOrFail($id);
        $pemeriksaan->update($data);

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
        $pemeriksaan = \App\Models\Examination::findOrFail($id);
        $pemeriksaan->delete();

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
        $pemeriksaan = \App\Models\Examination::with(['child', 'staff', 'activity'])->findOrFail($id);

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('examination.pdf', compact('pemeriksaan'))
                ->setPaper('a4', 'landscape');

        $namaFile = 'Hasil_Pemeriksaan_' . str_replace(' ', '_', $pemeriksaan->child->full_name) . '.pdf';
        return $pdf->download($namaFile);
    }

    /**
     * FUNGSI HELPER: Menghitung Klasifikasi Z-Score WHO AKURAT 100%
     */
    /**
     * FUNGSI HELPER: Menghitung Klasifikasi Z-Score WHO AKURAT 100%
     */
    private function calculateWHOStatus($child, $weight, $height, $headCircum, $armCircum, $date_of_visit)
    {
        $tglLahir = \Carbon\Carbon::parse($child->birth_date);
        $tglPeriksa = \Carbon\Carbon::parse($date_of_visit);
        $umurBulan = (int) floor($tglLahir->floatDiffInMonths($tglPeriksa));
        
        $gender = strtolower($child->gender);
        $isMale = in_array($gender, ['l', 'laki-laki', 'male', 'm', 'Male']);

        // Default Result jika data tidak diisi
        $result = [
            'weight_for_age'            => 'Data Kurang',
            'height_for_age'            => 'Data Kurang',
            'weight_for_height'         => 'Data Kurang',
            'head_circumference_status' => 'Data Kurang',
            'upper_arm_status'          => 'Data Kurang',
        ];

        // Membatasi umur maksimal 60 bulan (5 tahun) untuk standar balita
        if ($umurBulan < 0) $umurBulan = 0;
        if ($umurBulan > 60) $umurBulan = 60;

        // A. Klasifikasi BB/U
        if ($weight !== null) {
            // PERBAIKAN: Menggunakan \App\ (A besar)
            $dataBBU = $isMale ? \App\Helpers\WhoZScoreData::$bbu_lk : \App\Helpers\WhoZScoreData::$bbu_pr;
            if (isset($dataBBU[$umurBulan])) {
                $sd = $dataBBU[$umurBulan];
                // PERBAIKAN: Menggunakan index 0, 1, 2, dst.
                if ($weight < $sd[0]) $result['weight_for_age'] = 'Berat Badan Sangat Kurang';
                elseif ($weight >= $sd[0] && $weight < $sd[1]) $result['weight_for_age'] = 'Berat Badan Kurang';
                elseif ($weight >= $sd[1] && $weight <= $sd[2]) $result['weight_for_age'] = 'Berat Badan Normal';
                elseif ($weight > $sd[2]) $result['weight_for_age'] = 'Risiko Berat Badan Lebih';
            }
        }

        // B. Klasifikasi PB/U atau TB/U
        if ($height !== null) {
            $dataPBU = $isMale ? \App\Helpers\WhoZScoreData::$pbu_lk : \App\Helpers\WhoZScoreData::$pbu_pr;
            if (isset($dataPBU[$umurBulan])) {
                $sd = $dataPBU[$umurBulan];
                if ($height < $sd[0]) $result['height_for_age'] = 'Sangat Pendek';
                elseif ($height >= $sd[0] && $height < $sd[1]) $result['height_for_age'] = 'Pendek';
                elseif ($height >= $sd[1] && $height <= $sd[4]) $result['height_for_age'] = 'Normal';
                elseif ($height > $sd[4]) $result['height_for_age'] = 'Tinggi';
            }
        }

        // C. Klasifikasi LK/U
        if ($headCircum !== null) {
            $dataLKU = $isMale ? \App\Helpers\WhoZScoreData::$lku_lk : \App\Helpers\WhoZScoreData::$lku_pr;
            if (isset($dataLKU[$umurBulan])) {
                $sd = $dataLKU[$umurBulan];
                if ($headCircum < $sd[0]) $result['head_circumference_status'] = 'Sangat Kecil';
                elseif ($headCircum >= $sd[0] && $headCircum < $sd[1]) $result['head_circumference_status'] = 'Kecil';
                elseif ($headCircum >= $sd[1] && $headCircum <= $sd[3]) $result['head_circumference_status'] = 'Normal';
                elseif ($headCircum > $sd[3]) $result['head_circumference_status'] = 'Makrosefali';
            }
        }

        // D. Klasifikasi LLA/U
        if ($armCircum !== null) {
            $umurLLA = $umurBulan < 3 ? 3 : $umurBulan; 
            
            $dataLLAU = $isMale ? \App\Helpers\WhoZScoreData::$llau_lk : \App\Helpers\WhoZScoreData::$llau_pr;
            if (isset($dataLLAU[$umurLLA])) {
                $sd = $dataLLAU[$umurLLA];
                if ($armCircum < $sd[0]) $result['upper_arm_status'] = 'Sangat Kurus';
                elseif ($armCircum >= $sd[0] && $armCircum < $sd[1]) $result['upper_arm_status'] = 'Kurus';
                elseif ($armCircum >= $sd[1] && $armCircum <= $sd[3]) $result['upper_arm_status'] = 'Normal';
                elseif ($armCircum > $sd[3]) $result['upper_arm_status'] = 'Gizi Lebih';
            }
        }

        // E. Klasifikasi BB/PB atau BB/TB (Berat Badan menurut Panjang/Tinggi Badan)
        if ($weight !== null && $height !== null) {
            // Anak < 24 bulan pakai tabel Panjang Badan (PB), anak >= 24 bulan pakai Tinggi Badan (TB)
            $isPB = $umurBulan < 24; 
            
            // Standar WHO memakai interval 0.5 cm, jadi tinggi anak dibulatkan ke 0.5 terdekat
            $roundedHeight = round($height * 2) / 2;
            $heightKey = number_format($roundedHeight, 1, '.', ''); // format ke string, misal: '45.0'
            
            // Menentukan tabel mana yang dipakai berdasarkan umur dan jenis kelamin
            $dataBBTB = $isPB 
                ? ($isMale ? \App\Helpers\WhoZScoreData::$bbpb_lk : \App\Helpers\WhoZScoreData::$bbpb_pr) 
                : ($isMale ? \App\Helpers\WhoZScoreData::$bbtb_lk : \App\Helpers\WhoZScoreData::$bbtb_pr);

            if (isset($dataBBTB[$heightKey])) {
                $sd = $dataBBTB[$heightKey];
                
                if ($weight < $sd[0]) {
                    $result['weight_for_height'] = 'Gizi Buruk';
                } elseif ($weight >= $sd[0] && $weight < $sd[1]) {
                    $result['weight_for_height'] = 'Gizi Kurang';
                } elseif ($weight >= $sd[1] && $weight <= $sd[2]) {
                    $result['weight_for_height'] = 'Gizi Baik';
                } elseif ($weight > $sd[2] && $weight <= $sd[3]) {
                    $result['weight_for_height'] = 'Risiko Gizi Lebih';
                } elseif ($weight > $sd[3] && $weight <= $sd[4]) {
                    $result['weight_for_height'] = 'Gizi Lebih';
                } elseif ($weight > $sd[4]) {
                    $result['weight_for_height'] = 'Obesitas';
                }
            } else {
                // Jika ukuran anak di luar standar pengukuruan WHO
                if ($roundedHeight < 45.0) {
                    $result['weight_for_height'] = 'PB < 45cm (Di luar batas)';
                } else {
                    $result['weight_for_height'] = 'TB > 120cm (Di luar batas)';
                }
            }
        }

        return $result;
    }
}