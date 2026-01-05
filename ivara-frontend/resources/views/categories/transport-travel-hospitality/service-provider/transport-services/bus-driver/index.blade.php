@extends('layouts.app')

@section('content')
<!-- Inject Bootstrap 5 for Grid and Utilities -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    :root {
        --iv-dark: #0f172a;
        --iv-blue: #3b82f6;
        --iv-bg: #f8fafc;
        --glass-bg: rgba(255, 255, 255, 0.95);
        --glass-border: 1px solid rgba(255, 255, 255, 0.5);
    }
    
    body { background-color: var(--iv-bg); font-family: 'Segoe UI', system-ui, -apple-system, sans-serif; }
    .tth-dashboard { padding: 2rem; }

    .premium-card {
        background: var(--glass-bg);
        border-radius: 20px;
        border: var(--glass-border);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        height: 100%;
        transition: 0.3s;
    }
    .premium-card:hover { transform: translateY(-3px); box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); }

    /* Bus Theme - Green/Teal */
    .card-earnings { background: linear-gradient(135deg, #134e4a 0%, #115e59 100%); color: white; }
    .card-trips { background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%); color: white; } 

    .stat-label { font-size: 0.85rem; opacity: 0.8; text-transform: uppercase; font-weight: 600; }
    .stat-value { font-size: 2.2rem; font-weight: 800; }

    .route-list-item {
        border-left: 4px solid #14b8a6;
        background: white;
        margin-bottom: 10px;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
    }
    .badge-status { padding: 5px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; }
</style>

@php
    $driverName = auth()->user()->name ?? 'Captain John';
    $todayEarnings = 320.00; // Bus earns more/fixed
    $passengers = 450;
    $fuel = 45; // Diesel tank
    
    $schedule = [
        ['route' => 'Route 42: Downtown Loop', 'time' => '08:00 AM', 'status' => 'Completed', 'passengers' => 120],
        ['route' => 'Route 15: Airport Express', 'time' => '12:00 PM', 'status' => 'Active', 'passengers' => 85],
        ['route' => 'Route 7: Night Owl', 'time' => '08:00 PM', 'status' => 'Scheduled', 'passengers' => 0],
    ];
@endphp

<div class="tth-dashboard">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="fw-bold fs-2 text-dark">Bus Operations Center 🚌</h1>
            <p class="text-secondary">Schedule adherence is currently at 98%.</p>
        </div>
        <button class="btn btn-success rounded-pill px-4"><i class="fas fa-check me-2"></i> Clock In</button>
    </div>

    <!-- Stats -->
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="premium-card card-earnings p-4">
                <i class="fas fa-ticket-alt fa-2x opacity-50 mb-3"></i>
                <div class="stat-value">${{ $todayEarnings }}</div>
                <div class="stat-label">Ticket Revenue</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="premium-card card-trips p-4">
                <i class="fas fa-users fa-2x opacity-50 mb-3"></i>
                <div class="stat-value">{{ $passengers }}</div>
                <div class="stat-label">Total Passengers</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="premium-card p-4">
                <div class="d-flex justify-content-between mb-3"><i class="fas fa-gas-pump fa-2x text-secondary"></i></div>
                <div class="stat-value text-dark">{{ $fuel }}%</div>
                <div class="stat-label text-muted">Diesel Level</div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="premium-card p-4">
                <h5 class="fw-bold mb-4">Today's Schedule</h5>
                @foreach($schedule as $trip)
                <div class="route-list-item d-flex justify-content-between align-items-center">
                    <div>
                        <div class="fw-bold text-dark fs-5">{{ $trip['route'] }}</div>
                        <div class="text-muted"><i class="fas fa-clock me-1"></i> Departure: {{ $trip['time'] }}</div>
                    </div>
                    <div class="text-end">
                        <div class="mb-1">
                            @if($trip['status'] == 'Completed') <span class="badge bg-secondary badge-status">Completed</span>
                            @elseif($trip['status'] == 'Active') <span class="badge bg-success badge-status">In Progress</span>
                            @else <span class="badge bg-warning text-dark badge-status">Scheduled</span> @endif
                        </div>
                        <small class="text-muted">{{ $trip['passengers'] }} pax</small>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-lg-4">
            <div class="premium-card p-4">
                <h5 class="fw-bold mb-3">Bus Status</h5>
                <img src="https://cdn-icons-png.flaticon.com/512/3448/3448339.png" class="img-fluid mb-3 w-50 mx-auto d-block" alt="Bus Icon">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item bg-transparent d-flex justify-content-between"><span>Tire Pressure</span> <span class="text-success fw-bold">OK</span></li>
                    <li class="list-group-item bg-transparent d-flex justify-content-between"><span>Engine Oil</span> <span class="text-success fw-bold">OK</span></li>
                    <li class="list-group-item bg-transparent d-flex justify-content-between"><span>Brake Fluid</span> <span class="text-warning fw-bold">Check</span></li>
                    <li class="list-group-item bg-transparent d-flex justify-content-between"><span>Cleanliness</span> <span class="text-success fw-bold">Verified</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
