<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\User;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();

        Project::create([
            'title' => 'Website Redesign',
            'description' => 'Redesign the company website to improve user experience.',
            'deadline' => '2023-12-31 23:59:59',
            'creator_id' => $user->id,
        ]);

        Project::create([
            'title' => 'Mobile App Development',
            'description' => 'Develop a new mobile app for iOS and Android.',
            'deadline' => '2024-01-15 23:59:59',
            'creator_id' => $user->id,
        ]);

        Project::create([
            'title' => 'Marketing Campaign',
            'description' => 'Launch a new marketing campaign for the holiday season.',
            'deadline' => '2023-11-30 23:59:59',
            'creator_id' => $user->id,
        ]);
    }
}
