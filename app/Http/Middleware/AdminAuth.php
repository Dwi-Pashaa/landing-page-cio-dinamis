<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect('/cms/login');
        }

        $user = User::find(session('admin_user_id'));
        if (!$user || !$user->is_active) {
            session()->forget(['admin_logged_in', 'admin_name', 'admin_user_id']);
            return redirect('/cms/login');
        }

        Auth::login($user);

        return $next($request);
    }
}
