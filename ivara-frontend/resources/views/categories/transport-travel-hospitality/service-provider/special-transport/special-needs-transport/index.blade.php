@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body { background-color: #f0f9ff; font-family: 'Segoe UI', sans-serif; } /* Light Blue */
    .access-card { background: white; border-radius: 12px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); border: 1px solid #e0f2fe; }
    .icon-box { width: 60px; height: 60px; background: #e0f2fe; color: #0284c7; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 15px; }
</style>
<div class="container-fluid p-5">
    <div class="mb-5">
        <h1 class="fw-bold text-primary">Accessible Transport Service ♿</h1>
        <p class="text-secondary lead">Providing safe, comfortable, and dignified travel for everyone.</p>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="access-card">
                <div class="icon-box"><i class="fas fa-calendar-check"></i></div>
                <h4 class="fw-bold">Today's Schedule</h4>
                <p class="text-muted">3 scheduled pickups active.</p>
                <button class="btn btn-outline-primary rounded-pill">View Timetable</button>
            </div>
        </div>
        <div class="col-md-4">
            <div class="access-card">
                <div class="icon-box"><i class="fas fa-notes-medical"></i></div>
                <h4 class="fw-bold">Passenger Needs</h4>
                <p class="text-muted">Review accessibility requirements.</p>
                <button class="btn btn-outline-primary rounded-pill">View Profiles</button>
            </div>
        </div>
        <div class="col-md-4">
            <div class="access-card">
                <div class="icon-box"><i class="fas fa-wrench"></i></div>
                <h4 class="fw-bold">Lift Mechanism</h4>
                <p class="text-success fw-bold"><i class="fas fa-check"></i> Operational</p>
                <small class="text-muted">Last check: 2 hours ago</small>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header bg-white p-4 border-bottom">
            <h5 class="fw-bold m-0 text-dark">Upcoming Pickups</h5>
        </div>
        <div class="card-body p-0">
            <div class="list-group list-group-flush">
                <div class="list-group-item p-4 border-bottom">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fw-bold mb-1">Mr. Richards (Wheelchair Access)</h6>
                            <p class="mb-0 text-muted small"><i class="fas fa-map-marker-alt me-1"></i> Oakwood Care Home to City Hospital</p>
                        </div>
                        <div class="text-end">
                            <div class="fw-bold text-primary">10:30 AM</div>
                            <span class="badge bg-light text-dark">Confirmed</span>
                        </div>
                    </div>
                </div>
                <div class="list-group-item p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fw-bold mb-1">Ms. Davis (Assisted Walk)</h6>
                            <p class="mb-0 text-muted small"><i class="fas fa-map-marker-alt me-1"></i> 15 Park Ave to Community Center</p>
                        </div>
                        <div class="text-end">
                            <div class="fw-bold text-primary">02:00 PM</div>
                            <span class="badge bg-light text-dark">Pending</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
