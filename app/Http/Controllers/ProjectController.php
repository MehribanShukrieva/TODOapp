<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Project::class, 'project');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::where('user_id', Auth::id())
            ->withCount('tasks')
            ->latest()
            ->paginate(10);
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $validated = $request->validated();

        $project = Project::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()->route('projects.show', $project)->with('status', 'Project created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project, Request $request)
    {
        $this->authorize('view', $project);

        $status = $request->string('status')->toString();
        $search = $request->string('q')->toString();

        $tasksQuery = $project->tasks()->latest();
        if (in_array($status, ['todo', 'in_progress', 'done'])) {
            $tasksQuery->where('status', $status);
        }
        if ($search !== '') {
            $tasksQuery->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                  ->orWhere('description', 'like', "%$search%");
            });
        }

        $tasks = $tasksQuery->paginate(10)->appends($request->query());

        $counts = [
            'all' => $project->tasks()->count(),
            'todo' => $project->tasks()->where('status', 'todo')->count(),
            'in_progress' => $project->tasks()->where('status', 'in_progress')->count(),
            'done' => $project->tasks()->where('status', 'done')->count(),
        ];

        return view('projects.show', compact('project', 'tasks', 'counts', 'status', 'search'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $this->authorize('update', $project);
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $this->authorize('update', $project);

        $project->update($request->validated());
        return redirect()->route('projects.show', $project)->with('status', 'Project updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);
        $project->delete();
        return redirect()->route('projects.index')->with('status', 'Project deleted');
    }
}
