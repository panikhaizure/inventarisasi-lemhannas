<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Statistik - Inventaris Aplikasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans text-gray-800 antialiased flex h-screen overflow-hidden">



    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col h-screen overflow-y-auto">

        <!-- Top Header Navigation -->
        <header class="bg-white border-b border-gray-200 px-6 py-3.5 flex items-center justify-between sticky top-0 z-10 shadow-sm">
            <div class="flex items-center gap-4 text-gray-500">
                <i class="fa-solid fa-bars cursor-pointer hover:text-gray-700"></i>
                <span class="text-sm font-medium text-gray-600">Beranda</span>
            </div>
            <div>
                @auth
                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit" class="text-xs font-medium text-gray-600 hover:text-rose-600 flex items-center gap-1.5">
                        <i class="fa-solid fa-right-from-bracket"></i> Logout
                    </button>
                </form>
                @else
                <a href="/login" class="text-xs font-medium text-blue-600 hover:underline flex items-center gap-1.5">
                    <i class="fa-solid fa-right-to-bracket"></i> Login Super Admin
                </a>
                @endauth
            </div>
        </header>

        <!-- Body Dashboard Content -->
        <main class="p-6 space-y-6 flex-1">
            <h1 class="text-2xl font-bold text-gray-800">Dashboard Statistik</h1>

            <!-- 4 Cards Stat In Line -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Card 1: Total Aplikasi -->
                <div class="bg-cyan-600 text-white rounded-lg shadow overflow-hidden relative flex flex-col justify-between">
                    <div class="p-4">
                        <div class="text-3xl font-extrabold">{{ $totalAplikasi ?? 0 }}</div>
                        <div class="text-xs text-cyan-100 font-medium mt-1">Total Aplikasi</div>
                        <i class="fa-solid fa-boxes-stacked text-5xl absolute top-3 right-3 text-cyan-500/40"></i>
                    </div>
                    <a href="{{ Auth::check() ? '/admin/aplikasi' : '/login' }}" class="bg-cyan-700/60 hover:bg-cyan-700 py-1.5 px-4 text-xs text-center font-medium flex items-center justify-center gap-1">
                        Lihat Detail <i class="fa-solid fa-circle-arrow-right"></i>
                    </a>
                </div>

                <!-- Card 2: Aktif -->
                <div class="bg-emerald-600 text-white rounded-lg shadow overflow-hidden relative flex flex-col justify-between">
                    <div class="p-4">
                        <div class="text-3xl font-extrabold">{{ $statusData['aktif'] ?? 0 }}</div>
                        <div class="text-xs text-emerald-100 font-medium mt-1">Aplikasi Aktif</div>
                        <i class="fa-solid fa-circle-check text-5xl absolute top-3 right-3 text-emerald-500/40"></i>
                    </div>
                    <a href="{{ Auth::check() ? '/admin/aplikasi' : '/login' }}" class="bg-emerald-700/60 hover:bg-emerald-700 py-1.5 px-4 text-xs text-center font-medium flex items-center justify-center gap-1">
                        Lihat Detail <i class="fa-solid fa-circle-arrow-right"></i>
                    </a>
                </div>

                <!-- Card 3: Dalam Pengembangan -->
                <div class="bg-amber-500 text-white rounded-lg shadow overflow-hidden relative flex flex-col justify-between">
                    <div class="p-4">
                        <div class="text-3xl font-extrabold">{{ $statusData['dalam_pengembangan'] ?? 0 }}</div>
                        <div class="text-xs text-amber-100 font-medium mt-1">Dalam Pengembangan</div>
                        <i class="fa-solid fa-code-merge text-5xl absolute top-3 right-3 text-amber-400/40"></i>
                    </div>
                    <a href="{{ Auth::check() ? '/admin/aplikasi' : '/login' }}" class="bg-amber-600/60 hover:bg-amber-600 py-1.5 px-4 text-xs text-center font-medium flex items-center justify-center gap-1">
                        Lihat Detail <i class="fa-solid fa-circle-arrow-right"></i>
                    </a>
                </div>

                <!-- Card 4: Tidak Aktif -->
                <div class="bg-rose-600 text-white rounded-lg shadow overflow-hidden relative flex flex-col justify-between">
                    <div class="p-4">
                        <div class="text-3xl font-extrabold">{{ $statusData['tidak_aktif'] ?? 0 }}</div>
                        <div class="text-xs text-rose-100 font-medium mt-1">Tidak Aktif</div>
                        <i class="fa-solid fa-circle-xmark text-5xl absolute top-3 right-3 text-rose-500/40"></i>
                    </div>
                    <a href="{{ Auth::check() ? '/admin/aplikasi' : '/login' }}" class="bg-rose-700/60 hover:bg-rose-700 py-1.5 px-4 text-xs text-center font-medium flex items-center justify-center gap-1">
                        Lihat Detail <i class="fa-solid fa-circle-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 bg-white rounded-lg border border-gray-200 shadow-sm p-4">
                    <div class="flex items-center gap-2 border-b border-gray-100 pb-3 mb-4 text-sm font-semibold text-gray-700">
                        <i class="fa-solid fa-chart-pie text-blue-600"></i> Grafik Status Aplikasi
                    </div>
                    <div class="h-64 flex justify-center items-center">
                        <canvas id="statusChart"></canvas>
                    </div>
                </div>

                <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-4">
                    <div class="flex items-center gap-2 border-b border-gray-100 pb-3 mb-3 text-sm font-semibold text-gray-700">
                        <i class="fa-solid fa-clock text-blue-600"></i> Informasi Ringkas
                    </div>
                    <div class="space-y-2 text-xs">
                        <div class="p-3 bg-gray-50 border border-gray-100 rounded-lg flex justify-between items-center">
                            <span class="font-semibold text-gray-700">Total Record Sistem</span>
                            <span class="bg-blue-100 text-blue-700 font-bold px-2 py-0.5 rounded">{{ $totalAplikasi ?? 0 }} items</span>
                        </div>
                        <div class="p-3 bg-gray-50 border border-gray-100 rounded-lg flex justify-between items-center">
                            <span class="font-semibold text-gray-700">Status Database</span>
                            <span class="bg-emerald-100 text-emerald-700 font-bold px-2 py-0.5 rounded">SQLite Ready</span>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <footer class="bg-white border-t border-gray-200 px-6 py-3 flex justify-between text-xs text-gray-500">
            <div>Copyright © {{ date('Y') }} <strong>Admin Inventaris</strong>. All rights reserved.</div>
            <div>Version 1.0.0</div>
        </footer>
    </div>

    <script>
        const ctx = document.getElementById('statusChart').getContext('2d');
        const labels = {!! json_encode($labels ?? ['aktif', 'dalam_pengembangan', 'tidak_aktif']) !!};
        const data = {!! json_encode($totals ?? [0, 0, 0]) !!};

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels.map(l => l.replace('_', ' ').toUpperCase()),
                datasets: [{
                    data: data,
                    backgroundColor: ['#10B981', '#F59E0B', '#EF4444'],
                    borderWidth: 2,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                },
                cutout: '65%'
            }
        });
    </script>
</body>
</html>