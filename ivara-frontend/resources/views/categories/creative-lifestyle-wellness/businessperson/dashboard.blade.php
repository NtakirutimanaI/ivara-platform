@extends('layouts.app')

@section('title', 'Businessperson Dashboard')

@section('content')
<div class="container-fluid p-4">
    <h2 class="mb-4">Businessperson Dashboard</h2>
    <p>Welcome to your Business Management Portal</p>
    
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5>Staff</h5>
                    <p class="display-4">0</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5>Clients</h5>
                    <p class="display-4">0</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5>Bookings</h5>
                    <p class="display-4">0</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5>Revenue</h5>
                    <p class="display-4">$0</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
