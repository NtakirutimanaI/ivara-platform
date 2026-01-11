@extends('layouts.app')

@section('content')
<div class="dashboard-wrapper">
    <header class="pro-header">
        <div>
            <h1>Global Settings</h1>
            <p>System-wide configuration and maintenance controls.</p>
        </div>
    </header>

    <div class="pro-card glass-panel mb-4">
        <h4 class="mb-4"><i class="fas fa-globe me-2"></i>General Configuration</h4>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Platform Name</label>
                <input type="text" class="form-control pro-input" value="IVARA Platform">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Support Email</label>
                <input type="email" class="form-control pro-input" value="support@ivara.com">
            </div>
            <div class="col-12 mb-3">
                <label class="form-label">System Timezone</label>
                <select class="form-select pro-select">
                    <option>UTC</option>
                    <option selected>Africa/Kigali (CAT)</option>
                    <option>America/New_York (EST)</option>
                </select>
            </div>
        </div>
    </div>

    <div class="pro-card glass-panel border-danger border-start border-4">
        <h4 class="text-danger mb-3"><i class="fas fa-exclamation-triangle me-2"></i>Danger Zone</h4>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h6 class="mb-1">Maintenance Mode</h6>
                <small class="text-muted">Disable all user access except Super Admins.</small>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="maintenance">
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h6 class="mb-1">Clear Application Cache</h6>
                <small class="text-muted">Force refresh system configuration and views.</small>
            </div>
            <button class="btn btn-outline-danger btn-sm">Clear Cache</button>
        </div>
    </div>
</div>
@endsection
