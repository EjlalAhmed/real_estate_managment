@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">Bookings Management</h1>

<div class="bg-white dark:bg-gray-800 rounded shadow overflow-x-auto">
    <table class="w-full text-sm border-collapse">
        <thead>
            <tr class="bg-gray-100 dark:bg-gray-700">
                <th class="p-3 border">User</th>
                <th class="p-3 border">Apartment</th>
                <th class="p-3 border">Room</th>
                <th class="p-3 border">Dates</th>
                <th class="p-3 border">Status</th>
                <th class="p-3 border">Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($bookings as $booking)
            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                <td class="p-3 border">{{ $booking->user->name }}</td>

                <td class="p-3 border">
                    {{ $booking->room->floor->apartment->name ?? 'N/A' }}
                </td>

                <td class="p-3 border">
                    {{ $booking->room->room_number }}
                </td>

                <td class="p-3 border">
                    {{ $booking->start_date }} → {{ $booking->end_date }}
                </td>

                <td class="p-3 border">
                    <span class="font-medium">
                        {{ ucfirst($booking->status) }}
                    </span>
                </td>

                <td class="p-3 border">
                    @if($booking->status === 'pending')
                    <form method="POST"
                          action="{{ route('admin.bookings.status', $booking) }}"
                          class="flex gap-2">
                        @csrf
                        <button name="status" value="confirmed"
                                class="text-green-600 hover:underline">
                            Approve
                        </button>

                        <button name="status" value="cancelled"
                                class="text-red-600 hover:underline">
                            Cancel
                        </button>
                    </form>
                    @else
                        <span class="text-gray-400">—</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
