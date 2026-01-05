@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body { background-color: #fce7f3; font-family: 'Playfair Display', serif; } /* Soft Pink */
    .wedding-card { background: white; border-radius: 50% 50% 0 0; padding: 40px 20px 20px; border: 1px solid #fbcfe8; text-align: center; box-shadow: 0 4px 6px rgba(0,0,0,0.02); }
    .countdown-box { background: white; border-radius: 8px; padding: 15px; border: 1px solid #f9a8d4; margin-bottom: 10px; }
    .hero-title { font-size: 2.5rem; color: #be185d; }
</style>
<div class="container-fluid p-5">
    <div class="text-center mb-5">
        <h1 class="hero-title fw-bold">Amour Events <i class="fas fa-heart text-danger"></i></h1>
        <p class="text-muted">Making dreams come true, one detail at a time.</p>
    </div>

    <div class="row g-5">
        <div class="col-md-4">
            <div class="bg-white p-4 rounded shadow-sm h-100 border-start border-5 border-danger">
                <h5 class="fw-bold text-uppercase text-muted mb-4">Next Wedding</h5>
                <h2 class="fw-bold mb-0">Emma & Liam</h2>
                <p class="text-muted">The Grand Plaza Hotel</p>
                <div class="row mt-4">
                    <div class="col-4"><div class="countdown-box"><h3 class="m-0 fw-bold text-danger">04</h3><small>Days</small></div></div>
                    <div class="col-4"><div class="countdown-box"><h3 class="m-0 fw-bold text-danger">12</h3><small>Hours</small></div></div>
                    <div class="col-4"><div class="countdown-box"><h3 class="m-0 fw-bold text-danger">30</h3><small>Mins</small></div></div>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
             <div class="bg-white p-4 rounded shadow-sm h-100">
                 <div class="d-flex justify-content-between align-items-center mb-4">
                     <h5 class="fw-bold">Task Checklist</h5>
                     <div class="progress w-50" style="height: 10px;">
                         <div class="progress-bar bg-danger" style="width: 75%"></div>
                     </div>
                 </div>
                 
                 <div class="list-group list-group-flush">
                     <div class="list-group-item">
                         <input class="form-check-input me-2" type="checkbox" checked>
                         <span class="text-decoration-line-through text-muted">Confirm Florist Delivery</span>
                     </div>
                     <div class="list-group-item">
                         <input class="form-check-input me-2" type="checkbox" checked>
                         <span class="text-decoration-line-through text-muted">Finalize Seating Chart</span>
                     </div>
                     <div class="list-group-item">
                         <input class="form-check-input me-2" type="checkbox">
                         <span class="fw-bold">Rehearsal Dinner Coordination</span> <span class="badge bg-warning text-dark ms-2">Today</span>
                     </div>
                     <div class="list-group-item">
                         <input class="form-check-input me-2" type="checkbox">
                         <span>Pick up Dress from Tailor</span>
                     </div>
                 </div>
             </div>
        </div>
    </div>
</div>
@endsection
