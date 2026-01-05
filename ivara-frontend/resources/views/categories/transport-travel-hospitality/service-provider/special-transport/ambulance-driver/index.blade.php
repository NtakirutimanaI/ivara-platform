@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body { background-color: #fef2f2; font-family: 'Segoe UI', sans-serif; } /* Light Red BG */
    .emergency-card { background: white; border-left: 5px solid #ef4444; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); padding: 20px; }
    .status-badge { background: #ef4444; color: white; padding: 5px 15px; border-radius: 20px; font-weight: bold; animation: pulse 2s infinite; }
    @keyframes pulse { 0% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7); } 70% { box-shadow: 0 0 0 10px rgba(239, 68, 68, 0); } 100% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0); } }
</style>
<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-5 bg-white p-4 rounded shadow-sm border-bottom border-danger">
        <div>
            <h2 class="fw-bold text-danger m-0"><i class="fas fa-ambulance me-2"></i>Emergency Response Unit</h2>
            <small class="text-muted">Unit ID: #EMS-992 | Status: <span class="text-success fw-bold">Active</span></small>
        </div>
        <button class="btn btn-danger btn-lg px-4 fw-bold shadow-sm">GO OFFLINE</button>
    </div>

    <div class="row g-4">
        <div class="col-md-8">
            <div class="emergency-card mb-4 border-start-0 border-top border-4 border-danger">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold text-danger">Incoming Dispatch</h5>
                    <span class="status-badge">URGENT</span>
                </div>
                <h3 class="fw-bold">Cardiac Arrest - 45M</h3>
                <p class="lead mb-2"><i class="fas fa-map-marker-alt text-danger me-2"></i> 124 Main St, City Center (2.1 km away)</p>
                <div class="d-flex gap-2 mt-4">
                    <button class="btn btn-danger flex-grow-1 py-3 fw-bold">ACCEPT DISPATCH</button>
                    <button class="btn btn-outline-secondary px-4">Decline</button>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-md-6">
                    <div class="emergency-card h-100">
                        <h6 class="text-muted text-uppercase fw-bold">Shift Stats</h6>
                        <div class="fs-1 fw-bold text-dark">8</div>
                        <div class="text-success small fw-bold">Lives Impacted Today</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="emergency-card h-100">
                        <h6 class="text-muted text-uppercase fw-bold">Average Response</h6>
                        <div class="fs-1 fw-bold text-dark">5m 12s</div>
                        <div class="text-primary small fw-bold">Top 10% Efficiency</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="emergency-card bg-dark text-white border-0">
                <h5 class="fw-bold mb-4">Equipment Status</h5>
                <ul class="list-unstyled">
                    <li class="mb-3 d-flex justify-content-between"><span>Defibrillator</span> <span class="text-success"><i class="fas fa-check-circle"></i> Charged</span></li>
                    <li class="mb-3 d-flex justify-content-between"><span>Oxygen Tank A</span> <span class="text-warning"><i class="fas fa-exclamation-circle"></i> 40%</span></li>
                    <li class="mb-3 d-flex justify-content-between"><span>Stretcher</span> <span class="text-success"><i class="fas fa-check-circle"></i> OK</span></li>
                    <li class="mb-3 d-flex justify-content-between"><span>First Aid Kit</span> <span class="text-success"><i class="fas fa-check-circle"></i> Restocked</span></li>
                </ul>
                <button class="btn btn-outline-light w-100 btn-sm mt-2">Request Supplies</button>
            </div>
        </div>
    </div>
</div>
@endsection
