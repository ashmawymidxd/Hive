<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminStatus
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated and is an admin
        if (Auth::guard('admin')->check()) {
            $admin = Auth::guard('admin')->user();

            // Check admin status
            if ($admin->status === 'terminated') {
                Auth::guard('admin')->logout(); // Force logout
                return redirect()->route('login-admin')
                    ->withErrors(['account' => 'Your account has been terminated.']);
            }

            if ($admin->status === 'inactive') {
                Auth::guard('admin')->logout(); // Force logout
                return redirect()->route('login-admin')
                    ->withErrors(['account' => 'Your account is inactive.']);
            }
        }

        return $next($request);
    }
}
