<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\User;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        if (User::count() == 0) {
            User::factory()->count(3)->create();
        }

        $users = User::all();

        foreach (range(1, 10) as $i) {
            Project::create([
                'name' => "Project $i",
                'description' => "This is the description for project $i",
                'created_by' => $users->random()->id,
            ]);
        }
    }
}
