<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->query('page', 'space');
        $projects = Project::where('user_id', Auth::id())->latest()->get();
        return view('dashboard', compact('page', 'projects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'key' => 'required|string|max:10|unique:projects,key',
        ]);

        $project = Project::create([
            'name' => $request->name,
            'key' => strtoupper($request->key),
            'description' => $request->description,
            'user_id' => Auth::id()
        ]);

        // Create default statuses
        $project->statuses()->createMany([
            ['name' => 'To Do', 'color' => 'slate', 'order' => 0],
            ['name' => 'In Progress', 'color' => 'yellow', 'order' => 1],
            ['name' => 'Done', 'color' => 'emerald', 'order' => 2],
        ]);

        return redirect()->route('projects.show', $project);
    }

    public function show(Project $project)
    {
        if ($project->user_id !== Auth::id()) {
            abort(403);
        }

        $statuses = $project->statuses()->with(['tasks' => function($q) {
            $q->orderBy('order');
        }])->get();
        
        $users = \App\Models\User::all();

        return view('board', compact('project', 'statuses', 'users'));
    }

    public function storeStatus(Request $request, Project $project)
    {
        if ($project->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:50',
            'color' => 'required|string|in:slate,blue,purple,pink,orange,yellow,emerald,red'
        ]);

        $project->statuses()->create([
            'name' => $request->name,
            'color' => $request->color,
            'order' => $project->statuses()->max('order') + 1,
        ]);

        return back();
    }
}
