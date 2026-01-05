@extends('layouts.app')

@section('title', 'Client Dashboard')

@section('content')
<div class="container-fluid p-4">
    <h2 class="mb-4">Client Dashboard</h2>
    <p>Explore Creative, Lifestyle & Wellness Services</p>
    
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5>My Bookings</h5>
                    <p class="display-4">0</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5>Upcoming Sessions</h5>
                    <p class="display-4">0</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5>Favorites</h5>
                    <p class="display-4">0</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
