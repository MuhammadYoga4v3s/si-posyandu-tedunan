<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Kader') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <!-- Form Edit Kader -->
                    <form action="{{ route('kader.update', $staff->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Informasi Akun (Untuk Login)</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <!-- Username -->
                            <div>
                                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                                <input type="text" name="username" id="username" value="{{ old('username', $staff->user->username) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            </div>

                            <!-- Password -->
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700">Password Baru</label>
                                <input type="password" name="password" id="password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <span class="text-xs text-gray-500">Kosongkan jika tidak ingin mengubah password.</span>
                            </div>
                        </div>

                        <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Informasi Data Diri Kader</h3>
                        
                        <div class="grid grid-cols-1 gap-4 mb-6">
                            <!-- Nama Lengkap -->
                            <div>
                                <label for="full_name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                <input type="text" name="full_name" id="full_name" value="{{ old('full_name', $staff->full_name) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Jabatan -->
                                <div>
                                    <label for="position" class="block text-sm font-medium text-gray-700">Jabatan</label>
                                    <input type="text" name="position" id="position" value="{{ old('position', $staff->position) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                </div>

                                <!-- Nomor HP -->
                                <div>
                                    <label for="phone_number" class="block text-sm font-medium text-gray-700">Nomor HP</label>
                                    <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', $staff->phone_number) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                </div>
                            </div>

                            <!-- Alamat -->
                            <div>
                                <label for="address" class="block text-sm font-medium text-gray-700">Alamat Lengkap</label>
                                <textarea name="address" id="address" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>{{ old('address', $staff->address) }}</textarea>
                            </div>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="flex items-center justify-end mt-4 gap-3">
                            <a href="{{ route('kader.index') }}" class="text-gray-600 hover:text-gray-900 px-4 py-2 bg-gray-100 rounded-md shadow-sm hover:bg-gray-200">
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