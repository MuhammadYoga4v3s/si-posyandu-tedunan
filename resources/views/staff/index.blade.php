<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-800 leading-tight">
            {{ __('Data Kader Posyandu') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-10 bg-gradient-to-b from-blue-50 to-white min-h-screen flex flex-col">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6 w-full flex-grow">

            @if(session('success'))
                <div class="flex items-center gap-3 p-4 bg-emerald-50 text-emerald-700 border border-emerald-100 rounded-xl text-sm font-semibold">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            <!-- Header Halaman -->
            <div class="bg-gradient-to-r from-blue-700 to-blue-500 rounded-3xl shadow-sm overflow-hidden">
                <div class="p-6 md:p-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <span class="inline-flex items-center gap-2 py-1 px-3 rounded-full bg-white/15 border border-white/25 text-white text-xs font-semibold tracking-wide mb-3">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            Petugas Posyandu
                        </span>
                        <h3 class="text-2xl md:text-3xl font-bold text-white tracking-tight">Daftar Kader</h3>
                        <p class="text-blue-50 text-sm font-medium mt-1">Kelola data petugas dan hak akses login sistem.</p>
                    </div>

                    <!-- Tombol Tambah (Aktif untuk Admin, Mati untuk Kader) -->
                    <div>
                        @if(auth()->check() && auth()->user()->role === 'administrator')
                            <a href="{{ route('kader.create') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-white text-blue-700 text-sm font-semibold rounded-lg hover:bg-blue-50 transition duration-300 shadow-sm shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                Tambah Kader
                            </a>
                        @else
                            <div class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-white/40 text-white/70 text-sm font-semibold rounded-lg cursor-not-allowed select-none shrink-0" title="Akses khusus Administrator">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                Tambah Kader (Khusus Admin)
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Tabel Data -->
            <div class="bg-white rounded-2xl border border-blue-100 shadow-sm overflow-hidden">
                <div class="px-6 py-5 md:px-8 border-b border-blue-100">
                    <h3 class="text-lg font-bold text-slate-800">Data Kader</h3>
                    <p class="text-sm font-medium text-slate-500 mt-1">Seluruh kader yang terdaftar dan bertugas</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse whitespace-nowrap">
                        <thead>
                            <tr class="bg-blue-50">
                                <th class="px-6 md:px-8 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide border-b border-blue-100">No</th>
                                <th class="px-6 md:px-8 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide border-b border-blue-100">Nama Kader</th>
                                <th class="px-6 md:px-8 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide border-b border-blue-100">Username</th>
                                <th class="px-6 md:px-8 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide border-b border-blue-100">Jabatan</th>
                                <th class="px-6 md:px-8 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide border-b border-blue-100">Nomor HP</th>
                                <th class="px-6 md:px-8 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide border-b border-blue-100 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-blue-50">
                            @forelse ($staffs as $index => $staff)
                                <tr class="hover:bg-blue-50 transition-colors">
                                    <td class="px-6 md:px-8 py-4 text-sm font-medium text-slate-500">{{ $index + 1 }}</td>
                                    <td class="px-6 md:px-8 py-4">
                                        <span class="text-sm font-semibold text-blue-700">{{ $staff->full_name }}</span>
                                    </td>
                                    <td class="px-6 md:px-8 py-4 text-sm font-medium text-slate-600">
                                        {{ $staff->user->username ?? '-' }}
                                    </td>
                                    <td class="px-6 md:px-8 py-4 text-sm font-medium text-slate-600">
                                        {{ $staff->position }}
                                    </td>
                                    <td class="px-6 md:px-8 py-4 text-sm font-medium text-slate-600">
                                        {{ $staff->phone_number }}
                                    </td>
                                    <td class="px-6 md:px-8 py-4">
                                        <div class="flex items-center justify-center gap-2">
                                            @if(auth()->check() && auth()->user()->role === 'administrator')
                                                <!-- Tombol Edit Aktif untuk Admin -->
                                                <a href="{{ route('kader.edit', $staff->id) }}" class="inline-flex items-center px-3 py-1.5 text-xs font-semibold text-amber-700 bg-amber-50 border border-amber-100 rounded-md hover:bg-amber-100 transition" title="Edit Data">
                                                    Edit
                                                </a>
                                                <!-- Tombol Hapus Aktif untuk Admin -->
                                                <form action="{{ route('kader.destroy', $staff->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus kader ini? Semua data terkait akan ikut terhapus!')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 text-xs font-semibold text-red-700 bg-red-50 border border-red-100 rounded-md hover:bg-red-100 transition" title="Hapus Data">
                                                        Hapus
                                                    </button>
                                                </form>
                                            @else
                                                <!-- Tombol Mati / Disable untuk Kader -->
                                                <span class="px-3 py-1.5 bg-slate-100 text-slate-400 border border-slate-200 font-semibold text-xs rounded-md cursor-not-allowed select-none">
                                                    Edit (Admin)
                                                </span>
                                                <span class="px-3 py-1.5 bg-slate-100 text-slate-400 border border-slate-200 font-semibold text-xs rounded-md cursor-not-allowed select-none">
                                                    Hapus (Admin)
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-14 text-center text-slate-400">
                                        <div class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-blue-50 mb-3 text-blue-300">
                                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                        </div>
                                        <span class="block text-sm font-semibold text-slate-500">Belum ada data kader.</span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- FOOTER -->
        <div class="w-full mt-auto pt-10 pb-6 px-4 border-t border-blue-100 text-center">
            <p class="text-xs font-medium text-slate-500">© 2026 Sistem Informasi Posyandu Desa Tedunan. All rights reserved.</p>
            <p class="text-xs font-medium text-slate-500 mt-1">Developed by <span class="font-semibold text-blue-700">KKN-T UNDIP 88</span></p>
        </div>
    </div>
</x-app-layout>