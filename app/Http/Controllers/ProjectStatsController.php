<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectStatsController extends Controller
{
    public function stats(Project $project)
    {
        return response()->json([
            'total_tasks' => $project->tasks->count(),
            'completed_tasks' => $project->tasks->where('status', 'completed')->count(),
            'overdue_tasks' => $project->tasks->where('due_date', '<', now())->where('status', '!=', 'completed')->count(),
        ]);
    }
}
