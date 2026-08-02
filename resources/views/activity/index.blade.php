<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Kegiatan Posyandu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Alert Pesan Sukses (Opsional) -->
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <!-- Bagian Atas: Judul & Tombol Tambah -->
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold text-gray-700">Daftar Kegiatan</h3>
                        <a href="{{ route('kegiatan.create') }}" class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-md hover:bg-blue-700 transition">
                            + Tambah Kegiatan
                        </a>
                    </div>

                    <!-- Tabel Data -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-100 border-b">
                                    <th class="px-4 py-3 font-semibold text-gray-600">No</th>
                                    <th class="px-4 py-3 font-semibold text-gray-600">Bulan/Tahun</th>
                                    <th class="px-4 py-3 font-semibold text-gray-600">Tanggal Kegiatan</th>
                                    <th class="px-4 py-3 font-semibold text-gray-600">Lokasi</th>
                                    <th class="px-4 py-3 font-semibold text-gray-600">Keterangan</th>
                                    <th class="px-4 py-3 font-semibold text-gray-600 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Looping data dari Controller -->
                                @forelse ($activities as $index => $kegiatan)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="px-4 py-3">{{ $index + 1 }}</td>
                                        <td class="px-4 py-3">
                                            @php
                                                $namaBulan = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                            @endphp
                                            {{ $namaBulan[$kegiatan->month] }} {{ $kegiatan->year }}
                                        </td>
                                        
                                        <!-- Format tanggal jadi lebih enak dibaca -->
                                        <td class="px-4 py-3">{{ \Carbon\Carbon::parse($kegiatan->activity_date)->translatedFormat('d F Y') }}</td>
                                        
                                        <td class="px-4 py-3">{{ $kegiatan->location }}</td>
                                        <td class="px-4 py-3">{{ $kegiatan->description ?? '-' }}</td>
                                        <td class="px-4 py-3 text-center space-x-2">
                                            <!-- Tombol Edit -->
                                            <a href="{{ route('kegiatan.edit', $kegiatan->id) }}" class="text-yellow-600 hover:text-yellow-800 font-medium">Edit</a>
                                            
                                            <!-- Tombol Hapus -->
                                            <form action="{{ route('kegiatan.destroy', $kegiatan->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus data kegiatan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <!-- Jika database kosong (Empty State) -->
                                    <tr>
                                        <td colspan="6" class="px-4 py-8 text-center text-gray-500">
                                            Belum ada data kegiatan Posyandu.
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