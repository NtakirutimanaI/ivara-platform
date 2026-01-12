@extends('layouts.app')

@section('content')
<div class="dashboard-wrapper">
    <x-admin.header title="User Management" subtitle="Overview of all registered accounts across the platform">
    </x-admin.header>



    <!-- Main Content -->
    <div class="glass-panel mt-4 p-0">
        <div class="d-flex gap-3 p-3" style="min-height: 700px;">
            <!-- Left Sidebar Navigation -->
            <div class="user-management-sidebar">
                <div class="sidebar-inner">
                    <div class="sidebar-nav-list">
                        <button class="nav-item-premium active" data-category="all" data-label="All Categories">
                            <i class="fas fa-th-large"></i>
                            <span>All Categories</span>
                        </button>
                        @foreach($categories as $cat)
                        <button class="nav-item-premium" data-category="{{ $cat['slug'] }}" data-label="{{ $cat['name'] }}">
                            <i class="{{ $cat['icon'] }}"></i>
                            <span>{{ $cat['name'] }}</span>
                        </button>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Right Content Area -->
            <div class="user-management-content flex-grow-1 d-flex flex-column" style="min-width: 0;">
                
                <!-- 1. Stats Row -->
                <div class="d-flex align-items-center justify-content-center gap-3 mb-3">
                    <!-- Premium Page Size Selector -->
                    <div class="per-page-container shadow-sm">
                        <i class="fas fa-list-ol text-muted me-1" style="font-size: 0.75rem;"></i>
                        <label class="per-page-label mb-0">PER PAGE:</label>
                        <select id="perPageSelect" class="per-page-select">
                            <option value="5">5</option>
                            <option value="10" selected>10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                        </select>
                    </div>

                    <!-- System Metric Card -->
                    <div class="mini-stat-card">
                        <div class="stat-icon bg-light text-primary">
                            <i class="fas fa-users-cog"></i>
                        </div>
                        <div class="stat-content">
                            <span class="stat-label">System Users</span>
                            <span class="stat-value"><span id="visibleCountText">10</span> Participants</span>
                        </div>
                    </div>

                    <!-- Dynamic Category Card (Shows when selected) -->
                    <div id="activeCategoryCard" class="mini-stat-card d-none">
                        <div class="stat-icon" id="activeCatIcon" style="background: rgba(79, 70, 229, 0.1); color: #4F46E5;">
                            <i class="fas fa-th-large"></i>
                        </div>
                        <div class="stat-content">
                            <span class="stat-label" id="activeCatLabel">Category</span>
                            <span class="stat-value"><span id="activeCatCount">0</span> Users</span>
                        </div>
                    </div>
                </div>

                <!-- 2. Search Bar Row (Dedicated full-width row) -->
                <div class="mb-4">
                    <div class="search-container-premium w-100">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" id="userSearchInput" class="search-input-premium" placeholder="Search in this segment...">
                        <div class="search-kbd">
                            <i class="fas fa-command small opacity-50"></i>
                            <span>F</span>
                        </div>
                    </div>
                </div>

                <!-- 3. Advanced Filter Bar -->
                <div class="filter-bar-premium mb-4">
                    <div class="d-flex align-items-center justify-content-between w-100">
                        <div class="d-flex gap-2 flex-wrap" id="roleFilters">
                            <button class="btn-filter-premium active" data-role="all">
                                <i class="fas fa-users me-2"></i>All Roles
                            </button>
                            @foreach($roles as $role)
                            <button class="btn-filter-premium" data-role="{{ $role['slug'] }}">
                                <i class="fas {{ $role['slug'] == 'admin' ? 'fa-user-shield' : ($role['slug'] == 'manager' ? 'fa-user-cog' : ($role['slug'] == 'supervisor' ? 'fa-user-check' : 'fa-user-tag')) }} me-2"></i>{{ $role['name'] }}s
                            </button>
                            @endforeach
                        </div>
                        

                    </div>
                </div>

                    <div class="table-responsive">
                        <table class="table-custom" id="userTable">
                            <thead>
                                <tr>
                                    <th>User Identity</th>
                                    <th>Role</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Last Login</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $categorySlug => $categoryUsers)
                                    @foreach($categoryUsers as $user)
                                    <tr class="table-row" data-category="{{ $user['category_slug'] }}" data-role="{{ $user['role_slug'] }}" data-search="{{ strtolower($user['name'] . ' ' . $user['email'] . ' ' . $user['category_name']) }}">
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 40px; height: 40px; background: linear-gradient(135deg, #4F46E5 0%, #4338ca 100%) !important;">
                                                    {{ strtoupper(substr($user['name'], 0, 2)) }}
                                                </div>
                                                <div>
                                                    <span class="user-name-text fw-bold text-dark d-block">{{ $user['name'] }}</span>
                                                    <small class="user-email-text text-muted d-block">{{ $user['email'] }}</small>
                                                    <small class="user-phone-text text-primary" style="font-size: 0.7rem;"><i class="fas fa-phone-alt me-1 opacity-50"></i>{{ $user['phone'] ?? '--' }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge-role badge bg-light text-dark border px-2 rounded-pill">{{ $user['role'] }}</span>
                                        </td>
                                        <td><small class="text-muted fw-bold">{{ $user['category_name'] }}</small></td>
                                        <td><x-admin.status-badge :status="$user['status']" /></td>
                                        <td class="text-muted small">{{ $user['last_login'] ?? '--' }}</td>
                                        <td>
                                            <div class="action-pillar-container" onmouseleave="this.classList.remove('active')">
                                                <button class="action-dots" onclick="this.parentElement.classList.toggle('active')">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <div class="action-pills">
                                                    <button class="pill-btn view" title="View Details" onclick='openViewModal(@json($user))'><i class="fas fa-eye"></i></button>
                                                    <button class="pill-btn edit" title="Edit User" onclick='openEditModal(@json($user))'><i class="fas fa-edit"></i></button>
                                                    <button class="pill-btn delete" title="Delete User" onclick='openDeleteModal(@json($user))'><i class="fas fa-trash-alt"></i></button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Area -->
                    <div id="paginationContainer" class="d-flex justify-content-between align-items-center mt-auto pt-3 border-top">
                        <div class="d-flex align-items-center gap-3">
                            <span class="text-muted small">Showing <span id="visibleRange">1-10</span> of <span id="id_total_visible_footer">10</span> users</span>
                        </div>
                        <nav id="paginationNav">
                            <ul class="pagination pagination-sm mb-0" id="paginationList">
                                <li class="page-item disabled" id="prevPageBtn"><a class="page-link border-0 bg-transparent" href="javascript:void(0)">Previous</a></li>
                                <!-- Dynamic page numbers -->
                                <li class="page-item" id="nextPageBtn"><a class="page-link border-0 bg-transparent text-muted" href="javascript:void(0)">Next</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('modals')
<!-- STRICT VISIBILITY: Managed by Bootstrap JS -->
<div class="modal fade" id="viewUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 550px; margin: auto;">
        <div class="modal-content border-0 glass-modal-content" style="border-radius: 30px; overflow: hidden; position: relative;">
            
            <!-- Absolute Close Button -->
            <button type="button" class="btn-exit-premium" data-bs-dismiss="modal" style="position: absolute; right: 20px; top: 20px; z-index: 100;">
                <i class="fas fa-times"></i>
            </button>

            <!-- Centered Modal Body -->
            <div class="modal-body p-4" style="display: flex; flex-direction: column; align-items: center; text-align: center;">
                
                <!-- Profile Avatar Circle -->
                <div class="position-relative mb-3" style="width: 84px; height: 84px;">
                    <div id="viewUserAvatar" class="rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-lg" style="width: 100%; height: 100%; font-size: 1.8rem; background: linear-gradient(135deg, #6366f1 0%, #4338ca 100%); color: #fff; border: 4px solid #fff; border-radius: 50% !important;"></div>
                    <div class="position-absolute" style="bottom: 4px; right: 4px; width: 14px; height: 14px; background: #10b981; border: 3px solid #fff; border-radius: 50%;"></div>
                </div>

                <!-- Identity -->
                <h4 id="viewUserName" class="fw-bold mb-1" style="color: #0f172a; font-size: 1.25rem;"></h4>
                <p id="viewUserEmail" class="text-muted small mb-3" style="word-break: break-all; width: 100%; font-size: 0.8rem;"></p>
                
                <!-- Role Badge (Centered Box) -->
                <div class="mb-3">
                    <div id="viewUserRole" class="badge-role-pill"></div>
                </div>

                <!-- Centered Data Stack -->
                <div class="w-100 d-flex flex-column gap-2 mb-3">
                    <div class="data-row-premium">
                        <i class="fas fa-layer-group"></i>
                        <span id="viewUserCategory"></span>
                    </div>
                    <div class="data-row-premium">
                        <i class="fas fa-phone-alt"></i>
                        <span id="viewUserPhone"></span>
                    </div>
                    <div class="data-row-premium">
                        <i class="fas fa-history"></i>
                        <span id="viewUserLogin"></span>
                    </div>
                </div>

                <!-- Capabilities Matrix Chips -->
                <div class="w-100 mb-4 text-start">
                    <label class="small fw-bold text-muted text-uppercase mb-2 d-block text-center" style="letter-spacing: 1px; font-size: 0.6rem;">Authorized Capabilities</label>
                    <div id="viewUserPerms" class="d-flex flex-wrap justify-content-center gap-1">
                        <!-- Perm chips dynamic -->
                    </div>
                </div>

                <!-- Action Button -->
                <button class="btn-dismiss-premium" data-bs-dismiss="modal">
                    Dismiss Overview
                </button>
            </div>
        </div>
    </div>
</div>

<!-- PREMIUM FIX: Horizontal Row-Based Centered Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 520px; margin: auto;">
        <div class="modal-content border-0 shadow-2xl" style="border-radius: 30px; background: #ffffff; position: relative; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.6);">
            
            <!-- Floating Close Button -->
            <button type="button" class="btn-exit-premium" data-bs-dismiss="modal" style="position: absolute; right: -15px; top: -15px; width: 44px; height: 44px; border-radius: 50%; background: #0f172a; color: #fff; box-shadow: 0 10px 20px -5px rgba(0,0,0,0.4); display: flex; align-items: center; justify-content: center; z-index: 1000;">
                <i class="fas fa-times"></i>
            </button>

            <div class="modal-body p-5">
                <!-- Centered Identity Header -->
                <div class="d-flex flex-column align-items-center text-center mb-5">
                    <div class="position-relative mb-4" style="width: 88px; height: 88px;">
                        <div id="editUserAvatar" class="rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-lg" style="width: 100%; height: 100%; font-size: 2rem; background: linear-gradient(135deg, #6366f1 0%, #4338ca 100%); color: #fff; border: 4px solid #fff; border-radius: 50% !important;">
                            <i class="fas fa-user-edit" style="font-size: 1.5rem; opacity: 0.8;"></i>
                        </div>
                    </div>
                    <h3 class="fw-black mb-1" style="color: #0f172a; letter-spacing: -1px;">Edit Profile</h3>
                    <p class="text-muted small px-3">Update credentials and user settings</p>
                </div>

                <form id="editUserForm" onsubmit="saveUserChanges(event)" class="d-flex flex-column gap-3">
                    
                    <!-- Identity Name Row -->
                    <div class="d-flex align-items-center justify-content-center mb-3">
                        <label class="small fw-bold text-muted text-uppercase mb-0" style="width: 150px; text-align: left; letter-spacing: 0.5px;">Identity Name</label>
                        <input type="text" class="form-control premium-pill-input" id="editUserName" required style="width: 270px; padding-left: 20px; text-align: left;">
                    </div>

                    <!-- Email Address Row -->
                    <div class="d-flex align-items-center justify-content-center mb-3">
                        <label class="small fw-bold text-muted text-uppercase mb-0" style="width: 150px; text-align: left; letter-spacing: 0.5px;">Email Address</label>
                        <input type="email" class="form-control premium-pill-input" id="editUserEmail" required style="width: 270px; padding-left: 20px; text-align: left;">
                    </div>

                    <!-- Account Role Row -->
                    <div class="d-flex align-items-center justify-content-center mb-3">
                        <label class="small fw-bold text-muted text-uppercase mb-0" style="width: 150px; text-align: left; letter-spacing: 0.5px;">Account Role</label>
                        <select class="form-select premium-pill-input" id="editUserRole" style="width: 270px; padding-left: 20px; text-align: left;">
                            @foreach($roles as $role)
                            <option value="{{ $role['slug'] }}">{{ $role['name'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- User Status Row -->
                    <div class="d-flex align-items-center justify-content-center mb-3">
                        <label class="small fw-bold text-muted text-uppercase mb-0" style="width: 150px; text-align: left; letter-spacing: 0.5px;">User Status</label>
                        <select class="form-select premium-pill-input" id="editUserStatus" style="width: 270px; padding-left: 20px; text-align: left;">
                            <option value="online">Online</option>
                            <option value="offline">Offline</option>
                            <option value="banned">Banned</option>
                        </select>
                    </div>

                    <!-- Centered Footer Action -->
                    <div class="pt-4 d-flex justify-content-center">
                        <button type="submit" class="btn btn-dark w-100 rounded-pill py-3 fw-bold shadow-2xl" style="background: #0f172a; border: none; font-size: 1rem; transition: all 0.3s ease; max-width: 380px;">
                            Confirm Updates
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- PREMIUM FIX: Perfectly Centered Delete User Modal -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 400px; margin: auto;">
        <div class="modal-content border-0 shadow-2xl" style="border-radius: 32px; background: #ffffff; position: relative;">
            
            <!-- Absolute Close Button -->
            <button type="button" class="btn-exit-premium" data-bs-dismiss="modal" style="position: absolute; right: 20px; top: 20px; z-index: 100;">
                <i class="fas fa-times"></i>
            </button>
            
            <div class="modal-body p-5 d-flex flex-column align-items-center text-center">
                
                <!-- Centered Warning Identity -->
                <div class="mb-4 d-flex align-items-center justify-content-center rounded-circle shadow-lg" style="width: 84px; height: 84px; background: rgba(239, 68, 68, 0.1); border: 2px solid rgba(239, 68, 68, 0.05);">
                    <i class="fas fa-trash-alt text-danger" style="font-size: 2.2rem;"></i>
                </div>

                <div class="mb-5 text-center w-100">
                    <h3 class="fw-black mb-2" style="color: #0f172a; letter-spacing: -1px; text-align: center;">Secure Deletion</h3>
                    <p class="text-muted small px-2" style="text-align: center;">This action is permanent and cannot be undone. Are you sure you want to delete <strong id="deleteUserName" class="text-dark">User</strong>?</p>
                </div>

                <!-- Massive Action Stack -->
                <div class="w-100 d-flex flex-column gap-3">
                    <button class="btn btn-danger w-100 py-3 fw-bold shadow-xl btn-premium-delete" onclick="confirmDeleteUser()" style="background: #ef4444; border: none; font-size: 1.05rem; display: flex; align-items: center; justify-content: center; border-radius: 50px !important; color: #fff;">
                        Confirm Deletion
                    </button>
                    
                    <button class="btn btn-premium-cancel w-100 py-3 fw-bold border-0 shadow-sm" data-bs-dismiss="modal" style="font-size: 1.05rem; display: flex; align-items: center; justify-content: center; border-radius: 50px !important;">
                        No, Keep Account
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endpush

<style>
    :root {
        --sidebar-mini-w: 64px;
        --p-indigo: #4F46E5;
        --p-indigo-light: rgba(79, 70, 229, 0.1);
    }

    .dashboard-wrapper { padding: 20px !important; }
    
    .glass-panel-main {
        background: #fff;
        border-radius: 20px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
        display: flex;
        min-height: 750px;
        overflow: hidden;
    }

    /* Fixed Footprint Sidebar Wrapper */
    .user-management-sidebar {
        width: 64px;
        flex-shrink: 0;
        z-index: 1000;
        position: relative;
    }

    .sidebar-inner {
        position: absolute;
        top: 0;
        left: 0;
        width: 54px;
        height: 100%;
        background: var(--glass-bg);
        border: 1px solid var(--glass-border);
        border-radius: 16px;
        padding: 8px 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        transition: width 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        backdrop-filter: blur(25px);
        box-shadow: var(--card-shadow);
        overflow: hidden;
    }

    .user-management-sidebar:hover .sidebar-inner { 
        width: 220px; 
        box-shadow: var(--premium-shadow);
        border-color: var(--p-indigo);
    }

    .sidebar-nav-list { width: 100%; padding: 0 6px; }

    .nav-item-premium {
        width: 100%; height: 40px; display: flex; align-items: center;
        padding: 0 12px; border-radius: 12px; border: none; background: transparent;
        color: var(--text-muted); transition: all 0.3s ease; cursor: pointer; white-space: nowrap;
    }

    .nav-item-premium i { font-size: 1rem; min-width: 28px; margin-right: 12px; }
    .nav-item-premium span { opacity: 0; transition: opacity 0.3s; font-size: 0.8rem; font-weight: 700; visibility: hidden; }

    .user-management-sidebar:hover .nav-item-premium span { opacity: 1; visibility: visible; }

    .nav-item-premium:hover { background: var(--p-indigo-light); color: var(--p-indigo); transform: translateX(5px); }
    .nav-item-premium.active { background: var(--p-indigo); color: #fff; box-shadow: 0 10px 20px rgba(79, 70, 229, 0.3); }
    [data-theme="dark"] .nav-item-premium:hover { background: rgba(255,255,255,0.05); color: #fff; }

    /* Content Area Refinement */
        padding: 30px 15px;
        overflow: visible;
        min-width: 0;
    }

    /* Luxury Table Design */
    .table-custom { width: 100%; min-width: 800px; border-collapse: separate; border-spacing: 0 8px; }
    .table-custom th {
        padding: 8px 16px; color: var(--text-muted); font-size: 0.65rem; 
        text-transform: uppercase; letter-spacing: 1px; font-weight: 800; border: none;
    }

    .table-custom td { 
        padding: 12px 18px; background: rgba(255,255,255,0.4); 
        border-top: 1px solid var(--glass-border); border-bottom: 1px solid var(--glass-border); vertical-align: middle; 
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        font-size: 0.85rem;
    }
    [data-theme="dark"] .table-custom td { background: rgba(255,255,255,0.02); }
    .table-custom td:first-child { border-left: 1px solid var(--glass-border); border-radius: 12px 0 0 12px; }
    .table-custom td:last-child { border-right: 1px solid var(--glass-border); border-radius: 0 12px 12px 0; }
    
    .table-row { transition: 0.3s; cursor: pointer; }
    .table-row:hover td { 
        background: #fff !important; 
        transform: translateY(-2px) scale(1.002);
        box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        border-color: var(--p-indigo);
        z-index: 10;
    }
    [data-theme="dark"] .table-row:hover td { background: #1e293b !important; border-color: var(--p-indigo); }

    .user-name-text { white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 180px; font-size: 0.9rem; }
    .user-email-text { font-size: 0.75rem; }
    .table-custom th:last-child { min-width: 140px; text-align: right; padding-right: 25px !important; }
    .table-custom td:last-child { text-align: right; padding-right: 25px !important; }

    /* Stats & Search Upgrade */
    .mini-stat-card {
        padding: 8px 16px; border-radius: 12px; background: var(--glass-bg); border: 1px solid var(--glass-border);
        display: flex; align-items: center; gap: 12px; min-width: 160px; box-shadow: var(--card-shadow);
        transition: 0.3s;
    }
    .mini-stat-card:hover { transform: translateY(-3px); border-color: var(--p-indigo); }
    .mini-stat-card .stat-icon { width: 34px; height: 34px; font-size: 0.9rem; }
    .mini-stat-card .stat-label { font-size: 0.65rem; }
    .mini-stat-card .stat-value { font-size: 0.8rem; }

    .search-input-premium {
        width: 100%; padding: 12px 42px; border-radius: 14px; border: 1px solid var(--glass-border);
        background: rgba(0,0,0,0.02); transition: 0.3s; font-size: 0.85rem; font-weight: 500;
        backdrop-filter: blur(5px);
    }
    [data-theme="dark"] .search-input-premium { background: rgba(255,255,255,0.03); color: #fff; }
    .search-input-premium:focus { border-color: var(--p-indigo); background: #fff; box-shadow: 0 10px 25px rgba(79, 70, 229, 0.1); outline: none; }
    [data-theme="dark"] .search-input-premium:focus { background: rgba(255,255,255,0.07); }

    .search-container-premium { position: relative; width: 100%; }
    .search-container-premium .search-icon { 
        position: absolute; left: 16px; top: 50%; transform: translateY(-50%); 
        color: var(--text-muted); font-size: 0.9rem; pointer-events: none; transition: 0.3s;
    }
    .search-container-premium:focus-within .search-icon { color: var(--p-indigo); }

    .search-kbd {
        position: absolute; right: 14px; top: 50%; transform: translateY(-50%);
        display: flex; align-items: center; gap: 4px; padding: 4px 10px;
        background: var(--glass-bg); border: 1px solid var(--glass-border);
        border-radius: 8px; color: var(--text-muted); font-size: 0.65rem; 
        font-weight: 800; pointer-events: none; backdrop-filter: blur(10px);
    }

    .btn-filter-premium {
        padding: 6px 16px; border-radius: 50px; border: 1px solid var(--glass-border); background: var(--glass-bg);
        color: var(--text-muted); font-weight: 700; font-size: 0.75rem; cursor: pointer; transition: 0.3s;
    }
    .btn-filter-premium.active { background: var(--p-indigo); color: #fff; border-color: var(--p-indigo); transform: scale(1.05); }
    .btn-filter-premium:hover:not(.active) { border-color: var(--p-indigo); color: var(--p-indigo); }

    /* Scrollbar & Pagination Refinement */
    ::-webkit-scrollbar { width: 5px; height: 5px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.1); border-radius: 20px; }
    [data-theme="dark"] ::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); }

    .page-link { 
        color: var(--text-muted) !important; font-weight: 700; border: none !important; 
        background: transparent !important; transition: 0.3s; width: 32px; height: 32px;
        display: flex; align-items: center; justify-content: center;
    }
    .page-item.active .page-link { 
        background: var(--p-indigo) !important; color: #fff !important; 
        box-shadow: 0 5px 15px rgba(79, 70, 229, 0.3); border-radius: 50%;
    }
    .page-item:not(.active):hover .page-link { color: var(--p-indigo) !important; background: var(--p-indigo-light) !important; border-radius: 50%; }

    /* Action Pillar System */
    .action-pillar-container {
        position: relative; display: flex; align-items: center; justify-content: flex-end; min-height: 40px;
    }
    .action-dots {
        width: 32px; height: 32px; border-radius: 10px; border: 1px solid var(--glass-border);
        background: var(--glass-bg); color: var(--text-muted); cursor: pointer; transition: 0.3s;
        display: flex; align-items: center; justify-content: center;
    }
    .action-dots:hover { background: var(--p-indigo-light); color: var(--p-indigo); }

    .action-pills {
        position: absolute; right: 40px; display: flex; gap: 8px; background: #fff;
        padding: 6px 12px; border-radius: 50px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        border: 1px solid var(--glass-border); opacity: 0; visibility: hidden;
        transform: translateX(15px); transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        z-index: 1000;
    }
    [data-theme="dark"] .action-pills { background: #1e293b; }
    .action-pillar-container.active .action-pills { opacity: 1; visibility: visible; transform: translateX(0); }

    .pill-btn {
        width: 32px; height: 32px; border-radius: 50%; border: none;
        display: flex; align-items: center; justify-content: center;
        transition: 0.3s; font-size: 0.85rem; cursor: pointer;
    }
    .pill-btn.view { background: rgba(79, 70, 229, 0.1); color: #4F46E5; }
    .pill-btn.edit { background: rgba(245, 158, 11, 0.1); color: #f59e0b; }
    .pill-btn.delete { background: rgba(239, 68, 68, 0.1); color: #ef4444; }
    .pill-btn:hover { transform: scale(1.15) translateY(-2px); box-shadow: 0 5px 15px rgba(0,0,0,0.1); }

    /* Modal Perfection */
    .modal.show { 
        backdrop-filter: blur(20px); 
        background: rgba(0,0,0,0.6); 
        display: flex !important; 
        align-items: center; 
        justify-content: center; 
        position: fixed; 
        top: 0; 
        left: 0; 
        width: 100%; 
        height: 100%; 
        z-index: 10000;
    }
    
    .glass-modal-content {
        background: #ffffff;
        box-shadow: 0 40px 100px rgba(0,0,0,0.3);
        border: 1px solid var(--glass-border);
    }
    [data-theme="dark"] .glass-modal-content {
        background: #0f172a;
        box-shadow: 0 40px 100px rgba(0,0,0,0.6);
        border: 1px solid rgba(255,255,255,0.08);
    }

    [data-theme="dark"] #viewUserName { color: #f8fafc !important; }
    [data-theme="dark"] #viewUserEmail { color: #94a3b8 !important; }
    [data-theme="dark"] .modal-body label { color: #64748b !important; }

    .btn-dismiss-premium {
        width: 100%; border-radius: 50px; padding: 14px 0; border: 1px solid rgba(0,0,0,0.1);
        background: #0f172a; color: #fff; font-weight: 800; font-size: 0.95rem;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        letter-spacing: 0.5px;
    }
    [data-theme="dark"] .btn-dismiss-premium { background: var(--p-indigo); border-color: rgba(255,255,255,0.1); }
    .btn-dismiss-premium:hover { 
        transform: scale(1.02) translateY(-3px); 
        box-shadow: 0 20px 40px rgba(79, 70, 229, 0.4); 
        background: var(--p-indigo);
        color: #fff;
    }
    .btn-dismiss-premium:active { transform: scale(0.98); }

    .btn-exit-premium {
        width: 44px; height: 44px; border: none; background: rgba(0,0,0,0.05); 
        color: var(--text-muted); border-radius: 15px; display: flex; align-items: center; justify-content: center;
        transition: 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .btn-exit-premium:hover { background: #ef4444; color: #fff; transform: rotate(90deg) scale(1.1); }

    .badge-role-pill {
        display: inline-block; padding: 6px 16px; border-radius: 50px;
        background: var(--p-indigo-light); color: var(--p-indigo);
        font-weight: 800; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.5px;
    }

    .data-row-premium {
        display: flex; align-items: center; gap: 12px; padding: 10px 15px; border-radius: 12px;
        background: rgba(0,0,0,0.03); color: var(--text-main); font-size: 0.8rem; font-weight: 600;
        text-align: left;
    }
    [data-theme="dark"] .data-row-premium { background: rgba(255,255,255,0.05); color: #fff; }
    .data-row-premium i { color: var(--p-indigo); width: 16px; text-align: center; font-size: 0.85rem; }
</style>

<!-- Add Bootstrap 5 JS (required for dropdowns and modals) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('userSearchInput');
    const roleButtons = document.querySelectorAll('.btn-filter-premium');
    const navItems = document.querySelectorAll('.nav-item-premium');
    const tableRows = document.querySelectorAll('.table-row');
    const paginationContainer = document.getElementById('paginationContainer');
    const visibleCountText2 = document.getElementById('visibleCountText');
    
    const activeCategoryCard = document.getElementById('activeCategoryCard');
    const activeCatIcon = document.getElementById('activeCatIcon');
    const activeCatLabel = document.getElementById('activeCatLabel');
    const activeCatCount = document.getElementById('activeCatCount');

    // Role Metadata for permissions lookup
    const systemRoles = @json($roles);

    let activeRole = 'all';
    let activeCategory = 'all';
    let searchQuery = '';
    let currentPage = 1;
    let itemsPerPage = 10;
    let filteredRows = [];

    function updatePaginationUI(totalVisible) {
        const totalPages = Math.ceil(totalVisible / itemsPerPage) || 1;
        const paginationList = document.getElementById('paginationList');
        const prevBtn = document.getElementById('prevPageBtn');
        const nextBtn = document.getElementById('nextPageBtn');
        const visibleRange = document.getElementById('visibleRange');

        paginationList.querySelectorAll('.dynamic-page').forEach(n => n.remove());

        for (let i = 1; i <= totalPages; i++) {
            const li = document.createElement('li');
            li.className = `page-item dynamic-page ${i === currentPage ? 'active' : ''}`;
            li.innerHTML = `<a class="page-link rounded-circle mx-1 border-0" href="javascript:void(0)">${i}</a>`;
            li.addEventListener('click', () => { currentPage = i; renderPaginatedRows(); });
            nextBtn.before(li);
        }

        prevBtn.classList.toggle('disabled', currentPage === 1);
        nextBtn.classList.toggle('disabled', currentPage === totalPages || totalPages === 0);

        const start = totalVisible === 0 ? 0 : (currentPage - 1) * itemsPerPage + 1;
        const end = Math.min(currentPage * itemsPerPage, totalVisible);
        visibleRange.textContent = `${start}-${end}`;
    }

    function renderPaginatedRows() {
        tableRows.forEach(row => { row.style.display = 'none'; row.classList.add('d-none'); });
        const start = (currentPage - 1) * itemsPerPage;
        const end = start + itemsPerPage;
        const pageRows = filteredRows.slice(start, end);
        pageRows.forEach(row => { row.style.display = ''; row.classList.remove('d-none'); });
        updatePaginationUI(filteredRows.length);
    }

    function filterTable() {
        filteredRows = [];
        let catCount = 0;
        tableRows.forEach(row => {
            const rowRole = (row.getAttribute('data-role') || '').toLowerCase();
            const rowCategory = (row.getAttribute('data-category') || '');
            const rowSearch = (row.getAttribute('data-search') || '');
            
            const roleMatch = (activeRole === 'all' || rowRole === activeRole.toLowerCase());
            const categoryMatch = (activeCategory === 'all' || rowCategory === activeCategory);
            const searchMatch = rowSearch.includes(searchQuery);

            if (rowCategory === activeCategory) catCount++;
            if (roleMatch && categoryMatch && searchMatch) filteredRows.push(row);
        });

        currentPage = 1;
        if(visibleCountText2) visibleCountText2.textContent = filteredRows.length;
        document.getElementById('id_total_visible_footer').textContent = filteredRows.length;
        if(activeCatCount) activeCatCount.textContent = (activeCategory === 'all') ? tableRows.length : catCount;

        renderPaginatedRows();
    }

    navItems.forEach(item => {
        item.addEventListener('click', () => {
            navItems.forEach(nav => nav.classList.remove('active'));
            item.classList.add('active');
            activeCategory = item.getAttribute('data-category');
            if (activeCategory === 'all') { activeCategoryCard.classList.add('d-none'); } 
            else {
                activeCategoryCard.classList.remove('d-none');
                activeCatIcon.innerHTML = `<i class="${item.querySelector('i').className}"></i>`;
                activeCatLabel.textContent = item.querySelector('span').textContent;
            }
            filterTable();
        });
    });

    roleButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            roleButtons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            activeRole = btn.getAttribute('data-role');
            filterTable();
        });
    });

    searchInput.addEventListener('input', (e) => { searchQuery = e.target.value.toLowerCase().trim(); filterTable(); });

    document.getElementById('perPageSelect').addEventListener('change', (e) => { itemsPerPage = parseInt(e.target.value); currentPage = 1; renderPaginatedRows(); });
    document.getElementById('prevPageBtn').addEventListener('click', () => { if (currentPage > 1) { currentPage--; renderPaginatedRows(); } });
    document.getElementById('nextPageBtn').addEventListener('click', () => { if (currentPage < Math.ceil(filteredRows.length/itemsPerPage)) { currentPage++; renderPaginatedRows(); } });

    // URL Deep Linking for Role Filter
    const urlParams = new URLSearchParams(window.location.search);
    const roleParam = urlParams.get('role');
    if (roleParam) {
        activeRole = roleParam;
        roleButtons.forEach(btn => {
            if (btn.getAttribute('data-role') === roleParam) {
                roleButtons.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
            }
        });
    }

    filterTable();

    // Modal Global Instances
    const viewModal = new bootstrap.Modal(document.getElementById('viewUserModal'));
    const editModal = new bootstrap.Modal(document.getElementById('editUserModal'));
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteUserModal'));

    window.openViewModal = function(user) {
        document.getElementById('viewUserName').innerText = user.name;
        document.getElementById('viewUserEmail').innerText = user.email;
        document.getElementById('viewUserRole').innerText = user.role;
        document.getElementById('viewUserCategory').innerText = user.category_name || user.category;
        document.getElementById('viewUserPhone').innerText = user.phone || '--';
        document.getElementById('viewUserLogin').innerText = user.last_login || 'Never';
        document.getElementById('viewUserAvatar').innerText = user.name.substring(0, 2).toUpperCase();

        // Populate Permissions from systemRoles registry
        const permContainer = document.getElementById('viewUserPerms');
        permContainer.innerHTML = '';
        const roleData = systemRoles.find(r => r.slug.toLowerCase() === user.role.toLowerCase() || r.name.toLowerCase() === user.role.toLowerCase());
        
        if (roleData && roleData.permissions && roleData.permissions.length > 0) {
            roleData.permissions.forEach(p => {
                const span = document.createElement('span');
                span.className = 'badge bg-light text-dark border small px-2 py-1 rounded-pill fw-normal';
                span.style.fontSize = '0.65rem';
                span.innerText = p.replace(/_/g, ' ');
                permContainer.appendChild(span);
            });
        } else {
            permContainer.innerHTML = '<span class="text-muted small">No specific permissions assigned</span>';
        }

        viewModal.show();
    }

    let currentUserForAction = null;

    window.openEditModal = function(user) {
        currentUserForAction = user;
        document.getElementById('editUserName').value = user.name;
        document.getElementById('editUserEmail').value = user.email;
        document.getElementById('editUserRole').value = user.role;
        document.getElementById('editUserStatus').value = user.status;
        editModal.show();
    }

    window.openDeleteModal = function(user) {
        currentUserForAction = user;
        document.getElementById('deleteUserName').innerText = user.name;
        deleteModal.show();
    }

    // Handle User Updates (Permanent Save)
    document.getElementById('editUserForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const formData = {
            name: document.getElementById('editUserName').value,
            email: document.getElementById('editUserEmail').value,
            role: document.getElementById('editUserRole').value,
            status: document.getElementById('editUserStatus').value,
            _token: '{{ csrf_token() }}'
        };

        try {
            const response = await fetch(`/super_admin/users/${currentUserForAction.id}`, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                body: JSON.stringify(formData)
            });
            const data = await response.json();
            
            if (data.success) {
                editModal.hide();
                showNotify(data.message, 'success');
                setTimeout(() => window.location.reload(), 1000);
            } else {
                showNotify(data.message || 'Update failed', 'error');
            }
        } catch (error) {
            showNotify('Network error occurred.', 'error');
        }
    });

    // Handle Permanent User Deletion
    window.confirmDeleteUser = async function() {
        try {
            const response = await fetch(`/super_admin/users/${currentUserForAction.id}`, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
            });
            const data = await response.json();
            
            if (data.success) {
                deleteModal.hide();
                showNotify(data.message, 'success');
                setTimeout(() => window.location.reload(), 1000);
            } else {
                showNotify(data.message || 'Deletion failed', 'error');
            }
        } catch (error) {
            showNotify('Network error occurred.', 'error');
        }
    }
});

function banUser(userId, userName) {
    if (confirm(`Ban ${userName}?`)) {
        fetch(`/super_admin/users/${userId}/ban`, { method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json', 'Content-Type': 'application/json' }})
        .then(res => res.json()).then(data => { if (data.success) window.location.reload(); });
    }
}
</script>
@endsection
