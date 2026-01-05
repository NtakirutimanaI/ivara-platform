<?php

namespace App\Modules\FoodFashion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FoodFashionController extends Controller
{
    protected $categoryName = 'Food & Fashion';
    protected $categorySlug = 'food-fashion';
    protected $categoryIcon = 'fa-utensils';
    protected $categoryColor = '#FF5722';

    public function index()
    {
        $stats = [
            'total_services' => 0,
            'total_bookings' => 0,
            'total_providers' => 0,
            'total_products' => 0,
            'pending_orders' => 0,
            'total_revenue' => 0,
        ];

        return view('admin.categories.food-fashion.index', [
            'stats' => $stats,
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
            'categoryIcon' => $this->categoryIcon,
            'categoryColor' => $this->categoryColor,
        ]);
    }

    public function services()
    {
        return view('admin.categories.food-fashion.services', [
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
        ]);
    }

    public function bookings()
    {
        return view('admin.categories.food-fashion.bookings', [
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
        ]);
    }

    public function providers()
    {
        return view('admin.categories.food-fashion.providers', [
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
        ]);
    }

    public function products()
    {
        return view('admin.categories.food-fashion.products', [
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
        ]);
    }

    public function clients()
    {
        return view('admin.categories.food-fashion.clients', [
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
        ]);
    }

    public function reports()
    {
        return view('admin.categories.food-fashion.reports', [
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
        ]);
    }

    public function payments()
    {
        return view('admin.categories.food-fashion.payments', [
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
        ]);
    }

    public function reviews()
    {
        return view('admin.categories.food-fashion.reviews', [
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
        ]);
    }

    public function settings()
    {
        return view('admin.categories.food-fashion.settings', [
            'categoryName' => $this->categoryName,
            'categorySlug' => $this->categorySlug,
        ]);
    }
}
