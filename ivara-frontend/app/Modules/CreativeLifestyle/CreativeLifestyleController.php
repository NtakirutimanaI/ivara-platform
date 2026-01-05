<?php

namespace App\Modules\CreativeLifestyle;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreativeLifestyleController extends Controller
{
    protected $categoryName = 'Creative & Lifestyle';
    protected $categorySlug = 'creative-lifestyle';
    protected $categoryIcon = 'fa-palette';
    protected $categoryColor = '#E91E63';

    /**
     * Category Dashboard
     */
    public function index()
    {
        $stats = [
            'total_services' => 0,
            'total_bookings' => 0,
            'total_providers' => 0,
            'total_revenue' => 0,
            'pending_bookings' => 0,
            'completed_bookings' => 0,
        ];

        return view('admin.categories.creative-lifestyle.index', [
            'stats' => $stats,
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
            'categoryIcon' => $this->categoryIcon,
            'categoryColor' => $this->categoryColor,
        ]);
    }

    /**
     * Services Management
     */
    public function services()
    {
        $services = \App\Modules\CreativeLifestyle\Models\Service::latest()->paginate(10);
        return view('admin.categories.creative-lifestyle.services', [
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
            'services' => $services,
        ]);
    }

    /**
     * Bookings Management
     */
    public function bookings()
    {
        $bookings = \App\Modules\CreativeLifestyle\Models\Booking::latest()->paginate(10);
        return view('admin.categories.creative-lifestyle.bookings', [
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
            'bookings' => $bookings,
        ]);
    }

    /**
     * Providers Management
     */
    public function providers()
    {
        $providers = \App\Modules\CreativeLifestyle\Models\Provider::latest()->paginate(10);
        return view('admin.categories.creative-lifestyle.providers', [
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
            'providers' => $providers,
        ]);
    }

    /**
     * Products Management
     */
    public function products()
    {
        return view('admin.categories.creative-lifestyle.products', [
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
        ]);
    }

    /**
     * Clients Management
     */
    public function clients()
    {
        return view('admin.categories.creative-lifestyle.clients', [
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
        ]);
    }

    /**
     * Reports & Analytics
     */
    public function reports()
    {
        return view('admin.categories.creative-lifestyle.reports', [
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
        ]);
    }

    /**
     * Payments Management
     */
    public function payments()
    {
        return view('admin.categories.creative-lifestyle.payments', [
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
        ]);
    }

    /**
     * Reviews Management
     */
    public function reviews()
    {
        return view('admin.categories.creative-lifestyle.reviews', [
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
        ]);
    }

    /**
     * Category Settings
     */
    public function settings()
    {
        return view('admin.categories.creative-lifestyle.settings', [
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
        ]);
    }
}
