@extends('layouts.app')

@section('content')
<div class="dashboard-wrapper">
    <header class="pro-header">
        <div>
            <h1>Global Payments</h1>
            <p>Monitor all transaction flows on the platform.</p>
        </div>
    </header>
    <div class="pro-card glass-panel">
        <h4>Recent Transactions</h4>
        <table class="pro-table">
            <thead>
                <tr>
                    <th>Ref ID</th>
                    <th>User</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>TX-99281</td>
                    <td>user@example.com</td>
                    <td>5,000 RWF</td>
                    <td><span class="text-success">Success</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
