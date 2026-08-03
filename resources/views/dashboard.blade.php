<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Posyandu Tedunan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Welcome Message -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 border-l-4 border-blue-500">
                <div class="p-6 text-gray-900 font-semibold">
                    Selamat datang kembali, {{ Auth::user()->name }}! Anda login sebagai {{ ucfirst(Auth::user()->role) }}.
                </div>
            </div>

            <!-- Kartu Statistik (Cards) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                
                <!-- Kartu Total Balita -->
                <div class="bg-white rounded-lg shadow-sm p-6 border-t-4 border-pink-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Balita</p>
                            <p class="text-3xl font-bold text-gray-800">{{ $totalBalita }}</p>
                        </div>
                        <div class="p-3 bg-pink-100 text-pink-600 rounded-full">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Kartu Total Kader -->
                <div class="bg-white rounded-lg shadow-sm p-6 border-t-4 border-teal-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Kader</p>
                            <p class="text-3xl font-bold text-gray-800">{{ $totalKader }}</p>
                        </div>
                        <div class="p-3 bg-teal-100 text-teal-600 rounded-full">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Kartu Total Kegiatan -->
                <div class="bg-white rounded-lg shadow-sm p-6 border-t-4 border-yellow-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Kegiatan</p>
                            <p class="text-3xl font-bold text-gray-800">{{ $totalKegiatan }}</p>
                        </div>
                        <div class="p-3 bg-yellow-100 text-yellow-600 rounded-full">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Pemeriksaan Terbaru -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-gray-700">5 Pemeriksaan Terbaru</h3>
                        <a href="{{ route('pemeriksaan.index') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">Lihat Semua &rarr;</a>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-100 border-b">
                                    <th class="px-4 py-3 font-semibold text-gray-600">Tanggal</th>
                                    <th class="px-4 py-3 font-semibold text-gray-600">Nama Balita</th>
                                    <th class="px-4 py-3 font-semibold text-gray-600">BB (kg)</th>
                                    <th class="px-4 py-3 font-semibold text-gray-600">TB (cm)</th>
                                    <th class="px-4 py-3 font-semibold text-gray-600">Kader Pemeriksa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pemeriksaanTerbaru as $data)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="px-4 py-3">{{ \Carbon\Carbon::parse($data->activity->activity_date)->translatedFormat('d F Y') }}</td>
                                        <td class="px-4 py-3 font-medium text-blue-600">{{ $data->child->full_name }}</td>
                                        <td class="px-4 py-3">{{ $data->weight }}</td>
                                        <td class="px-4 py-3">{{ $data->height }}</td>
                                        <td class="px-4 py-3">{{ $data->staff->full_name }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                                            Belum ada data pemeriksaan terbaru.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>