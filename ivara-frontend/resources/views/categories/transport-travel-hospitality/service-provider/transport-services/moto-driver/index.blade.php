@extends('layouts.app')

@section('content')
<!-- Inject Bootstrap 5 for Grid and Utilities -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom Dashboard CSS -->
<style>
    :root {
        --iv-dark: #0f172a;
        --iv-blue: #3b82f6;
        --iv-cyan: #06b6d4;
        --iv-green: #10b981;
        --iv-bg: #f1f5f9;
        --glass-bg: rgba(255, 255, 255, 0.95);
        --glass-border: 1px solid rgba(255, 255, 255, 0.5);
    }
    
    body { background-color: var(--iv-bg); font-family: 'Segoe UI', system-ui, -apple-system, sans-serif; }
    .tth-dashboard { padding: 2rem; }

    /* Cards */
    .premium-card {
        background: var(--glass-bg);
        border-radius: 20px;
        border: var(--glass-border);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        overflow: hidden;
        height: 100%;
    }
    .premium-card:hover { transform: translateY(-5px); box-shadow: 0 20px 30px -10px rgba(0, 0, 0, 0.1); }

    /* Stat Cards Gradients - Moto Theme (Orange/Red/Dark) */
    .card-earnings { background: linear-gradient(135deg, #1e293b 0%, #334155 100%); color: white; }
    .card-trips { background: linear-gradient(135deg, #f97316 0%, #ea580c 100%); color: white; } /* Orange for Moto */
    .card-rating { background: white; border-left: 5px solid #f59e0b; }
    .card-accept { background: white; border-left: 5px solid #10b981; }

    .stat-label { font-size: 0.85rem; letter-spacing: 0.5px; opacity: 0.8; text-transform: uppercase; font-weight: 600; }
    .stat-value { font-size: 2.2rem; font-weight: 800; }

    /* Map Box */
    .map-placeholder {
        background: url('https://upload.wikimedia.org/wikipedia/commons/b/bd/OpenStreetMap_Logo_2011.svg') no-repeat center center;
        background-color: #e2e8f0;
        background-size: 20%;
        position: relative;
        min-height: 400px;
        border-radius: 20px;
        overflow: hidden;
    }
    .map-overlay {
        position: absolute; top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(15, 23, 42, 0.05); backdrop-filter: blur(2px);
        display: flex; justify-content: center; align-items: center;
    }

    /* List Items */
    .timeline-item { margin-bottom: 20px; position: relative; }
    .timeline-dot {
        width: 12px; height: 12px; background: #f97316; border-radius: 50%;
        position: absolute; left: -27px; top: 6px; border: 2px solid white; box-shadow: 0 0 0 2px #f97316;
    }
    .activity-timeline { position: relative; padding-left: 20px; border-left: 2px solid #e2e8f0; margin-left: 10px; }

    .badge-premium { padding: 6px 12px; border-radius: 30px; font-weight: 600; font-size: 0.75rem; }

    /* Toggle */
    .driver-status-toggle {
        background: white; padding: 4px; border-radius: 50px; display: inline-flex;
        border: 1px solid #e2e8f0; position: relative; cursor: pointer;
    }
    .driver-status-toggle .status-pill {
        padding: 8px 20px; border-radius: 50px; font-weight: 600; font-size: 0.9rem; transition: 0.3s;
    }
    .driver-status-toggle.online .status-pill.on { background: #10b981; color: white; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3); }
    .driver-status-toggle.offline .status-pill.off { background: #64748b; color: white; }
</style>

@php
    $driverName = auth()->user()->name ?? 'Moto Rider';
    $isOnline = true;
    $todayEarnings = 85.20;
    $weekEarnings = 420.50;
    $totalTripsToday = 18; // More trips for moto usually
    $rating = 4.9;
    $acceptanceRate = 98;
    
    $recentRequests = [
        ['id' => '#M-102', 'from' => 'University Gate A', 'to' => 'Student Hostels', 'fare' => 5.00, 'status' => 'Completed', 'time' => '10 min ago'],
        ['id' => '#M-101', 'from' => 'Metro Station', 'to' => 'Office Park', 'fare' => 8.50, 'status' => 'Completed', 'time' => '35 min ago'],
        ['id' => '#M-100', 'from' => 'Market Street', 'to' => 'North Ave', 'fare' => 4.00, 'status' => 'Cancelled', 'time' => '1 hr ago'],
    ];

    $vehicleHealth = [
        'fuel' => 60,
        'oil' => 'Due Soon', // Moto oil changes are frequent
        'next_service' => '300 km'
    ];
@endphp

<div class="tth-dashboard">
    <!-- Header -->
    <div class="row align-items-center mb-5">
        <div class="col-md-8">
            <h1 class="fw-bold fs-2 text-dark mb-1">Ride safe, {{ $driverName }}! 🏍️</h1>
            <p class="text-secondary mb-0">Beat the traffic and earn more.</p>
        </div>
        <div class="col-md-4 text-md-end mt-3 mt-md-0">
            <div class="driver-status-toggle {{ $isOnline ? 'online' : 'offline' }}">
                <div class="status-pill off me-1">Offline</div>
                <div class="status-pill on">Online</div>
            </div>
        </div>
    </div>

    <!-- Metrics -->
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="premium-card card-earnings p-4 d-flex flex-column justify-content-between">
                <div>
                    <div class="mb-3 d-flex justify-content-between">
                        <i class="fas fa-wallet fa-2x opacity-50"></i>
                        <span class="badge bg-white text-dark bg-opacity-25">+8%</span>
                    </div>
                    <div class="stat-value mb-1">${{ number_format($todayEarnings, 2) }}</div>
                    <div class="stat-label">Earnings Today</div>
                </div>
                <div class="mt-3 pt-3 border-top border-white border-opacity-10 small"><span class="opacity-75">Weekly: ${{ number_format($weekEarnings, 2) }}</span></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="premium-card card-trips p-4 d-flex flex-column justify-content-between">
                <div>
                    <div class="mb-3 d-flex justify-content-between">
                        <i class="fas fa-motorcycle fa-2x opacity-50"></i>
                    </div>
                    <div class="stat-value mb-1">{{ $totalTripsToday }}</div>
                    <div class="stat-label">Trips Completed</div>
                </div>
                <div class="mt-3 pt-3 border-top border-white border-opacity-10 small"><span class="opacity-75">5.5 hrs online</span></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="premium-card card-rating p-4">
                <div class="d-flex justify-content-between mb-3"><div class="text-warning"><i class="fas fa-star fa-2x"></i></div></div>
                <div class="stat-value text-dark mb-1">{{ number_format($rating, 1) }}</div>
                <div class="stat-label text-muted">Rider Rating</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="premium-card card-accept p-4">
                <div class="d-flex justify-content-between mb-3"><div class="text-success"><i class="fas fa-check-circle fa-2x"></i></div></div>
                <div class="stat-value text-dark mb-1">{{ $acceptanceRate }}%</div>
                <div class="stat-label text-muted">Acceptance Rate</div>
            </div>
        </div>
    </div>

    <!-- Main Section -->
    <div class="row g-4">
        <!-- Live Map -->
        <div class="col-lg-8">
            <div class="premium-card p-0">
                <div class="p-4 border-bottom d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold m-0"><i class="fas fa-map-marked text-danger me-2"></i>Traffic Heatmap</h5>
                    <button class="btn btn-sm btn-outline-danger rounded-pill">Find Surges</button>
                </div>
                <div class="map-placeholder">
                    <div class="map-overlay">
                        <div class="text-center p-4 bg-white rounded-4 shadow">
                            <i class="fas fa-fire fa-3x text-danger mb-3 animate__animated animate__pulse animate__infinite"></i>
                            <h5 class="fw-bold">High Demand Zone</h5>
                            <p class="text-muted mb-3">2 min wait times near University Campus.</p>
                            <button class="btn btn-danger rounded-pill px-4">Go Online</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Vehicle -->
            <div class="premium-card p-4 mb-4">
                <h6 class="text-uppercase text-muted fw-bold mb-4 ls-1">Bike Health</h6>
                <div class="mb-4">
                    <div class="d-flex justify-content-between mb-1">
                        <span class="fw-semibold text-dark"><i class="fas fa-gas-pump me-2 text-warning"></i> Fuel</span>
                        <span class="fw-bold">{{ $vehicleHealth['fuel'] }}%</span>
                    </div>
                    <div class="progress" style="height: 6px;">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $vehicleHealth['fuel'] }}%"></div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-6"><div class="p-3 bg-light rounded-3 text-center border"><small class="text-muted d-block mb-1">Oil</small><div class="fw-bold text-warning">{{ $vehicleHealth['oil'] }}</div></div></div>
                    <div class="col-6"><div class="p-3 bg-light rounded-3 text-center border"><small class="text-muted d-block mb-1">Service</small><div class="fw-bold text-dark">{{ $vehicleHealth['next_service'] }}</div></div></div>
                </div>
            </div>

            <!-- Recent -->
            <div class="premium-card p-4">
                <h6 class="text-uppercase text-muted fw-bold mb-4 ls-1">Ride History</h6>
                <div class="activity-timeline">
                    @foreach($recentRequests as $req)
                        <div class="timeline-item">
                            <div class="timeline-dot"></div>
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="fw-bold text-dark">{{ $req['to'] }}</span>
                                <span class="badge bg-light text-dark border">${{ number_format($req['fare'], 2) }}</span>
                            </div>
                            <div class="text-muted small mb-2"><i class="fas fa-map-marker-alt me-1"></i> {{ $req['from'] }}</div>
                            <div class="d-flex align-items-center">
                                @if($req['status'] == 'Completed') <span class="badge bg-success text-white badge-premium">Done</span>
                                @else <span class="badge bg-secondary badge-premium">Cancelled</span> @endif
                                <span class="text-secondary ms-2 small" style="font-size: 0.7em">{{ $req['time'] }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
