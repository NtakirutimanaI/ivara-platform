@include('layouts.header')
@include('layouts.sidebar')

@php
    $pageTitle = $pageTitle ?? 'Services';
    $pageIcon = $pageIcon ?? 'fa-concierge-bell';
@endphp

<style>
    :root {
        --category-color: {{ $categoryColor ?? '#E91E63' }};
        --category-glow: {{ $categoryColor ?? '#E91E63' }}40;
        --primary: #924FC2;
        --bg-panel: #fdf4ff;
        --text-primary: #1e293b;
        --text-secondary: #64748b;
        --card-bg: #ffffff;
        --border-color: #e2e8f0;
    }

    body.dark-theme {
        --bg-panel: #0f172a !important;
        --text-primary: #f8fafc !important;
        --text-secondary: #cbd5e1 !important;
        --card-bg: rgba(30, 41, 59, 0.6) !important;
        --border-color: rgba(255, 255, 255, 0.1) !important;
    }

    body { background: var(--bg-panel) !important; color: var(--text-primary) !important; font-family: 'Poppins', sans-serif; }

    .category-panel { width: 80%; max-width: 1600px; margin: 0 auto; padding: 30px 20px; padding-left: 270px; }

    .breadcrumb-nav { display: flex; align-items: center; gap: 8px; font-size: 14px; color: var(--text-secondary); margin-bottom: 20px; }
    .breadcrumb-nav a { color: var(--category-color); text-decoration: none; }
    .breadcrumb-nav a:hover { text-decoration: underline; }

    .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; flex-wrap: wrap; gap: 15px; }
    .page-title { font-size: 26px; font-weight: 800; color: var(--text-primary); margin: 0; display: flex; align-items: center; gap: 12px; }
    .page-title i { color: var(--category-color); font-size: 24px; }

    .coming-soon-card {
        background: var(--card-bg);
        border-radius: 20px;
        padding: 60px 40px;
        text-align: center;
        border: 1px solid var(--border-color);
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    }

    .coming-soon-icon {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--category-color), {{ $categoryColor ?? '#E91E63' }}cc);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 30px;
        font-size: 48px;
        color: white;
        box-shadow: 0 10px 40px var(--category-glow);
    }

    .coming-soon-title { font-size: 28px; font-weight: 800; color: var(--text-primary); margin: 0 0 15px 0; }
    .coming-soon-desc { font-size: 16px; color: var(--text-secondary); margin: 0 0 30px 0; max-width: 500px; margin-left: auto; margin-right: auto; line-height: 1.6; }

    .btn-back {
        padding: 14px 28px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        border: none;
        background: linear-gradient(135deg, var(--category-color), {{ $categoryColor ?? '#E91E63' }}cc);
        color: white;
    }

    .btn-back:hover { transform: translateY(-2px); box-shadow: 0 8px 20px var(--category-glow); }

    @media (max-width: 992px) { .category-panel { width: 100%; padding-left: 20px; padding-right: 20px; } }
</style>

<div class="category-panel">
    <div class="breadcrumb-nav">
        <a href="{{ route('admin.index') }}"><i class="fas fa-home"></i></a>
        <i class="fas fa-chevron-right"></i>
        <a href="{{ route('admin.' . $categorySlug . '.index') }}">{{ $categoryName }}</a>
        <i class="fas fa-chevron-right"></i>
        <span>{{ $pageTitle }}</span>
    </div>

    <div class="page-header">
        <h1 class="page-title"><i class="fas {{ $pageIcon }}"></i> {{ $pageTitle }}</h1>
    </div>

    <div class="coming-soon-card">
        <div class="coming-soon-icon"><i class="fas fa-rocket"></i></div>
        <h2 class="coming-soon-title">Coming Soon!</h2>
        <p class="coming-soon-desc">
            The <strong>{{ $pageTitle }}</strong> management page for <strong>{{ $categoryName }}</strong> is under development. 
            This feature will be available soon with full CRUD functionality, advanced filtering, and beautiful design.
        </p>
        <a href="{{ route('admin.' . $categorySlug . '.index') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> Back to {{ $categoryName }} Dashboard
        </a>
    </div>
</div>
