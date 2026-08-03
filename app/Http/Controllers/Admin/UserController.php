<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Halaman "Kelola Admin" — hanya bisa diakses Super Admin
     * (diproteksi lewat middleware role:super_admin di routes/web.php).
     */
    public function index()
    {
        // Hanya tampilkan user dengan role 'admin' (yang bisa dipromosikan)
        $admins = User::role('admin')->latest()->get();
        $superAdmins = User::role('super_admin')->latest()->get();

        return view('admin.user.index', compact('admins', 'superAdmins'));
    }

    /**
     * Promosikan seorang Admin menjadi Super Admin.
     * Satu arah saja — tidak ada fitur menurunkan kembali.
     */
    public function promosikan(User $user)
    {
        if (! $user->hasRole('admin')) {
            return back()->with('error', 'User ini bukan Admin biasa.');
        }

        $user->syncRoles(['super_admin']);

        return back()->with('success', "{$user->name} berhasil dipromosikan menjadi Super Admin.");
    }
}
