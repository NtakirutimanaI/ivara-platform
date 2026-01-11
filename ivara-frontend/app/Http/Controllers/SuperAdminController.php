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
        return $this->genericIndex('users', 'super_admin.users.index');
    }

    public function categories()
    {
        $categories = $this->getMockCategories();
        return view('super_admin.categories.index', compact('categories'));
    }

    public function createCategory()
    {
        return redirect()->route('super_admin.categories.index'); // Disable creation
    }

    public function storeCategory(\Illuminate\Http\Request $request)
    {
        return redirect()->route('super_admin.categories.index'); // Disable creation
    }

    public function showCategory($slug)
    {
        $categories = $this->getMockCategories();
        $category = collect($categories)->firstWhere('slug', $slug);
        
        if(!$category) {
            return redirect()->route('super_admin.categories.index')->with('error', 'Category not found');
        }

        return view('super_admin.categories.show', compact('category', 'slug'));
    }

    public function editCategory($slug)
    {
        $categories = $this->getMockCategories();
        $category = collect($categories)->firstWhere('slug', $slug);
        
        if(!$category) {
            return redirect()->route('super_admin.categories.index')->with('error', 'Category not found');
        }

        return view('super_admin.categories.edit', compact('category'));
    }

    public function updateCategory(Request $request, $slug)
    {
         $categories = $this->getMockCategories();
         
         $updated = false;
         $oldName = '';
         $newName = $request->input('name');

         foreach($categories as &$cat) {
             if($cat['slug'] == $slug) {
                 $oldName = $cat['name'];
                 $cat['name'] = $newName;
                 $cat['status'] = $request->input('status');
                 // Only update name and status as requested.
                 $updated = true;
                 break;
             }
         }

         if($updated) {
             session(['mock_categories' => $categories]);
             
             // Update related users in session to reflect category name change
             $roles = ['admins', 'managers', 'supervisors'];
             foreach($roles as $role) {
                 $key = 'mock_' . $role;
                 if(session()->has($key)) {
                     $users = session($key);
                     foreach($users as &$u) {
                         if($u['category'] === $oldName) {
                             $u['category'] = $newName;
                         }
                     }
                     session([$key => $users]);
                 }
             }

             return redirect()->route('super_admin.categories.index')->with('success', 'Category updated successfully');
         }

         return back()->with('error', 'Update failed');
    }

    public function manageCategories()
    {
        return view('super_admin.categories.manage');
    }

    // --- Admin Management (Session-based Mock Persistence) ---

    private function getMockCategories() {
        if (!session()->has('mock_categories')) {
            $initial = [
                 ['id' => 1, 'name' => 'Technical & Repair', 'slug' => 'technical-repair', 'status' => 'Active', 'subs' => 12, 'providers' => 150, 'color' => '#3498db', 'icon' => 'fas fa-tools'],
                 ['id' => 2, 'name' => 'Creative & Lifestyle', 'slug' => 'creative-lifestyle', 'status' => 'Active', 'subs' => 8, 'providers' => 120, 'color' => '#e91e63', 'icon' => 'fas fa-paint-brush'],
                 ['id' => 3, 'name' => 'Transport & Travel', 'slug' => 'transport-travel', 'status' => 'Active', 'subs' => 8, 'providers' => 320, 'color' => '#f1c40f', 'icon' => 'fas fa-car'],
                 ['id' => 4, 'name' => 'Food, Fashion & Events', 'slug' => 'food-fashion-events', 'status' => 'Active', 'subs' => 15, 'providers' => 210, 'color' => '#e67e22', 'icon' => 'fas fa-utensils'],
                 ['id' => 5, 'name' => 'Education & Knowledge', 'slug' => 'education-knowledge', 'status' => 'Active', 'subs' => 20, 'providers' => 95, 'color' => '#2ecc71', 'icon' => 'fas fa-graduation-cap'],
                 ['id' => 6, 'name' => 'Agriculture & Environment', 'slug' => 'agriculture-environment', 'status' => 'Active', 'subs' => 10, 'providers' => 400, 'color' => '#27ae60', 'icon' => 'fas fa-leaf'],
                 ['id' => 7, 'name' => 'Media & Entertainment', 'slug' => 'media-entertainment', 'status' => 'Active', 'subs' => 6, 'providers' => 60, 'color' => '#9b59b6', 'icon' => 'fas fa-film'],
                 ['id' => 8, 'name' => 'Legal & Professional', 'slug' => 'legal-professional', 'status' => 'Inactive', 'subs' => 5, 'providers' => 45, 'color' => '#34495e', 'icon' => 'fas fa-balance-scale'],
                 ['id' => 9, 'name' => 'Other Services', 'slug' => 'other-services', 'status' => 'Active', 'subs' => 4, 'providers' => 30, 'color' => '#95a5a6', 'icon' => 'fas fa-ellipsis-h'],
            ];
            session(['mock_categories' => $initial]);
        }
        return session('mock_categories');
    }

    private function getMockUsers($roleKey = 'admins')
    {
        $sessionKey = 'mock_' . $roleKey; // mock_admins, mock_managers, mock_supervisors, mock_users

        if (!session()->has($sessionKey)) {
            $users = [];
            $categories = $this->getMockCategories();
            $names = ['Sarah Connor', 'John Doe', 'Emily Zhang', 'Michael Bay', 'Jessica Alba', 'Robert Stark', 'Daenerys T', 'Bruce Wayne', 'Clark Kent'];
            
            // Customize role labels based on type
            $defaultRole = match($roleKey) {
                'managers' => 'Area Manager',
                'supervisors' => 'Field Supervisor',
                'users' => 'Client',
                default => 'Category Manager'
            };

            foreach($categories as $index => $cat) {
                 // Primary
                 $name = $names[$index % count($names)];
                 $id = rand(100, 999);
                 
                 // Hardcoded Admin User
                 if($roleKey == 'admins' && $cat['name'] == 'Technical & Repair' && $index == 0) {
                     $id = 8480; 
                     $name = "Innocent NTAKIRUTIMANA";
                 }

                 $role = $defaultRole;
                 if ($roleKey == 'users') {
                     // Mix of clients and providers for 'users' page
                     $role = ($index % 2 == 0) ? 'Client' : 'Provider';
                 }

                 $users[] = [
                    'id' => $id,
                    'name' => $name,
                    'email' => strtolower(explode(' ', $name)[0]) . '@ivara.com',
                    'role' => $role,
                    'category' => $cat['name'],
                    'status' => 'online',
                    'tasks' => rand(2, 15)
                 ];

                 // Secondary
                 if($index % 2 == 0) {
                     $secRole = 'Support ' . ucfirst(substr($roleKey, 0, -1));
                     if ($roleKey == 'users') $secRole = 'Provider';

                     $users[] = [
                        'id' => rand(2000, 3000),
                        'name' => 'Assistant ' . ($index+1),
                        'email' => 'assist'.($index+1).'@ivara.com',
                        'role' => $secRole,
                        'category' => $cat['name'],
                        'status' => 'offline',
                        'tasks' => 0
                    ];
                 }
            }
            session([$sessionKey => $users]);
        }
        return session($sessionKey);
    }

    // --- Admins ---
    public function indexAdmins() {
        return $this->genericIndex('admins', 'super_admin.admins.index');
    }
    public function storeAdmin(Request $request) {
        return $this->genericStore($request, 'admins', 'super_admin.admins.index');
    }
    public function editAdmin($id) {
        return $this->genericEdit($id, 'admins', 'super_admin.admins.edit');
    }
    public function updateAdmin(Request $request, $id) {
        return $this->genericUpdate($request, $id, 'admins', 'super_admin.admins.index');
    }
    public function messageAdmin($id) {
        return back()->with('success', 'Message sent successfully (Simulation).');
    }
    public function suspendAdmin($id) {
        return back()->with('success', 'Admin status updated (Simulation).');
    }

    // --- Managers ---
    public function indexManagers() {
        return $this->genericIndex('managers', 'super_admin.managers.index');
    }
    public function storeManager(Request $request) {
        return $this->genericStore($request, 'managers', 'super_admin.managers.index');
    }
    public function editManager($id) {
        return $this->genericEdit($id, 'managers', 'super_admin.managers.edit');
    }
    public function updateManager(Request $request, $id) {
        return $this->genericUpdate($request, $id, 'managers', 'super_admin.managers.index'); 
    }

    // --- Supervisors ---
    public function indexSupervisors() {
        return $this->genericIndex('supervisors', 'super_admin.supervisors.index');
    }
    public function storeSupervisor(Request $request) {
        return $this->genericStore($request, 'supervisors', 'super_admin.supervisors.index');
    }
    public function editSupervisor($id) {
        return $this->genericEdit($id, 'supervisors', 'super_admin.supervisors.edit');
    }
    public function updateSupervisor(Request $request, $id) {
        return $this->genericUpdate($request, $id, 'supervisors', 'super_admin.supervisors.index');
    }

    public function showAdmin($id) {
        return $this->genericShow($id, 'admins', 'super_admin.admins.show');
    }

    public function showManager($id) {
        return $this->genericShow($id, 'managers', 'super_admin.managers.show');
    }

    public function showSupervisor($id) {
        return $this->genericShow($id, 'supervisors', 'super_admin.supervisors.show');
    }

    // --- Performance Matrix ---
    public function performanceMatrix() {
        $admins = $this->getMockUsers('admins');
        $managers = $this->getMockUsers('managers');
        $supervisors = $this->getMockUsers('supervisors');

        return view('super_admin.performance.index', compact('admins', 'managers', 'supervisors'));
    }

    public function storeReview(Request $request) {
        $roleKey = $request->input('role_key');
        $userId = $request->input('user_id');
        $content = $request->input('review_content');
        $rating = $request->input('rating');

        $users = $this->getMockUsers($roleKey);
        foreach($users as &$user) {
            if($user['id'] == $userId) {
                $user['latest_review'] = $content;
                $user['rating'] = $rating;
                break;
            }
        }
        
        session(['mock_' . $roleKey => $users]);

        return response()->json([
            'success' => true,
            'message' => 'Review submitted successfully.'
        ]);
    }

    // --- Generic Logic for reusable Crud ---
    private function genericIndex($roleKey, $view) {
        $allUsers = $this->getMockUsers($roleKey);
        $categories = $this->getMockCategories();
        
        $grouped = [];
        foreach($allUsers as $u) {
            $grouped[$u['category']][] = $u;
        }

        $data = [
            'categories' => $categories,
            'admins' => $grouped, // Maintain for backward compatibility
            'users' => $grouped // Add for 'users' view
        ];

        return view($view, $data);
    }

    private function genericStore($request, $roleKey, $redirectRoute) {
        $newUser = [
            'id' => rand(10000, 99999),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'role' => $request->input('role') ?? ucfirst(substr($roleKey, 0, -1)),
            'category' => $this->mapSlugToName($request->input('category')),
            'status' => 'online',
            'tasks' => 0
        ];

        $users = $this->getMockUsers($roleKey);
        $users[] = $newUser;
        session(['mock_' . $roleKey => $users]);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'New team member created successfully.',
                'admin' => $newUser // Keep key 'admin' for JS compatibility
            ]);
        }
        
        return redirect()->route($redirectRoute)->with('success', 'Created successfully.');
    }

    private function genericEdit($id, $roleKey, $view) {
        $users = $this->getMockUsers($roleKey);
        $user = collect($users)->firstWhere('id', $id);
        
        if(!$user) {
            return back()->with('error', 'User not found');
        }

        // Pass as 'admin' to keep view compatibility
        return view($view, ['admin' => $user, 'id' => $id]);
    }

    private function genericUpdate($request, $id, $roleKey, $redirectRoute) {
        $users = $this->getMockUsers($roleKey);
        $updatedUser = null;

        foreach($users as &$u) {
            if($u['id'] == $id) {
                $u['name'] = $request->input('name');
                $u['email'] = $request->input('email');
                $u['role'] = $request->input('role');
                if($request->has('category')) {
                     $u['category'] = $this->mapSlugToName($request->input('category'));
                }
                $updatedUser = $u;
                break;
            }
        }
        session(['mock_' . $roleKey => $users]);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true, 
                'message' => 'Account updated successfully.',
                'admin' => $updatedUser
            ]);
        }

        return redirect()->route($redirectRoute)->with('success', 'Updated successfully.');
    }

    private function genericShow($id, $roleKey, $view) {
        $users = $this->getMockUsers($roleKey);
        $user = collect($users)->firstWhere('id', $id);
        
        if(!$user) {
            return back()->with('error', 'User not found');
        }

        return view($view, ['admin' => $user, 'id' => $id]);
    }

    // Helper to map select values (slugs) to display names used in array
    private function mapSlugToName($slug) {
        $map = [
            'technical-repair' => 'Technical & Repair',
            'creative-lifestyle' => 'Creative & Lifestyle',
            'transport-travel' => 'Transport & Travel',
            'food-fashion-events' => 'Food, Fashion & Events',
            'education-knowledge' => 'Education & Knowledge',
            'agriculture-environment' => 'Agriculture & Environment',
            'media-entertainment' => 'Media & Entertainment',
            'legal-professional' => 'Legal & Professional',
            'other-services' => 'Other Services'
        ];
        return $map[$slug] ?? 'Other Services';
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
