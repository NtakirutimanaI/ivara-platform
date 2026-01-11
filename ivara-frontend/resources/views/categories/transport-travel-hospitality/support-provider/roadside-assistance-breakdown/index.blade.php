@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body { background-color: #f5f3ff; font-family: 'Segoe UI', sans-serif; } /* Light purple */
    .hazard-card { background: white; border-top: 4px solid #924FC2; box-shadow: 0 4px 6px rgba(0,0,0,0.05); padding: 20px; border-radius: 8px; }
    .btn-hazard { background-color: #000; color: #924FC2; font-weight: bold; border: none; }
    .btn-hazard:hover { background-color: #333; color: #924FC2; }
</style>
<div class="container-fluid p-4">
    <div class="d-flex align-items-center mb-5">
         <div class="text-white p-3 rounded me-3 shadow-sm" style="background-color: #924FC2;"><i class="fas fa-truck-pickup fa-2x"></i></div>
         <div>
             <h2 class="fw-bold m-0">Roadside Assistance</h2>
             <p class="text-muted m-0">Fleet ID: #TOW-01</p>
         </div>
    </div>

    <div class="alert alert-danger d-flex align-items-center shadow-sm" role="alert">
        <i class="fas fa-exclamation-triangle fa-2x me-3"></i>
        <div>
            <h5 class="alert-heading fw-bold m-0">New SOS Alert!</h5>
            <p class="mb-0">Vehicle Breakdown on Highway 401 Eastbound (Exit 23). Flat tire & Engine overheat.</p>
        </div>
        <button class="btn btn-light fw-bold ms-auto text-danger shadow-sm">Respond Now</button>
    </div>

    <div class="row g-4 mt-2">
        <div class="col-md-4">
            <div class="hazard-card h-100 text-center">
                <i class="fas fa-map-marked-alt fa-3x mb-3" style="color: #924FC2;"></i>
                <h5 class="fw-bold">My Location</h5>
                <p class="text-muted">Tracking Active</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="hazard-card h-100 text-center">
                <i class="fas fa-phone-alt fa-3x text-success mb-3"></i>
                <h5 class="fw-bold">Dispatch Center</h5>
                <p class="text-muted">Connected</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="hazard-card h-100 text-center">
                <i class="fas fa-clipboard-list fa-3x text-primary mb-3"></i>
                <h5 class="fw-bold">Daily Logs</h5>
                <p class="text-muted">4 Jobs Completed</p>
            </div>
        </div>
    </div>
</div>
@endsection
