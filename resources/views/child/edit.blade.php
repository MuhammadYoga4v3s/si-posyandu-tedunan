<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Balita') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form action="{{ route('balita.update', $child->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <!-- BAGIAN 1: IDENTITAS BALITA -->
                        <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Identitas Balita</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nama Lengkap Balita</label>
                                <input type="text" name="full_name" value="{{ old('full_name', $child->full_name) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">NIK Balita (Jika ada)</label>
                                <input type="text" name="national_id" value="{{ old('national_id', $child->national_id) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                                <input type="text" name="birth_place" value="{{ old('birth_place', $child->birth_place) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                                <input type="date" name="birth_date" value="{{ old('birth_date', $child->birth_date) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                                <select name="gender" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                    <option value="Male" {{ old('gender', $child->gender) == 'Male' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Female" {{ old('gender', $child->gender) == 'Female' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tag ID Card</label>
                                <input type="text" name="card_tag" value="{{ old('card_tag', $child->card_tag) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                            <!-- TAMBAHAN BARU: BERAT & PANJANG LAHIR -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Berat Badan Lahir (kg)</label>
                                <input type="number" step="0.01" name="birth_weight" value="{{ old('birth_weight', $child->birth_weight) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Contoh: 3.2">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Panjang Badan Lahir (cm)</label>
                                <input type="number" step="0.01" name="birth_length" value="{{ old('birth_length', $child->birth_length) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Contoh: 49.5">
                            </div>
                        </div>

                        <!-- BAGIAN 2: DATA KELUARGA -->
                        <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Data Keluarga</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nomor Kartu Keluarga (KK)</label>
                                <input type="text" name="family_card_number" value="{{ old('family_card_number', $child->family_card_number) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nama Ayah</label>
                                <input type="text" name="father_name" value="{{ old('father_name', $child->father_name) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nama Ibu</label>
                                <input type="text" name="mother_name" value="{{ old('mother_name', $child->mother_name) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Agama</label>
                                <input type="text" name="religion" value="{{ old('religion', $child->religion) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Status Perkawinan</label>
                                <input type="text" name="marital_status" value="{{ old('marital_status', $child->marital_status) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Pendidikan Terakhir</label>
                                <input type="text" name="education" value="{{ old('education', $child->education) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Pekerjaan</label>
                                <input type="text" name="occupation" value="{{ old('occupation', $child->occupation) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Hubungan Keluarga</label>
                                <input type="text" name="family_relationship" value="{{ old('family_relationship', $child->family_relationship) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                            <!-- TAMBAHAN BARU: TELEPON -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Telepon / No. HP</label>
                                <input type="text" name="phone" value="{{ old('phone', $child->phone) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Contoh: 081234567890">
                            </div>
                        </div>

                        <!-- BAGIAN 3: ALAMAT & DOMISILI -->
                        <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Alamat & Domisili</h3>
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                            <div class="md:col-span-4">
                                <label class="block text-sm font-medium text-gray-700">Alamat Lengkap</label>
                                <textarea name="address" rows="2" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>{{ old('address', $child->address) }}</textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">RT</label>
                                <input type="text" name="rt" value="{{ old('rt', $child->rt) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">RW</label>
                                <input type="text" name="rw" value="{{ old('rw', $child->rw) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            </div>
                            <!-- TAMBAHAN BARU: DUSUN -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Dusun</label>
                                <input type="text" name="dusun" value="{{ old('dusun', $child->dusun) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Status Menetap</label>
                                <select name="is_resident" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                    <option value="1" {{ old('is_resident', $child->is_resident) == 1 ? 'selected' : '' }}>Menetap (Warga Asli)</option>
                                    <option value="0" {{ old('is_resident', $child->is_resident) == 0 ? 'selected' : '' }}>Pendatang (Domisili)</option>
                                </select>
                            </div>
                        </div>

                        <!-- BAGIAN 4: KETERANGAN TAMBAHAN (BARU) -->
                        <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Keterangan Lainnya</h3>
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700">Keterangan Tambahan (Opsional)</label>
                            <textarea name="notes" rows="2" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Masukkan catatan khusus jika ada...">{{ old('notes', $child->notes) }}</textarea>
                        </div>

                        <div class="flex items-center justify-end mt-4 gap-3">
                            <a href="{{ route('balita.index') }}" class="text-gray-600 hover:text-gray-900 px-4 py-2 bg-gray-100 rounded-md shadow-sm">
                                Batal
                            </a>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
                                Simpan Perubahan
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