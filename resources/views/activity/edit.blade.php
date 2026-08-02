<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Kegiatan Posyandu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <h3 class="text-lg font-bold text-gray-700 mb-6">Ubah Data Kegiatan</h3>

                    <!-- Arahkan form ke method update, bawa ID kegiatan -->
                    <form action="{{ route('kegiatan.update', $kegiatan->id) }}" method="POST">
                        @csrf
                        @method('PUT') <!-- Wajib ada untuk proses Edit di Laravel -->

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            
                            <!-- Input Bulan (dengan memilih data yang tersimpan sebelumnya) -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Bulan Kegiatan</label>
                                <select name="month" required class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                                    <option value="1" {{ $kegiatan->month == 1 ? 'selected' : '' }}>Januari</option>
                                    <option value="2" {{ $kegiatan->month == 2 ? 'selected' : '' }}>Februari</option>
                                    <option value="3" {{ $kegiatan->month == 3 ? 'selected' : '' }}>Maret</option>
                                    <option value="4" {{ $kegiatan->month == 4 ? 'selected' : '' }}>April</option>
                                    <option value="5" {{ $kegiatan->month == 5 ? 'selected' : '' }}>Mei</option>
                                    <option value="6" {{ $kegiatan->month == 6 ? 'selected' : '' }}>Juni</option>
                                    <option value="7" {{ $kegiatan->month == 7 ? 'selected' : '' }}>Juli</option>
                                    <option value="8" {{ $kegiatan->month == 8 ? 'selected' : '' }}>Agustus</option>
                                    <option value="9" {{ $kegiatan->month == 9 ? 'selected' : '' }}>September</option>
                                    <option value="10" {{ $kegiatan->month == 10 ? 'selected' : '' }}>Oktober</option>
                                    <option value="11" {{ $kegiatan->month == 11 ? 'selected' : '' }}>November</option>
                                    <option value="12" {{ $kegiatan->month == 12 ? 'selected' : '' }}>Desember</option>
                                </select>
                            </div>

                            <!-- Input Tahun -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tahun</label>
                                <input type="number" name="year" required value="{{ $kegiatan->year }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                            </div>

                            <!-- Input Tanggal Kegiatan -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Pelaksanaan</label>
                                <input type="date" name="activity_date" required value="{{ $kegiatan->activity_date }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                            </div>

                            <!-- Input Lokasi -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Lokasi Posyandu</label>
                                <input type="text" name="location" required value="{{ $kegiatan->location }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                            </div>
                        </div>

                        <!-- Input Keterangan -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan Tambahan (Opsional)</label>
                            <textarea name="description" rows="3" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">{{ $kegiatan->description }}</textarea>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="flex justify-end space-x-3 mt-6 border-t pt-4">
                            <a href="{{ route('kegiatan.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 font-semibold rounded-md hover:bg-gray-300 transition">
                                Batal
                            </a>
                            <button type="submit" class="px-4 py-2 bg-yellow-500 text-white font-semibold rounded-md hover:bg-yellow-600 transition">
                                Update Data
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>