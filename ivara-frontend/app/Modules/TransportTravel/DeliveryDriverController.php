<?php

namespace App\Modules\TransportTravel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeliveryDriverController extends Controller
{
    public function index()
    {
        return view('transport.delivery_driver.index');
    }

    public function orders()
    {
        return view('transport.coming_soon');
    }

    public function routeMap()
    {
        return view('transport.coming_soon');
    }

    public function meetings()
    {
        return view('transport.coming_soon');
    }
}
