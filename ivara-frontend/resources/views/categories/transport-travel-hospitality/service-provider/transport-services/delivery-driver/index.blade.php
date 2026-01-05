@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body { background-color: #f8fafc; font-family: 'Inter', sans-serif; }
    .stat-box { background: white; border-radius: 12px; padding: 20px; border: 1px solid #e2e8f0; }
    .stat-label { color: #64748b; font-size: 0.9rem; font-weight: 600; }
    .stat-num { font-size: 1.8rem; font-weight: 700; color: #0f172a; }
</style>
<div class="container-fluid p-4">
    <h2 class="fw-bold mb-4">Delivery Dashboard 📦</h2>
    <div class="row g-3 mb-4">
        <div class="col-md-3"><div class="stat-box"><div class="stat-label">Packages Delivered</div><div class="stat-num">24</div></div></div>
        <div class="col-md-3"><div class="stat-box"><div class="stat-label">Pending Orders</div><div class="stat-num text-primary">8</div></div></div>
        <div class="col-md-3"><div class="stat-box"><div class="stat-label">Earnings</div><div class="stat-num text-success">$120.50</div></div></div>
        <div class="col-md-3"><div class="stat-box"><div class="stat-label">Efficiency</div><div class="stat-num">94%</div></div></div>
    </div>
    
    <div class="bg-white p-4 rounded-3 border">
        <h5 class="fw-bold mb-3">Active Deliveries</h5>
        <div class="alert alert-info d-flex justify-content-between align-items-center">
            <div><strong>#ORD-9921</strong> • 2 Items • 4.5km away</div>
            <button class="btn btn-sm btn-primary">Navigate</button>
        </div>
        <div class="alert alert-secondary d-flex justify-content-between align-items-center">
            <div><strong>#ORD-9918</strong> • 1 Item • Pickup</div>
            <span class="badge bg-secondary">Waiting at Vendor</span>
        </div>
    </div>
</div>
@endsection
