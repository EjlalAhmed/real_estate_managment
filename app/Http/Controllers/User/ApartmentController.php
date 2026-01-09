<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function index(Request $request)
    {
        $start = $request->start_date;
        $end   = $request->end_date;

        $apartments = Apartment::with(['floors.rooms' => function ($q) use ($start, $end) {

            if ($start && $end) {
                $q->whereDoesntHave('bookings', function ($b) use ($start, $end) {
                    $b->where('status', 'confirmed')
                      ->where(function ($d) use ($start, $end) {
                          $d->whereBetween('start_date', [$start, $end])
                            ->orWhereBetween('end_date', [$start, $end])
                            ->orWhere(function ($x) use ($start, $end) {
                                $x->where('start_date', '<=', $start)
                                  ->where('end_date', '>=', $end);
                            });
                      });
                });
            }

        }])->get();

        return view('user.apartments', compact('apartments'));
    }
}
