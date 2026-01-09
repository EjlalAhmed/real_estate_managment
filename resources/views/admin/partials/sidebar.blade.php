@php
    $active = 'bg-black text-white';
    $inactive = 'text-black dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-800';
@endphp

<aside class="w-64 min-h-screen bg-white dark:bg-gray-900 border-r border-black dark:border-gray-700 fixed left-0 top-0 pt-16">

    {{-- HEADER --}}
    <div class="p-6 font-bold text-lg text-black dark:text-white border-b border-black dark:border-gray-700">
        Admin Panel
    </div>

    {{-- NAV --}}
    <nav class="p-4 space-y-2 text-sm font-medium">

        {{-- ================= DASHBOARD ================= --}}
        @can('view dashboard')
        <a href="{{ route('admin.dashboard') }}"
           class="block px-3 py-2 rounded {{ request()->routeIs('admin.dashboard') ? $active : $inactive }}">
            Dashboard
        </a>
        @endcan

        {{-- ================= USERS ================= --}}
        @can('manage users')
        <div class="mt-4 border-t border-gray-300 dark:border-gray-700 pt-4">
            <p class="px-3 mb-2 text-xs uppercase text-gray-500 dark:text-gray-400">
                Users
            </p>

            <a href="{{ route('admin.users.index') }}"
               class="block px-3 py-2 rounded {{ request()->routeIs('admin.users.*') ? $active : $inactive }}">
                All Users
            </a>

            @can('create users')
            <a href="{{ route('admin.users.create') }}"
               class="block px-3 py-2 rounded {{ $inactive }}">
                Create User
            </a>
            @endcan
        </div>
        @endcan

        {{-- ================= PROPERTIES ================= --}}
        @can('manage apartments')
        <div class="mt-4 border-t border-gray-300 dark:border-gray-700 pt-4">
            <p class="px-3 mb-2 text-xs uppercase text-gray-500 dark:text-gray-400">
                Properties
            </p>

            <a href="{{ route('admin.apartments.index') }}"
               class="block px-3 py-2 rounded {{ request()->routeIs('admin.apartments.*') ? $active : $inactive }}">
                Apartments
            </a>
        </div>
        @endcan

        @can('manage floors')
        <a href="{{ route('admin.floors.index') }}"
           class="block px-3 py-2 rounded {{ request()->routeIs('admin.floors.*') ? $active : $inactive }}">
            Floors
        </a>
        @endcan

        @can('manage rooms')
        <a href="{{ route('admin.rooms.index') }}"
           class="block px-3 py-2 rounded {{ request()->routeIs('admin.rooms.*') ? $active : $inactive }}">
            Rooms
        </a>
        @endcan

        {{-- ================= BOOKINGS ================= --}}
        @canany(['create booking','manage bookings'])
        <div class="mt-4 border-t border-gray-300 dark:border-gray-700 pt-4">
            <p class="px-3 mb-2 text-xs uppercase text-gray-500 dark:text-gray-400">
                Bookings
            </p>

            {{-- USER SIDE --}}
            @can('view own bookings')
            <a href="{{ route('bookings.index') }}"
               class="block px-3 py-2 rounded {{ request()->routeIs('bookings.*') ? $active : $inactive }}">
                My Bookings
            </a>
            @endcan

            {{-- ADMIN SIDE --}}
            @can('manage bookings')
            <a href="{{ route('admin.bookings.index') }}"
               class="block px-3 py-2 rounded {{ request()->routeIs('admin.bookings.*') ? $active : $inactive }}">
                Manage Bookings
            </a>
            @endcan
        </div>
        @endcanany

        {{-- ================= FRONT ================= --}}
        @can('view apartments')
        <div class="mt-4 border-t border-gray-300 dark:border-gray-700 pt-4">
            <p class="px-3 mb-2 text-xs uppercase text-gray-500 dark:text-gray-400">
                Front
            </p>

            <a href="{{ route('user.apartments') }}"
               class="block px-3 py-2 rounded {{ $inactive }}">
                View Apartments
            </a>
        </div>
        @endcan

    </nav>
</aside>
