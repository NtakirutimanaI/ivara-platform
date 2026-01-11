@extends('layouts.app')

@section('content')
<div class="dashboard-wrapper">
    <header class="pro-header">
        <div>
            <h1>Platform Analytics</h1>
            <p>Real-time insights across the IVARA ecosystem.</p>
        </div>
        <div class="d-flex gap-2">
            <select class="form-select pro-select form-select-sm" style="width: 150px;">
                <option>Last 7 Days</option>
                <option>Last 30 Days</option>
                <option>This Year</option>
            </select>
            <button class="btn btn-primary btn-sm"><i class="fas fa-download me-1"></i> Export Report</button>
        </div>
    </header>

    <!-- KPI Grid -->
    <div class="dashboard-grid mb-4">
        <div class="metric-card">
            <div class="d-flex justify-content-between mb-3">
                <span class="metric-title">Total Users</span>
                <i class="fas fa-users text-primary opacity-50"></i>
            </div>
            <h3 class="metric-value">124,592</h3>
            <span class="metric-trend trend-up"><i class="fas fa-arrow-up"></i> 12% vs last month</span>
        </div>
         <div class="metric-card">
            <div class="d-flex justify-content-between mb-3">
                <span class="metric-title">Total Revenue</span>
                <i class="fas fa-dollar-sign text-success opacity-50"></i>
            </div>
            <h3 class="metric-value">$8.4M</h3>
            <span class="metric-trend trend-up"><i class="fas fa-arrow-up"></i> 5.3% vs last month</span>
        </div>
         <div class="metric-card">
            <div class="d-flex justify-content-between mb-3">
                <span class="metric-title">Active Providers</span>
                <i class="fas fa-briefcase text-warning opacity-50"></i>
            </div>
            <h3 class="metric-value">15,200</h3>
            <span class="metric-trend trend-down"><i class="fas fa-arrow-down"></i> 1% vs last month</span>
        </div>
         <div class="metric-card">
            <div class="d-flex justify-content-between mb-3">
                <span class="metric-title">Platform Health</span>
                <i class="fas fa-heartbeat text-danger opacity-50"></i>
            </div>
            <h3 class="metric-value">99.98%</h3>
            <span class="text-muted small">Uptime</span>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="pro-card glass-panel mb-4" style="min-height: 400px;">
                <h4 class="mb-4">Traffic Overview</h4>
                <div class="d-flex align-items-center justify-content-center h-75 bg-dark rounded border border-secondary border-opacity-25">
                    <span class="text-muted"><i class="fas fa-chart-area fa-2x mb-2 d-block text-center"></i> Chart Placeholder (CanvasJS/ApexCharts)</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="pro-card glass-panel mb-4">
                <h4 class="mb-3">Category Distribution</h4>
                <ul class="list-group list-group-flush bg-transparent">
                    <li class="list-group-item bg-transparent text-white border-secondary d-flex justify-content-between align-items-center px-0">
                        Technical & Repair
                        <span class="badge bg-primary rounded-pill">40%</span>
                    </li>
                    <li class="list-group-item bg-transparent text-white border-secondary d-flex justify-content-between align-items-center px-0">
                        Transport
                        <span class="badge bg-info rounded-pill">25%</span>
                    </li>
                    <li class="list-group-item bg-transparent text-white border-secondary d-flex justify-content-between align-items-center px-0">
                        Agriculture
                        <span class="badge bg-success rounded-pill">20%</span>
                    </li>
                    <li class="list-group-item bg-transparent text-white border-secondary d-flex justify-content-between align-items-center px-0">
                        Others
                        <span class="badge bg-secondary rounded-pill">15%</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
