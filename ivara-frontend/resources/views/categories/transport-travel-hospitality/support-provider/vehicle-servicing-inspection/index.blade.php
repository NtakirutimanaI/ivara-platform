@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body { background-color: #262626; color: #d4d4d4; font-family: 'Roboto Mono', monospace; } /* Industrial Dark */
    .tech-card { background: #404040; border-left: 5px solid #ea580c; border-radius: 2px; padding: 20px; margin-bottom: 20px; }
    .stat-val { font-size: 2.5rem; color: #fff; font-weight: bold; }
    .btn-orange { background: #ea580c; color: white; border: none; }
    .btn-orange:hover { background: #c2410c; color: white; }
</style>
<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-5 border-bottom border-secondary pb-4">
        <h2 class="text-white"><i class="fas fa-tools me-3 text-warning"></i>Service Bay Control</h2>
        <span class="badge bg-secondary p-2">Bay 4 Active</span>
    </div>

    <div class="row g-4">
        <div class="col-md-3">
            <div class="tech-card">
                <div class="text-uppercase small mb-2 text-warning">Active Jobs</div>
                <div class="stat-val">5</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="tech-card" style="border-color: #22c55e;">
                <div class="text-uppercase small mb-2 text-success">Completed</div>
                <div class="stat-val">12</div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="tech-card border-left-0 bg-dark">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="text-white">Next Appointment</h5>
                        <p class="mb-0">Toyota Camry - Full Service</p>
                    </div>
                    <div class="text-end">
                        <h3 class="text-white">14:30</h3>
                        <span class="badge bg-primary">Confirmed</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h4 class="text-white mt-4 mb-3">Job Queue</h4>
    <table class="table table-dark table-hover table-bordered border-secondary">
        <thead>
            <tr>
                <th>Job ID</th>
                <th>Vehicle</th>
                <th>Service Type</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>#SRV-4421</td>
                <td>Ford Transit</td>
                <td>Oil Change & Filter</td>
                <td><span class="text-warning">In Progress</span></td>
                <td><button class="btn btn-sm btn-outline-light">Update</button></td>
            </tr>
            <tr>
                <td>#SRV-4422</td>
                <td>Honda Civic</td>
                <td>Brake Pad Replacement</td>
                <td><span class="text-info">Waiting Parts</span></td>
                <td><button class="btn btn-sm btn-outline-light">View</button></td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
