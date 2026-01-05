@extends('layouts.app')
@section('title', 'Coming Soon')
@section('content')
<div class="container-fluid p-4">
    <div class="bento-card bg-glass text-center p-5">
        <i class="fas fa-tools display-1 text-muted mb-4"></i>
        <h2 class="fw-bold text-primary">Service Module Under Construction</h2>
        <p class="lead text-muted">We are currently integrating this real-time transport feature with the Node.js microservice.</p>
        <a href="{{ url()->previous() }}" class="btn btn-primary mt-3">Back to Dashboard</a>
    </div>
</div>
@endsection
