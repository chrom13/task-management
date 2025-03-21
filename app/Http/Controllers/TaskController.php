<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    public function store(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => ['required', Rule::in(['pending', 'in_progress', 'completed'])],
            'due_date' => [
                'required',
                'date',
                function ($attribute, $value, $fail) use ($project) {
                    if ($value > $project->deadline) {
                        $fail('The due date must be before the project deadline.');
                    }
                },
            ],
        ]);

        $task = $project->tasks()->create($request->all());
        return response()->json($task, 201);
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'status' => ['sometimes', Rule::in(['pending', 'in_progress', 'completed'])],
            'due_date' => [
                'sometimes',
                'date',
                function ($attribute, $value, $fail) use ($task) {
                    if ($value > $task->project->deadline) {
                        $fail('The due date must be before the project deadline.');
                    }
                },
            ],
        ]);

        $task->update($request->all());
        return response()->json($task);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(null, 204);
    }
}
