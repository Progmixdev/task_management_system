<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\Project;
use App\Models\User;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $projects = Project::all();
        $users = User::all();

        foreach ($projects as $project) {
            foreach (range(1, rand(2, 5)) as $i) {
                Task::create([
                    'project_id' => $project->id,
                    'title' => "Task $i for Project {$project->id}",
                    'description' => "Description for Task $i of project {$project->id}",
                    'is_done' => rand(0, 1),
                ]);
            }
        }
    }
}
