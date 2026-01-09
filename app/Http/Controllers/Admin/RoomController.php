<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Floor;
use Illuminate\Http\Request;
use App\Models\Apartment;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::with('floor.apartment')->get();
        return view('admin.rooms.index', compact('rooms'));
    }

    public function create()
    {
        $apartments = Apartment::all();
    return view('admin.rooms.create', compact('apartments'));
    }


public function store(Request $request)
{
    $data = $request->validate([
        'floor_id'    => 'required|exists:floors,id',
        'room_number' => 'required',
        'type'        => 'required',
        'price'       => 'required|numeric',
    ]);

    Room::create($data);

    return redirect()
        ->route('admin.rooms.index')
        ->with('success', 'Room added successfully');
}
    public function destroy(Room $room)
    {
        $room->delete();
        return back();
    }
}
