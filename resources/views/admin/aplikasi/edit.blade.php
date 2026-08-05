<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Aplikasi - Inventarisasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-[#f4f7fe] text-gray-800 antialiased min-h-screen p-6 md:p-10 bg-gradient-to-br from-purple-100/40 via-[#f4f7fe] to-white flex justify-center items-center">

    <div class="w-full max-w-4xl bg-white/80 backdrop-blur-md rounded-2xl border border-purple-100 shadow-xl p-8">
        
        <!-- Header Edit Form -->
        <div class="flex items-center justify-between pb-6 mb-6 border-b border-purple-100">
            <div>
                <h1 class="text-xl md:text-2xl font-extrabold text-gray-800 flex items-center gap-2">
                    <i class="fa-solid fa-pen-to-square text-[#8B5CF6]"></i> Edit Data Aplikasi
                </h1>
                <p class="text-xs text-gray-500 mt-1">Perbarui informasi rinci aplikasi inventaris di bawah ini.</p>
            </div>
            <a href="{{ route('admin.aplikasi.index') }}" class="text-xs font-semibold text-gray-500 hover:text-purple-600 flex items-center gap-1 bg-gray-100 px-3 py-2 rounded-xl transition">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>

        <!-- Form Edit Data -->
        <form action="{{ route('admin.aplikasi.update', $aplikasi->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- SECTION 1: INFORMASI UTAMA -->
            <div>
                <h2 class="text-xs font-bold text-purple-700 tracking-wider uppercase mb-3 flex items-center gap-1.5">
                    <i class="fa-solid fa-circle-info"></i> Informasi Utama
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Nama Aplikasi <span class="text-rose-500">*</span></label>
                        <input type="text" name="nama_aplikasi" value="{{ old('nama_aplikasi', $aplikasi->nama_aplikasi) }}" required class="w-full text-xs px-3.5 py-2.5 rounded-xl border border-purple-100 bg-white/70 focus:bg-white focus:outline-none focus:ring-2 focus:ring-purple-400/50 transition">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Person in Charge (PIC) <span class="text-rose-500">*</span></label>
                        <input type="text" name="pic" value="{{ old('pic', $aplikasi->pic) }}" required class="w-full text-xs px-3.5 py-2.5 rounded-xl border border-purple-100 bg-white/70 focus:bg-white focus:outline-none focus:ring-2 focus:ring-purple-400/50 transition">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Status Aplikasi <span class="text-rose-500">*</span></label>
                        <select name="status" required class="w-full text-xs px-3.5 py-2.5 rounded-xl border border-purple-100 bg-white/70 focus:bg-white focus:outline-none focus:ring-2 focus:ring-purple-400/50 transition">
                            <option value="aktif" {{ strtolower($aplikasi->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="dalam_pengembangan" {{ strtolower($aplikasi->status) == 'dalam_pengembangan' || strtolower($aplikasi->status) == 'pengembangan' ? 'selected' : '' }}>Dalam Pengembangan</option>
                            <option value="tidak_aktif" {{ strtolower($aplikasi->status) == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Alamat Aplikasi / URL</label>
                        <input type="url" name="url_aplikasi" placeholder="https://domain.go.id" value="{{ old('url_aplikasi', $aplikasi->url_aplikasi) }}" class="w-full text-xs px-3.5 py-2.5 rounded-xl border border-purple-100 bg-white/70 focus:bg-white focus:outline-none focus:ring-2 focus:ring-purple-400/50 transition">
                    </div>
                </div>

                <!-- Uraian Singkat -->
                <div class="mt-4">
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Uraian Singkat Aplikasi</label>
                    <textarea name="uraian_singkat" rows="3" placeholder="Jelaskan deskripsi dan fungsi singkat aplikasi..." class="w-full text-xs px-3.5 py-2.5 rounded-xl border border-purple-100 bg-white/70 focus:bg-white focus:outline-none focus:ring-2 focus:ring-purple-400/50 transition">{{ old('uraian_singkat', $aplikasi->uraian_singkat) }}</textarea>
                </div>
            </div>

            <hr class="border-purple-100">

            <!-- SECTION 2: INFRASTRUKTUR & JARINGAN -->
            <div>
                <h2 class="text-xs font-bold text-purple-700 tracking-wider uppercase mb-3 flex items-center gap-1.5">
                    <i class="fa-solid fa-server"></i> Infrastruktur & Jaringan
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Alamat IP</label>
                        <input type="text" name="alamat_ip" placeholder="192.168.1.100 / 10.x.x.x" value="{{ old('alamat_ip', $aplikasi->alamat_ip) }}" class="w-full text-xs px-3.5 py-2.5 rounded-xl border border-purple-100 bg-white/70 focus:bg-white focus:outline-none focus:ring-2 focus:ring-purple-400/50 transition">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Server / Nama Server</label>
                        <input type="text" name="server" value="{{ old('server', $aplikasi->server) }}" class="w-full text-xs px-3.5 py-2.5 rounded-xl border border-purple-100 bg-white/70 focus:bg-white focus:outline-none focus:ring-2 focus:ring-purple-400/50 transition">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Tipe Akses (Publik / Internal)</label>
                        <select name="jenis_akses" class="w-full text-xs px-3.5 py-2.5 rounded-xl border border-purple-100 bg-white/70 focus:bg-white focus:outline-none focus:ring-2 focus:ring-purple-400/50 transition">
                            <option value="internal" {{ strtolower($aplikasi->jenis_akses ?? 'internal') == 'internal' ? 'selected' : '' }}>IP Internal (Private)</option>
                            <option value="publik" {{ strtolower($aplikasi->jenis_akses ?? '') == 'publik' ? 'selected' : '' }}>Aplikasi Publik (Public)</option>
                        </select>
                    </div>
                </div>
            </div>

            <hr class="border-purple-100">

            <!-- SECTION 3: PLATFORM & TEKNOLOGI -->
            <div>
                <h2 class="text-xs font-bold text-purple-700 tracking-wider uppercase mb-3 flex items-center gap-1.5">
                    <i class="fa-solid fa-code"></i> Platform & Stack Teknologi
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Platform Aplikasi</label>
                        <input type="text" name="platform_aplikasi" placeholder="e.g., Web / Mobile / Desktop" value="{{ old('platform_aplikasi', $aplikasi->platform_aplikasi) }}" class="w-full text-xs px-3.5 py-2.5 rounded-xl border border-purple-100 bg-white/70 focus:bg-white focus:outline-none focus:ring-2 focus:ring-purple-400/50 transition">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Platform Database</label>
                        <input type="text" name="platform_database" placeholder="e.g., MySQL / PostgreSQL / Oracle" value="{{ old('platform_database', $aplikasi->platform_database) }}" class="w-full text-xs px-3.5 py-2.5 rounded-xl border border-purple-100 bg-white/70 focus:bg-white focus:outline-none focus:ring-2 focus:ring-purple-400/50 transition">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Bahasa Pemrograman</label>
                        <input type="text" name="bahasa_pemrograman" value="{{ old('bahasa_pemrograman', $aplikasi->bahasa_pemrograman) }}" class="w-full text-xs px-3.5 py-2.5 rounded-xl border border-purple-100 bg-white/70 focus:bg-white focus:outline-none focus:ring-2 focus:ring-purple-400/50 transition">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Framework</label>
                        <input type="text" name="framework" value="{{ old('framework', $aplikasi->framework) }}" class="w-full text-xs px-3.5 py-2.5 rounded-xl border border-purple-100 bg-white/70 focus:bg-white focus:outline-none focus:ring-2 focus:ring-purple-400/50 transition">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">OS Server</label>
                        <input type="text" name="os_server" value="{{ old('os_server', $aplikasi->os_server) }}" class="w-full text-xs px-3.5 py-2.5 rounded-xl border border-purple-100 bg-white/70 focus:bg-white focus:outline-none focus:ring-2 focus:ring-purple-400/50 transition">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Database Engine</label>
                        <input type="text" name="database_engine" value="{{ old('database_engine', $aplikasi->database_engine) }}" class="w-full text-xs px-3.5 py-2.5 rounded-xl border border-purple-100 bg-white/70 focus:bg-white focus:outline-none focus:ring-2 focus:ring-purple-400/50 transition">
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end gap-3 pt-4 border-t border-purple-100">
                <a href="{{ route('admin.aplikasi.index') }}" class="px-5 py-2.5 text-xs font-semibold text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 text-xs font-semibold text-white bg-[#8B5CF6] hover:bg-purple-700 rounded-xl shadow-md shadow-purple-500/20 transition">
                    <i class="fa-solid fa-floppy-disk mr-1"></i> Update Data
                </button>
            </div>
        </form>
    </div>

</body>
</html>