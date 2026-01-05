@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="container-fluid p-5" style="background-color: #e0f7fa; min-height: 100vh;">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="fw-bold" style="color: #006064;">Mediation Room</h1>
            <p class="text-muted">Resolving Conflicts in Food, Events & Fashion</p>
        </div>
        <span class="badge bg-info text-dark">3 Active Cases</span>
    </div>

    <div class="row g-4">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold text-muted mb-4">Case #402: Wedding Planner vs. Florist</h5>
                    <div class="p-3 bg-light rounded mb-3 border-start border-5 border-warning">
                        <small class="text-uppercase text-muted">Issue</small>
                        <p class="mb-0">Late delivery of centerpieces caused delay.</p>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                         <button class="btn btn-outline-secondary">View Evidence</button>
                         <button class="btn btn-primary" style="background-color: #00838f; border:none;">Enter Chat</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 bg-white">
                <div class="card-body p-4 text-center d-flex flex-column justify-content-center">
                     <i class="fas fa-handshake fa-4x mb-3" style="color: #00acc1;"></i>
                     <h4>Resolution Rate</h4>
                     <h1 class="fw-bold text-dark">94%</h1>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
