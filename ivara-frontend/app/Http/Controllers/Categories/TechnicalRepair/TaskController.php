<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;

class TaskController extends Controller
{
    /**
     * Display a listing of the tasks.
     */
    public function index()
    {
        // Get all tasks with assigned user
        $tasks = Task::with('user')->orderBy('created_at', 'desc')->get();
        $users = User::orderBy('name')->get(); // For assign dropdown

        return view('supervisor.tasks.index', compact('tasks', 'users'));
    }

    /**
     * Store a newly created task.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id,
            'status' => 'pending', // default status
        ]);

        return redirect()->back()->with('success', 'Task assigned successfully.');
    }

    /**
     * Show the specified task (optional if using modal view).
     */
    public function show(Task $task)
    {
        $task->load('user');
        return view('supervisor.tasks.show', compact('task'));
    }

    /**
     * Update the specified task.
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified task.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->back()->with('success', 'Task deleted successfully.');
    }
}
