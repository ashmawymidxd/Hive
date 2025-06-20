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
            return response()->view('admin.errors.403', [
                'message' => 'Unauthorized - Please login with proper credentials'
            ], 403);
        }

        $permissions = json_decode($admin->role->permissions ?? '[]', true);

        if (!in_array($permission, $permissions)) {
            return response()->view('admin.errors.403', [
                'message' => 'Unauthorized action - You don\'t have the required permission'
            ], 403);
        }

        return $next($request);
    }
}
