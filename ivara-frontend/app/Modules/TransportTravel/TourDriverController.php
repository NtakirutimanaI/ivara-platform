<?php

namespace App\Modules\TransportTravel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TourDriverController extends Controller
{
    public function index()
    {
        return view('transport.tour_driver.index');
    }

    public function bookings()
    {
        return view('transport.coming_soon');
    }

    public function destinations()
    {
        return view('transport.coming_soon');
    }

    public function meetings()
    {
        return view('transport.coming_soon');
    }
}
