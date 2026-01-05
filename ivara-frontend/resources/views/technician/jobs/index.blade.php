@extends('layouts.app')

@section('title', 'Assignments & Jobs')

@section('content')
<div class="technician-page-container">
    <div class="container-fluid p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="fw-bold text-primary">Assignments & Jobs</h1>
                <p class="text-muted">Track and manage your daily technical assignments.</p>
            </div>
            <div class="glass-pill p-2 px-3">
                <span class="badge bg-primary rounded-pill">12 Active Jobs</span>
            </div>
        </div>

        <div class="row g-4">
            <!-- Summary Stats -->
            <div class="col-md-3">
                <div class="glass-card p-4 text-center">
                    <div class="icon-circle bg-soft-primary text-primary mb-3 mx-auto">
                        <i class="fas fa-list-ul"></i>
                    </div>
                    <h3 class="fw-bold mb-1">24</h3>
                    <span class="text-muted small fw-bold uppercase">Total Assigned</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="glass-card p-4 text-center">
                    <div class="icon-circle bg-soft-warning text-warning mb-3 mx-auto">
                        <i class="fas fa-spinner"></i>
                    </div>
                    <h3 class="fw-bold mb-1">8</h3>
                    <span class="text-muted small fw-bold uppercase">In Progress</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="glass-card p-4 text-center">
                    <div class="icon-circle bg-soft-success text-success mb-3 mx-auto">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h3 class="fw-bold mb-1">16</h3>
                    <span class="text-muted small fw-bold uppercase">Completed</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="glass-card p-4 text-center">
                    <div class="icon-circle bg-soft-danger text-danger mb-3 mx-auto">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <h3 class="fw-bold mb-1">2</h3>
                    <span class="text-muted small fw-bold uppercase">Pending Parts</span>
                </div>
            </div>

            <!-- Jobs Table -->
            <div class="col-12">
                <div class="glass-card p-0 overflow-hidden">
                    <div class="p-4 border-bottom border-light d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold">Active Technical Assignments</h5>
                        <div class="d-flex gap-2">
                            <input type="text" class="form-control form-control-sm glass-input" placeholder="Search jobs...">
                            <select class="form-select form-select-sm glass-input">
                                <option>All Status</option>
                                <option>In Progress</option>
                                <option>Pending</option>
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4">Job ID</th>
                                    <th>Client / Device</th>
                                    <th>Issue Description</th>
                                    <th>Assigned Date</th>
                                    <th>Status</th>
                                    <th class="text-end pe-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="ps-4 font-monospace text-primary fw-bold">#JOB-2241</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm bg-soft-primary text-primary rounded-circle me-3">JD</div>
                                            <div>
                                                <div class="fw-bold">John Doe</div>
                                                <div class="small text-muted">MacBook Pro 16"</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="text-truncate d-inline-block" style="max-width: 200px;">Battery swelling and trackpad unresponsive</span></td>
                                    <td>2025-12-27</td>
                                    <td><span class="status-badge bg-soft-warning text-warning">In Progress</span></td>
                                    <td class="text-end pe-4">
                                        <button class="btn btn-sm btn-glass"><i class="fas fa-eye"></i></button>
                                        <button class="btn btn-sm btn-primary ms-1">Update</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ps-4 font-monospace text-primary fw-bold">#JOB-2238</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm bg-soft-info text-info rounded-circle me-3">SA</div>
                                            <div>
                                                <div class="fw-bold">Sarah Adams</div>
                                                <div class="small text-muted">iPhone 14 Pro</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="text-truncate d-inline-block" style="max-width: 200px;">Screen flickering after water exposure</span></td>
                                    <td>2025-12-26</td>
                                    <td><span class="status-badge bg-soft-danger text-danger">Pending Parts</span></td>
                                    <td class="text-end pe-4">
                                        <button class="btn btn-sm btn-glass"><i class="fas fa-eye"></i></button>
                                        <button class="btn btn-sm btn-primary ms-1">Update</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .technician-page-container { width: 96%; margin-left: 15px; }
    .glass-card { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.3); border-radius: 24px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
    .icon-circle { width: 50px; height: 50px; border-radius: 15px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; }
    .avatar-sm { width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 0.8rem; }
    .bg-soft-primary { background: rgba(59, 130, 246, 0.1); color: #3b82f6; }
    .bg-soft-warning { background: rgba(245, 158, 11, 0.1); color: #f59e0b; }
    .bg-soft-success { background: rgba(16, 185, 129, 0.1); color: #10b981; }
    .bg-soft-danger { background: rgba(239, 68, 68, 0.1); color: #ef4444; }
    .bg-soft-info { background: rgba(6, 182, 212, 0.1); color: #06b6d4; }
    .status-badge { padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; }
    .glass-input { background: rgba(255, 255, 255, 0.5); border: 1px solid rgba(0,0,0,0.05); border-radius: 10px; }
    .btn-glass { background: rgba(0,0,0,0.02); border: 1px solid rgba(0,0,0,0.05); border-radius: 10px; }
    .btn-glass:hover { background: rgba(0,0,0,0.05); }
    .uppercase { text-transform: uppercase; letter-spacing: 1px; }
</style>
@endsection
