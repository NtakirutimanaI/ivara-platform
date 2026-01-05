<?php

namespace App\Modules\MediaEntertainment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MediaDashboardController extends Controller
{
    public function consumer() { return view('categories.media-entertainment.consumer.index'); }
    public function creator() { return view('categories.media-entertainment.creator.index'); }
    public function producer() { return view('categories.media-entertainment.producer.index'); }
    public function advertiser() { return view('categories.media-entertainment.advertiser.index'); }
    public function distributor() { return view('categories.media-entertainment.distributor.index'); }
    public function admin() { return view('categories.media-entertainment.admin.index'); }
    public function index() { return $this->admin(); }


    public function generic() { return view('media.generic'); }
}
