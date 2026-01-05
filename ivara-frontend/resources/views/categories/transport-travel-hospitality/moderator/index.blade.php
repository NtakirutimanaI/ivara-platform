@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body { background-color: #f1f5f9; font-family: 'Segoe UI', sans-serif; }
    .mod-card { background: white; border-radius: 8px; padding: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
    .flag-count { font-size: 2.5rem; font-weight: bold; color: #ef4444; }
</style>
<div class="container-fluid p-4">
    <h3 class="fw-bold mb-4 text-secondary">Moderation Dashboard</h3>

    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="mod-card text-center">
                <h6 class="text-uppercase text-muted fw-bold">Pending Flags</h6>
                <div class="flag-count">15</div>
                <button class="btn btn-outline-danger btn-sm mt-3 w-100">Review Queue</button>
            </div>
        </div>
        <div class="col-md-3">
            <div class="mod-card text-center">
                <h6 class="text-uppercase text-muted fw-bold">User Reports</h6>
                <div class="flag-count text-warning">8</div>
                <button class="btn btn-outline-warning btn-sm mt-3 w-100">Investigate</button>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mod-card h-100">
                <h6 class="fw-bold mb-3">System Health</h6>
                <div class="d-flex align-items-center mb-2">
                    <span class="me-3" style="width: 100px;">Spam Filter</span>
                    <div class="progress flex-grow-1" style="height: 6px;">
                        <div class="progress-bar bg-success" style="width: 98%"></div>
                    </div>
                    <span class="ms-3 small text-muted">98%</span>
                </div>
                <div class="d-flex align-items-center">
                    <span class="me-3" style="width: 100px;">User Trust</span>
                    <div class="progress flex-grow-1" style="height: 6px;">
                        <div class="progress-bar bg-primary" style="width: 85%"></div>
                    </div>
                     <span class="ms-3 small text-muted">85%</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
