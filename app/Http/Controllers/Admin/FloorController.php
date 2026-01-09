<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Floor;
use App\Models\Apartment;
use Illuminate\Http\Request;

class FloorController extends Controller
{
    public function index()
    {
        $floors = Floor::with('apartment')->get();
        return view('admin.floors.index', compact('floors'));
    }

    public function create()
    {
        $apartments = Apartment::all();
        return view('admin.floors.create', compact('apartments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'apartment_id' => 'required',
            'floor_number' => 'required',
        ]);

        Floor::create($request->only('apartment_id', 'floor_number'));

        return redirect()->route('admin.floors.index');
    }

    public function destroy(Floor $floor)
{
    if ($floor->rooms()->exists()) {
        return back()->withErrors(
            'This floor cannot be deleted because it has rooms.'
        );
    }

    $floor->delete();

    return back()->with('success', 'Floor deleted successfully.');
}
}
