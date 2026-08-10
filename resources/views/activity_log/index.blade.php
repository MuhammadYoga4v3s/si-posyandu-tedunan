<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Aktivitas Sistem') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="mb-6 border-b pb-4">
                        <h3 class="text-lg font-bold text-gray-700">Log Aktivitas Pengguna</h3>
                        <p class="text-sm text-gray-500">Rekaman seluruh tindakan penambahan, perubahan, dan penghapusan data pada sistem.</p>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-100 border-b">
                                    <th class="px-4 py-3 font-semibold text-gray-600">No</th>
                                    <th class="px-4 py-3 font-semibold text-gray-600">Waktu</th>
                                    <th class="px-4 py-3 font-semibold text-gray-600">Pengguna</th>
                                    <th class="px-4 py-3 font-semibold text-gray-600">Aktivitas</th>
                                    <th class="px-4 py-3 font-semibold text-gray-600">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($logs as $index => $log)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="px-4 py-3">{{ $index + 1 }}</td>
                                        
                                        <!-- Menampilkan waktu dengan format rapi -->
                                        <td class="px-4 py-3 text-sm text-gray-600">
                                            {{ \Carbon\Carbon::parse($log->created_at)->translatedFormat('d F Y H:i:s') }}
                                        </td>
                                        
                                        <!-- Nama User -->
                                        <td class="px-4 py-3 font-medium text-blue-600">
                                            {{ $log->user->name ?? 'Sistem' }}
                                        </td>
                                        
                                        <!-- Aktivitas -->
                                        <td class="px-4 py-3">
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                                {{ str_contains(strtolower($log->activity), 'tambah') ? 'bg-green-100 text-green-700' : '' }}
                                                {{ str_contains(strtolower($log->activity), 'ubah') ? 'bg-yellow-100 text-yellow-700' : '' }}
                                                {{ str_contains(strtolower($log->activity), 'hapus') ? 'bg-red-100 text-red-700' : '' }}
                                                {{ !str_contains(strtolower($log->activity), 'tambah') && !str_contains(strtolower($log->activity), 'ubah') && !str_contains(strtolower($log->activity), 'hapus') ? 'bg-blue-100 text-blue-700' : '' }}
                                            ">
                                                {{ $log->activity }}
                                            </span>
                                        </td>
                                        
                                        <!-- Keterangan detail -->
                                        <td class="px-4 py-3 text-sm text-gray-600">{{ $log->description }}</td>
                                    </tr>
                                @empty
                                    <!-- Jika database log masih kosong -->
                                    <tr>
                                        <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                                            Belum ada rekaman aktivitas di sistem.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

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