<?php

namespace App\Modules\CreativeLifestyle;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WellnessController extends Controller
{
    public function gym() { return view('creative.gym.index'); }
    public function yoga() { return view('creative.yoga.index'); }
    public function sports() { return view('creative.generic'); }
    public function fitness() { return view('creative.generic'); }
    public function aerobics() { return view('creative.generic'); }
    public function martialArts() { return view('creative.generic'); }
    public function pilates() { return view('creative.generic'); }

    // Sub-pages (generic for now)
    public function comingSoon() { return view('creative.coming_soon'); }
}
