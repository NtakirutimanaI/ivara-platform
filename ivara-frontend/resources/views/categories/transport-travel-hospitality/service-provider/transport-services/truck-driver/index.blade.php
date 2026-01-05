@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body { background-color: #f1f5f9; font-family: 'Segoe UI', sans-serif; }
    .premium-card { background: white; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); transition: 0.3s; padding: 24px; border: 1px solid #e2e8f0; }
    .premium-card:hover { transform: translateY(-5px); }
    .bg-gradient-truck { background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); color: white; }
</style>
@php
    $logs = [
        ['id' => 'L-8841', 'cargo' => 'Electronics', 'dest' => 'Warehouse A', 'status' => 'In Transit'],
        ['id' => 'L-8840', 'cargo' => 'Furniture', 'dest' => 'Retail Park', 'status' => 'Delivered'],
    ];
@endphp
<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <h1 class="fw-bold">Truck Logistics Hub 🚛</h1>
        <span class="badge bg-primary fs-6 px-3 py-2">On Duty</span>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="premium-card bg-gradient-truck">
                <h3 class="fw-bold">1,450 km</h3>
                <p class="mb-0 opacity-75">Distance This Week</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="premium-card">
                <h3 class="fw-bold text-dark">4 Pending</h3>
                <p class="mb-0 text-muted">Shipment Allocations</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="premium-card">
                <h3 class="fw-bold text-success">Good</h3>
                <p class="mb-0 text-muted">Vehicle Condition</p>
            </div>
        </div>
    </div>
    
    <div class="premium-card">
        <h5 class="fw-bold mb-3">Active Shipments</h5>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead><tr><th>ID</th><th>Cargo</th><th>Destination</th><th>Status</th></tr></thead>
                <tbody>
                    @foreach($logs as $log)
                    <tr>
                        <td>{{ $log['id'] }}</td>
                        <td>{{ $log['cargo'] }}</td>
                        <td>{{ $log['dest'] }}</td>
                        <td><span class="badge bg-info text-dark">{{ $log['status'] }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
