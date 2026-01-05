@extends('layouts.app')

@section('title', 'Client Bookings')

@section('content')
<div class="technician-page-container">
    <div class="container-fluid p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="fw-bold text-primary">Appointment Bookings</h1>
                <p class="text-muted">Manage direct client technical consultations and repairs.</p>
            </div>
            <div class="d-flex align-items-center bg-white p-2 rounded-pill shadow-sm">
                <button class="btn btn-primary rounded-pill px-4 me-2">Today</button>
                <div class="text-muted small px-3">Dec 27, 2025</div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="glass-card p-0 overflow-hidden">
                    <div class="p-3 bg-primary text-white d-flex justify-content-between">
                        <span class="fw-bold fw-bold">MORNING SLOTS</span>
                        <i class="fas fa-sun"></i>
                    </div>
                    <div class="p-3">
                        <div class="appointment-card p-3 border rounded-4 mb-3 active">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="badge bg-white text-primary rounded-pill border">09:00 AM</span>
                                <i class="fas fa-check-circle text-primary"></i>
                            </div>
                            <h6 class="fw-bold mb-1 text-primary">Diagnose Water Damage</h6>
                            <p class="small text-muted mb-0">Client: Michael Smith</p>
                            <hr class="my-2 opacity-10">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="small text-muted"><i class="fas fa-map-marker-alt me-1"></i> Site Visit</span>
                                <button class="btn btn-sm btn-link p-0 fw-bold">START JOB</button>
                            </div>
                        </div>

                        <div class="appointment-card p-3 border rounded-4 mb-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="badge bg-white text-muted rounded-pill border">11:30 AM</span>
                            </div>
                            <h6 class="fw-bold mb-1 text-dark">Data Recovery Consulting</h6>
                            <p class="small text-muted mb-0">Client: ProDesign Ltd</p>
                            <hr class="my-2 opacity-10">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="small text-muted"><i class="fas fa-video me-1"></i> Video Call</span>
                                <button class="btn btn-sm btn-link p-0 text-muted">AWAITING</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="glass-card p-4">
                    <h5 class="fw-bold mb-4">Recent Inquiries & Requests</h5>
                    <div class="list-group list-group-flush">
                        <div class="list-group-item bg-transparent px-0 py-3 border-bottom d-flex gap-3">
                            <div class="avatar bg-soft-info text-info p-3 rounded-4"><i class="fas fa-envelope"></i></div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between">
                                    <h6 class="fw-bold mb-0">Alicia Keys</h6>
                                    <small class="text-muted">2 hours ago</small>
                                </div>
                                <p class="text-muted small mb-2">"Can you repair a vintage turn-table? The belt seems snapped."</p>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-sm btn-glass px-3">Reply</button>
                                    <button class="btn btn-sm btn-primary px-3">Accept & Schedule</button>
                                </div>
                            </div>
                        </div>
                         <div class="list-group-item bg-transparent px-0 py-3 border-bottom d-flex gap-3">
                            <div class="avatar bg-soft-primary text-primary p-3 rounded-4"><i class="fas fa-comment-dots"></i></div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between">
                                    <h6 class="fw-bold mb-0">TechSolutions HQ</h6>
                                    <small class="text-muted">Yesterday</small>
                                </div>
                                <p class="text-muted small mb-2">Contract request for ongoing server maintenance in Kigali.</p>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-sm btn-glass px-3">View Details</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .technician-page-container { width: 96%; margin-left: 15px; }
    .glass-card { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.3); border-radius: 24px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
    .appointment-card.active { border-color: #3b82f6 !important; background: rgba(59, 130, 246, 0.05); }
    .bg-soft-info { background: rgba(6, 182, 212, 0.1); color: #06b6d4; }
    .bg-soft-primary { background: rgba(59, 130, 246, 0.1); color: #3b82f6; }
    .btn-glass { background: rgba(0,0,0,0.02); border: 1px solid rgba(0,0,0,0.05); border-radius: 12px; font-weight: 600; }
</style>
@endsection
