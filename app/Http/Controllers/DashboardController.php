<?php

namespace App\Http\Controllers;

use App\Models\Aplikasi;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $statusData = Aplikasi::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        $labels = array_keys($statusData);
        $totals = array_values($statusData);
        $totalAplikasi = Aplikasi::count();

        return view('dashboard', compact('labels', 'totals', 'totalAplikasi', 'statusData'));
    }
}