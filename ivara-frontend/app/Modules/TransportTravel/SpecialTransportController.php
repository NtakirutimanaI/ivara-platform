<?php

namespace App\Modules\TransportTravel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SpecialTransportController extends Controller
{
    public function index()
    {
        return view('transport.special_transport.index');
    }

    public function emergencyRequests()
    {
        return view('transport.coming_soon');
    }

    public function careLogs()
    {
        return view('transport.coming_soon');
    }

    public function meetings()
    {
        return view('transport.coming_soon');
    }
}
