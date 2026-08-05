<x-guest-layout>
    <!-- Header / Logo -->
    <div class="mb-10">
        <img src="{{ asset('images/logo.png') }}" alt="Logo Posyandu" class="w-24 h-auto mb-6">
        <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">Selamat Datang,</h2>
        <p class="text-slate-500 mt-2 text-base">Silakan masuk ke akun Anda untuk melanjutkan pendataan.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Username (Tanpa NIK) -->
        <div>
            <label for="username" class="block text-sm font-semibold text-slate-700">Username</label>
            <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus autocomplete="username"
                class="mt-2 block w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-3.5 text-sm focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all duration-200" 
                placeholder="Masukkan username Anda">
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Password dengan Fitur Mata (Alpine.js) -->
        <div x-data="{ showPassword: false }">
            <label for="password" class="block text-sm font-semibold text-slate-700">Password</label>
            <div class="relative mt-2">
                
                <!-- Input Password (tipe input berubah dinamis) -->
                <input id="password" :type="showPassword ? 'text' : 'password'" name="password" required autocomplete="current-password"
                    class="block w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-3.5 pr-12 text-sm focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all duration-200" 
                    placeholder="••••••••">
                
                <!-- Tombol Icon Mata -->
                <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400 hover:text-blue-600 focus:outline-none transition-colors">
                    
                    <!-- Icon Mata Tertutup -->
                    <svg x-show="!showPassword" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                    </svg>

                    <!-- Icon Mata Terbuka -->
                    <svg x-show="showPassword" style="display: none;" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>

                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between pt-1">
            <label for="remember_me" class="flex items-center cursor-pointer group">
                <input id="remember_me" type="checkbox" name="remember" class="rounded text-blue-600 focus:ring-blue-500 h-4 w-4 border-slate-300">
                <span class="ms-2 text-sm text-slate-600 group-hover:text-slate-900 transition-colors">Ingat saya</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm font-semibold text-blue-600 hover:text-blue-700 transition-colors" href="{{ route('password.request') }}">
                    Lupa password?
                </a>
            @endif
        </div>

        <!-- Tombol Masuk -->
        <div class="pt-2">
            <button type="submit" class="w-full flex justify-center items-center py-3.5 px-4 rounded-xl shadow-sm text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                Masuk
            </button>
        </div>
    </form>
</x-guest-layout>