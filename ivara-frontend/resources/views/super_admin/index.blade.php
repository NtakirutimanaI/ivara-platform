@extends('layouts.app')

@section('title', 'Super Admin Command Center')

@section('content')
<div class="super-admin-container">
    <div class="container-fluid p-3 pt-0">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mt-0 mb-4">
            <div>
                <h1 class="fw-bold display-5 mt-0 mb-1 text-primary">Command Center</h1>
                <p class="text-muted lead mb-0" style="font-size: 1rem;">Global System & Service Category Oversight</p>
            </div>
            <div class="d-flex align-items-center gap-3">
                 <div class="status-pill online">
                    <span class="dot"></span> System Online
                </div>
                <div class="text-end ms-4 border-start ps-3 border-secondary">
                    <h5 class="mb-0 fw-bold">{{ now()->format('H:i') }} <span class="fs-6 text-muted">UTC</span></h5>
                    <small class="text-muted">{{ now()->format('D, M d Y') }}</small>
                </div>
            </div>
        </div>

        <!-- Bento Grid Layout -->
        <div class="bento-grid">
            
            <!-- 1. Key Metrics (Top Row) -->
            <div class="bento-card bg-glass">
                <div class="card-icon bg-soft-primary text-primary"><i class="fas fa-users"></i></div>
                <h3 class="metric-value">{{ number_format($overview['total_users'] ?? 12503) }}</h3>
                <span class="metric-label">Total Users</span>
                <div class="trend up"><i class="fas fa-arrow-up"></i> 12% week</div>
            </div>
            
            <div class="bento-card bg-glass">
                <div class="card-icon bg-soft-warning text-warning"><i class="fas fa-shopping-bag"></i></div>
                <h3 class="metric-value">{{ number_format($overview['total_orders'] ?? 845) }}</h3>
                <span class="metric-label">Active Orders</span>
                <div class="trend up"><i class="fas fa-arrow-up"></i> 5% today</div>
            </div>

            <div class="bento-card bg-glass">
                 <div class="card-icon bg-soft-success text-success"><i class="fas fa-dollar-sign"></i></div>
                <h3 class="metric-value">{{ number_format($overview['total_revenue'] ?? 0) }}</h3>
                <span class="metric-label">Revenue (FRW)</span>
                <div class="trend up"><i class="fas fa-arrow-up"></i> 8% target</div>
            </div>

            <div class="bento-card bg-glass">
                <div class="card-icon bg-soft-danger text-danger"><i class="fas fa-server"></i></div>
                <h3 class="metric-value">99.9%</h3>
                <span class="metric-label">System Uptime</span>
                 <div class="trend down"><i class="fas fa-check"></i> Stable</div>
            </div>

            <!-- 2. System Health Map (Large Block) -->
            <div class="bento-card bg-glass span-2 row-2 p-0 position-relative overflow-hidden">
                 <div class="p-4 position-absolute w-100 z-1">
                    <h5 class="card-title"><i class="fas fa-map-marked-alt text-primary me-2"></i>Global Activity Map</h5>
                    <p class="card-subtitle text-muted">Real-time service request heatmap.</p>
                 </div>
                 <!-- Decorational Map Background -->
                 <div class="map-placeholder">
                     <div class="pulse-dot" style="top: 30%; left: 20%"></div>
                     <div class="pulse-dot" style="top: 45%; left: 60%"></div>
                     <div class="pulse-dot" style="top: 70%; left: 40%"></div>
                     <div class="pulse-dot" style="top: 25%; left: 80%"></div>
                     <img src="https://upload.wikimedia.org/wikipedia/commons/8/80/World_map_-_low_resolution.svg" class="world-map-svg" alt="Map">
                 </div>
            </div>

            <!-- 3. Category Health (Tall Block) -->
            <div class="bento-card bg-glass span-2 row-2">
                <h5 class="card-title mb-4"><i class="fas fa-th-large text-info me-2"></i>Service Category Health</h5>
                <div class="grid-categories">
                     @foreach(['Technical', 'Creative', 'Transport', 'Food', 'Education', 'Agri', 'Other'] as $cat)
                     <div class="cat-item">
                         <div class="d-flex justify-content-between mb-1">
                             <span class="fw-bold">{{ $cat }}</span>
                             <i class="fas fa-check-circle text-success"></i>
                         </div>
                         <div class="d-flex align-items-center gap-2">
                             <div class="progress flex-grow-1" style="height: 4px;">
                                 <div class="progress-bar bg-gradient-primary" style="width: 90%"></div>
                             </div>
                             <span class="badge bg-soft-primary rounded-circle p-1" style="width:20px; height:20px; display:flex; align-items:center; justify-content:center; font-size:0.6rem;">1</span>
                         </div>
                         <small class="text-muted" style="font-size: 0.75rem;">Active Service</small>
                     </div>
                     @endforeach
                </div>
            </div>

            <!-- 4. Role Distribution (Wide Block) -->
            <div class="bento-card bg-glass span-2">
                <h5 class="card-title mb-3">User Distribution</h5>
                <div class="d-flex flex-wrap gap-2">
                    @forelse($role_counts as $role => $count)
                    <div class="role-pill">
                        <span class="role-name">{{ str_replace(['-', '_'], ' ', $role) }}</span>
                        <span class="role-count">{{ $count }}</span>
                    </div>
                    @empty
                    <p class="text-muted small">No users found</p>
                    @endforelse
                </div>
            </div>

             <!-- 5. Audit Log (Wide Block) -->
            <div class="bento-card bg-glass span-2">
                <h5 class="card-title mb-3">Recent System Events</h5>
                 <div class="table-responsive">
                    <table class="table table-sm table-borderless align-middle mb-0">
                        <tbody>
                            @forelse($overview['recent_events'] ?? [] as $event)
                            <tr>
                                <td><span class="badge bg-soft-secondary text-secondary">{{ $event['time'] }}</span></td>
                                <td><i class="fas fa-circle text-success fs-xs me-2"></i> {{ $event['event'] }}</td>
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
    </div>
</div>

<style>
    /* VARIABLES */
    :root {
        --grid-gap: 20px;
        --card-radius: 20px;
        --card-bg: rgba(255,255,255,0.85); /* Restored Glass Opacity */
    }

    /* BENTO GRID - 4 Columns */
    .bento-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        grid-auto-rows: minmax(180px, auto);
        gap: var(--grid-gap);
    }

    .bento-card {
        background: var(--card-bg);
        border: 1px solid rgba(255,255,255,0.2);
        border-radius: var(--card-radius);
        padding: 24px;
        position: relative;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        display: flex;
        flex-direction: column;
        backdrop-filter: blur(10px); /* Glass */
    }
    .bento-card:hover { 
        transform: translateY(-5px); 
        box-shadow: 0 15px 30px rgba(0,0,0,0.1); 
        z-index: 10;
        border-color: rgba(59, 130, 246, 0.4);
    }
    
    /* Spans */
    .span-2 { grid-column: span 2; }
    .span-4 { grid-column: span 4; }
    .row-2 { grid-row: span 2; }

    /* Content Styling */
    .metric-value { font-size: 2.5rem; font-weight: 800; margin-bottom: 5px; color: var(--page-text); }
    .metric-label { font-size: 0.9rem; text-transform: uppercase; font-weight: 600; color: #94a3b8; letter-spacing: 0.5px; }
    .card-icon { 
        width: 45px; height: 45px; border-radius: 12px; 
        display: flex; align-items: center; justify-content: center; 
        font-size: 1.2rem; margin-bottom: 15px; 
    }
    .trend { font-size: 0.85rem; font-weight: 700; margin-top: auto; padding-top: 10px; }
    .trend.up { color: #10b981; } .trend.down { color: #ef4444; }

    /* Colors */
    .bg-soft-primary { background: rgba(59, 130, 246, 0.1); }
    .bg-soft-success { background: rgba(16, 185, 129, 0.1); }
    .bg-soft-warning { background: rgba(245, 158, 11, 0.1); }
    .bg-soft-danger { background: rgba(239, 68, 68, 0.1); }
    .bg-soft-secondary { background: rgba(148, 163, 184, 0.1); }
    .text-primary { color: #3b82f6 !important; }

    /* Map Styling */
    .world-map-svg { width: 100%; height: 100%; object-fit: cover; opacity: 0.2; filter: grayscale(100%); }
    .map-placeholder { position: absolute; top:0; left:0; right:0; bottom:0; background: radial-gradient(circle, var(--card-bg) 0%, rgba(0,0,0,0) 100%); z-index: 0; }
    .pulse-dot {
        position: absolute; width: 12px; height: 12px; background: #3b82f6; border-radius: 50%;
        box-shadow: 0 0 0 rgba(59, 130, 246, 0.4);
        animation: pulse 2s infinite;
    }
    @keyframes pulse {
        0% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.7); }
        70% { box-shadow: 0 0 0 15px rgba(59, 130, 246, 0); }
        100% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0); }
    }

    /* Category Grid */
    .grid-categories { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }
    .cat-item { background: rgba(0,0,0,0.03); padding: 12px; border-radius: 10px; }
    
    /* Roles */
    .role-pill { 
        display: flex; align-items: center; background: rgba(0,0,0,0.03); 
        border: 1px solid rgba(0,0,0,0.05); padding: 5px 12px; border-radius: 50px; 
    }
    .role-name { font-weight: 600; font-size: 0.85rem; margin-right: 8px; text-transform: capitalize; color: var(--page-text); }
    .role-count { background: #3b82f6; color: white; border-radius: 50px; padding: 1px 8px; font-size: 0.75rem; font-weight: 700; }

    /* System Status */
    .status-pill { background: rgba(16, 185, 129, 0.1); color: #10b981; padding: 5px 12px; border-radius: 20px; font-weight: 700; font-size: 0.85rem; display: flex; align-items: center; }
    .status-pill .dot { width: 8px; height: 8px; background: #10b981; border-radius: 50%; margin-right: 8px; animation: blink 2s infinite; }
    @keyframes blink { 50% { opacity: 0.5; } }
    
     .super-admin-container {
        width: 96%;
        margin-left: 15px;
        margin-top: 0 !important;
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .bento-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 768px) {
        .bento-grid { grid-template-columns: 1fr; }
        .span-2 { grid-column: auto; }
        .row-2 { grid-row: auto; }
        .super-admin-container { width: 100%; margin: 0; padding: 10px; }
    }
</style>
@endsection
