@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="container-fluid p-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold text-primary"><i class="fas fa-university me-3"></i>Education & Knowledge Hub</h1>
        <p class="lead">Category Dashboard</p>
    </div>

    <div class="alert alert-info">
        Welcome to your workspace. This dashboard is successfully configured.
    </div>

    <div class="row g-4">
        <div class="col-md-4">
             <div class="p-4 bg-white rounded shadow-sm border-start border-5 border-primary">
                 <h5 class="fw-bold">Tasks</h5>
                 <p class="text-muted">No pending tasks.</p>
             </div>
        </div>
        <div class="col-md-4">
             <div class="p-4 bg-white rounded shadow-sm border-start border-5 border-success">
                 <h5 class="fw-bold">Notifications</h5>
                 <p class="text-muted">You are up to date.</p>
             </div>
        </div>
        <div class="col-md-4">
             <div class="p-4 bg-white rounded shadow-sm border-start border-5 border-info">
                 <h5 class="fw-bold">Resources</h5>
                 <p class="text-muted">Access library.</p>
             </div>
        </div>
    </div>
</div>
@endsection
