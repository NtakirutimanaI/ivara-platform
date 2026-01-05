<?php

namespace App\Modules\TransportTravel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BusDriverController extends Controller
{
    public function index()
    {
        return view('transport.bus_driver.index');
    }

    public function schedule()
    {
        return view('transport.coming_soon');
    }

    public function ticketLog()
    {
        return view('transport.coming_soon');
    }

    public function meetings()
    {
        return view('transport.coming_soon');
    }
}
