<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Kegiatan Posyandu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <h3 class="text-lg font-bold text-gray-700 mb-6">Formulir Data Kegiatan Baru</h3>

                    <!-- Arahkan form ke method store di Controller -->
                    <form action="{{ route('kegiatan.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            
                            <!-- Input Bulan -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Bulan Kegiatan</label>
                                <select name="month" required class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                                    <option value="">-- Pilih Bulan --</option>
                                    <option value="1">Januari</option>
                                    <option value="2">Februari</option>
                                    <option value="3">Maret</option>
                                    <option value="4">April</option>
                                    <option value="5">Mei</option>
                                    <option value="6">Juni</option>
                                    <option value="7">Juli</option>
                                    <option value="8">Agustus</option>
                                    <option value="9">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                            </div>

                            <!-- Input Tahun -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tahun</label>
                                <input type="number" name="year" required value="{{ date('Y') }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                            </div>

                            <!-- Input Tanggal Kegiatan -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Pelaksanaan</label>
                                <input type="date" name="activity_date" required class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                            </div>

                            <!-- Input Lokasi -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Lokasi Posyandu</label>
                                <input type="text" name="location" required placeholder="Contoh: Balai Desa Tedunan" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                            </div>
                        </div>

                        <!-- Input Keterangan -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan Tambahan (Opsional)</label>
                            <textarea name="description" rows="3" placeholder="Contoh: Pemberian Vitamin A dan Obat Cacing" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"></textarea>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="flex justify-end space-x-3 mt-6 border-t pt-4">
                            <a href="{{ route('kegiatan.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 font-semibold rounded-md hover:bg-gray-300 transition">
                                Batal
                            </a>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition">
                                Simpan Data
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>