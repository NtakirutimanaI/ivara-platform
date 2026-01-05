@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="container-fluid p-5">
    <div class="row align-items-center mb-5">
        <div class="col-md-7">
            <h1 class="fw-bold" style="color: #2e7d32;">My Agricultural Hub</h1>
            <p class="text-muted">Manage your orders and consultations.</p>
        </div>
        <div class="col-md-5 text-end">
            <button class="btn btn-outline-success me-2">Consult Expert</button>
            <button class="btn btn-success"><i class="fas fa-shopping-basket me-2"></i>Buy Supplies</button>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-8">
            <h4 class="fw-bold mb-3">Marketplace Recommendations</h4>
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm">
                        <div class="row g-0 align-items-center">
                            <div class="col-4 bg-light text-center py-4">
                                <i class="fas fa-seedling fa-3x text-success"></i>
                            </div>
                            <div class="col-8">
                                <div class="card-body">
                                    <h6 class="fw-bold">Organic Tomato Seeds</h6>
                                    <p class="small text-muted mb-1">High yield variety</p>
                                    <strong class="text-success">$12.50</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="col-md-6">
                    <div class="card border-0 shadow-sm">
                        <div class="row g-0 align-items-center">
                            <div class="col-4 bg-light text-center py-4">
                                <i class="fas fa-tools fa-3x text-dark"></i>
                            </div>
                            <div class="col-8">
                                <div class="card-body">
                                    <h6 class="fw-bold">Garden Trowel Set</h6>
                                    <p class="small text-muted mb-1">Stainless steel</p>
                                    <strong class="text-success">$24.00</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
             <div class="card border-0 shadow-sm bg-success text-white">
                 <div class="card-body p-4">
                     <h5 class="fw-bold">Tips of the Day</h5>
                     <ul class="list-unstyled mt-3">
                         <li class="mb-2"><i class="fas fa-check-circle me-2"></i> Water crops early morning.</li>
                         <li class="mb-2"><i class="fas fa-check-circle me-2"></i> Rotate crops for soil health.</li>
                         <li><i class="fas fa-check-circle me-2"></i> Mulch preventive weed growth.</li>
                     </ul>
                 </div>
             </div>
        </div>
    </div>
</div>
@endsection
