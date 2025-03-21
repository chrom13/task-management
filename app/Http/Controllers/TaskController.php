<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Notifications\TaskDueDateNotification;
use Illuminate\Support\Facades\Notification;

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

        $task = $project->tasks()->create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'due_date' => $request->due_date,
            'creator_id' => auth()->id(),
        ]);





        return response()->json($task, 201);
    }

    public function update(Request $request, Project $project, Task $task)
    {
        if ($task->project_id !== $project->id) {
            return response()->json([
                'error' => 'The task does not belong to the specified project.'
            ], 403); // 403 Forbidden
        }

        $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'status' => ['sometimes', Rule::in(['pending', 'in_progress', 'completed'])],
            'due_date' => [
                'sometimes',
                'date',
                function ($attribute, $value, $fail) use ($project) {
                    if ($value > $project->deadline) {
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
