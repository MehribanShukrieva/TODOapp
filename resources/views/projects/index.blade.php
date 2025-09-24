@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Projects</h1>
    <a href="{{ route('projects.create') }}" class="px-3 py-2 bg-blue-600 text-white rounded">New Project</a>
    </div>

<div class="bg-white dark:bg-gray-800 rounded shadow">
    <ul>
        @forelse($projects as $project)
            <li class="border-b border-gray-200 dark:border-gray-700 p-4 flex justify-between items-center">
                <div>
                    <a class="text-blue-600 font-medium" href="{{ route('projects.show', $project) }}">{{ $project->title }}</a>
                    <div class="text-sm text-gray-500">{{ $project->tasks_count }} tasks • {{ $project->created_at->diffForHumans() }}</div>
                </div>
                <a class="text-sm text-gray-600 hover:underline" href="{{ route('projects.edit', $project) }}">Edit</a>
            </li>
        @empty
            <li class="p-6 text-gray-500">No projects yet. <a class="text-blue-600 underline" href="{{ route('projects.create') }}">Create your first project</a>.</li>
        @endforelse
    </ul>
</div>

<div class="mt-4">{{ $projects->links() }}</div>
@endsection


