<?php

namespace App\Modules\TransportTravel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MotorcycleTaxiController extends Controller
{
    public function index()
    {
        return view('transport.motorcycle_taxi.index');
    }

    public function trips()
    {
        return view('transport.coming_soon');
    }

    public function bikeStatus()
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
