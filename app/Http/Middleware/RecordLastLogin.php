<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RecordLastLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (auth('admin')->check()) {
            auth('admin')->user()->update([
                'last_login_at' => now(),
                'last_login_ip' => $request->ip(),
            ]);
        }

        return $next($request);
    }
}
