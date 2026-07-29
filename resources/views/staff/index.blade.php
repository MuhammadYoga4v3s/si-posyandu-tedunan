<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100">
                Data Kader
            </h2>

            <a href="{{ route('kader.create') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow transition">
                + Tambah Kader
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow overflow-hidden">

                <div class="px-6 py-5 border-b dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                        Daftar Kader Posyandu
                    </h3>

                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Kelola seluruh data kader Posyandu Desa Tedunan.
                    </p>
                </div>

                <div class="overflow-x-auto">

                    <table class="min-w-full">

                        <thead class="bg-gray-100 dark:bg-gray-700">

                            <tr>

                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase">
                                    No
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase">
                                    Nama
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase">
                                    Username
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase">
                                    Jabatan
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase">
                                    Nomor HP
                                </th>

                                <th class="px-6 py-3 text-center text-xs font-semibold uppercase">
                                    Aksi
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            <tr class="border-t dark:border-gray-700">

                                <td colspan="6"
                                    class="py-12 text-center text-gray-500 dark:text-gray-400">

                                    <div class="flex flex-col items-center">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="w-14 h-14 mb-3 text-gray-300"
                                             fill="none"
                                             viewBox="0 0 24 24"
                                             stroke="currentColor">

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="1.5"
                                                  d="M17 20h5V4H2v16h5m10 0v-2a3 3 0 00-3-3H10a3 3 0 00-3 3v2m10 0H7m10-10a3 3 0 11-6 0 3 3 0 016 0z"/>

                                        </svg>

                                        <p class="font-medium">
                                            Belum ada data kader.
                                        </p>

                                        <p class="text-sm mt-1">
                                            Klik tombol <b>Tambah Kader</b> untuk menambahkan data baru.
                                        </p>

                                    </div>

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>