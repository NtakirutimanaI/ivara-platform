@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
    :root {
        --cinema-red: #E50914;
        --cinema-gold: #D4AF37;
        --dark-bg: #141414;
        --card-bg: #1f1f1f;
        --text-main: #ffffff;
        --text-dim: rgba(255,255,255,0.7);
    }

    .media-dashboard {
        background: var(--dark-bg);
        color: var(--text-main);
        min-height: 100vh;
        padding: 40px;
        font-family: 'Inter', sans-serif;
    }

    .media-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 40px;
        border-bottom: 2px solid var(--cinema-red);
        padding-bottom: 20px;
    }

    .header-title h1 {
        font-family: 'Cinzel', serif;
        font-size: 2.5rem;
        font-weight: 700;
        letter-spacing: 2px;
        color: var(--cinema-gold);
        margin: 0;
    }

    .header-title p {
        color: var(--text-dim);
        margin-top: 5px;
        text-transform: uppercase;
        font-size: 0.9rem;
        letter-spacing: 1px;
    }

    .stats-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 25px;
        margin-bottom: 40px;
    }

    .stat-card {
        background: var(--card-bg);
        border-radius: 12px;
        padding: 25px;
        border: 1px solid rgba(255,255,255,0.05);
        transition: transform 0.3s ease, border-color 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        border-color: var(--cinema-red);
    }

    .stat-card::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0; width: 100%; height: 3px;
        background: var(--cinema-red);
        opacity: 0.3;
    }

    .stat-icon {
        font-size: 2rem;
        color: var(--cinema-red);
        margin-bottom: 15px;
    }

    .stat-value {
        font-size: 2.2rem;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .stat-label {
        color: var(--text-dim);
        font-size: 0.85rem;
        text-transform: uppercase;
        font-weight: 600;
    }

    .content-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 30px;
    }

    .main-panel, .side-panel {
        background: var(--card-bg);
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
    }

    .panel-title {
        font-family: 'Cinzel', serif;
        font-size: 1.4rem;
        margin-bottom: 25px;
        color: var(--cinema-gold);
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .featured-content {
        aspect-ratio: 16/9;
        background: linear-gradient(to top, rgba(0,0,0,0.8), transparent), url('https://images.unsplash.com/photo-1485846234645-a62644f84728?auto=format&fit=crop&q=80&w=1000');
        background-size: cover;
        background-position: center;
        border-radius: 10px;
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 30px;
        margin-bottom: 30px;
        cursor: pointer;
    }

    .featured-label {
        background: var(--cinema-red);
        color: white;
        padding: 5px 12px;
        border-radius: 4px;
        font-size: 0.8rem;
        font-weight: 700;
        width: fit-content;
        margin-bottom: 10px;
    }

    .featured-name {
        font-size: 1.8rem;
        font-weight: 800;
    }

    .production-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .production-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 15px;
        background: rgba(255,255,255,0.03);
        border-radius: 8px;
        transition: background 0.3s;
    }

    .production-item:hover {
        background: rgba(255,255,255,0.08);
    }

    .prod-thumb {
        width: 100px;
        height: 60px;
        background: #333;
        border-radius: 4px;
        background-size: cover;
        background-position: center;
    }

    .prod-info h5 { margin: 0; font-size: 1rem; }
    .prod-info p { margin: 0; color: var(--text-dim); font-size: 0.8rem; }

    .btn-cinema {
        padding: 10px 20px;
        background: var(--cinema-red);
        color: white;
        border: none;
        border-radius: 5px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        cursor: pointer;
        transition: background 0.3s;
    }

    .btn-cinema:hover {
        background: #b20710;
    }
</style>

<div class="media-dashboard">
    <div class="media-header">
        <div class="header-title">
            <h1><i class="fas fa-film me-3"></i>Media & Entertainment Admin</h1>
            <p>Production, Distribution & Talent Management</p>
        </div>
        <div class="header-actions">
            <button class="btn-cinema"><i class="fas fa-video me-2"></i> New Project</button>
        </div>
    </div>

    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-ticket-alt"></i></div>
            <div class="stat-value">2.4M</div>
            <div class="stat-label">Total Views</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-users"></i></div>
            <div class="stat-value">12.5k</div>
            <div class="stat-label">Active Creators</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-clapperboard"></i></div>
            <div class="stat-value">48</div>
            <div class="stat-label">Live Productions</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-star"></i></div>
            <div class="stat-value">4.9</div>
            <div class="stat-label">Avg Rating</div>
        </div>
    </div>

    <div class="content-grid">
        <div class="main-panel">
            <h3 class="panel-title"><i class="fas fa-play-circle"></i> Trending Performance</h3>
            <div class="featured-content">
                <span class="featured-label">TRENDING NOW</span>
                <h4 class="featured-name">Ivara Music Awards 2026</h4>
            </div>
            
            <div class="production-list">
                <div class="production-item">
                    <div class="prod-thumb" style="background-image: url('https://images.unsplash.com/photo-1598899134739-24c46f58b8c0?auto=format&fit=crop&q=80&w=200')"></div>
                    <div class="prod-info">
                        <h5>Film Production #102</h5>
                        <p>Status: Post-Production | Release: Feb 2026</p>
                    </div>
                </div>
                <div class="production-item">
                    <div class="prod-thumb" style="background-image: url('https://images.unsplash.com/photo-1493225255756-d9584f8606e9?auto=format&fit=crop&q=80&w=200')"></div>
                    <div class="prod-info">
                        <h5>Podcast: Global Tech Trends</h5>
                        <p>Status: Live | Listeners: 50k</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="side-panel">
            <h3 class="panel-title"><i class="fas fa-bullhorn"></i> Global Ads</h3>
            <div class="stat-card" style="background: rgba(229, 9, 20, 0.1); border-color: var(--cinema-red); margin-bottom: 20px;">
                <p class="text-dim small mb-2">AD REVENUE THIS MONTH</p>
                <div class="stat-value" style="font-size: 1.8rem; color: var(--cinema-red);">$124,500</div>
            </div>
            
            <h3 class="panel-title" style="margin-top: 30px;"><i class="fas fa-calendar-day"></i> Schedule</h3>
            <div style="font-size: 0.9rem;">
                <div class="mb-3">
                    <p class="mb-1 text-cinema-gold">TODAY @ 14:00</p>
                    <p>Production Meeting - Studio A</p>
                </div>
                <div class="mb-3">
                    <p class="mb-1 text-cinema-gold">TODAY @ 16:30</p>
                    <p>Casting Call: 'The Rwandan Dream'</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
