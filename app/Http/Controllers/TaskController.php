<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function create($projectId)
    {
        $project = Project::findOrFail($projectId);
        return view('tasks.create', compact('project'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
            'project_id' => 'required|exists:projects,id',
        ]);
        $task = Task::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Task Created Successfully',
            'task' => $task,
        ]);
    }

    public function toggleTaskStatus($taskId)
    {
        $task = Task::findOrFail($taskId);
        $task->is_done = !$task->is_done;
        $task->save();

        return response()->json([
            'status' => $task->is_done ? 'done' : 'pending',
            'taskId' => $task->id
        ]);
    }
}
