@extends('layouts.app')

@section('content')
<div class="dashboard-wrapper">
    <header class="pro-header">
        <div>
            <h1>Assign Admins</h1>
            <p>Delegate category-specific responsibilities to admin staff.</p>
        </div>
    </header>

    <div class="pro-card glass-panel mb-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0">Staff Assignment Console</h4>
            <div class="input-group" style="width: 300px;">
                <span class="input-group-text bg-transparent border-secondary text-white"><i class="fas fa-search"></i></span>
                <input type="text" class="form-control pro-input" placeholder="Search admins...">
            </div>
        </div>

        <div class="table-responsive">
            <table class="pro-table">
                <thead>
                    <tr>
                        <th>Admin User</th>
                        <th>Current Role</th>
                        <th>Assigned Scope</th>
                        <th>Workload</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="bg-primary rounded-circle me-3 d-flex align-items-center justify-content-center text-white fw-bold" style="width: 40px; height: 40px;">JS</div>
                                <div>
                                    <div class="fw-bold">Jane Smith</div>
                                    <small class="text-muted">jane.s@ivara.com</small>
                                </div>
                            </div>
                        </td>
                        <td>Category Manager</td>
                        <td><span class="badge bg-info text-dark">Technical & Repair</span></td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="progress flex-grow-1" style="height: 6px; width: 80px;">
                                    <div class="progress-bar bg-success" style="width: 45%"></div>
                                </div>
                                <span class="small">45%</span>
                            </div>
                        </td>
                        <td>
                             <button class="btn btn-sm btn-outline-primary">Reassign</button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="bg-warning rounded-circle me-3 d-flex align-items-center justify-content-center text-dark fw-bold" style="width: 40px; height: 40px;">MK</div>
                                <div>
                                    <div class="fw-bold">Mike K.</div>
                                    <small class="text-muted">mike.k@ivara.com</small>
                                </div>
                            </div>
                        </td>
                        <td>Moderator</td>
                        <td><span class="badge bg-secondary">Global (Unassigned)</span></td>
                        <td>
                             <div class="d-flex align-items-center gap-2">
                                <div class="progress flex-grow-1" style="height: 6px; width: 80px;">
                                    <div class="progress-bar bg-info" style="width: 10%"></div>
                                </div>
                                <span class="small">10%</span>
                            </div>
                        </td>
                        <td>
                             <button class="btn btn-sm btn-primary">Assign Scope</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
