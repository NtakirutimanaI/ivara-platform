@extends('layouts.app')

@section('title', $categoryName . ' ' . $role . ' Dashboard')

@section('content')
<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold display-5 mb-1 text-primary">{{ $categoryName }}</h1>
            <p class="text-muted lead mb-0">{{ $role }} Control Center</p>
        </div>
        <div class="status-pill online">
            <span class="dot"></span> Authorized: {{ $user->name }}
        </div>
    </div>

    <div class="alert alert-info border-0 shadow-sm rounded-4 p-4">
        <div class="d-flex align-items-center">
            <div class="fs-1 me-4"><i class="fas fa-construction text-info"></i></div>
            <div>
                <h4 class="fw-bold mb-1">Module Under Construction</h4>
                <p class="mb-0">This specific dashboard for <strong>{{ $role }}</strong> in <strong>{{ $categoryName }}</strong> is being optimized. You have full access to your category resources via the sidebar.</p>
            </div>
        </div>
    </div>

    <!-- Bento Grid Placeholder -->
    <div class="row g-4 mt-2">
        <div class="col-md-3">
            <div class="bento-card bg-glass p-4 text-center">
                <i class="fas fa-users-cog fs-1 text-primary mb-3"></i>
                <h5 class="fw-bold">Management</h5>
                <p class="small text-muted">Access your team and providers.</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="bento-card bg-glass p-4 text-center">
                <i class="fas fa-chart-pie fs-1 text-success mb-3"></i>
                <h5 class="fw-bold">Analytics</h5>
                <p class="small text-muted">View category-specific performance.</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="bento-card bg-glass p-4 text-center">
                <i class="fas fa-shield-alt fs-1 text-warning mb-3"></i>
                <h5 class="fw-bold">Security</h5>
                <p class="small text-muted">Privacy and access logs active.</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="bento-card bg-glass p-4 text-center">
                <i class="fas fa-headset fs-1 text-danger mb-3"></i>
                <h5 class="fw-bold">Support</h5>
                <p class="small text-muted">Direct line to system super-admin.</p>
            </div>
        </div>
    </div>
</div>

<style>
    .bento-card {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.2);
        border-radius: 20px;
        transition: 0.3s;
    }
    .bento-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.05); }
    .status-pill { 
        background: rgba(16, 185, 129, 0.1); color: #10b981; padding: 5px 15px; 
        border-radius: 20px; font-weight: 700; font-size: 0.9rem; display: flex; align-items: center; 
    }
    .status-pill .dot { width: 8px; height: 8px; background: #10b981; border-radius: 50%; margin-right: 10px; }
</style>
@endsection
