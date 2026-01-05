@extends('layouts.app')
@section('title', 'Events Organizer Dashboard')
@section('content')
<div class="container-fluid p-4">
    <div class="bento-card bg-glass p-5 text-center">
        <i class="fas fa-calendar-check text-warning display-3 mb-4"></i>
        <h2 class="fw-bold">Events & Logistics Organizer</h2>
        <p class="text-muted">Manage gala events, catering schedules, and venue logistics.</p>
        <div class="row g-4 mt-4">
            <div class="col-md-6">
                <div class="p-4 bg-soft-warning rounded-4 h-100">
                    <i class="fas fa-tasks d-block mb-3 fs-2"></i>
                    <h5 class="fw-bold">Active Events</h5>
                    <p class="small mb-0">Track 5 ongoing event planning sessions.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-4 bg-soft-info rounded-4 h-100">
                    <i class="fas fa-map-marker-alt d-block mb-3 fs-2"></i>
                    <h5 class="fw-bold">Venue Management</h5>
                    <p class="small mb-0">Coordinate with 3 different event spaces.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
