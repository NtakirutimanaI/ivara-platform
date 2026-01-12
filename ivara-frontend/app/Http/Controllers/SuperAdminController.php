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

    public function showUser($id)
    {
        $user = $this->superAdminService->findUserById($id);
        return view('super_admin.users.show', compact('user'));
    }

    public function banUser(Request $request, $id)
    {
        $user = $this->superAdminService->updateUserStatus($id, 'banned');
        
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'User account has been restricted successfully.',
                'status' => 'banned'
            ]);
        }

        return back()->with('success', 'User banned successfully.');
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
                 ['id' => 8, 'name' => 'Legal & Professional', 'slug' => 'legal-professional', 'status' => 'Active', 'subs' => 4, 'providers' => 45, 'color' => '#34495e', 'icon' => 'fas fa-gavel'],
                 ['id' => 9, 'name' => 'Other Services', 'slug' => 'other-services', 'status' => 'Active', 'subs' => 3, 'providers' => 30, 'color' => '#7f8c8d', 'icon' => 'fas fa-concierge-bell'],
            ];
            session(['mock_categories' => $initial]);
        }
        return session('mock_categories');
    }

    private function getMockUsers($roleKey)
    {
        $sessionKey = 'mock_' . $roleKey;

        if (!session()->has($sessionKey)) {
            $users = [];
            $categories = $this->getMockCategories();
            
            // Exact Rwandan Personas from documentation.txt (2 per category ONLY)
            $rwandanPersonas = [
                'Technical & Repair' => [
                    ['name' => 'Jean Pierre MUGABO', 'email' => 'mugabo.jp@ivara.com', 'role' => 'Client', 'phone' => '0788123456'],
                    ['name' => 'Alain NIYONZIMA', 'email' => 'niyonzima.alain@ivara.com', 'role' => 'Provider', 'phone' => '0788654321']
                ],
                'Creative & Lifestyle' => [
                    ['name' => 'Clarisse UMUTONI', 'email' => 'umutoni.c@ivara.com', 'role' => 'Client', 'phone' => '0788111222'],
                    ['name' => 'David GAKWAYA', 'email' => 'gakwaya.d@ivara.com', 'role' => 'Provider', 'phone' => '0788333444']
                ],
                'Transport & Travel' => [
                    ['name' => 'Emmanuel HABIMANA', 'email' => 'habimana.e@ivara.com', 'role' => 'Client', 'phone' => '0788555666'],
                    ['name' => 'Fabrice KAMANZI', 'email' => 'kamanzi.f@ivara.com', 'role' => 'Provider', 'phone' => '0788777888']
                ],
                'Food, Fashion & Events' => [
                    ['name' => 'Grace UWAMAHORO', 'email' => 'uwamahoro.g@ivara.com', 'role' => 'Client', 'phone' => '0788999000'],
                    ['name' => 'Honoré RUKUNDO', 'email' => 'rukundo.h@ivara.com', 'role' => 'Provider', 'phone' => '0782123123']
                ],
                'Education & Knowledge' => [
                    ['name' => 'Innocent NTAKIRUTIMANA', 'email' => 'ntakirutimana.i@ivara.com', 'role' => 'Client', 'phone' => '0783456456'],
                    ['name' => 'Julienne MUKARUGWIZA', 'email' => 'mukarugwiza.j@ivara.com', 'role' => 'Provider', 'phone' => '0784567567']
                ],
                'Agriculture & Environment' => [
                    ['name' => 'Kevin KALISA', 'email' => 'kalisa.k@ivara.com', 'role' => 'Client', 'phone' => '0785678678'],
                    ['name' => 'Lydia UMULISA', 'email' => 'umulisa.l@ivara.com', 'role' => 'Provider', 'phone' => '0786789789']
                ],
                'Media & Entertainment' => [
                    ['name' => 'Moses IRADUKUNDA', 'email' => 'iradukunda.m@ivara.com', 'role' => 'Client', 'phone' => '0787890890'],
                    ['name' => 'Nancy UWASE', 'email' => 'uwase.n@ivara.com', 'role' => 'Provider', 'phone' => '0788901901']
                ],
                'Legal & Professional' => [
                    ['name' => 'Olivier NDAYISHIMIYE', 'email' => 'ndayishimiye.o@ivara.com', 'role' => 'Client', 'phone' => '0789012012'],
                    ['name' => 'Patricia MUTONIWA', 'email' => 'mutoniwa.p@ivara.com', 'role' => 'Provider', 'phone' => '0722123456']
                ],
                'Other Services' => [
                    ['name' => 'Quentin GASANA', 'email' => 'gasana.q@ivara.com', 'role' => 'Client', 'phone' => '0733123456'],
                    ['name' => 'Rose MUKESHIMANA', 'email' => 'mukeshimana.r@ivara.com', 'role' => 'Provider', 'phone' => '0788123111']
                ],
            ];

            // Rwandan Management Staff (from documentation.txt)
            $rwandanMgmt = [ 
                'Technical & Repair' => ['Admin' => 'Jean Bosco Niyonsaba', 'Manager' => 'Mutoni Alice', 'Supervisor' => 'Karasira Eric'],
                'Creative & Lifestyle' => ['Admin' => 'Uwimana Marie', 'Manager' => 'Habimana Innocent', 'Supervisor' => 'Umutoniwase Solange'],
                'Transport & Travel' => ['Admin' => 'Gakuba Benjamin', 'Manager' => 'Murekatete Claudine', 'Supervisor' => 'Ishimwe Didier'],
                'Food, Fashion & Events' => ['Admin' => 'Mukansanga Salome', 'Manager' => 'Bizimana Jean de Dieu', 'Supervisor' => 'Uwera Beatrice'],
                'Education & Knowledge' => ['Admin' => 'Ndayisaba Fabrice', 'Manager' => 'Mukandutiye Seraphine', 'Supervisor' => 'Rutayisire David'],
                'Agriculture & Environment' => ['Admin' => 'Uwizeye Claudine', 'Manager' => 'Kalisa John', 'Supervisor' => 'Mutesi Divine'],
                'Media & Entertainment' => ['Admin' => 'Jean Damascene Ntabanganyimana', 'Manager' => 'Nyirahabimana Speciose', 'Supervisor' => 'Manzi Olivier'],
                'Legal & Professional' => ['Admin' => 'Umubyeyi Diane', 'Manager' => 'Nkurunziza Pascal', 'Supervisor' => 'Mugenzi Aimable'],
                'Other Services' => ['Admin' => 'Uwimana Josiane', 'Manager' => 'Tuyishime Innocent', 'Supervisor' => 'Karasira Benjamin'],
            ];

            foreach($categories as $cat) {
                 $catName = $cat['name'];
                 
                 if ($roleKey == 'users') {
                     // Add BOTH Client and Provider from documentation for this category
                     $personas = $rwandanPersonas[$catName] ?? [];
                     foreach ($personas as $persona) {
                         $users[] = [
                            'id' => rand(1000, 9999),
                            'name' => $persona['name'],
                            'email' => $persona['email'],
                            'role' => $persona['role'],
                            'category' => $catName,
                            'status' => 'online',
                            'phone' => $persona['phone'],
                            'last_login' => rand(1, 12) . ' hours ago',
                            'tasks' => 0
                         ];
                     }
                 } else {
                     // Add specific Management role for this category
                     $roleTitle = match($roleKey) {
                        'managers' => 'Manager',
                        'supervisors' => 'Supervisor',
                        default => 'Admin'
                     };
                     
                     $name = $rwandanMgmt[$catName][$roleTitle] ?? "Staff " . $roleTitle;
                     
                     // Generate email based on documentation pattern if not explicitly mapped
                     $emailName = strtolower(str_replace(' ', '.', $name));
                     $catSlug = strtolower(str_replace([' ', '&'], '', $catName));
                     $email = $emailName . '.' . strtolower($roleTitle) . '.' . $catSlug . '@ivara.rw';

                     $users[] = [
                        'id' => rand(100, 999),
                        'name' => $name,
                        'email' => $email,
                        'role' => $roleTitle,
                        'category' => $catName,
                        'status' => 'online',
                        'last_login' => rand(1, 48) . ' mins ago',
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

        $data = [
            'admins' => $admins,
            'managers' => $managers,
            'supervisors' => $supervisors,
            'admins_flat' => $admins,
            'managers_flat' => $managers,
            'supervisors_flat' => $supervisors,
        ];

        return view('super_admin.performance.index', $data);
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
        $overview = $this->superAdminService->getSystemOverview();
        
        $realUsers = [];
        // For 'users' page, we force mock data to strictly adhere to the documentation personas (2 per category)
        if ($roleKey !== 'users') {
            if ($roleKey === 'admins') {
                $rolesToFetch = ['admin'];
                $realUsers = $this->superAdminService->getUsersByRole($rolesToFetch);
            } else if ($roleKey === 'managers') {
                $rolesToFetch = ['manager'];
                $realUsers = $this->superAdminService->getUsersByRole($rolesToFetch);
            } else if ($roleKey === 'supervisors') {
                $rolesToFetch = ['supervisor'];
                $realUsers = $this->superAdminService->getUsersByRole($rolesToFetch);
            }
        }
        
        if (count($realUsers) > 0) {
            $allUsers = collect($realUsers)->map(function($u) {
                $u = (object) $u;
                return [
                    'id' => $u->id ?? $u->_id ?? null,
                    'name' => $u->name ?? 'Unknown',
                    'email' => $u->email ?? 'no-email@ivara.com',
                    'role' => ucfirst($u->role ?? 'User'),
                    'category' => $u->category ?? 'General',
                    'status' => $u->status ?? 'online',
                    'phone' => $u->phone ?? $u->phoneNumber ?? '--',
                    'last_login' => isset($u->last_login) ? \Carbon\Carbon::parse($u->last_login)->diffForHumans() : 'Never',
                    'tasks' => 0
                ];
            })->toArray();
        } else {
            // Fallback (or forced for users page) to mock data
            $allUsers = $this->getMockUsers($roleKey);
        }

        $allCategories = $this->getMockCategories();
        $categoryMap = collect($allCategories)->pluck('name', 'slug')->toArray();
        $reverseCategoryMap = array_flip($categoryMap);

        $grouped = [];
        foreach($allUsers as $u) {
            $rawCat = $u['category'] ?: 'General';
            // Try to find the slug if it's a name, or name if it's a slug
            $catSlug = $reverseCategoryMap[$rawCat] ?? (str_contains($rawCat, ' ') ? \Illuminate\Support\Str::slug($rawCat) : $rawCat);
            $catName = $categoryMap[$catSlug] ?? $rawCat;
            
            $u['category_slug'] = $catSlug;
            $u['category_name'] = $catName;
            
            $grouped[$catSlug][] = $u;
        }

        // Add "General" to categories if not present but has users
        if (isset($grouped['general']) && !collect($allCategories)->contains('slug', 'general')) {
            $allCategories[] = ['id' => 99, 'name' => 'General', 'slug' => 'general', 'icon' => 'fas fa-folder-open'];
        }

        $data = [
            'categories' => $allCategories,
            'admins' => $grouped,
            'users' => $grouped,
            'admins_flat' => $allUsers, // Flat list for analytical pages
            'users_flat' => $allUsers,
            'overview' => $overview
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
    public function roles() {
        $roles = [
            [
                'id' => 1,
                'name' => 'Super Admin',
                'slug' => 'super_admin',
                'description' => 'Full system access, including security and global configurations.',
                'users_count' => 3,
                'permissions' => ['full_access', 'manage_logs', 'system_settings'],
                'color' => '#ef4444',
                'badge' => 'System'
            ],
            [
                'id' => 2,
                'name' => 'Admin',
                'slug' => 'admin',
                'description' => 'Manages platform categories, staff assignments, and high-level reports.',
                'users_count' => 18,
                'permissions' => ['manage_users', 'view_analytics', 'moderate_content'],
                'color' => '#f59e0b',
                'badge' => 'Management'
            ],
            [
                'id' => 3,
                'name' => 'Manager',
                'slug' => 'manager',
                'description' => 'Oversees service sectors and manages regional supervisor teams.',
                'users_count' => 42,
                'permissions' => ['assign_tasks', 'approve_applications', 'view_reports'],
                'color' => '#3b82f6',
                'badge' => 'Ops'
            ],
            [
                'id' => 4,
                'name' => 'Supervisor',
                'slug' => 'supervisor',
                'description' => 'On-the-ground verification of tasks and quality assurance.',
                'users_count' => 115,
                'permissions' => ['verify_completion', 'field_checks', 'update_status'],
                'color' => '#10b981',
                'badge' => 'Field'
            ],
            [
                'id' => 5,
                'name' => 'Provider',
                'slug' => 'provider',
                'description' => 'Professional service entities fulfilling platform requests.',
                'users_count' => 1240,
                'permissions' => ['manage_services', 'receive_payouts', 'fulfill_orders'],
                'color' => '#8b5cf6',
                'badge' => 'Partner'
            ],
            [
                'id' => 6,
                'name' => 'Client',
                'slug' => 'client',
                'description' => 'End users who request and consume services via the platform.',
                'users_count' => 5800,
                'permissions' => ['create_orders', 'view_history', 'chat_providers'],
                'color' => '#6366f1',
                'badge' => 'User'
            ]
        ];

        return view('super_admin.roles.index', compact('roles'));
    }
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
