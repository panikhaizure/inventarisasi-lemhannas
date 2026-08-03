<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Inventarisasi Biro Telematika</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100 font-sans text-gray-800 antialiased flex h-screen overflow-hidden">

    <!-- Sidebar Admin -->
    <aside class="w-64 bg-slate-900 text-slate-300 flex flex-col justify-between h-screen shrink-0">
        <div>
  <!-- Container Header Sidebar -->
<div class="flex items-center gap-3 px-4 py-3">
    <!-- Tag Logo -->
    <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-10 h-10 object-contain">
    
    <!-- Teks Judul -->
    <div class="flex flex-col">
        <span class="font-bold text-white text-sm leading-tight">APLIKASI</span>
        <span class="font-bold text-white text-sm leading-tight">INVENTARIS</span>
    </div>
</div>

            <!-- Profile Info -->
            <div class="px-6 py-4 flex items-center gap-3 border-b border-slate-800/60 bg-blue-950/30">
                <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
                <div>
                    <h4 class="text-sm font-semibold text-white leading-tight">
                        {{ Auth::user()->username ?? Auth::user()->name ?? 'Super Admin' }}
                    </h4>
                    <span class="text-xs text-emerald-400 font-medium">
                        ● Admin Authenticated
                    </span>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="p-4 space-y-1 text-sm">
                <a href="{{ route('admin.aplikasi.index') }}" class="flex items-center gap-3 px-4 py-2 hover:bg-slate-800 rounded-lg text-slate-400 hover:text-white transition">
                    <i class="fa-solid fa-chart-line w-5"></i> Dashboard Admin
                </a>

                <div class="pt-4 pb-1 px-4 text-xs font-semibold text-slate-500 tracking-wider uppercase">Menu Utama Admin</div>
                
                <a href="{{ route('admin.aplikasi.index') }}" class="flex items-center gap-3 px-4 py-2.5 bg-blue-600 text-white rounded-lg font-medium shadow-sm">
                    <i class="fa-solid fa-list-check w-5"></i> Data Detail
                </a>
                <a href="{{ route('admin.aplikasi.create') }}" class="flex items-center gap-3 px-4 py-2 hover:bg-slate-800 rounded-lg text-slate-400 hover:text-white transition">
                    <i class="fa-solid fa-square-plus w-5"></i> Input Data Baru
                </a>
            </nav>
        </div>

        <!-- Sidebar Footer / Logout Button -->
        <div class="p-4 border-t border-slate-800">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-2 text-rose-400 hover:bg-rose-500/10 rounded-lg transition font-medium text-sm">
                    <i class="fa-solid fa-power-off w-5"></i> Logout Admin
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col h-screen overflow-y-auto">

        <!-- Top Header Navigation -->
        <header class="bg-white border-b border-gray-200 px-6 py-3.5 flex items-center justify-between sticky top-0 z-10 shadow-sm">
            <div class="flex items-center gap-4 text-gray-500">
                <i class="fa-solid fa-bars"></i>
                <span class="text-sm font-medium text-gray-600">Dashboard Super Admin</span>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-xs font-medium text-rose-600 hover:underline flex items-center gap-1.5">
                    <i class="fa-solid fa-right-from-bracket"></i> Keluar
                </button>
            </form>
        </header>

        <!-- Body Admin Content -->
        <main class="p-6 space-y-6 flex-1">
            
            <!-- Welcome Header & Quick Action -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-5 rounded-lg border border-gray-200 shadow-sm">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Panel Kelola Data Aplikasi</h1>
                    <p class="text-xs text-gray-500 mt-1">Akses penuh untuk melihat, menambah, mengubah, dan menghapus inventaris aplikasi.</p>
                </div>
                
                <!-- MENU 1: INPUT DATA -->
                <a href="{{ route('admin.aplikasi.create') }}" class="inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm px-4 py-2.5 rounded-lg shadow transition">
                    <i class="fa-solid fa-plus"></i> Input Data Baru
                </a>
            </div>

            <!-- MENU 2: LIHAT DATA DETAIL (Tabel Utama) -->
            <div id="tabel-data" class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between bg-gray-50/50">
                    <h2 class="text-base font-bold text-gray-800 flex items-center gap-2">
                        <i class="fa-solid fa-table-list text-blue-600"></i> Detail Master Data Aplikasi
                    </h2>
                    <span class="text-xs bg-blue-100 text-blue-700 font-semibold px-2.5 py-1 rounded-full">
                        Total: {{ $aplikasis->total() ?? count($aplikasis) }} Data
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs border-collapse">
                        <thead class="bg-gray-100/80 text-gray-700 uppercase font-bold border-b border-gray-200">
                            <tr>
                                <th class="py-3 px-4 w-12 text-center">No</th>
                                <th class="py-3 px-4">Nama Aplikasi</th>
                                <th class="py-3 px-4">PIC</th>
                                <th class="py-3 px-4">Server / IP</th>
                                <th class="py-3 px-4 text-center">Status</th>
                                <th class="py-3 px-4 text-center w-48">Aksi Pengelolaan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 text-gray-700">
                            @forelse($aplikasis as $index => $item)
                            <tr class="hover:bg-gray-50/80 transition">
                                <td class="py-3 px-4 text-center font-medium">{{ $aplikasis->firstItem() + $index }}</td>
                                <td class="py-3 px-4 font-bold text-gray-900">{{ $item->nama_aplikasi }}</td>
                                <td class="py-3 px-4 font-medium text-gray-700">{{ $item->pic }}</td>
                                <td class="py-3 px-4 text-gray-500">{{ $item->server ?? '-' }}</td>
                                <td class="py-3 px-4 text-center">
                                    @if($item->status == 'aktif')
                                        <span class="bg-emerald-100 text-emerald-700 px-2.5 py-0.5 rounded-full font-bold uppercase text-[10px]">Aktif</span>
                                    @elseif($item->status == 'dalam_pengembangan')
                                        <span class="bg-amber-100 text-amber-700 px-2.5 py-0.5 rounded-full font-bold uppercase text-[10px]">Pengembangan</span>
                                    @else
                                        <span class="bg-rose-100 text-rose-700 px-2.5 py-0.5 rounded-full font-bold uppercase text-[10px]">Tidak Aktif</span>
                                    @endif
                                </td>
                                
                                <!-- MENU 3 & 4: EDIT DATA & HAPUS DATA -->
                                <td class="py-3 px-4 text-center space-x-1">
                                    <!-- Edit Button -->
                                    <a href="{{ route('admin.aplikasi.edit', $item->id) }}" class="inline-flex items-center gap-1 bg-amber-500 hover:bg-amber-600 text-white px-2.5 py-1.5 rounded font-medium shadow-xs transition" title="Edit Data">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </a>

                                    <!-- Hapus Button -->
                                    <form action="{{ route('admin.aplikasi.destroy', $item->id) }}" method="POST" class="inline-block form-hapus">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete(this)" class="inline-flex items-center gap-1 bg-rose-600 hover:bg-rose-700 text-white px-2.5 py-1.5 rounded font-medium shadow-xs transition" title="Hapus Data">
                                            <i class="fa-solid fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="py-8 text-center text-gray-400">
                                    <i class="fa-solid fa-folder-open text-3xl mb-2 block"></i>
                                    Belum ada data aplikasi tersimpan. Klik tombol <strong>Input Data Baru</strong> di atas.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Links -->
                @if(method_exists($aplikasis, 'links'))
                <div class="px-6 py-3 border-t border-gray-200">
                    {{ $aplikasis->links() }}
                </div>
                @endif
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-gray-200 px-6 py-3 flex justify-between text-xs text-gray-500">
            <div>Copyright © {{ date('Y') }} <strong>Admin Inventaris</strong>. All rights reserved.</div>
            <div>Version 1.0.0</div>
        </footer>
    </div>

    <!-- Script SweetAlert Konfirmasi Hapus Data -->
    <script>
        function confirmDelete(button) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data aplikasi ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e11d48',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Hapus Data!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    button.closest('form').submit();
                }
            });
        }
    </script>

    <!-- Script Notifikasi Post-Action (Create / Update / Delete) -->
    @if(session('success'))
    <script>
       Swal.fire({
    title: 'Berhasil!',
    text: "{{ session('success') }}",
    icon: 'success',
    confirmButtonColor: '#2563eb',
    confirmButtonText: 'OK'

        }).then((result) => {
            if (!result.isConfirmed) {
                const logoutForm = document.createElement('form');
                logoutForm.method = 'POST';
                logoutForm.action = "{{ route('logout') }}";
                
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = '{{ csrf_token() }}';
                
                logoutForm.appendChild(csrfInput);
                document.body.appendChild(logoutForm);
                logoutForm.submit();
            }
        });
    </script>
    @endif

</body>
</html>