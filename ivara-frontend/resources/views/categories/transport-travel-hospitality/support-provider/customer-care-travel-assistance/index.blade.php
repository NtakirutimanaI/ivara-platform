@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body { background-color: #f0fdf4; font-family: 'Segoe UI', sans-serif; } /* Light Green */
    .support-card { background: white; border-radius: 12px; border: 1px solid #dcfce7; box-shadow: 0 2px 10px rgba(0,0,0,0.02); padding: 25px; transition: 0.3s; }
    .support-card:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.05); }
    .chat-bubble { background: #dcfce7; padding: 15px; border-radius: 15px 15px 15px 0; margin-bottom: 10px; max-width: 80%; font-size: 0.9rem; }
</style>
<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <h2 class="fw-bold text-success"><i class="fas fa-headset me-2"></i>Customer Care Hub</h2>
        <div class="d-flex gap-2">
            <span class="badge bg-success py-2 px-3 rounded-pill"><i class="fas fa-circle small me-1"></i> Online</span>
            <span class="badge bg-warning text-dark py-2 px-3 rounded-pill">Queue: 3</span>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="support-card h-100">
                <div class="d-flex justify-content-between mb-4 border-bottom pb-3">
                    <h5 class="fw-bold m-0">Live Chat - Session #9921</h5>
                    <button class="btn btn-sm btn-outline-danger">End Chat</button>
                </div>
                <div class="chat-area mb-4" style="height: 300px; overflow-y: auto;">
                    <div class="d-flex mb-3">
                        <div class="bg-light p-3 rounded-3" style="max-width: 80%;">
                            <small class="text-muted d-block mb-1">User (Alice)</small>
                            Hi, I was charged twice for my last taxi ride. Can you help?
                        </div>
                    </div>
                    <div class="d-flex mb-3 justify-content-end">
                        <div class="bg-primary text-white p-3 rounded-3" style="max-width: 80%;">
                            <small class="text-white-50 d-block mb-1">You</small>
                            Hello Alice! I'm sorry to hear that. Let me pull up your transaction history. One moment please.
                        </div>
                    </div>
                </div>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Type your reply...">
                    <button class="btn btn-primary"><i class="fas fa-paper-plane"></i> Send</button>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="support-card mb-4">
                <h6 class="fw-bold text-uppercase text-muted mb-3">Ticket Overview</h6>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span>Open</span>
                    <span class="badge bg-danger rounded-pill">12</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span>Pending</span>
                    <span class="badge bg-warning text-dark rounded-pill">5</span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <span>Resolved Today</span>
                    <span class="badge bg-success rounded-pill">24</span>
                </div>
            </div>
            
            <div class="support-card bg-primary text-white">
                <h5 class="fw-bold"><i class="fas fa-star text-warning"></i> Feedback</h5>
                <p class="display-4 fw-bold mb-0">4.9</p>
                <small>Average Rating Today</small>
            </div>
        </div>
    </div>
</div>
@endsection
