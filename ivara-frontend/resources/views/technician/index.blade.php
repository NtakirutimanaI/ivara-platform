@extends('layouts.app')

@section('title', 'Senior Technician Dashboard')

@push('styles')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
@endpush

@section('content')
<div class="tech-dashboard">
    {{-- Welcome Header --}}
    <div class="welcome-section">
        <div class="welcome-content">
            <div class="user-greeting">
                <div class="avatar-ring">
                    <div class="user-avatar">
                        <i class="fas fa-user-cog"></i>
                    </div>
                    <span class="status-ring"></span>
                </div>
                <div class="greeting-text">
                    <span class="time-greeting" id="timeGreeting">Good Morning</span>
                    <h1>{{ Auth::user()->name ?? 'Senior Technician' }}</h1>
                    <p class="role-tag"><i class="fas fa-shield-alt"></i> Senior Technician • Technical & Repair Division</p>
                </div>
            </div>
            <div class="header-widgets">
                <div class="widget clock-widget">
                    <i class="fas fa-clock"></i>
                    <div class="clock-content">
                        <span class="time" id="liveTime">{{ now()->format('H:i:s') }}</span>
                        <span class="date">{{ now()->format('l, F d, Y') }}</span>
                    </div>
                </div>
                <div class="widget status-widget online">
                    <span class="status-dot"></span>
                    <span>Online & Ready</span>
                </div>
                <button class="widget theme-toggle" id="themeToggle" title="Toggle Dark Mode">
                    <i class="fas fa-moon" id="themeIcon"></i>
                </button>
            </div>
        </div>
    </div>

    {{-- Performance Summary Cards --}}
    <div class="stats-row">
        <div class="stat-card gradient-indigo">
            <div class="stat-icon"><i class="fas fa-wrench"></i></div>
            <div class="stat-info">
                <span class="stat-value" id="statRepairs">47</span>
                <span class="stat-label">Repairs This Month</span>
                <div class="stat-change positive"><i class="fas fa-arrow-up"></i> 12% vs last month</div>
            </div>
            <div class="stat-chart-mini">
                <canvas id="miniRepairs"></canvas>
            </div>
        </div>
        <div class="stat-card gradient-emerald">
            <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
            <div class="stat-info">
                <span class="stat-value" id="statCompleted">42</span>
                <span class="stat-label">Jobs Completed</span>
                <div class="stat-change positive"><i class="fas fa-arrow-up"></i> 8% efficiency</div>
            </div>
            <div class="stat-chart-mini">
                <canvas id="miniCompleted"></canvas>
            </div>
        </div>
        <div class="stat-card gradient-amber">
            <div class="stat-icon"><i class="fas fa-hourglass-half"></i></div>
            <div class="stat-info">
                <span class="stat-value" id="statPending">5</span>
                <span class="stat-label">Pending Tasks</span>
                <div class="stat-change neutral"><i class="fas fa-minus"></i> Stable</div>
            </div>
            <div class="stat-chart-mini">
                <canvas id="miniPending"></canvas>
            </div>
        </div>
        <div class="stat-card gradient-rose">
            <div class="stat-icon"><i class="fas fa-star"></i></div>
            <div class="stat-info">
                <span class="stat-value" id="statRating">4.9</span>
                <span class="stat-label">Customer Rating</span>
                <div class="stat-change positive"><i class="fas fa-arrow-up"></i> Top 5%</div>
            </div>
            <div class="star-display">
                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
            </div>
        </div>
    </div>

    {{-- Main Dashboard Grid --}}
    <div class="dashboard-grid">
        {{-- Repair Analytics Chart --}}
        <div class="dash-card chart-large">
            <div class="card-header">
                <div class="header-title">
                    <i class="fas fa-chart-area"></i>
                    <h3>Repair Analytics</h3>
                </div>
                <div class="header-actions">
                    <select id="chartRange" class="range-select">
                        <option value="7">Last 7 Days</option>
                        <option value="30" selected>Last 30 Days</option>
                        <option value="90">Last 3 Months</option>
                    </select>
                </div>
            </div>
            <div class="chart-container" style="height: 280px;">
                <canvas id="repairAnalyticsChart"></canvas>
            </div>
        </div>

        {{-- Active Job Queue --}}
        <div class="dash-card job-queue">
            <div class="card-header">
                <div class="header-title">
                    <i class="fas fa-tasks"></i>
                    <h3>Active Job Queue</h3>
                </div>
                <a href="{{ route('technician.jobs.index') }}" class="view-all-link">View All <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="job-list" id="jobList">
                {{-- Jobs will be rendered here --}}
            </div>
        </div>

        {{-- Quick Navigation --}}
        <div class="dash-card quick-nav">
            <div class="card-header">
                <div class="header-title">
                    <i class="fas fa-th-large"></i>
                    <h3>Quick Navigation</h3>
                </div>
            </div>
            <div class="nav-grid">
                <a href="{{ route('technician.registerDevice') }}" class="nav-tile">
                    <div class="tile-icon blue"><i class="fas fa-plus-circle"></i></div>
                    <span>New Repair</span>
                </a>
                <a href="{{ route('technician.jobs.index') }}" class="nav-tile">
                    <div class="tile-icon emerald"><i class="fas fa-clipboard-list"></i></div>
                    <span>My Jobs</span>
                </a>
                <a href="{{ route('technician.work_orders.index') }}" class="nav-tile">
                    <div class="tile-icon violet"><i class="fas fa-file-alt"></i></div>
                    <span>Work Orders</span>
                </a>
                <a href="{{ route('technician.inventory.index') }}" class="nav-tile">
                    <div class="tile-icon amber"><i class="fas fa-boxes"></i></div>
                    <span>Inventory</span>
                </a>
                <a href="{{ route('technician.bookings.index') }}" class="nav-tile">
                    <div class="tile-icon cyan"><i class="fas fa-calendar-check"></i></div>
                    <span>Bookings</span>
                </a>
                <a href="{{ route('technician.schedule.index') }}" class="nav-tile">
                    <div class="tile-icon rose"><i class="fas fa-calendar-alt"></i></div>
                    <span>Schedule</span>
                </a>
                <a href="{{ route('technician.services.index') }}" class="nav-tile">
                    <div class="tile-icon green"><i class="fas fa-receipt"></i></div>
                    <span>Invoices</span>
                </a>
                <a href="{{ route('technician.support.index') }}" class="nav-tile">
                    <div class="tile-icon orange"><i class="fas fa-headset"></i></div>
                    <span>Support</span>
                </a>
            </div>
        </div>

        {{-- Today's Schedule --}}
        <div class="dash-card schedule-card">
            <div class="card-header">
                <div class="header-title">
                    <i class="fas fa-calendar-day"></i>
                    <h3>Today's Schedule</h3>
                </div>
                <a href="{{ route('technician.schedule.index') }}" class="view-all-link">Full Schedule <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="schedule-timeline" id="scheduleTimeline">
                {{-- Schedule will be rendered here --}}
            </div>
        </div>

        {{-- Repair Categories Chart --}}
        <div class="dash-card category-chart">
            <div class="card-header">
                <div class="header-title">
                    <i class="fas fa-chart-pie"></i>
                    <h3>Repair Categories</h3>
                </div>
            </div>
            <div class="donut-container">
                <canvas id="categoryDonut"></canvas>
            </div>
            <div class="category-legend" id="categoryLegend"></div>
        </div>

        {{-- Parts Inventory Status --}}
        <div class="dash-card inventory-status">
            <div class="card-header">
                <div class="header-title">
                    <i class="fas fa-box-open"></i>
                    <h3>Inventory Status</h3>
                </div>
                <a href="{{ route('technician.inventory.index') }}" class="view-all-link">Manage <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="inventory-bars" id="inventoryBars">
                {{-- Inventory bars will be rendered here --}}
            </div>
        </div>

        {{-- Weekly Performance Bar Chart --}}
        <div class="dash-card performance-chart">
            <div class="card-header">
                <div class="header-title">
                    <i class="fas fa-chart-bar"></i>
                    <h3>Weekly Performance</h3>
                </div>
            </div>
            <div class="chart-container" style="height: 200px;">
                <canvas id="weeklyPerfChart"></canvas>
            </div>
        </div>

        {{-- Recent Payments --}}
        <div class="dash-card payments-card">
            <div class="card-header">
                <div class="header-title">
                    <i class="fas fa-money-bill-wave"></i>
                    <h3>Recent Earnings</h3>
                </div>
                <a href="{{ route('technician.services.index') }}" class="view-all-link">View All <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="earnings-summary">
                <div class="earnings-total">
                    <span class="currency">RWF</span>
                    <span class="amount" id="totalEarnings">485,000</span>
                </div>
                <span class="earnings-period">This Month</span>
            </div>
            <div class="payments-list" id="paymentsList">
                {{-- Payments will be rendered here --}}
            </div>
        </div>

        {{-- Learning Progress --}}
        <div class="dash-card learning-card">
            <div class="card-header">
                <div class="header-title">
                    <i class="fas fa-graduation-cap"></i>
                    <h3>Learning & Development</h3>
                </div>
                <a href="{{ route('technician.e-learning') }}" class="view-all-link">Browse Courses <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="learning-content">
                <div class="current-course">
                    <div class="course-thumb">
                        <i class="fas fa-microchip"></i>
                    </div>
                    <div class="course-info">
                        <span class="course-label">CURRENT COURSE</span>
                        <h4>Advanced Micro-Soldering</h4>
                        <div class="progress-track">
                            <div class="progress-fill" id="courseProgress" style="width: 68%;"></div>
                        </div>
                        <span class="progress-text">68% Complete • 4 lessons left</span>
                    </div>
                </div>
                <div class="learning-stats">
                    <div class="learn-stat">
                        <span class="learn-val">12</span>
                        <span class="learn-label">Completed</span>
                    </div>
                    <div class="learn-stat">
                        <span class="learn-val">3</span>
                        <span class="learn-label">In Progress</span>
                    </div>
                    <div class="learn-stat">
                        <span class="learn-val">5</span>
                        <span class="learn-label">Certificates</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Community Network --}}
        <div class="dash-card community-card">
            <div class="card-header">
                <div class="header-title">
                    <i class="fas fa-users"></i>
                    <h3>Technician Network</h3>
                </div>
                <a href="{{ route('technician.connections') }}" class="view-all-link">Connect <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="community-content">
                <div class="network-stats">
                    <div class="net-stat">
                        <i class="fas fa-user-friends"></i>
                        <span class="net-val">1,247</span>
                        <span class="net-label">Network Members</span>
                    </div>
                    <div class="net-stat">
                        <i class="fas fa-comments"></i>
                        <span class="net-val">24</span>
                        <span class="net-label">Active Discussions</span>
                    </div>
                </div>
                <div class="recent-members">
                    <div class="member-avatars">
                        <div class="m-avatar" style="background: #6366f1;">JD</div>
                        <div class="m-avatar" style="background: #10b981;">AK</div>
                        <div class="m-avatar" style="background: #f59e0b;">MC</div>
                        <div class="m-avatar" style="background: #ec4899;">SL</div>
                        <div class="m-avatar more">+48</div>
                    </div>
                    <span class="members-label">Recently Active</span>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* ============================================
   SENIOR TECHNICIAN DASHBOARD - PROFESSIONAL UI
   Font: Inter | Design: Modern Glass
   ============================================ */

@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

:root {
    --bg: #f1f5f9;
    --surface: #ffffff;
    --surface-hover: #f8fafc;
    --text: #0f172a;
    --text-secondary: #475569;
    --text-muted: #94a3b8;
    --border: #e2e8f0;
    --primary: #6366f1;
    --primary-light: rgba(99, 102, 241, 0.1);
    --success: #10b981;
    --warning: #f59e0b;
    --danger: #ef4444;
    --info: #06b6d4;
    --shadow-sm: 0 1px 2px rgba(0,0,0,0.04);
    --shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -2px rgba(0,0,0,0.05);
    --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.08), 0 4px 6px -4px rgba(0,0,0,0.05);
    --radius: 16px;
    --radius-sm: 10px;
}

/* Dark Mode Variables */
body.dark-mode, [data-theme="dark"] {
    --bg: #0f172a;
    --surface: #1e293b;
    --surface-hover: #334155;
    --text: #f1f5f9;
    --text-secondary: #cbd5e1;
    --text-muted: #64748b;
    --border: #334155;
    --primary: #818cf8;
    --primary-light: rgba(129, 140, 248, 0.15);
    --shadow-sm: 0 1px 2px rgba(0,0,0,0.2);
    --shadow: 0 4px 6px -1px rgba(0,0,0,0.3), 0 2px 4px -2px rgba(0,0,0,0.2);
    --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.4), 0 4px 6px -4px rgba(0,0,0,0.3);
}

body.dark-mode .welcome-section,
[data-theme="dark"] .welcome-section {
    background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 50%, #9333ea 100%);
}

body.dark-mode .stat-card,
[data-theme="dark"] .stat-card {
    background: var(--surface);
}

body.dark-mode .job-item,
body.dark-mode .schedule-item,
body.dark-mode .nav-tile,
body.dark-mode .net-stat,
body.dark-mode .inv-bar,
body.dark-mode .payment-item,
[data-theme="dark"] .job-item,
[data-theme="dark"] .schedule-item,
[data-theme="dark"] .nav-tile,
[data-theme="dark"] .net-stat,
[data-theme="dark"] .inv-bar,
[data-theme="dark"] .payment-item {
    background: var(--surface-hover);
}

body.dark-mode .widget,
[data-theme="dark"] .widget {
    background: rgba(255,255,255,0.1);
    border-color: rgba(255,255,255,0.15);
}

body.dark-mode .range-select,
[data-theme="dark"] .range-select {
    background: var(--surface);
    border-color: var(--border);
    color: var(--text);
}

body.dark-mode .current-course,
[data-theme="dark"] .current-course {
    background: linear-gradient(135deg, rgba(139,92,246,0.2), rgba(168,85,247,0.2));
}

body.dark-mode .earnings-summary,
[data-theme="dark"] .earnings-summary {
    background: linear-gradient(135deg, rgba(16,185,129,0.15), rgba(34,197,94,0.15));
}

* { box-sizing: border-box; }
html, body { overflow-x: hidden; margin: 0; padding: 0; }

.tech-dashboard {
    font-family: 'Inter', sans-serif;
    background: var(--bg);
    min-height: 100vh;
    padding: 16px;
    margin: 0;
    width: 93%;
    margin-left: 20px;
}

/* Welcome Section */
.welcome-section {
    background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%);
    border-radius: var(--radius);
    padding: 28px 32px;
    margin-bottom: 24px;
    color: white;
    position: relative;
    overflow: hidden;
}
.welcome-section::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 60%;
    height: 200%;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
    pointer-events: none;
}
.welcome-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: relative;
    z-index: 1;
    flex-wrap: wrap;
    gap: 20px;
}
.user-greeting {
    display: flex;
    align-items: center;
    gap: 20px;
}
.avatar-ring {
    position: relative;
}
.user-avatar {
    width: 64px;
    height: 64px;
    background: rgba(255,255,255,0.2);
    border: 3px solid rgba(255,255,255,0.4);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}
.status-ring {
    position: absolute;
    bottom: 2px;
    right: 2px;
    width: 16px;
    height: 16px;
    background: #22c55e;
    border: 3px solid #6366f1;
    border-radius: 50%;
}
.time-greeting {
    font-size: 14px;
    opacity: 0.9;
    font-weight: 500;
}
.greeting-text h1 {
    font-size: 1.75rem;
    font-weight: 800;
    margin: 4px 0;
    letter-spacing: -0.5px;
}
.role-tag {
    font-size: 13px;
    opacity: 0.9;
    display: flex;
    align-items: center;
    gap: 6px;
}
.header-widgets {
    display: flex;
    align-items: center;
    gap: 16px;
}
.widget {
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: var(--radius-sm);
    padding: 12px 18px;
    display: flex;
    align-items: center;
    gap: 12px;
}
.clock-widget i {
    font-size: 1.2rem;
    opacity: 0.8;
}
.clock-content {
    display: flex;
    flex-direction: column;
}
.clock-content .time {
    font-size: 1.25rem;
    font-weight: 700;
}
.clock-content .date {
    font-size: 11px;
    opacity: 0.8;
}
.status-widget {
    font-size: 13px;
    font-weight: 600;
}
.status-dot {
    width: 10px;
    height: 10px;
    background: #22c55e;
    border-radius: 50%;
    animation: pulse 2s infinite;
}
@keyframes pulse {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.6; transform: scale(1.1); }
}

/* Theme Toggle Button */
.theme-toggle {
    cursor: pointer;
    border: none;
    padding: 12px 14px;
    font-size: 1.1rem;
    transition: transform 0.3s, background 0.3s;
}
.theme-toggle:hover {
    transform: scale(1.1);
    background: rgba(255,255,255,0.25);
}
.theme-toggle i {
    transition: transform 0.3s;
}
body.dark-mode .theme-toggle i {
    transform: rotate(180deg);
}

/* Stats Row */
.stats-row {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-bottom: 24px;
}
.stat-card {
    background: var(--surface);
    border-radius: var(--radius);
    padding: 20px;
    position: relative;
    overflow: hidden;
    box-shadow: var(--shadow);
    display: flex;
    align-items: center;
    gap: 16px;
    transition: transform 0.2s, box-shadow 0.2s;
}
.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-lg);
}
.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
}
.gradient-indigo::before { background: linear-gradient(180deg, #6366f1, #818cf8); }
.gradient-emerald::before { background: linear-gradient(180deg, #10b981, #34d399); }
.gradient-amber::before { background: linear-gradient(180deg, #f59e0b, #fbbf24); }
.gradient-rose::before { background: linear-gradient(180deg, #f43f5e, #fb7185); }

.stat-icon {
    width: 52px;
    height: 52px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.4rem;
    flex-shrink: 0;
}
.gradient-indigo .stat-icon { background: rgba(99,102,241,0.1); color: #6366f1; }
.gradient-emerald .stat-icon { background: rgba(16,185,129,0.1); color: #10b981; }
.gradient-amber .stat-icon { background: rgba(245,158,11,0.1); color: #f59e0b; }
.gradient-rose .stat-icon { background: rgba(244,63,94,0.1); color: #f43f5e; }

.stat-info { flex: 1; }
.stat-value {
    font-size: 1.75rem;
    font-weight: 800;
    color: var(--text);
    display: block;
}
.stat-label {
    font-size: 13px;
    color: var(--text-secondary);
    font-weight: 500;
}
.stat-change {
    font-size: 11px;
    font-weight: 600;
    margin-top: 4px;
    display: flex;
    align-items: center;
    gap: 4px;
}
.stat-change.positive { color: var(--success); }
.stat-change.negative { color: var(--danger); }
.stat-change.neutral { color: var(--text-muted); }

.stat-chart-mini {
    width: 60px;
    height: 30px;
}
.star-display {
    color: #fbbf24;
    font-size: 12px;
}

/* Dashboard Grid */
.dashboard-grid {
    display: grid;
    grid-template-columns: repeat(12, 1fr);
    gap: 20px;
}
.dash-card {
    background: var(--surface);
    border-radius: var(--radius);
    padding: 20px;
    box-shadow: var(--shadow);
    transition: box-shadow 0.2s;
}
.dash-card:hover {
    box-shadow: var(--shadow-lg);
}
.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
}
.header-title {
    display: flex;
    align-items: center;
    gap: 10px;
}
.header-title i {
    color: var(--primary);
    font-size: 1rem;
}
.header-title h3 {
    font-size: 15px;
    font-weight: 700;
    color: var(--text);
    margin: 0;
}
.view-all-link {
    font-size: 12px;
    font-weight: 600;
    color: var(--primary);
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 4px;
}
.view-all-link:hover { text-decoration: underline; }
.range-select {
    padding: 6px 12px;
    border-radius: 8px;
    border: 1px solid var(--border);
    background: var(--surface);
    color: var(--text);
    font-size: 12px;
    font-weight: 500;
    cursor: pointer;
}

/* Chart Large */
.chart-large { grid-column: span 8; }
.chart-container { position: relative; }

/* Job Queue */
.job-queue { grid-column: span 4; }
.job-list { display: flex; flex-direction: column; gap: 12px; max-height: 320px; overflow-y: auto; }
.job-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px;
    background: var(--bg);
    border-radius: var(--radius-sm);
    border-left: 4px solid var(--primary);
    transition: all 0.2s;
}
.job-item:hover { background: var(--primary-light); }
.job-item.urgent { border-left-color: var(--danger); }
.job-item.high { border-left-color: var(--warning); }
.job-priority {
    padding: 3px 8px;
    border-radius: 6px;
    font-size: 10px;
    font-weight: 700;
    text-transform: uppercase;
}
.job-priority.urgent { background: rgba(239,68,68,0.1); color: #dc2626; }
.job-priority.high { background: rgba(245,158,11,0.1); color: #d97706; }
.job-priority.normal { background: rgba(99,102,241,0.1); color: #6366f1; }
.job-content { flex: 1; }
.job-title { font-size: 13px; font-weight: 600; color: var(--text); }
.job-subtitle { font-size: 11px; color: var(--text-muted); margin-top: 2px; }
.job-meta { display: flex; gap: 10px; font-size: 10px; color: var(--text-muted); margin-top: 4px; }
.job-action {
    padding: 8px 14px;
    background: var(--primary);
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 11px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s;
}
.job-action:hover { background: #5558e3; }

/* Quick Navigation */
.quick-nav { grid-column: span 4; }
.nav-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 10px;
}
.nav-tile {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    padding: 16px 8px;
    background: var(--bg);
    border-radius: var(--radius-sm);
    text-decoration: none;
    transition: all 0.2s;
}
.nav-tile:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow);
}
.tile-icon {
    width: 42px;
    height: 42px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
}
.tile-icon.blue { background: rgba(59,130,246,0.1); color: #3b82f6; }
.tile-icon.emerald { background: rgba(16,185,129,0.1); color: #10b981; }
.tile-icon.violet { background: rgba(139,92,246,0.1); color: #8b5cf6; }
.tile-icon.amber { background: rgba(245,158,11,0.1); color: #f59e0b; }
.tile-icon.cyan { background: rgba(6,182,212,0.1); color: #06b6d4; }
.tile-icon.rose { background: rgba(244,63,94,0.1); color: #f43f5e; }
.tile-icon.green { background: rgba(34,197,94,0.1); color: #22c55e; }
.tile-icon.orange { background: rgba(249,115,22,0.1); color: #f97316; }
.nav-tile span {
    font-size: 11px;
    font-weight: 600;
    color: var(--text-secondary);
    text-align: center;
}

/* Schedule Card */
.schedule-card { grid-column: span 4; }
.schedule-timeline { display: flex; flex-direction: column; gap: 12px; }
.schedule-item {
    display: flex;
    gap: 14px;
    padding: 12px;
    background: var(--bg);
    border-radius: var(--radius-sm);
}
.schedule-item.current {
    background: var(--primary-light);
    border: 1px solid rgba(99,102,241,0.2);
}
.sched-time {
    min-width: 50px;
    text-align: center;
}
.sched-time .hour { font-size: 14px; font-weight: 700; color: var(--text); display: block; }
.sched-time .period { font-size: 10px; color: var(--text-muted); }
.sched-divider {
    width: 3px;
    background: var(--border);
    border-radius: 2px;
    position: relative;
}
.sched-divider::before {
    content: '';
    position: absolute;
    top: 0;
    left: -3px;
    width: 9px;
    height: 9px;
    background: var(--primary);
    border-radius: 50%;
}
.schedule-item.current .sched-divider::before { box-shadow: 0 0 0 4px rgba(99,102,241,0.2); }
.sched-content { flex: 1; }
.sched-type { font-size: 10px; font-weight: 700; color: var(--primary); text-transform: uppercase; }
.sched-title { font-size: 13px; font-weight: 600; color: var(--text); margin: 2px 0; }
.sched-location { font-size: 11px; color: var(--text-muted); }

/* Category Chart */
.category-chart { grid-column: span 4; }
.donut-container { height: 160px; display: flex; justify-content: center; }
.category-legend {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    justify-content: center;
    margin-top: 12px;
}
.legend-item {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 11px;
    color: var(--text-secondary);
}
.legend-dot {
    width: 10px;
    height: 10px;
    border-radius: 3px;
}

/* Inventory Status */
.inventory-status { grid-column: span 4; }
.inventory-bars { display: flex; flex-direction: column; gap: 14px; }
.inv-item { display: flex; flex-direction: column; gap: 6px; }
.inv-header { display: flex; justify-content: space-between; align-items: center; }
.inv-name { font-size: 12px; font-weight: 600; color: var(--text); }
.inv-qty { font-size: 11px; font-weight: 600; }
.inv-qty.critical { color: var(--danger); }
.inv-qty.low { color: var(--warning); }
.inv-qty.ok { color: var(--success); }
.inv-bar {
    height: 8px;
    background: var(--bg);
    border-radius: 4px;
    overflow: hidden;
}
.inv-fill {
    height: 100%;
    border-radius: 4px;
    transition: width 0.5s;
}
.inv-fill.critical { background: linear-gradient(90deg, #ef4444, #f87171); }
.inv-fill.low { background: linear-gradient(90deg, #f59e0b, #fbbf24); }
.inv-fill.ok { background: linear-gradient(90deg, #10b981, #34d399); }

/* Performance Chart */
.performance-chart { grid-column: span 4; }

/* Payments Card */
.payments-card { grid-column: span 4; }
.earnings-summary {
    text-align: center;
    padding: 16px;
    background: linear-gradient(135deg, rgba(16,185,129,0.1), rgba(34,197,94,0.1));
    border-radius: var(--radius-sm);
    margin-bottom: 16px;
}
.earnings-total { display: flex; align-items: baseline; justify-content: center; gap: 4px; }
.currency { font-size: 14px; color: var(--success); font-weight: 600; }
.amount { font-size: 1.75rem; font-weight: 800; color: var(--success); }
.earnings-period { font-size: 12px; color: var(--text-muted); }
.payments-list { display: flex; flex-direction: column; gap: 10px; }
.payment-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    background: var(--bg);
    border-radius: 8px;
}
.payment-info { display: flex; flex-direction: column; }
.payment-client { font-size: 12px; font-weight: 600; color: var(--text); }
.payment-service { font-size: 10px; color: var(--text-muted); }
.payment-amount { font-size: 13px; font-weight: 700; color: var(--success); }

/* Learning Card */
.learning-card { grid-column: span 4; }
.current-course {
    display: flex;
    gap: 14px;
    padding: 14px;
    background: linear-gradient(135deg, rgba(139,92,246,0.1), rgba(168,85,247,0.1));
    border-radius: var(--radius-sm);
    margin-bottom: 16px;
}
.course-thumb {
    width: 48px;
    height: 48px;
    background: #8b5cf6;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
}
.course-info { flex: 1; }
.course-label { font-size: 9px; font-weight: 700; color: #8b5cf6; text-transform: uppercase; letter-spacing: 0.5px; }
.course-info h4 { font-size: 13px; font-weight: 600; color: var(--text); margin: 4px 0; }
.progress-track {
    height: 6px;
    background: rgba(139,92,246,0.2);
    border-radius: 3px;
    overflow: hidden;
    margin: 8px 0 4px;
}
.progress-fill { height: 100%; background: linear-gradient(90deg, #8b5cf6, #a78bfa); border-radius: 3px; }
.progress-text { font-size: 10px; color: var(--text-muted); }
.learning-stats {
    display: flex;
    justify-content: space-around;
    text-align: center;
}
.learn-stat { display: flex; flex-direction: column; gap: 2px; }
.learn-val { font-size: 1.25rem; font-weight: 800; color: var(--text); }
.learn-label { font-size: 10px; color: var(--text-muted); }

/* Community Card */
.community-card { grid-column: span 4; }
.network-stats {
    display: flex;
    gap: 20px;
    margin-bottom: 16px;
}
.net-stat {
    flex: 1;
    text-align: center;
    padding: 14px;
    background: var(--bg);
    border-radius: var(--radius-sm);
}
.net-stat i { font-size: 1.2rem; color: var(--primary); margin-bottom: 6px; }
.net-val { display: block; font-size: 1.25rem; font-weight: 800; color: var(--text); }
.net-label { font-size: 10px; color: var(--text-muted); }
.recent-members { text-align: center; }
.member-avatars { display: flex; justify-content: center; margin-bottom: 8px; }
.m-avatar {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 11px;
    font-weight: 700;
    color: white;
    border: 2px solid white;
    margin-left: -8px;
}
.m-avatar:first-child { margin-left: 0; }
.m-avatar.more { background: var(--text-muted); font-size: 10px; }
.members-label { font-size: 11px; color: var(--text-muted); }

/* Responsive */
@media (max-width: 1200px) {
    .stats-row { grid-template-columns: repeat(2, 1fr); }
    .dashboard-grid { grid-template-columns: repeat(6, 1fr); }
    .chart-large { grid-column: span 6; }
    .dash-card { grid-column: span 3; }
    .quick-nav { grid-column: span 6; }
}
@media (max-width: 768px) {
    .tech-dashboard { padding: 16px; }
    .stats-row { grid-template-columns: 1fr; }
    .dashboard-grid { grid-template-columns: 1fr; }
    .dash-card { grid-column: span 1 !important; }
    .welcome-content { flex-direction: column; text-align: center; }
    .user-greeting { flex-direction: column; }
    .header-widgets { flex-direction: column; width: 100%; }
    .nav-grid { grid-template-columns: repeat(4, 1fr); }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Dark Mode Toggle
    const themeToggle = document.getElementById('themeToggle');
    const themeIcon = document.getElementById('themeIcon');
    const body = document.body;

    // Check for saved theme preference or default to light
    const savedTheme = localStorage.getItem('techDashboardTheme');
    if (savedTheme === 'dark') {
        body.classList.add('dark-mode');
        themeIcon.classList.remove('fa-moon');
        themeIcon.classList.add('fa-sun');
    }

    // Toggle dark mode on button click
    themeToggle.addEventListener('click', function() {
        body.classList.toggle('dark-mode');
        const isDark = body.classList.contains('dark-mode');
        
        // Update icon
        if (isDark) {
            themeIcon.classList.remove('fa-moon');
            themeIcon.classList.add('fa-sun');
            localStorage.setItem('techDashboardTheme', 'dark');
        } else {
            themeIcon.classList.remove('fa-sun');
            themeIcon.classList.add('fa-moon');
            localStorage.setItem('techDashboardTheme', 'light');
        }
    });

    // Update time greeting
    const hour = new Date().getHours();
    let greeting = 'Good Morning';
    if (hour >= 12 && hour < 17) greeting = 'Good Afternoon';
    else if (hour >= 17) greeting = 'Good Evening';
    document.getElementById('timeGreeting').textContent = greeting;

    // Live clock
    setInterval(() => {
        const now = new Date();
        document.getElementById('liveTime').textContent = now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false });
    }, 1000);

    // Seed data
    const dashboardData = {
        jobs: [
            { id: 1, title: 'iPhone 14 Pro Max', subtitle: 'Screen replacement - OLED', priority: 'urgent', client: 'John Doe', time: '45min ago' },
            { id: 2, title: 'Samsung Galaxy S23', subtitle: 'Battery swap + diagnostics', priority: 'high', client: 'Alice Kim', time: '2h ago' },
            { id: 3, title: 'MacBook Pro 16"', subtitle: 'Thermal repaste + cleaning', priority: 'normal', client: 'Mark Chen', time: 'Yesterday' },
            { id: 4, title: 'iPad Air 5th Gen', subtitle: 'Cracked glass digitizer', priority: 'normal', client: 'Sarah Lee', time: '2 days ago' }
        ],
        schedule: [
            { time: '09:00', period: 'AM', type: 'Site Visit', title: 'Corporate IT Maintenance', location: 'Kigali Heights, Floor 12', current: true },
            { time: '11:30', period: 'AM', type: 'Remote Support', title: 'VPN Router Troubleshoot', location: 'Video Conference', current: false },
            { time: '14:00', period: 'PM', type: 'Workshop', title: 'Laptop Screen Install', location: 'Main Workshop', current: false },
            { time: '16:30', period: 'PM', type: 'Client Pickup', title: 'Device Delivery', location: 'Client Office - Nyarugenge', current: false }
        ],
        inventory: [
            { name: 'iPhone 14 Pro OLED Display', qty: 3, max: 20, status: 'critical' },
            { name: 'Samsung S23 Battery OEM', qty: 8, max: 20, status: 'low' },
            { name: 'Thermal Paste Arctic MX-5', qty: 15, max: 20, status: 'ok' },
            { name: 'USB-C Charging Ports', qty: 28, max: 30, status: 'ok' }
        ],
        payments: [
            { client: 'Sarah Johnson', service: 'Screen Replacement', amount: 75000 },
            { client: 'Tech Solutions Ltd', service: 'Bulk Maintenance', amount: 280000 },
            { client: 'Paul Mugabo', service: 'Battery + Diagnostics', amount: 45000 }
        ],
        categories: { 'Phones': 45, 'Laptops': 25, 'Tablets': 15, 'Other': 15 },
        weeklyPerf: [4, 7, 5, 9, 8, 6, 3],
        monthlyTrend: [32, 28, 35, 42, 38, 45, 47]
    };

    // Render Jobs
    document.getElementById('jobList').innerHTML = dashboardData.jobs.map(job => `
        <div class="job-item ${job.priority}">
            <span class="job-priority ${job.priority}">${job.priority}</span>
            <div class="job-content">
                <div class="job-title">${job.title}</div>
                <div class="job-subtitle">${job.subtitle}</div>
                <div class="job-meta">
                    <span><i class="fas fa-user"></i> ${job.client}</span>
                    <span><i class="fas fa-clock"></i> ${job.time}</span>
                </div>
            </div>
            <button class="job-action">Start</button>
        </div>
    `).join('');

    // Render Schedule
    document.getElementById('scheduleTimeline').innerHTML = dashboardData.schedule.map(s => `
        <div class="schedule-item ${s.current ? 'current' : ''}">
            <div class="sched-time">
                <span class="hour">${s.time}</span>
                <span class="period">${s.period}</span>
            </div>
            <div class="sched-divider"></div>
            <div class="sched-content">
                <div class="sched-type">${s.type}</div>
                <div class="sched-title">${s.title}</div>
                <div class="sched-location"><i class="fas fa-map-marker-alt"></i> ${s.location}</div>
            </div>
        </div>
    `).join('');

    // Render Inventory
    document.getElementById('inventoryBars').innerHTML = dashboardData.inventory.map(inv => `
        <div class="inv-item">
            <div class="inv-header">
                <span class="inv-name">${inv.name}</span>
                <span class="inv-qty ${inv.status}">${inv.qty} units</span>
            </div>
            <div class="inv-bar">
                <div class="inv-fill ${inv.status}" style="width: ${(inv.qty / inv.max) * 100}%"></div>
            </div>
        </div>
    `).join('');

    // Render Payments
    document.getElementById('paymentsList').innerHTML = dashboardData.payments.map(p => `
        <div class="payment-item">
            <div class="payment-info">
                <span class="payment-client">${p.client}</span>
                <span class="payment-service">${p.service}</span>
            </div>
            <span class="payment-amount">+RWF ${p.amount.toLocaleString()}</span>
        </div>
    `).join('');

    // Charts
    const chartColors = {
        primary: '#6366f1',
        success: '#10b981',
        warning: '#f59e0b',
        danger: '#ef4444',
        info: '#06b6d4'
    };

    // Repair Analytics Chart
    new Chart(document.getElementById('repairAnalyticsChart'), {
        type: 'line',
        data: {
            labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5', 'Week 6', 'Week 7'],
            datasets: [{
                label: 'Repairs Completed',
                data: dashboardData.monthlyTrend,
                borderColor: chartColors.primary,
                backgroundColor: 'rgba(99,102,241,0.1)',
                fill: true,
                tension: 0.4,
                pointRadius: 4,
                pointBackgroundColor: chartColors.primary
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                x: { grid: { display: false }, ticks: { font: { size: 11 } } },
                y: { grid: { color: 'rgba(0,0,0,0.04)' }, ticks: { font: { size: 11 } } }
            }
        }
    });

    // Category Donut
    const catColors = [chartColors.primary, chartColors.success, chartColors.warning, chartColors.info];
    new Chart(document.getElementById('categoryDonut'), {
        type: 'doughnut',
        data: {
            labels: Object.keys(dashboardData.categories),
            datasets: [{
                data: Object.values(dashboardData.categories),
                backgroundColor: catColors,
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: { legend: { display: false } }
        }
    });
    document.getElementById('categoryLegend').innerHTML = Object.entries(dashboardData.categories).map((c, i) => `
        <div class="legend-item">
            <span class="legend-dot" style="background: ${catColors[i]}"></span>
            ${c[0]}: ${c[1]}%
        </div>
    `).join('');

    // Weekly Performance Chart
    new Chart(document.getElementById('weeklyPerfChart'), {
        type: 'bar',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                label: 'Jobs',
                data: dashboardData.weeklyPerf,
                backgroundColor: chartColors.primary,
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                x: { grid: { display: false }, ticks: { font: { size: 10 } } },
                y: { grid: { color: 'rgba(0,0,0,0.04)' }, ticks: { font: { size: 10 } } }
            }
        }
    });

    // Mini sparklines
    const miniChartConfig = (data, color) => ({
        type: 'line',
        data: {
            labels: ['', '', '', '', '', '', ''],
            datasets: [{
                data: data,
                borderColor: color,
                borderWidth: 2,
                fill: false,
                tension: 0.4,
                pointRadius: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: { x: { display: false }, y: { display: false } }
        }
    });
    new Chart(document.getElementById('miniRepairs'), miniChartConfig([5, 7, 6, 8, 7, 9, 8], chartColors.primary));
    new Chart(document.getElementById('miniCompleted'), miniChartConfig([4, 6, 5, 7, 8, 7, 9], chartColors.success));
    new Chart(document.getElementById('miniPending'), miniChartConfig([6, 5, 7, 4, 5, 6, 5], chartColors.warning));
});
</script>
@endsection
