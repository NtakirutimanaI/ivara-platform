@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body { background-color: #f3f4f6; font-family: 'Segoe UI', sans-serif; }
    .mediate-card { background: white; border-radius: 6px; padding: 30px; border-top: 4px solid #6366f1; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
    .case-status { font-size: 0.8rem; font-weight: bold; text-transform: uppercase; padding: 4px 8px; border-radius: 4px; }
    .status-active { background: #e0e7ff; color: #4338ca; }
</style>
<div class="container-fluid p-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold text-dark">Dispute Resolution Center</h2>
        <p class="text-muted">Impartial Mediation & Arbitration Services</p>
    </div>

    <div class="row g-5 justify-content-center">
        <div class="col-md-8">
            <div class="mediate-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold">Active Cases</h5>
                    <button class="btn btn-primary btn-sm">New Case File</button>
                </div>
                
                <div class="list-group list-group-flush">
                    <div class="list-group-item border-0 px-0 py-3">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1 fw-bold">Case #9921: Fare Dispute - Rider vs. Driver</h6>
                            <span class="case-status status-active">In Negotiation</span>
                        </div>
                        <p class="mb-1 text-muted small">Parties agree to meet on Jan 4th, 2026.</p>
                    </div>
                     <div class="list-group-item border-0 px-0 py-3">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1 fw-bold">Case #9918: Damage Claim - Vehicle Rental</h6>
                            <span class="case-status status-active">Evidence Review</span>
                        </div>
                        <p class="mb-1 text-muted small">Photos submitted by claimant.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
