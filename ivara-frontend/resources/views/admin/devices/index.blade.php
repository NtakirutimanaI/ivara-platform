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

    /* Main Container - 80% width centered */
    .devices-management-panel {
        width: 80%;
        max-width: 1600px;
        margin-left: auto;
        margin-right: auto;
        padding: 30px 20px;
        padding-left: 270px; /* Account for sidebar */
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

    /* Stats Grid */
    .stats-grid { 
        display: grid; 
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); 
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
        width: 48px; 
        height: 48px; 
        border-radius: 12px; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        font-size: 20px;
        flex-shrink: 0;
    }
    
    .primary .stat-icon { background: rgba(146, 79, 194, 0.15); color: var(--primary); }
    .success .stat-icon { background: rgba(0, 200, 83, 0.15); color: var(--success); }
    .warning .stat-icon { background: rgba(255, 171, 0, 0.15); color: var(--warning); }
    .info .stat-icon { background: rgba(33, 150, 243, 0.15); color: var(--info); }
    
    .stat-label { font-size: 12px; color: var(--text-secondary); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; }
    .stat-value { font-size: 26px; font-weight: 800; margin: 0; color: var(--text-primary); }

    /* Toolbar */
    .toolbar { 
        display: flex; 
        justify-content: space-between; 
        align-items: center; 
        margin-bottom: 25px; 
        flex-wrap: wrap;
        gap: 15px;
    }
    
    .toolbar-left {
        display: flex;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
    }
    
    .search-bar { 
        background: var(--card-bg);
        border-radius: 12px; 
        height: 48px; 
        display: flex; 
        align-items: center; 
        padding: 0 16px; 
        gap: 10px; 
        min-width: 280px;
        max-width: 350px;
        border: 1px solid var(--border-color);
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    .search-bar:focus-within {
        border-color: var(--primary);
        box-shadow: 0 0 0 4px var(--primary-glow);
    }
    
    .search-bar input { 
        border: none; 
        outline: none; 
        width: 100%; 
        font-size: 14px; 
        background: transparent;
        color: var(--text-primary);
    }
    
    .search-bar i { color: var(--text-secondary); }

    .action-buttons { 
        display: flex; 
        gap: 10px; 
        flex-wrap: wrap;
    }

    /* Buttons */
    .btn-primary { 
        background: linear-gradient(135deg, var(--primary), #7c3aed);
        color: white; 
        border: none; 
        padding: 12px 20px; 
        border-radius: 12px; 
        font-weight: 600; 
        cursor: pointer;
        transition: all 0.3s;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }
    
    .btn-primary:hover { 
        transform: translateY(-2px); 
        box-shadow: 0 8px 20px var(--primary-glow); 
    }
    
    .btn-outline { 
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        color: var(--text-primary);
        padding: 12px 20px; 
        border-radius: 12px; 
        font-weight: 600; 
        cursor: pointer;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }
    
    .btn-outline:hover {
        border-color: var(--primary);
        color: var(--primary);
        background: rgba(146, 79, 194, 0.05);
    }

    /* Table Container */
    .table-container { 
        background: var(--card-bg);
        border-radius: 16px; 
        overflow: hidden; 
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        border: 1px solid var(--border-color);
    }

    .table-scroll-wrapper {
        overflow-x: auto;
        max-width: 100%;
    }
    
    .premium-table { 
        width: 100%; 
        border-collapse: collapse;
        min-width: 900px;
    }
    
    .premium-table thead { 
        background: linear-gradient(135deg, rgba(146, 79, 194, 0.1), rgba(124, 58, 237, 0.05));
    }
    
    body.dark-theme .premium-table thead {
        background: linear-gradient(135deg, rgba(146, 79, 194, 0.2), rgba(15, 23, 42, 0.8));
    }
    
    .premium-table th { 
        padding: 16px 20px; 
        font-size: 11px; 
        text-transform: uppercase; 
        color: var(--text-secondary);
        text-align: left; 
        font-weight: 700;
        letter-spacing: 0.5px;
        white-space: nowrap;
    }
    
    .premium-table td { 
        padding: 14px 20px; 
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

    /* IMEI Cell */
    .imei-cell {
        font-size: 11px;
        line-height: 1.6;
        max-width: 120px;
    }

    .imei-item {
        display: block;
        background: rgba(146, 79, 194, 0.08);
        padding: 2px 6px;
        border-radius: 4px;
        margin-bottom: 2px;
        font-family: 'Fira Code', monospace;
    }

    .imei-item:last-child {
        margin-bottom: 0;
    }

    /* Serial Code */
    .serial-code {
        background: rgba(146, 79, 194, 0.1);
        padding: 4px 8px;
        border-radius: 6px;
        font-size: 11px;
        font-family: 'Fira Code', monospace;
        display: inline-block;
    }

    /* Status Badges */
    .status-badge { 
        padding: 6px 12px; 
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
    .status-badge.active { background: rgba(0, 200, 83, 0.15); color: #00853a; }
    .status-badge.inactive { background: rgba(255, 23, 68, 0.15); color: #c4122e; }
    .status-badge.repair { background: rgba(33, 150, 243, 0.15); color: #0d6ebd; }
    .status-badge.repaired { background: rgba(0, 200, 83, 0.15); color: #00853a; }

    body.dark-theme .status-badge.pending { background: rgba(255, 171, 0, 0.2); color: #ffab00; }
    body.dark-theme .status-badge.active { background: rgba(0, 200, 83, 0.2); color: #00c853; }
    body.dark-theme .status-badge.inactive { background: rgba(255, 23, 68, 0.2); color: #ff5252; }
    body.dark-theme .status-badge.repair { background: rgba(33, 150, 243, 0.2); color: #64b5f6; }
    body.dark-theme .status-badge.repaired { background: rgba(0, 200, 83, 0.2); color: #69f0ae; }

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
        max-width: 550px;
        max-height: 90vh;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.3);
        animation: modalSlideIn 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        border: 1px solid var(--border-color);
    }

    .glass-modal.small {
        max-width: 400px;
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

    .form-control::placeholder {
        color: var(--text-secondary);
        opacity: 0.7;
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

    .btn-submit.danger:hover {
        box-shadow: 0 8px 20px rgba(255, 23, 68, 0.4);
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
        padding: 10px 14px;
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
        box-shadow: 0 4px 12px var(--primary-glow);
    }
    
    .page-link:hover:not(.active) {
        background: rgba(146, 79, 194, 0.1);
        color: var(--primary);
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

    body.dark-theme .alert-success {
        color: #69f0ae;
    }

    body.dark-theme .alert-danger {
        color: #ff5252;
    }

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
        .devices-management-panel {
            width: 95%;
            padding-left: 270px;
        }
    }

    @media (max-width: 992px) { 
        .devices-management-panel { 
            width: 100%;
            padding-left: 20px;
            padding-right: 20px;
        }
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .form-row {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 600px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
        .toolbar {
            flex-direction: column;
            align-items: stretch;
        }
        .search-bar {
            min-width: 100%;
            max-width: 100%;
        }
        .action-buttons {
            width: 100%;
            justify-content: stretch;
        }
        .action-buttons > * {
            flex: 1;
            justify-content: center;
        }
        .view-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="devices-management-panel">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-mobile-alt"></i> Device Management
        </h1>
    </div>

    <!-- Stats Grid -->
    <div class="stats-grid">
        <div class="stat-card primary">
            <div class="stat-icon">
                <i class="fas fa-mobile-alt"></i>
            </div>
            <div>
                <div class="stat-label">Total Devices</div>
                <div class="stat-value">{{ $devices->total() }}</div>
            </div>
        </div>
        
        <div class="stat-card success">
            <div class="stat-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div>
                <div class="stat-label">Active</div>
                <div class="stat-value">{{ $devices->where('status', 'active')->count() }}</div>
            </div>
        </div>
        
        <div class="stat-card warning">
            <div class="stat-icon">
                <i class="fas fa-tools"></i>
            </div>
            <div>
                <div class="stat-label">In Repair</div>
                <div class="stat-value">{{ $devices->where('status', 'repair')->count() }}</div>
            </div>
        </div>
        
        <div class="stat-card info">
            <div class="stat-icon">
                <i class="fas fa-clock"></i>
            </div>
            <div>
                <div class="stat-label">Pending</div>
                <div class="stat-value">{{ $devices->where('status', 'pending')->count() }}</div>
            </div>
        </div>
    </div>

    <!-- Alerts -->
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle"></i>
            @foreach($errors->all() as $error) {{ $error }}<br> @endforeach
        </div>
    @endif

    <!-- Toolbar -->
    <div class="toolbar">
        <div class="toolbar-left">
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" id="searchInput" placeholder="Search devices..." onkeyup="filterTable()">
            </div>
        </div>
        
        <div class="action-buttons">
            <a href="{{ route('admin.devices.repairs') }}" class="btn-outline">
                <i class="fas fa-wrench"></i> Manage Repairs
            </a>
            <button class="btn-primary" onclick="openModal('deviceModal')">
                <i class="fas fa-plus"></i> Register Device
            </button>
        </div>
    </div>

    <!-- Table Container -->
    <div class="table-container">
        <div class="table-scroll-wrapper">
            <table class="premium-table" id="devicesTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Device Info</th>
                        <th>Serial / IMEI</th>
                        <th>Type / OS</th>
                        <th>Status</th>
                        <th>Location</th>
                        <th>Dates</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($devices as $index => $device)
                    <tr>
                        <td>{{ ($devices->currentPage()-1) * $devices->perPage() + $index + 1 }}</td>
                        <td>
                            <strong style="display: block; color: var(--text-primary);">{{ $device->brand }}</strong>
                            <span style="font-size: 12px; color: var(--text-secondary);">{{ $device->model }}</span>
                        </td>
                        <td>
                            <code class="serial-code">{{ $device->serial_number }}</code>
                            <div class="imei-cell" style="margin-top: 4px;">
                                @if($device->imei_1)<span class="imei-item">{{ $device->imei_1 }}</span>@endif
                                @if($device->imei_2)<span class="imei-item">{{ $device->imei_2 }}</span>@endif
                                @if($device->imei_3_or_mac_or_plate)<span class="imei-item">{{ $device->imei_3_or_mac_or_plate }}</span>@endif
                            </div>
                        </td>
                        <td>
                            <span style="display: block;">{{ $device->type ?? '-' }}</span>
                            <span style="font-size: 12px; color: var(--text-secondary);">{{ $device->os ?? '-' }}</span>
                        </td>
                        <td><span class="status-badge {{ $device->status }}">{{ $device->status }}</span></td>
                        <td>{{ $device->location ?? '-' }}</td>
                        <td>
                            <div style="font-size: 12px;">
                                <div><i class="fas fa-shopping-cart" style="width: 14px; color: var(--text-secondary);"></i> {{ $device->purchase_date ? \Carbon\Carbon::parse($device->purchase_date)->format('M d, Y') : '-' }}</div>
                                <div><i class="fas fa-shield-alt" style="width: 14px; color: var(--text-secondary);"></i> {{ $device->warranty_expiry ? \Carbon\Carbon::parse($device->warranty_expiry)->format('M d, Y') : '-' }}</div>
                            </div>
                        </td>
                        <td>
                            <div class="action-cell">
                                <button class="action-btn view" onclick="openViewModal({{ $device->id }})" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="action-btn edit" onclick="openEditModal({{ $device->id }})" title="Edit Device">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="action-btn status" onclick="openStatusModal({{ $device->id }}, '{{ $device->status }}')" title="Change Status">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                                <button class="action-btn delete" onclick="openDeleteModal({{ $device->id }})" title="Delete Device">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">
                            <div class="empty-state">
                                <i class="fas fa-inbox"></i>
                                <p>No devices found. Register your first device to get started.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination-wrapper">
            {{ $devices->appends(['pageSize' => request('pageSize')])->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

<!-- REGISTER DEVICE MODAL -->
<div id="deviceModal" class="modal-wrapper">
    <div class="glass-modal">
        <div class="modal-header-premium">
            <h3><i class="fas fa-mobile-alt"></i> Register New Device</h3>
            <button class="btn-close" onclick="closeModal('deviceModal')">&times;</button>
        </div>
        <form action="{{ route('admin.devices.store') }}" method="POST" class="modal-body">
            @csrf
            <div class="form-row">
                <div class="form-group">
                    <label>Brand *</label>
                    <input type="text" name="brand" class="form-control" placeholder="e.g., Apple, Samsung" required>
                </div>
                <div class="form-group">
                    <label>Model *</label>
                    <input type="text" name="model" class="form-control" placeholder="e.g., iPhone 13" required>
                </div>
            </div>
            <div class="form-row single">
                <div class="form-group">
                    <label>Serial Number *</label>
                    <input type="text" name="serial_number" class="form-control" placeholder="Device serial number" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>IMEI 1</label>
                    <input type="text" name="imei_1" class="form-control" placeholder="Primary IMEI">
                </div>
                <div class="form-group">
                    <label>IMEI 2</label>
                    <input type="text" name="imei_2" class="form-control" placeholder="Secondary IMEI">
                </div>
            </div>
            <div class="form-row single">
                <div class="form-group">
                    <label>IMEI 3 / MAC / Plate</label>
                    <input type="text" name="imei_3_or_mac_or_plate" class="form-control" placeholder="Third IMEI, MAC address, or plate">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Device Type</label>
                    <select name="type" class="form-control">
                        <option value="">Select Type</option>
                        <option value="Phone">Phone</option>
                        <option value="Tablet">Tablet</option>
                        <option value="Laptop">Laptop</option>
                        <option value="Computer">Computer</option>
                        <option value="Smartwatch">Smartwatch</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Operating System</label>
                    <select name="os" class="form-control">
                        <option value="">Select OS</option>
                        <option value="iOS">iOS</option>
                        <option value="Android">Android</option>
                        <option value="Windows">Windows</option>
                        <option value="macOS">macOS</option>
                        <option value="Linux">Linux</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Status *</label>
                    <select name="status" class="form-control" required>
                        <option value="" disabled selected>Select Status</option>
                        <option value="pending">Pending</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="repair">Repair</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Location</label>
                    <input type="text" name="location" class="form-control" placeholder="Device location">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Purchase Date</label>
                    <input type="date" name="purchase_date" class="form-control">
                </div>
                <div class="form-group">
                    <label>Warranty Expiry</label>
                    <input type="date" name="warranty_expiry" class="form-control">
                </div>
            </div>
            <div class="form-row single">
                <div class="form-group">
                    <label>Notes</label>
                    <textarea name="notes" class="form-control" rows="2" placeholder="Additional notes..."></textarea>
                </div>
            </div>
            <button type="submit" class="btn-submit">
                <i class="fas fa-save"></i> Save Device
            </button>
        </form>
    </div>
</div>

<!-- CLIENT MODAL -->
<div id="clientModal" class="modal-wrapper">
    <div class="glass-modal">
        <div class="modal-header-premium">
            <h3><i class="fas fa-user"></i> Register Client (Device Owner)</h3>
            <button class="btn-close" onclick="closeModal('clientModal')">&times;</button>
        </div>
        <form action="{{ route('admin.clients.store') }}" method="POST" class="modal-body">
            @csrf
            <input type="hidden" name="device_id" id="client_device_id">
            <div class="form-row">
                <div class="form-group">
                    <label>Full Name *</label>
                    <input type="text" name="name" class="form-control" placeholder="John Doe" required>
                </div>
                <div class="form-group">
                    <label>Phone Number *</label>
                    <input type="text" name="phone" class="form-control" placeholder="+250 ..." required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" class="form-control" placeholder="john@example.com">
                </div>
                <div class="form-group">
                    <label>National ID</label>
                    <input type="text" name="national_id" class="form-control" placeholder="National ID number">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Gender</label>
                    <select name="gender" class="form-control">
                        <option value="" disabled selected>Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Date of Birth</label>
                    <input type="date" name="date_of_birth" class="form-control">
                </div>
            </div>
            <div class="form-row single">
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" class="form-control" placeholder="Street address">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>City</label>
                    <input type="text" name="city" class="form-control" placeholder="Kigali">
                </div>
                <div class="form-group">
                    <label>Country</label>
                    <input type="text" name="country" class="form-control" value="Rwanda">
                </div>
            </div>
            <div class="form-row single">
                <div class="form-group">
                    <label>Notes</label>
                    <textarea name="notes" class="form-control" rows="2" placeholder="Additional notes..."></textarea>
                </div>
            </div>
            <button type="submit" class="btn-submit">
                <i class="fas fa-save"></i> Save Client
            </button>
        </form>
    </div>
</div>

<!-- VIEW DEVICE MODAL -->
<div id="viewModal" class="modal-wrapper">
    <div class="glass-modal">
        <div class="modal-header-premium">
            <h3><i class="fas fa-eye"></i> Device Details</h3>
            <button class="btn-close" onclick="closeModal('viewModal')">&times;</button>
        </div>
        <div class="modal-body" id="viewContent">
            <!-- Content will be loaded dynamically -->
        </div>
    </div>
</div>

<!-- EDIT DEVICE MODAL -->
<div id="editModal" class="modal-wrapper">
    <div class="glass-modal">
        <div class="modal-header-premium">
            <h3><i class="fas fa-edit"></i> Edit Device</h3>
            <button class="btn-close" onclick="closeModal('editModal')">&times;</button>
        </div>
        <form id="editForm" method="POST" class="modal-body">
            @csrf
            @method('PUT')
            <div class="form-row">
                <div class="form-group">
                    <label>Brand *</label>
                    <input type="text" name="brand" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Model *</label>
                    <input type="text" name="model" class="form-control" required>
                </div>
            </div>
            <div class="form-row single">
                <div class="form-group">
                    <label>Serial Number *</label>
                    <input type="text" name="serial_number" class="form-control" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>IMEI 1</label>
                    <input type="text" name="imei_1" class="form-control">
                </div>
                <div class="form-group">
                    <label>IMEI 2</label>
                    <input type="text" name="imei_2" class="form-control">
                </div>
            </div>
            <div class="form-row single">
                <div class="form-group">
                    <label>IMEI 3 / MAC / Plate</label>
                    <input type="text" name="imei_3_or_mac_or_plate" class="form-control">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Device Type</label>
                    <select name="type" class="form-control">
                        <option value="">Select Type</option>
                        <option value="Phone">Phone</option>
                        <option value="Tablet">Tablet</option>
                        <option value="Laptop">Laptop</option>
                        <option value="Computer">Computer</option>
                        <option value="Smartwatch">Smartwatch</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Operating System</label>
                    <select name="os" class="form-control">
                        <option value="">Select OS</option>
                        <option value="iOS">iOS</option>
                        <option value="Android">Android</option>
                        <option value="Windows">Windows</option>
                        <option value="macOS">macOS</option>
                        <option value="Linux">Linux</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Status *</label>
                    <select name="status" class="form-control" required>
                        <option value="pending">Pending</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="repair">Repair</option>
                        <option value="repaired">Repaired</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Location</label>
                    <input type="text" name="location" class="form-control">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Purchase Date</label>
                    <input type="date" name="purchase_date" class="form-control">
                </div>
                <div class="form-group">
                    <label>Warranty Expiry</label>
                    <input type="date" name="warranty_expiry" class="form-control">
                </div>
            </div>
            <div class="form-row single">
                <div class="form-group">
                    <label>Notes</label>
                    <textarea name="notes" class="form-control" rows="2"></textarea>
                </div>
            </div>
            <button type="submit" class="btn-submit">
                <i class="fas fa-save"></i> Update Device
            </button>
        </form>
    </div>
</div>

<!-- DELETE DEVICE MODAL -->
<div id="deleteModal" class="modal-wrapper">
    <div class="glass-modal small">
        <div class="modal-header-premium">
            <h3><i class="fas fa-trash"></i> Delete Device</h3>
            <button class="btn-close" onclick="closeModal('deleteModal')">&times;</button>
        </div>
        <form id="deleteForm" method="POST" class="modal-body">
            @csrf
            @method('DELETE')
            <div class="delete-warning">
                <div class="delete-warning-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <p class="delete-warning-text">
                    Are you sure you want to delete this device?<br>
                    <strong>This action cannot be undone.</strong>
                </p>
            </div>
            <button type="submit" class="btn-submit danger">
                <i class="fas fa-trash"></i> Yes, Delete Device
            </button>
        </form>
    </div>
</div>

<!-- CHANGE STATUS MODAL -->
<div id="statusModal" class="modal-wrapper">
    <div class="glass-modal small">
        <div class="modal-header-premium">
            <h3><i class="fas fa-sync-alt"></i> Change Status</h3>
            <button class="btn-close" onclick="closeModal('statusModal')">&times;</button>
        </div>
        <form id="statusForm" method="POST" class="modal-body">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label>Select New Status</label>
                <select name="status" id="statusSelect" class="form-control" required>
                    <option value="pending">Pending</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                    <option value="repair">Repair</option>
                    <option value="repaired">Repaired</option>
                </select>
            </div>
            <button type="submit" class="btn-submit">
                <i class="fas fa-check"></i> Update Status
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

// Search filter
function filterTable() {
    let input = document.getElementById("searchInput");
    let filter = input.value.toLowerCase();
    let table = document.getElementById("devicesTable");
    let trs = table.getElementsByTagName("tr");
    for (let i = 1; i < trs.length; i++) {
        let tds = trs[i].getElementsByTagName("td");
        let show = false;
        for (let j = 0; j < tds.length - 1; j++) {
            if (tds[j].textContent.toLowerCase().indexOf(filter) > -1) {
                show = true;
                break;
            }
        }
        trs[i].style.display = show ? "" : "none";
    }
}

// View Device Modal
function openViewModal(id) {
    fetch(`/admin/devices/${id}`)
        .then(res => res.json())
        .then(data => {
            let html = `
                <div class="view-section">
                    <div class="view-section-title">
                        <i class="fas fa-mobile-alt"></i> Device Information
                    </div>
                    <div class="view-grid">
                        <div class="view-item">
                            <div class="view-item-label">Brand</div>
                            <div class="view-item-value">${data.brand || '-'}</div>
                        </div>
                        <div class="view-item">
                            <div class="view-item-label">Model</div>
                            <div class="view-item-value">${data.model || '-'}</div>
                        </div>
                        <div class="view-item">
                            <div class="view-item-label">Serial Number</div>
                            <div class="view-item-value">${data.serial_number || '-'}</div>
                        </div>
                        <div class="view-item">
                            <div class="view-item-label">Status</div>
                            <div class="view-item-value"><span class="status-badge ${data.status}">${data.status}</span></div>
                        </div>
                        <div class="view-item">
                            <div class="view-item-label">Type</div>
                            <div class="view-item-value">${data.type || '-'}</div>
                        </div>
                        <div class="view-item">
                            <div class="view-item-label">Operating System</div>
                            <div class="view-item-value">${data.os || '-'}</div>
                        </div>
                        <div class="view-item full">
                            <div class="view-item-label">IMEI Numbers</div>
                            <div class="view-item-value">${data.imei_1 || '-'}${data.imei_2 ? ', ' + data.imei_2 : ''}${data.imei_3_or_mac_or_plate ? ', ' + data.imei_3_or_mac_or_plate : ''}</div>
                        </div>
                        <div class="view-item">
                            <div class="view-item-label">Location</div>
                            <div class="view-item-value">${data.location || '-'}</div>
                        </div>
                        <div class="view-item">
                            <div class="view-item-label">Purchase Date</div>
                            <div class="view-item-value">${data.purchase_date || '-'}</div>
                        </div>
                        <div class="view-item">
                            <div class="view-item-label">Warranty Expiry</div>
                            <div class="view-item-value">${data.warranty_expiry || '-'}</div>
                        </div>
                        ${data.notes ? `<div class="view-item full">
                            <div class="view-item-label">Notes</div>
                            <div class="view-item-value">${data.notes}</div>
                        </div>` : ''}
                    </div>
                </div>
                ${data.client ? `
                <div class="view-section">
                    <div class="view-section-title">
                        <i class="fas fa-user"></i> Client Information
                    </div>
                    <div class="view-grid">
                        <div class="view-item">
                            <div class="view-item-label">Name</div>
                            <div class="view-item-value">${data.client.name || '-'}</div>
                        </div>
                        <div class="view-item">
                            <div class="view-item-label">Phone</div>
                            <div class="view-item-value">${data.client.phone || '-'}</div>
                        </div>
                        <div class="view-item">
                            <div class="view-item-label">Email</div>
                            <div class="view-item-value">${data.client.email || '-'}</div>
                        </div>
                        <div class="view-item">
                            <div class="view-item-label">National ID</div>
                            <div class="view-item-value">${data.client.national_id || '-'}</div>
                        </div>
                    </div>
                </div>` : ''}
            `;
            document.getElementById('viewContent').innerHTML = html;
            openModal('viewModal');
        })
        .catch(err => {
            console.error('Error fetching device:', err);
            alert('Failed to load device details');
        });
}

// Edit Device Modal
function openEditModal(id) {
    fetch(`/admin/devices/${id}`)
        .then(res => res.json())
        .then(device => {
            const form = document.getElementById('editForm');
            form.action = `/admin/devices/${id}`;
            form.brand.value = device.brand || '';
            form.model.value = device.model || '';
            form.serial_number.value = device.serial_number || '';
            form.imei_1.value = device.imei_1 || '';
            form.imei_2.value = device.imei_2 || '';
            form.imei_3_or_mac_or_plate.value = device.imei_3_or_mac_or_plate || '';
            form.type.value = device.type || '';
            form.os.value = device.os || '';
            form.status.value = device.status || '';
            form.purchase_date.value = device.purchase_date ? device.purchase_date.split('T')[0] : '';
            form.warranty_expiry.value = device.warranty_expiry ? device.warranty_expiry.split('T')[0] : '';
            form.location.value = device.location || '';
            form.notes.value = device.notes || '';
            openModal('editModal');
        })
        .catch(err => {
            console.error('Error fetching device:', err);
            alert('Failed to load device details');
        });
}

// Delete Device Modal
function openDeleteModal(id) {
    const form = document.getElementById('deleteForm');
    form.action = `/admin/devices/${id}`;
    openModal('deleteModal');
}

// Status Change Modal
function openStatusModal(id, currentStatus) {
    const form = document.getElementById('statusForm');
    form.action = `/admin/devices/${id}/status`;
    document.getElementById('statusSelect').value = currentStatus || 'pending';
    openModal('statusModal');
}

// Auto-open Client Modal after Device save
@if(session('device_saved_id'))
    document.getElementById('client_device_id').value = '{{ session("device_saved_id") }}';
    openModal('clientModal');
@endif
</script>
