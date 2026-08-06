<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-800 leading-tight">
            {{ __('Catat Pemeriksaan Balita') }}
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
            <div class="bg-gradient-to-r from-blue-700 to-blue-500 rounded-3xl shadow-sm overflow-hidden">
                <div class="p-6 md:p-8 lg:p-10 flex flex-col justify-between gap-6">
                    <div class="w-full">
                        <span class="inline-flex items-center gap-2 py-1 px-3 rounded-full bg-white/15 border border-white/25 text-white text-xs font-semibold tracking-wide mb-3">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"></path></svg>
                            Rekam Medis
                        </span>
                        <h3 class="text-2xl sm:text-3xl font-bold text-white tracking-tight mb-2 leading-tight">
                            Pencatatan Pertumbuhan Baru
                        </h3>
                        <p class="text-blue-50 text-sm font-medium leading-relaxed max-w-2xl">
                            Isi formulir ini dengan lengkap berdasarkan hasil pengukuran dan observasi balita saat kegiatan posyandu berlangsung.
                        </p>
                    </div>
                </div>
            </div>

            <!-- 2. FORM SECTION -->
            <div class="bg-white rounded-2xl border border-blue-100 shadow-sm overflow-hidden">
                <div class="px-6 py-5 md:px-8 border-b border-blue-100">
                    <h3 class="text-lg font-bold text-slate-800">Formulir Rekam Medis</h3>
                    <p class="text-sm font-medium text-slate-500 mt-1">Gunakan kotak pencarian untuk menemukan data dengan cepat.</p>
                </div>

                <div class="p-6 md:p-8">
                    <form action="{{ route('pemeriksaan.store') }}" method="POST">
                        @csrf
                        
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
                                            <option value="{{ $k->id }}">{{ \Carbon\Carbon::parse($k->activity_date)->translatedFormat('d F Y') }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <!-- Dropdown Balita -->
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Nama Balita <span class="text-red-500">*</span></label>
                                    <select name="child_id" required class="select2-dinamis w-full border-slate-200 bg-white rounded-lg shadow-sm text-sm" data-placeholder="-- Ketik/Pilih Nama Balita --">
                                        <option value=""></option>
                                        @foreach($balita as $b)
                                            <option value="{{ $b->id }}">{{ $b->full_name }} (Ibu: {{ $b->mother_name }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <!-- Dropdown Kader -->
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Kader Pemeriksa <span class="text-red-500">*</span></label>
                                    <select name="staff_id" required class="select2-dinamis w-full border-slate-200 bg-white rounded-lg shadow-sm text-sm" data-placeholder="-- Ketik/Pilih Kader --">
                                        <option value=""></option>
                                        @foreach($kader as $kdr)
                                            <option value="{{ $kdr->id }}">{{ $kdr->full_name }}</option>
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
                                    <input type="number" step="0.01" max="999" name="weight" required class="w-full border-slate-200 bg-white rounded-lg shadow-sm px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Tinggi Badan (cm) <span class="text-red-500">*</span></label>
                                    <input type="number" step="0.01" max="999" name="height" required class="w-full border-slate-200 bg-white rounded-lg shadow-sm px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Lingkar Kepala (cm)</label>
                                    <input type="number" step="0.01" max="999" name="head_circumference" class="w-full border-slate-200 bg-white rounded-lg shadow-sm px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Lingkar Lengan (cm)</label>
                                    <input type="number" step="0.01" max="999" name="upper_arm_circumference" class="w-full border-slate-200 bg-white rounded-lg shadow-sm px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors">
                                </div>
                            </div>
                        </div>

                        <!-- BAGIAN 3: Observasi -->
                        <div class="mb-10">
                            <div class="flex items-center gap-2 mb-4">
                                <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center font-bold">3</div>
                                <h4 class="text-base font-bold text-slate-800">Observasi & Intervensi <span class="text-xs font-normal text-slate-500 ml-1">(Beri Ceklis jika Ya)</span></h4>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-5 sm:p-6 bg-slate-50 rounded-xl border border-slate-100">
                                <!-- Kolom 1: Gejala Penyakit -->
                                <div>
                                    <h4 class="font-bold text-sm text-slate-800 mb-4 pb-2 border-b border-slate-200">Gejala Penyakit</h4>
                                    <label class="flex items-center space-x-3 mb-3 cursor-pointer group">
                                        <input type="checkbox" name="cough_two_weeks" value="1" class="w-5 h-5 rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                        <span class="text-sm font-medium text-slate-600 group-hover:text-slate-900 transition-colors">Batuk > 2 Minggu</span>
                                    </label>
                                    <label class="flex items-center space-x-3 mb-3 cursor-pointer group">
                                        <input type="checkbox" name="fever_two_weeks" value="1" class="w-5 h-5 rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                        <span class="text-sm font-medium text-slate-600 group-hover:text-slate-900 transition-colors">Demam > 2 Minggu</span>
                                    </label>
                                    <label class="flex items-center space-x-3 mb-3 cursor-pointer group">
                                        <input type="checkbox" name="weight_not_increasing" value="1" class="w-5 h-5 rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                        <span class="text-sm font-medium text-slate-600 group-hover:text-slate-900 transition-colors">BB Tidak Naik</span>
                                    </label>
                                    <label class="flex items-center space-x-3 cursor-pointer group">
                                        <input type="checkbox" name="tb_contact" value="1" class="w-5 h-5 rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                        <span class="text-sm font-medium text-slate-600 group-hover:text-slate-900 transition-colors">Kontak Pasien TBC</span>
                                    </label>
                                </div>

                                <!-- Kolom 2: Gizi & Perkembangan -->
                                <div>
                                    <h4 class="font-bold text-sm text-slate-800 mb-4 pb-2 border-b border-slate-200">Gizi & Perkembangan</h4>
                                    <label class="flex items-center space-x-3 mb-3 cursor-pointer group">
                                        <input type="checkbox" name="exclusive_breastfeeding" value="1" class="w-5 h-5 rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                        <span class="text-sm font-medium text-slate-600 group-hover:text-slate-900 transition-colors">Lulus ASI Eksklusif</span>
                                    </label>
                                    <label class="flex items-center space-x-3 mb-3 cursor-pointer group">
                                        <input type="checkbox" name="complementary_feeding" value="1" class="w-5 h-5 rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                        <span class="text-sm font-medium text-slate-600 group-hover:text-slate-900 transition-colors">Dapat MP-ASI</span>
                                    </label>
                                    <label class="flex items-center space-x-3 cursor-pointer group">
                                        <input type="checkbox" name="development_check" value="1" class="w-5 h-5 rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                        <span class="text-sm font-medium text-slate-600 group-hover:text-slate-900 transition-colors">Cek Perkembangan Sesuai Umur</span>
                                    </label>
                                </div>

                                <!-- Kolom 3: Layanan Kesehatan -->
                                <div>
                                    <h4 class="font-bold text-sm text-slate-800 mb-4 pb-2 border-b border-slate-200">Layanan Kesehatan</h4>
                                    <label class="flex items-center space-x-3 mb-3 cursor-pointer group">
                                        <input type="checkbox" name="vitamin_a" value="1" class="w-5 h-5 rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                        <span class="text-sm font-medium text-slate-600 group-hover:text-slate-900 transition-colors">Diberikan Vitamin A</span>
                                    </label>
                                    <label class="flex items-center space-x-3 mb-3 cursor-pointer group">
                                        <input type="checkbox" name="deworming" value="1" class="w-5 h-5 rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                        <span class="text-sm font-medium text-slate-600 group-hover:text-slate-900 transition-colors">Diberikan Obat Cacing</span>
                                    </label>
                                    <label class="flex items-center space-x-3 mb-3 cursor-pointer group">
                                        <input type="checkbox" name="local_food_program" value="1" class="w-5 h-5 rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                        <span class="text-sm font-medium text-slate-600 group-hover:text-slate-900 transition-colors">Program PMT / Pangan Lokal</span>
                                    </label>
                                    <label class="flex items-center space-x-3 cursor-pointer group">
                                        <input type="checkbox" name="health_education" value="1" class="w-5 h-5 rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500">
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
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Jenis Imunisasi <span class="text-xs font-normal text-slate-500">(Jika Ada)</span></label>
                                    <input type="text" name="immunization" placeholder="Contoh: Polio 1 / DPT" class="w-full border-slate-200 bg-white rounded-lg shadow-sm px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Porsi PMT <span class="text-xs font-normal text-slate-500">(Jika Dapat)</span></label>
                                    <input type="text" name="pmt_portion" placeholder="Contoh: 1 mangkok bubur kacang hijau" class="w-full border-slate-200 bg-white rounded-lg shadow-sm px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Gejala Sakit Terlihat</label>
                                    <input type="text" name="illness_symptoms" placeholder="Contoh: Muncul ruam merah" class="w-full border-slate-200 bg-white rounded-lg shadow-sm px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Surat Rujukan <span class="text-xs font-normal text-slate-500">(Jika Perlu)</span></label>
                                    <input type="text" name="referral" placeholder="Contoh: Rujuk ke Poli Gizi" class="w-full border-slate-200 bg-white rounded-lg shadow-sm px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Catatan Khusus Kader</label>
                                    <textarea name="notes" rows="2" class="w-full border-slate-200 bg-white rounded-lg shadow-sm px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- TOMBOL AKSI -->
                        <div class="flex flex-col-reverse sm:flex-row items-center justify-end gap-3 pt-6 border-t border-slate-100">
                            <a href="{{ route('pemeriksaan.index') }}" class="w-full sm:w-auto text-center font-bold text-slate-600 px-6 py-3 bg-slate-100 rounded-xl hover:bg-slate-200 transition duration-300">
                                Batal
                            </a>
                            <button type="submit" class="w-full sm:w-auto inline-flex justify-center items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-xl shadow-sm transition duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Simpan Data Pemeriksaan
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
            // Aktifkan Select2 untuk semua elemen yang punya kelas 'select2-dinamis'
            $('.select2-dinamis').select2({
                allowClear: true,
                width: '100%' 
                // Catatan: Teks placeholder akan otomatis diambil dari atribut data-placeholder di elemen HTML
            });
        });
    </script>
</x-app-layout>