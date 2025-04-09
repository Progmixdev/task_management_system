<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function getProjects()
    {
        $projects = Project::all();
        // return response()->json($projects);
        return view('projects.index', compact('projects'));
    }

    public function getTasksByProject($projectId)
    {
        $tasks = Task::where('project_id', $projectId)
            ->orderBy('due_date')
            ->paginate(5);

        return view('tasks.index', compact('tasks', 'projectId'));
        // return response()->json($tasks);
    }
}
