<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(Request $request, Project $project)
    {
        if ($project->user_id !== request()->user()->id) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'nullable|string|in:task,bug,story,epic',
            'priority' => 'nullable|string|in:low,medium,high',
        ]);

        $status = $project->statuses()->first();
        if (!$status) {
            return back()->withErrors(['message' => 'Project has no columns/statuses.']);
        }

        $task = $project->tasks()->create([
            'title' => $request->title,
            'description' => $request->description,
            'status_id' => $status->id,
            'type' => $request->type ?? 'task',
            'priority' => $request->priority ?? 'medium',
            'order' => $project->tasks()->where('status_id', $status->id)->max('order') + 1,
        ]);

        return back();
    }

    public function update(Request $request, Task $task)
    {
        if ($task->project->user_id !== request()->user()->id) {
            abort(403);
        }

        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'status_id' => 'sometimes|required|exists:statuses,id',
            'priority' => 'sometimes|required|string|in:low,medium,high',
            'type' => 'sometimes|required|string|in:task,bug,story,epic',
        ]);

        $task->fill($request->only([
            'title', 'description', 'status_id', 'priority', 'type', 'order', 'assignee_id'
        ]));
        
        $task->save();

        if ($request->wantsJson()) {
            return response()->json(['success' => true]);
        }
        
        return back();
    }

    public function destroy(Task $task)
    {
        if ($task->project->user_id !== request()->user()->id) {
            abort(403);
        }

        $task->delete();
        return back();
    }
}
