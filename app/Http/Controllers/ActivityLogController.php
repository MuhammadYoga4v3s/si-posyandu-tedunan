<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityLog;

class ActivityLogController extends Controller
{
    public function index()
    {
        // Mengambil data riwayat aktivitas beserta nama pelakunya (user)
        // latest() digunakan agar aktivitas terbaru muncul di paling atas
        $logs = ActivityLog::with('user')->latest()->get();
        
        return view('activity_log.index', compact('logs'));
    }
}