<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Child;
use App\Models\Staff;
use App\Models\Activity;
use App\Models\Examination;

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung total data
        $totalBalita = Child::count();
        $totalKader = Staff::count();
        $totalKegiatan = Activity::count();

        // Mengambil 5 data pemeriksaan paling baru beserta relasinya
        $pemeriksaanTerbaru = Examination::with(['child', 'staff', 'activity'])
                                ->latest()
                                ->take(5)
                                ->get();

        // Mengirim data ke halaman view dashboard
        return view('dashboard', compact('totalBalita', 'totalKader', 'totalKegiatan', 'pemeriksaanTerbaru'));
    }
}