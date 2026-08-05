<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Statistik - Inventarisasi Lemhannas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-[#f4f7fe] text-gray-800 antialiased min-h-screen flex flex-col bg-gradient-to-br from-purple-100/40 via-[#f4f7fe] to-white">

    <!-- Header Navigation -->
    <header class="bg-white/80 backdrop-blur-md border-b border-purple-100/60 px-8 py-4 flex items-center justify-between sticky top-0 z-20 shadow-xs">
        <div class="flex items-center gap-3">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-8 h-8 object-contain">
            <span class="text-sm font-bold text-gray-800 tracking-wide">Dashboard Statistik Inventaris</span>
        </div>
        <div>
            @auth
                <a href="{{ route('admin.aplikasi.index') }}" class="text-xs font-semibold text-white bg-[#8B5CF6] hover:bg-purple-700 px-4 py-2 rounded-xl shadow-md shadow-purple-500/20 transition">
                    <i class="fa-solid fa-user-gear mr-1"></i> Panel Admin
                </a>
            @else
                <a href="{{ route('login') }}" class="text-xs font-semibold text-[#8B5CF6] hover:text-purple-800 flex items-center gap-1.5 bg-purple-50 px-3.5 py-2 rounded-full transition">
                    <i class="fa-solid fa-right-to-bracket"></i> Login Super Admin
                </a>
            @endauth
        </div>
    </header>

    <!-- Main Content -->
    <main class="p-6 md:p-10 max-w-7xl mx-auto w-full space-y-8 flex-1">
        
        <div>
            <h1 class="text-2xl font-extrabold text-gray-800">Dashboard Statistik</h1>
            <p class="text-xs text-gray-500 mt-1">Ringkasan infrastruktur, platform, dan status inventarisasi aplikasi.</p>
        </div>

        <!-- Metric Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <div class="bg-white/80 backdrop-blur-md p-5 rounded-2xl border border-purple-100 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-3xl font-extrabold text-[#8B5CF6]">{{ $totalAplikasi ?? 0 }}</span>
                    <p class="text-xs font-semibold text-gray-400 mt-1">Total Aplikasi</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-purple-50 text-[#8B5CF6] flex items-center justify-center text-xl">
                    <i class="fa-solid fa-cubes"></i>
                </div>
            </div>

            <div class="bg-white/80 backdrop-blur-md p-5 rounded-2xl border border-purple-100 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-3xl font-extrabold text-purple-600">{{ $statusAktif ?? 0 }}</span>
                    <p class="text-xs font-semibold text-purple-400 mt-1">Aplikasi Aktif</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-xl">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
            </div>

            <div class="bg-white/80 backdrop-blur-md p-5 rounded-2xl border border-purple-100 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-3xl font-extrabold text-amber-500">{{ $statusPengembangan ?? 0 }}</span>
                    <p class="text-xs font-semibold text-amber-400 mt-1">Dalam Pengembangan</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-500 flex items-center justify-center text-xl">
                    <i class="fa-solid fa-code-branch"></i>
                </div>
            </div>

            <div class="bg-white/80 backdrop-blur-md p-5 rounded-2xl border border-purple-100 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-3xl font-extrabold text-rose-500">{{ $statusTidakAktif ?? 0 }}</span>
                    <p class="text-xs font-semibold text-rose-400 mt-1">Tidak Aktif</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-rose-50 text-rose-500 flex items-center justify-center text-xl">
                    <i class="fa-solid fa-circle-xmark"></i>
                </div>
            </div>
        </div>

        <!-- Charts Grid Section 1 -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- Chart 1: Status Aplikasi (Doughnut) -->
            <div class="bg-white/80 backdrop-blur-md p-6 rounded-2xl border border-purple-100 shadow-sm flex flex-col justify-between">
                <h3 class="text-xs font-bold text-gray-700 uppercase tracking-wider mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-chart-pie text-[#8B5CF6]"></i> Status Aplikasi
                </h3>
                <div class="relative h-56 flex items-center justify-center">
                    <canvas id="chartStatus"></canvas>
                </div>
            </div>

            <!-- Chart 2: Tipe Akses (Bar/Pie) -->
            <div class="bg-white/80 backdrop-blur-md p-6 rounded-2xl border border-purple-100 shadow-sm flex flex-col justify-between">
                <h3 class="text-xs font-bold text-gray-700 uppercase tracking-wider mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-[#8B5CF6] fa-network-wired text-[#8B5CF6]"></i> Tipe Akses (Jaringan)
                </h3>
                <div class="relative h-56 flex items-center justify-center">
                    <canvas id="chartAkses"></canvas>
                </div>
            </div>

            <!-- Chart 3: Platform Aplikasi (Bar Horizontal) -->
            <div class="bg-white/80 backdrop-blur-md p-6 rounded-2xl border border-purple-100 shadow-sm flex flex-col justify-between">
                <h3 class="text-xs font-bold text-gray-700 uppercase tracking-wider mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-laptop-code text-[#8B5CF6]"></i> Platform Aplikasi
                </h3>
                <div class="relative h-56 flex items-center justify-center">
                    <canvas id="chartPlatformApp"></canvas>
                </div>
            </div>

        </div>

        <!-- Charts Grid Section 2 -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            
            <!-- Chart 4: Platform Database -->
            <div class="bg-white/80 backdrop-blur-md p-6 rounded-2xl border border-purple-100 shadow-sm">
                <h3 class="text-xs font-bold text-gray-700 uppercase tracking-wider mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-database text-[#8B5CF6]"></i> Sebaran Platform Database
                </h3>
                <div class="relative h-60">
                    <canvas id="chartPlatformDb"></canvas>
                </div>
            </div>

            <!-- Chart 5: Framework Stack -->
            <div class="bg-white/80 backdrop-blur-md p-6 rounded-2xl border border-purple-100 shadow-sm">
                <h3 class="text-xs font-bold text-gray-700 uppercase tracking-wider mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-layer-group text-[#8B5CF6]"></i> Framework & Stack
                </h3>
                <div class="relative h-60">
                    <canvas id="chartFramework"></canvas>
                </div>
            </div>

        </div>

    </main>

    <!-- Footer -->
    <footer class="bg-white/80 backdrop-blur-md border-t border-purple-100/60 px-8 py-4 flex justify-between text-xs text-gray-500">
        <div>Copyright © {{ date('Y') }} <strong>Admin Inventaris</strong>. All rights reserved.</div>
        <div>Version 1.2.0</div>
    </footer>

    <!-- Chart.js Integration Script -->
    <script>
        const purplePalette = ['#8B5CF6', '#A78BFA', '#C4B5FD', '#DDD6FE', '#F43F5E', '#F59E0B', '#10B981', '#06B6D4'];

        // 1. Chart Status Aplikasi
        new Chart(document.getElementById('chartStatus'), {
            type: 'doughnut',
            data: {
                labels: ['Aktif', 'Dalam Pengembangan', 'Tidak Aktif'],
                datasets: [{
                    data: [{{ $statusAktif ?? 0 }}, {{ $statusPengembangan ?? 0 }}, {{ $statusTidakAktif ?? 0 }}],
                    backgroundColor: ['#8B5CF6', '#F59E0B', '#F43F5E'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom', labels: { font: { family: 'Poppins', size: 10 } } } }
            }
        });

        // 2. Chart Tipe Akses
        new Chart(document.getElementById('chartAkses'), {
            type: 'pie',
            data: {
                labels: ['IP Internal (Private)', 'Aplikasi Publik'],
                datasets: [{
                    data: [{{ $aksesInternal ?? 0 }}, {{ $aksesPublik ?? 0 }}],
                    backgroundColor: ['#8B5CF6', '#06B6D4'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom', labels: { font: { family: 'Poppins', size: 10 } } } }
            }
        });

        // 3. Chart Platform Aplikasi
        new Chart(document.getElementById('chartPlatformApp'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($platformApp->keys() ?? []) !!},
                datasets: [{
                    label: 'Jumlah Aplikasi',
                    data: {!! json_encode($platformApp->values() ?? []) !!},
                    backgroundColor: '#A78BFA',
                    borderRadius: 8
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { x: { beginAtZero: true, ticks: { stepSize: 1 } } }
            }
        });

        // 4. Chart Platform Database
        new Chart(document.getElementById('chartPlatformDb'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($platformDb->keys() ?? []) !!},
                datasets: [{
                    label: 'Jumlah Database',
                    data: {!! json_encode($platformDb->values() ?? []) !!},
                    backgroundColor: '#8B5CF6',
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
            }
        });

        // 5. Chart Framework
        new Chart(document.getElementById('chartFramework'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($frameworks->keys() ?? []) !!},
                datasets: [{
                    label: 'Jumlah',
                    data: {!! json_encode($frameworks->values() ?? []) !!},
                    backgroundColor: '#06B6D4',
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
            }
        });
    </script>
</body>
</html>