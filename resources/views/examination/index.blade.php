<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Pemeriksaan Posyandu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold text-gray-700">Daftar Hasil Pemeriksaan</h3>
                        <a href="{{ route('pemeriksaan.create') }}" class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-md hover:bg-blue-700 transition">
                            + Tambah Pemeriksaan
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-100 border-b">
                                    <th class="px-4 py-3 font-semibold text-gray-600">No</th>
                                    <th class="px-4 py-3 font-semibold text-gray-600">Tanggal Kegiatan</th>
                                    <th class="px-4 py-3 font-semibold text-gray-600">Nama Balita</th>
                                    <th class="px-4 py-3 font-semibold text-gray-600">BB (kg)</th>
                                    <th class="px-4 py-3 font-semibold text-gray-600">TB (cm)</th>
                                    <th class="px-4 py-3 font-semibold text-gray-600">Petugas</th>
                                    <th class="px-4 py-3 font-semibold text-gray-600 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pemeriksaan as $index => $data)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="px-4 py-3">{{ $index + 1 }}</td>
                                        
                                        <!-- Mengambil tanggal dari relasi tabel activity -->
                                        <td class="px-4 py-3">
                                            {{ \Carbon\Carbon::parse($data->activity->activity_date)->translatedFormat('d F Y') }}
                                        </td>
                                        
                                        <!-- Mengambil nama dari relasi tabel child -->
                                        <td class="px-4 py-3 font-medium text-blue-600">{{ $data->child->full_name }}</td>
                                        
                                        <td class="px-4 py-3">{{ $data->weight }}</td>
                                        <td class="px-4 py-3">{{ $data->height }}</td>
                                        
                                        <!-- Mengambil nama dari relasi tabel staff -->
                                        <td class="px-4 py-3">{{ $data->staff->full_name }}</td>
                                        
                                        <td class="px-4 py-3 text-center space-x-2">
                                            <a href="{{ route('pemeriksaan.edit', $data->id) }}" class="text-yellow-600 hover:text-yellow-800 font-medium">Edit</a>
                                            
                                            <form action="{{ route('pemeriksaan.destroy', $data->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus data pemeriksaan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                                            Belum ada data pemeriksaan Posyandu.
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