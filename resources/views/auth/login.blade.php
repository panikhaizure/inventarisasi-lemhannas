<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Notifikasi Error Login Umum -->
    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-50 border-l-4 border-red-500 rounded text-sm text-red-700">
            <p class="font-semibold">Gagal Masuk</p>
            <p class="text-xs">Email/Username atau password yang kamu masukkan salah.</p>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- 1. EMAIL / USERNAME -->
        <div>
            <x-input-label for="login_key" :value="__('Email / Username')" />
            <x-text-input id="login_key" class="block mt-1 w-full" type="text" name="login_key" :value="old('login_key')" required autofocus autocomplete="username" placeholder="Masukkan email atau username" />
            <x-input-error :messages="$errors->get('login_key')" class="mt-2" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

<!-- Password Field -->
<div class="mt-4">
    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>

    <!-- Wrapper Khusus Input + Icon (Sangat Spesifik) -->
    <div class="relative mt-1 block w-full">
        <input 
            id="password" 
            type="password" 
            name="password" 
            placeholder="Masukkan password" 
            required 
            autocomplete="current-password" 
            class="block w-full text-sm pl-3.5 pr-10 py-2.5 rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition"
        >

        <!-- Tombol Mata dengan Pengunci Tengah Vertikal Kuat -->
        <button 
            type="button" 
            onclick="togglePasswordVisibility()" 
            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none flex items-center justify-center p-1"
        >
            <!-- Icon Mata Terbuka -->
            <svg id="eye-open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 hidden">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12c.074-.154.195-.38.398-.679C3.93 8.84 7.218 6.75 12 6.75c4.782 0 8.07 2.09 9.566 4.571.203.299.324.525.398.679a.75.75 0 0 1 0 .842c-.074.154-.195.38-.398.679C20.07 15.16 16.782 17.25 12 17.25c-4.782 0-8.07-2.09-9.566-4.571a.75.75 0 0 1 0-.842Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>
            <!-- Icon Mata Coret -->
            <svg id="eye-closed" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
            </svg>
        </button>
    </div>

    <!-- Error ditaruh DILUAR div relative -->
    <x-input-error :messages="$errors->get('password')" class="mt-2" />
</div>

        <!-- 3. CHECKBOX INGATKAN SAYA -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input 
                    id="remember_me" 
                    type="checkbox" 
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 cursor-pointer" 
                    name="remember"
                >
                <span class="ms-2 text-sm text-gray-600 select-none">{{ __('Ingatkan Saya') }}</span>
            </label>
        </div>

        <!-- 4. BUTTON SUBMIT & DASHBOARD LINK -->
        <div class="flex items-center justify-between mt-6">
            <a href="/dashboard" class="text-sm text-gray-600 hover:text-indigo-600 flex items-center gap-1">
                ← Kembali ke Dashboard
            </a>

            <x-primary-button class="ms-3">
                {{ __('Log in Super Admin') }}
            </x-primary-button>
        </div>
    </form>

    <!-- 📍 DITARUH DI SINI: SCRIPT JAVASCRIPT TAMBAHAN -->
    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const eyeOpen = document.getElementById('eye-open');
            const eyeClosed = document.getElementById('eye-closed');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeOpen.classList.remove('hidden');
                eyeClosed.classList.add('hidden');
            } else {
                passwordInput.type = 'password';
                eyeOpen.classList.add('hidden');
                eyeClosed.classList.remove('hidden');
            }
        }
    </script>
</x-guest-layout>