@extends('layouts.app')

@section('content')
<style>
    :root {
        --audit-alert: #ef4444;
        --audit-warning: #f59e0b;
        --audit-info: #3b82f6;
        --audit-success: #10b981;
        --glass-bg: rgba(255, 255, 255, 0.95);
        --glass-border: rgba(0, 0, 0, 0.08);
        --card-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05);
    }

    [data-theme="dark"] {
        --glass-bg: rgba(17, 24, 39, 0.8);
        --glass-border: rgba(255, 255, 255, 0.08);
        --text-main: #f8fafc;
        --text-muted: #9ca3af;
    }

    .audit-wrapper {
        padding: 40px 30px;
        animation: fadeIn 0.8s ease-out;
    }

    @keyframes fadeIn { 
        from { opacity: 0; transform: translateY(10px); } 
        to { opacity: 1; transform: translateY(0); } 
    }

    .audit-header {
        margin-bottom: 40px;
    }

    .audit-header h1 {
        font-size: 2.2rem;
        font-weight: 800;
        margin: 0;
        color: var(--text-main);
    }

    .audit-header p {
        color: var(--text-muted);
        font-weight: 500;
        margin-top: 8px;
    }

    .audit-filters {
        display: flex;
        gap: 12px;
        margin-bottom: 30px;
        flex-wrap: wrap;
    }

    .filter-btn {
        padding: 10px 20px;
        border-radius: 12px;
        border: 1px solid var(--glass-border);
        background: var(--glass-bg);
        color: var(--text-main);
        font-weight: 700;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }

    .filter-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .filter-btn.active {
        background: linear-gradient(135deg, #4F46E5 0%, #4338ca 100%);
        color: #fff;
        border-color: transparent;
    }

    .audit-log-container {
        background: var(--glass-bg);
        border: 1px solid var(--glass-border);
        border-radius: 24px;
        padding: 30px;
        box-shadow: var(--card-shadow);
        backdrop-filter: blur(20px);
    }

    .log-entry {
        padding: 20px;
        margin-bottom: 12px;
        border-radius: 16px;
        border: 1px solid var(--glass-border);
        background: rgba(0, 0, 0, 0.02);
        transition: all 0.3s ease;
        display: flex;
        align-items: flex-start;
        gap: 16px;
    }

    [data-theme="dark"] .log-entry {
        background: rgba(255, 255, 255, 0.02);
    }

    .log-entry:hover {
        transform: translateX(8px);
        background: rgba(79, 70, 229, 0.04);
        border-color: rgba(79, 70, 229, 0.2);
    }

    .log-entry:last-child {
        margin-bottom: 0;
    }

    .log-icon {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    .log-icon.alert {
        background: rgba(239, 68, 68, 0.1);
        color: var(--audit-alert);
    }

    .log-icon.warning {
        background: rgba(245, 158, 11, 0.1);
        color: var(--audit-warning);
    }

    .log-icon.info {
        background: rgba(59, 130, 246, 0.1);
        color: var(--audit-info);
    }

    .log-icon.success {
        background: rgba(16, 185, 129, 0.1);
        color: var(--audit-success);
    }

    .log-content {
        flex: 1;
    }

    .log-badge {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 0.7rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 6px;
    }

    .log-badge.alert {
        background: rgba(239, 68, 68, 0.15);
        color: var(--audit-alert);
    }

    .log-badge.warning {
        background: rgba(245, 158, 11, 0.15);
        color: var(--audit-warning);
    }

    .log-badge.info {
        background: rgba(59, 130, 246, 0.15);
        color: var(--audit-info);
    }

    .log-badge.success {
        background: rgba(16, 185, 129, 0.15);
        color: var(--audit-success);
    }

    .log-time {
        font-size: 0.75rem;
        color: var(--text-muted);
        font-weight: 600;
        margin-bottom: 4px;
    }

    .log-message {
        color: var(--text-main);
        font-weight: 500;
        font-size: 0.95rem;
        line-height: 1.5;
    }

    .log-meta {
        display: flex;
        gap: 16px;
        margin-top: 8px;
        font-size: 0.75rem;
        color: var(--text-muted);
    }

    .log-meta span {
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: var(--text-muted);
    }

    .empty-state i {
        font-size: 4rem;
        opacity: 0.3;
        margin-bottom: 20px;
    }
</style>

<div class="audit-wrapper">
    <div class="audit-header">
        <h1>Audit Logs</h1>
        <p>System security and action logs with real-time monitoring</p>
    </div>

    <div class="audit-filters">
        <button class="filter-btn active" onclick="filterLogs('all')">All Logs</button>
        <button class="filter-btn" onclick="filterLogs('alert')">Alerts</button>
        <button class="filter-btn" onclick="filterLogs('warning')">Warnings</button>
        <button class="filter-btn" onclick="filterLogs('info')">Info</button>
        <button class="filter-btn" onclick="filterLogs('success')">Success</button>
    </div>

    <div class="audit-log-container">
        <div class="log-entry" data-type="alert">
            <div class="log-icon alert">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <div class="log-content">
                <span class="log-badge alert">Alert</span>
                <div class="log-time">Today at 20:01</div>
                <div class="log-message">Failed login attempt for user 'admin'</div>
                <div class="log-meta">
                    <span><i class="fas fa-map-marker-alt"></i> IP: 192.168.1.45</span>
                    <span><i class="fas fa-desktop"></i> Chrome on Windows</span>
                </div>
            </div>
        </div>

        <div class="log-entry" data-type="info">
            <div class="log-icon info">
                <i class="fas fa-info-circle"></i>
            </div>
            <div class="log-content">
                <span class="log-badge info">Info</span>
                <div class="log-time">Today at 19:55</div>
                <div class="log-message">System backup completed successfully</div>
                <div class="log-meta">
                    <span><i class="fas fa-database"></i> 2.4 GB backed up</span>
                    <span><i class="fas fa-clock"></i> Duration: 3m 42s</span>
                </div>
            </div>
        </div>

        <div class="log-entry" data-type="success">
            <div class="log-icon success">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="log-content">
                <span class="log-badge success">Success</span>
                <div class="log-time">Today at 18:30</div>
                <div class="log-message">New admin user 'Jean Bosco' created by Super Admin</div>
                <div class="log-meta">
                    <span><i class="fas fa-user"></i> User ID: #ADM-1024</span>
                    <span><i class="fas fa-shield-alt"></i> Role: Category Admin</span>
                </div>
            </div>
        </div>

        <div class="log-entry" data-type="warning">
            <div class="log-icon warning">
                <i class="fas fa-exclamation-circle"></i>
            </div>
            <div class="log-content">
                <span class="log-badge warning">Warning</span>
                <div class="log-time">Today at 17:15</div>
                <div class="log-message">High API request rate detected from marketplace module</div>
                <div class="log-meta">
                    <span><i class="fas fa-tachometer-alt"></i> 1,240 requests/min</span>
                    <span><i class="fas fa-server"></i> Server: API-02</span>
                </div>
            </div>
        </div>

        <div class="log-entry" data-type="info">
            <div class="log-icon info">
                <i class="fas fa-sync"></i>
            </div>
            <div class="log-content">
                <span class="log-badge info">Info</span>
                <div class="log-time">Today at 16:00</div>
                <div class="log-message">Scheduled system maintenance completed</div>
                <div class="log-meta">
                    <span><i class="fas fa-tools"></i> Database optimization</span>
                    <span><i class="fas fa-check"></i> All services operational</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function filterLogs(type) {
        // Update active button
        document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));
        event.target.classList.add('active');

        // Filter log entries
        const entries = document.querySelectorAll('.log-entry');
        entries.forEach(entry => {
            if (type === 'all' || entry.dataset.type === type) {
                entry.style.display = 'flex';
            } else {
                entry.style.display = 'none';
            }
        });
    }
</script>
@endsection
