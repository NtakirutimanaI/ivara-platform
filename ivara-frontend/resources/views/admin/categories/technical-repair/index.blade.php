@extends('layouts.app')

@section('title', 'Admin Dashboard - Technical & Repair')

@section('content')
<div class="dashboard-wrapper">
    <!-- Header Section -->
    <header class="pro-header">
        <div>
            <h1>Technical & Repair</h1>
            <p>Managing business operations and technician performance</p>
        </div>
        <div class="d-flex gap-3 align-items-center">
            <a href="#" class="action-btn secondary">
                <i class="fas fa-cog"></i> Settings
            </a>
            <button class="action-btn btn-primary">
                <i class="fas fa-plus"></i> New Service
            </button>
        </div>
    </header>

    <!-- Metrics Grid -->
    <div class="dashboard-grid">
        <div class="metric-card glass-panel">
            <div class="metric-icon" style="background: linear-gradient(135deg, #6366f1, #8b5cf6);">
                <i class="fas fa-users-cog"></i>
            </div>
            <div class="metric-content">
                <div class="metric-label">Technicians</div>
                <div class="metric-value">{{ number_format($overview['total_providers'] ?? 145) }}</div>
                <div class="metric-trend up">
                    <i class="fas fa-caret-up"></i> 12% increase
                </div>
            </div>
        </div>

        <div class="metric-card glass-panel">
            <div class="metric-icon" style="background: linear-gradient(135deg, #f59e0b, #fbbf24);">
                <i class="fas fa-tools"></i>
            </div>
            <div class="metric-content">
                <div class="metric-label">Active Jobs</div>
                <div class="metric-value">{{ number_format($overview['active_jobs'] ?? 32) }}</div>
                <div class="metric-trend up">
                    <i class="fas fa-caret-up"></i> 8 new today
                </div>
            </div>
        </div>

        <div class="metric-card glass-panel">
            <div class="metric-icon" style="background: linear-gradient(135deg, #10b981, #34d399);">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="metric-content">
                <div class="metric-label">M-T-D Revenue</div>
                <div class="metric-value">${{ number_format($overview['revenue'] ?? 45200) }}</div>
                <div class="metric-trend up">
                    <i class="fas fa-caret-up"></i> 24% vs last mo.
                </div>
            </div>
        </div>

        <div class="metric-card glass-panel">
            <div class="metric-icon" style="background: linear-gradient(135deg, #ef4444, #f87171);">
                <i class="fas fa-shield-alt"></i>
            </div>
            <div class="metric-content">
                <div class="metric-label">Guarantee Rate</div>
                <div class="metric-value">98.4%</div>
                <div class="metric-trend down">
                    <i class="fas fa-caret-down"></i> 0.2% drop
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="main-grid">
        <!-- Left Column: Performance & Tables -->
        <div class="analytical-section">
            <div class="pro-card glass-panel mb-4">
                <div class="card-header">
                    <h3><i class="fas fa-chart-line text-primary"></i> Specialty Performance</h3>
                    <div class="header-pill">Category Analytics</div>
                </div>
                
                <div class="grid-categories" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px;">
                    @foreach(['Vehicle Maintenance', 'Electronics Repair', 'Construction Services', 'Crafts & Design', 'Electrical Works', 'IT & Systems'] as $spec)
                    <div class="activity-item" style="padding: 15px; border-radius: 12px; background: rgba(0,0,0,0.02); border: 1px solid rgba(0,0,0,0.03);">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="fw-bold" style="font-size: 0.9rem;">{{ $spec }}</span>
                            <span class="status-badge status-completed">Optimal</span>
                        </div>
                        <div class="progress" style="height: 6px; border-radius: 10px; background: rgba(0,0,0,0.05);">
                            <div class="progress-bar" style="width: {{ rand(60, 95) }}%; background: var(--primary); border-radius: 10px;"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="pro-card glass-panel">
                <div class="card-header">
                    <h3><i class="fas fa-history text-primary"></i> Recent Critical Requests</h3>
                    <a href="#" class="view-all-link">View All <i class="fas fa-external-link-alt"></i></a>
                </div>
                <div class="table-responsive">
                    <table class="pro-table">
                        <thead>
                            <tr>
                                <th>Job ID</th>
                                <th>Client</th>
                                <th>Specialty</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $names = ['Alice Johnson', 'Mark Spencer', 'Sarah Lee', 'David Chen'];
                                $specialties = ['Electrical', 'Mechanic', 'Builder', 'Plumber'];
                            @endphp
                            @for($i=0; $i<4; $i++)
                            <tr>
                                <td class="fw-bold text-dark">#TR-{{ 520 + $i }}</td>
                                <td>{{ $names[$i] ?? 'Unknown Client' }}</td>
                                <td>{{ $specialties[$i] ?? 'General' }}</td>
                                <td>
                                    <span class="status-badge {{ $i % 2 == 0 ? 'status-in_progress' : 'status-pending' }}">
                                        {{ $i % 2 == 0 ? 'In Progress' : 'In Queue' }}
                                    </span>
                                </td>
                                <td>
                                    <button class="icon-btn"><i class="fas fa-eye"></i></button>
                                </td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Right Column: Activity & Map -->
        <div class="sidebar-section">
            <div class="pro-card glass-panel mb-4" style="padding: 0; overflow: hidden; height: 350px; position: relative;">
                <div class="p-3 position-absolute top-0 start-0 w-100 z-1" style="background: linear-gradient(to bottom, rgba(255,255,255,0.95), transparent);">
                    <h5 class="fw-800 m-0" style="font-size: 0.9rem; color: var(--dark);"><i class="fas fa-globe-africa text-primary me-2"></i>Live Operations Map</h5>
                </div>
                <div class="map-container" style="height: 100%; width: 100%;">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127589.6053335354!2d30.01258602695325!3d-1.944073356064115!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x19dca429ed86fd29%3A0xc6cb1a8f9cc33682!2sKigali!5e0!3m2!1sen!2srw!4v1704680000000!5m2!1sen!2srw" 
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

            <div class="activity-card glass-panel">
                <div class="card-header">
                    <h3><i class="fas fa-bolt text-warning"></i> Recent Activity</h3>
                </div>
                <div class="activity-list">
                    @php
                        $activities = [
                            ['icon' => 'fa-check-circle', 'color' => 'success', 'title' => 'Repair Completed', 'time' => '2 mins ago'],
                            ['icon' => 'fa-user-plus', 'color' => 'primary', 'title' => 'New Provider', 'time' => '15 mins ago'],
                            ['icon' => 'fa-exclamation-triangle', 'color' => 'danger', 'title' => 'Job Disputed', 'time' => '1 hr ago'],
                            ['icon' => 'fa-credit-card', 'color' => 'info', 'title' => 'Payment Received', 'time' => '4 hrs ago']
                        ];
                    @endphp
                    @foreach($activities as $act)
                    <div class="activity-item">
                        <div class="item-visual" style="color: var(--{{ $act['color'] }})">
                            <i class="fas {{ $act['icon'] }}"></i>
                        </div>
                        <div class="item-info">
                            <div class="item-title">{{ $act['title'] }}</div>
                            <div class="item-meta">{{ $act['time'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
