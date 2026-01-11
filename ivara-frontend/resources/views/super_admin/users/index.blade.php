@extends('layouts.app')

@section('content')
<div class="dashboard-wrapper">
    <x-admin.header title="User Management" subtitle="Overview of all registered accounts across the platform">
        <div class="d-flex gap-2">
            <button class="btn-outline-premium">
                <i class="fas fa-file-export me-2"></i>Export CSV
            </button>
            <a href="{{ route('super_admin.admins.create') }}" class="btn-premium text-decoration-none">
                <i class="fas fa-user-plus me-2"></i>Add Administrator
            </a>
        </div>
    </x-admin.header>

    <!-- KPI Stats -->
    <div class="row g-4 mb-4">
        <div class="col-md-6 col-xl-3">
            <x-admin.metric-card label="Total Users" value="24,592" trend="+124 today" icon="fas fa-users"/>
        </div>
        <div class="col-md-6 col-xl-3">
            <x-admin.metric-card label="Verified Providers" value="1,850" trend="Active" trendColor="success" icon="fas fa-user-tie"/>
        </div>
        <div class="col-md-6 col-xl-3">
            <x-admin.metric-card label="Internal Admins" value="15" icon="fas fa-user-shield"/>
        </div>
        <div class="col-md-6 col-xl-3">
            <x-admin.metric-card label="Pending Verification" value="42" trendColor="warning" icon="fas fa-clock"/>
        </div>
    </div>

    <!-- Main Content -->
    <x-admin.card title="System Users" icon="fas fa-address-book">
        
        <!-- Filters Toolbar -->
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
            <div class="d-flex gap-2">
                <button class="btn btn-sm btn-dark rounded-pill px-3">All Users</button>
                <button class="btn btn-sm btn-light border rounded-pill px-3 text-muted">Providers</button>
                <button class="btn btn-sm btn-light border rounded-pill px-3 text-muted">Clients</button>
                <button class="btn btn-sm btn-light border rounded-pill px-3 text-muted">Admins</button>
            </div>
            <div class="input-group" style="max-width: 300px;">
                <span class="input-group-text bg-light border-end-0"><i class="fas fa-search text-muted"></i></span>
                <input type="text" class="form-control border-start-0 bg-light" placeholder="Search by name, email or ID...">
            </div>
        </div>

        <x-admin.table :headers="['User Identity', 'Role', 'Access Level', 'Status', 'Last Login', 'Actions']">
            
            <!-- Mock Row 1: Super Admin -->
            <tr>
                <td class="ps-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 40px; height: 40px;">
                            TA
                        </div>
                        <div>
                            <span class="fw-bold text-dark d-block">Tech Admin</span>
                            <small class="text-muted">tech.admin@ivara.com</small>
                        </div>
                    </div>
                </td>
                <td>
                    <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-2">Super Admin</span>
                </td>
                <td><small class="text-muted">Full System Access</small></td>
                <td><x-admin.status-badge status="active" /></td>
                <td class="text-muted small">Just now</td>
                <td>
                    <button class="btn btn-sm btn-light border text-muted" disabled><i class="fas fa-lock"></i></button>
                </td>
            </tr>

            <!-- Mock Row 2: Category Manager -->
            <tr>
                <td class="ps-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-info text-white rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 40px; height: 40px;">
                            SC
                        </div>
                        <div>
                            <span class="fw-bold text-dark d-block">Sarah Connor</span>
                            <small class="text-muted">sarah@ivara.com</small>
                        </div>
                    </div>
                </td>
                <td>
                    <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25 px-2">Manager</span>
                </td>
                <td><small class="text-muted">Technical & Repair</small></td>
                <td><x-admin.status-badge status="active" /></td>
                <td class="text-muted small">2 hours ago</td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-icon text-muted" data-bs-toggle="dropdown"><i class="fas fa-ellipsis-v"></i></button>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                            <li><a class="dropdown-item small" href="#"><i class="fas fa-edit me-2 text-muted"></i>Edit Details</a></li>
                            <li><a class="dropdown-item small" href="#"><i class="fas fa-shield-alt me-2 text-muted"></i>Permissions</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item small text-danger" href="#"><i class="fas fa-ban me-2"></i>Suspend User</a></li>
                        </ul>
                    </div>
                </td>
            </tr>

            <!-- Mock Row 3: Provider -->
             <tr>
                <td class="ps-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-gradient-warning text-white rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 40px; height: 40px;">
                            JP
                        </div>
                        <div>
                            <span class="fw-bold text-dark d-block">John Plumber</span>
                            <small class="text-muted">john.p@gmail.com</small>
                        </div>
                    </div>
                </td>
                <td>
                    <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 px-2">Provider</span>
                </td>
                <td><small class="text-muted">Standard Acc.</small></td>
                <td><x-admin.status-badge status="verified" /></td>
                <td class="text-muted small">1 day ago</td>
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

             <!-- Mock Row 4: Client -->
             <tr>
                <td class="ps-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 40px; height: 40px;">
                            MK
                        </div>
                        <div>
                            <span class="fw-bold text-dark d-block">Mary Key</span>
                            <small class="text-muted">mary.k@yahoo.com</small>
                        </div>
                    </div>
                </td>
                <td>
                    <span class="badge bg-light text-dark border px-2">Client</span>
                </td>
                <td><small class="text-muted">Basic Access</small></td>
                <td><x-admin.status-badge status="active" /></td>
                <td class="text-muted small">5 mins ago</td>
                <td>
                    <button class="btn btn-sm btn-icon text-muted"><i class="fas fa-ellipsis-v"></i></button>
                </td>
            </tr>

        </x-admin.table>

        <!-- Pagination Mock -->
        <div class="d-flex justify-content-between align-items-center p-3 border-top mt-2">
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
    </x-admin.card>
</div>

<style>
    .bg-gradient-warning {
        background: linear-gradient(135deg, #f59e0b, #d97706);
    }
</style>
@endsection
