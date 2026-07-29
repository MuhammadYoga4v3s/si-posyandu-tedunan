<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            SI Posyandu Tedunan
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 mb-6">
                <h3 class="text-2xl font-bold text-gray-800 dark:text-white">
                    Selamat Datang, {{ Auth::user()->name }}
                </h3>

                <p class="text-gray-600 dark:text-gray-300 mt-2">
                    Sistem Informasi Pencatatan Posyandu Desa Tedunan
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                <div class="bg-blue-500 text-white rounded-lg shadow p-5">
                    <h4 class="text-lg font-semibold">Balita</h4>
                    <p class="text-3xl font-bold mt-2">0</p>
                </div>

                <div class="bg-green-500 text-white rounded-lg shadow p-5">
                    <h4 class="text-lg font-semibold">Petugas</h4>
                    <p class="text-3xl font-bold mt-2">0</p>
                </div>

                <div class="bg-yellow-500 text-white rounded-lg shadow p-5">
                    <h4 class="text-lg font-semibold">Pemeriksaan</h4>
                    <p class="text-3xl font-bold mt-2">0</p>
                </div>

                <div class="bg-red-500 text-white rounded-lg shadow p-5">
                    <h4 class="text-lg font-semibold">Kegiatan</h4>
                    <p class="text-3xl font-bold mt-2">0</p>
                </div>

            </div>

            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 mt-6">
                <h4 class="text-xl font-semibold mb-3 text-gray-800 dark:text-white">
                    Aktivitas Terbaru
                </h4>

                <p class="text-gray-500 dark:text-gray-400">
                    Belum ada aktivitas.
                </p>
            </div>

        </div>
    </div>
</x-app-layout>