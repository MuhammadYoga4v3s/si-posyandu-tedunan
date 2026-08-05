<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pencatatan Pemeriksaan Balita (Lengkap)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form action="{{ route('pemeriksaan.store') }}" method="POST">
                        @csrf

                        <!-- Bagian 1: Data Utama -->
                        <h3 class="text-lg font-bold text-gray-700 mb-4 border-b pb-2">1. Informasi Utama</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Jadwal Kegiatan</label>
                                <select name="activity_id" required class="w-full border-gray-300 rounded-md shadow-sm">
                                    <option value="">-- Pilih Kegiatan --</option>
                                    @foreach($kegiatan as $k)
                                        <option value="{{ $k->id }}">{{ \Carbon\Carbon::parse($k->activity_date)->translatedFormat('d F Y') }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Balita</label>
                                <select name="child_id" required class="w-full border-gray-300 rounded-md shadow-sm">
                                    <option value="">-- Pilih Balita --</option>
                                    @foreach($balita as $b)
                                        <option value="{{ $b->id }}">{{ $b->full_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kader Pemeriksa</label>
                                <select name="staff_id" required class="w-full border-gray-300 rounded-md shadow-sm">
                                    <option value="">-- Pilih Kader --</option>
                                    @foreach($kader as $kdr)
                                        <option value="{{ $kdr->id }}">{{ $kdr->full_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Bagian 2: Pengukuran Pertumbuhan (Growth) -->
                        <h3 class="text-lg font-bold text-gray-700 mb-4 border-b pb-2">2. Pengukuran Pertumbuhan</h3>
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Berat Badan (kg)</label>
                                <input type="number" step="0.01" max="999" name="weight" required class="w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tinggi Badan (cm)</label>
                                <input type="number" step="0.01" max="999" name="height" required class="w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Lingkar Kepala (cm)</label>
                                <input type="number" step="0.01" max="999" name="head_circumference" class="w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Lingkar Lengan Atas (cm)</label>
                                <input type="number" step="0.01" max="999" name="upper_arm_circumference" class="w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                        </div>

                        <!-- Bagian 3: Checklist Observasi -->
                        <h3 class="text-lg font-bold text-gray-700 mb-4 border-b pb-2">3. Observasi & Intervensi (Beri Ceklis jika Ya)</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 bg-gray-50 p-4 rounded-lg">
                            
                            <!-- Kolom 1: Gejala Penyakit -->
                            <div>
                                <h4 class="font-semibold text-sm text-gray-800 mb-3">Gejala Penyakit</h4>
                                <label class="flex items-center space-x-3 mb-2">
                                    <input type="checkbox" name="cough_two_weeks" value="1" class="rounded border-gray-300 text-blue-600 shadow-sm">
                                    <span class="text-sm text-gray-700">Batuk > 2 Minggu</span>
                                </label>
                                <label class="flex items-center space-x-3 mb-2">
                                    <input type="checkbox" name="fever_two_weeks" value="1" class="rounded border-gray-300 text-blue-600 shadow-sm">
                                    <span class="text-sm text-gray-700">Demam > 2 Minggu</span>
                                </label>
                                <label class="flex items-center space-x-3 mb-2">
                                    <input type="checkbox" name="weight_not_increasing" value="1" class="rounded border-gray-300 text-blue-600 shadow-sm">
                                    <span class="text-sm text-gray-700">BB Tidak Naik</span>
                                </label>
                                <label class="flex items-center space-x-3 mb-2">
                                    <input type="checkbox" name="tb_contact" value="1" class="rounded border-gray-300 text-blue-600 shadow-sm">
                                    <span class="text-sm text-gray-700">Kontak Pasien TBC</span>
                                </label>
                            </div>

                            <!-- Kolom 2: Gizi & Perkembangan -->
                            <div>
                                <h4 class="font-semibold text-sm text-gray-800 mb-3">Gizi & Perkembangan</h4>
                                <label class="flex items-center space-x-3 mb-2">
                                    <input type="checkbox" name="exclusive_breastfeeding" value="1" class="rounded border-gray-300 text-blue-600 shadow-sm">
                                    <span class="text-sm text-gray-700">Lulus ASI Eksklusif</span>
                                </label>
                                <label class="flex items-center space-x-3 mb-2">
                                    <input type="checkbox" name="complementary_feeding" value="1" class="rounded border-gray-300 text-blue-600 shadow-sm">
                                    <span class="text-sm text-gray-700">Dapat MP-ASI</span>
                                </label>
                                <label class="flex items-center space-x-3 mb-2">
                                    <input type="checkbox" name="development_check" value="1" class="rounded border-gray-300 text-blue-600 shadow-sm">
                                    <span class="text-sm text-gray-700">Cek Perkembangan Sesuai Umur</span>
                                </label>
                            </div>

                            <!-- Kolom 3: Layanan Kesehatan -->
                            <div>
                                <h4 class="font-semibold text-sm text-gray-800 mb-3">Layanan Kesehatan</h4>
                                <label class="flex items-center space-x-3 mb-2">
                                    <input type="checkbox" name="vitamin_a" value="1" class="rounded border-gray-300 text-blue-600 shadow-sm">
                                    <span class="text-sm text-gray-700">Diberikan Vitamin A</span>
                                </label>
                                <label class="flex items-center space-x-3 mb-2">
                                    <input type="checkbox" name="deworming" value="1" class="rounded border-gray-300 text-blue-600 shadow-sm">
                                    <span class="text-sm text-gray-700">Diberikan Obat Cacing</span>
                                </label>
                                <label class="flex items-center space-x-3 mb-2">
                                    <input type="checkbox" name="local_food_program" value="1" class="rounded border-gray-300 text-blue-600 shadow-sm">
                                    <span class="text-sm text-gray-700">Program Pangan Lokal (PMT)</span>
                                </label>
                                <label class="flex items-center space-x-3 mb-2">
                                    <input type="checkbox" name="health_education" value="1" class="rounded border-gray-300 text-blue-600 shadow-sm">
                                    <span class="text-sm text-gray-700">Edukasi / Konseling Gizi</span>
                                </label>
                            </div>
                        </div>

                        <!-- Bagian 4: Catatan & Teks Tambahan -->
                        <h3 class="text-lg font-bold text-gray-700 mb-4 border-b pb-2">4. Imunisasi, PMT & Catatan Tambahan</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Imunisasi (Jika Ada)</label>
                                <input type="text" name="immunization" placeholder="Contoh: Polio 1 / DPT" class="w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                            
                            <!-- TAMBAHAN BARU: INPUT PORSI PMT -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Porsi PMT (Jika Dapat Pangan Lokal)</label>
                                <input type="text" name="pmt_portion" placeholder="Contoh: 1 mangkok bubur kacang hijau" class="w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                            <!-- ------------------------------- -->

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Gejala Sakit Terlihat</label>
                                <input type="text" name="illness_symptoms" placeholder="Contoh: Muncul ruam merah" class="w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Surat Rujukan (Jika Perlu Puskemas)</label>
                                <input type="text" name="referral" placeholder="Contoh: Rujuk ke Poli Gizi" class="w-full border-gray-300 rounded-md shadow-sm">
                            </div>

                            <!-- Catatan dibentangkan penuh agar layout tidak berantakan -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Catatan Tambahan Kader</label>
                                <textarea name="notes" rows="2" class="w-full border-gray-300 rounded-md shadow-sm"></textarea>
                            </div>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="flex justify-end space-x-3 mt-6 border-t pt-4">
                            <a href="{{ route('pemeriksaan.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 font-semibold rounded-md hover:bg-gray-300 transition">Batal</a>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition">Simpan Data Pemeriksaan</button>
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