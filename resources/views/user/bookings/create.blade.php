@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('bookings.store') }}"
      class="bg-white dark:bg-gray-800 p-6 rounded shadow max-w-md">
    @csrf

    <input type="hidden" name="room_id" value="{{ $room->id }}">

    <div class="mb-4">
        <label class="block mb-1 font-medium">Start Date</label>
        <input type="date" name="start_date"
               class="w-full border rounded px-3 py-2" required>
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-medium">End Date</label>
        <input type="date" name="end_date"
               class="w-full border rounded px-3 py-2" required>
    </div>

    <button class="bg-black text-white px-4 py-2 rounded">
        Book Room
    </button>
</form>

@endsection
