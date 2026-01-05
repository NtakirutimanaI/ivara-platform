@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="container-fluid p-5">
    <div class="text-center mb-5">
        <h1 class="font-monospace fw-bold display-4 text-uppercase" style="color: #6a1b9a; letter-spacing: 2px;">Moderation Console</h1>
        <p class="text-muted text-uppercase">Food & Fashion Enforcement</p>
    </div>

    <div class="row align-items-center mb-5">
        <div class="col-md-3">
             <div class="card border-0 shadow-sm text-center p-3" style="background: #f3e5f5;">
                 <h2 style="color: #6a1b9a;">0</h2>
                 <small class="text-uppercase fw-bold text-muted">Banned Users</small>
             </div>
        </div>
        <div class="col-md-3">
             <div class="card border-0 shadow-sm text-center p-3" style="background: #e1bee7;">
                 <h2 style="color: #6a1b9a;">2</h2>
                 <small class="text-uppercase fw-bold text-muted">Flagged Content</small>
             </div>
        </div>
        <div class="col-md-6">
             <div class="alert alert-dark d-flex justify-content-between align-items-center">
                 <span><i class="fas fa-eye me-2"></i> System Status: <strong>Monitoring Active</strong></span>
                 <button class="btn btn-sm btn-outline-dark">View Logs</button>
             </div>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-bottom fw-bold text-uppercase" style="color: #6a1b9a;">
            Flagged Reviews & Posts
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                     <strong>User #9921</strong>
                     <p class="mb-0 text-muted small">Reported for spam in "Wedding Gowns"</p>
                </div>
                <div>
                     <button class="btn btn-sm btn-success me-2">Approve</button>
                     <button class="btn btn-sm btn-danger">Ban</button>
                </div>
            </li>
             <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                     <strong>Vendor: BakeryX</strong>
                     <p class="mb-0 text-muted small">Dispute over refund policy</p>
                </div>
                <div>
                     <button class="btn btn-sm btn-warning">Investigate</button>
                </div>
            </li>
        </ul>
    </div>
</div>
@endsection
