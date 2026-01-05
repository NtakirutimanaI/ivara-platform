@extends('layouts.app')

@section('title', 'Client Dashboard - Overview')

@section('content')
<div class="container-fluid" style="padding: 20px;">
    <!-- Welcome Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h2 style="color: #1e293b; font-weight: 700;">Dashboard Overview</h2>
            <p style="color: #64748b;">Welcome back, {{ Auth::user()->name ?? 'Client' }}!</p>
        </div>
    </div>

    <!-- Key Metrics Cards -->
    <div class="row mb-4">
        <!-- Metric 1: Registered Devices -->
        <div class="col-md-3 mb-3">
            <div class="card" style="border:none; border-radius:12px; box-shadow:0 4px 6px rgba(0,0,0,0.05); overflow:hidden;">
                <div class="card-body p-4" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color:white;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-1" style="opacity:0.9;">My Devices</h6>
                            <h3 class="mb-0" style="font-weight:700;">3</h3>
                        </div>
                        <div style="font-size:2rem; opacity:0.3;"><i class="fas fa-laptop"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Metric 2: Active Repairs -->
        <div class="col-md-3 mb-3">
            <div class="card" style="border:none; border-radius:12px; box-shadow:0 4px 6px rgba(0,0,0,0.05); overflow:hidden;">
                <div class="card-body p-4" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color:white;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-1" style="opacity:0.9;">Active Repairs</h6>
                            <h3 class="mb-0" style="font-weight:700;">1</h3>
                        </div>
                        <div style="font-size:2rem; opacity:0.3;"><i class="fas fa-wrench"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Metric 3: Orders -->
        <div class="col-md-3 mb-3">
            <div class="card" style="border:none; border-radius:12px; box-shadow:0 4px 6px rgba(0,0,0,0.05); overflow:hidden;">
                <div class="card-body p-4" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color:white;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-1" style="opacity:0.9;">Pending Orders</h6>
                            <h3 class="mb-0" style="font-weight:700;">2</h3>
                        </div>
                        <div style="font-size:2rem; opacity:0.3;"><i class="fas fa-shopping-bag"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Metric 4: Messages -->
        <div class="col-md-3 mb-3">
            <div class="card" style="border:none; border-radius:12px; box-shadow:0 4px 6px rgba(0,0,0,0.05); overflow:hidden;">
                <div class="card-body p-4" style="background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); color:white;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-1" style="opacity:0.9;">New Messages</h6>
                            <h3 class="mb-0" style="font-weight:700;">5</h3>
                        </div>
                        <div style="font-size:2rem; opacity:0.3;"><i class="fas fa-envelope"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Map & Recent Activity Section -->
    <div class="row">
        <!-- Nearby Map Placeholder -->
        <div class="col-lg-8 mb-4">
            <div class="card" style="border:none; border-radius:12px; box-shadow:0 4px 6px rgba(0,0,0,0.05);">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center" style="border-bottom:1px solid #f1f5f9; border-radius:12px 12px 0 0;">
                    <h5 class="mb-0" style="color:#1e293b; font-weight:600;"><i class="fas fa-map-marked-alt text-primary me-2"></i>Nearby Service Centers</h5>
                    <button class="btn btn-sm btn-outline-primary" style="border-radius:20px;">Use Current Location</button>
                </div>
                <div class="card-body p-0">
                    <div style="height: 350px; background-color: #e2e8f0; display: flex; align-items: center; justify-content: center; color: #64748b; border-radius: 0 0 12px 12px;">
                        <div class="text-center">
                            <i class="fas fa-map-marked-alt fa-3x mb-3" style="opacity:0.5;"></i>
                            <p>Map Integration Placeholder</p>
                            <small>Find certified technicians nearby</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Activities / Status -->
        <div class="col-lg-4 mb-4">
            <div class="card" style="border:none; border-radius:12px; box-shadow:0 4px 6px rgba(0,0,0,0.05); height:100%;">
                <div class="card-header bg-white py-3" style="border-bottom:1px solid #f1f5f9; border-radius:12px 12px 0 0;">
                    <h5 class="mb-0" style="color:#1e293b; font-weight:600;">Recent Activity</h5>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item p-3 border-0 d-flex align-items-start">
                            <div class="rounded-circle bg-blue-100 text-blue-600 p-2 me-3" style="background:#dbeafe; color:#2563eb;">
                                <i class="fas fa-wrench"></i>
                            </div>
                            <div>
                                <h6 class="mb-0" style="font-weight:600; color:#334155;">Repair Request #8921</h6>
                                <p class="mb-0 small text-muted">Status updated to "In Progress"</p>
                                <small class="text-xs text-muted">2 hours ago</small>
                            </div>
                        </li>
                        <li class="list-group-item p-3 border-0 d-flex align-items-start">
                            <div class="rounded-circle bg-green-100 text-green-600 p-2 me-3" style="background:#dcfce7; color:#16a34a;">
                                <i class="fas fa-check"></i>
                            </div>
                            <div>
                                <h6 class="mb-0" style="font-weight:600; color:#334155;">Order #4402 Delivered</h6>
                                <p class="mb-0 small text-muted">Your marketplace order has arrived</p>
                                <small class="text-xs text-muted">Yesterday</small>
                            </div>
                        </li>
                        <li class="list-group-item p-3 border-0 d-flex align-items-start">
                            <div class="rounded-circle bg-purple-100 text-purple-600 p-2 me-3" style="background:#ede9fe; color:#7c3aed;">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <div>
                                <h6 class="mb-0" style="font-weight:600; color:#334155;">Device Registered</h6>
                                <p class="mb-0 small text-muted">MacBook Pro M1 added to assets</p>
                                <small class="text-xs text-muted">3 days ago</small>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="card-footer bg-white text-center border-0 py-3" style="border-radius:0 0 12px 12px;">
                    <a href="#" class="text-decoration-none" style="font-weight:600; color:#2563eb;">View All Activity</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
