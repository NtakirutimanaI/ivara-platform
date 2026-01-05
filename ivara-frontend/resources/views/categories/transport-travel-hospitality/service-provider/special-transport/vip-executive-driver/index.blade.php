@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body { background-color: #0f172a; color: #f8fafc; font-family: 'Playfair Display', serif; } /* Dark Luxury */
    .vip-card { background: #1e293b; border: 1px solid #334155; border-radius: 4px; padding: 30px; }
    .gold-text { color: #f59e0b; }
    h1, h2, h3, h4 { font-weight: 700; letter-spacing: -0.5px; }
    .divider { height: 1px; background: linear-gradient(to right, transparent, #f59e0b, transparent); margin: 30px 0; }
</style>
<div class="container-fluid p-5">
    <div class="text-center mb-5">
        <h5 class="text-uppercase letter-spacing-2 gold-text mb-2">Executive Transport</h5>
        <h1 class="display-4">Welcome, Agent 007</h1>
        <p class="text-secondary">Your fleet is prepared. 2 reservations require your attention.</p>
    </div>

    <div class="row g-5">
        <div class="col-lg-8 offset-lg-2">
            <div class="vip-card shadow-lg position-relative">
                <span class="badge bg-warning text-dark position-absolute top-0 end-0 m-4 px-3 py-2">PRIORITY</span>
                <h3 class="mb-4">Current Reservation</h3>
                <div class="d-flex align-items-center mb-4">
                    <div class="display-1 gold-text me-4"><i class="fas fa-user-tie"></i></div>
                    <div>
                        <h4 class="mb-1">Mr. Sterling Archer</h4>
                        <p class="text-secondary mb-0">CEO, ISIS Corp.</p>
                    </div>
                </div>
                
                <div class="row mb-4 text-secondary">
                    <div class="col-6">
                        <small class="text-uppercase d-block mb-1">Pickup</small>
                        <span class="text-white lead">Grand Continental Hotel</span>
                    </div>
                    <div class="col-6 text-end">
                        <small class="text-uppercase d-block mb-1">Time</small>
                        <span class="text-white lead">19:00 Hours</span>
                    </div>
                </div>

                <div class="p-3 bg-black bg-opacity-25 rounded border border-secondary mb-4">
                    <small class="gold-text text-uppercase fw-bold mb-2 d-block"><i class="fas fa-info-circle me-1"></i> Preferences</small>
                    <ul class="list-unstyled mb-0 small text-light">
                        <li>• Temperature: 21°C</li>
                        <li>• Music: Classical Jazz</li>
                        <li>• Beverage: Sparkling Water (Chilled)</li>
                    </ul>
                </div>

                <button class="btn btn-outline-warning w-100 py-3 text-uppercase letter-spacing-1">Initiate Trip Protocol</button>
            </div>
        </div>
    </div>
</div>
@endsection
