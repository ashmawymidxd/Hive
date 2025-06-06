<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'staff_id' => 'required|exists:staff,id',
            'due_date' => 'nullable|date',
            'priority' => 'required|in:low,medium,high',
        ]);

        $task = Task::create([
            'name' => $request->name,
            'description' => $request->description,
            'staff_id' => $request->staff_id,
            'assigned_by' => auth()->id(), // Assuming admins are authenticated
            'due_date' => $request->due_date,
            'priority' => $request->priority,
            'status' => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'task' => $task,
            'message' => 'Task assigned successfully!'
        ]);
    }

    public function show(Task $task)
    {
        return response()->json($task);
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'status' => 'sometimes|in:pending,in_progress,completed,overdue',
            'priority' => 'sometimes|in:low,medium,high',
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|nullable|string',
            'due_date' => 'sometimes|nullable|date'
        ]);

        $task->update($validated);

        return response()->json(['message' => 'Task updated successfully', 'task' => $task]);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(['message' => 'Task deleted successfully']);
    }

}
