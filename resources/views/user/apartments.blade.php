@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">Available Apartments</h1>

{{-- DATE FILTER --}}
<form method="GET" class="mb-6 flex gap-4 items-end">
    <div>
        <label class="block text-sm">Start Date</label>
        <input type="date" name="start_date"
               value="{{ request('start_date') }}"
               class="border rounded px-3 py-2" required>
    </div>

    <div>
        <label class="block text-sm">End Date</label>
        <input type="date" name="end_date"
               value="{{ request('end_date') }}"
               class="border rounded px-3 py-2" required>
    </div>

    <button class="bg-black text-white px-4 py-2 rounded">
        Check Availability
    </button>
</form>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
@foreach($apartments as $apartment)
    <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">
        <h2 class="text-xl font-bold">{{ $apartment->name }}</h2>
        <p class="text-sm text-gray-500">{{ $apartment->location }}</p>

        @foreach($apartment->floors as $floor)
            <div class="mt-4">
                <p class="font-semibold">Floor {{ $floor->floor_number }}</p>

                <ul class="ml-4 mt-2 space-y-2">
                    @forelse($floor->rooms as $room)
                        <li class="flex justify-between items-center border-b pb-2">
                            <span>
                                Room {{ $room->room_number }}
                                <span class="text-gray-500">
                                    ({{ $room->type }} – £{{ $room->price }})
                                </span>
                            </span>

                            @can('create booking')
                            <form method="POST" action="{{ route('bookings.store') }}"
                                  class="flex gap-2 items-center">
                                @csrf
                                <input type="hidden" name="room_id" value="{{ $room->id }}">
                                <input type="hidden" name="start_date" value="{{ request('start_date') }}">
                                <input type="hidden" name="end_date" value="{{ request('end_date') }}">

                                <button class="bg-black text-white px-3 py-1 text-xs rounded">
                                    Book
                                </button>
                            </form>
                            @endcan
                        </li>
                    @empty
                        <li class="text-sm text-red-500">
                            No rooms available for selected dates
                        </li>
                    @endforelse
                </ul>
            </div>
        @endforeach
    </div>
@endforeach
</div>
@endsection
