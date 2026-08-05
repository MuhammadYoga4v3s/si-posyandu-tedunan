<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-800 leading-tight">
            {{ __('Data Registrasi Balita') }}
        </h2>
    </x-slot>

    <!-- Flex container agar footer terdorong ke bawah -->
    <div class="pt-6 sm:pt-10 bg-gradient-to-b from-blue-50 to-white min-h-[calc(100vh-4rem)] flex flex-col">

        <!-- KONTEN UTAMA -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8 w-full flex-grow">

            <!-- 1. HERO BANNER -->
            <div class="bg-gradient-to-r from-blue-700 to-blue-500 rounded-3xl shadow-sm overflow-hidden">
                <div class="p-6 md:p-8 lg:p-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
                    <div class="w-full md:w-2/3">
                        <div class="flex items-center gap-3 mb-6 flex-wrap">
                            <div class="flex items-center gap-3 bg-white/10 py-2 px-4 rounded-xl border border-white/20">
                                <img src="{{ asset('images/logo.png') }}" alt="Posyandu" class="w-9 h-9 object-contain shrink-0">
                                <div class="leading-tight">
                                    <span class="block text-white font-bold text-sm tracking-wide">POSYANDU</span>
                                    <span class="block text-blue-100 text-xs font-semibold uppercase tracking-widest">Tedunan</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 bg-white/10 py-2 px-4 rounded-xl border border-white/20">
                                <div class="text-right leading-tight">
                                    <span class="block text-blue-100 font-semibold text-[10px] uppercase tracking-widest">Support by</span>
                                    <span class="block text-white font-bold text-sm tracking-wide">TIM KKN UNDIP</span>
                                </div>
                                <div class="w-px h-8 bg-white/20 hidden xs:block"></div>
                                <img src="{{ asset('images/logoKKN.png') }}" alt="KKN" class="h-9 w-auto object-contain shrink-0">
                            </div>
                        </div>

                        <span class="inline-flex items-center gap-2 py-1 px-3 rounded-full bg-white/15 border border-white/25 text-white text-xs font-semibold tracking-wide mb-3">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            Registrasi Balita
                        </span>
                        <h3 class="text-2xl sm:text-3xl font-bold text-white tracking-tight mb-2 leading-tight">
                            Data Balita Terdaftar
                        </h3>
                        <p class="text-blue-50 text-sm font-medium leading-relaxed">
                            Kelola informasi identitas, orang tua, dan domisili balita secara aman dan terintegrasi di sistem Posyandu Desa Tedunan.
                        </p>
                    </div>

                    <div class="w-full md:w-auto shrink-0">
                        <a href="{{ route('balita.create') }}" class="flex items-center justify-center gap-2 px-6 py-3 bg-white text-blue-700 font-semibold text-sm rounded-lg shadow-sm hover:bg-blue-50 transition duration-300 w-full">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Tambah Data Balita
                        </a>
                    </div>
                </div>
            </div>

            <!-- 2. TABEL DATA SECTION -->
            <div class="bg-white rounded-2xl border border-blue-100 shadow-sm overflow-hidden">
                <div class="px-6 py-5 md:px-8 border-b border-blue-100">
                    <h3 class="text-lg font-bold text-slate-800">Daftar Balita</h3>
                    <p class="text-sm font-medium text-slate-500 mt-1">Seluruh balita yang terdaftar di sistem posyandu</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse whitespace-nowrap">
                        <thead>
                            <tr class="bg-blue-50">
                                <th class="py-3 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wide border-b border-blue-100">No</th>
                                <th class="py-3 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wide border-b border-blue-100">Nama Balita</th>
                                <th class="py-3 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wide border-b border-blue-100">Jenis Kelamin</th>
                                <th class="py-3 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wide border-b border-blue-100">Tanggal Lahir</th>
                                <th class="py-3 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wide border-b border-blue-100">Nama Ibu</th>
                                <th class="py-3 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wide border-b border-blue-100 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-blue-50">
                            @forelse ($children as $index => $child)
                                <tr class="hover:bg-blue-50 transition-colors">
                                    <td class="py-4 px-6 text-sm font-medium text-slate-500">{{ $index + 1 }}</td>
                                    <td class="py-4 px-6">
                                        <span class="text-sm font-semibold text-slate-800">{{ $child->full_name }}</span>
                                    </td>
                                    <td class="py-4 px-6">
                                        @if(in_array(strtolower($child->gender), ['l', 'laki-laki', 'male']))
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-100">Laki-laki</span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-pink-50 text-pink-700 border border-pink-100">Perempuan</span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-6 text-sm font-medium text-slate-600">
                                        {{ \Carbon\Carbon::parse($child->birth_date)->translatedFormat('d F Y') }}
                                    </td>
                                    <td class="py-4 px-6 text-sm font-medium text-slate-600">
                                        {{ $child->mother_name }}
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('balita.edit', $child->id) }}" class="inline-flex items-center justify-center px-3 py-1.5 bg-amber-50 text-amber-700 border border-amber-100 font-semibold text-xs rounded-md hover:bg-amber-100 transition duration-300" title="Edit Data">
                                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                Edit
                                            </a>
                                            <form action="{{ route('balita.destroy', $child->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data balita ini secara permanen?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center justify-center px-3 py-1.5 bg-red-50 text-red-600 border border-red-100 font-semibold text-xs rounded-md hover:bg-red-100 transition duration-300" title="Hapus Data">
                                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-14 text-center text-slate-400">
                                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-50 mb-4 border border-blue-100 text-blue-300">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                        </div>
                                        <h3 class="text-base font-bold text-slate-700 mb-1">Belum Ada Data Balita</h3>
                                        <p class="text-sm font-medium text-slate-500">Silakan klik tombol "Tambah Data Balita" pada banner di atas.</p>
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