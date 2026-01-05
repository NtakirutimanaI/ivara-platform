@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="container-fluid p-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold text-success"><i class="fas fa-leaf me-3"></i>Agriculture & Environment Hub</h1>
        <p class="lead">Category Dashboard</p>
    </div>

    <div class="alert alert-success">
        Welcome to your workspace. This dashboard is successfully configured.
    </div>

    <div class="row g-4">
        <div class="col-md-4">
             <div class="p-4 bg-white rounded shadow-sm border-start border-5 border-success">
                 <h5 class="fw-bold">Fields / Units</h5>
                 <p class="text-muted">Status: Optimal</p>
             </div>
        </div>
        <div class="col-md-4">
             <div class="p-4 bg-white rounded shadow-sm border-start border-5 border-warning">
                 <h5 class="fw-bold">Tasks</h5>
                 <p class="text-muted">No pending alerts.</p>
             </div>
        </div>
        <div class="col-md-4">
             <div class="p-4 bg-white rounded shadow-sm border-start border-5 border-info">
                 <h5 class="fw-bold">Reports</h5>
                 <p class="text-muted">View harvest data.</p>
             </div>
        </div>
    </div>
</div>
@endsection
