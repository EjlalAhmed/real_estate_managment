<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;

class DashboardController extends Controller
{
    public function index()
    {
        $totalApartments = Apartment::count();

        return view('admin.dashboard', compact('totalApartments'));
    }
}
