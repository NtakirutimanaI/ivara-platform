@extends('layouts.app')

@section('title', 'Service Provider Dashboard')

@section('content')
<div class="container-fluid p-4">
    <h2 class="mb-4">Service Provider Dashboard</h2>
    <p>Welcome to the Creative, Lifestyle & Wellness Service Provider Portal</p>
    
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5>Bookings</h5>
                    <p class="display-4">0</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5>Sessions</h5>
                    <p class="display-4">0</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5>Earnings</h5>
                    <p class="display-4">$0</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
