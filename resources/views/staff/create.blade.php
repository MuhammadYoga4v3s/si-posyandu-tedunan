<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100">
                Tambah Kader
            </h2>

            <a href="{{ route('kader.index') }}"
                class="text-gray-600 hover:text-blue-600">
                ← Kembali ke Data Kader
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-8">

                <form>

                    <div class="mb-8">

                        <h3 class="text-lg font-semibold mb-5">
                            Informasi Akun
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <div>
                                <label class="block mb-2 font-medium">
                                    Username
                                </label>

                                <input
                                    type="text"
                                    class="w-full rounded-lg border-gray-300">
                            </div>

                            <div>
                                <label class="block mb-2 font-medium">
                                    Password
                                </label>

                                <input
                                    type="password"
                                    class="w-full rounded-lg border-gray-300">
                            </div>

                        </div>

                        <div class="mt-6">

                            <label class="block mb-2 font-medium">
                                Konfirmasi Password
                            </label>

                            <input
                                type="password"
                                class="w-full rounded-lg border-gray-300">

                        </div>

                    </div>

                    <hr class="my-8">

                    <div>

                        <h3 class="text-lg font-semibold mb-5">
                            Informasi Kader
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <div>

                                <label class="block mb-2 font-medium">
                                    Nama Lengkap
                                </label>

                                <input
                                    type="text"
                                    class="w-full rounded-lg border-gray-300">

                            </div>

                            <div>

                                <label class="block mb-2 font-medium">
                                    Jabatan
                                </label>

                                <select class="w-full rounded-lg border-gray-300">

                                    <option>Pilih Jabatan</option>
                                    <option>Ketua Kader</option>
                                    <option>Sekretaris</option>
                                    <option>Bendahara</option>
                                    <option>Kader Posyandu</option>

                                </select>

                            </div>

                            <div>

                                <label class="block mb-2 font-medium">
                                    Nomor HP
                                </label>

                                <input
                                    type="text"
                                    class="w-full rounded-lg border-gray-300">

                            </div>

                            <div>

                                <label class="block mb-2 font-medium">
                                    Alamat
                                </label>

                                <textarea
                                    rows="3"
                                    class="w-full rounded-lg border-gray-300"></textarea>

                            </div>

                        </div>

                    </div>

                    <div class="flex justify-end gap-3 mt-10">

                        <a href="{{ route('kader.index') }}"
                            class="px-5 py-2 rounded-lg bg-gray-200 hover:bg-gray-300">

                            Batal

                        </a>

                        <button
                            type="submit"
                            class="px-5 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white">

                            Simpan Data

                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>