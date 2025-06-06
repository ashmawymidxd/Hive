<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\Task;
use App\Models\Department;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class StaffController extends Controller
{
    /**
     * Display a listing of the staff members.
     */
    public function index()
    {
        $staff = Staff::with(['department', 'role'])
            ->orderBy('first_name')
            ->get();

        $departments = Department::all();
        $roles = Role::all();
        $staff = Staff::all();
        $tasks = Task::latest()->paginate(10);

        return view('admin.pages.staff.index', compact('staff', 'departments', 'roles','tasks'));
    }

    /**
     * Show the form for creating a new staff member.
     */
    public function create()
    {
        $departments = Department::all();
        $roles = Role::all();

        return view('admin.pages.staff.create', compact('departments', 'roles'));
    }

    /**
     * Store a newly created staff member in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:staff,email',
            'phone' => 'required|string|max:20',
            'department_id' => 'required|exists:departments,id',
            'role_id' => 'required|exists:roles,id',
            'hire_date' => 'required|date',
            'status' => ['required', Rule::in(['active', 'on_leave', 'terminated'])],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $staff = Staff::create($request->all());

        return redirect()->route('admin.staff.index')
            ->with('success', 'Staff member added successfully');
    }

    /**
     * Display the specified staff member.
     */
    public function show(Staff $staff)
    {
        $staff->load(['department', 'role', 'tasks']);

        return view('admin.pages.staff.show', compact('staff'));
    }

    /**
     * Show the form for editing the specified staff member.
     */
    public function edit(Staff $staff)
    {
        $departments = Department::all();
        $roles = Role::all();

        return view('admin.pages.staff.edit', compact('staff', 'departments', 'roles'));
    }

    /**
     * Update the specified staff member in storage.
     */

    public function update(Request $request, Staff $staff)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('staff')->ignore($staff->id),
            ],
            'phone' => 'required|string|max:20',
            'department_id' => 'required|exists:departments,id',
            'role_id' => 'required|exists:roles,id',
            'hire_date' => 'required|date',
            'status' => ['required', Rule::in(['active', 'on_leave', 'terminated'])],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $staff->update($request->all());

        return response()->json(['success' => 'Staff member updated successfully!']);
    }


    /**
     * Remove the specified staff member from storage.
     */
    public function destroy(Staff $staff)
    {

        $staff->delete();

        return response()->json(['success' => 'Staff member deleted successfully!']);
    }

}
