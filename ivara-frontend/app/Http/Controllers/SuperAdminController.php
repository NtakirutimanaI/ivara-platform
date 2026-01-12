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
        
        // Update mock session too if it exists
        if (session()->has('mock_users')) {
            $users = session('mock_users');
            foreach($users as &$u) {
                if ($u['id'] == $id) { $u['status'] = 'banned'; break; }
            }
            session(['mock_users' => $users]);
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'User account has been restricted successfully.',
                'status' => 'banned'
            ]);
        }

        return back()->with('success', 'User banned successfully.');
    }

    public function updateGeneralUser(Request $request, $id)
    {
        $users = $this->getMockUsers('users');
        $updatedUser = null;
        foreach($users as &$u) {
            if ($u['id'] == $id) {
                $u['name'] = $request->input('name');
                $u['email'] = $request->input('email');
                $u['role'] = $request->input('role');
                $u['status'] = $request->input('status');
                $updatedUser = $u;
                break;
            }
        }
        session(['mock_users' => $users]);
        
        return response()->json([
            'success' => true,
            'message' => 'User profile updated successfully.',
            'user' => $updatedUser
        ]);
    }

    public function deleteGeneralUser($id)
    {
        $users = $this->getMockUsers('users');
        $users = collect($users)->filter(fn($u) => $u['id'] != $id)->values()->toArray();
        session(['mock_users' => $users]);

        return response()->json([
            'success' => true,
            'message' => 'User account deleted successfully.'
        ]);
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
        $isMgmt = in_array($roleKey, ['admins', 'managers', 'supervisors']);
        $expectedCount = $isMgmt ? 14 : 18;

        // Force re-generation if session is missing or significantly mismatched/empty
        if (!session()->has($sessionKey) || count(session($sessionKey)) < $expectedCount) {
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

            // Rwandan Management Staff (Expanded to exactly 14 per tier)
            $rwandanMgmt = [ 
                ['Admin' => 'Jean Bosco Niyonsaba', 'Manager' => 'Mutoni Alice', 'Supervisor' => 'Karasira Eric'],
                ['Admin' => 'Uwimana Marie', 'Manager' => 'Habimana Innocent', 'Supervisor' => 'Umutoniwase Solange'],
                ['Admin' => 'Gakuba Benjamin', 'Manager' => 'Murekatete Claudine', 'Supervisor' => 'Ishimwe Didier'],
                ['Admin' => 'Mukansanga Salome', 'Manager' => 'Bizimana Jean de Dieu', 'Supervisor' => 'Uwera Beatrice'],
                ['Admin' => 'Ndayisaba Fabrice', 'Manager' => 'Mukandutiye Seraphine', 'Supervisor' => 'Rutayisire David'],
                ['Admin' => 'Uwizeye Claudine', 'Manager' => 'Kalisa John', 'Supervisor' => 'Mutesi Divine'],
                ['Admin' => 'Jean Damascene Ntabanganyimana', 'Manager' => 'Nyirahabimana Speciose', 'Supervisor' => 'Manzi Olivier'],
                ['Admin' => 'Umubyeyi Diane', 'Manager' => 'Nkurunziza Pascal', 'Supervisor' => 'Mugenzi Aimable'],
                ['Admin' => 'Uwimana Josiane', 'Manager' => 'Tuyishime Innocent', 'Supervisor' => 'Karasira Benjamin'],
                ['Admin' => 'Rwigema Silas', 'Manager' => 'Umutoni Fiona', 'Supervisor' => 'Niyonzima Placide'],
                ['Admin' => 'Kayitesi Hope', 'Manager' => 'Ntaganda Fred', 'Supervisor' => 'Mukeshimana Marie'],
                ['Admin' => 'Gatera Kevin', 'Manager' => 'Uwayezu Phiona', 'Supervisor' => 'Ndimbati Salva'],
                ['Admin' => 'Ishimwe Grace', 'Manager' => 'Rukundo Regis', 'Supervisor' => 'Uwamahoro Betty'],
                ['Admin' => 'Nteziryayo Paul', 'Manager' => 'Kamanzi Robert', 'Supervisor' => 'Tuyisenge Chantal'],
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
                    // Add all 14 Management roles exactly once
                    $roleTitle = match($roleKey) {
                        'managers' => 'Manager',
                        'supervisors' => 'Supervisor',
                        default => 'Admin'
                    };
                    
                    foreach ($rwandanMgmt as $index => $staff) {
                        $cat = $categories[$index % count($categories)];
                        $users[] = [
                           'id' => rand(100, 999),
                           'name' => $staff[$roleTitle],
                           'email' => strtolower(str_replace(' ', '.', $staff[$roleTitle])) . '@ivara.com',
                           'role' => $roleTitle,
                           'category' => $cat['name'],
                           'status' => 'online',
                           'phone' => '078' . rand(1111111, 9999999),
                           'last_login' => rand(1, 48) . ' mins ago',
                           'tasks' => rand(0, 5)
                        ];
                    }
                    break; 
                }
            }
            session([$sessionKey => $users]);
        }
        return session($sessionKey);
    }

    public function indexAdmins() {
        return $this->genericIndex('admins', 'super_admin.admins.index');
    }
    public function indexManagers() {
        return $this->genericIndex('managers', 'super_admin.managers.index');
    }
    public function indexSupervisors() {
        return $this->genericIndex('supervisors', 'super_admin.supervisors.index');
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

    public function storeManager(Request $request) {
        return $this->genericStore($request, 'managers', 'super_admin.managers.index');
    }
    public function editManager($id) {
        return $this->genericEdit($id, 'managers', 'super_admin.managers.edit');
    }
    public function updateManager(Request $request, $id) {
        return $this->genericUpdate($request, $id, 'managers', 'super_admin.managers.index'); 
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
        
        // Fetch Real Data First
        $roleToFetch = match($roleKey) {
            'admins' => ['admin'],
            'managers' => ['manager'],
            'supervisors' => ['supervisor'],
            'users' => ['client', 'provider'],
            default => []
        };
        
        $realUsers = [];
        if (!empty($roleToFetch)) {
            $realUsers = $this->superAdminService->getUsersByRole($roleToFetch);
        }

        $normalizedReal = collect($realUsers)->map(function($u) {
            $uArr = (array) $u;
            return [
                'id' => $uArr['id'] ?? $uArr['_id'] ?? rand(100000, 999999),
                'name' => $uArr['name'] ?? 'Real Entity',
                'email' => $uArr['email'] ?? 'api@ivara.com',
                'role' => ucfirst($uArr['role'] ?? 'User'),
                'category' => $uArr['category'] ?? 'General',
                'status' => $uArr['status'] ?? 'online',
                'phone' => $uArr['phone'] ?? $uArr['phoneNumber'] ?? '--',
                'last_login' => isset($uArr['last_login']) ? \Carbon\Carbon::parse($uArr['last_login'])->diffForHumans() : 'Just now',
                'tasks' => rand(0, 10)
            ];
        })->toArray();

        // Merge with Mock Personas to ensure high population
        if ($roleKey === 'users') {
            $mockBase = array_merge(
                $this->getMockUsers('admins'),
                $this->getMockUsers('managers'),
                $this->getMockUsers('supervisors'),
                $this->getMockUsers('users')
            );
        } else {
            $mockBase = $this->getMockUsers($roleKey);
        }

        // Deduplicate and Merge: Real data wins on ID collision
        $allUsers = array_merge($mockBase, $normalizedReal);
        $allUsers = collect($allUsers)->unique('email')->values()->toArray();

        // Clean up: Ensure $allUsers is always a collection for easier mapping
        $allUsers = collect($allUsers)->values()->toArray();

        $allCategories = $this->getMockCategories();
        $categoryMap = collect($allCategories)->pluck('name', 'slug')->toArray();
        $reverseCategoryMap = array_flip($categoryMap);

        $roleDefinitions = $this->superAdminService->getRoles();
        if (empty($roleDefinitions)) {
            $roleDefinitions = $this->getMockRoles();
        }
        $roleSlugMap = collect($roleDefinitions)->pluck('slug', 'name')->toArray();

        $grouped = [];
        foreach($allUsers as $u) {
            $rawCat = $u['category'] ?: 'General';
            // Try to find the slug if it's a name, or name if it's a slug
            $catSlug = $reverseCategoryMap[$rawCat] ?? (str_contains($rawCat, ' ') ? \Illuminate\Support\Str::slug($rawCat) : $rawCat);
            $catName = $categoryMap[$catSlug] ?? $rawCat;
            
            $u['category_slug'] = $catSlug;
            $u['category_name'] = $catName;
            $u['role_slug'] = $roleSlugMap[$u['role']] ?? \Illuminate\Support\Str::slug($u['role']);
            
            $grouped[$catSlug][] = $u;
        }

        // Add "General" to categories if not present but has users
        if (isset($grouped['general']) && !collect($allCategories)->contains('slug', 'general')) {
            $allCategories[] = ['id' => 99, 'name' => 'General', 'slug' => 'general', 'icon' => 'fas fa-folder-open'];
        }

        $data = [
            'categories' => $allCategories,
            'roles' => $roleDefinitions,
            // Provide data under the expected key for the view
            'admins' => $grouped, 
            'managers' => $grouped,
            'supervisors' => $grouped,
            'users' => $grouped,
            'admins_flat' => $allUsers,
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

    public function updateCommissionRates(Request $request)
    {
        $rules = session('billing_rules', []);
        
        $rules['standard_commission'] = $request->input('standard_commission', 15);
        $rules['premium_commission'] = $request->input('premium_commission', 10);
        $rules['product_commission'] = $request->input('product_commission', 5);
        
        session(['billing_rules' => $rules]);
        
        return response()->json([
            'success' => true,
            'message' => 'Commission rates updated successfully',
            'data' => $rules
        ]);
    }

    public function updateTaxPolicies(Request $request)
    {
        $rules = session('billing_rules', []);
        
        $rules['vat_enabled'] = $request->has('vat_enabled');
        $rules['transaction_fee'] = $request->input('transaction_fee', 0.50);
        $rules['payout_schedule'] = $request->input('payout_schedule', 'weekly');
        
        session(['billing_rules' => $rules]);
        
        return response()->json([
            'success' => true,
            'message' => 'Tax and fee policies saved successfully',
            'data' => $rules
        ]);
    }

    // --- Settings ---
    public function settings()
    {
        return view('super_admin.settings.index');
    }

    public function marketplace() { 
        $apiData = $this->superAdminService->getMarketplaceData();
        
        $products = !empty($apiData['products']) ? $apiData['products'] : $this->getMockProducts();
        $plans = !empty($apiData['plans']) ? $apiData['plans'] : $this->getMockPlans();
        $mediators = !empty($apiData['mediators']) ? $apiData['mediators'] : $this->getMockMediators();
        
        if (!empty($apiData['stats'])) {
            $stats = [
                'total_listings' => $apiData['stats']['totalListings'] ?? 0,
                'pending_reviews' => $apiData['stats']['pendingApprovals'] ?? 0,
                'total_sellers' => $apiData['stats']['verifiedSellers'] ?? 0,
                'marketplace_revenue' => $apiData['stats']['platformRevenue'] ?? 0
            ];
        } else {
            $stats = [
                'total_listings' => count($products),
                'pending_reviews' => collect($products)->where('status', 'Pending')->count(),
                'total_sellers' => collect($products)->pluck('seller_id')->unique()->count(),
                'marketplace_revenue' => collect($mediators)->sum('earnings') + 1250000 
            ];
        }

        $sellerSubscriptions = $this->getMockSellerSubscriptions();

        return view('super_admin.marketplace.index', compact('products', 'plans', 'mediators', 'stats', 'sellerSubscriptions')); 
    }

    private function getMockSellerSubscriptions() {
        if (!session()->has('mock_seller_subscriptions')) {
            $sellers = [
                ['name' => 'AgriGrow Rwanda Ltd', 'email' => 'contact@agrigrow.rw', 'plan' => 'Premium', 'status' => 'Active', 'revenue' => 450000, 'joined' => '2024-01-15'],
                ['name' => 'FashionHub Kigali', 'email' => 'info@fashionhub.rw', 'plan' => 'Standard', 'status' => 'Active', 'revenue' => 280000, 'joined' => '2024-02-20'],
                ['name' => 'TechRepair Pro', 'email' => 'support@techrepair.rw', 'plan' => 'Premium', 'status' => 'Active', 'revenue' => 520000, 'joined' => '2023-11-10'],
                ['name' => 'BuildMasters Construction', 'email' => 'admin@buildmasters.rw', 'plan' => 'Standard', 'status' => 'Active', 'revenue' => 380000, 'joined' => '2024-03-05'],
                ['name' => 'EduTech Solutions', 'email' => 'hello@edutech.rw', 'plan' => 'Basic', 'status' => 'Active', 'revenue' => 120000, 'joined' => '2024-04-12'],
                ['name' => 'Creative Media Hub', 'email' => 'contact@creativemedia.rw', 'plan' => 'Standard', 'status' => 'Active', 'revenue' => 310000, 'joined' => '2024-01-28'],
                ['name' => 'Transport Solutions Ltd', 'email' => 'info@transportsolutions.rw', 'plan' => 'Premium', 'status' => 'Active', 'revenue' => 680000, 'joined' => '2023-12-03'],
                ['name' => 'Legal Advisors Rwanda', 'email' => 'legal@advisors.rw', 'plan' => 'Basic', 'status' => 'Pending', 'revenue' => 85000, 'joined' => '2024-05-01'],
                ['name' => 'Food Delivery Express', 'email' => 'orders@foodexpress.rw', 'plan' => 'Standard', 'status' => 'Active', 'revenue' => 420000, 'joined' => '2024-02-14'],
                ['name' => 'Home Services Plus', 'email' => 'support@homeservices.rw', 'plan' => 'Premium', 'status' => 'Active', 'revenue' => 590000, 'joined' => '2023-10-22'],
                ['name' => 'Craft Artisans Collective', 'email' => 'hello@craftartisans.rw', 'plan' => 'Basic', 'status' => 'Active', 'revenue' => 95000, 'joined' => '2024-04-18'],
                ['name' => 'Auto Mechanics Pro', 'email' => 'service@automechanics.rw', 'plan' => 'Standard', 'status' => 'Active', 'revenue' => 340000, 'joined' => '2024-03-22'],
            ];
            session(['mock_seller_subscriptions' => $sellers]);
        }
        return session('mock_seller_subscriptions');
    }

    private function getMockProducts() {
        if (!session()->has('mock_marketplace_products')) {
            $products = [
                // Technical & Repair Services
                ['id' => 'prod_001', 'name' => 'Professional Laptop Repair & Maintenance', 'seller_name' => 'TechFix Rwanda', 'seller_id' => 'seller_001', 'category' => 'Technical & Repair', 'price' => 25000, 'status' => 'Active', 'plan' => 'Premium', 'created_at' => '2025-12-15'],
                ['id' => 'prod_002', 'name' => 'Smartphone Screen Replacement Service', 'seller_name' => 'Mobile Care Pro', 'seller_id' => 'seller_002', 'category' => 'Technical & Repair', 'price' => 15000, 'status' => 'Active', 'plan' => 'Standard', 'created_at' => '2025-12-20'],
                ['id' => 'prod_003', 'name' => 'Home Appliance Repair (Refrigerators, Washers)', 'seller_name' => 'HomeService Plus', 'seller_id' => 'seller_003', 'category' => 'Technical & Repair', 'price' => 35000, 'status' => 'Pending', 'plan' => 'Standard', 'created_at' => '2026-01-05'],
                
                // Creative & Lifestyle
                ['id' => 'prod_004', 'name' => 'Professional Wedding Photography Package', 'seller_name' => 'Lens & Light Studio', 'seller_id' => 'seller_004', 'category' => 'Creative & Lifestyle', 'price' => 150000, 'status' => 'Active', 'plan' => 'Premium', 'created_at' => '2025-11-10'],
                ['id' => 'prod_005', 'name' => 'Custom Logo Design & Branding', 'seller_name' => 'Creative Minds RW', 'seller_id' => 'seller_005', 'category' => 'Creative & Lifestyle', 'price' => 45000, 'status' => 'Active', 'plan' => 'Standard', 'created_at' => '2025-12-01'],
                ['id' => 'prod_006', 'name' => 'Event DJ Services - Weddings & Parties', 'seller_name' => 'DJ Maestro', 'seller_id' => 'seller_006', 'category' => 'Creative & Lifestyle', 'price' => 80000, 'status' => 'Pending', 'plan' => 'Basic', 'created_at' => '2026-01-08'],
                
                // Transport & Travel
                ['id' => 'prod_007', 'name' => 'Airport Transfer Service (Kigali)', 'seller_name' => 'Swift Rides Rwanda', 'seller_id' => 'seller_007', 'category' => 'Transport & Travel', 'price' => 20000, 'status' => 'Active', 'plan' => 'Premium', 'created_at' => '2025-10-15'],
                ['id' => 'prod_008', 'name' => 'Car Rental - SUV (Daily Rate)', 'seller_name' => 'DriveEasy RW', 'seller_id' => 'seller_008', 'category' => 'Transport & Travel', 'price' => 50000, 'status' => 'Active', 'plan' => 'Standard', 'created_at' => '2025-11-20'],
                ['id' => 'prod_009', 'name' => 'Motorcycle Taxi Service (Moto)', 'seller_name' => 'SafeMoto Network', 'seller_id' => 'seller_009', 'category' => 'Transport & Travel', 'price' => 2000, 'status' => 'Rejected', 'plan' => 'Basic', 'created_at' => '2025-12-28'],
                
                // Food, Fashion & Events
                ['id' => 'prod_010', 'name' => 'Catering Service - Corporate Events (50 pax)', 'seller_name' => 'Gourmet Delights RW', 'seller_id' => 'seller_010', 'category' => 'Food, Fashion & Events', 'price' => 250000, 'status' => 'Active', 'plan' => 'Premium', 'created_at' => '2025-09-05'],
                ['id' => 'prod_011', 'name' => 'Custom Tailoring - Traditional Imishanana', 'seller_name' => 'Heritage Fashion House', 'seller_id' => 'seller_011', 'category' => 'Food, Fashion & Events', 'price' => 35000, 'status' => 'Active', 'plan' => 'Standard', 'created_at' => '2025-11-12'],
                ['id' => 'prod_012', 'name' => 'Wedding Cake Design & Delivery', 'seller_name' => 'Sweet Celebrations', 'seller_id' => 'seller_012', 'category' => 'Food, Fashion & Events', 'price' => 120000, 'status' => 'Pending', 'plan' => 'Standard', 'created_at' => '2026-01-03'],
                
                // Education & Knowledge
                ['id' => 'prod_013', 'name' => 'Private Math Tutoring (Secondary Level)', 'seller_name' => 'EduMasters Rwanda', 'seller_id' => 'seller_013', 'category' => 'Education & Knowledge', 'price' => 30000, 'status' => 'Active', 'plan' => 'Basic', 'created_at' => '2025-10-20'],
                ['id' => 'prod_014', 'name' => 'IELTS Preparation Course (2 Months)', 'seller_name' => 'Global Language Institute', 'seller_id' => 'seller_014', 'category' => 'Education & Knowledge', 'price' => 180000, 'status' => 'Active', 'plan' => 'Premium', 'created_at' => '2025-11-01'],
                ['id' => 'prod_015', 'name' => 'Web Development Bootcamp (3 Months)', 'seller_name' => 'CodeCraft Academy', 'seller_id' => 'seller_015', 'category' => 'Education & Knowledge', 'price' => 350000, 'status' => 'Pending', 'plan' => 'Premium', 'created_at' => '2026-01-07'],
                
                // Media
                ['id' => 'prod_016', 'name' => 'Corporate Video Production Service', 'seller_name' => 'Vision Media Group', 'seller_id' => 'seller_016', 'category' => 'Media', 'price' => 200000, 'status' => 'Active', 'plan' => 'Premium', 'created_at' => '2025-08-15'],
                ['id' => 'prod_017', 'name' => 'Social Media Management (Monthly)', 'seller_name' => 'Digital Boost RW', 'seller_id' => 'seller_017', 'category' => 'Media', 'price' => 75000, 'status' => 'Active', 'plan' => 'Standard', 'created_at' => '2025-12-10'],
                
                // Agriculture
                ['id' => 'prod_018', 'name' => 'Organic Fertilizer Supply (50kg bags)', 'seller_name' => 'GreenGrow Supplies', 'seller_id' => 'seller_018', 'category' => 'Agriculture', 'price' => 18000, 'status' => 'Active', 'plan' => 'Standard', 'created_at' => '2025-11-25'],
                ['id' => 'prod_019', 'name' => 'Farm Irrigation System Installation', 'seller_name' => 'AgroTech Solutions', 'seller_id' => 'seller_019', 'category' => 'Agriculture', 'price' => 450000, 'status' => 'Pending', 'plan' => 'Premium', 'created_at' => '2026-01-02'],
                
                // Legal
                ['id' => 'prod_020', 'name' => 'Legal Consultation - Business Registration', 'seller_name' => 'Rwanda Legal Advisors', 'seller_id' => 'seller_020', 'category' => 'Legal', 'price' => 50000, 'status' => 'Active', 'plan' => 'Premium', 'created_at' => '2025-09-20'],
                ['id' => 'prod_021', 'name' => 'Contract Review & Drafting Service', 'seller_name' => 'LawPro Associates', 'seller_id' => 'seller_021', 'category' => 'Legal', 'price' => 75000, 'status' => 'Pending', 'plan' => 'Standard', 'created_at' => '2026-01-06'],
                
                // Construction
                ['id' => 'prod_022', 'name' => 'Residential House Construction (per sqm)', 'seller_name' => 'BuildRight Contractors', 'seller_id' => 'seller_022', 'category' => 'Construction', 'price' => 120000, 'status' => 'Active', 'plan' => 'Premium', 'created_at' => '2025-10-05'],
                ['id' => 'prod_023', 'name' => 'Plumbing Installation & Repair', 'seller_name' => 'PipeMasters RW', 'seller_id' => 'seller_023', 'category' => 'Construction', 'price' => 28000, 'status' => 'Active', 'plan' => 'Basic', 'created_at' => '2025-12-18'],
            ];
            
            session(['mock_marketplace_products' => $products]);
        }
        return session('mock_marketplace_products');
    }

    private function getMockPlans() {
        return [
            ['name' => 'Basic', 'price' => 10000, 'benefits' => '5 Listings, Standard Visibility'],
            ['name' => 'Standard', 'price' => 25000, 'benefits' => '20 Listings, Featured Badges'],
            ['name' => 'Premium', 'price' => 50000, 'benefits' => 'Unlimited Listings, Priority Search']
        ];
    }

    private function getMockMediators() {
        if (!session()->has('mock_marketplace_mediators')) {
            $mediators = [
                ['id' => 1, 'name' => 'Jean de Dieu', 'clients' => 12, 'level' => 'Basic', 'earnings' => 120000, 'requirement' => 20],
                ['id' => 2, 'name' => 'Marie Claire', 'clients' => 45, 'level' => 'Standard', 'earnings' => 450000, 'requirement' => 50],
                ['id' => 3, 'name' => 'Innocent K.', 'clients' => 105, 'level' => 'Premium', 'earnings' => 1250000, 'requirement' => 0]
            ];
            session(['mock_marketplace_mediators' => $mediators]);
        }
        return session('mock_marketplace_mediators');
    }

    public function productAction(Request $request, $id) {
        $action = $request->input('action'); // 'approve', 'reject', 'delete'
        $success = $this->superAdminService->moderateProduct($id, $action);

        if (!$success) {
            // Fallback to mock session if API fails
            $products = $this->getMockProducts();
            if ($action === 'delete') {
                $products = collect($products)->filter(fn($p) => $p['id'] != $id)->values()->toArray();
            } else {
                foreach($products as &$p) {
                    if ($p['id'] == $id) {
                        $p['status'] = ($action === 'approve') ? 'Active' : 'Rejected';
                        break;
                    }
                }
            }
            session(['mock_marketplace_products' => $products]);
        }

        return response()->json(['success' => true, 'message' => 'Marketplace listing updated.']);
    }

    public function upgradeSeller(Request $request)
    {
        $name = $request->input('name');
        $currentPlan = $request->input('current_plan');
        $email = $request->input('email');
        
        $planHierarchy = ['Basic' => 'Standard', 'Standard' => 'Premium'];
        $newPlan = $planHierarchy[$currentPlan] ?? $currentPlan;
        
        // Update seller subscription in session
        $sellers = $this->getMockSellerSubscriptions();
        foreach ($sellers as &$seller) {
            if ($seller['name'] === $name) {
                $seller['plan'] = $newPlan;
                $seller['upgraded_at'] = now()->toDateTimeString();
                break;
            }
        }
        session(['mock_seller_subscriptions' => $sellers]);
        
        return response()->json([
            'success' => true,
            'message' => "Successfully upgraded {$name} to {$newPlan} plan",
            'new_plan' => $newPlan
        ]);
    }

    public function generateSettlementReport(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        
        $mediators = $this->getMockMediators();
        $totalCommissions = collect($mediators)->sum('earnings');
        $totalClients = collect($mediators)->sum('clients');
        
        $reportData = [
            'period' => ['start' => $startDate, 'end' => $endDate],
            'total_commissions' => $totalCommissions,
            'total_clients' => $totalClients,
            'mediator_count' => count($mediators),
            'mediators' => $mediators,
            'generated_at' => now()->toDateTimeString()
        ];
        
        // Store report in session
        session(['last_settlement_report' => $reportData]);
        
        return response()->json([
            'success' => true,
            'message' => 'Settlement report generated successfully',
            'report' => $reportData
        ]);
    }

    public function auditMediator(Request $request)
    {
        $name = $request->input('name');
        $mediators = $this->getMockMediators();
        
        $mediator = collect($mediators)->firstWhere('name', $name);
        
        if (!$mediator) {
            return response()->json(['success' => false, 'message' => 'Mediator not found'], 404);
        }
        
        $auditData = [
            'mediator' => $mediator,
            'commission_rate' => 0.15,
            'avg_commission_per_client' => $mediator['earnings'] / max($mediator['clients'], 1),
            'last_payment' => now()->subDays(30)->format('M d, Y'),
            'status' => 'verified',
            'audited_at' => now()->toDateTimeString()
        ];
        
        // Store audit in session
        $audits = session('mediator_audits', []);
        $audits[$name] = $auditData;
        session(['mediator_audits' => $audits]);
        
        return response()->json([
            'success' => true,
            'message' => "Audit completed for {$name}",
            'audit' => $auditData
        ]);
    }
    public function licenses() { return view('super_admin.licenses.index'); }
    private function getMockRoles() {
        if (!session()->has('mock_roles')) {
            $initial = [
                [
                    'id' => 1,
                    'name' => 'Super Admin',
                    'slug' => 'super_admin',
                    'description' => 'Full system access, including security and global configurations. Yes',
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
            session(['mock_roles' => $initial]);
        }
        return session('mock_roles');
    }

    public function roles() {
        // High-Fidelity Session Synchronization: Prioritize session overrides for real-time mandate simulation
        $roles = session('mock_roles');
        
        if (empty($roles)) {
            $apiRoles = $this->superAdminService->getRoles();
            if (!empty($apiRoles)) {
                $roles = $apiRoles;
                session(['mock_roles' => $roles]);
            } else {
                $roles = $this->getMockRoles();
            }
        }
        
        // Dynamic Entity Synchronization: Calculate actual counts from session-based mock data
        $admins = $this->getMockUsers('admins');
        $managers = $this->getMockUsers('managers');
        $supervisors = $this->getMockUsers('supervisors');
        $generalUsers = $this->getMockUsers('users');

        foreach($roles as &$role) {
            $role['users_count'] = match($role['slug']) {
                'super_admin' => 1,
                'admin'       => count($admins),
                'manager'     => count($managers),
                'supervisor'  => count($supervisors),
                'provider'    => collect($generalUsers)->where('role', 'Provider')->count(),
                'client'      => collect($generalUsers)->where('role', 'Client')->count(),
                default       => $role['users_count'] ?? 0
            };

            // Ensure required keys for view safety
            $role['badge'] = $role['badge'] ?? 'Management';
            $role['color'] = $role['color'] ?? '#4F46E5';
            $role['description'] = $role['description'] ?? 'Platform role with standard access boundaries.';
        }

        return view('super_admin.roles.index', compact('roles'));
    }

    public function storeRole(Request $request) {
        $roles = $this->getMockRoles();
        $newRole = [
            'id' => count($roles) + 1,
            'name' => $request->name,
            'slug' => \Illuminate\Support\Str::slug($request->name),
            'description' => $request->description,
            'users_count' => 0,
            'permissions' => [],
            'color' => $request->color ?? '#4F46E5',
            'badge' => $request->badge ?? 'Operations'
        ];
        $roles[] = $newRole;
        session(['mock_roles' => $roles]);

        return response()->json(['success' => true, 'message' => 'Role provisioned successfully']);
    }

    public function updateRole(Request $request, $slug) {
        $roles = $this->getMockRoles();
        foreach($roles as &$role) {
            if ($role['slug'] === $slug) {
                $role['name'] = $request->name;
                $role['description'] = $request->description;
                $role['color'] = $request->color;
                $role['badge'] = $request->badge;
                break;
            }
        }
        session(['mock_roles' => $roles]);
        return response()->json(['success' => true, 'message' => 'Role mandate updated successfully']);
    }

    public function deleteRole($slug) {
        $roles = $this->getMockRoles();
        $roles = collect($roles)->filter(fn($r) => $r['slug'] !== $slug)->values()->toArray();
        session(['mock_roles' => $roles]);
        return response()->json(['success' => true, 'message' => 'Role enclave revoked successfully']);
    }

    public function syncPermissions(Request $request, $slug) {
        $roles = $this->getMockRoles();
        foreach($roles as &$role) {
            if ($role['slug'] === $slug) {
                $role['permissions'] = $request->permissions ?? [];
                break;
            }
        }
        session(['mock_roles' => $roles]);
        return response()->json(['success' => true, 'message' => 'Capability matrix synchronized successfully']);
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
