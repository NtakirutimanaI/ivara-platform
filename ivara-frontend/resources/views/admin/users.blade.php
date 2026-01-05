@include('layouts.header')
@include('layouts.sidebar')

<div class="user-management-panel">
    {{-- Stats Bento Grid --}}
    <div class="stats-grid">
        <div class="stat-card primary">
            <div class="stat-icon"><i class="fas fa-users"></i></div>
            <div class="stat-content">
                <span class="stat-label">Total Users</span>
                <h2 class="stat-value">{{ $users->total() }}</h2>
            </div>
            <div class="stat-trend"><i class="fas fa-arrow-up"></i> +12%</div>
        </div>
        <div class="stat-card success">
            <div class="stat-icon"><i class="fas fa-user-check"></i></div>
            <div class="stat-content">
                <span class="stat-label">Active Now</span>
                <h2 class="stat-value">{{ \App\Models\User::where('status', 'active')->count() }}</h2>
            </div>
        </div>
        <div class="stat-card warning">
            <div class="stat-icon"><i class="fas fa-user-clock"></i></div>
            <div class="stat-content">
                <span class="stat-label">Pending Review</span>
                <h2 class="stat-value">{{ \App\Models\User::where('status', 'inactive')->count() }}</h2>
            </div>
        </div>
        <div class="stat-card info">
            <div class="stat-icon"><i class="fas fa-shield-alt"></i></div>
            <div class="stat-content">
                <span class="stat-label">Administrators</span>
                <h2 class="stat-value">{{ \App\Models\User::role('admin')->count() }}</h2>
            </div>
        </div>
    </div>

    {{-- Main Toolbar --}}
    <div class="toolbar">
        <div class="toolbar-left">
            <form action="{{ route('admin.users.index') }}" method="GET" class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, email or username...">
            </form>

            <div class="per-page-selector">
                <label>Show:</label>
                <select onchange="window.location.href=this.value">
                    <option value="{{ route('admin.users.index', array_merge(request()->all(), ['per_page' => 5])) }}" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                    <option value="{{ route('admin.users.index', array_merge(request()->all(), ['per_page' => 10])) }}" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                    <option value="{{ route('admin.users.index', array_merge(request()->all(), ['per_page' => 20])) }}" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                </select>
            </div>
        </div>
        
        <div class="action-buttons">
            <button class="btn-outline" onclick="openExportModal()">
                <i class="fas fa-download"></i> Export Data
            </button>
            <button class="btn-primary" onclick="openModal('addUserModal')">
                <i class="fas fa-plus"></i> Add New User
            </button>
        </div>
    </div>

    {{-- Bulk Actions Panel (Hidden by default) --}}
    <div id="bulkActions" class="bulk-actions-panel">
        <span id="selectedCount">0 users selected</span>
        <div class="bulk-btns">
            <button onclick="bulkStatus('active')" class="btn-bulk-success">Activate</button>
            <button onclick="bulkStatus('inactive')" class="btn-bulk-warning">Deactivate</button>
            <button onclick="bulkDelete()" class="btn-bulk-danger">Delete</button>
        </div>
    </div>

    {{-- Users Table Container (AJAX Target) --}}
    <div class="table-container-wrapper">
        @include('admin.partials.users_table')
    </div>
</div>

{{-- All Modals --}}
@include('admin.users_modals')
@include('layouts.footer')

<!-- Export Modal with Dark Mode Support -->
<div id="exportModal" class="export-modal" style="display:none;">
    <div class="export-modal-content">
        <span class="close" onclick="closeExportModal()">&times;</span>
        <h3>Export User Data</h3>
        <form action="{{ route('admin.users.export') }}" method="GET">
            <div class="form-group">
                <label>Start Date:</label>
                <input type="date" name="start_date" required>
            </div>
            <div class="form-group">
                <label>End Date:</label>
                <input type="date" name="end_date" required>
            </div>
            <div class="form-group">
                <label>Format:</label>
                <select name="format">
                    <option value="csv">CSV / Excel</option>
                    <option value="pdf">PDF (Professional)</option>
                </select>
            </div>
            <button type="submit" class="btn-primary" style="width:100%;">Download Report</button>
        </form>
    </div>
</div>

<script>
    // ==========================================
    // FRESH DROPDOWN IMPLEMENTATION
    // ==========================================
    
    // Wait for DOM to be ready
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Dropdown script loaded');
        
        // Handle all clicks on the page
        document.addEventListener('click', function(e) {
            // Find if we clicked on a three-dot button or its icon
            let button = e.target;
            
            // Check if we clicked the icon inside the button
            if (button.classList.contains('fa-ellipsis-v')) {
                button = button.parentElement;
            }
            
            // Check if this is our dropdown button
            if (button.classList.contains('btn-icon')) {
                e.preventDefault();
                e.stopPropagation();
                
                console.log('Three-dot button clicked');
                
                // Find the dropdown menu (it's the next element after the button)
                const menu = button.nextElementSibling;
                
                if (menu && menu.classList.contains('dropdown-menu')) {
                    console.log('Found dropdown menu:', menu);
                    
                    // Check if this menu is currently visible
                    const isVisible = menu.style.display === 'block';
                    
                    // First, hide ALL dropdown menus
                    document.querySelectorAll('.dropdown-menu').forEach(function(m) {
                        m.style.display = 'none';
                    });
                    
                    // Then show this one if it wasn't visible
                    if (!isVisible) {
                        menu.style.display = 'block';
                        console.log('Dropdown shown');
                    } else {
                        console.log('Dropdown hidden');
                    }
                } else {
                    console.error('Dropdown menu not found next to button');
                }
                
                return;
            }
            
            // If we clicked inside a dropdown menu, don't close it
            if (e.target.closest('.dropdown-menu')) {
                console.log('Clicked inside dropdown menu');
                return;
            }
            
            // Otherwise, close all dropdowns
            document.querySelectorAll('.dropdown-menu').forEach(function(m) {
                m.style.display = 'none';
            });
        });
    });

    // ==========================================
    // AJAX SEARCH & PAGINATION
    // ==========================================
    
    let searchTimeout = null;

    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.querySelector('input[name="search"]');
        if(searchInput) {
            searchInput.addEventListener('keyup', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    fetchUsers(this.value);
                }, 300);
            });
        }
        
        // Handle Pagination Clicks
        document.body.addEventListener('click', function(e) {
            if(e.target.closest('.pagination .page-link')) {
                e.preventDefault();
                let url = e.target.closest('.page-link').href;
                if(url && url !== '#') {
                    fetchUsers(null, url);
                }
            }
        });
    });

    function fetchUsers(search = null, url = null) {
        if(!url) {
            url = "{{ route('admin.users.index') }}";
            let params = new URLSearchParams(window.location.search);
            if(search !== null) params.set('search', search);
            else if(document.querySelector('input[name="search"]')) params.set('search', document.querySelector('input[name="search"]').value);
            url = url + "?" + params.toString();
        }

        window.history.pushState(null, '', url);

        fetch(url, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => response.text())
        .then(html => {
            document.querySelector('.table-container-wrapper').innerHTML = html;
        });
    }

    // ==========================================
    // AJAX FORM SUBMIT
    // ==========================================
    
    function ajaxSubmit(e, form) {
        e.preventDefault();
        fetch(form.action, {
            method: form.method,
            body: new FormData(form),
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => {
            if(res.ok) {
               fetchUsers();
            } else {
                alert('Action failed');
            }
        });
        return false;
    }

    // ==========================================
    // BULK ACTIONS
    // ==========================================
    
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('.table-container-wrapper').addEventListener('change', function(e) {
            if(e.target.matches('.user-checkbox') || e.target.matches('#selectAll')) {
                 updateBulkPanel();
            }
        });
    });

    function updateBulkPanel() {
        const checked = document.querySelectorAll('.user-checkbox:checked');
        const bulkPanel = document.getElementById('bulkActions');
        if(bulkPanel) {
            bulkPanel.style.display = checked.length > 0 ? 'flex' : 'none';
            document.getElementById('selectedCount').innerText = `${checked.length} users selected`;
        }
    }
    
    function bulkDelete() {
        if(!confirm('Are you sure?')) return;
        const ids = Array.from(document.querySelectorAll('.user-checkbox:checked')).map(c => c.value);
        fetch("{{ route('admin.users.bulkDelete') }}", {
            method: 'POST',
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json', 'X-Requested-With': 'XMLHttpRequest'},
            body: JSON.stringify({ids})
        }).then(() => fetchUsers());
    }

    // ==========================================
    // MODAL HELPERS
    // ==========================================
    
    function openExportModal() { 
        document.getElementById('exportModal').style.display = 'flex'; 
    }
    
    function closeExportModal() { 
        document.getElementById('exportModal').style.display = 'none'; 
    }
</script>

<style>
    /* Pagination Button Style Override */
    .pagination {
        display: flex;
        justify-content: center;
        gap: 5px;
        margin-top: 20px;
    }
    .page-item { list-style: none; }
    .page-link {
        display: inline-block;
        padding: 8px 16px;
        border-radius: 8px; /* Rounded buttons */
        background: #f1f5f9;
        color: #475569;
        text-decoration: none;
        font-weight: 600;
        font-size: 13px;
        transition: 0.2s;
        border: 1px solid transparent;
    }
    .page-item.active .page-link {
        background: var(--primary);
        color: white;
        box-shadow: 0 4px 6px -1px rgba(146, 79, 194, 0.4);
    }
    .page-item.disabled .page-link {
        opacity: 0.5;
        cursor: not-allowed;
    }
    .page-link:hover:not(.active) {
        background: #e2e8f0;
        color: #1e293b;
    }
    
    /* Export Modal Styling */
    .export-modal {
        position: fixed;
        z-index: 2000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .export-modal-content {
        background-color: var(--card-bg);
        padding: 30px;
        border: 1px solid var(--border-color);
        width: 90%;
        max-width: 450px;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        position: relative;
    }

    .export-modal-content .close {
        color: var(--text-secondary);
        float: right;
        font-size: 32px;
        font-weight: bold;
        cursor: pointer;
        line-height: 1;
        transition: color 0.2s;
    }

    .export-modal-content .close:hover {
        color: var(--danger);
    }

    .export-modal-content h3 {
        margin-top: 0;
        margin-bottom: 25px;
        color: var(--primary);
        font-size: 24px;
        font-weight: 700;
    }

    .export-modal-content .form-group {
        margin-bottom: 20px;
    }

    .export-modal-content label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        font-size: 14px;
        color: var(--text-primary);
    }

    .export-modal-content input,
    .export-modal-content select {
        width: 100%;
        padding: 12px 15px;
        border: 1.5px solid var(--border-color);
        border-radius: 10px;
        font-size: 14px;
        background: var(--card-bg);
        color: var(--text-primary);
        transition: border-color 0.2s;
    }

    .export-modal-content input:focus,
    .export-modal-content select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(146, 79, 194, 0.1);
    }

    body.dark-theme .export-modal-content {
        background: rgba(15, 23, 42, 0.95);
        border-color: rgba(255, 255, 255, 0.1);
    }

    body.dark-theme .export-modal-content h3 {
        color: #a78bfa;
    }
</style>

<style>
    :root {
        --primary: #924FC2;
        --success: #00C853;
        --warning: #FFAB00;
        --danger: #FF1744;
        --bg-panel: #fdf4ff;
        --card-glass: rgba(255, 255, 255, 0.7);
        --text-primary: #1e293b;
        --text-secondary: #64748b;
        --card-bg: #ffffff;
        --border-color: #e2e8f0;
    }

    /* Dark Mode Overrides */
    body.dark-theme {
        --bg-panel: #0f172a !important;
        --card-glass: rgba(30, 41, 59, 0.7) !important;
        --text-primary: #f8fafc !important;
        --text-secondary: #cbd5e1 !important;
        --card-bg: rgba(30, 41, 59, 0.6) !important;
        --border-color: rgba(255, 255, 255, 0.1) !important;
    }

    body { 
        background: var(--bg-panel) !important; 
        font-family: 'Poppins', sans-serif;
        color: var(--text-primary) !important;
        transition: background 0.3s, color 0.3s;
    }

    body.dark-theme .stat-card,
    body.dark-theme .table-container,
    body.dark-theme .search-bar,
    body.dark-theme .btn-outline {
        background: var(--card-bg) !important;
        border-color: var(--border-color) !important;
    }

    body.dark-theme .stat-value,
    body.dark-theme .user-meta .name,
    body.dark-theme h1, body.dark-theme h2, body.dark-theme h3 {
        color: var(--text-primary) !important;
    }

    body.dark-theme .stat-label,
    body.dark-theme .premium-table th,
    body.dark-theme .contact-info,
    body.dark-theme .user-meta .username {
        color: var(--text-secondary) !important;
    }

    body.dark-theme .premium-table td {
        border-bottom-color: var(--border-color) !important;
    }

    body.dark-theme input,
    body.dark-theme select {
        background: rgba(15, 23, 42, 0.5) !important;
        color: var(--text-primary) !important;
        border-color: var(--border-color) !important;
    }

    /* Dark Mode: Export Button */
    body.dark-theme .btn-outline {
        background: rgba(30, 41, 59, 0.6) !important;
        color: #f8fafc !important;
        border-color: rgba(255, 255, 255, 0.2) !important;
    }

    body.dark-theme .btn-outline:hover {
        background: rgba(30, 41, 59, 0.8) !important;
        border-color: var(--primary) !important;
    }

    /* Dark Mode: Table Headers */
    body.dark-theme .premium-table th {
        background: rgba(15, 23, 42, 0.6) !important;
        color: #cbd5e1 !important;
        border-bottom-color: rgba(255, 255, 255, 0.1) !important;
    }

    /* Dark Mode: Table Data (including Joined Date column) */
    body.dark-theme .premium-table td {
        color: #e2e8f0 !important;
        border-bottom-color: var(--border-color) !important;
    }

    /* Dark Mode: Ensure all table text is visible */
    body.dark-theme .premium-table tbody tr {
        color: #e2e8f0 !important;
    }

    body.dark-theme .premium-table tbody tr:hover {
        background: rgba(255, 255, 255, 0.03) !important;
    }

    .user-management-panel {
        /* width: 80%; REMOVED to prevent overflow */
        margin-left: 250px;
        margin-right: 20px;
        padding: 30px 20px;
        margin-top: 20px;
    }

    /* Stats Grid */
    .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 30px; }
    .stat-card { 
        background: white; border-radius: 20px; padding: 25px; 
        display: flex; align-items: center; gap: 20px;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
        border: 1px solid rgba(146, 79, 194, 0.1);
    }
    .stat-icon { width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 20px; }
    .primary .stat-icon { background: rgba(146, 79, 194, 0.1); color: var(--primary); }
    .success .stat-icon { background: rgba(0, 200, 83, 0.1); color: var(--success); }
    .warning .stat-icon { background: rgba(255, 171, 0, 0.1); color: var(--warning); }
    .info .stat-icon { background: rgba(33, 150, 243, 0.1); color: #2196F3; }
    .stat-label { font-size: 13px; color: #64748b; font-weight: 600; }
    .stat-value { font-size: 28px; font-weight: 800; margin: 0; color: #1e293b; }

    /* Toolbar */
    .toolbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
    .search-bar { background: white; border-radius: 12px; height: 50px; display: flex; align-items: center; padding: 0 20px; gap: 12px; width: 400px; border: 1px solid #e2e8f0; }
    .search-bar input { border: none; outline: none; width: 100%; font-size: 14px; background: transparent; }
    .search-bar i { color: #94a3b8; }
    .action-buttons { display: flex; gap: 12px; }

    /* Buttons */
    .btn-primary { background: var(--primary); color: white; border: none; padding: 12px 24px; border-radius: 12px; font-weight: 700; cursor: pointer; transition: 0.3s; }
    .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 10px 15px -3px rgba(146, 79, 194, 0.3); }
    .btn-outline { background: white; border: 1px solid #e2e8f0; color: #1e293b; padding: 12px 24px; border-radius: 12px; font-weight: 600; cursor: pointer; text-decoration: none; }
    
    .btn-icon { 
        background: none; 
        border: none; 
        cursor: pointer; 
        color: #64748b; 
        font-size: 16px; 
        padding: 8px; 
        border-radius: 50%; 
        transition: background 0.2s;
    }
    .btn-icon:hover { 
        background: #f1f5f9; 
        color: var(--primary); 
    }

    body.dark-theme .btn-icon:hover {
        background: rgba(146, 79, 194, 0.2);
        color: #a78bfa;
    }

    /* Table Styling */
    .table-container { background: white; border-radius: 20px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05); overflow: visible; }
    .premium-table { width: 100%; border-collapse: collapse; text-align: left; }
    .premium-table th { background: #f8fafc; padding: 12px 25px; font-size: 11px; text-transform: uppercase; color: #64748b; letter-spacing: 0.05em; border-bottom: 1px solid #f1f5f9; }
    .premium-table td { padding: 8px 25px; border-bottom: 1px solid #f1f5f9; vertical-align: middle; font-size: 13px; }

    .contact-info { display: flex; flex-direction: column; gap: 2px; }
    .contact-info span { display: block; white-space: nowrap; }
    .contact-info i { width: 18px; color: var(--primary); font-size: 12px; }

    .toolbar-left { display: flex; align-items: center; gap: 20px; }
    .per-page-selector { display: flex; align-items: center; gap: 8px; font-size: 13px; color: #64748b; font-weight: 600; }
    .per-page-selector select { padding: 6px 12px; border-radius: 10px; border: 1.5px solid #e2e8f0; outline: none; background: white; cursor: pointer; font-size: 13px; }

    .user-profile-cell { display: flex; align-items: center; gap: 15px; }
    .user-avatar { width: 45px; height: 45px; border-radius: 12px; background: #f1f5f9; display: flex; align-items: center; justify-content: center; font-weight: 700; color: var(--primary); }
    .user-meta .name { display: block; font-weight: 700; color: #0f172a; font-size: 15px; }
    .user-meta .username { display: block; font-size: 12px; color: #64748b; }

    .role-badge { padding: 4px 10px; border-radius: 6px; font-size: 11px; font-weight: 700; text-transform: uppercase; }
    .role-badge.admin { background: #fee2e2; color: #ef4444; }
    .role-badge.manager { background: #e0f2fe; color: #0ea5e9; }
    
    .status-indicator { display: inline-flex; align-items: center; gap: 6px; font-weight: 600; font-size: 13px; }
    .status-indicator::before { content: ''; width: 8px; height: 8px; border-radius: 50%; }
    .status-indicator.active { color: var(--success); }
    .status-indicator.active::before { background: var(--success); }
    .status-indicator.inactive { color: #94a3b8; }
    .status-indicator.inactive::before { background: #cbd5e1; }

    /* Custom Dropdown */
    .dropdown-actions { position: relative; }
    .dropdown-menu { 
        position: absolute; 
        right: 0; 
        top: 100%; 
        background: white; 
        box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); 
        border-radius: 12px; 
        padding: 8px; 
        z-index: 1000; 
        min-width: 200px; 
        display: none;
        border: 1px solid #e2e8f0;
        margin-top: 5px;
    }
    .dropdown-menu a, .dropdown-menu button { 
        display: flex; align-items: center; gap: 10px; padding: 10px 15px; 
        color: #475569; text-decoration: none; font-size: 13px; font-weight: 500;
        border-radius: 8px; width: 100%; border: none; background: none; text-align: left;
        cursor: pointer;
    }
    .dropdown-menu a:hover, .dropdown-menu button:hover { background: #f1f5f9; color: var(--primary); }

    /* Dark Mode: Dropdown Menu */
    body.dark-theme .dropdown-menu {
        background: rgba(15, 23, 42, 0.98) !important;
        border: 1px solid rgba(255, 255, 255, 0.2) !important;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.6) !important;
    }

    body.dark-theme .dropdown-menu a,
    body.dark-theme .dropdown-menu button {
        color: #e2e8f0 !important;
    }

    body.dark-theme .dropdown-menu a:hover,
    body.dark-theme .dropdown-menu button:hover {
        background: rgba(146, 79, 194, 0.2) !important;
        color: #a78bfa !important;
    }

    body.dark-theme .dropdown-menu .text-danger {
        color: #fca5a5 !important;
    }

    body.dark-theme .dropdown-menu .text-danger:hover {
        color: #ef4444 !important;
    }

    .bulk-actions-panel { 
        background: #0f172a; color: white; padding: 15px 30px; 
        border-radius: 15px; margin-bottom: 20px; display: none;
        justify-content: space-between; align-items: center;
        animation: slideDown 0.3s ease-out;
    }

    @keyframes slideDown { from { transform: translateY(-10px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }

    /* Pagination Button Style Override */
    .pagination {
        display: flex;
        justify-content: center;
        gap: 5px;
        margin-top: 20px;
    }
    .page-item { list-style: none; }
    .page-link {
        display: inline-block;
        padding: 8px 16px;
        border-radius: 8px; /* Rounded buttons */
        background: #f1f5f9;
        color: #475569;
        text-decoration: none;
        font-weight: 600;
        font-size: 13px;
        transition: 0.2s;
        border: 1px solid transparent;
    }
    .page-item.active .page-link {
        background: var(--primary);
        color: white;
        box-shadow: 0 4px 6px -1px rgba(146, 79, 194, 0.4);
    }
    .page-item.disabled .page-link {
        opacity: 0.5;
        cursor: not-allowed;
    }
    .page-link:hover:not(.active) {
        background: #e2e8f0;
        color: #1e293b;
</style>
```
