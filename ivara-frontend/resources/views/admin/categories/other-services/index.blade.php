@include('layouts.header')
@include('layouts.sidebar')

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    :root {
        --slate-main: #334155;
        --slate-light: #475569;
        --slate-dim: #94A3B8;
        --bg-neutral: #F1F5F9;
        --card-bg: #FFFFFF;
        --text-main: #1E293B;
        --accent: #64748B;
    }

    .other-dashboard {
        background: var(--bg-neutral);
        color: var(--text-main);
        min-height: 100vh;
        padding: 40px;
        padding-left: 280px; /* Sidebar offset */
        font-family: 'Inter', sans-serif;
    }

    .other-header {
        background: white;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        margin-bottom: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-left: 6px solid var(--slate-main);
    }

    .header-title h1 {
        font-size: 2rem;
        font-weight: 800;
        color: var(--slate-main);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .header-title p {
        color: var(--slate-dim);
        margin-top: 5px;
        font-size: 0.95rem;
    }

    .stats-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: white;
        padding: 20px;
        border-radius: 12px;
        border: 1px solid #E2E8F0;
        display: flex;
        align-items: center;
        gap: 15px;
        transition: all 0.3s;
    }

    .stat-card:hover {
        border-color: var(--slate-main);
        transform: translateY(-2px);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        background: var(--bg-neutral);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        color: var(--slate-main);
    }

    .stat-info .stat-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--slate-main);
        display: block;
    }

    .stat-info .stat-label {
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--slate-dim);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .grid-layout {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 25px;
    }

    .panel {
        background: white;
        border-radius: 15px;
        padding: 25px;
        border: 1px solid #E2E8F0;
    }

    .panel-title {
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 1px solid #F1F5F9;
        display: flex;
        align-items: center;
        gap: 10px;
        color: var(--slate-main);
    }

    .action-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
        gap: 15px;
    }

    .action-btn {
        background: var(--bg-neutral);
        border: 1px solid #E2E8F0;
        padding: 20px 10px;
        border-radius: 10px;
        text-align: center;
        text-decoration: none;
        color: var(--slate-main);
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.2s;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }

    .action-btn i { font-size: 1.5rem; }

    .action-btn:hover {
        background: var(--slate-main);
        color: white;
        border-color: var(--slate-main);
    }

    .empty-msg {
        text-align: center;
        padding: 50px 0;
        color: var(--slate-dim);
    }

    .empty-msg i { font-size: 3rem; margin-bottom: 15px; display: block; }

    .btn-main {
        background: var(--slate-main);
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        transition: opacity 0.3s;
    }

    .btn-main:hover { opacity: 0.9; }

    @media (max-width: 1000px) {
        .other-dashboard { padding-left: 20px; }
        .grid-layout { grid-template-columns: 1fr; }
    }
</style>

<div class="other-dashboard">
    <div class="other-header">
        <div class="header-title">
            <h1><i class="fas fa-th-large"></i> Other Services Admin</h1>
            <p>General Management & Miscellaneous Support Services</p>
        </div>
        <div class="header-actions">
            <a href="#" class="btn-main"><i class="fas fa-plus me-2"></i> Create New Entry</a>
        </div>
    </div>

    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-tasks"></i></div>
            <div class="stat-info">
                <span class="stat-value">284</span>
                <span class="stat-label">Total Services</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
            <div class="stat-info">
                <span class="stat-value">1,052</span>
                <span class="stat-label">Completed</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-clock"></i></div>
            <div class="stat-info">
                <span class="stat-value">14</span>
                <span class="stat-label">Pending</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-star"></i></div>
            <div class="stat-info">
                <span class="stat-value">4.8</span>
                <span class="stat-label">SLA Rating</span>
            </div>
        </div>
    </div>

    <div class="grid-layout">
        <div class="panel">
            <h3 class="panel-title"><i class="fas fa-rocket"></i> Quick Operations</h3>
            <div class="action-grid">
                <a href="#" class="action-btn"><i class="fas fa-cog"></i> <span>Settings</span></a>
                <a href="#" class="action-btn"><i class="fas fa-users"></i> <span>Clients</span></a>
                <a href="#" class="action-btn"><i class="fas fa-chart-line"></i> <span>Reports</span></a>
                <a href="#" class="action-btn"><i class="fas fa-wallet"></i> <span>Billing</span></a>
                <a href="#" class="action-btn"><i class="fas fa-shield-alt"></i> <span>Compliance</span></a>
                <a href="#" class="action-btn"><i class="fas fa-envelope"></i> <span>Support</span></a>
            </div>
        </div>

        <div class="panel">
            <h3 class="panel-title"><i class="fas fa-bell"></i> Alerts</h3>
            <div class="empty-msg">
                <i class="fas fa-bell-slash"></i>
                <p>No active alerts at the moment.</p>
            </div>
        </div>
    </div>
</div>
