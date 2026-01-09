<!DOCTYPE html>
<html lang="en" class="bg-gray-100 dark:bg-gray-900">
<head>
    <meta charset="UTF-8">
    <title>London Square</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen text-gray-900 dark:text-gray-100">

<div class="flex min-h-screen">

    {{-- ================= ADMIN SIDEBAR ================= --}}
    @auth
        @if(auth()->user()->hasRole('admin'))
            @include('admin.partials.sidebar')
        @endif
    @endauth

    {{-- ================= MAIN CONTENT ================= --}}
    <div class="flex-1 flex flex-col ml-64">

        {{-- TOP NAVBAR --}}
        <nav class="bg-black text-white px-6 py-4 flex justify-between items-center fixed top-0 left-0 right-0 z-10">
            <span class="font-semibold text-lg">
                London Square
            </span>

            <div class="flex items-center gap-4">

                {{-- Dark Mode Toggle --}}
                <button
                    onclick="toggleTheme(this)"
                    id="themeToggle"
                    class="relative bg-gray-800 hover:bg-gray-700 px-3 py-1 rounded text-lg
                           transition-all duration-300 focus:outline-none dark:bg-gray-700">
                    <span id="themeIcon">🌙</span>
                </button>

                {{-- Logout --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-sm hover:underline">
                        Logout
                    </button>
                </form>
            </div>
        </nav>

        {{-- PAGE CONTENT --}}
        <main class="flex-1 p-6 pt-24">
            @yield('content')
        </main>

    </div>
</div>

{{-- ================= DARK MODE SCRIPT ================= --}}
<script>
    const icon = document.getElementById('themeIcon');

    if (
        localStorage.theme === 'dark' ||
        (!('theme' in localStorage) &&
         window.matchMedia('(prefers-color-scheme: dark)').matches)
    ) {
        document.documentElement.classList.add('dark');
        icon.textContent = '☀️';
    } else {
        document.documentElement.classList.remove('dark');
        icon.textContent = '🌙';
    }

    function toggleTheme(button) {
        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
            localStorage.theme = 'light';
            icon.textContent = '🌙';
        } else {
            document.documentElement.classList.add('dark');
            localStorage.theme = 'dark';
            icon.textContent = '☀️';
        }

        button.classList.remove('glow');
        void button.offsetWidth;
        button.classList.add('glow');
    }
</script>

</body>
</html>
