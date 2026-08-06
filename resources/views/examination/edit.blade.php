<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-800 leading-tight">
            {{ __('Edit Data Pemeriksaan') }}
        </h2>
    </x-slot>

    <!-- Panggil CSS Select2 dari CDN untuk style dropdown dinamis -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
    <!-- Override style Select2 biar match dengan Tailwind -->
    <style>
        .select2-container .select2-selection--single {
            height: 42px !important;
            border-radius: 0.5rem !important;
            border: 1px solid #e2e8f0 !important;
            display: flex;
            align-items: center;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 40px !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #334155 !important;
            font-size: 0.875rem !important;
            line-height: 1.25rem !important;
        }
        .select2-search__field { outline: none !important; }
    </style>

    <div class="pt-6 sm:pt-10 bg-gradient-to-b from-blue-50 to-white min-h-[calc(100vh-4rem)] flex flex-col">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8 w-full flex-grow mb-10">

            <!-- 1. HERO BANNER -->
            <div class="bg-gradient-to-r from-amber-600 to-amber-500 rounded-3xl shadow-sm overflow-hidden">
                <div class="p-6 md:p-8 lg:p-10 flex flex-col justify-between gap-6">
                    <div class="w-full">
                        <span class="inline-flex items-center gap-2 py-1 px-3 rounded-full bg-white/15 border border-white/25 text-white text-xs font-semibold tracking-wide mb-3">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            Koreksi Rekam Medis
                        </span>
                        <h3 class="text-2xl sm:text-3xl font-bold text-white tracking-tight mb-2 leading-tight">
                            Edit Data Pemeriksaan
                        </h3>
                        <p class="text-amber-50 text-sm font-medium leading-relaxed max-w-2xl">
                            Perbarui informasi pengukuran atau observasi jika terdapat kesalahan pada saat penginputan data sebelumnya.
                        </p>
                    </div>
                </div>
            </div>

            <!-- 2. FORM SECTION -->
            <div class="bg-white rounded-2xl border border-amber-100 shadow-sm overflow-hidden">
                <div class="px-6 py-5 md:px-8 border-b border-amber-100">
                    <h3 class="text-lg font-bold text-slate-800">Formulir Perubahan Data</h3>
                    <p class="text-sm font-medium text-slate-500 mt-1">Pastikan data yang diubah sudah sesuai dengan buku KIA balita.</p>
                </div>

                <div class="p-6 md:p-8">
                    <!-- Gunakan ID/route yang benar sesuai kode aslimu (pemeriksaan.update / examination.update) -->
                    <form action="{{ route('pemeriksaan.update', $pemeriksaan->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <!-- BAGIAN 1: Informasi Utama -->
                        <div class="mb-10">
                            <div class="flex items-center gap-2 mb-4">
                                <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center font-bold">1</div>
                                <h4 class="text-base font-bold text-slate-800">Informasi Utama</h4>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-5 sm:p-6 bg-slate-50 rounded-xl border border-slate-100">
                                <!-- Dropdown Kegiatan -->
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Jadwal Kegiatan <span class="text-red-500">*</span></label>
                                    <select name="activity_id" required class="select2-dinamis w-full border-slate-200 bg-white rounded-lg shadow-sm text-sm" data-placeholder="-- Ketik/Pilih Kegiatan --">
                                        <option value=""></option>
                                        @foreach($kegiatan as $k)
                                            <option value="{{ $k->id }}" {{ $pemeriksaan->activity_id == $k->id ? 'selected' : '' }}>
                                                {{ \Carbon\Carbon::parse($k->activity_date)->locale('id')->translatedFormat('d F Y') }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <!-- Dropdown Balita -->
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Nama Balita <span class="text-red-500">*</span></label>
                                    <select name="child_id" required class="select2-dinamis w-full border-slate-200 bg-white rounded-lg shadow-sm text-sm" data-placeholder="-- Ketik/Pilih Nama Balita --">
                                        <option value=""></option>
                                        @foreach($balita as $b)
                                            <option value="{{ $b->id }}" {{ $pemeriksaan->child_id == $b->id ? 'selected' : '' }}>
                                                {{ $b->full_name }} (Ibu: {{ $b->mother_name }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <!-- Dropdown Kader -->
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Kader Pemeriksa <span class="text-red-500">*</span></label>
                                    <select name="staff_id" required class="select2-dinamis w-full border-slate-200 bg-white rounded-lg shadow-sm text-sm" data-placeholder="-- Ketik/Pilih Kader --">
                                        <option value=""></option>
                                        @foreach($kader as $kdr)
                                            <option value="{{ $kdr->id }}" {{ $pemeriksaan->staff_id == $kdr->id ? 'selected' : '' }}>
                                                {{ $kdr->full_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- BAGIAN 2: Pengukuran Pertumbuhan -->
                        <div class="mb-10">
                            <div class="flex items-center gap-2 mb-4">
                                <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold">2</div>
                                <h4 class="text-base font-bold text-slate-800">Pengukuran Pertumbuhan</h4>
                            </div>
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 p-5 sm:p-6 bg-slate-50 rounded-xl border border-slate-100">
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Berat Badan (kg) <span class="text-red-500">*</span></label>
                                    <input type="number" step="0.01" max="999" name="weight" value="{{ $pemeriksaan->weight }}" required class="w-full border-slate-200 bg-white rounded-lg shadow-sm px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Tinggi Badan (cm) <span class="text-red-500">*</span></label>
                                    <input type="number" step="0.01" max="999" name="height" value="{{ $pemeriksaan->height }}" required class="w-full border-slate-200 bg-white rounded-lg shadow-sm px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Lingkar Kepala (cm)</label>
                                    <input type="number" step="0.01" max="999" name="head_circumference" value="{{ $pemeriksaan->head_circumference }}" class="w-full border-slate-200 bg-white rounded-lg shadow-sm px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Lingkar Lengan (cm)</label>
                                    <input type="number" step="0.01" max="999" name="upper_arm_circumference" value="{{ $pemeriksaan->upper_arm_circumference }}" class="w-full border-slate-200 bg-white rounded-lg shadow-sm px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors">
                                </div>
                            </div>
                        </div>

                        <!-- BAGIAN 3: Observasi -->
                        <div class="mb-10">
                            <div class="flex items-center gap-2 mb-4">
                                <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center font-bold">3</div>
                                <h4 class="text-base font-bold text-slate-800">Observasi & Intervensi</h4>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-5 sm:p-6 bg-slate-50 rounded-xl border border-slate-100">
                                <!-- Kolom 1: Gejala Penyakit -->
                                <div>
                                    <h4 class="font-bold text-sm text-slate-800 mb-4 pb-2 border-b border-slate-200">Gejala Penyakit</h4>
                                    <label class="flex items-center space-x-3 mb-3 cursor-pointer group">
                                        <input type="checkbox" name="cough_two_weeks" value="1" {{ $pemeriksaan->cough_two_weeks ? 'checked' : '' }} class="w-5 h-5 rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                        <span class="text-sm font-medium text-slate-600 group-hover:text-slate-900 transition-colors">Batuk > 2 Minggu</span>
                                    </label>
                                    <label class="flex items-center space-x-3 mb-3 cursor-pointer group">
                                        <input type="checkbox" name="fever_two_weeks" value="1" {{ $pemeriksaan->fever_two_weeks ? 'checked' : '' }} class="w-5 h-5 rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                        <span class="text-sm font-medium text-slate-600 group-hover:text-slate-900 transition-colors">Demam > 2 Minggu</span>
                                    </label>
                                    <label class="flex items-center space-x-3 mb-3 cursor-pointer group">
                                        <input type="checkbox" name="weight_not_increasing" value="1" {{ $pemeriksaan->weight_not_increasing ? 'checked' : '' }} class="w-5 h-5 rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                        <span class="text-sm font-medium text-slate-600 group-hover:text-slate-900 transition-colors">BB Tidak Naik</span>
                                    </label>
                                    <label class="flex items-center space-x-3 cursor-pointer group">
                                        <input type="checkbox" name="tb_contact" value="1" {{ $pemeriksaan->tb_contact ? 'checked' : '' }} class="w-5 h-5 rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                        <span class="text-sm font-medium text-slate-600 group-hover:text-slate-900 transition-colors">Kontak Pasien TBC</span>
                                    </label>
                                </div>

                                <!-- Kolom 2: Gizi & Perkembangan -->
                                <div>
                                    <h4 class="font-bold text-sm text-slate-800 mb-4 pb-2 border-b border-slate-200">Gizi & Perkembangan</h4>
                                    <label class="flex items-center space-x-3 mb-3 cursor-pointer group">
                                        <input type="checkbox" name="exclusive_breastfeeding" value="1" {{ $pemeriksaan->exclusive_breastfeeding ? 'checked' : '' }} class="w-5 h-5 rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                        <span class="text-sm font-medium text-slate-600 group-hover:text-slate-900 transition-colors">Lulus ASI Eksklusif</span>
                                    </label>
                                    <label class="flex items-center space-x-3 mb-3 cursor-pointer group">
                                        <input type="checkbox" name="complementary_feeding" value="1" {{ $pemeriksaan->complementary_feeding ? 'checked' : '' }} class="w-5 h-5 rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                        <span class="text-sm font-medium text-slate-600 group-hover:text-slate-900 transition-colors">Dapat MP-ASI</span>
                                    </label>
                                    <label class="flex items-center space-x-3 cursor-pointer group">
                                        <input type="checkbox" name="development_check" value="1" {{ $pemeriksaan->development_check ? 'checked' : '' }} class="w-5 h-5 rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                        <span class="text-sm font-medium text-slate-600 group-hover:text-slate-900 transition-colors">Cek Perkembangan</span>
                                    </label>
                                </div>

                                <!-- Kolom 3: Layanan Kesehatan -->
                                <div>
                                    <h4 class="font-bold text-sm text-slate-800 mb-4 pb-2 border-b border-slate-200">Layanan Kesehatan</h4>
                                    <label class="flex items-center space-x-3 mb-3 cursor-pointer group">
                                        <input type="checkbox" name="vitamin_a" value="1" {{ $pemeriksaan->vitamin_a ? 'checked' : '' }} class="w-5 h-5 rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                        <span class="text-sm font-medium text-slate-600 group-hover:text-slate-900 transition-colors">Diberikan Vitamin A</span>
                                    </label>
                                    <label class="flex items-center space-x-3 mb-3 cursor-pointer group">
                                        <input type="checkbox" name="deworming" value="1" {{ $pemeriksaan->deworming ? 'checked' : '' }} class="w-5 h-5 rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                        <span class="text-sm font-medium text-slate-600 group-hover:text-slate-900 transition-colors">Diberikan Obat Cacing</span>
                                    </label>
                                    <label class="flex items-center space-x-3 mb-3 cursor-pointer group">
                                        <input type="checkbox" name="local_food_program" value="1" {{ $pemeriksaan->local_food_program ? 'checked' : '' }} class="w-5 h-5 rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                        <span class="text-sm font-medium text-slate-600 group-hover:text-slate-900 transition-colors">Program Pangan Lokal (PMT)</span>
                                    </label>
                                    <label class="flex items-center space-x-3 cursor-pointer group">
                                        <input type="checkbox" name="health_education" value="1" {{ $pemeriksaan->health_education ? 'checked' : '' }} class="w-5 h-5 rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                        <span class="text-sm font-medium text-slate-600 group-hover:text-slate-900 transition-colors">Edukasi / Konseling Gizi</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- BAGIAN 4: Catatan -->
                        <div class="mb-4">
                            <div class="flex items-center gap-2 mb-4">
                                <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold">4</div>
                                <h4 class="text-base font-bold text-slate-800">Catatan Tambahan</h4>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-5 sm:p-6 bg-slate-50 rounded-xl border border-slate-100">
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Jenis Imunisasi</label>
                                    <input type="text" name="immunization" value="{{ $pemeriksaan->immunization }}" class="w-full border-slate-200 bg-white rounded-lg shadow-sm px-4 py-2.5 text-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Porsi PMT</label>
                                    <input type="text" name="pmt_portion" value="{{ $pemeriksaan->pmt_portion }}" class="w-full border-slate-200 bg-white rounded-lg shadow-sm px-4 py-2.5 text-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Gejala Sakit Terlihat</label>
                                    <input type="text" name="illness_symptoms" value="{{ $pemeriksaan->illness_symptoms }}" class="w-full border-slate-200 bg-white rounded-lg shadow-sm px-4 py-2.5 text-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Surat Rujukan</label>
                                    <input type="text" name="referral" value="{{ $pemeriksaan->referral }}" class="w-full border-slate-200 bg-white rounded-lg shadow-sm px-4 py-2.5 text-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors">
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Catatan Khusus Kader</label>
                                    <textarea name="notes" rows="2" class="w-full border-slate-200 bg-white rounded-lg shadow-sm px-4 py-2.5 text-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors">{{ $pemeriksaan->notes }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- TOMBOL AKSI -->
                        <div class="flex flex-col-reverse sm:flex-row items-center justify-end gap-3 pt-6 border-t border-slate-100">
                            <a href="{{ route('pemeriksaan.index') }}" class="w-full sm:w-auto text-center font-bold text-slate-600 px-6 py-3 bg-slate-100 rounded-xl hover:bg-slate-200 transition duration-300">
                                Batal
                            </a>
                            <button type="submit" class="w-full sm:w-auto inline-flex justify-center items-center gap-2 bg-amber-500 hover:bg-amber-600 text-white font-bold py-3 px-6 rounded-xl shadow-sm transition duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                Update Data Pemeriksaan
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

    <!-- Panggil jQuery dan JS Select2 untuk mengaktifkan fitur pencarian -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Aktifkan Select2 untuk dropdown pencarian
            $('.select2-dinamis').select2({
                allowClear: false,
                width: '100%'
            });
        });
    </script>
</x-app-layout>