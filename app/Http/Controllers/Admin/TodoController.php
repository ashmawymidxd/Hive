<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TodoItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $todos = TodoItem::where('staff_id', auth('admin')->id())
            ->where('completed', false)
            ->latest()
            ->get();

        return view('admin.pages.todo.index', compact('todos'));
    }

    public function completed()
    {
        $completedTodos = TodoItem::where('staff_id', auth('admin')->id())
            ->where('completed', true)
            ->latest()
            ->get();

        return view('admin.pages.todo.completed', compact('completedTodos'));
    }

    public function create()
    {
        return view('admin.pages.todo.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        TodoItem::create([
            'title' => $request->title,
            'description' => $request->description,
            'staff_id' => auth('admin')->id(),
        ]);

        return redirect()->route('admin.todo.index')->with('success', 'Task added successfully!');
    }

    public function complete(TodoItem $todo)
    {
        if ($todo->staff_id !== auth('admin')->id()) {
            abort(403);
        }

        $todo->update([
            'completed' => true,
            'completed_at' => now(),
        ]);

        return back()->with('success', 'Task marked as completed!');
    }

    public function destroy(TodoItem $todo)
    {
        if ($todo->staff_id !== auth('admin')->id()) {
            abort(403);
        }

        $todo->delete();

        return back()->with('success', 'Task deleted successfully!');
    }
}
