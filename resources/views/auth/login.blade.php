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

        <!-- Email / Username Address -->
        <div>
            <x-input-label for="login_key" :value="__('Email / Username')" />
            <x-text-input id="login_key" class="block mt-1 w-full" type="text" name="login_key" :value="old('login_key')" required autofocus autocomplete="username" placeholder="Masukkan email atau username" />
            <x-input-error :messages="$errors->get('login_key')" class="mt-2" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password"
                            placeholder="••••••••" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-6">
            <a href="/dashboard" class="text-sm text-gray-600 hover:text-indigo-600 flex items-center gap-1">
                ← Kembali ke Dashboard
            </a>

            <x-primary-button class="ms-3">
                {{ __('Log in Super Admin') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>