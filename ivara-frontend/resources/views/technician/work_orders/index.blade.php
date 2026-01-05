@extends('layouts.app')

@section('title', 'My Work Orders')

@section('content')
<div class="technician-page-container">
    <div class="container-fluid p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="fw-bold text-primary">Technical Work Orders</h1>
                <p class="text-muted">Generate and manage official repair documentation.</p>
            </div>
            <button class="btn btn-primary rounded-pill px-4">
                <i class="fas fa-plus me-2"></i> New Work Order
            </button>
        </div>

        <div class="row g-4">
            <!-- Active Work Orders -->
            <div class="col-md-4">
                <div class="glass-card p-4 border-start border-4 border-warning">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <span class="badge bg-warning text-dark uppercase p-2 px-3">Open</span>
                        <div class="dropdown">
                            <button class="btn btn-link text-muted p-0" data-bs-toggle="dropdown"><i class="fas fa-ellipsis-v"></i></button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Edit</a></li>
                                <li><a class="dropdown-item" href="#">Print PDF</a></li>
                            </ul>
                        </div>
                    </div>
                    <h5 class="fw-bold mb-1">WO-2025-0881</h5>
                    <p class="small text-muted mb-3">Client: David Miller</p>
                    <div class="repair-summary p-3 bg-light rounded-3 mb-3">
                        <div class="small fw-bold text-primary">REPAIR STATUS</div>
                        <div class="d-flex justify-content-between mt-1">
                            <span>Mainboard Swap</span>
                            <span class="fw-bold">60%</span>
                        </div>
                        <div class="progress mt-2" style="height: 6px;">
                            <div class="progress-bar" style="width: 60%"></div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="small text-muted"><i class="fas fa-calendar-alt me-1"></i> Due: Dec 30</div>
                        <button class="btn btn-sm btn-outline-primary">Open Console</button>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="glass-card p-4 border-start border-4 border-success">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <span class="badge bg-success uppercase p-2 px-3">Verified</span>
                        <div class="dropdown">
                            <button class="btn btn-link text-muted p-0" data-bs-toggle="dropdown"><i class="fas fa-ellipsis-v"></i></button>
                        </div>
                    </div>
                    <h5 class="fw-bold mb-1">WO-2025-0879</h5>
                    <p class="small text-muted mb-3">Client: Emma Wilson</p>
                    <div class="repair-summary p-3 bg-light rounded-3 mb-3">
                        <div class="small fw-bold text-success">COMPLETED</div>
                        <div class="d-flex justify-content-between mt-1">
                            <span>Screen Replacement</span>
                            <span class="fw-bold">100%</span>
                        </div>
                        <div class="progress mt-2" style="height: 6px;">
                            <div class="progress-bar bg-success" style="width: 100%"></div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="small text-muted"><i class="fas fa-check-circle me-1"></i> Dec 26, 2025</div>
                        <button class="btn btn-sm btn-success">Download Invoice</button>
                    </div>
                </div>
            </div>

             <div class="col-md-4">
                <div class="glass-card p-4 border-start border-4 border-primary">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <span class="badge bg-primary uppercase p-2 px-3">Quoted</span>
                        <div class="dropdown">
                            <button class="btn btn-link text-muted p-0" data-bs-toggle="dropdown"><i class="fas fa-ellipsis-v"></i></button>
                        </div>
                    </div>
                    <h5 class="fw-bold mb-1">WO-2025-0890</h5>
                    <p class="small text-muted mb-3">Client: Robert Cage</p>
                    <div class="repair-summary p-3 bg-light rounded-3 mb-3">
                        <div class="small fw-bold text-primary">ESTIMATION</div>
                        <div class="d-flex justify-content-between mt-1">
                            <span>Labor + Parts</span>
                            <span class="fw-bold">$240.00</span>
                        </div>
                        <div class="progress mt-2" style="height: 6px;">
                            <div class="progress-bar bg-primary" style="width: 0%"></div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="small text-muted"><i class="fas fa-clock me-1"></i> Awaiting Approval</div>
                        <button class="btn btn-sm btn-outline-primary">Send to Client</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    .technician-page-container { width: 96%; margin-left: 15px; }
    .glass-card { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.3); border-radius: 24px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
    .uppercase { text-transform: uppercase; letter-spacing: 1px; font-size: 0.7rem; }
</style>
@endsection
