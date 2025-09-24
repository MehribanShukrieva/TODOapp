<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'ToDo App') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-slate-50">
    <nav class="bg-white border-b border-slate-200 sticky top-0 z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-6">
                    <a href="{{ route('dashboard') }}" class="text-lg font-semibold tracking-wide text-slate-800">ToDo Pro</a>
                    <a href="{{ route('projects.index') }}" class="text-slate-600 hover:text-slate-900">Projects</a>
                </div>
                <div class="flex items-center gap-4">
                    @auth
                        <span class="text-slate-600">{{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="px-3 py-1.5 rounded bg-slate-800 text-white hover:bg-slate-900">Logout</button>
                        </form>
                    @else
                        <a class="text-slate-600 hover:text-slate-900" href="{{ route('login') }}">Login</a>
                        <a class="px-3 py-1.5 rounded bg-blue-600 text-white hover:bg-blue-700" href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
    <main class="max-w-5xl mx-auto p-6">
        @if (session('status'))
            <div class="mb-4 p-3 rounded border border-green-200 bg-green-50 text-green-800">{{ session('status') }}</div>
        @endif
        @if ($errors->any())
            <div class="mb-4 p-3 rounded border border-red-200 bg-red-50 text-red-800">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @yield('content')
    </main>
</div>
</body>
</html>
