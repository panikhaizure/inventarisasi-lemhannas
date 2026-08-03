<x-app-layout>
    <div class="py-6 px-4 max-w-5xl mx-auto">
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <h2 class="text-xl font-bold mb-6 text-gray-800 border-b pb-3">Edit Data Aplikasi</h2>

            <form action="{{ route('admin.aplikasi.update', $aplikasi->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <!-- Nama Aplikasi -->
                    <div>
                        <label for="nama_aplikasi" class="block text-sm font-medium text-gray-700 mb-1">Nama Aplikasi <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_aplikasi" id="nama_aplikasi" value="{{ old('nama_aplikasi', $aplikasi->nama_aplikasi) }}" required
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        @error('nama_aplikasi')
                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- PIC -->
                    <div>
                        <label for="pic" class="block text-sm font-medium text-gray-700 mb-1">Person in Charge (PIC) <span class="text-red-500">*</span></label>
                        <input type="text" name="pic" id="pic" value="{{ old('pic', $aplikasi->pic) }}" required
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        @error('pic')
                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status Aplikasi <span class="text-red-500">*</span></label>
                        <select name="status" id="status" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                            <option value="aktif" {{ old('status', $aplikasi->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="tidak_aktif" {{ old('status', $aplikasi->status) == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                            <option value="dalam_pengembangan" {{ old('status', $aplikasi->status) == 'dalam_pengembangan' ? 'selected' : '' }}>Dalam Pengembangan</option>
                        </select>
                        @error('status')
                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Server -->
                    <div>
                        <label for="server" class="block text-sm font-medium text-gray-700 mb-1">Server / IP</label>
                        <input type="text" name="server" id="server" value="{{ old('server', $aplikasi->server) }}"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                    </div>

                    <!-- Bahasa Pemrograman -->
                    <div>
                        <label for="bahasa_pemograman" class="block text-sm font-medium text-gray-700 mb-1">Bahasa Pemrograman</label>
                        <input type="text" name="bahasa_pemograman" id="bahasa_pemograman" value="{{ old('bahasa_pemograman', $aplikasi->bahasa_pemograman) }}"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                    </div>

                    <!-- Framework -->
                    <div>
                        <label for="framework" class="block text-sm font-medium text-gray-700 mb-1">Framework</label>
                        <input type="text" name="framework" id="framework" value="{{ old('framework', $aplikasi->framework) }}"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                    </div>

                    <!-- OS Server -->
                    <div>
                        <label for="os_server" class="block text-sm font-medium text-gray-700 mb-1">OS Server</label>
                        <input type="text" name="os_server" id="os_server" value="{{ old('os_server', $aplikasi->os_server) }}"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                    </div>

                    <!-- Database Engine -->
                    <div>
                        <label for="database_engine" class="block text-sm font-medium text-gray-700 mb-1">Database Engine</label>
                        <input type="text" name="database_engine" id="database_engine" value="{{ old('database_engine', $aplikasi->database_engine) }}"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                    </div>

                    <!-- Web Server -->
                    <div>
                        <label for="web_server" class="block text-sm font-medium text-gray-700 mb-1">Web Server</label>
                        <input type="text" name="web_server" id="web_server" value="{{ old('web_server', $aplikasi->web_server) }}"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                    </div>

                    <!-- Password Server -->
                    <div>
                        <label for="password_server" class="block text-sm font-medium text-gray-700 mb-1">Password Server</label>
                        <input type="text" name="password_server" id="password_server" value="{{ old('password_server', $aplikasi->password_server) }}"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-end gap-3 mt-6 pt-4 border-t">
                    <a href="{{ route('admin.aplikasi.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 text-sm font-medium">
                        Batal
                    </a>
                    <button type="submit" class="px-5 py-2 bg-yellow-600 text-white rounded-md hover:bg-yellow-700 text-sm font-medium">
                        Update Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>