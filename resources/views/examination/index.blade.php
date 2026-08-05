<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-800 leading-tight">
            {{ __('Data Pemeriksaan Posyandu') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-10 bg-gradient-to-b from-blue-50 to-white min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6 w-full">

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
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"></path></svg>
                            Rekam Medis
                        </span>
                        <h3 class="text-2xl md:text-3xl font-bold text-white tracking-tight">Daftar Hasil Pemeriksaan</h3>
                        <p class="text-blue-50 text-sm font-medium mt-1">Riwayat pemeriksaan tumbuh kembang balita Desa Tedunan.</p>
                    </div>
                    <a href="{{ route('pemeriksaan.create') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-white text-blue-700 text-sm font-semibold rounded-lg hover:bg-blue-50 transition duration-300 shadow-sm shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Tambah Pemeriksaan
                    </a>
                </div>
            </div>

            <!-- Tabel Data -->
            <div class="bg-white rounded-2xl border border-blue-100 shadow-sm overflow-hidden">
                <div class="px-6 py-5 md:px-8 border-b border-blue-100">
                    <h3 class="text-lg font-bold text-slate-800">Daftar Hasil Pemeriksaan</h3>
                    <p class="text-sm font-medium text-slate-500 mt-1">Seluruh rekam pemeriksaan balita yang tercatat</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse whitespace-nowrap">
                        <thead>
                            <tr class="bg-blue-50">
                                <th class="px-6 md:px-8 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide border-b border-blue-100">No</th>
                                <th class="px-6 md:px-8 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide border-b border-blue-100">Tanggal Kegiatan</th>
                                <th class="px-6 md:px-8 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide border-b border-blue-100">Nama Balita</th>
                                <th class="px-6 md:px-8 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide border-b border-blue-100">BB (kg)</th>
                                <th class="px-6 md:px-8 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide border-b border-blue-100">TB (cm)</th>
                                <th class="px-6 md:px-8 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide border-b border-blue-100">Petugas</th>
                                <th class="px-6 md:px-8 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide border-b border-blue-100 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-blue-50">
                            @forelse ($pemeriksaan as $index => $data)
                                <tr class="hover:bg-blue-50 transition-colors">
                                    <td class="px-6 md:px-8 py-4 text-sm font-medium text-slate-500">{{ $index + 1 }}</td>

                                    <!-- Mengambil tanggal dari relasi tabel activity -->
                                    <td class="px-6 md:px-8 py-4 text-sm font-medium text-slate-600">
                                        {{ \Carbon\Carbon::parse($data->activity->activity_date)->translatedFormat('d F Y') }}
                                    </td>

                                    <!-- Mengambil nama dari relasi tabel child -->
                                    <td class="px-6 md:px-8 py-4">
                                        <span class="text-sm font-semibold text-blue-700">{{ $data->child->full_name }}</span>
                                    </td>

                                    <td class="px-6 md:px-8 py-4">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100">
                                            {{ $data->weight }} kg
                                        </span>
                                    </td>
                                    <td class="px-6 md:px-8 py-4">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-100">
                                            {{ $data->height }} cm
                                        </span>
                                    </td>

                                    <!-- Mengambil nama dari relasi tabel staff -->
                                    <td class="px-6 md:px-8 py-4 text-sm font-medium text-slate-600">
                                        <div class="flex items-center gap-3">
                                            <div class="w-7 h-7 rounded-full bg-blue-100 flex items-center justify-center text-[10px] font-bold text-blue-700 shrink-0">{{ substr($data->staff->full_name, 0, 1) }}</div>
                                            <span>{{ $data->staff->full_name }}</span>
                                        </div>
                                    </td>

                                    <td class="px-6 md:px-8 py-4">
                                        <div class="flex items-center justify-center gap-2">
                                            <!-- Tombol Cetak PDF -->
                                            <a href="{{ route('pemeriksaan.cetak', $data->id) }}" class="inline-flex items-center px-3 py-1.5 text-xs font-semibold text-emerald-700 bg-emerald-50 border border-emerald-100 rounded-md hover:bg-emerald-100 transition" title="Cetak PDF">
                                                Cetak PDF
                                            </a>

                                            <!-- Tombol Edit -->
                                            <a href="{{ route('pemeriksaan.edit', $data->id) }}" class="inline-flex items-center px-3 py-1.5 text-xs font-semibold text-amber-700 bg-amber-50 border border-amber-100 rounded-md hover:bg-amber-100 transition" title="Edit Data">
                                                Edit
                                            </a>

                                            <!-- Tombol Hapus -->
                                            <form action="{{ route('pemeriksaan.destroy', $data->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus data pemeriksaan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center px-3 py-1.5 text-xs font-semibold text-red-700 bg-red-50 border border-red-100 rounded-md hover:bg-red-100 transition" title="Hapus Data">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-14 text-center text-slate-400">
                                        <div class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-blue-50 mb-3 text-blue-300">
                                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"></path></svg>
                                        </div>
                                        <span class="block text-sm font-semibold text-slate-500">Belum ada data pemeriksaan Posyandu.</span>
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