<?php

namespace App\Modules\TransportTravel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaxiDriverController extends Controller
{
    public function index()
    {
        return view('transport.taxi_driver.index');
    }

    public function bookings()
    {
        return view('transport.coming_soon');
    }

    public function vehicle()
    {
        return view('transport.coming_soon');
    }

    public function meetings()
    {
        return view('transport.coming_soon');
    }

    public function earnings()
    {
        return view('transport.coming_soon');
    }
}
