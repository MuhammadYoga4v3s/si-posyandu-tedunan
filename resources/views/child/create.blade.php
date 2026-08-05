<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Data Balita') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form action="{{ route('balita.store') }}" method="POST">
                        @csrf
                        
                        <!-- BAGIAN 1: IDENTITAS BALITA -->
                        <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Identitas Balita</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nama Lengkap Balita</label>
                                <input type="text" name="full_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">NIK Balita (Jika ada)</label>
                                <input type="text" name="national_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                                <input type="text" name="birth_place" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                                <input type="date" name="birth_date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                                <select name="gender" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="Male">Laki-laki</option>
                                    <option value="Female">Perempuan</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tag ID Card (Kartu Posyandu)</label>
                                <input type="text" name="card_tag" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                            <!-- TAMBAHAN BARU: BERAT & PANJANG LAHIR -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Berat Badan Lahir (kg)</label>
                                <input type="number" step="0.01" name="birth_weight" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Contoh: 3.2">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Panjang Badan Lahir (cm)</label>
                                <input type="number" step="0.01" name="birth_length" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Contoh: 49.5">
                            </div>
                        </div>

                        <!-- BAGIAN 2: DATA KELUARGA -->
                        <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Data Keluarga</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nomor Kartu Keluarga (KK)</label>
                                <input type="text" name="family_card_number" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nama Ayah</label>
                                <input type="text" name="father_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nama Ibu</label>
                                <input type="text" name="mother_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Agama</label>
                                <input type="text" name="religion" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Status Perkawinan Orang Tua</label>
                                <input type="text" name="marital_status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Pendidikan Terakhir (Ortu)</label>
                                <input type="text" name="education" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Pekerjaan (Ortu)</label>
                                <input type="text" name="occupation" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Hubungan Keluarga</label>
                                <input type="text" name="family_relationship" value="Anak" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                            <!-- TAMBAHAN BARU: TELEPON -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Telepon / No. HP</label>
                                <input type="text" name="phone" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Contoh: 081234567890">
                            </div>
                        </div>

                        <!-- BAGIAN 3: ALAMAT & DOMISILI -->
                        <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Alamat & Domisili</h3>
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                            <div class="md:col-span-4">
                                <label class="block text-sm font-medium text-gray-700">Alamat Lengkap</label>
                                <textarea name="address" rows="2" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">RT</label>
                                <input type="text" name="rt" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">RW</label>
                                <input type="text" name="rw" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            </div>
                            <!-- TAMBAHAN BARU: DUSUN -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Dusun</label>
                                <input type="text" name="dusun" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Status Menetap</label>
                                <select name="is_resident" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                    <option value="1">Menetap (Warga Asli)</option>
                                    <option value="0">Pendatang (Domisili)</option>
                                </select>
                            </div>
                        </div>

                        <!-- BAGIAN 4: KETERANGAN TAMBAHAN (BARU) -->
                        <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Keterangan Lainnya</h3>
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700">Keterangan Tambahan (Opsional)</label>
                            <textarea name="notes" rows="2" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Masukkan catatan khusus jika ada..."></textarea>
                        </div>

                        <div class="flex items-center justify-end mt-4 gap-3">
                            <a href="{{ route('balita.index') }}" class="text-gray-600 hover:text-gray-900 px-4 py-2 bg-gray-100 rounded-md shadow-sm">
                                Batal
                            </a>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
                                Simpan Data
                            </button>
                        </div>
                    </form>

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