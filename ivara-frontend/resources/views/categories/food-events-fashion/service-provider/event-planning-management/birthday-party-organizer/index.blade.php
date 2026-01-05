@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body { background-color: #fce4ec; } /* Light pink */
    .party-card { background: white; border-radius: 20px; box-shadow: 0 4px 15px rgba(233,30,99, 0.1); padding: 25px; border: 2px solid #f8bbd0; }
</style>
<div class="container-fluid p-5">
    <h1 class="fw-bold text-center mb-5" style="color: #d81b60;">Party Planner Central <i class="fas fa-balloon ms-2"></i></h1>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="party-card text-center">
                <i class="fas fa-birthday-cake fa-3x text-danger mb-3"></i>
                <h4 class="fw-bold">Upcoming Birthdays</h4>
                <p class="h1 fw-bold text-dark">5</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="party-card text-center">
                <i class="fas fa-gift fa-3x text-primary mb-3"></i>
                <h4 class="fw-bold">Supplies</h4>
                <p class="text-muted">Balloons, Streamers, Candles checked.</p>
                <button class="btn btn-outline-danger btn-sm rounded-pill">Order More</button>
            </div>
        </div>
        <div class="col-md-4">
            <div class="party-card text-center">
                <i class="fas fa-music fa-3x text-info mb-3"></i>
                <h4 class="fw-bold">Entertainment</h4>
                <p class="text-muted">Magic Show booked for 2pm.</p>
            </div>
        </div>
    </div>
</div>
@endsection
