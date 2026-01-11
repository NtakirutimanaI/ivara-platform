@extends('layouts.app')

@section('content')
<div class="dashboard-wrapper">
    <header class="pro-header">
        <div>
            <h1>Audit Logs</h1>
            <p>System security and action logs.</p>
        </div>
    </header>
    <div class="pro-card glass-panel">
        <ul class="list-unstyled">
             <li class="border-bottom border-secondary py-2">
                <small class="text-danger">[ALERT]</small> 20:01: Failed login attempt for user 'admin'
             </li>
             <li class="border-bottom border-secondary py-2">
                <small class="text-info">[INFO]</small> 19:55: System backup completed
             </li>
        </ul>
    </div>
</div>
@endsection
