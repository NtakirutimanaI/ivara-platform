@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="container-fluid p-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold text-dark"><i class="fas fa-tasks me-3"></i>Manager Dashboard</h1>
        <p class="lead">Food, Events & Fashion Category</p>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
             <div class="p-4 bg-white rounded shadow-sm border-start border-5 border-primary">
                 <h5 class="fw-bold">Pending Approvals</h5>
                 <p class="text-muted">No pending approvals.</p>
             </div>
        </div>
        <div class="col-md-4">
             <div class="p-4 bg-white rounded shadow-sm border-start border-5 border-success">
                 <h5 class="fw-bold">Active Providers</h5>
                 <p class="text-muted">All systems go.</p>
             </div>
        </div>
        <div class="col-md-4">
             <div class="p-4 bg-white rounded shadow-sm border-start border-5 border-info">
                 <h5 class="fw-bold">Reports</h5>
                 <p class="text-muted">View monthly activity.</p>
             </div>
        </div>
    </div>
</div>
@endsection
