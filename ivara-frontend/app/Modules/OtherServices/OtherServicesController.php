<?php

namespace App\Modules\OtherServices;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OtherServicesController extends Controller
{
    protected $categoryName = 'Other Services';
    protected $categorySlug = 'other-services';
    protected $categoryIcon = 'fa-ellipsis-h';
    protected $categoryColor = '#607D8B';

    public function index()
    {
        $stats = [
            'total_services' => 0,
            'total_bookings' => 0,
            'total_providers' => 0,
            'total_products' => 0,
            'pending_requests' => 0,
            'total_revenue' => 0,
        ];

        return view('admin.categories.other-services.index', [
            'stats' => $stats,
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
            'categoryIcon' => $this->categoryIcon,
            'categoryColor' => $this->categoryColor,
        ]);
    }

    public function services()
    {
        return view('admin.categories.other-services.services', [
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
        ]);
    }

    public function bookings()
    {
        return view('admin.categories.other-services.bookings', [
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
        ]);
    }

    public function providers()
    {
        return view('admin.categories.other-services.providers', [
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
        ]);
    }

    public function products()
    {
        return view('admin.categories.other-services.products', [
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
        ]);
    }

    public function clients()
    {
        return view('admin.categories.other-services.clients', [
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
        ]);
    }

    public function reports()
    {
        return view('admin.categories.other-services.reports', [
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
        ]);
    }

    public function payments()
    {
        return view('admin.categories.other-services.payments', [
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
        ]);
    }

    public function reviews()
    {
        return view('admin.categories.other-services.reviews', [
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
        ]);
    }

    public function settings()
    {
        return view('admin.categories.other-services.settings', [
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
        ]);
    }
}
