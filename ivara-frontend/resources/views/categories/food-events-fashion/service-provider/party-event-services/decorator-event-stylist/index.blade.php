@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body { background-color: #faf5ff; font-family: 'Playfair Display', serif; } /* Lavender */
    .moodboard-card { border: none; border-radius: 12px; overflow: hidden; position: relative; height: 250px; background-size: cover; background-position: center; transition: 0.3s; }
    .moodboard-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
    .moodboard-title { position: absolute; bottom: 0; left: 0; right: 0; background: rgba(255,255,255,0.9); padding: 15px; font-weight: bold; text-align: center; color: #581c87; }
</style>
<div class="container-fluid p-5">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <h1 class="fw-bold text-dark" style="color: #6b21a8;">Design Studio <i class="fas fa-paint-brush ms-2"></i></h1>
        <button class="btn btn-outline-dark rounded-pill px-4">+ New Moodboard</button>
    </div>

    <h5 class="aa-section-title mb-3 fw-bold text-muted text-uppercase small ls-1">Active Projects</h5>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="moodboard-card" style="background-image: url('https://images.unsplash.com/photo-1519225468063-50126b84fc2d?auto=format&fit=crop&w=400&q=80');">
                <div class="moodboard-title">Rustic Garden Wedding</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="moodboard-card" style="background-image: url('https://images.unsplash.com/photo-1505236858219-8359eb29e329?auto=format&fit=crop&w=400&q=80');">
                <div class="moodboard-title">Cyberpunk Corporate Gala</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="moodboard-card bg-white d-flex align-items-center justify-content-center border border-dashed text-muted">
                <div class="text-center">
                    <i class="fas fa-plus fa-2x mb-2"></i><br>Create New Concept
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
