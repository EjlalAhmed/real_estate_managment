<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Floor;
use App\Models\Room;

class AjaxController extends Controller
{
    // Get floors by apartment
    public function floors(Apartment $apartment)
    {
        return response()->json(
            $apartment->floors()->select('id', 'floor_number')->get()
        );
    }

    // Get rooms by floor
    public function rooms(Floor $floor)
    {
        return response()->json(
            $floor->rooms()->select('id', 'room_number')->get()
        );
    }
}
