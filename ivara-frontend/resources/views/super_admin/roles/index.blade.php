@extends('layouts.app')

@section('content')
<div class="dashboard-wrapper">
    <header class="pro-header">
        <div>
            <h1>Roles & Permissions</h1>
            <p>Define global user roles and access control lists.</p>
        </div>
    </header>
    <div class="pro-card glass-panel">
        <ul class="list-group list-group-flush bg-transparent">
            <li class="list-group-item bg-transparent text-white border-secondary">Super Admin <span class="badge bg-danger float-end">System</span></li>
            <li class="list-group-item bg-transparent text-white border-secondary">Admin <span class="badge bg-warning float-end">Management</span></li>
            <li class="list-group-item bg-transparent text-white border-secondary">Technician <span class="badge bg-primary float-end">User</span></li>
            <li class="list-group-item bg-transparent text-white border-secondary">Client <span class="badge bg-success float-end">User</span></li>
        </ul>
    </div>
</div>
@endsection
