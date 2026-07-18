<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            if (!$user->is_active) {
                return back()->withErrors(['email' => 'Akun Anda dinonaktifkan.']);
            }
            session([
                'admin_logged_in' => true,
                'admin_name' => $user->name,
                'admin_user_id' => $user->id,
            ]);
            \Illuminate\Support\Facades\Auth::login($user);
            return redirect('/cms');
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    public function logout()
    {
        session()->forget(['admin_logged_in', 'admin_name', 'admin_user_id']);
        return redirect('/cms/login');
    }
}
