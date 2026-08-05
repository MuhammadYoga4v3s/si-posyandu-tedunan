<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-800 leading-tight">
            {{ __('Dashboard Posyandu') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-10 bg-gradient-to-b from-blue-50 to-white min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8 w-full">

            <!-- 1. HERO SECTION -->
            <div class="bg-gradient-to-r from-blue-700 to-blue-500 rounded-3xl shadow-sm overflow-hidden">
                <div class="p-6 md:p-8 lg:p-10">
                    <!-- HEADER LOGO -->
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 w-full mb-8">
                        <!-- Badge Posyandu -->
                        <div class="flex items-center gap-3 bg-white/10 py-2 px-4 rounded-xl border border-white/20">
                            <img src="{{ asset('images/logo.png') }}" alt="Posyandu" class="w-9 h-9 object-contain shrink-0">
                            <div class="leading-tight">
                                <span class="block text-white font-bold text-sm tracking-wide">POSYANDU</span>
                                <span class="block text-blue-100 text-xs font-semibold uppercase tracking-widest">Tedunan</span>
                            </div>
                        </div>

                        <!-- Badge KKN -->
                        <div class="flex items-center gap-3 bg-white/10 py-2 px-4 rounded-xl border border-white/20">
                            <div class="text-right leading-tight">
                                <span class="block text-blue-100 font-semibold text-[10px] uppercase tracking-widest">Support by</span>
                                <span class="block text-white font-bold text-sm tracking-wide">TIM KKN UNDIP</span>
                            </div>
                            <div class="w-px h-8 bg-white/20 hidden xs:block"></div>
                            <img src="{{ asset('images/logoKKN.png') }}" alt="KKN" class="h-9 w-auto object-contain shrink-0">
                        </div>
                    </div>

                    <!-- TEKS SAMBUTAN -->
                    <div class="max-w-2xl">
                        <span class="inline-flex items-center gap-2 py-1 px-3 rounded-full bg-white/15 border border-white/25 text-white text-xs font-semibold tracking-wide mb-4">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Sistem Pendataan Terintegrasi
                        </span>
                        <h3 class="text-3xl md:text-4xl font-bold text-white tracking-tight mb-3 leading-tight">
                            Halo, {{ explode(' ', Auth::user()->name)[0] }}!
                        </h3>
                        <p class="text-blue-50 text-sm md:text-base font-medium leading-relaxed">
                            Anda masuk dengan hak akses <span class="font-bold underline decoration-white/40 underline-offset-4">{{ ucfirst(Auth::user()->role) }}</span>. Pantau dan kelola data kesehatan balita Desa Tedunan hari ini.
                        </p>
                    </div>
                </div>
            </div>

            <!-- 2. KARTU STATISTIK -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

                <!-- Card: Balita -->
                <div class="bg-white rounded-2xl p-6 border border-blue-100 shadow-sm hover:shadow-md hover:scale-[1.01] transition duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center border border-blue-100 text-blue-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                        <span class="text-[10px] font-bold px-3 py-1 bg-blue-50 text-blue-700 rounded-full border border-blue-100 uppercase tracking-wide">Aktif</span>
                    </div>
                    <div>
                        <h4 class="text-3xl md:text-4xl font-bold text-slate-800 tracking-tight">{{ $totalBalita }}</h4>
                        <p class="text-sm font-semibold text-slate-500 mt-1">Total Balita Terdaftar</p>
                    </div>
                </div>

                <!-- Card: Kader -->
                <div class="bg-white rounded-2xl p-6 border border-blue-100 shadow-sm hover:shadow-md hover:scale-[1.01] transition duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center border border-blue-100 text-blue-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"></path></svg>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-3xl md:text-4xl font-bold text-slate-800 tracking-tight">{{ $totalKader }}</h4>
                        <p class="text-sm font-semibold text-slate-500 mt-1">Kader Bertugas</p>
                    </div>
                </div>

                <!-- Card: Kegiatan -->
                <div class="bg-white rounded-2xl p-6 border border-blue-100 shadow-sm hover:shadow-md hover:scale-[1.01] transition duration-300 md:col-span-2 xl:col-span-1">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center border border-blue-100 text-blue-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-3xl md:text-4xl font-bold text-slate-800 tracking-tight">{{ $totalKegiatan }}</h4>
                        <p class="text-sm font-semibold text-slate-500 mt-1">Jadwal Posyandu</p>
                    </div>
                </div>

            </div>

            <!-- 3. TABEL PEMERIKSAAN -->
            <div class="bg-white rounded-2xl border border-blue-100 shadow-sm overflow-hidden">
                <div class="px-6 py-5 md:px-8 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 border-b border-blue-100">
                    <div>
                        <h3 class="text-lg font-bold text-slate-800">Riwayat Medis Terbaru</h3>
                        <p class="text-sm font-medium text-slate-500 mt-1">5 rekam pemeriksaan balita terakhir</p>
                    </div>
                    <a href="{{ route('pemeriksaan.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white font-semibold text-sm rounded-lg hover:bg-blue-700 transition duration-300">
                        Lihat Selengkapnya &rarr;
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse whitespace-nowrap">
                        <thead>
                            <tr class="bg-blue-50">
                                <th class="py-3 px-6 md:px-8 text-xs font-semibold text-slate-500 uppercase tracking-wide border-b border-blue-100">Tanggal</th>
                                <th class="py-3 px-6 md:px-8 text-xs font-semibold text-slate-500 uppercase tracking-wide border-b border-blue-100">Nama Balita</th>
                                <th class="py-3 px-6 md:px-8 text-xs font-semibold text-slate-500 uppercase tracking-wide border-b border-blue-100">Berat Badan</th>
                                <th class="py-3 px-6 md:px-8 text-xs font-semibold text-slate-500 uppercase tracking-wide border-b border-blue-100">Tinggi Badan</th>
                                <th class="py-3 px-6 md:px-8 text-xs font-semibold text-slate-500 uppercase tracking-wide border-b border-blue-100">Kader Pemeriksa</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-blue-50">
                            @forelse ($pemeriksaanTerbaru as $data)
                                <tr class="hover:bg-blue-50 transition-colors">
                                    <td class="py-4 px-6 md:px-8 text-sm font-medium text-slate-600">{{ \Carbon\Carbon::parse($data->activity->activity_date)->translatedFormat('d M Y') }}</td>
                                    <td class="py-4 px-6 md:px-8">
                                        <span class="text-sm font-semibold text-slate-800">{{ $data->child->full_name }}</span>
                                    </td>
                                    <td class="py-4 px-6 md:px-8">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100">
                                            {{ $data->weight }} kg
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 md:px-8">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-100">
                                            {{ $data->height }} cm
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 md:px-8 text-sm font-medium text-slate-600">
                                        <div class="flex items-center gap-3">
                                            <div class="w-7 h-7 rounded-full bg-blue-100 flex items-center justify-center text-[10px] font-bold text-blue-700 shrink-0">{{ substr($data->staff->full_name, 0, 1) }}</div>
                                            <span>{{ $data->staff->full_name }}</span>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-14 text-center text-slate-400">
                                        <div class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-blue-50 mb-3 text-blue-300">
                                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"></path></svg>
                                        </div>
                                        <span class="block text-sm font-semibold text-slate-500">Belum ada rekam medis terbaru.</span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- FOOTER -->
        <div class="w-full mt-10 pt-6 pb-6 border-t border-blue-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-2 text-xs font-medium text-slate-500">
                <p>&copy; 2026 Sistem Informasi Posyandu Desa Tedunan. All rights reserved.</p>
                <p class="flex items-center gap-1.5">
                    Developed by <span class="font-semibold text-blue-700">KKN-T UNDIP 88</span>
                </p>
            </div>
        </div>

    </div>
</x-app-layout>