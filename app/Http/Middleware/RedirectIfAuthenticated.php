<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next){

        if (auth('web')->check()){
            return redirect(RouteServiceProvider::WEBSITE);
        }

        if (auth('admin')->check()){
            return redirect(RouteServiceProvider::ADMIN);
        }

        return $next($request);
    }
}
