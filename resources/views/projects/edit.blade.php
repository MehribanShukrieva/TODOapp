@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4 text-gray-900 dark:text-gray-100">Edit Project</h1>

<form method="POST" action="{{ route('projects.update', $project) }}" class="space-y-4">
    @csrf
    @method('PUT')
    <div>
        <label class="block text-sm text-gray-700 dark:text-gray-300">Title</label>
        <input name="title" value="{{ old('title', $project->title) }}" class="w-full p-2 border rounded bg-white dark:bg-gray-900"/>
        @error('title')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
    </div>
    <div>
        <label class="block text-sm text-gray-700 dark:text-gray-300">Description</label>
        <textarea name="description" class="w-full p-2 border rounded bg-white dark:bg-gray-900">{{ old('description', $project->description) }}</textarea>
        @error('description')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
    </div>
    <div>
        <label class="block text-sm text-gray-700 dark:text-gray-300">Color</label>
        <input type="color" name="color" value="{{ old('color', $project->color ?? '#3b82f6') }}" class="h-10 w-16 p-0 border rounded bg-white dark:bg-gray-900"/>
    </div>
    <div class="flex gap-2">
        <button class="px-4 py-2 bg-blue-600 text-white rounded">Save</button>
        <a href="{{ route('projects.show', $project) }}" class="px-4 py-2 bg-gray-300 rounded">Cancel</a>
    </div>
</form>
@endsection


