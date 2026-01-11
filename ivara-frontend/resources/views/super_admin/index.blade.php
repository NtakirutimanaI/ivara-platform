@extends('layouts.app')

@section('title', 'Super Admin Control')

@section('content')
<div class="dashboard-wrapper">
    <!-- Header Section -->
    <header class="pro-header">
        <div>
            <h1>Super Admin Control</h1>
            <p>Global System & Service Category Oversight</p>
        </div>
        <div class="d-flex align-items-center gap-3">
             <div class="status-badge status-completed">
                <i class="fas fa-circle me-2" style="font-size: 8px;"></i> System Online
            </div>
            <div class="text-end ms-3 border-start ps-3 border-secondary">
                <h5 class="mb-0 fw-bold fs-6">{{ now()->format('H:i') }} <span class="text-muted">UTC</span></h5>
                <small class="text-muted">{{ now()->format('D, M d') }}</small>
            </div>
        </div>
    </header>

    <!-- Metrics Grid -->
    <div class="dashboard-grid">
        <!-- 1. Users -->
        <div class="metric-card glass-panel">
            <div class="metric-icon" style="background: linear-gradient(135deg, #3b82f6, #60a5fa);">
                <i class="fas fa-users"></i>
            </div>
            <div class="metric-content">
                <div class="metric-label">Total Users</div>
                <div class="metric-value">{{ number_format($overview['total_users'] ?? 12503) }}</div>
                <div class="metric-trend up">
                    <i class="fas fa-arrow-up"></i> 12% week
                </div>
            </div>
        </div>

        <!-- 2. Orders -->
        <div class="metric-card glass-panel">
            <div class="metric-icon" style="background: linear-gradient(135deg, #f59e0b, #fbbf24);">
                <i class="fas fa-shopping-bag"></i>
            </div>
            <div class="metric-content">
                <div class="metric-label">Active Orders</div>
                <div class="metric-value">{{ number_format($overview['total_orders'] ?? 845) }}</div>
                <div class="metric-trend up">
                    <i class="fas fa-arrow-up"></i> 5% today
                </div>
            </div>
        </div>

        <!-- 3. Revenue -->
        <div class="metric-card glass-panel">
            <div class="metric-icon" style="background: linear-gradient(135deg, #10b981, #34d399);">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="metric-content">
                <div class="metric-label">Revenue (FRW)</div>
                <div class="metric-value">{{ number_format($overview['total_revenue'] ?? 0) }}</div>
                <div class="metric-trend up">
                    <i class="fas fa-arrow-up"></i> 8% target
                </div>
            </div>
        </div>

        <!-- 4. Uptime -->
        <div class="metric-card glass-panel">
            <div class="metric-icon" style="background: linear-gradient(135deg, #ef4444, #f87171);">
                <i class="fas fa-server"></i>
            </div>
            <div class="metric-content">
                <div class="metric-label">System Uptime</div>
                <div class="metric-value">99.9%</div>
                <div class="metric-trend up">
                    <i class="fas fa-check"></i> Stable
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="main-grid">
        <!-- Left Column (Activity & Audit) -->
        <div class="analytical-section">
            
            <!-- Global Map -->
            <div class="pro-card glass-panel mb-4" style="padding: 0; overflow: hidden; height: 350px; position: relative;">
                <div class="p-3 position-absolute top-0 start-0 w-100 z-1" style="background: linear-gradient(to bottom, rgba(255,255,255,0.95), transparent); pointer-events: none;">
                    <h3 class="fw-bold m-0" style="font-size: 1rem; color: #000; pointer-events: auto;"><i class="fas fa-map-marked-alt text-primary me-2"></i>Ivara Service Location</h3>
                    <p class="text-muted small mb-0" style="pointer-events: auto;">Remera, Kigali (Near Car Park)</p>
                </div>
                <div class="map-container" style="height: 100%; width: 100%;">
                     <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3987.502931238479!2d30.11029837496677!3d-1.9596009980227548!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x19dca6f7317e0821%3A0xe7c4440360a0a527!2sRemera%20Bus%20Park!5e0!3m2!1sen!2srw!4v1715243685675!5m2!1sen!2srw" 
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>

            <!-- Recent Event Log -->
            <div class="pro-card glass-panel">
                <div class="card-header border-bottom-0 pb-0 mb-3">
                    <h3><i class="fas fa-history text-secondary"></i> Recent System Events</h3>
                </div>
                <div class="table-responsive">
                    <table class="pro-table">
                        <tbody>
                            @forelse($overview['recent_events'] ?? [] as $event)
                            <tr>
                                <td style="width: 120px;"><span class="badge bg-secondary bg-opacity-10 text-secondary">{{ $event['time'] }}</span></td>
                                <td class="fw-bold"><i class="fas fa-circle text-success" style="font-size: 8px; margin-right: 8px;"></i> {{ $event['event'] }}</td>
                                <td class="text-end text-muted">{{ $event['details'] }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="3" class="text-center text-muted">No recent events</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- Right Column (Categories & Roles) -->
        <div class="sidebar-section">
            
            <!-- Service Category Health -->
            <div class="pro-card glass-panel mb-4">
                <div class="card-header border-bottom-0 pb-0 mb-3">
                    <h3><i class="fas fa-th-large text-info"></i> Service Health</h3>
                </div>
                <div class="categories-list d-flex flex-column gap-3">
                     @foreach(['Technical', 'Creative', 'Transport', 'Food', 'Education', 'Agri', 'Other'] as $cat)
                     <div class="cat-health-item">
                         <div class="d-flex justify-content-between mb-1">
                             <span class="fw-bold small">{{ $cat }}</span>
                             <i class="fas fa-check-circle text-success small"></i>
                         </div>
                         <div class="progress" style="height: 4px;">
                             <div class="progress-bar bg-primary" style="width: 90%; border-radius: 10px;"></div>
                         </div>
                     </div>
                     @endforeach
                </div>
            </div>

            <!-- User Distribution -->
            <div class="pro-card glass-panel">
                <div class="card-header border-bottom-0 pb-0 mb-3">
                    <h3><i class="fas fa-users-cog text-warning"></i> Role Dist.</h3>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    @forelse($role_counts as $role => $count)
                    <div class="status-badge status-pending d-inline-flex align-items-center gap-2">
                        <span>{{ str_replace(['-', '_'], ' ', $role) }}</span>
                        <span class="bg-white text-dark rounded-circle px-2 py-0 small fw-bold" style="font-size: 10px;">{{ $count }}</span>
                    </div>
                    @empty
                    <p class="text-muted small">No users found</p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
