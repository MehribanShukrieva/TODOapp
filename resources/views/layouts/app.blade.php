<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'ToDo App') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root { color-scheme: dark; }
        html, body { background: radial-gradient(1200px 600px at 10% 10%, #0b1220 0%, #0a0f1a 45%, #080d17 100%); color:#e5ecff; }
        .card { background:#0f1a2b; border:1px solid #1f2a3d; border-radius:0.5rem; box-shadow: 0 6px 18px rgba(0,0,0,.35); }
        input, select, textarea { background-color:#0f1a2b !important; color:#e5ecff !important; border-color:#23324a !important; }
        input::placeholder, textarea::placeholder { color:#8aa0bf; }
        .btn-primary { background:#3b82f6; color:#fff; }
        .btn-primary:hover { background:#2563eb; }
        .btn-danger { background:#ef4444; color:#fff; }
        .btn-danger:hover { background:#dc2626; }
        .badge { background:#1f2a3d; color:#c7d2fe; border:1px solid #2b3a55; border-radius:.375rem; padding:.125rem .5rem; }
        .muted { color:#8aa0bf; }
    </style>
</head>
<body class="font-sans antialiased">
<div class="min-h-screen">
    <nav class="sticky top-0 z-10 bg-gradient-to-r from-indigo-700 via-indigo-600 to-sky-600/90 backdrop-blur border-b border-indigo-500/30 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-6">
                    <a href="{{ route('dashboard') }}" class="text-lg font-semibold tracking-wide">ToDo Pro</a>
                    <a href="{{ route('projects.index') }}" class="opacity-90 hover:opacity-100">Projects</a>
                </div>
                <div class="flex items-center gap-4">
                    @auth
                        <span class="opacity-90">{{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="px-3 py-1.5 rounded bg-white/10 hover:bg-white/20">Logout</button>
                        </form>
                    @else
                        <a class="opacity-90 hover:opacity-100" href="{{ route('login') }}">Login</a>
                        <a class="px-3 py-1.5 rounded bg-white/10 hover:bg-white/20" href="{{ route('register') }}">Register</a>
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
