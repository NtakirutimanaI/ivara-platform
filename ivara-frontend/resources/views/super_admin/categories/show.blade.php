@extends('layouts.app')

@section('content')
<div class="dashboard-wrapper">
    <!-- Header Component -->
    <x-admin.header 
        :title="$category['name']" 
        subtitle="Control Center & Analytics"
    >
        <a href="{{ route('super_admin.categories.edit', $slug) }}" class="btn-secondary-premium text-decoration-none">
            <i class="fas fa-cog me-2"></i> Settings
        </a>
        <a href="{{ route('marketplace.index', ['category' => $slug]) }}" target="_blank" class="btn-premium text-decoration-none">
            <i class="fas fa-external-link-alt me-2"></i> Live Site
        </a>
    </x-admin.header>

    <!-- Metrics Grid -->
    <div class="row g-4 mb-5">
        <div class="col-md-6 col-xl-3">
            <x-admin.metric-card 
                label="Active Services" 
                value="42" 
                trend="+12%" 
                trendColor="success" 
                icon="fas fa-concierge-bell"
            />
        </div>
        <div class="col-md-6 col-xl-3">
            <x-admin.metric-card 
                label="Total Providers" 
                value="158" 
                trend="New" 
                trendColor="primary" 
                icon="fas fa-users"
            />
        </div>
        <div class="col-md-6 col-xl-3">
            <x-admin.metric-card 
                label="Monthly Revenue" 
                value="$12.5k" 
                icon="fas fa-dollar-sign"
            />
        </div>
        <div class="col-md-6 col-xl-3">
            <x-admin.metric-card 
                label="System Health" 
                value="99.9%" 
                trend="Stable" 
                trendColor="info" 
                icon="fas fa-server"
            />
        </div>
    </div>

    <div class="row g-4">
        <!-- Main Management Area -->
        <div class="col-lg-8">
            <x-admin.card title="Management Modules" icon="fas fa-th-large" class="h-100">
                <div class="row g-4">
                    <!-- Services Module -->
                    <div class="col-md-4">
                        <a href="{{ route('super_admin.services.index', ['category' => $slug]) }}" class="text-decoration-none">
                            <div class="hover-glass p-4 rounded-4 text-center h-100 border border-light bg-light bg-opacity-10">
                                <div class="icon-circle mx-auto text-primary bg-white shadow-sm mb-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; border-radius: 50%;">
                                    <i class="fas fa-concierge-bell fa-lg"></i>
                                </div>
                                <h6 class="fw-bold text-dark">Services</h6>
                                <p class="text-muted small mb-3">Catalog & Pricing</p>
                                <span class="btn-link text-primary text-decoration-none fs-7 fw-bold">Manage &rarr;</span>
                            </div>
                        </a>
                    </div>
                    
                    <!-- Providers Module -->
                    <div class="col-md-4">
                        <a href="{{ route('super_admin.businesses.index', ['category' => $slug]) }}" class="text-decoration-none">
                            <div class="hover-glass p-4 rounded-4 text-center h-100 border border-light bg-light bg-opacity-10">
                                <div class="icon-circle mx-auto text-warning bg-white shadow-sm mb-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; border-radius: 50%;">
                                    <i class="fas fa-users-cog fa-lg"></i>
                                </div>
                                <h6 class="fw-bold text-dark">Providers</h6>
                                <p class="text-muted small mb-3">Verifications</p>
                                <span class="btn-link text-warning text-decoration-none fs-7 fw-bold">View All &rarr;</span>
                            </div>
                        </a>
                    </div>

                    <!-- Finance Module -->
                    <div class="col-md-4">
                        <a href="{{ route('super_admin.payments.index', ['category' => $slug]) }}" class="text-decoration-none">
                            <div class="hover-glass p-4 rounded-4 text-center h-100 border border-light bg-light bg-opacity-10">
                                <div class="icon-circle mx-auto text-success bg-white shadow-sm mb-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; border-radius: 50%;">
                                    <i class="fas fa-file-invoice-dollar fa-lg"></i>
                                </div>
                                <h6 class="fw-bold text-dark">Finance</h6>
                                <p class="text-muted small mb-3">Payouts & Fees</p>
                                <span class="btn-link text-success text-decoration-none fs-7 fw-bold">Overview &rarr;</span>
                            </div>
                        </a>
                    </div>
                </div>

                <hr class="my-4 border-light opacity-50">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold text-muted text-uppercase fs-7 mb-0">Recent Audit Logs</h6>
                    <a href="{{ route('super_admin.logs.audit') }}" class="btn-link small">View All</a>
                </div>
                <!-- Mini Log Table -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-muted fs-7">
                            <tr>
                                <th class="border-0 rounded-start ps-3">User</th>
                                <th class="border-0">Action</th>
                                <th class="border-0 rounded-end text-end pe-3">Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="ps-3"><div class="d-flex align-items-center gap-2"><div class="bg-primary rounded-circle text-white d-flex align-items-center justify-content-center" style="width: 24px; height: 24px;">JD</div> <span class="fw-bold small">John Doe</span></div></td>
                                <td class="small text-muted">Updated generic service pricing</td>
                                <td class="text-end pe-3 small text-muted">2m ago</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </x-admin.card>
        </div>

        <!-- Sidebar Area -->
        <div class="col-lg-4">
            <x-admin.card title="Configuration" icon="fas fa-sliders-h" class="mb-4">
                <div class="text-center py-4">
                    <x-admin.status-badge status="active" />
                    <p class="text-muted mt-3 small px-3">
                        This category is currently <strong class="text-success">Active</strong> and serving requests from the public marketplace.
                    </p>
                </div>
                <div class="d-grid gap-2">
                    <a href="{{ route('super_admin.categories.edit', $slug) }}" class="btn btn-light border text-muted fw-bold btn-sm">
                        <i class="fas fa-pause me-2"></i>Pause Operations
                    </a>
                    <a href="{{ route('super_admin.categories.edit', $slug) }}" class="btn btn-light border text-muted fw-bold btn-sm">
                        <i class="fas fa-wrench me-2"></i>Maintenance Mode
                    </a>
                </div>
            </x-admin.card>

            <div class="bg-gradient-primary text-white p-4 rounded-4 shadow-sm position-relative overflow-hidden">
                <div class="position-absolute top-0 end-0 p-3 opacity-25">
                    <i class="fas fa-rocket fa-4x"></i>
                </div>
                <h5 class="fw-bold position-relative">Growth Campaign</h5>
                <p class="small opacity-75 position-relative mb-3">Boost visibility for {{ $category['name'] }} services.</p>
                <button class="btn btn-light text-primary fw-bold rounded-pill w-100 shadow-sm position-relative" onclick="alert('Campaign started!')">Start Campaign</button>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-gradient-primary { background: linear-gradient(135deg, #6366f1, #8b5cf6); }
    .fs-7 { font-size: 0.75rem; }
    .btn-light:hover { background: #f1f5f9; }
</style>
@endsection
