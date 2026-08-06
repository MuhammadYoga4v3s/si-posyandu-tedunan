<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data staff beserta data user (akun) yang berelasi
        $staffs = Staff::with('user')->get();
        
        // Mengirimkan data tersebut ke halaman UI
        return view('staff.index', compact('staffs'));
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

        return view('staff.create');
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

        // 1. Validasi Data (Mengecek apakah form sudah diisi dengan benar)
        $request->validate([
            'username'     => 'required|string|max:255|unique:users,username',
            'password'     => 'required|string|min:8',
            'full_name'    => 'required|string|max:255',
            'position'     => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'address'      => 'required|string',
        ], [
            // Kita kustomisasi pesan error-nya pakai bahasa Indonesia
            'username.unique' => 'Username ini sudah digunakan, silakan pilih yang lain.',
            'password.min'    => 'Password minimal harus 8 karakter.',
        ]);

        // 2. Simpan Data ke 2 Tabel (Menggunakan DB Transaction)
        DB::transaction(function () use ($request) {
            
            // A. Bikin akun login-nya dulu di tabel users
            $user = User::create([
                'name'     => $request->full_name,
                'username' => $request->username,
                'password' => Hash::make($request->password), // Password wajib di-hash (disandikan) biar aman
                'role'     => 'staff', // Hak aksesnya diset sebagai Petugas
                'status'   => true,      // Akun langsung aktif
            ]);

            // B. Simpan biodata kader di tabel staff, lalu hubungkan dengan akun di atas
            Staff::create([
                'user_id'      => $user->id, // Ini kunci penghubungnya
                'full_name'    => $request->full_name,
                'position'     => $request->position,
                'phone_number' => $request->phone_number,
                'address'      => $request->address,
            ]);
            
        });
        // Merekam aktivitas
        \App\Models\ActivityLog::create([
            'user_id'       => Auth::id(),
            'activity'      => 'Tambah Kader',
            'activity_time' => now(),
            'description'   => 'Menambahkan data kader baru: ' . $request->full_name,
        ]);

        // 3. Balikkan ke halaman Daftar Kader kalau sudah sukses
        return redirect()->route('kader.index');
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

        // Cari data kader beserta akunnya berdasarkan ID
        $staff = Staff::with('user')->findOrFail($id);
        
        // Tampilkan halaman edit dan kirimkan datanya
        return view('staff.edit', compact('staff'));
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

        // 1. Cari data kader yang mau diedit
        $staff = Staff::findOrFail($id);
        $userId = $staff->user_id;

        // 2. Validasi Input
        $request->validate([
            'username'     => 'required|string|max:255|unique:users,username,' . $userId,
            'password'     => 'nullable|string|min:8', // nullable = boleh kosong jika password tidak ingin diubah
            'full_name'    => 'required|string|max:255',
            'position'     => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'address'      => 'required|string',
        ], [
            'username.unique' => 'Username ini sudah digunakan, silakan pilih yang lain.',
            'password.min'    => 'Password minimal harus 8 karakter.',
        ]);

        // 3. Simpan perubahan ke database (DB Transaction)
        DB::transaction(function () use ($request, $staff, $userId) {
            
            // A. Update tabel users
            $user = User::findOrFail($userId);
            $user->name = $request->full_name;
            $user->username = $request->username;
            
            // Jika kolom password diisi, maka hash dan update passwordnya
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            // B. Update tabel staff
            $staff->update([
                'full_name'    => $request->full_name,
                'position'     => $request->position,
                'phone_number' => $request->phone_number,
                'address'      => $request->address,
            ]);
            
        });
        // Merekam aktivitas
        \App\Models\ActivityLog::create([
            'user_id'       => Auth::id(),
            'activity'      => 'Ubah Kader',
            'activity_time' => now(),
            'description'   => 'Mengubah data kader dengan ID: ' . $id,
        ]);

        // 4. Balikkan ke halaman Daftar Kader
        return redirect()->route('kader.index');
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

        // 1. Cari data kader berdasarkan ID yang diklik
        $staff = Staff::findOrFail($id);

        // 2. Ambil ID user (akun) yang terkait dengan kader ini
        $userId = $staff->user_id;

        // 3. Hapus data kader terlebih dahulu
        $staff->delete();

        // 4. Hapus juga akun login-nya di tabel users
        User::destroy($userId);
        // Merekam aktivitas
        \App\Models\ActivityLog::create([
            'user_id'       => Auth::id(),
            'activity'      => 'Hapus Kader',
            'activity_time' => now(),
            'description'   => 'Menghapus data kader dengan ID: ' . $id,
        ]);

        // 5. Kembali ke halaman daftar kader
        return redirect()->route('kader.index');
    }
}