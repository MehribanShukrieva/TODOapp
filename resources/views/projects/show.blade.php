@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100 flex items-center gap-3">
        <span class="inline-block h-4 w-4 rounded" style="background-color: {{ $project->color ?? '#3b82f6' }}"></span>
        {{ $project->title }}
    </h1>
    <div class="flex gap-2">
        <a href="{{ route('projects.edit', $project) }}" class="px-3 py-2 bg-yellow-600 text-white rounded">Edit</a>
        <form method="POST" action="{{ route('projects.destroy', $project) }}" onsubmit="return confirm('Delete project?')">
            @csrf
            @method('DELETE')
            <button class="px-3 py-2 bg-red-600 text-white rounded">Delete</button>
        </form>
    </div>
</div>
<p class="text-gray-700 dark:text-gray-300 mb-6">{{ $project->description ?: 'No description' }}</p>

<h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-gray-100">Tasks</h2>

<form method="GET" action="{{ route('projects.show', $project) }}" class="mb-4 flex gap-2">
    <input type="text" name="q" value="{{ $search ?? '' }}" placeholder="Search tasks..." class="flex-1 p-2 border rounded bg-white dark:bg-gray-900" />
    <select name="status" class="p-2 border rounded bg-white dark:bg-gray-900">
        <option value="" @selected(($status ?? '')==='')>All ({{ $counts['all'] ?? $project->tasks->count() }})</option>
        <option value="todo" @selected(($status ?? '')==='todo')>Todo ({{ $counts['todo'] ?? 0 }})</option>
        <option value="in_progress" @selected(($status ?? '')==='in_progress')>In progress ({{ $counts['in_progress'] ?? 0 }})</option>
        <option value="done" @selected(($status ?? '')==='done')>Done ({{ $counts['done'] ?? 0 }})</option>
    </select>
    <button class="px-4 py-2 bg-gray-700 text-white rounded">Filter</button>
</form>

<div class="bg-white dark:bg-gray-800 rounded shadow mb-4">
    <ul>
        @forelse(($tasks ?? $project->tasks) as $task)
            <li class="border-b border-gray-200 dark:border-gray-700 p-3 flex items-center justify-between">
                <div>
                    <div class="font-medium {{ $task->status === 'done' ? 'line-through' : '' }}">{{ $task->title }}</div>
                    <div class="text-sm text-gray-500">{{ $task->description }}</div>
                    <div class="text-xs text-gray-400 flex gap-3">
                        <span>Status: <span class="inline-block px-2 py-0.5 rounded bg-gray-200 text-gray-800">{{ $task->status }}</span></span>
                        <span>Priority: <span class="inline-block px-2 py-0.5 rounded {{ $task->priority==='high' ? 'bg-red-200 text-red-800' : ($task->priority==='low' ? 'bg-green-200 text-green-800' : 'bg-yellow-200 text-yellow-800') }}">{{ $task->priority ?? 'medium' }}</span></span>
                        @if($task->due_date)
                            <span>Due: {{ \Illuminate\Support\Carbon::parse($task->due_date)->toFormattedDateString() }}</span>
                        @endif
                    </div>
                </div>
                <div class="flex gap-2">
                    <form method="POST" action="{{ route('tasks.update', $task) }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="title" value="{{ $task->title }}">
                        <input type="hidden" name="description" value="{{ $task->description }}">
                        <select name="status" class="border rounded p-1">
                            <option value="todo" @selected($task->status==='todo')>todo</option>
                            <option value="in_progress" @selected($task->status==='in_progress')>in_progress</option>
                            <option value="done" @selected($task->status==='done')>done</option>
                        </select>
                        <button class="ml-2 px-2 py-1 bg-blue-600 text-white rounded">Update</button>
                    </form>
                    <form method="POST" action="{{ route('tasks.destroy', $task) }}" onsubmit="return confirm('Delete task?')">
                        @csrf
                        @method('DELETE')
                        <button class="px-2 py-1 bg-red-600 text-white rounded">Delete</button>
                    </form>
                </div>
            </li>
        @empty
            <li class="p-6 text-gray-500">No tasks found.</li>
        @endforelse
    </ul>
    </div>

@if(isset($tasks))
    <div class="mt-3">{{ $tasks->links() }}</div>
@endif

<h3 class="text-lg font-semibold mb-2 text-gray-900 dark:text-gray-100">Add Task</h3>
<form method="POST" action="{{ route('projects.tasks.store', $project) }}" class="space-y-3">
    @csrf
    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
        <div>
            <label class="block text-sm">Title</label>
            <input name="title" class="w-full p-2 border rounded bg-white dark:bg-gray-900" required/>
            @error('title')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>
        <div>
            <label class="block text-sm">Priority</label>
            <select name="priority" class="w-full p-2 border rounded bg-white dark:bg-gray-900">
                <option value="low">low</option>
                <option value="medium" selected>medium</option>
                <option value="high">high</option>
            </select>
        </div>
        <div>
            <label class="block text-sm">Due date</label>
            <input type="date" name="due_date" class="w-full p-2 border rounded bg-white dark:bg-gray-900" />
        </div>
        <div>
            <label class="block text-sm">Status</label>
            <select name="status" class="w-full border rounded p-2">
                <option value="todo">todo</option>
                <option value="in_progress">in_progress</option>
                <option value="done">done</option>
            </select>
        </div>
    </div>
    <button class="px-4 py-2 bg-green-600 text-white rounded">Add Task</button>
</form>
@endsection


