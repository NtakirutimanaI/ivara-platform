@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body { background-color: #fff7ed; font-family: 'Segoe UI', sans-serif; } /* Warm tone for tourism */
    .premium-card { background: white; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); padding: 30px; border: none; }
    .hero-stat { font-size: 3rem; font-weight: 800; color: #c2410c; }
</style>
<div class="container-fluid p-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold display-5 text-dark">Adventure Awaits, Guide! 🗺️</h1>
        <p class="lead text-muted">Your next group is ready for an unforgettable journey.</p>
    </div>

    <div class="row g-4">
        <div class="col-md-6 col-lg-3">
            <div class="premium-card text-center">
                <i class="fas fa-camera-retro fa-3x text-warning mb-3"></i>
                <div class="hero-stat">12</div>
                <div class="text-uppercase fw-bold text-muted letter-spacing-1">Upcoming Tours</div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="premium-card text-center">
                <i class="fas fa-users fa-3x text-info mb-3"></i>
                <div class="hero-stat">45</div>
                <div class="text-uppercase fw-bold text-muted letter-spacing-1">Tourists This Week</div>
            </div>
        </div>
        <div class="col-md-12 col-lg-6">
            <div class="premium-card h-100 d-flex flex-column justify-content-center align-items-center bg-dark text-white" style="background: url('https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80') center/cover;">
                <div class="bg-black bg-opacity-50 p-4 rounded-3 text-center">
                    <h3 class="fw-bold">Next Stop: City Museum</h3>
                    <p class="mb-3">Group of 8 • 10:00 AM Tomorrow</p>
                    <button class="btn btn-light rounded-pill px-4">View Itinerary</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
