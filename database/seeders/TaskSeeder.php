<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $projects = Project::all();
        $user = User::first();


        $projects->each(function ($project) use ($user) {
            Task::create([
                'project_id' => $project->id,
                'title' => 'Design Homepage',
                'description' => 'Create the homepage design for the website.',
                'status' => 'pending',
                'due_date' => '2025-03-22 23:59:59',
                'creator_id' => $user->id,
            ]);

            Task::create([
                'project_id' => $project->id,
                'title' => 'Develop API',
                'description' => 'Build the backend API for the mobile app.',
                'status' => 'in_progress',
                'due_date' => '2025-03-22 23:59:59',
                'creator_id' => $user->id,
            ]);

            Task::create([
                'project_id' => $project->id,
                'title' => 'Write Content',
                'description' => 'Write blog posts for the marketing campaign.',
                'status' => 'pending',
                'due_date' => '2025-03-22 23:59:59',
                'creator_id' => $user->id,
            ]);

            Task::create([
                'project_id' => $project->id,
                'title' => 'Test Features',
                'description' => 'Test the new features for the mobile app.',
                'status' => 'pending',
                'due_date' => '2025-03-22 23:59:59',
                'creator_id' => $user->id,
            ]);

            Task::create([
                'project_id' => $project->id,
                'title' => 'Launch Campaign',
                'description' => 'Launch the marketing campaign on social media.',
                'status' => 'pending',
                'due_date' => '2025-03-22 23:59:59',
                'creator_id' => $user->id,
            ]);
        });
    }
}
