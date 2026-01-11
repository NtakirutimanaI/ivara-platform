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

    <!-- KPI Stats -->
    <div class="d-flex gap-3 mb-4">
        <div class="metric-glass">
            <div class="metric-icon icon-blue">
                <i class="fas fa-users"></i>
            </div>
            <div>
                <span class="text-muted small d-block fw-bold text-uppercase" style="font-size: 0.7rem;">Total Users</span>
                <span class="h5 fw-bold mb-0">24,592</span>
                <small class="text-success d-block" style="font-size: 0.7rem;">+124 today</small>
            </div>
        </div>
        <div class="metric-glass">
            <div class="metric-icon icon-green">
                <i class="fas fa-user-tie"></i>
            </div>
            <div>
                <span class="text-muted small d-block fw-bold text-uppercase" style="font-size: 0.7rem;">Verified Providers</span>
                <span class="h5 fw-bold mb-0">1,850</span>
                <small class="text-success d-block" style="font-size: 0.7rem;">Active</small>
            </div>
        </div>
        <div class="metric-glass">
            <div class="metric-icon icon-purple">
                <i class="fas fa-user-shield"></i>
            </div>
            <div>
                <span class="text-muted small d-block fw-bold text-uppercase" style="font-size: 0.7rem;">Internal Admins</span>
                <span class="h5 fw-bold mb-0">15</span>
            </div>
        </div>
        <div class="metric-glass">
            <div class="metric-icon icon-orange">
                <i class="fas fa-clock"></i>
            </div>
            <div>
                <span class="text-muted small d-block fw-bold text-uppercase" style="font-size: 0.7rem;">Pending Verification</span>
                <span class="h5 fw-bold mb-0">42</span>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="glass-panel">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold mb-0 text-dark">System Users</h3>
            
            <!-- Filters Toolbar -->
            <div class="d-flex gap-2">
                <div class="input-group" style="max-width: 300px;">
                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-search text-muted"></i></span>
                    <input type="text" class="form-control border-start-0 bg-light" placeholder="Search by name, email or ID...">
                </div>
                <button class="btn-glass text-dark"><i class="fas fa-filter me-2"></i>Filter</button>
            </div>
        </div>
        
        <div class="d-flex flex-wrap gap-2 mb-4">
            <button class="btn-glass btn-primary">All Users</button>
            <button class="btn-glass text-muted">Providers</button>
            <button class="btn-glass text-muted">Clients</button>
            <button class="btn-glass text-muted">Admins</button>
        </div>

        <table class="table-custom">
            <thead>
                <tr>
                    <th>User Identity</th>
                    <th>Role</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Last Login</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $categoryName => $categoryUsers)
                    @foreach($categoryUsers as $user)
                    <tr class="table-row">
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 40px; height: 40px; background: linear-gradient(135deg, #4F46E5 0%, #4338ca 100%) !important;">
                                    {{ strtoupper(substr($user['name'], 0, 2)) }}
                                </div>
                                <div>
                                    <span class="fw-bold text-dark d-block">{{ $user['name'] }}</span>
                                    <small class="text-muted">{{ $user['email'] }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border px-2 rounded-pill">{{ $user['role'] }}</span>
                        </td>
                        <td><small class="text-muted fw-bold">{{ $user['category'] }}</small></td>
                        <td><x-admin.status-badge :status="$user['status']" /></td>
                        <td class="text-muted small">--</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-icon text-muted" data-bs-toggle="dropdown"><i class="fas fa-ellipsis-v"></i></button>
                                <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                                    <li><a class="dropdown-item small" href="#"><i class="fas fa-eye me-2 text-muted"></i>View Profile</a></li>
                                    <li><a class="dropdown-item small" href="#"><i class="fas fa-history me-2 text-muted"></i>Activity Log</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item small text-danger" href="#"><i class="fas fa-ban me-2"></i>Ban Account</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>

        <!-- Pagination Mock -->
        <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
            <span class="text-muted small">Showing 1-10 of 24,592 users</span>
            <nav>
                <ul class="pagination pagination-sm mb-0">
                    <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item active"><a class="page-link bg-primary border-primary" href="#">1</a></li>
                    <li class="page-item"><a class="page-link text-muted" href="#">2</a></li>
                    <li class="page-item"><a class="page-link text-muted" href="#">3</a></li>
                    <li class="page-item"><a class="page-link text-muted" href="#">Next</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<style>
    .dashboard-page .content .dashboard-wrapper {
        --primary: #4F46E5;
        --secondary: #64748B; 
        padding-top: 40px !important; 
    }
    .glass-panel {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border-radius: 16px;
        border: 1px solid rgba(255, 255, 255, 0.5);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        padding: 20px;
        overflow-x: auto;
    }
    
    /* Small Glass Metrics */
    .metric-glass {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.5);
        border-radius: 12px;
        padding: 12px 15px;
        display: flex;
        align-items: center;
        gap: 15px;
        flex: 1;
        transition: transform 0.2s;
        min-width: 180px;
    }
    .metric-glass:hover {
        transform: translateY(-3px);
        background: rgba(255, 255, 255, 0.85);
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }
    .metric-icon {
        width: 38px; height: 38px;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.1rem;
    }
    .icon-blue { background: rgba(79, 70, 229, 0.1) !important; color: #4F46E5 !important; }
    .icon-green { background: rgba(16, 185, 129, 0.1) !important; color: #10B981 !important; }
    .icon-purple { background: rgba(147, 51, 234, 0.1) !important; color: #9333EA !important; }
    .icon-orange { background: rgba(245, 158, 11, 0.1) !important; color: #F59E0B !important; }

    /* Dark Mode */
    body.dark-mode .glass-panel, body.dark-mode .metric-glass { background: #1f2937 !important; border-color: #374151; }
    body.dark-mode h1, body.dark-mode h3, body.dark-mode .h5 { color: #fff !important; }
    body.dark-mode p, body.dark-mode th, body.dark-mode td, body.dark-mode span, body.dark-mode small { color: #9ca3af !important; }
    body.dark-mode .table-row:hover { background: #374151 !important; }

    .table-custom { width: 100%; border-collapse: collapse; }
    .table-custom th { text-align: left; padding: 15px; color: #64748b; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; border-bottom: 1px solid #e2e8f0; }
    .table-custom td { padding: 15px 10px; color: #1e293b; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
    .table-row:hover { background: #f8fafc; transition: 0.2s; }
    .table-custom th:last-child, .table-custom td:last-child { width: 120px; text-align: center; }
    
    .score-badge {
        padding: 5px 12px; border-radius: 20px; font-weight: 700; font-size: 0.85rem;
    }
    .score-high { background: #dcfce7; color: #166534; }
    .score-med { background: #fef9c3; color: #854d0e; }
    .score-low { background: #fee2e2; color: #991b1b; }

    /* Tabs */
    .tabs-header { display: flex; gap: 20px; margin-bottom: 25px; border-bottom: 1px solid #e5e7eb; padding-bottom: 10px; }
    .tab-btn {
        background: none; border: none; font-size: 1rem; font-weight: 600; color: #64748b;
        padding: 10px 20px; cursor: pointer; position: relative;
    }
    .tab-btn.active { color: var(--primary); }
    .tab-btn.active::after {
        content: ''; position: absolute; bottom: -11px; left: 0; width: 100%; height: 3px; background: var(--primary); border-radius: 3px 3px 0 0;
    }
    body.dark-mode .tab-btn { color: #9ca3af; }
    body.dark-mode .tab-btn.active { color: #818cf8; }
    body.dark-mode .tab-btn.active::after { background: #818cf8; }
    body.dark-mode .tabs-header { border-color: #374151; }

    .tab-content { display: none; animation: fadeIn 0.3s ease; }
    .tab-content.active { display: block; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }

    /* Modal Styles */
    .modal-overlay {
        position: fixed; top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0, 0, 0, 0.5); backdrop-filter: blur(5px);
        display: flex; justify-content: center; align-items: center; z-index: 1000;
        opacity: 0; visibility: hidden; transition: all 0.3s;
    }
    .modal-overlay.active { opacity: 1; visibility: visible; }
    .modal-glass {
        background: rgba(255, 255, 255, 0.95); width: 500px; padding: 30px; border-radius: 20px;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1); transform: scale(0.95); transition: all 0.3s;
    }
    .modal-overlay.active .modal-glass { transform: scale(1); }
    .btn-glass { 
        padding: 6px 14px; 
        border-radius: 10px; 
        border: 1px solid rgba(255, 255, 255, 0.1); 
        cursor: pointer; 
        font-weight: 600; 
        font-size: 0.85rem;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        display: inline-flex;
        align-items: center;
        gap: 6px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }
    .btn-success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        box-shadow: 0 4px 10px rgba(16, 185, 129, 0.2);
    }
    .btn-primary { 
        background: linear-gradient(135deg, #4F46E5 0%, #4338ca 100%); 
        color: white;
        box-shadow: 0 4px 10px rgba(79, 70, 229, 0.2); 
    }
    .btn-glass:hover {
        transform: translateY(-2px);
        filter: brightness(1.1);
    }
    .btn-glass:active { transform: translateY(0); }
</style>
@endsection
