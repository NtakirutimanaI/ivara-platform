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

    public function users()
    {
        return view('super_admin.users.index');
    }

    // --- Category Management Pages ---
    public function categories()
    {
        return view('super_admin.categories.index');
    }

    public function createCategory()
    {
        return view('super_admin.categories.create');
    }

    public function storeCategory(\Illuminate\Http\Request $request)
    {
        // Validation would go here
        // \App\Models\Category::create($request->all());
        
        // For now, redirect with success to simulate creation until migration is run
        return redirect()->route('super_admin.categories.index')->with('success', 'Category created successfully!');
    }

    public function showCategory($slug)
    {
        return view('super_admin.categories.show', compact('slug'));
    }

    public function editCategory($slug)
    {
        // In a real app, fetch category by slug: $category = Category::where('slug', $slug)->firstOrFail();
        // Here we pass the slug to the view to mock the data
        return view('super_admin.categories.edit', compact('slug'));
    }

    public function manageCategories()
    {
        return view('super_admin.categories.manage');
    }

    // --- Admin Management ---
    public function indexAdmins()
    {
        return view('super_admin.admins.index');
    }

    public function storeAdmin(Request $request)
    {
        // Validation & Creation Logic would go here
        
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'New administrator account created successfully.',
                'admin' => [
                    'id' => rand(1000, 9999),
                    'name' => $request->input('name', 'New Admin'),
                    'role' => $request->input('role', 'Admin'),
                    'email' => $request->input('email', 'email@test.com'),
                    'status' => 'online',
                    'tasks' => 0
                ]
            ]);
        }
        
        return redirect()->route('super_admin.admins.index')->with('success', 'New administrator account created successfully.');
    }

    public function assignAdmins()
    {
        return view('super_admin.admins.assign');
    }

    public function messageAdmin(Request $request, $id)
    {
        //Logic to send message would go here
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Message sent successfully.']);
        }
        return back()->with('success', 'Message sent successfully to the administrator.');
    }

    public function suspendAdmin(Request $request, $id)
    {
        // Logic to toggle status
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Administrator status updated.']);
        }
        return back()->with('success', 'Administrator status updated successfully.');
    }

    public function showAdmin($id)
    {
        // In real app, findOrFail($id)
        return view('super_admin.admins.show', compact('id'));
    }

    public function editAdmin($id)
    {
        // In real app, findOrFail($id)
        return view('super_admin.admins.edit', compact('id'));
    }

    public function updateAdmin(Request $request, $id)
    {
        // Validate and update

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true, 
                'message' => 'Administrator account updated successfully.'
            ]);
        }

        return redirect()->route('super_admin.admins.index')->with('success', 'Administrator account updated.');
    }

    // --- Analytics ---
    public function analytics()
    {
        return view('super_admin.analytics.index');
    }

    // --- Billing ---
    public function billingRules()
    {
        return view('super_admin.billing.rules');
    }

    // --- Settings ---
    public function settings()
    {
        return view('super_admin.settings.index');
    }

    // --- Other Sidebar Pages (Previously incorrectly pointing to dashboard) ---
    public function marketplace() { return view('super_admin.marketplace.index'); }
    public function businesses() { return view('super_admin.businesses.index'); }
    public function licenses() { return view('super_admin.licenses.index'); }
    public function roles() { return view('super_admin.roles.index'); }
    public function services() { return view('super_admin.services.index'); }
    public function courses() { return view('super_admin.courses.index'); }
    public function payments() { return view('super_admin.payments.index'); }
    public function invoices() { return view('super_admin.invoices.index'); }
    public function auditLogs() { return view('super_admin.logs.audit'); }
    public function support() { return view('super_admin.support.index'); }
    
    // Subscriptions
    public function subPlans() { return view('super_admin.subscriptions.plans'); }
    public function subActive() { return view('super_admin.subscriptions.active'); }
    public function subPayments() { return view('super_admin.subscriptions.payments'); }
}
