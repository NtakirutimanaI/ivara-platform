@extends('layouts.app')

@section('content')
<div class="dashboard-wrapper">
    <x-admin.header title="User Management" subtitle="Overview of all registered accounts across the platform">
        <div class="d-flex gap-2">
            <button class="btn-glass btn-primary">
                <i class="fas fa-file-export me-2"></i>Export CSV
            </button>
        </div>
    </x-admin.header>



    <!-- Main Content -->
    <div class="glass-panel mt-4 p-0 overflow-hidden">
        <div class="d-flex gap-3 p-3" style="min-height: 700px;">
            <!-- Left Sidebar Navigation -->
            <div class="user-management-sidebar">
                <div class="sidebar-header-box px-3 py-4">
                    <h5 class="fw-bold mb-1 text-dark" style="font-size: 1rem;">Categories</h5>
                    <p class="text-muted small mb-0" style="font-size: 0.7rem;">Filter by sector</p>
                </div>
                
                <div class="sidebar-nav-list">
                    <button class="nav-item-premium active" data-category="all">
                        <i class="fas fa-th-large"></i>
                        <span>All Categories</span>
                    </button>
                    @foreach($categories as $cat)
                    <button class="nav-item-premium" data-category="{{ $cat['name'] }}">
                        <i class="{{ $cat['icon'] }}"></i>
                        <span>{{ $cat['name'] }}</span>
                    </button>
                    @endforeach
                </div>

                <div class="sidebar-footer-box px-3 py-4 mt-auto">
                    <div class="help-center-card shadow-sm">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <div class="help-icon-box">
                                <i class="fas fa-question-circle"></i>
                            </div>
                            <span class="help-title">Help Center</span>
                        </div>
                        <p class="help-text small mb-3">Facing issues? Our team is available to assist you.</p>
                        <button class="btn-help-premium w-100">
                            <i class="fas fa-headset me-2"></i>Contact Support
                        </button>
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
                        
                        <div class="d-flex gap-2">
                            <button class="btn-action-premium" title="Export Segment">
                                <i class="fas fa-download"></i>
                            </button>
                            <button class="btn-action-premium" title="Segment Settings">
                                <i class="fas fa-cog"></i>
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
                                @foreach($users as $categoryName => $categoryUsers)
                                    @foreach($categoryUsers as $user)
                                    <tr class="table-row" data-category="{{ $user['category'] }}" data-role="{{ $user['role'] }}" data-search="{{ strtolower($user['name'] . ' ' . $user['email'] . ' ' . $user['category']) }}">
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 40px; height: 40px; background: linear-gradient(135deg, #4F46E5 0%, #4338ca 100%) !important;">
                                                    {{ strtoupper(substr($user['name'], 0, 2)) }}
                                                </div>
                                                <div>
                                                    <span class="user-name-text fw-bold text-dark d-block">{{ $user['name'] }}</span>
                                                    <small class="user-email-text text-muted">{{ $user['email'] }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge-role badge bg-light text-dark border px-2 rounded-pill">{{ $user['role'] }}</span>
                                        </td>
                                        <td><small class="text-muted fw-bold">{{ $user['category'] }}</small></td>
                                        <td><x-admin.status-badge :status="$user['status']" /></td>
                                        <td class="text-muted small">--</td>
                                        <td>
                                            <div class="dropdown text-center">
                                                <button class="btn btn-sm btn-icon text-muted" data-bs-toggle="dropdown"><i class="fas fa-ellipsis-v"></i></button>
                                                <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                                                    <li><a class="dropdown-item small" href="{{ route('super_admin.users.show', $user['id']) }}"><i class="fas fa-eye me-2 text-muted"></i>View Profile</a></li>
                                                    <li><a class="dropdown-item small" href="#"><i class="fas fa-history me-2 text-muted"></i>Activity Log</a></li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item small text-danger" href="javascript:void(0)" onclick="banUser({{ $user['id'] }}, '{{ $user['name'] }}')"><i class="fas fa-ban me-2"></i>Ban Account</a></li>
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
                        <nav>
                            <ul class="pagination pagination-sm mb-0" id="paginationList">
                                <li class="page-item disabled" id="prevPageBtn"><a class="page-link border-0 bg-transparent" href="javascript:void(0)">Previous</a></li>
                                <!-- Dynamic page numbers will be inserted here -->
                                <li class="page-item" id="nextPageBtn"><a class="page-link border-0 bg-transparent text-muted" href="javascript:void(0)">Next</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<style>
    .dashboard-page .content .dashboard-wrapper {
        --primary: #4F46E5;
        --secondary: #64748B; 
        padding: 20px 0 !important; 
    }
    
    .glass-panel {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(15px);
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.6);
        box-shadow: 0 10px 40px -10px rgba(0, 0, 0, 0.08);
    }

    /* Sidebar Navigation Layout */
    .user-management-sidebar {
        width: 210px;
        background: #f8fafc;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        display: flex;
        flex-direction: column;
    }

    .sidebar-nav-list {
        padding: 0 12px;
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .nav-item-premium {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 10px;
        border: none;
        background: transparent;
        color: #64748b;
        font-weight: 600;
        font-size: 0.88rem;
        border-radius: 12px;
        text-align: left;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        width: 100%;
    }

    .nav-item-premium i {
        font-size: 1.1rem;
        width: 20px;
        display: flex;
        justify-content: center;
    }

    .nav-item-premium:hover {
        background: #f1f5f9;
        color: var(--primary);
        transform: translateX(4px);
    }

    .nav-item-premium.active {
        background: #fff;
        color: var(--primary);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03), 0 1px 2px rgba(0, 0, 0, 0.06);
        border: 1px solid rgba(79, 70, 229, 0.1);
    }

    /* Right Side Content Styling */
    .bg-light { background-color: #f8fafc !important; }
    .text-primary { color: var(--primary) !important; }

    /* Search Bar Refinement */
    .search-container-premium { position: relative; z-index: 10; }
    .search-input-premium {
        width: 100%;
        padding: 14px 44px;
        padding-right: 80px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        font-size: 0.92rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        outline: none;
        box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.02);
    }
    .search-input-premium:focus {
        background: #fff;
        border-color: var(--primary);
        box-shadow: 0 10px 25px -5px rgba(79, 70, 229, 0.1), 0 8px 10px -6px rgba(79, 70, 229, 0.05);
        transform: translateY(-1px);
    }
    .search-icon { 
        position: absolute; left: 16px; top: 50%; transform: translateY(-50%); 
        color: #94a3b8; font-size: 1rem; transition: all 0.3s;
    }
    .search-input-premium:focus + .search-icon { color: var(--primary); }

    .search-kbd {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        display: flex;
        align-items: center;
        gap: 6px;
        background: #fff;
        border: 1px solid #e2e8f0;
        padding: 4px 10px;
        border-radius: 8px;
        color: #94a3b8;
        font-size: 0.7rem;
        font-weight: 800;
        pointer-events: none;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.03);
    }

    /* Filter Bar Refinement */
    .filter-bar-premium {
        background: rgba(248, 250, 252, 0.8);
        backdrop-filter: blur(10px);
        padding: 8px 12px;
        border-radius: 18px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    .btn-filter-premium {
        padding: 8px 16px;
        border-radius: 50px;
        border: 1px solid transparent;
        background: transparent;
        color: #64748b;
        font-weight: 600;
        font-size: 0.8rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        align-items: center;
    }

    .btn-filter-premium:hover {
        background: rgba(79, 70, 229, 0.05);
        color: var(--primary);
    }

    /* Buttons & Actions */
    .btn-filter-premium {
        padding: 8px 16px; border-radius: 12px; border: 1px solid #e2e8f0;
        background: #fff; color: #64748b; font-weight: 600; font-size: 0.85rem;
        transition: all 0.2s; display: flex; align-items: center; gap: 8px;
    }
    .btn-filter-premium:hover { background: #f8fafc; border-color: var(--primary); color: var(--primary); }
    .btn-filter-premium.active {
        background: #fff; color: var(--primary); border-color: rgba(79, 70, 229, 0.2);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.08);
    }

    .btn-action-premium {
        width: 36px; height: 36px; border-radius: 10px; border: 1px solid #e2e8f0;
        background: #fff; color: #64748b; display: flex; align-items: center; justify-content: center;
        transition: all 0.2s; cursor: pointer;
    }
    .btn-action-premium:hover { background: var(--primary); color: #fff; border-color: var(--primary); transform: translateY(-2px); }

    .btn-icon {
        width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center;
        background: #f8fafc; border: 1px solid #e2e8f0; transition: all 0.2s;
    }
    .btn-icon:hover { background: #f1f5f9; border-color: #cbd5e1; color: var(--primary); }

    /* Table Styling */
    .table-custom { width: 100%; border-collapse: separate; border-spacing: 0 8px; }
    .table-custom th { color: #64748b; font-weight: 600; font-size: 0.75rem; text-transform: uppercase; padding: 12px; opacity: 0.8; }
    .table-custom td { padding: 16px 12px; background: #fff; vertical-align: middle; border-top: 1px solid #f1f5f9; border-bottom: 1px solid #f1f5f9; }
    .table-custom td:first-child { border-left: 1px solid #f1f5f9; border-radius: 12px 0 0 12px; }
    .table-custom td:last-child { border-right: 1px solid #f1f5f9; border-radius: 0 12px 12px 0; }
    .table-row:hover td { background: #f8fafc !important; }

    /* Stat Cards */
    .mini-stat-card {
        display: flex; align-items: center; gap: 10px; background: #f8fafc;
        border: 1px solid #e2e8f0; padding: 6px 12px; border-radius: 12px;
        min-width: 160px; transition: all 0.3s;
    }
    .mini-stat-card .stat-icon { width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 0.95rem; }
    .mini-stat-card .stat-label { display: block; font-size: 0.65rem; font-weight: 700; text-transform: uppercase; color: #64748b; line-height: 1; margin-bottom: 2px; }
    .mini-stat-card .stat-value { display: block; font-size: 0.8rem; font-weight: 600; color: #1e293b; line-height: 1; }

    /* Per Page Selector */
    .per-page-container {
        background: #fff; border: 1px solid #e2e8f0; padding: 8px 16px; border-radius: 12px;
        display: flex; align-items: center; gap: 12px; height: 48.4px; transition: all 0.3s ease;
    }
    .per-page-container:hover { border-color: #4F46E5; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.1); }
    .per-page-label { font-size: 0.65rem; font-weight: 800; color: #64748b; text-transform: uppercase; }
    .per-page-select { border: none; background: transparent; font-weight: 700; color: #4F46E5; font-size: 0.9rem; outline: none; appearance: none; }

    /* Help Center Card */
    .help-center-card {
        background: linear-gradient(135deg, #ffffff 0%, #f1f5f9 100%);
        border: 1px solid #e2e8f0; padding: 16px; border-radius: 20px;
        position: relative; overflow: hidden; transition: all 0.3s ease;
    }
    .help-icon-box { width: 28px; height: 28px; background: #4F46E5; color: white; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; box-shadow: 0 4px 10px rgba(79, 70, 229, 0.2); }
    .help-title { font-size: 0.8rem; font-weight: 700; color: #1e293b; }
    .help-text { font-size: 0.7rem; color: #64748b; line-height: 1.4; margin-bottom: 12px; }
    .btn-help-premium {
        background: #fff; border: 1px solid #e2e8f0; color: #1e293b; padding: 8px 12px;
        border-radius: 12px; font-size: 0.75rem; font-weight: 600; display: flex; align-items: center; justify-content: center;
        transition: all 0.3s ease;
    }
    .btn-help-premium:hover { background: #4F46E5; color: #fff; border-color: #4F46E5; transform: translateY(-2px); }

    /* =============================================
       DARK MODE OVERRIDES (Premium High Fidelity)
       ============================================= */
    [data-theme="dark"] .glass-panel { background: #0f172a; border-color: #1e293b; box-shadow: 0 20px 50px rgba(0, 0, 0, 0.4); }
    [data-theme="dark"] .user-management-sidebar { background: #1e293b !important; border-color: #334155 !important; }
    [data-theme="dark"] .nav-item-premium { color: #94a3b8; }
    [data-theme="dark"] .nav-item-premium:hover { background: #334155; color: #818cf8; }
    [data-theme="dark"] .nav-item-premium.active { background: #4F46E5 !important; color: #fff !important; box-shadow: 0 4px 15px rgba(79, 70, 229, 0.4); }
    [data-theme="dark"] .user-management-content { background: #0f172a !important; color: #f8fafc; border-color: #1e293b !important; }
    
    [data-theme="dark"] .search-input-premium { background: #1e293b; border-color: #334155; color: #fff; }
    [data-theme="dark"] .search-input-premium:focus { background: #334155; border-color: #4F46E5; }
    [data-theme="dark"] .search-kbd { background: #334155; border-color: #475569; color: #f8fafc; }
    
    [data-theme="dark"] .filter-bar-premium { background: #1e293b; border-color: #334155; }
    [data-theme="dark"] .btn-filter-premium { background: #1e293b; border-color: #334155; color: #94a3b8; }
    [data-theme="dark"] .btn-filter-premium.active { background: #334155; color: #818cf8; border-color: #4f46e5; }
    
    [data-theme="dark"] .btn-action-premium { background: #1e293b; border-color: #334155; color: #94a3b8; }
    [data-theme="dark"] .btn-action-premium:hover { background: #4F46E5; color: #fff; border-color: #4F46E5; }
    
    [data-theme="dark"] .table-custom td { background: #1e293b; border-color: #334155; color: #f1f5f9; }
    [data-theme="dark"] .table-custom th { color: #f8fafc !important; opacity: 1; border-bottom-color: #334155; }
    [data-theme="dark"] .table-row:hover td { background: #334155 !important; }
    
    [data-theme="dark"] .btn-icon { background: #1e293b; border-color: #334155; color: #94a3b8; }
    [data-theme="dark"] .btn-icon:hover { background: #334155; color: #fff; }
    
    [data-theme="dark"] .dropdown-menu { background: #1e293b; border: 1px solid #334155; box-shadow: 0 10px 30px rgba(0,0,0,0.5) !important; }
    [data-theme="dark"] .dropdown-item { color: #94a3b8; }
    [data-theme="dark"] .dropdown-item:hover { background: #334155; color: #fff; }
    [data-theme="dark"] .dropdown-divider { border-color: #334155; }
    
    [data-theme="dark"] .bg-light { background-color: #334155 !important; border-color: #475569 !important; }
    [data-theme="dark"] .text-dark { color: #f8fafc !important; }
    [data-theme="dark"] .text-muted { color: #94a3b8 !important; }
    
    [data-theme="dark"] .mini-stat-card { background: #1e293b; border-color: #334155; }
    [data-theme="dark"] .mini-stat-card .stat-value { color: #fff; }
    [data-theme="dark"] .mini-stat-card .stat-icon.bg-light { background: #334155 !important; color: #818cf8 !important; }
    
    [data-theme="dark"] .per-page-container { background: #1e293b; border-color: #334155; }
    [data-theme="dark"] .per-page-label { color: #94a3b8; }
    [data-theme="dark"] .per-page-select { color: #818cf8; }
    
    [data-theme="dark"] .help-center-card { background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%); border-color: #334155; }
    [data-theme="dark"] .help-title { color: #fff; }
    [data-theme="dark"] .help-text { color: #94a3b8; }
    [data-theme="dark"] .btn-help-premium { background: #334155; border-color: #475569; color: #eee; }
    [data-theme="dark"] .btn-help-premium:hover { background: #4F46E5; color: #fff; }

    /* Force d-none to hide exactly */
    .d-none { display: none !important; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('userSearchInput');
    const roleButtons = document.querySelectorAll('.btn-filter-premium');
    const navItems = document.querySelectorAll('.nav-item-premium');
    const tableRows = document.querySelectorAll('.table-row');
    const paginationContainer = document.getElementById('paginationContainer');
    const visibleCountText = document.getElementById('visibleCount');
    const visibleCountText2 = document.getElementById('visibleCountText');
    const userTable = document.getElementById('userTable');
    
    // Mini Card Selectors
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
        if (currentPage > totalPages) currentPage = totalPages;

        const paginationList = document.getElementById('paginationList');
        const prevBtn = document.getElementById('prevPageBtn');
        const nextBtn = document.getElementById('nextPageBtn');
        const visibleRange = document.getElementById('visibleRange');

        // Reset dynamic numbers
        const pageNumbers = paginationList.querySelectorAll('.dynamic-page');
        pageNumbers.forEach(n => n.remove());

        // Create page numbers
        for (let i = 1; i <= totalPages; i++) {
            const li = document.createElement('li');
            li.className = `page-item dynamic-page ${i === currentPage ? 'active' : ''}`;
            li.innerHTML = `<a class="page-link rounded-circle mx-1 border-0 ${i === currentPage ? '' : 'text-muted'}" 
                              style="width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;" 
                              href="javascript:void(0)">${i}</a>`;
            li.addEventListener('click', () => {
                currentPage = i;
                renderPaginatedRows();
            });
            nextBtn.before(li);
        }

        // Prev/Next state
        prevBtn.classList.toggle('disabled', currentPage === 1);
        nextBtn.classList.toggle('disabled', currentPage === totalPages);

        // Visibility range
        const start = totalVisible === 0 ? 0 : (currentPage - 1) * itemsPerPage + 1;
        const end = Math.min(currentPage * itemsPerPage, totalVisible);
        visibleRange.textContent = `${start}-${end}`;
    }

    function renderPaginatedRows() {
        // Force hide all rows first
        tableRows.forEach(row => {
            row.style.display = 'none';
            row.classList.add('d-none');
        });
        
        const start = (currentPage - 1) * itemsPerPage;
        const end = start + itemsPerPage;
        const pageRows = filteredRows.slice(start, end);

        // Show only the sliced items for current page
        pageRows.forEach(row => {
            row.style.display = '';
            row.classList.remove('d-none');
        });

        updatePaginationUI(filteredRows.length);
    }

    function filterTable() {
        filteredRows = [];
        let categorySpecificCount = 0;
        
        tableRows.forEach(row => {
            const rowRole = (row.getAttribute('data-role') || '').toLowerCase();
            const rowCategory = (row.getAttribute('data-category') || '');
            const rowSearch = (row.getAttribute('data-search') || '');
            
            const roleMatch = (activeRole === 'all' || rowRole === activeRole.toLowerCase());
            const categoryMatch = (activeCategory === 'all' || rowCategory === activeCategory);
            const searchMatch = rowSearch.includes(searchQuery);

            if (rowCategory === activeCategory) categorySpecificCount++;

            if (roleMatch && categoryMatch && searchMatch) {
                filteredRows.push(row);
            }
        });

        // Reset to first page when filtering
        currentPage = 1;
        
        // Update counts
        const totalFound = filteredRows.length;
        if(visibleCountText) visibleCountText.textContent = totalFound;
        if(visibleCountText2) visibleCountText2.textContent = totalFound;
        
        const footerCountText = document.getElementById('id_total_visible_footer');
        if(footerCountText) footerCountText.textContent = totalFound;
        
        if(activeCatCount) activeCatCount.textContent = categorySpecificCount;

        // Render first page
        renderPaginatedRows();

        // Ensure table container remains visible
        if(userTable && userTable.parentElement) {
            userTable.parentElement.classList.remove('d-none');
            userTable.parentElement.style.display = '';
        }
        
        if(paginationContainer) {
            paginationContainer.style.opacity = filteredRows.length === 0 ? '0' : '1';
            paginationContainer.style.display = filteredRows.length === 0 ? 'none' : 'flex';
        }
    }

    // Category Sidebar Click
    navItems.forEach(item => {
        item.addEventListener('click', () => {
            navItems.forEach(nav => nav.classList.remove('active'));
            item.classList.add('active');
            
            activeCategory = item.getAttribute('data-category');
            
            if (activeCategory === 'all') {
                activeCategoryCard.classList.add('d-none');
            } else {
                activeCategoryCard.classList.remove('d-none');
                
                // Update Mini Card Icon & Label
                const icon = item.querySelector('i').className;
                const label = item.querySelector('span').textContent;
                
                activeCatIcon.innerHTML = `<i class="${icon}"></i>`;
                activeCatLabel.textContent = label;
            }
            
            filterTable();
        });
    });

    // Role Filter Click
    roleButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            roleButtons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            activeRole = btn.getAttribute('data-role');
            filterTable();
        });
    });

    // Typing Event
    searchInput.addEventListener('input', (e) => {
        searchQuery = e.target.value.toLowerCase().trim();
        filterTable();
    });

    // Per Page Change
    document.getElementById('perPageSelect').addEventListener('change', (e) => {
        itemsPerPage = parseInt(e.target.value);
        currentPage = 1;
        renderPaginatedRows();
    });

    // Pagination Nav
    document.getElementById('prevPageBtn').addEventListener('click', () => {
        if (currentPage > 1) {
            currentPage--;
            renderPaginatedRows();
        }
    });

    document.getElementById('nextPageBtn').addEventListener('click', () => {
        const totalPages = Math.ceil(filteredRows.length / itemsPerPage);
        if (currentPage < totalPages) {
            currentPage++;
            renderPaginatedRows();
        }
    });

    // Shortcut for Search focus
    document.addEventListener('keydown', (e) => {
        if ((e.metaKey || e.ctrlKey) && e.key === 'f') {
            e.preventDefault();
            searchInput.focus();
        }
    });

    // Initial Filter
    filterTable();
});

function resetFilters() {
    document.getElementById('userSearchInput').value = '';
    document.getElementById('userSearchInput').dispatchEvent(new Event('input'));
    document.querySelector('.nav-item-premium[data-category="all"]').click();
}

function banUser(userId, userName) {
    if (confirm(`Are you sure you want to restrict the account of ${userName}?`)) {
        fetch(`/super_admin/users/${userId}/ban`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                window.location.reload();
            } else {
                alert('Something went wrong. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please check your connection.');
        });
    }
}
</script>
@endsection

