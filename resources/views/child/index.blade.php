<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Balita') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Tombol Tambah Balita -->
            <div class="mb-4 flex justify-end">
                <a href="{{ route('balita.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
                    + Tambah Balita
                </a>
            </div>

            <!-- Kotak Data (Card) -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto border-collapse">
                            <thead class="bg-gray-100 border-b-2 border-gray-200">
                                <tr>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">NO</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">NAMA BALITA</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">L/P</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">TANGGAL LAHIR</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">NAMA IBU</th>
                                    <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Looping Data Balita -->
                                @forelse ($children as $index => $child)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="px-4 py-4 text-sm">{{ $index + 1 }}</td>
                                        <td class="px-4 py-4 text-sm font-medium text-gray-900">{{ $child->full_name }}</td>
                                        <td class="px-4 py-4 text-sm text-gray-600">{{ $child->gender }}</td>
                                        <td class="px-4 py-4 text-sm text-gray-600">{{ $child->birth_date }}</td>
                                        <td class="px-4 py-4 text-sm text-gray-600">{{ $child->mother_name }}</td>
                                        <td class="px-4 py-4 text-sm text-center flex justify-center gap-2">
                                            <!-- Tombol Edit -->
                                            <a href="{{ route('balita.edit', $child->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs font-semibold">
                                                Edit
                                            </a>

                                            <!-- Tombol Hapus -->
                                            <form action="{{ route('balita.destroy', $child->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data balita ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs font-semibold">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <!-- Jika Datanya Kosong -->
                                    <tr>
                                        <td colspan="6" class="px-4 py-12 text-center text-gray-500">
                                            <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                            </svg>
                                            <p class="text-lg font-medium text-gray-900">Belum ada data balita.</p>
                                            <p class="text-sm mt-1">Klik tombol <strong>Tambah Balita</strong> di atas untuk mendaftarkan balita baru.</p>
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