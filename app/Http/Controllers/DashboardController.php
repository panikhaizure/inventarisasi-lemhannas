<?php

namespace App\Http\Controllers;

use App\Models\Aplikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Total & Status Aplikasi
        $totalAplikasi = Aplikasi::count();
        $statusAktif = Aplikasi::whereRaw('LOWER(status) = ?', ['aktif'])->count();
        $statusPengembangan = Aplikasi::whereRaw('LOWER(status) LIKE ?', ['%pengembangan%'])->count();
        $statusTidakAktif = Aplikasi::whereRaw('LOWER(status) = ?', ['tidak_aktif'])->count();

        // 2. Statistik Tipe Akses (Publik vs Internal)
        $aksesInternal = Aplikasi::whereRaw('LOWER(jenis_akses) = ?', ['internal'])->orWhereNull('jenis_akses')->count();
        $aksesPublik = Aplikasi::whereRaw('LOWER(jenis_akses) = ?', ['publik'])->count();

        // 3. Statistik Platform Aplikasi (Web, Mobile, Desktop, dll)
        $platformApp = Aplikasi::select('platform_aplikasi', DB::raw('count(*) as total'))
            ->whereNotNull('platform_aplikasi')
            ->groupBy('platform_aplikasi')
            ->pluck('total', 'platform_aplikasi');

        // 4. Statistik Platform Database (MySQL, PostgreSQL, Oracle, dll)
        $platformDb = Aplikasi::select('platform_database', DB::raw('count(*) as total'))
            ->whereNotNull('platform_database')
            ->groupBy('platform_database')
            ->pluck('total', 'platform_database');

        // 5. Statistik Framework & Bahasa Pemrograman
        $frameworks = Aplikasi::select('framework', DB::raw('count(*) as total'))
            ->whereNotNull('framework')
            ->groupBy('framework')
            ->pluck('total', 'framework');

        return view('dashboard', compact(
            'totalAplikasi',
            'statusAktif',
            'statusPengembangan',
            'statusTidakAktif',
            'aksesInternal',
            'aksesPublik',
            'platformApp',
            'platformDb',
            'frameworks'
        ));
    }
}