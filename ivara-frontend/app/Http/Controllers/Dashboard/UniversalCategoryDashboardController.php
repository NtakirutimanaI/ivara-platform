<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UniversalCategoryDashboardController extends Controller
{
    /**
     * Entry point for Category Dashboards
     */
    public function index(Request $request, $category)
    {
        $user = auth()->user();
        if (!$user) return redirect('/login');

        // Normalize inputs
        $role = strtolower($user->role);
        $catFull = str_replace('-', '_', $category); // e.g., technical_repair
        $catShort = explode('_', $catFull)[0];       // e.g., technical

        // Possible view paths to check
        $possibleViews = [
            "{$catFull}.{$role}.index",   // technical_repair.admin.index
            "{$catShort}.{$role}.index",  // technical.admin.index
            "{$catFull}.index",           // technical_repair.index
            "{$catShort}.index",          // technical.index
        ];

        foreach ($possibleViews as $viewName) {
            if (view()->exists($viewName)) {
                return view($viewName, [
                    'category' => $category,
                    'role' => $role,
                    'user' => $user
                ]);
            }
        }

        // Fallback to generic dashboard if specific one doesn't exist
        return view('dashboard.generic_category', [
            'categoryName' => ucwords(str_replace('-', ' ', $category)),
            'category' => $category,
            'role' => ucwords($role),
            'user' => $user
        ]);
    }
}
