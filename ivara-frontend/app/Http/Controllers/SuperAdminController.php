<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SuperAdminService;
use App\Models\User;

class SuperAdminController extends Controller
{
    protected $superAdminService;

    public function __construct(SuperAdminService $superAdminService)
    {
        $this->superAdminService = $superAdminService;
    }

    public function index()
    {
        // Fetch System Overview Stats from API
        $overview = $this->superAdminService->getSystemOverview();
        
        // Detailed breakdowns are now included in the overview data from API
        $role_counts = $overview['role_counts'] ?? [];

        // Pass to view
        return view('super_admin.index', compact('overview', 'role_counts'));
    }

    public function credentials()
    {
        return view('super_admin.credentials');
    }
}
