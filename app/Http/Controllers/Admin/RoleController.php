<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
      /**
     * Display roles management.
     */
    public function roles()
    {
        $roles = Role::withCount('staff')->get();

        return view('admin.pages.staff.roles', compact('roles'));
    }

    /**
     * Store a new role.
     */
    public function storeRole(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:roles,name',
            'access_level' => ['required', Rule::in(['admin', 'manager', 'staff'])],
            'permissions' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Role::create([
            'name' => $request->name,
            'access_level' => $request->access_level,
            'permissions' => $request->permissions ? json_encode($request->permissions) : null,
        ]);

        return redirect()->back()
            ->with('success', 'Role created successfully');
    }

    /**
     * Update a role.
     */
    public function updateRole(Request $request, Role $role)
    {
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('roles')->ignore($role->id),
            ],
            'access_level' => ['required', Rule::in(['admin', 'manager', 'staff'])],
            'permissions' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $role->update([
            'name' => $request->name,
            'access_level' => $request->access_level,
            'permissions' => $request->permissions ? json_encode($request->permissions) : null,
        ]);

        return redirect()->back()
            ->with('success', 'Role updated successfully');
    }

    /**
     * Delete a role.
     */
    public function destroyRole(Role $role)
    {
        if ($role->staff()->count() > 0) {
            return redirect()->back()
                ->with('error', 'Cannot delete role that is assigned to staff members');
        }

        $role->delete();

        return redirect()->back()
            ->with('success', 'Role deleted successfully');
    }
}
