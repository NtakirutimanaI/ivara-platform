@extends('layouts.app')

@section('content')
<div class="dashboard-wrapper">
    <header class="pro-header">
        <div>
            <h1>Invoices</h1>
            <p>Generated billing documents for subscriptions and commissions.</p>
        </div>
    </header>
    <div class="pro-card glass-panel text-center">
        <i class="fas fa-file-invoice fa-3x text-muted mb-3"></i>
        <p>No open invoices found.</p>
    </div>
</div>
@endsection
