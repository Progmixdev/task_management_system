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
        $tasks = Project::findOrFail($projectId)->tasks;
        // return response()->json($tasks);

        return view('tasks.index', compact('tasks', 'projectId'));
    }
}
