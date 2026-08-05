<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Inventarisasi Biro Telematika</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .swal2-popup-custom {
            border-radius: 1.25rem !important;
            padding: 1.5rem !important;
        }
    </style>
</head>
<body class="bg-[#f4f7fe] text-gray-800 antialiased flex h-screen overflow-hidden">

    <!-- Sidebar Admin (Tema Ungu Gelap Canva) -->
    <aside class="w-64 bg-slate-900 text-slate-300 flex flex-col justify-between h-screen shrink-0 border-r border-purple-900/20">
        <div>
            <!-- Header Sidebar -->
            <div class="flex items-center gap-3 px-5 py-4 border-b border-slate-800">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-9 h-9 object-contain">
                <div class="flex flex-col">
                    <span class="font-extrabold text-white text-sm leading-tight tracking-wider">APLIKASI</span>
                    <span class="font-extrabold text-white text-sm leading-tight tracking-wider">INVENTARIS</span>
                </div>
            </div>

            <!-- Profile Info Card -->
            <div class="p-4 mx-3 my-4 bg-slate-800/60 rounded-xl flex items-center gap-3 border border-slate-700/50">
                <div class="w-9 h-9 rounded-full bg-[#8B5CF6] flex items-center justify-center text-white font-bold text-sm shadow-md shadow-purple-500/30">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
                <div>
                    <h4 class="text-xs font-semibold text-white leading-tight">
                        {{ Auth::user()->username ?? Auth::user()->name ?? 'Super Admin' }}
                    </h4>
                    <span class="text-[10px] text-emerald-400 font-medium flex items-center gap-1 mt-0.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span> Admin Authenticated
                    </span>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="px-3 space-y-1 text-xs font-medium">
                <a href="{{ route('admin.aplikasi.index') }}" class="flex items-center gap-3 px-4 py-3 bg-[#8B5CF6] text-white rounded-xl font-semibold shadow-md shadow-purple-600/30 transition">
                    <i class="fa-solid fa-list-check w-4 text-center"></i> Data Detail
                </a>
                <a href="{{ route('admin.aplikasi.create') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-purple-300 transition">
                    <i class="fa-solid fa-square-plus w-4 text-center"></i> Input Data Baru
                </a>
            </nav>
        </div>

        <!-- Logout Button -->
        <div class="p-4 border-t border-slate-800">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-2.5 px-4 py-2.5 text-rose-400 hover:bg-rose-500/10 rounded-xl transition font-semibold text-xs">
                    <i class="fa-solid fa-power-off w-4 text-center"></i> Logout Admin
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col h-screen overflow-y-auto bg-gradient-to-br from-purple-100/40 via-[#f4f7fe] to-white">

        <!-- Header Navigation -->
        <header class="bg-white/80 backdrop-blur-md border-b border-purple-100/60 px-6 py-3.5 flex items-center justify-between sticky top-0 z-20 shadow-xs">
            <div class="flex items-center gap-4 text-gray-500">
                <i class="fa-solid fa-bars cursor-pointer hover:text-gray-700"></i>
                <span class="text-xs font-semibold text-gray-600">Dashboard Super Admin</span>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-xs font-semibold text-rose-600 hover:text-rose-700 flex items-center gap-1.5 p-1.5 px-3 rounded-full hover:bg-rose-50 transition">
                    <i class="fa-solid fa-right-from-bracket"></i> Keluar
                </button>
            </form>
        </header>

        <!-- Body Admin Content -->
        <main class="p-6 md:p-8 space-y-6 flex-1">
            
            <!-- Welcome Header -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white/80 backdrop-blur-md p-6 rounded-2xl border border-purple-100 shadow-sm">
                <div>
                    <h1 class="text-xl md:text-2xl font-extrabold text-gray-800 tracking-tight">Panel Kelola Data Aplikasi</h1>
                    <p class="text-xs text-gray-500 mt-1">Akses penuh untuk melihat, menambah, mengubah, dan menghapus inventaris aplikasi.</p>
                </div>
                
                <a href="{{ route('admin.aplikasi.create') }}" class="inline-flex items-center justify-center gap-2 bg-[#8B5CF6] hover:bg-purple-700 text-white font-semibold text-xs px-5 py-2.5 rounded-xl shadow-md shadow-purple-500/20 transition">
                    <i class="fa-solid fa-plus"></i> Input Data Baru
                </a>
            </div>

            <!-- Tabel Utama -->
            <div id="tabel-data" class="bg-white/80 backdrop-blur-md rounded-2xl border border-purple-100 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-purple-50 flex items-center justify-between bg-purple-50/20">
                    <h2 class="text-xs font-bold text-gray-800 flex items-center gap-2">
                        <i class="fa-solid fa-table-list text-[#8B5CF6]"></i> Detail Master Data Aplikasi
                    </h2>
                    <span class="text-xs bg-purple-100 text-purple-700 font-bold px-3 py-1 rounded-full">
                        Total: {{ $aplikasis->total() ?? count($aplikasis) }} Data
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs border-collapse">
                        <thead class="bg-purple-50/50 text-gray-500 uppercase font-bold text-[10px] tracking-wider border-b border-purple-100">
                            <tr>
                                <th class="py-3.5 px-4 w-12 text-center">No</th>
                                <th class="py-3.5 px-4">Nama Aplikasi</th>
                                <th class="py-3.5 px-4">PIC</th>
                                <th class="py-3.5 px-4">Server / IP</th>
                                <th class="py-3.5 px-4 text-center">Status</th>
                                <th class="py-3.5 px-4 text-center whitespace-nowrap w-36">Aksi Pengelolaan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-purple-50 text-gray-700">
                            @forelse($aplikasis as $index => $item)
                            <tr class="hover:bg-purple-50/30 transition">
                                <td class="py-3.5 px-4 text-center font-medium text-gray-500">{{ $aplikasis->firstItem() + $index }}</td>
                                <td class="py-3.5 px-4 font-bold text-gray-900">{{ $item->nama_aplikasi }}</td>
                                <td class="py-3.5 px-4 font-medium text-gray-600">{{ $item->pic }}</td>
                                <td class="py-3.5 px-4 text-gray-400 font-mono text-[11px]">{{ $item->alamat_ip ?? $item->server ?? '-' }}</td>
                                
                                <td class="py-3.5 px-4 text-center">
                                    @if(strtolower($item->status) == 'aktif')
                                        <span class="bg-[#DDD6FE] text-[#6D28D9] px-3 py-1 rounded-full font-bold uppercase text-[10px]">Aktif</span>
                                    @elseif(strtolower($item->status) == 'dalam_pengembangan' || strtolower($item->status) == 'pengembangan')
                                        <span class="bg-amber-100 text-amber-700 px-3 py-1 rounded-full font-bold uppercase text-[10px]">Pengembangan</span>
                                    @else
                                        <span class="bg-rose-100 text-rose-600 px-3 py-1 rounded-full font-bold uppercase text-[10px]">Tidak Aktif</span>
                                    @endif
                                </td>
                                
                                <!-- AKSI PENGELOLAAN (Compact Horizontal Icon Group) -->
                                <td class="py-3.5 px-4 text-center whitespace-nowrap">
                                    <div class="inline-flex items-center justify-center gap-1.5 bg-purple-50/60 p-1 rounded-xl border border-purple-100/80 shadow-2xs">
                                        
                                        <!-- Tombol Detail (Biru) -->
                                        <button type="button" 
                                                onclick='showDetail(@json($item))' 
                                                class="w-7 h-7 inline-flex items-center justify-center text-sky-600 hover:text-white hover:bg-sky-500 rounded-lg transition-all duration-200" 
                                                title="Lihat Detail">
                                            <i class="fa-solid fa-eye text-xs"></i>
                                        </button>

                                        <!-- Tombol Edit (Kuning/Oranye) -->
                                        <a href="{{ route('admin.aplikasi.edit', $item->id) }}" 
                                           class="w-7 h-7 inline-flex items-center justify-center text-amber-600 hover:text-white hover:bg-amber-500 rounded-lg transition-all duration-200" 
                                           title="Edit Data">
                                            <i class="fa-solid fa-pen-to-square text-xs"></i>
                                        </a>

                                        <!-- Tombol Hapus (Merah) -->
                                        <form action="{{ route('admin.aplikasi.destroy', $item->id) }}" method="POST" class="inline-block form-hapus">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" 
                                                    onclick="confirmDelete(this)" 
                                                    class="w-7 h-7 inline-flex items-center justify-center text-rose-600 hover:text-white hover:bg-rose-500 rounded-lg transition-all duration-200" 
                                                    title="Hapus Data">
                                                <i class="fa-solid fa-trash-can text-xs"></i>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="py-12 text-center text-gray-400">
                                    <i class="fa-solid fa-folder-open text-4xl mb-3 text-purple-200 block"></i>
                                    Belum ada data aplikasi tersimpan.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if(method_exists($aplikasis, 'links'))
                <div class="px-6 py-4 border-t border-purple-50">
                    {{ $aplikasis->links() }}
                </div>
                @endif
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-white/80 backdrop-blur-md border-t border-purple-100/60 px-6 py-3.5 flex justify-between text-xs text-gray-500">
            <div>Copyright © {{ date('Y') }} <strong>Admin Inventaris</strong>. All rights reserved.</div>
            <div>Version 1.2.0</div>
        </footer>
    </div>

    <!-- Script Pop-up SweetAlert2 Detail Aplikasi -->
    <script>
        function showDetail(item) {
            const content = `
                <div class="text-left space-y-4 text-xs font-sans text-gray-700 pt-2">
                    <div class="bg-purple-50/70 p-3.5 rounded-xl border border-purple-100">
                        <span class="text-[10px] font-bold text-purple-600 uppercase tracking-wider block mb-1">Uraian Singkat Aplikasi</span>
                        <p class="text-gray-800 font-medium">${item.uraian_singkat ?? 'Belum ada uraian singkat.'}</p>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div class="p-3 bg-gray-50 rounded-xl border border-gray-100">
                            <span class="text-[10px] font-bold text-gray-400 uppercase block">Alamat URL</span>
                            <span class="font-semibold text-purple-700 break-all">${item.url_aplikasi ?? item.url ?? '-'}</span>
                        </div>
                        <div class="p-3 bg-gray-50 rounded-xl border border-gray-100">
                            <span class="text-[10px] font-bold text-gray-400 uppercase block">Alamat IP</span>
                            <span class="font-semibold text-gray-800 font-mono">${item.alamat_ip ?? item.server ?? '-'}</span>
                        </div>
                        <div class="p-3 bg-gray-50 rounded-xl border border-gray-100">
                            <span class="text-[10px] font-bold text-gray-400 uppercase block">Jenis Akses</span>
                            <span class="font-semibold text-gray-800 uppercase">${item.jenis_akses ?? 'Internal'}</span>
                        </div>
                        <div class="p-3 bg-gray-50 rounded-xl border border-gray-100">
                            <span class="text-[10px] font-bold text-gray-400 uppercase block">Person in Charge (PIC)</span>
                            <span class="font-semibold text-gray-800">${item.pic ?? '-'}</span>
                        </div>
                        <div class="p-3 bg-gray-50 rounded-xl border border-gray-100">
                            <span class="text-[10px] font-bold text-gray-400 uppercase block">Platform Aplikasi</span>
                            <span class="font-semibold text-gray-800">${item.platform_aplikasi ?? '-'}</span>
                        </div>
                        <div class="p-3 bg-gray-50 rounded-xl border border-gray-100">
                            <span class="text-[10px] font-bold text-gray-400 uppercase block">Platform Database</span>
                            <span class="font-semibold text-gray-800">${item.platform_database ?? item.database_engine ?? '-'}</span>
                        </div>
                    </div>
                </div>
            `;

            Swal.fire({
                title: `<div class="text-left text-lg font-bold text-gray-800 flex items-center gap-2">
                            <i class="fa-solid fa-circle-info text-[#8B5CF6]"></i> Detail: ${item.nama_aplikasi}
                        </div>`,
                html: content,
                showCloseButton: true,
                confirmButtonColor: '#8B5CF6',
                confirmButtonText: 'Tutup',
                customClass: {
                    popup: 'swal2-popup-custom'
                },
                width: '600px'
            });
        }

        function confirmDelete(button) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data aplikasi ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#f43f5e',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Hapus Data!',
                cancelButtonText: 'Batal',
                customClass: {
                    popup: 'rounded-2xl'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    button.closest('form').submit();
                }
            });
        }
    </script>

    @if(session('success'))
    <script>
        Swal.fire({
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonColor: '#8B5CF6',
            confirmButtonText: 'OK',
            customClass: {
                popup: 'rounded-2xl'
            }
        });
    </script>
    @endif

</body>
</html>