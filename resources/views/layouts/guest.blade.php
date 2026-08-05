<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Posyandu Tedunan') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts (Otomatis memuat Alpine.js) -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-900 antialiased">
        <div class="flex min-h-screen bg-white">
            
            <!-- KIRI: Form Login (Lebar persis 50% di layar besar) -->
            <div class="w-full lg:w-1/2 flex flex-col justify-center px-8 sm:px-24 xl:px-32 relative z-10">
                {{ $slot }}
                
                <!-- Footer -->
                <div class="mt-12 text-sm text-slate-400">
                    <p>❤ Sehat Balitaku, Bahagia Keluargaku</p>
                    <p>&copy; 2026 Posyandu Tedunan. All rights reserved.</p>
                </div>
            </div>

            <!-- KANAN: Foto (Lebar persis 50%) -->
            <div class="hidden lg:block lg:w-1/2 relative bg-cover bg-center" style="background-image: url('{{ asset('images/backgroundlogin.jpeg') }}');">
                <!-- Overlay warna biru tipis agar foto menyatu dengan warna aplikasi -->
                <div class="absolute inset-0 bg-sky-900/20 mix-blend-multiply"></div>
            </div>
            
        </div>
    </body>
</html>