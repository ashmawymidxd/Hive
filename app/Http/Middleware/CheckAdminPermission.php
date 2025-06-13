<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class CheckAdminPermission
{
    public function handle(Request $request, Closure $next, $permission)
    {
        $admin = auth('admin')->user();

        if (!$admin || !$admin->role) {
            abort(403, 'Unauthorized');
        }

        $permissions = json_decode($admin->role->permissions ?? '[]', true);

        if (!in_array($permission, $permissions)) {
            abort(403, 'Unauthorized action');
        }

        return $next($request);
    }
}
