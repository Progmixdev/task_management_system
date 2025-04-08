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
        $project = Project::findOrFail($projectId); // Get the project from the database
        return view('tasks.create', compact('project'));
    }


    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'project_id' => 'required|exists:projects,id', // Make sure the project exists in the database
        ]);

        // Create the task and associate it with the logged-in user
        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'project_id' => $request->project_id,
            'assigned_to' => Auth::id(),  // Automatically assign the task to the logged-in user
            'is_done' => false, // Default to task not done
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Task added successfully');
    }



    public function toggleTaskStatus($taskId)
    {
        $task = Task::findOrFail($taskId);
        $task->is_done = !$task->is_done;
        $task->save();

        return response()->json($task);
        // return redirect()->back();
    }
    public function edit($taskId)
    {
        $task = Task::findOrFail($taskId);
        return response()->json($task);
    }

    public function update(Request $request, $taskId)
    {
        $task = Task::findOrFail($taskId);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $task->title = $request->title;
        $task->description = $request->description;
        $task->save();

        return response()->json($task);
    }
}
