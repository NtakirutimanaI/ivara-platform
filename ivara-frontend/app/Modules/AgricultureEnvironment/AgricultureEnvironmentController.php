<?php

namespace App\Modules\AgricultureEnvironment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AgricultureEnvironmentController extends Controller
{
    protected $categoryName = 'Agriculture & Environment';
    protected $categorySlug = 'agriculture-environment';
    protected $categoryIcon = 'fa-leaf';
    protected $categoryColor = '#4CAF50';

    public function index()
    {
        $stats = [
            'total_services' => 0,
            'total_bookings' => 0,
            'total_providers' => 0,
            'total_products' => 0,
            'active_projects' => 0,
            'total_revenue' => 0,
        ];

        return view('admin.categories.agriculture-environment.index', [
            'stats' => $stats,
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
            'categoryIcon' => $this->categoryIcon,
            'categoryColor' => $this->categoryColor,
        ]);
    }

    public function services()
    {
        return view('admin.categories.agriculture-environment.services', [
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
        ]);
    }

    public function bookings()
    {
        return view('admin.categories.agriculture-environment.bookings', [
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
        ]);
    }

    public function providers()
    {
        return view('admin.categories.agriculture-environment.providers', [
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
        ]);
    }

    public function products()
    {
        return view('admin.categories.agriculture-environment.products', [
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
        ]);
    }

    public function clients()
    {
        return view('admin.categories.agriculture-environment.clients', [
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
        ]);
    }

    public function reports()
    {
        return view('admin.categories.agriculture-environment.reports', [
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
        ]);
    }

    public function payments()
    {
        return view('admin.categories.agriculture-environment.payments', [
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
        ]);
    }

    public function reviews()
    {
        return view('admin.categories.agriculture-environment.reviews', [
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
        ]);
    }

    public function settings()
    {
        return view('admin.categories.agriculture-environment.settings', [
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
        ]);
    }
}
