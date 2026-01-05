<?php

namespace App\Modules\TransportTravel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransportTravelController extends Controller
{
    protected $categoryName = 'Transport & Travel';
    protected $categorySlug = 'transport-travel';
    protected $categoryIcon = 'fa-car';
    protected $categoryColor = '#2196F3';

    public function index()
    {
        $stats = [
            'total_services' => 0,
            'total_bookings' => 0,
            'total_providers' => 0,
            'total_vehicles' => 0,
            'active_trips' => 0,
            'total_revenue' => 0,
        ];

        return view('admin.categories.transport-travel.index', [
            'stats' => $stats,
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
            'categoryIcon' => $this->categoryIcon,
            'categoryColor' => $this->categoryColor,
        ]);
    }

    public function services()
    {
        return view('admin.categories.transport-travel.services', [
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
        ]);
    }

    public function bookings()
    {
        return view('admin.categories.transport-travel.bookings', [
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
        ]);
    }

    public function providers()
    {
        return view('admin.categories.transport-travel.providers', [
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
        ]);
    }

    public function vehicles()
    {
        return view('admin.categories.transport-travel.vehicles', [
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
        ]);
    }

    public function clients()
    {
        return view('admin.categories.transport-travel.clients', [
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
        ]);
    }

    public function reports()
    {
        return view('admin.categories.transport-travel.reports', [
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
        ]);
    }

    public function payments()
    {
        return view('admin.categories.transport-travel.payments', [
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
        ]);
    }

    public function reviews()
    {
        return view('admin.categories.transport-travel.reviews', [
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
        ]);
    }

    public function settings()
    {
        return view('admin.categories.transport-travel.settings', [
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
        ]);
    }
}
