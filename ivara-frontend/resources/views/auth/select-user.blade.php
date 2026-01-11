@extends('layouts.app')

@section('title', 'Select Profile - IVARA Dashboard')

@section('styles')
<style>
    :root {
        --primary: #924FC2;
        --primary-glow: rgba(146, 79, 194, 0.2);
        --bg-selection: radial-gradient(circle at top right, #fdf4ff, #f3f4f6);
    }

    [data-theme="dark"] {
        --bg-selection: radial-gradient(circle at top right, #0f172a, #020617);
    }

    .selection-wrapper {
        min-height: calc(100vh - 72px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
        background: var(--bg-selection);
        transition: background 0.3s ease;
    }

    .selection-card {
        background: var(--glass-bg);
        backdrop-filter: blur(25px);
        border-radius: 35px;
        border: 1px solid var(--glass-border);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        width: 100%;
        max-width: 450px;
        padding: 40px;
        animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .selection-header {
        text-align: center;
        margin-bottom: 35px;
    }

    .selection-title {
        font-size: 28px;
        font-weight: 900;
        margin-bottom: 10px;
        background: linear-gradient(135deg, var(--primary), #6366f1);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        letter-spacing: -1px;
    }

    .selection-subtitle {
        font-size: 14px;
        color: var(--text-muted);
        font-weight: 500;
    }

    .selection-subtitle strong {
        color: var(--primary);
    }

    .user-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .user-item {
        background: #ffffff;
        border-radius: 20px;
        padding: 20px;
        border: 1px solid #e2e8f0;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        align-items: center;
        width: 100%;
        text-align: left;
        position: relative;
    }

    [data-theme="dark"] .user-item {
        background: rgba(30, 41, 59, 0.5);
        border-color: rgba(255, 255, 255, 0.05);
    }

    .user-item:hover {
        transform: scale(1.03);
        border-color: var(--primary);
        box-shadow: 0 10px 20px rgba(146, 79, 194, 0.1);
    }

    .user-meta {
        display: flex;
        align-items: center;
        gap: 15px;
        flex: 1;
    }

    .user-avatar {
        width: 50px;
        height: 50px;
        border-radius: 14px;
        background: linear-gradient(135deg, var(--primary), #6366f1);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 18px;
        flex-shrink: 0;
        box-shadow: 0 5px 15px var(--primary-glow);
    }

    .user-info h4 {
        margin: 0;
        font-size: 16px;
        font-weight: 800;
        color: var(--text-main);
    }

    .user-info p {
        margin: 2px 0 0 0;
        font-size: 12px;
        color: var(--text-muted);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .btn-enter {
        color: var(--text-muted);
        font-size: 18px;
        transition: 0.3s;
    }

    .user-item:hover .btn-enter {
        transform: translateX(5px);
        color: var(--primary);
    }

    .back-link {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        margin-top: 30px;
        color: var(--text-muted);
        text-decoration: none;
        font-size: 14px;
        font-weight: 700;
        transition: 0.3s;
    }

    .back-link:hover {
        color: var(--primary);
    }

    @keyframes slideUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection

@section('content')
<div class="selection-wrapper">
    <div class="selection-card">
        <div class="selection-header">
            <h1 class="selection-title">Select Profile</h1>
            <p class="selection-subtitle">Access your <strong>{{ ucwords(str_replace('-', ' ', $category)) }}</strong> workspace</p>
        </div>
        
        <form action="{{ route('auth.enter-dashboard') }}" method="POST" class="user-list">
            @csrf
            <input type="hidden" name="category" value="{{ $category }}">
            
            @foreach($users as $user)
            <button type="submit" name="user_id" value="{{ $user->id }}" class="user-item">
                <div class="user-meta">
                    <div class="user-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                    <div class="user-info">
                        <h4>{{ $user->name }}</h4>
                        <p>{{ str_replace(['-', '_'], ' ', $user->role) }} Workspace</p>
                    </div>
                </div>
                <div class="btn-enter"><i class="fas fa-arrow-right"></i></div>
            </button>
            @endforeach
        </form>

        <a href="{{ route('auth.select-category') }}" class="back-link">
            <i class="fas fa-chevron-left"></i> Change Category
        </a>
    </div>
</div>
@endsection
