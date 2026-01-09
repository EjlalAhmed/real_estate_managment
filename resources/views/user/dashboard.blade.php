@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">
    User Dashboard
</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    {{-- Apartments --}}
    <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">
        <h3 class="text-sm text-gray-500 mb-2">Apartments</h3>
        <p class="text-2xl font-semibold">Browse</p>

        <a href="{{ route('user.apartments') }}"
           class="inline-block mt-4 text-blue-600 hover:underline">
            View Apartments →
        </a>
    </div>

    {{-- My Bookings --}}
    @can('view own bookings')
    <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">
        <h3 class="text-sm text-gray-500 mb-2">My Bookings</h3>
        <p class="text-2xl font-semibold">History</p>

        <a href="{{ route('bookings.index') }}"
           class="inline-block mt-4 text-blue-600 hover:underline">
            View Bookings →
        </a>
    </div>
    @endcan

    {{-- Profile --}}
    <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">
        <h3 class="text-sm text-gray-500 mb-2">Profile</h3>
        <p class="text-2xl font-semibold">
            {{ auth()->user()->name }}
        </p>

        <p class="text-sm text-gray-500 mt-2">
            {{ auth()->user()->email }}
        </p>
    </div>

</div>
@endsection
