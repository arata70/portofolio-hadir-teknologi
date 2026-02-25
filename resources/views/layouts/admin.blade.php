<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-slate-100">

<div class="min-h-screen flex">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-slate-900 text-slate-200 flex flex-col">
        <div class="px-6 py-5 text-xl font-bold border-b border-slate-700">
            Admin Panel
        </div>

        <nav class="flex-1 px-4 py-6 space-y-2 text-sm">
            <a href="{{ route('admin.dashboard') }}"
               class="block px-4 py-2 rounded hover:bg-slate-800">
                Beranda
            </a>

            <a href="{{ route('admin.posts.index') }}"
               class="block px-4 py-2 rounded hover:bg-slate-800">
                Postingan
            </a>
        </nav>

        <!-- PROFILE -->
        <div class="px-4 py-4 border-t border-slate-700 text-sm">
            <div class="font-semibold">{{ auth()->user()->name }}</div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="text-red-400 hover:underline mt-1">
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- CONTENT -->
    <main class="flex-1 p-8">
        @yield('content')
    </main>

</div>

</body>
</html>
