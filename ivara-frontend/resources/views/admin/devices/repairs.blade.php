@include('layouts.header')
@include('layouts.sidebar')

<style>
    :root {
        --primary: #924FC2;
        --primary-glow: rgba(146, 79, 194, 0.4);
        --success: #00C853;
        --warning: #FFAB00;
        --danger: #FF1744;
        --info: #2196F3;
        --bg-panel: #fdf4ff;
        --text-primary: #1e293b;
        --text-secondary: #64748b;
        --card-bg: #ffffff;
        --border-color: #e2e8f0;
        --glass-bg: rgba(255, 255, 255, 0.8);
    }

    body.dark-theme {
        --bg-panel: #0f172a !important;
        --text-primary: #f8fafc !important;
        --text-secondary: #cbd5e1 !important;
        --card-bg: rgba(30, 41, 59, 0.6) !important;
        --border-color: rgba(255, 255, 255, 0.1) !important;
        --glass-bg: rgba(15, 23, 42, 0.85) !important;
    }

    body {
        background: var(--bg-panel) !important;
        color: var(--text-primary) !important;
        font-family: 'Poppins', sans-serif;
        transition: background 0.3s, color 0.3s;
    }

    /* Main Container */
    .repairs-panel {
        width: 80%;
        max-width: 1600px;
        margin-left: auto;
        margin-right: auto;
        padding: 30px 20px;
        padding-left: 270px;
    }

    /* Page Header */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        flex-wrap: wrap;
        gap: 15px;
    }

    .page-title {
        font-size: 26px;
        font-weight: 800;
        color: var(--text-primary);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .page-title i {
        color: var(--primary);
        font-size: 24px;
    }

    .breadcrumb-nav {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        color: var(--text-secondary);
    }

    .breadcrumb-nav a {
        color: var(--primary);
        text-decoration: none;
    }

    .breadcrumb-nav a:hover {
        text-decoration: underline;
    }

    /* Stats Grid */
    .stats-grid { 
        display: grid; 
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); 
        gap: 20px; 
        margin-bottom: 30px; 
    }
    
    .stat-card { 
        background: var(--card-bg);
        border-radius: 16px; 
        padding: 20px; 
        display: flex; 
        align-items: center; 
        gap: 16px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        border: 1px solid var(--border-color);
        transition: transform 0.3s, box-shadow 0.3s;
        backdrop-filter: blur(10px);
    }
    
    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px var(--primary-glow);
    }
    
    .stat-icon { 
        width: 50px; 
        height: 50px; 
        border-radius: 12px; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        font-size: 22px;
        flex-shrink: 0;
    }

    .stat-icon.purple { background: rgba(146, 79, 194, 0.15); color: var(--primary); }
    .stat-icon.orange { background: rgba(255, 171, 0, 0.15); color: var(--warning); }
    .stat-icon.blue { background: rgba(33, 150, 243, 0.15); color: var(--info); }
    .stat-icon.green { background: rgba(0, 200, 83, 0.15); color: var(--success); }
    
    .stat-label { font-size: 12px; color: var(--text-secondary); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; }
    .stat-value { font-size: 28px; font-weight: 800; margin: 0; color: var(--text-primary); }

    /* Filter Section */
    .filter-section {
        background: var(--card-bg);
        border-radius: 16px;
        padding: 20px;
        margin-bottom: 25px;
        border: 1px solid var(--border-color);
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }

    .filter-title {
        font-size: 14px;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .filter-title i {
        color: var(--primary);
    }

    .filter-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 15px;
        align-items: end;
    }

    .filter-group label {
        display: block;
        font-size: 11px;
        font-weight: 600;
        color: var(--text-secondary);
        margin-bottom: 6px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .filter-input {
        width: 100%;
        padding: 10px 14px;
        border-radius: 10px;
        border: 1px solid var(--border-color);
        font-family: inherit;
        font-size: 13px;
        background: var(--card-bg);
        color: var(--text-primary);
        transition: all 0.3s;
    }

    body.dark-theme .filter-input {
        background: rgba(30, 41, 59, 0.8);
    }

    .filter-input:focus {
        border-color: var(--primary);
        outline: none;
        box-shadow: 0 0 0 3px var(--primary-glow);
    }

    .filter-buttons {
        display: flex;
        gap: 10px;
    }

    .btn-filter {
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 13px;
        cursor: pointer;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        border: none;
    }

    .btn-filter.primary {
        background: linear-gradient(135deg, var(--primary), #7c3aed);
        color: white;
    }

    .btn-filter.primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px var(--primary-glow);
    }

    .btn-filter.secondary {
        background: var(--card-bg);
        color: var(--text-secondary);
        border: 1px solid var(--border-color);
    }

    .btn-filter.secondary:hover {
        border-color: var(--primary);
        color: var(--primary);
    }

    /* Table Container */
    .table-container { 
        background: var(--card-bg);
        border-radius: 16px; 
        overflow: hidden; 
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        border: 1px solid var(--border-color);
    }

    .table-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
        border-bottom: 1px solid var(--border-color);
        flex-wrap: wrap;
        gap: 15px;
    }

    .table-title {
        font-size: 16px;
        font-weight: 700;
        color: var(--text-primary);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .table-title i {
        color: var(--primary);
    }

    .table-actions {
        display: flex;
        gap: 10px;
    }

    .btn-action {
        padding: 10px 18px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 13px;
        cursor: pointer;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        border: none;
    }

    .btn-action.primary {
        background: linear-gradient(135deg, var(--primary), #7c3aed);
        color: white;
    }

    .btn-action.outline {
        background: transparent;
        color: var(--text-primary);
        border: 1px solid var(--border-color);
    }

    .btn-action:hover {
        transform: translateY(-2px);
    }

    .table-scroll-wrapper {
        overflow-x: auto;
        max-width: 100%;
    }
    
    .premium-table { 
        width: 100%; 
        border-collapse: collapse;
        min-width: 1000px;
    }
    
    .premium-table thead { 
        background: linear-gradient(135deg, rgba(146, 79, 194, 0.1), rgba(124, 58, 237, 0.05));
    }
    
    body.dark-theme .premium-table thead {
        background: linear-gradient(135deg, rgba(146, 79, 194, 0.2), rgba(15, 23, 42, 0.8));
    }
    
    .premium-table th { 
        padding: 16px 18px; 
        font-size: 11px; 
        text-transform: uppercase; 
        color: var(--text-secondary);
        text-align: left; 
        font-weight: 700;
        letter-spacing: 0.5px;
        white-space: nowrap;
    }
    
    .premium-table td { 
        padding: 14px 18px; 
        border-bottom: 1px solid var(--border-color);
        color: var(--text-primary);
        font-size: 13px;
        vertical-align: middle;
    }
    
    .premium-table tbody tr {
        transition: background 0.2s;
    }

    .premium-table tbody tr:hover {
        background: rgba(146, 79, 194, 0.05);
    }

    .premium-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* Device Info Cell */
    .device-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .device-icon {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        background: linear-gradient(135deg, var(--primary), #7c3aed);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 18px;
        flex-shrink: 0;
    }

    .device-details strong {
        display: block;
        color: var(--text-primary);
        font-weight: 600;
    }

    .device-details span {
        font-size: 12px;
        color: var(--text-secondary);
    }

    /* Status Badges */
    .status-badge { 
        padding: 6px 14px; 
        border-radius: 20px; 
        font-size: 11px; 
        font-weight: 700;
        text-transform: uppercase;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        letter-spacing: 0.5px;
    }

    .status-badge::before {
        content: '';
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
    }

    .status-badge.pending { background: rgba(255, 171, 0, 0.15); color: #b27b00; }
    .status-badge.in-progress { background: rgba(33, 150, 243, 0.15); color: #0d6ebd; }
    .status-badge.completed { background: rgba(0, 200, 83, 0.15); color: #00853a; }

    body.dark-theme .status-badge.pending { background: rgba(255, 171, 0, 0.2); color: #ffab00; }
    body.dark-theme .status-badge.in-progress { background: rgba(33, 150, 243, 0.2); color: #64b5f6; }
    body.dark-theme .status-badge.completed { background: rgba(0, 200, 83, 0.2); color: #69f0ae; }

    /* Warranty Badge */
    .warranty-badge {
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
    }

    .warranty-badge.active {
        background: rgba(0, 200, 83, 0.15);
        color: #00853a;
    }

    .warranty-badge.expired {
        background: rgba(255, 23, 68, 0.15);
        color: #c4122e;
    }

    body.dark-theme .warranty-badge.active { color: #69f0ae; }
    body.dark-theme .warranty-badge.expired { color: #ff5252; }

    /* Cost Display */
    .cost-display {
        font-weight: 700;
        color: var(--primary);
    }

    /* Action Buttons */
    .action-cell {
        display: flex;
        gap: 6px;
        justify-content: flex-end;
        flex-wrap: nowrap;
    }

    .action-btn {
        width: 34px;
        height: 34px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        transition: all 0.2s;
    }

    .action-btn:hover {
        transform: scale(1.1);
    }

    .action-btn.view { background: rgba(33, 150, 243, 0.15); color: #2196F3; }
    .action-btn.view:hover { background: #2196F3; color: white; }

    .action-btn.edit { background: rgba(255, 171, 0, 0.15); color: #FFAB00; }
    .action-btn.edit:hover { background: #FFAB00; color: white; }

    .action-btn.status { background: rgba(146, 79, 194, 0.15); color: var(--primary); }
    .action-btn.status:hover { background: var(--primary); color: white; }

    .action-btn.delete { background: rgba(255, 23, 68, 0.15); color: #FF1744; }
    .action-btn.delete:hover { background: #FF1744; color: white; }

    /* Modal Styles */
    .modal-wrapper {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.75);
        backdrop-filter: blur(12px);
        z-index: 9999;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 20px;
        overflow-y: auto;
    }

    .modal-wrapper.active {
        display: flex;
    }

    body.dark-theme .modal-wrapper {
        background: rgba(0, 0, 0, 0.85);
    }

    .glass-modal {
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        width: 100%;
        max-width: 600px;
        max-height: 90vh;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.3);
        animation: modalSlideIn 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        border: 1px solid var(--border-color);
    }

    .glass-modal.small {
        max-width: 420px;
    }

    @keyframes modalSlideIn { 
        from { transform: translateY(-30px) scale(0.95); opacity: 0; } 
        to { transform: translateY(0) scale(1); opacity: 1; } 
    }

    .modal-header-premium {
        padding: 20px 25px;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: linear-gradient(135deg, rgba(146, 79, 194, 0.1), transparent);
        flex-shrink: 0;
    }

    .modal-header-premium h3 {
        margin: 0;
        font-size: 18px;
        font-weight: 700;
        color: var(--text-primary);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .modal-header-premium h3 i {
        color: var(--primary);
    }

    .btn-close {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: rgba(255, 23, 68, 0.1);
        border: none;
        font-size: 20px;
        color: #FF1744;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-close:hover {
        background: #FF1744;
        color: white;
        transform: rotate(90deg);
    }

    .modal-body {
        padding: 25px;
        overflow-y: auto;
        flex: 1;
    }

    /* Form Styles */
    .form-row {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
    }

    .form-row.single {
        grid-template-columns: 1fr;
    }

    .form-group {
        margin-bottom: 16px;
    }

    .form-group label {
        display: block;
        font-size: 12px;
        font-weight: 600;
        color: var(--text-secondary);
        margin-bottom: 6px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-control {
        width: 100%;
        padding: 12px 14px;
        border-radius: 10px;
        border: 1px solid var(--border-color);
        font-family: inherit;
        font-size: 14px;
        background: var(--card-bg);
        color: var(--text-primary);
        transition: all 0.3s;
        box-sizing: border-box;
    }

    body.dark-theme .form-control {
        background: rgba(30, 41, 59, 0.8);
    }

    .form-control:focus {
        border-color: var(--primary);
        outline: none;
        box-shadow: 0 0 0 4px var(--primary-glow);
    }

    textarea.form-control {
        resize: vertical;
        min-height: 80px;
    }

    .btn-submit {
        width: 100%;
        padding: 14px 20px;
        background: linear-gradient(135deg, var(--primary), #7c3aed);
        color: white;
        border: none;
        border-radius: 12px;
        font-weight: 700;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-top: 10px;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px var(--primary-glow);
    }

    .btn-submit.danger {
        background: linear-gradient(135deg, #FF1744, #d50000);
    }

    /* View Modal Content */
    .view-section {
        margin-bottom: 20px;
    }

    .view-section-title {
        font-size: 14px;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 12px;
        padding-bottom: 8px;
        border-bottom: 2px solid var(--border-color);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .view-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }

    .view-item {
        background: rgba(146, 79, 194, 0.05);
        padding: 12px 14px;
        border-radius: 10px;
        border: 1px solid var(--border-color);
    }

    .view-item.full {
        grid-column: 1 / -1;
    }

    .view-item-label {
        font-size: 11px;
        color: var(--text-secondary);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
    }

    .view-item-value {
        font-size: 14px;
        font-weight: 600;
        color: var(--text-primary);
    }

    /* Delete Warning */
    .delete-warning {
        text-align: center;
        padding: 20px 0;
    }

    .delete-warning-icon {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        background: rgba(255, 23, 68, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        font-size: 32px;
        color: #FF1744;
    }

    .delete-warning-text {
        color: var(--text-secondary);
        font-size: 15px;
        line-height: 1.6;
    }

    /* Pagination */
    .pagination-wrapper {
        display: flex;
        justify-content: center;
        padding: 20px;
        border-top: 1px solid var(--border-color);
    }

    .pagination {
        display: flex;
        gap: 5px;
        flex-wrap: wrap;
        justify-content: center;
    }

    .page-item { list-style: none; }

    .page-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 38px;
        height: 38px;
        padding: 0 12px;
        border-radius: 10px;
        background: var(--card-bg);
        color: var(--text-primary);
        text-decoration: none;
        font-weight: 600;
        font-size: 13px;
        transition: all 0.2s;
        border: 1px solid var(--border-color);
    }

    .page-item.active .page-link {
        background: linear-gradient(135deg, var(--primary), #7c3aed);
        color: white;
        border-color: var(--primary);
    }

    /* Alert Styles */
    .alert {
        padding: 16px 20px;
        border-radius: 12px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 12px;
        font-weight: 500;
    }

    .alert-success {
        background: rgba(0, 200, 83, 0.15);
        color: #00853a;
        border: 1px solid rgba(0, 200, 83, 0.3);
    }

    .alert-danger {
        background: rgba(255, 23, 68, 0.15);
        color: #c4122e;
        border: 1px solid rgba(255, 23, 68, 0.3);
    }

    body.dark-theme .alert-success { color: #69f0ae; }
    body.dark-theme .alert-danger { color: #ff5252; }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: var(--text-secondary);
    }

    .empty-state i {
        font-size: 64px;
        opacity: 0.3;
        margin-bottom: 20px;
    }

    .empty-state p {
        margin: 0;
        font-size: 16px;
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .repairs-panel {
            width: 95%;
            padding-left: 270px;
        }
    }

    @media (max-width: 992px) { 
        .repairs-panel { 
            width: 100%;
            padding-left: 20px;
            padding-right: 20px;
        }
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .filter-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .form-row {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 600px) {
        .stats-grid, .filter-grid {
            grid-template-columns: 1fr;
        }
        .view-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="repairs-panel">
    <!-- Breadcrumb -->
    <div class="breadcrumb-nav">
        <a href="{{ route('admin.devices.index') }}"><i class="fas fa-mobile-alt"></i> Devices</a>
        <i class="fas fa-chevron-right"></i>
        <span>Repairs Management</span>
    </div>

    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-tools"></i> Repairs Management
        </h1>
    </div>

    <!-- Stats Grid -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon purple">
                <i class="fas fa-clipboard-list"></i>
            </div>
            <div>
                <div class="stat-label">Total Repairs</div>
                <div class="stat-value">{{ $repairs->total() }}</div>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon orange">
                <i class="fas fa-hourglass-half"></i>
            </div>
            <div>
                <div class="stat-label">Pending</div>
                <div class="stat-value">{{ $repairs->where('repair_status', 'Pending')->count() }}</div>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon blue">
                <i class="fas fa-spinner"></i>
            </div>
            <div>
                <div class="stat-label">In Progress</div>
                <div class="stat-value">{{ $repairs->where('repair_status', 'In Progress')->count() }}</div>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon green">
                <i class="fas fa-check-double"></i>
            </div>
            <div>
                <div class="stat-label">Completed</div>
                <div class="stat-value">{{ $repairs->where('repair_status', 'Completed')->count() }}</div>
            </div>
        </div>
    </div>

    <!-- Alerts -->
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
        </div>
    @endif

    <!-- Filter Section -->
    <div class="filter-section">
        <div class="filter-title">
            <i class="fas fa-filter"></i> Filter Repairs
        </div>
        <form method="GET" action="{{ route('admin.devices.repairs') }}">
            <div class="filter-grid">
                <div class="filter-group">
                    <label>Search</label>
                    <input type="text" name="search" value="{{ request('search') }}" class="filter-input" placeholder="Device, owner, technician...">
                </div>
                <div class="filter-group">
                    <label>Status</label>
                    <select name="status" class="filter-input">
                        <option value="">All Status</option>
                        <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="In Progress" {{ request('status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="Completed" {{ request('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label>From Date</label>
                    <input type="date" name="from" value="{{ request('from') }}" class="filter-input">
                </div>
                <div class="filter-group">
                    <label>To Date</label>
                    <input type="date" name="to" value="{{ request('to') }}" class="filter-input">
                </div>
                <div class="filter-group filter-buttons">
                    <button type="submit" class="btn-filter primary">
                        <i class="fas fa-search"></i> Filter
                    </button>
                    <a href="{{ route('admin.devices.repairs') }}" class="btn-filter secondary">
                        <i class="fas fa-undo"></i> Reset
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- Table Container -->
    <div class="table-container">
        <div class="table-header">
            <div class="table-title">
                <i class="fas fa-wrench"></i> Repair Records
            </div>
            <div class="table-actions">
                <a href="{{ route('admin.devices.index') }}" class="btn-action outline">
                    <i class="fas fa-arrow-left"></i> Back to Devices
                </a>
                <button class="btn-action primary" onclick="openModal('addRepairModal')">
                    <i class="fas fa-plus"></i> New Repair
                </button>
            </div>
        </div>

        <div class="table-scroll-wrapper">
            <table class="premium-table" id="repairsTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Device</th>
                        <th>Owner</th>
                        <th>Technician</th>
                        <th>Problem</th>
                        <th>Status</th>
                        <th>Warranty</th>
                        <th>Est. Cost</th>
                        <th>Received</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($repairs as $index => $repair)
                    <tr>
                        <td>{{ ($repairs->currentPage()-1) * $repairs->perPage() + $index + 1 }}</td>
                        <td>
                            <div class="device-info">
                                <div class="device-icon">
                                    <i class="fas fa-mobile-alt"></i>
                                </div>
                                <div class="device-details">
                                    <strong>{{ $repair->device_name }}</strong>
                                    <span>{{ $repair->brand }} - {{ $repair->model }}</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <strong>{{ $repair->device_owner ?? '-' }}</strong>
                            <div style="font-size: 12px; color: var(--text-secondary);">{{ $repair->contact_number ?? '' }}</div>
                        </td>
                        <td>{{ $repair->technician ?? '-' }}</td>
                        <td>
                            <span title="{{ $repair->problem_description }}">
                                {{ Str::limit($repair->problem_description ?? '-', 25) }}
                            </span>
                        </td>
                        <td>
                            @php
                                $statusClass = match($repair->repair_status) {
                                    'Completed' => 'completed',
                                    'In Progress' => 'in-progress',
                                    default => 'pending'
                                };
                            @endphp
                            <span class="status-badge {{ $statusClass }}">{{ $repair->repair_status ?? 'Pending' }}</span>
                        </td>
                        <td>
                            <span class="warranty-badge {{ $repair->warranty_status == 'Under Warranty' ? 'active' : 'expired' }}">
                                {{ $repair->warranty_status == 'Under Warranty' ? 'Active' : 'Expired' }}
                            </span>
                        </td>
                        <td>
                            <span class="cost-display">{{ $repair->estimated_cost ? number_format($repair->estimated_cost) . ' RWF' : '-' }}</span>
                        </td>
                        <td>{{ $repair->received_date ? \Carbon\Carbon::parse($repair->received_date)->format('M d, Y') : '-' }}</td>
                        <td>
                            <div class="action-cell">
                                <button class="action-btn view" onclick="openViewRepairModal({{ $repair->id }})" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="action-btn edit" onclick="openEditRepairModal({{ $repair->id }})" title="Edit Repair">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="action-btn status" onclick="openStatusRepairModal({{ $repair->id }}, '{{ $repair->repair_status }}')" title="Update Status">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                                <button class="action-btn delete" onclick="openDeleteRepairModal({{ $repair->id }}, '{{ $repair->device_name }}')" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10">
                            <div class="empty-state">
                                <i class="fas fa-tools"></i>
                                <p>No repair records found. Create your first repair entry to get started.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination-wrapper">
            {{ $repairs->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

<!-- VIEW REPAIR MODAL -->
<div id="viewRepairModal" class="modal-wrapper">
    <div class="glass-modal">
        <div class="modal-header-premium">
            <h3><i class="fas fa-eye"></i> Repair Details</h3>
            <button class="btn-close" onclick="closeModal('viewRepairModal')">&times;</button>
        </div>
        <div class="modal-body" id="viewRepairContent">
            <!-- Content loaded dynamically -->
        </div>
    </div>
</div>

<!-- EDIT REPAIR MODAL -->
<div id="editRepairModal" class="modal-wrapper">
    <div class="glass-modal">
        <div class="modal-header-premium">
            <h3><i class="fas fa-edit"></i> Update Repair</h3>
            <button class="btn-close" onclick="closeModal('editRepairModal')">&times;</button>
        </div>
        <form id="editRepairForm" method="POST" class="modal-body">
            @csrf
            @method('PUT')
            <div class="form-row">
                <div class="form-group">
                    <label>Device Name</label>
                    <input type="text" name="device_name" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label>Brand</label>
                    <input type="text" name="brand" class="form-control" readonly>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Technician</label>
                    <input type="text" name="technician" class="form-control" placeholder="Assigned technician">
                </div>
                <div class="form-group">
                    <label>Estimated Cost (RWF)</label>
                    <input type="number" name="estimated_cost" class="form-control" placeholder="0">
                </div>
            </div>
            <div class="form-row single">
                <div class="form-group">
                    <label>Solved Problems</label>
                    <textarea name="solved_problems" class="form-control" rows="2" placeholder="Describe what was fixed..."></textarea>
                </div>
            </div>
            <div class="form-row single">
                <div class="form-group">
                    <label>Recommendations</label>
                    <textarea name="recommendations" class="form-control" rows="2" placeholder="Any recommendations for the client..."></textarea>
                </div>
            </div>
            <div class="form-row single">
                <div class="form-group">
                    <label>Repair Status *</label>
                    <select name="repair_status" class="form-control" required>
                        <option value="Pending">Pending</option>
                        <option value="In Progress">In Progress</option>
                        <option value="Completed">Completed</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn-submit">
                <i class="fas fa-save"></i> Save Changes
            </button>
        </form>
    </div>
</div>

<!-- STATUS UPDATE MODAL -->
<div id="statusRepairModal" class="modal-wrapper">
    <div class="glass-modal small">
        <div class="modal-header-premium">
            <h3><i class="fas fa-sync-alt"></i> Update Status</h3>
            <button class="btn-close" onclick="closeModal('statusRepairModal')">&times;</button>
        </div>
        <form id="statusRepairForm" method="POST" class="modal-body">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label>Select New Status</label>
                <select name="repair_status" id="repairStatusSelect" class="form-control" required>
                    <option value="Pending">Pending</option>
                    <option value="In Progress">In Progress</option>
                    <option value="Completed">Completed</option>
                </select>
            </div>
            <button type="submit" class="btn-submit">
                <i class="fas fa-check"></i> Update Status
            </button>
        </form>
    </div>
</div>

<!-- DELETE REPAIR MODAL -->
<div id="deleteRepairModal" class="modal-wrapper">
    <div class="glass-modal small">
        <div class="modal-header-premium">
            <h3><i class="fas fa-trash"></i> Delete Repair</h3>
            <button class="btn-close" onclick="closeModal('deleteRepairModal')">&times;</button>
        </div>
        <form id="deleteRepairForm" method="POST" class="modal-body">
            @csrf
            @method('DELETE')
            <div class="delete-warning">
                <div class="delete-warning-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <p class="delete-warning-text">
                    Are you sure you want to delete the repair for<br>
                    <strong id="deleteRepairDevice"></strong>?<br>
                    This action cannot be undone.
                </p>
            </div>
            <button type="submit" class="btn-submit danger">
                <i class="fas fa-trash"></i> Yes, Delete Repair
            </button>
        </form>
    </div>
</div>

<!-- ADD REPAIR MODAL -->
<div id="addRepairModal" class="modal-wrapper">
    <div class="glass-modal">
        <div class="modal-header-premium">
            <h3><i class="fas fa-plus"></i> New Repair Entry</h3>
            <button class="btn-close" onclick="closeModal('addRepairModal')">&times;</button>
        </div>
        <form action="{{ route('admin.repairs.store') }}" method="POST" class="modal-body">
            @csrf
            <div class="form-row">
                <div class="form-group">
                    <label>Device Type *</label>
                    <select name="device_type" class="form-control" required>
                        <option value="">Select Type</option>
                        <option value="Phone">Phone</option>
                        <option value="Tablet">Tablet</option>
                        <option value="Laptop">Laptop</option>
                        <option value="Computer">Computer</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Device Name *</label>
                    <input type="text" name="device_name" class="form-control" placeholder="e.g., iPhone 14 Pro" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Brand *</label>
                    <input type="text" name="brand" class="form-control" placeholder="e.g., Apple" required>
                </div>
                <div class="form-group">
                    <label>Model *</label>
                    <input type="text" name="model" class="form-control" placeholder="e.g., A2890" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Serial Number *</label>
                    <input type="text" name="serial_number" class="form-control" placeholder="Device serial" required>
                </div>
                <div class="form-group">
                    <label>Operating System</label>
                    <input type="text" name="operating_system" class="form-control" placeholder="e.g., iOS 17">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Device Owner *</label>
                    <input type="text" name="device_owner" class="form-control" placeholder="Owner name" required>
                </div>
                <div class="form-group">
                    <label>Contact Number *</label>
                    <input type="text" name="contact_number" class="form-control" placeholder="+250..." required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Received Date *</label>
                    <input type="date" name="received_date" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Warranty Status *</label>
                    <select name="warranty_status" class="form-control" required>
                        <option value="Under Warranty">Under Warranty</option>
                        <option value="Out of Warranty">Out of Warranty</option>
                    </select>
                </div>
            </div>
            <div class="form-row single">
                <div class="form-group">
                    <label>Problem Description *</label>
                    <textarea name="problem_description" class="form-control" rows="3" placeholder="Describe the issue..." required></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Assigned Technician</label>
                    <input type="text" name="technician" class="form-control" placeholder="Technician name">
                </div>
                <div class="form-group">
                    <label>Estimated Cost (RWF)</label>
                    <input type="number" name="estimated_cost" class="form-control" placeholder="0">
                </div>
            </div>
            <button type="submit" class="btn-submit">
                <i class="fas fa-save"></i> Create Repair Entry
            </button>
        </form>
    </div>
</div>

<script>
// Modal Functions
function openModal(id) {
    document.getElementById(id).classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeModal(id) {
    document.getElementById(id).classList.remove('active');
    document.body.style.overflow = '';
}

// Close modal on backdrop click
document.querySelectorAll('.modal-wrapper').forEach(modal => {
    modal.addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.remove('active');
            document.body.style.overflow = '';
        }
    });
});

// Close modal on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        document.querySelectorAll('.modal-wrapper.active').forEach(modal => {
            modal.classList.remove('active');
        });
        document.body.style.overflow = '';
    }
});

// View Repair Modal
function openViewRepairModal(id) {
    fetch(`/admin/repairs/${id}`)
        .then(res => res.json())
        .then(data => {
            let statusClass = data.repair_status === 'Completed' ? 'completed' : 
                              data.repair_status === 'In Progress' ? 'in-progress' : 'pending';
            let html = `
                <div class="view-section">
                    <div class="view-section-title">
                        <i class="fas fa-mobile-alt"></i> Device Information
                    </div>
                    <div class="view-grid">
                        <div class="view-item">
                            <div class="view-item-label">Device Name</div>
                            <div class="view-item-value">${data.device_name || '-'}</div>
                        </div>
                        <div class="view-item">
                            <div class="view-item-label">Brand / Model</div>
                            <div class="view-item-value">${data.brand || '-'} / ${data.model || '-'}</div>
                        </div>
                        <div class="view-item">
                            <div class="view-item-label">Serial Number</div>
                            <div class="view-item-value">${data.serial_number || '-'}</div>
                        </div>
                        <div class="view-item">
                            <div class="view-item-label">Operating System</div>
                            <div class="view-item-value">${data.operating_system || '-'}</div>
                        </div>
                    </div>
                </div>
                <div class="view-section">
                    <div class="view-section-title">
                        <i class="fas fa-user"></i> Owner Information
                    </div>
                    <div class="view-grid">
                        <div class="view-item">
                            <div class="view-item-label">Owner Name</div>
                            <div class="view-item-value">${data.device_owner || '-'}</div>
                        </div>
                        <div class="view-item">
                            <div class="view-item-label">Contact Number</div>
                            <div class="view-item-value">${data.contact_number || '-'}</div>
                        </div>
                    </div>
                </div>
                <div class="view-section">
                    <div class="view-section-title">
                        <i class="fas fa-tools"></i> Repair Information
                    </div>
                    <div class="view-grid">
                        <div class="view-item full">
                            <div class="view-item-label">Problem Description</div>
                            <div class="view-item-value">${data.problem_description || '-'}</div>
                        </div>
                        <div class="view-item">
                            <div class="view-item-label">Technician</div>
                            <div class="view-item-value">${data.technician || '-'}</div>
                        </div>
                        <div class="view-item">
                            <div class="view-item-label">Status</div>
                            <div class="view-item-value"><span class="status-badge ${statusClass}">${data.repair_status || 'Pending'}</span></div>
                        </div>
                        <div class="view-item">
                            <div class="view-item-label">Warranty Status</div>
                            <div class="view-item-value">${data.warranty_status || '-'}</div>
                        </div>
                        <div class="view-item">
                            <div class="view-item-label">Estimated Cost</div>
                            <div class="view-item-value" style="color: var(--primary); font-weight: 700;">${data.estimated_cost ? Number(data.estimated_cost).toLocaleString() + ' RWF' : '-'}</div>
                        </div>
                        ${data.solved_problems ? `<div class="view-item full">
                            <div class="view-item-label">Solved Problems</div>
                            <div class="view-item-value">${data.solved_problems}</div>
                        </div>` : ''}
                        ${data.recommendations ? `<div class="view-item full">
                            <div class="view-item-label">Recommendations</div>
                            <div class="view-item-value">${data.recommendations}</div>
                        </div>` : ''}
                    </div>
                </div>
            `;
            document.getElementById('viewRepairContent').innerHTML = html;
            openModal('viewRepairModal');
        })
        .catch(err => {
            console.error('Error:', err);
            alert('Failed to load repair details');
        });
}

// Edit Repair Modal
function openEditRepairModal(id) {
    fetch(`/admin/repairs/${id}`)
        .then(res => res.json())
        .then(data => {
            const form = document.getElementById('editRepairForm');
            form.action = `/admin/repairs/${id}`;
            form.device_name.value = data.device_name || '';
            form.brand.value = data.brand || '';
            form.technician.value = data.technician || '';
            form.estimated_cost.value = data.estimated_cost || '';
            form.solved_problems.value = data.solved_problems || '';
            form.recommendations.value = data.recommendations || '';
            form.repair_status.value = data.repair_status || 'Pending';
            openModal('editRepairModal');
        })
        .catch(err => {
            console.error('Error:', err);
            alert('Failed to load repair details');
        });
}

// Status Update Modal
function openStatusRepairModal(id, currentStatus) {
    const form = document.getElementById('statusRepairForm');
    form.action = `/admin/repairs/${id}/status`;
    document.getElementById('repairStatusSelect').value = currentStatus || 'Pending';
    openModal('statusRepairModal');
}

// Delete Repair Modal
function openDeleteRepairModal(id, deviceName) {
    const form = document.getElementById('deleteRepairForm');
    form.action = `/admin/repairs/${id}`;
    document.getElementById('deleteRepairDevice').textContent = deviceName;
    openModal('deleteRepairModal');
}
</script>
