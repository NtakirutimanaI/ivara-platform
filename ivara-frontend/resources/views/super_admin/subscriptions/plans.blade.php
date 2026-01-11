@extends('layouts.app')

@section('content')
<div class="dashboard-wrapper">
    <header class="pro-header">
        <div>
            <h1>Subscription Plans</h1>
            <p>Manage pricing tiers and features.</p>
        </div>
    </header>
    <div class="row">
        <div class="col-md-4">
            <div class="pro-card glass-panel text-center">
                <h3>Free / Basic</h3>
                <h2 class="text-primary">0 RWF</h2>
                <button class="btn btn-outline-primary mt-3">Edit Features</button>
            </div>
        </div>
        <div class="col-md-4">
            <div class="pro-card glass-panel text-center border-primary">
                <h3>Pro Provider</h3>
                <h2 class="text-warning">15,000 RWF</h2>
                <button class="btn btn-warning mt-3">Edit Features</button>
            </div>
        </div>
    </div>
</div>
@endsection
