@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body { background-color: #fffbeb; font-family: 'Segoe UI', sans-serif; } /* Warm Orange */
    .menu-card { background: white; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); overflow: hidden; transition: 0.3s; }
    .menu-card:hover { transform: translateY(-5px); }
    .order-status { font-weight: bold; font-size: 0.8rem; text-transform: uppercase; padding: 4px 10px; border-radius: 4px; }
</style>
<div class="container-fluid p-5">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h2 class="fw-bold text-dark"><i class="fas fa-utensils me-3 text-warning"></i>Gourmet Catering Co.</h2>
            <p class="text-muted mb-0">Kitchen Status: <span class="text-success fw-bold">ACTIVE SERVICE</span></p>
        </div>
        <button class="btn btn-warning text-white fw-bold shadow-sm">+ New Order</button>
    </div>

    <div class="row g-4">
        <!-- Active Orders -->
        <div class="col-lg-8">
            <h5 class="fw-bold mb-3">Live Order Stream</h5>
            <div class="menu-card p-0">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th class="p-3">Event</th>
                            <th>Menu</th>
                            <th>Guest Count</th>
                            <th>Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="p-3 fw-bold">Tech Corp Seminar</td>
                            <td>Premium Lunch Buffet</td>
                            <td>150</td>
                            <td>12:30 PM</td>
                            <td><span class="badge bg-warning text-dark">Prep</span></td>
                        </tr>
                        <tr>
                            <td class="p-3 fw-bold">Smith Birthday</td>
                            <td>Kids Party Pack</td>
                            <td>40</td>
                            <td>03:00 PM</td>
                            <td><span class="badge bg-secondary">Queued</span></td>
                        </tr>
                        <tr>
                            <td class="p-3 fw-bold">City Gala</td>
                            <td>3-Course Plated Dinner</td>
                            <td>300</td>
                            <td>07:00 PM</td>
                            <td><span class="badge bg-info text-dark">Review</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Inventory -->
        <div class="col-lg-4">
            <h5 class="fw-bold mb-3">Pantry Alerts</h5>
            <div class="menu-card p-4 bg-white">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div><i class="fas fa-exclamation-circle text-danger me-2"></i> Fresh Salmon</div>
                        <span class="badge bg-danger rounded-pill">Low Stock</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div><i class="fas fa-exclamation-circle text-warning me-2"></i> Avocados</div>
                        <span class="badge bg-warning text-dark rounded-pill">Expiring Soon</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div><i class="fas fa-check-circle text-success me-2"></i> Wine Selection</div>
                        <span class="badge bg-success rounded-pill">Restocked</span>
                    </li>
                </ul>
                <button class="btn btn-outline-dark w-100 mt-3">Generate Prep List</button>
            </div>
        </div>
    </div>
</div>
@endsection
