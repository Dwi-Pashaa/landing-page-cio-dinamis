<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\PageVisit;

class TrackPageVisit
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if ($request->isMethod('GET') && !$request->ajax() && !$request->is('cms*')) {
            PageVisit::create([
                'page' => $request->path() ?: '/',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'visited_at' => now(),
            ]);
        }

        return $response;
    }
}
