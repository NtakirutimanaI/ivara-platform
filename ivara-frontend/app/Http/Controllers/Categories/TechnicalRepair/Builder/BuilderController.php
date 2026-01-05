<?php

namespace App\Http\Controllers\Categories\TechnicalRepair\Builder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BuilderController extends Controller
{
    public function index()
    {
        return view('builder.index'); 
    }

    public function projects()
    {
        return view('builder.projects');
    }

    public function schedule()
    {
        return view('builder.schedule');
    }
}
