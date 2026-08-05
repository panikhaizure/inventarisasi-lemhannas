<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aplikasi;
use Illuminate\Http\Request;

class AplikasiController extends Controller
{
    // 1. LIHAT DATA DETAIL: Menampilkan tabel seluruh record aplikasi
    public function index()
    {
        $aplikasis = Aplikasi::with('user')->latest()->paginate(15);

        return view('admin.aplikasi.index', compact('aplikasis'));
    }

    // 2. INPUT DATA: Menampilkan form tambah aplikasi
    public function create()
    {
        return view('admin.aplikasi.create');
    }

    // PROSES INPUT DATA
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_aplikasi'     => 'required|string|max:255',
            'pic'               => 'required|string|max:255',
            'status'            => 'required|in:aktif,tidak_aktif,dalam_pengembangan',
            'uraian_singkat'    => 'nullable|string',
            'url'               => 'nullable|url|max:255',
            'alamat_ip'         => 'nullable|string|max:255',
            'jenis_akses'       => 'nullable|in:publik,internal',
            'platform_aplikasi' => 'nullable|string|max:255',
            'platform_database' => 'nullable|string|max:255',
            'bahasa_pemograman' => 'nullable|string|max:255',
            'framework'         => 'nullable|string|max:255',
            'os_server'         => 'nullable|string|max:255',
            'database_engine'   => 'nullable|string|max:255',
            'server'            => 'nullable|string|max:255',
            'web_server'        => 'nullable|string|max:255',
            'password_server'   => 'nullable|string|max:255',
        ]);

        // Otomatis memasukkan ID user yang sedang login
        $validated['user_id'] = $request->user()->id;

        Aplikasi::create($validated);

        return redirect()
            ->route('admin.aplikasi.index')
            ->with('success', 'Data aplikasi berhasil ditambahkan.');
    }

    // 3. EDIT DATA: Menampilkan form ubah data aplikasi
    public function edit(Aplikasi $aplikasi)
    {
        return view('admin.aplikasi.edit', compact('aplikasi'));
    }

    // PROSES EDIT DATA
    public function update(Request $request, Aplikasi $aplikasi)
    {
        $validated = $request->validate([
            'nama_aplikasi'     => 'required|string|max:255',
            'pic'               => 'required|string|max:255',
            'status'            => 'required|in:aktif,tidak_aktif,dalam_pengembangan',
            'uraian_singkat'    => 'nullable|string',
            'url'               => 'nullable|url|max:255',
            'alamat_ip'         => 'nullable|string|max:255',
            'jenis_akses'       => 'nullable|in:publik,internal',
            'platform_aplikasi' => 'nullable|string|max:255',
            'platform_database' => 'nullable|string|max:255',
            'bahasa_pemograman' => 'nullable|string|max:255',
            'framework'         => 'nullable|string|max:255',
            'os_server'         => 'nullable|string|max:255',
            'database_engine'   => 'nullable|string|max:255',
            'server'            => 'nullable|string|max:255',
            'web_server'        => 'nullable|string|max:255',
            'password_server'   => 'nullable|string|max:255',
        ]);

        $aplikasi->update($validated);

        return redirect()
            ->route('admin.aplikasi.index')
            ->with('success', 'Data aplikasi berhasil diperbarui.');
    }

    // 4. HAPUS DATA: Menghapus record aplikasi
    public function destroy(Aplikasi $aplikasi)
    {
        $aplikasi->delete();

        return redirect()
            ->route('admin.aplikasi.index')
            ->with('success', 'Data aplikasi berhasil dihapus.');
    }
}