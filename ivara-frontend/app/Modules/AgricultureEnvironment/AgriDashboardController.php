<?php

namespace App\Modules\AgricultureEnvironment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AgriDashboardController extends Controller
{
    public function farmer() { return view('agriculture.farmer.index'); }
    public function manager() { return view('agriculture.manager.index'); }
    public function supplier() { return view('agriculture.supplier.index'); }
    public function officer() { return view('agriculture.officer.index'); }
    public function buyer() { return view('agriculture.buyer.index'); }
    public function sustainability() { return view('agriculture.sustainability.index'); }
    public function admin() { return view('agriculture.admin.index'); }

    public function generic() { return view('agriculture.generic'); }
}
