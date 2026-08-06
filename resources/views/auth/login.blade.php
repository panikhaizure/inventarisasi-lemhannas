<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Inventarisasi Lemhannas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .minimal-card {
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .minimal-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 40px -15px rgba(139, 92, 246, 0.15);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-purple-50/60 via-[#f4f7fe] to-indigo-50/40 text-gray-900 antialiased min-h-screen flex items-center justify-center p-4">

    <div class="minimal-card w-full max-w-md bg-white/95 backdrop-blur-md p-8 sm:p-10 rounded-[2.2rem] border border-purple-100 shadow-xl shadow-purple-900/5 space-y-6">
        
        <div class="text-center space-y-2.5">
            <div class="w-11 h-11 rounded-2xl bg-[#8B5CF6] text-white inline-flex items-center justify-center text-sm shadow-md shadow-purple-500/30 mb-2">
                <i class="fa-solid fa-cube"></i>
            </div>
            <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-gray-900">Masuk.</h1>
            <p class="text-xs text-gray-400 font-medium leading-relaxed">Panel Administrator Inventarisasi Lemhannas</p>
        </div>

        @if (session('status'))
            <div class="text-xs font-medium text-emerald-600 bg-emerald-50/50 p-3 rounded-xl border border-emerald-100">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="text-xs font-medium text-rose-600 bg-rose-50/50 p-3 rounded-xl border border-rose-100 space-y-1">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div class="space-y-1.5">
                <label for="email" class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                    class="w-full px-4 py-3 bg-gray-50/50 border border-purple-100 rounded-xl text-xs sm:text-sm text-gray-900 focus:outline-none focus:border-[#8B5CF6] focus:ring-2 focus:ring-[#8B5CF6]/20 focus:bg-white transition duration-200"
                    placeholder="nama@lemhannas.go.id">
            </div>

            <div class="space-y-1.5">
                <label for="password" class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider">Password</label>
                <div class="relative">
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        class="w-full px-4 py-3 pr-11 bg-gray-50/50 border border-purple-100 rounded-xl text-xs sm:text-sm text-gray-900 focus:outline-none focus:border-[#8B5CF6] focus:ring-2 focus:ring-[#8B5CF6]/20 focus:bg-white transition duration-200"
                        placeholder="masukan password">
                    <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-gray-400 hover:text-[#8B5CF6] text-xs transition">
                        <i id="eyeIcon" class="fa-solid fa-eye"></i>
                    </button>
                </div>
            </div>

            <div class="flex items-center justify-between text-xs pt-0.5">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="remember" id="remember_me" class="rounded border-purple-200 text-[#8B5CF6] focus:ring-[#8B5CF6] w-3.5 h-3.5">
                    <span class="text-gray-500 font-medium">Ingat Saya</span>
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-[#8B5CF6] hover:text-purple-700 font-medium transition">Lupa password?</a>
                @endif
            </div>

            <button type="submit" class="w-full py-3.5 px-4 bg-[#8B5CF6] hover:bg-purple-700 text-white font-semibold text-xs sm:text-sm tracking-wide rounded-xl shadow-md shadow-purple-500/25 transition duration-300 flex items-center justify-center gap-2 mt-2">
                <span>Masuk Sistem</span>
                <i class="fa-solid fa-arrow-right-long text-xs"></i>
            </button>
        </form>

        <div class="text-center pt-2.5 border-t border-purple-100/60">
            <a href="{{ url('/') }}" class="text-xs font-medium text-gray-400 hover:text-[#8B5CF6] transition flex items-center justify-center gap-1.5">
                <i class="fa-solid fa-arrow-left text-xs"></i> Kembali ke Dashboard
            </a>
        </div>

    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>