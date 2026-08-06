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
    <style>
        body { font-family: 'Poppins', sans-serif; }
        /* Smooth transition for interactive elements */
        .dashboard-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .dashboard-card:hover {
            transform: translateY(-6px) scale(1.01);
            box-shadow: 0 20px 30px -10px rgba(139, 92, 246, 0.15);
            border-color: rgba(139, 92, 246, 0.4);
        }
    </style>
</head>
<body class="bg-[#f8fafc] text-gray-800 antialiased min-h-screen flex flex-col bg-gradient-to-br from-purple-50/60 via-[#f4f7fe] to-indigo-50/40">

    <header class="bg-white/80 backdrop-blur-md border-b border-purple-100/80 px-8 py-4 flex items-center justify-between sticky top-0 z-30 shadow-sm">
        <div class="flex items-center gap-3">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-9 h-9 object-contain drop-shadow-sm">
            <span class="text-sm font-bold text-gray-800 tracking-wide">Dashboard Statistik Inventaris</span>
        </div>
        <div>
            @auth
                <a href="{{ route('admin.aplikasi.index') }}" class="text-xs font-semibold text-white bg-[#8B5CF6] hover:bg-purple-700 px-4.5 py-2.5 rounded-xl shadow-md shadow-purple-500/25 transition duration-300 flex items-center gap-1.5">
                    <i class="fa-solid fa-user-gear"></i> Panel Admin
                </a>
            @else
                <a href="{{ route('login') }}" class="text-xs font-semibold text-[#8B5CF6] hover:text-purple-800 flex items-center gap-1.5 bg-purple-50/80 hover:bg-purple-100 px-4 py-2 rounded-full transition duration-300 border border-purple-100">
                    <i class="fa-solid fa-right-to-bracket"></i> Login Super Admin
                </a>
            @endauth
        </div>
    </header>

    <main class="p-6 md:p-10 max-w-7xl mx-auto w-full space-y-10 flex-1">
        
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 bg-white/60 backdrop-blur-md p-6 rounded-3xl border border-purple-100/80 shadow-sm">
            <div>
                <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight">Dashboard Statistik</h1>
                <p class="text-xs md:text-sm text-gray-500 mt-1">Ringkasan infrastruktur, platform, dan status inventarisasi aplikasi secara real-time.</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-600 border border-emerald-200">
                    <span class="w-2 h-2 mr-1.5 bg-emerald-500 rounded-full animate-pulse"></span> Sistem Online
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <div class="dashboard-card bg-white/90 backdrop-blur-md p-6 rounded-3xl border border-purple-100 shadow-sm flex items-center justify-between cursor-pointer">
                <div>
                    <span class="text-3xl lg:text-4xl font-black text-[#8B5CF6] tracking-tight">{{ $totalAplikasi ?? 0 }}</span>
                    <p class="text-xs font-bold uppercase tracking-wider text-gray-400 mt-2">Total Aplikasi</p>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-purple-50 text-[#8B5CF6] flex items-center justify-center text-2xl shadow-inner">
                    <i class="fa-solid fa-cubes"></i>
                </div>
            </div>

            <div class="dashboard-card bg-white/90 backdrop-blur-md p-6 rounded-3xl border border-purple-100 shadow-sm flex items-center justify-between cursor-pointer">
                <div>
                    <span class="text-3xl lg:text-4xl font-black text-purple-600 tracking-tight">{{ $statusAktif ?? 0 }}</span>
                    <p class="text-xs font-bold uppercase tracking-wider text-purple-400 mt-2">Aplikasi Aktif</p>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center text-2xl shadow-inner">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
            </div>

            <div class="dashboard-card bg-white/90 backdrop-blur-md p-6 rounded-3xl border border-purple-100 shadow-sm flex items-center justify-between cursor-pointer">
                <div>
                    <span class="text-3xl lg:text-4xl font-black text-amber-500 tracking-tight">{{ $statusPengembangan ?? 0 }}</span>
                    <p class="text-xs font-bold uppercase tracking-wider text-amber-400 mt-2">Dalam Pengembangan</p>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-500 flex items-center justify-center text-2xl shadow-inner">
                    <i class="fa-solid fa-code-branch"></i>
                </div>
            </div>

            <div class="dashboard-card bg-white/90 backdrop-blur-md p-6 rounded-3xl border border-purple-100 shadow-sm flex items-center justify-between cursor-pointer">
                <div>
                    <span class="text-3xl lg:text-4xl font-black text-rose-500 tracking-tight">{{ $statusTidakAktif ?? 0 }}</span>
                    <p class="text-xs font-bold uppercase tracking-wider text-rose-400 mt-2">Tidak Aktif</p>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-rose-50 text-rose-500 flex items-center justify-center text-2xl shadow-inner">
                    <i class="fa-solid fa-circle-xmark"></i>
                </div>
            </div>

        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <div class="dashboard-card bg-white/90 backdrop-blur-md p-6 rounded-3xl border border-purple-100 shadow-sm flex flex-col justify-between">
                <h3 class="text-xs font-extrabold text-gray-700 uppercase tracking-widest mb-4 flex items-center gap-2.5">
                    <span class="w-7 h-7 rounded-lg bg-purple-100 text-[#8B5CF6] flex items-center justify-center text-xs"><i class="fa-solid fa-chart-pie"></i></span> Status Aplikasi
                </h3>
                <div class="relative h-60 flex items-center justify-center">
                    <canvas id="chartStatus"></canvas>
                </div>
            </div>

            <div class="dashboard-card bg-white/90 backdrop-blur-md p-6 rounded-3xl border border-purple-100 shadow-sm flex flex-col justify-between">
                <h3 class="text-xs font-extrabold text-gray-700 uppercase tracking-widest mb-4 flex items-center gap-2.5">
                    <span class="w-7 h-7 rounded-lg bg-purple-100 text-[#8B5CF6] flex items-center justify-center text-xs"><i class="fa-solid fa-network-wired"></i></span> Tipe Akses (Jaringan)
                </h3>
                <div class="relative h-60 flex items-center justify-center">
                    <canvas id="chartAkses"></canvas>
                </div>
            </div>

            <div class="dashboard-card bg-white/90 backdrop-blur-md p-6 rounded-3xl border border-purple-100 shadow-sm flex flex-col justify-between">
                <h3 class="text-xs font-extrabold text-gray-700 uppercase tracking-widest mb-4 flex items-center gap-2.5">
                    <span class="w-7 h-7 rounded-lg bg-purple-100 text-[#8B5CF6] flex items-center justify-center text-xs"><i class="fa-solid fa-laptop-code"></i></span> Platform Aplikasi
                </h3>
                <div class="relative h-60 flex items-center justify-center">
                    <canvas id="chartPlatformApp"></canvas>
                </div>
            </div>

        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            
            <div class="dashboard-card bg-white/90 backdrop-blur-md p-6 rounded-3xl border border-purple-100 shadow-sm">
                <h3 class="text-xs font-extrabold text-gray-700 uppercase tracking-widest mb-4 flex items-center gap-2.5">
                    <span class="w-7 h-7 rounded-lg bg-purple-100 text-[#8B5CF6] flex items-center justify-center text-xs"><i class="fa-solid fa-database"></i></span> Sebaran Platform Database
                </h3>
                <div class="relative h-64">
                    <canvas id="chartPlatformDb"></canvas>
                </div>
            </div>

            <div class="dashboard-card bg-white/90 backdrop-blur-md p-6 rounded-3xl border border-purple-100 shadow-sm">
                <h3 class="text-xs font-extrabold text-gray-700 uppercase tracking-widest mb-4 flex items-center gap-2.5">
                    <span class="w-7 h-7 rounded-lg bg-purple-100 text-[#8B5CF6] flex items-center justify-center text-xs"><i class="fa-solid fa-layer-group"></i></span> Framework & Stack
                </h3>
                <div class="relative h-64">
                    <canvas id="chartFramework"></canvas>
                </div>
            </div>

        </div>

    </main>

    <footer class="bg-white/80 backdrop-blur-md border-t border-purple-100/80 px-8 py-5 flex flex-col sm:flex-row justify-between items-center text-xs text-gray-500 gap-2">
        <div>Copyright © {{ date('Y') }} <strong class="text-gray-700">Admin Inventaris</strong>. All rights reserved.</div>
        <div class="flex items-center gap-3">
            <span>Lemhannas RI</span>
            <span>•</span>
            <span>Version 1.2.0</span>
        </div>
    </footer>

    <script>
        // 1. Chart Status Aplikasi
        new Chart(document.getElementById('chartStatus'), {
            type: 'doughnut',
            data: {
                labels: ['Aktif', 'Dalam Pengembangan', 'Tidak Aktif'],
                datasets: [{
                    data: [{{ $statusAktif ?? 0 }}, {{ $statusPengembangan ?? 0 }}, {{ $statusTidakAktif ?? 0 }}],
                    backgroundColor: ['#8B5CF6', '#F59E0B', '#F43F5E'],
                    borderWidth: 2,
                    borderColor: '#ffffff',
                    hoverOffset: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom', labels: { font: { family: 'Poppins', size: 11, weight: '500' }, padding: 15 } } }
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
                    borderWidth: 2,
                    borderColor: '#ffffff',
                    hoverOffset: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom', labels: { font: { family: 'Poppins', size: 11, weight: '500' }, padding: 15 } } }
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
                    borderRadius: 10,
                    borderSkipped: false,
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { 
                    x: { beginAtZero: true, ticks: { stepSize: 1, font: { family: 'Poppins' } }, grid: { color: '#f1f5f9' } },
                    y: { ticks: { font: { family: 'Poppins', weight: '500' } }, grid: { display: false } }
                }
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
                    borderRadius: 10,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { 
                    y: { beginAtZero: true, ticks: { stepSize: 1, font: { family: 'Poppins' } }, grid: { color: '#f1f5f9' } },
                    x: { ticks: { font: { family: 'Poppins', weight: '500' } }, grid: { display: false } }
                }
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
                    borderRadius: 10,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { 
                    y: { beginAtZero: true, ticks: { stepSize: 1, font: { family: 'Poppins' } }, grid: { color: '#f1f5f9' } },
                    x: { ticks: { font: { family: 'Poppins', weight: '500' } }, grid: { display: false } }
                }
            }
        });
    </script>
</body>
</html>