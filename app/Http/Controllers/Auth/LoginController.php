<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'login_key' => 'required|string',
            'password'  => 'required|string',
        ]);

        // 2. Deteksi apakah input merupakan email atau username
        $loginType = filter_var($request->login_key, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // 3. Susun kredensial autentikasi
        $credentials = [
            $loginType => $request->login_key,
            'password' => $request->password,
        ];

        // 4. Coba proses login
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended('/admin/aplikasi');
        }

        // 5. Jika gagal, kembalikan error
        return back()->withErrors([
            'login_key' => 'Kredensial yang dimasukkan tidak cocok.',
        ])->onlyInput('login_key');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}