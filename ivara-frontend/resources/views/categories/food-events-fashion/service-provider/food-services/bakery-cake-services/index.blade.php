@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body { background-color: #fff7ed; font-family: 'Segoe UI', sans-serif; } /* Light Orange */
    .cake-stat { background: white; padding: 20px; border-radius: 50%; width: 150px; height: 150px; display: flex; flex-direction: column; align-items: center; justify-content: center; border: 4px solid #fed7aa; margin: 0 auto; }
    .cake-val { font-size: 2.5rem; font-weight: bold; color: #c2410c; }
</style>
<div class="container-fluid p-5 text-center">
    <h1 class="fw-bold mb-2">Sweet Delights Bakery 🍰</h1>
    <p class="text-muted mb-5">Orders for today: <span class="fw-bold text-dark">January 1st, 2026</span></p>

    <div class="row g-5">
        <div class="col-md-4">
            <div class="cake-stat">
                <div class="cake-val">12</div>
                <small class="text-uppercase fw-bold text-muted">To Bake</small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="cake-stat" style="border-color: #86efac;">
                <div class="cake-val text-success">5</div>
                <small class="text-uppercase fw-bold text-muted">Ready</small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="cake-stat" style="border-color: #cbd5e1;">
                <div class="cake-val text-secondary">8</div>
                <small class="text-uppercase fw-bold text-muted">Delivered</small>
            </div>
        </div>
    </div>
    
    <div class="mt-5 p-4 bg-white rounded shadow-sm mx-auto" style="max-width: 800px;">
        <h5 class="fw-bold text-start mb-3">Order Queue</h5>
        <div class="list-group list-group-flush text-start">
             <div class="list-group-item d-flex justify-content-between">
                 <span>Wedding Cake (3 Tier, Vanilla) - <em class="text-muted">Johnson Wedding</em></span>
                 <span class="badge bg-warning text-dark">In Oven</span>
             </div>
             <div class="list-group-item d-flex justify-content-between">
                 <span>Cupcakes (50x, Red Velvet) - <em class="text-muted">Tech Mixer</em></span>
                 <span class="badge bg-info text-dark">Decorating</span>
             </div>
        </div>
    </div>
</div>
@endsection
