<?php

namespace App\Http\Controllers;

use App\Models\Aplikasi;
use Illuminate\Support\Facades\DB;

class PimpinanController extends Controller
{
    /**
     * Halaman "Lihat Data" untuk Pimpinan — diakses tanpa login.
     * Route ini SENGAJA tidak diberi middleware 'auth'.
     */
    public function index()
    {
        $perStatus = Aplikasi::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();

        $perFramework = Aplikasi::select('framework', DB::raw('count(*) as total'))
            ->whereNotNull('framework')
            ->groupBy('framework')
            ->get();

        $perPic = Aplikasi::select('pic', DB::raw('count(*) as total'))
            ->groupBy('pic')
            ->get();

        // Tabel/daftar detail aplikasi (read-only, tanpa data sensitif seperti password_server)
        $daftarAplikasi = Aplikasi::select(
            'nama_aplikasi', 'pic', 'server', 'bahasa_pemograman', 'framework', 'status'
        )->latest()->get();

        return view('pimpinan.index', compact(
            'perStatus', 'perFramework', 'perPic', 'daftarAplikasi'
        ));
    }
}