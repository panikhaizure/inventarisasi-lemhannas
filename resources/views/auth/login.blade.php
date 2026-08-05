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

<!-- 2. PASSWORD (Ganti Total Pakai Input Biasa) -->
<div class="mt-4">
    <x-input-label for="password" :value="__('Password')" />

    <!-- KOTAK PEMBUNGKUS UTAMA (Input + Mata di dalamnya) -->
    <div class="mt-1 flex items-center w-full rounded-md border border-gray-300 bg-white shadow-sm focus-within:border-indigo-500 focus-within:ring-1 focus-within:ring-indigo-500">
        
        <!-- Input Password Murni (Tanpa Border Biar Mengikuti Kotak Utama) -->
        <input 
            id="password" 
            type="password" 
            name="password" 
            placeholder="Masukkan password" 
            required 
            autocomplete="current-password" 
            class="w-full border-0 focus:ring-0 focus:outline-none text-sm px-3 py-2 bg-transparent rounded-l-md"
            style="border: none !important; box-shadow: none !important;"
        />

        <!-- Tombol Mata Berada Dalam Baris yang Sama -->
        <button 
            type="button" 
            onclick="togglePasswordVisibility()" 
            class="px-3 text-gray-400 hover:text-gray-600 focus:outline-none flex items-center justify-center shrink-0"
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