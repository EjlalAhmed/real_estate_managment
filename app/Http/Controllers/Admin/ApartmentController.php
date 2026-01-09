<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function index()
    {
        $apartments = Apartment::all();
        return view('admin.apartments.index', compact('apartments'));
    }

    public function create()
    {
        return view('admin.apartments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Apartment::create($request->only('name', 'location', 'description'));

        return redirect()->route('admin.apartments.index');
    }

    public function edit(Apartment $apartment)
    {
        return view('admin.apartments.edit', compact('apartment'));
    }

    public function update(Request $request, Apartment $apartment)
    {
        $apartment->update($request->only('name', 'location', 'description'));

        return redirect()->route('admin.apartments.index');
    }

    public function destroy(Apartment $apartment)
    {
        $apartment->delete();
        return back();
    }
}
