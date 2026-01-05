@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="container-fluid p-5">
    <div class="d-flex align-items-center mb-5">
        <div class="bg-primary text-white p-3 rounded me-3"><i class="fas fa-briefcase fa-2x"></i></div>
        <div>
            <h2 class="fw-bold m-0">Business Hub (FEF)</h2>
            <p class="text-muted m-0">Food, Events & Fashion Sector</p>
        </div>
    </div>
    
    <div class="alert alert-info">Dashboard Initialized. Modules loading...</div>
    
    <!-- Generic Content -->
    <div class="row g-4">
        <div class="col-md-4"><div class="card p-4 shadow-sm border-0"><h3 class="fw-bold">Financials</h3><p>View Reports</p></div></div>
        <div class="col-md-4"><div class="card p-4 shadow-sm border-0"><h3 class="fw-bold">Contracts</h3><p>Manage Active</p></div></div>
        <div class="col-md-4"><div class="card p-4 shadow-sm border-0"><h3 class="fw-bold">Analytics</h3><p>Growth Trends</p></div></div>
    </div>
</div>
@endsection
