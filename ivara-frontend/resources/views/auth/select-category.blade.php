@extends('layouts.app')

@section('title', 'Select Category - IVARA Dashboard')

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
        padding: 60px 20px;
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
        max-width: 1000px;
        padding: 50px;
        animation: fadeIn 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .selection-header {
        text-align: center;
        margin-bottom: 50px;
    }

    .selection-title {
        font-size: 36px;
        font-weight: 900;
        margin-bottom: 12px;
        background: linear-gradient(135deg, var(--primary), #6366f1);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        letter-spacing: -1px;
    }

    .selection-subtitle {
        font-size: 16px;
        color: var(--text-muted);
        font-weight: 500;
    }

    .category-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
    }

    .category-item {
        background: #ffffff;
        border-radius: 24px;
        padding: 25px;
        border: 1px solid #e2e8f0;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        align-items: center;
        gap: 20px;
        text-decoration: none;
        position: relative;
        overflow: hidden;
    }

    [data-theme="dark"] .category-item {
        background: rgba(30, 41, 59, 0.5);
        border-color: rgba(255, 255, 255, 0.05);
    }

    .category-item::after {
        content: '';
        position: absolute;
        top: 0; right: 0;
        width: 100px; height: 100px;
        background: linear-gradient(135deg, transparent 50%, rgba(146, 79, 194, 0.03) 50%);
        border-radius: 0 0 0 100%;
        transition: 0.3s;
    }

    .category-item:hover {
        transform: translateY(-5px) scale(1.02);
        border-color: var(--primary);
        box-shadow: 0 15px 30px rgba(146, 79, 194, 0.1);
    }

    .category-item:hover::after {
        background: linear-gradient(135deg, transparent 50%, rgba(146, 79, 194, 0.08) 50%);
    }

    .category-icon {
        width: 56px;
        height: 56px;
        border-radius: 16px;
        background: var(--primary);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
        box-shadow: 0 8px 16px var(--primary-glow);
        transition: 0.3s;
    }

    .category-item:hover .category-icon {
        transform: rotate(5deg) scale(1.1);
    }

    .category-info h3 {
        margin: 0 0 4px 0;
        font-size: 17px;
        font-weight: 800;
        color: var(--text-main);
    }

    .category-info p {
        margin: 0;
        font-size: 13px;
        color: var(--text-muted);
        line-height: 1.5;
        font-weight: 500;
    }

    .category-arrow {
        margin-left: auto;
        color: var(--text-muted);
        opacity: 0;
        transform: translateX(-10px);
        transition: 0.3s;
    }

    .category-item:hover .category-arrow {
        opacity: 1;
        transform: translateX(0);
        color: var(--primary);
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 768px) {
        .selection-card { padding: 30px 20px; border-radius: 25px; }
        .selection-title { font-size: 28px; }
        .category-grid { grid-template-columns: 1fr; }
    }
</style>
@endsection

@section('content')
<div class="selection-wrapper">
    <div class="selection-card">
        <div class="selection-header">
            <h1 class="selection-title">Welcome Back, {{ str_replace(['-', '_'], ' ', ucfirst(auth()->user()->role)) }}!</h1>
            <p class="selection-subtitle">Choose the category you want to manage today</p>
        </div>
        
        <div class="category-grid">
            @foreach($categories as $cat)
            <a href="{{ route('auth.select-user', ['category' => $cat['id']]) }}" class="category-item">
                <div class="category-icon">
                    <i class="{{ $cat['icon'] }}"></i>
                </div>
                <div class="category-info">
                    <h3>{{ $cat['name'] }}</h3>
                    <p>{{ $cat['desc'] }}</p>
                </div>
                <div class="category-arrow">
                    <i class="fas fa-arrow-right"></i>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endsection
