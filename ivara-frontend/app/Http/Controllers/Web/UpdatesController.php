<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Update;
use Illuminate\Http\Request;

class UpdatesController extends Controller
{
    /**
     * Show the updates page.
     */
    public function index()
    {
        $updates = Update::latest()->paginate(12);
        return view('web.updates', compact('updates'));
    }
}
