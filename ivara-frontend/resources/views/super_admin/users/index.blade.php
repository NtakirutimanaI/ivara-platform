@extends('layouts.app')

@section('content')
<div class="dashboard-wrapper">
    <x-admin.header title="User Management" subtitle="Overview of all registered accounts across the platform">
    </x-admin.header>



    <!-- Main Content -->
    <div class="glass-panel mt-4 p-0 overflow-hidden">
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
            <div class="user-management-content flex-grow-1 p-3 p-lg-4 bg-white d-flex flex-column rounded-4 border shadow-sm overflow-hidden" style="min-width: 0;">
                
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
                            <button class="btn-filter-premium" data-role="Provider">
                                <i class="fas fa-user-tie me-2"></i>Providers
                            </button>
                            <button class="btn-filter-premium" data-role="Client">
                                <i class="fas fa-user me-2"></i>Clients
                            </button>

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
                                    <tr class="table-row" data-category="{{ $user['category_slug'] }}" data-role="{{ $user['role'] }}" data-search="{{ strtolower($user['name'] . ' ' . $user['email'] . ' ' . $user['category_name']) }}">
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
                                            <div class="dropdown text-center">
                                                <button class="btn btn-sm btn-icon text-muted" data-bs-toggle="dropdown"><i class="fas fa-ellipsis-v"></i></button>
                                                <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                                                    <li><a class="dropdown-item small" href="javascript:void(0)" onclick='openViewModal(@json($user))'><i class="fas fa-eye me-2 text-primary"></i>View Details</a></li>
                                                    <li><a class="dropdown-item small" href="javascript:void(0)" onclick='openEditModal(@json($user))'><i class="fas fa-edit me-2 text-warning"></i>Edit User</a></li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item small text-danger" href="javascript:void(0)" onclick='openDeleteModal(@json($user))'><i class="fas fa-trash-alt me-2"></i>Delete User</a></li>
                                                </ul>
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
<!-- STRICT VISIBILITY: Hidden by default (display: none !important) -->
<div class="modal fade" id="viewUserModal" tabindex="-1" aria-hidden="true" style="z-index: 99999 !important; display: none;">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 360px; margin: auto;">
        <div class="modal-content border-0" style="border-radius: 30px; background: #ffffff; overflow: hidden; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.4); position: relative;">
            
            <!-- Absolute Close Button -->
            <button type="button" class="btn-exit-premium" data-bs-dismiss="modal" style="position: absolute; right: 20px; top: 20px; z-index: 100;">
                <i class="fas fa-times"></i>
            </button>

            <!-- Centered Modal Body -->
            <div class="modal-body p-5" style="display: flex; flex-direction: column; align-items: center; text-align: center;">
                
                <!-- Profile Avatar Circle -->
                <div class="position-relative mb-4" style="width: 96px; height: 96px;">
                    <div id="viewUserAvatar" class="rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-lg" style="width: 100%; height: 100%; font-size: 2.2rem; background: linear-gradient(135deg, #6366f1 0%, #4338ca 100%); color: #fff; border: 4px solid #fff; border-radius: 50% !important;"></div>
                    <div class="position-absolute" style="bottom: 5px; right: 5px; width: 16px; height: 16px; background: #10b981; border: 3px solid #fff; border-radius: 50%;"></div>
                </div>

                <!-- Identity -->
                <h4 id="viewUserName" class="fw-bold mb-1" style="color: #0f172a; font-size: 1.4rem;"></h4>
                <p id="viewUserEmail" class="text-muted small mb-4" style="word-break: break-all; width: 100%;"></p>
                
                <!-- Role Badge (Centered Box) -->
                <div class="mb-4">
                    <div id="viewUserRole" class="badge-role-pill"></div>
                </div>

                <!-- Centered Data Stack -->
                <div class="w-100 d-flex flex-column gap-2 mb-5">
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

                <!-- Action Button -->
                <button class="btn btn-dark w-100 rounded-pill py-3 fw-bold shadow-sm btn-view-dismiss" data-bs-dismiss="modal" style="border: none; font-size: 0.95rem;">
                    Dismiss Overview
                </button>
            </div>
        </div>
    </div>
</div>

<!-- PREMIUM FIX: Horizontal Row-Based Centered Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-hidden="true" style="z-index: 99999 !important; display: none;">
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
                            <option value="Manager">Manager</option>
                            <option value="Supervisor">Supervisor</option>
                            <option value="Client">Client</option>
                            <option value="Provider">Provider</option>
                            <option value="Admin">Admin</option>
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
<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-hidden="true" style="z-index: 99999 !important; display: none;">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 400px; margin: auto;">
        <div class="modal-content border-0 shadow-2xl" style="border-radius: 32px; background: #ffffff; position: relative;">
            
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
        width: var(--sidebar-mini-w);
        flex-shrink: 0;
        position: relative;
        z-index: 100;
        background: transparent;
        border: none;
    }

    /* Expanding Inner Container (Overlay Style) */
    .sidebar-inner {
        position: absolute;
        top: 0;
        left: 0;
        width: 64px;
        height: 100%;
        background: #f8fafc;
        border-right: 1px solid #e2e8f0;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        padding: 20px 0;
        transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
    }

    .user-management-sidebar:hover .sidebar-inner {
        width: 250px;
        box-shadow: 15px 0 30px rgba(0,0,0,0.08);
    }

    .sidebar-nav-list { 
        display: flex; 
        flex-direction: column; 
        gap: 8px; 
        width: 100%;
        padding: 0 10px;
    }

    .nav-item-premium {
        width: 100%;
        height: 44px;
        display: flex;
        align-items: center;
        padding: 0 12px;
        border-radius: 12px;
        border: none;
        background: transparent;
        color: #94a3b8;
        transition: all 0.2s ease;
        cursor: pointer;
        white-space: nowrap;
    }

    .nav-item-premium i { 
        font-size: 1.2rem; 
        min-width: 28px;
        display: flex;
        justify-content: center;
        margin-right: 12px;
    }

    .nav-item-premium span { 
        opacity: 0;
        transition: opacity 0.2s ease;
        font-size: 0.85rem;
        font-weight: 600;
        visibility: hidden;
    }

    .user-management-sidebar:hover .nav-item-premium span {
        opacity: 1;
        visibility: visible;
    }

    .nav-item-premium:hover {
        background: var(--p-indigo-light);
        color: var(--p-indigo);
    }

    .nav-item-premium.active {
        background: var(--p-indigo);
        color: #fff;
        box-shadow: 0 8px 15px rgba(79, 70, 229, 0.2);
    }

    /* Fixed Content Area */
    .user-management-content {
        flex-grow: 1;
        background: #fff;
        padding: 32px;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        min-width: 0; /* Critical for flex to handle large tables */
    }

    /* Table & UI Refinement */
    .table-custom { width: 100%; border-collapse: separate; border-spacing: 0 8px; }
    .table-custom td { padding: 14px 16px; background: #fff; border-top: 1px solid #f1f5f9; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
    .table-custom td:first-child { border-left: 1px solid #f1f5f9; border-radius: 12px 0 0 12px; }
    .table-custom td:last-child { border-right: 1px solid #f1f5f9; border-radius: 0 12px 12px 0; }
    .table-row:hover td { background: #f8fafc !important; }

    .mini-stat-card {
        padding: 10px 16px; border-radius: 14px; background: #f8fafc; border: 1px solid #e2e8f0;
        display: flex; align-items: center; gap: 12px; min-width: 160px;
    }

    .search-input-premium {
        width: 100%; padding: 12px 44px; border-radius: 12px; border: 1px solid #e2e8f0;
        background: #f8fafc; transition: 0.3s;
    }
    .search-input-premium:focus { border-color: var(--p-indigo); background: #fff; box-shadow: 0 8px 20px rgba(0,0,0,0.05); }

    .btn-filter-premium {
        padding: 8px 18px; border-radius: 50px; border: 1px solid #e2e8f0; background: #fff;
        color: #64748b; font-weight: 600; font-size: 0.85rem; cursor: pointer; transition: 0.2s;
    }
    .btn-filter-premium.active { background: var(--p-indigo); color: #fff; border-color: var(--p-indigo); }

    /* Search Bar Refinement */
    .search-container-premium { position: relative; width: 100%; }
    .search-icon { 
        position: absolute; left: 16px; top: 50%; transform: translateY(-50%); 
        color: #94a3b8; font-size: 1rem; z-index: 5;
    }
    .search-kbd { 
        position: absolute; right: 12px; top: 50%; transform: translateY(-50%); 
        background: #fff; border: 1px solid #e2e8f0; padding: 4px 8px; 
        border-radius: 8px; color: #94a3b8; font-size: 0.7rem; font-weight: 700; 
        display: flex; align-items: center; gap: 4px; z-index: 5; pointer-events: none;
    }
    .search-input-premium { 
        width: 100%; padding: 12px 48px; border-radius: 12px; border: 1px solid #e2e8f0; 
        background: #f8fafc; transition: 0.3s; font-size: 0.9rem;
    }
    .search-input-premium:focus { border-color: var(--p-indigo); background: #fff; box-shadow: 0 10px 25px rgba(0,0,0,0.05); }

    /* Action Buttons */
    .btn-action-premium { 
        width: 40px; height: 40px; border-radius: 10px; border: 1px solid #e2e8f0; 
        background: #fff; color: #64748b; display: flex; align-items: center; justify-content: center; 
        transition: 0.2s; cursor: pointer;
    }
    .btn-action-premium:hover { background: #f8fafc; color: var(--p-indigo); border-color: var(--p-indigo); transform: translateY(-2px); }


    /* Comprehensive Dark Mode Support */
    [data-theme="dark"] .glass-panel-main { background: #0f172a; border-color: #1e293b; }
    [data-theme="dark"] .user-management-content { background: #0f172a; color: #fff; }
    [data-theme="dark"] .sidebar-inner { background: #1e293b; border-color: #334155; }
    [data-theme="dark"] .nav-item-premium { color: #94a3b8; }
    [data-theme="dark"] .nav-item-premium:hover { background: rgba(255, 255, 255, 0.05); color: #fff; }
    [data-theme="dark"] .nav-item-premium.active { background: var(--p-indigo); color: #fff; }
    [data-theme="dark"] .table-custom td { background: #1e293b; border-color: #334155; color: #f8fafc; }
    [data-theme="dark"] .table-row:hover td { background: #232d3f !important; }
    [data-theme="dark"] .mini-stat-card { background: #1e293b; border-color: #334155; }
    [data-theme="dark"] .stat-value { color: #fff; }
    [data-theme="dark"] .search-input-premium { background: #1e293b; border-color: #334155; color: #fff; }
    [data-theme="dark"] .btn-filter-premium { background: #1e293b; border-color: #334155; color: #cbd5e1; }
    [data-theme="dark"] .btn-filter-premium.active { background: var(--p-indigo); color: #fff; border-color: var(--p-indigo); }
    [data-theme="dark"] .user-name-text { color: #fff !important; }
    [data-theme="dark"] .text-dark { color: #fff !important; }
    [data-theme="dark"] .per-page-container { background: #1e293b; border-color: #334155; }
    [data-theme="dark"] .per-page-select { color: #fff; }
    [data-theme="dark"] .search-kbd { background: #0f172a; border-color: #334155; color: #64748b; }
    [data-theme="dark"] .btn-action-premium { background: #1e293b; border-color: #334155; color: #cbd5e1; }
    [data-theme="dark"] .btn-action-premium:hover { background: #232d3f; color: #fff; }
    [data-theme="dark"] .btn-icon { background: #1e293b; color: #cbd5e1; border: 1px solid #334155 !important; }
    [data-theme="dark"] .btn-icon:hover { background: #232d3f; color: #fff; }
    [data-theme="dark"] .table-custom th { color: #94a3b8; }
    [data-theme="dark"] .modal-content { background: #0f172a; color: #fff; border: 1px solid #1e293b !important; }
    [data-theme="dark"] .modal-header .btn-close { filter: invert(1) grayscale(100%) brightness(200%); }
    [data-theme="dark"] .dropdown-menu { background: #1e293b; border-color: #334155; }
    [data-theme="dark"] .dropdown-item { color: #cbd5e1; }
    [data-theme="dark"] .dropdown-item:hover { background: #232d3f; color: #fff; }
    [data-theme="dark"] .form-control, [data-theme="dark"] .form-select { background: #0f172a; border-color: #334155; color: #fff; }

    /* Fix table-responsive clipping dropdowns and modal appearance */
    .table-responsive { overflow: initial !important; }
    .dropdown-menu { 
        z-index: 1060 !important; 
        min-width: 200px; 
        padding: 8px 0;
        background: #fff;
        border: 1px solid #e2e8f0;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    .dropdown-item { padding: 10px 20px; display: flex; align-items: center; transition: 0.2s; }
    
    [data-theme="dark"] .dropdown-menu { background: #1e293b; border-color: #334155; box-shadow: 0 10px 25px rgba(0,0,0,0.3); }
    [data-theme="dark"] .modal-content { background: #1e293b !important; color: #fff; border: 1px solid #334155 !important; }
    [data-theme="dark"] #viewUserName { color: #fff !important; }
    [data-theme="dark"] .view-data-text { color: #cbd5e1 !important; }
    [data-theme="dark"] .info-tag { background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.05); color: #cbd5e1; }
    [data-theme="dark"] .premium-input { background: #0f172a; border-color: #334155; color: #fff; }
    [data-theme="dark"] .btn-modal-close:hover { background: rgba(255, 255, 255, 0.05); }

    /* View User Modal Dark Mode */
    [data-theme="dark"] #viewUserModal .modal-content { background: #1e293b !important; }
    [data-theme="dark"] #viewUserName { color: #f8fafc !important; }
    [data-theme="dark"] .data-row-premium { background: #0f172a !important; border-color: #334155 !important; color: #cbd5e1 !important; }
    [data-theme="dark"] #viewUserAvatar { border-color: #1e293b !important; }
    [data-theme="dark"] #viewUserModal .rounded-circle[style*="background: #10b981"] { border-color: #1e293b !important; }
    [data-theme="dark"] .btn-view-dismiss { background: #0f172a !important; color: #fff !important; }
    [data-theme="dark"] .btn-view-dismiss:hover { background: #000 !important; }
    
    /* Premium Modal Button Themes */
    .btn-premium-cancel { background: #f1f5f9; color: #64748b; transition: 0.3s; }
    .btn-premium-cancel:hover { background: #e2e8f0; color: #475569; }
    
    [data-theme="dark"] .btn-premium-cancel { background: #334155; color: #f8fafc; }
    [data-theme="dark"] .btn-premium-cancel:hover { background: #475569; color: #ffffff; }

    [data-theme="dark"] #deleteUserName { color: #f8fafc !important; }
    [data-theme="dark"] .text-muted { color: #94a3b8 !important; }
    [data-theme="dark"] h3 { color: #ffffff !important; }

    /* Viewport-Pinned Modal Enforcement */
    .modal {
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        width: 100% !important;
        height: 100% !important;
        z-index: 99999 !important;
        background: rgba(15, 23, 42, 0.4); /* Integrated Airy Backdrop */
        backdrop-filter: blur(8px);
        display: none;
        align-items: center;
        justify-content: center;
    }
    .modal.show { display: flex !important; }
    
    .modal-dialog { margin: auto !important; width: 100%; }

    .modal-backdrop { display: none !important; } /* We use the modal parent as the backdrop for better centering */
    
    .btn-exit-premium {
        width: 36px; height: 36px; border: none; background: rgba(0,0,0,0.05); 
        color: #64748b; border-radius: 10px; font-size: 0.9rem;
        display: flex; align-items: center; justify-content: center;
        transition: 0.2s;
    }
    .btn-exit-premium:hover { background: #ef4444; color: #fff; transform: rotate(90deg); }
    
    .badge-role-pill {
        display: inline-block; padding: 6px 16px; border-radius: 50px;
        background: rgba(99, 102, 241, 0.1); color: #6366f1;
        font-weight: 700; font-size: 0.75rem; text-transform: uppercase;
    }
    
    .data-row-premium {
        display: flex; align-items: center; justify-content: flex-start; gap: 15px;
        padding: 12px 20px; border-radius: 16px; background: #f8fafc;
        color: #64748b; font-size: 0.85rem; font-weight: 600;
        border: 1px solid #f1f5f9; transition: 0.2s;
    }
    .data-row-premium i {
        width: 24px; text-align: center; font-size: 1.1rem; color: #6366f1; flex-shrink: 0;
    }
    .data-row-premium i { color: #6366f1; width: 16px; text-align: center; }

    .glass-input-field {
        border-radius: 14px; border: 1px solid #e2e8f0; background: #f8fafc;
        padding: 12px 16px; font-size: 0.9rem; transition: 0.2s;
    }
    .glass-input-field:focus { border-color: #6366f1; background: #fff; box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1); }

    .premium-pill-input {
        border-radius: 50px; border: 1px solid #e2e8f0; background: #f8fafc;
        padding: 12px 24px; font-size: 0.9rem; transition: 0.2s;
        color: #0f172a; font-weight: 500; text-align: center;
    }
    .premium-pill-input:focus { border-color: #6366f1; background: #fff; box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1); outline: none; }

    [data-theme="dark"] .modal-content { background: #1e293b !important; color: #fff; }
    [data-theme="dark"] .premium-pill-input { background: #111827; border-color: #334155; color: #fff; }
    [data-theme="dark"] .premium-pill-input:focus { background: #111827; }
    [data-theme="dark"] h4, [data-theme="dark"] .fw-bold { color: #fff !important; }
    [data-theme="dark"] .btn-exit-premium { background: #334155; color: #94a3b8; }
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
        if(activeCatCount) activeCatCount.textContent = catCount;

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

    document.getElementById('editUserForm').addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Updates saved for ' + currentUserForAction.name + ' (Mock Action)');
        editModal.hide();
    });

    window.confirmDelete = function() {
        alert('User ' + currentUserForAction.name + ' deleted (Mock Action)');
        deleteModal.hide();
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
