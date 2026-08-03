<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aplikasi;
use Illuminate\Http\Request;

class AplikasiController extends Controller
{
    // Lihat Data Detail: daftar seluruh aplikasi
    public function index()
    {
        $aplikasis = Aplikasi::with('user')->latest()->paginate(15);

        return view('admin.aplikasi.index', compact('aplikasis'));
    }

    // Form Input Data
    public function create()
    {
        return view('admin.aplikasi.create');
    }

    // Proses Input Data
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_aplikasi' => 'required|string|max:255',
            'pic' => 'required|string|max:255',
            'server' => 'nullable|string|max:255',
            'bahasa_pemograman' => 'nullable|string|max:255',
            'framework' => 'nullable|string|max:255',
            'os_server' => 'nullable|string|max:255',
            'database_engine' => 'nullable|string|max:255',
            'web_server' => 'nullable|string|max:255',
            'password_server' => 'nullable|string|max:255',
            'status' => 'required|in:aktif,tidak_aktif,dalam_pengembangan',
        ]);

        $validated['user_id'] = $request->user()->id;

        Aplikasi::create($validated);

        return redirect()
            ->route('admin.aplikasi.index')
            ->with('success', 'Data aplikasi berhasil ditambahkan.');
    }

    // Form Edit Data
    public function edit(Aplikasi $aplikasi)
    {
        return view('admin.aplikasi.edit', compact('aplikasi'));
    }

    // Proses Edit Data
    public function update(Request $request, Aplikasi $aplikasi)
    {
        $validated = $request->validate([
            'nama_aplikasi' => 'required|string|max:255',
            'pic' => 'required|string|max:255',
            'server' => 'nullable|string|max:255',
            'bahasa_pemograman' => 'nullable|string|max:255',
            'framework' => 'nullable|string|max:255',
            'os_server' => 'nullable|string|max:255',
            'database_engine' => 'nullable|string|max:255',
            'web_server' => 'nullable|string|max:255',
            'password_server' => 'nullable|string|max:255',
            'status' => 'required|in:aktif,tidak_aktif,dalam_pengembangan',
        ]);

        $aplikasi->update($validated);

        return redirect()
            ->route('admin.aplikasi.index')
            ->with('success', 'Data aplikasi berhasil diperbarui.');
    }

    // Hapus Data
    public function destroy(Aplikasi $aplikasi)
    {
        $aplikasi->delete();

        return redirect()
            ->route('admin.aplikasi.index')
            ->with('success', 'Data aplikasi berhasil dihapus.');
    }
}