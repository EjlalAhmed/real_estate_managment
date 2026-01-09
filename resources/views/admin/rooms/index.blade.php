@extends('layouts.app')

@section('content')
<div class="flex justify-between mb-6">
    <h1 class="text-2xl font-bold text-black">Rooms</h1>
    <a href="{{ route('admin.rooms.create') }}"
       class="bg-black text-white px-4 py-2 rounded">
        + Add Room
    </a>
</div>

<div class="bg-white rounded shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-left text-black font-medium">Apartment</th>
                <th class="p-3 text-left text-black font-medium">Floor</th>
                <th class="p-3 text-left text-black font-medium">Room</th>
                <th class="p-3 text-left text-black font-medium">Type</th>
                <th class="p-3 text-left text-black font-medium">Price</th>
                <th class="p-3 text-left text-black font-medium">Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($rooms as $room)
            <tr class="border-t">
                <td class="p-3 text-black font-medium">{{ $room->floor->apartment->name }}</td>
                <td class="p-3 text-black font-medium">{{ $room->floor->floor_number }}</td>
                <td class="p-3 text-black font-medium">{{ $room->room_number }}</td>
                <td class="p-3 text-black font-medium">{{ $room->type }}</td>
                <td class="p-3text-black font-medium">£{{ $room->price }}</td>
                <td class="p-3 text-black font-medium">
                    <form method="POST"
                          action="{{ route('admin.rooms.destroy', $room) }}">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600 hover:underline">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
