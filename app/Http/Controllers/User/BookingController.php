<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Show logged-in user's bookings
     */
    public function index(Request $request)
    {
        $bookings = $request->user()
            ->bookings()
            ->with('room.floor.apartment')
            ->latest()
            ->get();

        return view('user.bookings.index', compact('bookings'));
    }

    /**
     * Store new booking
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'room_id'    => 'required|exists:rooms,id',
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after:start_date',
        ]);

        // ❌ Prevent double booking (only confirmed ones)
        $exists = Booking::where('room_id', $data['room_id'])
            ->where('status', 'confirmed')
            ->where(function ($q) use ($data) {
                $q->whereBetween('start_date', [$data['start_date'], $data['end_date']])
                  ->orWhereBetween('end_date', [$data['start_date'], $data['end_date']]);
            })
            ->exists();

        if ($exists) {
            return back()->withErrors([
                'booking' => 'Room already booked for selected dates.'
            ]);
        }

        // ✅ CREATE BOOKING
        Booking::create([
            'user_id'    => $request->user()->id,
            'room_id'    => $data['room_id'],
            'start_date' => $data['start_date'],
            'end_date'   => $data['end_date'],
            'status'     => 'pending',
        ]);

        return back()->with('success', 'Booking request submitted.');
    }
}
