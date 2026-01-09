@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">My Bookings</h1>

<div class="bg-white dark:bg-gray-800 rounded shadow overflow-x-auto">
    <table class="w-full text-sm border-collapse">
        <thead>
            <tr class="bg-gray-100 dark:bg-gray-700">
                <th class="p-3 border text-left">Apartment</th>
                <th class="p-3 border text-left">Floor</th>
                <th class="p-3 border text-left">Room</th>
                <th class="p-3 border text-left">Dates</th>
                <th class="p-3 border text-left">Status</th>
            </tr>
        </thead>

        <tbody>
            @forelse($bookings as $booking)
            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                <td class="p-3 border">
                    {{ $booking->room->floor->apartment->name ?? 'N/A' }}
                </td>
                <td class="p-3 border">
                    {{ $booking->room->floor->name ?? 'N/A' }}
                </td>
                <td class="p-3 border">
                    {{ $booking->room->room_number }}
                </td>
                <td class="p-3 border">
                    {{ $booking->start_date }} → {{ $booking->end_date }}
                </td>
                <td class="p-3 border">
                    @if($booking->status === 'pending')
                        <span class="text-yellow-600 font-medium">Pending</span>
                    @elseif($booking->status === 'confirmed')
                        <span class="text-green-600 font-medium">Confirmed</span>
                    @else
                        <span class="text-red-600 font-medium">Cancelled</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="p-4 text-center text-gray-500">
                    No bookings found
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
