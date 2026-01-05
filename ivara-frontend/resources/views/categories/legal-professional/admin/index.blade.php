@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Crimson+Pro:wght@400;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
    :root {
        --navy-main: #0A192F;
        --navy-light: #172A45;
        --navy-accent: #30475E;
        --gold-muted: #C5A059;
        --legal-blue: #2563EB;
        --bg-soft: #F1F5F9;
        --text-dark: #1E293B;
        --text-muted: #64748B;
    }

    .legal-dashboard {
        background: var(--bg-soft);
        color: var(--text-dark);
        min-height: 100vh;
        padding: 40px;
        font-family: 'Inter', sans-serif;
    }

    .legal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 40px;
        border-left: 8px solid var(--navy-main);
        padding-left: 25px;
        background: white;
        padding: 30px;
        border-radius: 0 15px 15px 0;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
    }

    .header-title h1 {
        font-family: 'Crimson Pro', serif;
        font-size: 2.2rem;
        font-weight: 700;
        color: var(--navy-main);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .header-title p {
        color: var(--text-muted);
        margin-top: 5px;
        font-size: 1rem;
        font-weight: 500;
    }

    .stats-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 25px;
        margin-bottom: 40px;
    }

    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 25px;
        border: 1px solid #E2E8F0;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
        border-color: var(--legal-blue);
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        background: var(--bg-soft);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: var(--navy-main);
        margin-bottom: 15px;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        color: var(--navy-main);
    }

    .stat-label {
        color: var(--text-muted);
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .content-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 30px;
    }

    .panel {
        background: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
    }

    .panel-title {
        font-family: 'Crimson Pro', serif;
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 25px;
        color: var(--navy-main);
        display: flex;
        align-items: center;
        padding-bottom: 15px;
        border-bottom: 1px solid #E2E8F0;
        gap: 15px;
    }

    .case-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .case-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px;
        border: 1px solid #F1F5F9;
        border-radius: 8px;
        transition: background 0.3s;
    }

    .case-item:hover {
        background: var(--bg-soft);
    }

    .case-info h5 { margin: 0; font-size: 1rem; color: var(--navy-main); }
    .case-info p { margin: 0; color: var(--text-muted); font-size: 0.85rem; }

    .status-badge {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
    }

    .status-active { background: #DCFCE7; color: #166534; }
    .status-pending { background: #FEF3C7; color: #92400E; }

    .btn-navy {
        padding: 12px 24px;
        background: var(--navy-main);
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-navy:hover {
        background: var(--navy-light);
        box-shadow: 0 4px 12px rgba(10, 25, 47, 0.2);
    }
</style>

<div class="legal-dashboard">
    <div class="legal-header">
        <div class="header-title">
            <h1><i class="fas fa-balance-scale"></i> Legal & Professional Admin</h1>
            <p>Advocacy, Consultancy & Regulatory Compliance</p>
        </div>
        <div class="header-actions">
            <button class="btn-navy"><i class="fas fa-plus me-2"></i> New Case File</button>
        </div>
    </div>

    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-gavel"></i></div>
            <div class="stat-value">142</div>
            <div class="stat-label">Active Cases</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-file-contract"></i></div>
            <div class="stat-value">843</div>
            <div class="stat-label">Documents Verified</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-user-shield"></i></div>
            <div class="stat-value">12</div>
            <div class="stat-label">Regulatory Alerts</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-clock"></i></div>
            <div class="stat-value">4.2k</div>
            <div class="stat-label">Billable Hours</div>
        </div>
    </div>

    <div class="content-grid">
        <div class="panel">
            <h3 class="panel-title"><i class="fas fa-briefcase"></i> Recent High-Priority Cases</h3>
            <div class="case-list">
                <div class="case-item">
                    <div class="case-info">
                        <h5>Ivara v. Global Markets Corp</h5>
                        <p>Corporate Law | Assigned: Senior Partner</p>
                    </div>
                    <span class="status-badge status-active">Active</span>
                </div>
                <div class="case-item">
                    <div class="case-info">
                        <h5>Property Dispute - Kigali Sector 4</h5>
                        <p>Real Estate | Assigned: J. Kabera</p>
                    </div>
                    <span class="status-badge status-pending">In Review</span>
                </div>
                <div class="case-item">
                    <div class="case-info">
                        <h5>Intellectual Property Filing: WaveTech</h5>
                        <p>IP Law | Status: Pending Filing</p>
                    </div>
                    <span class="status-badge status-pending">Pending</span>
                </div>
            </div>
        </div>

        <div class="panel">
            <h3 class="panel-title"><i class="fas fa-calendar-check"></i> Consultations</h3>
            <div style="font-size: 0.95rem;">
                <div class="mb-4 pb-3 border-bottom">
                    <p class="mb-1 fw-bold text-navy-main">10:00 AM - Client Prep</p>
                    <p class="text-muted small">Conference Room B</p>
                </div>
                <div class="mb-4 pb-3 border-bottom">
                    <p class="mb-1 fw-bold text-navy-main">02:30 PM - Regulatory Review</p>
                    <p class="text-muted small">Virtual Meeting</p>
                </div>
                <button class="btn btn-link text-decoration-none p-0 fw-bold" style="color: var(--legal-blue)">View All Schedule →</button>
            </div>
            
            <div class="mt-5 p-4 rounded-4" style="background: var(--navy-main); color: white;">
                <h5 class="fw-bold mb-2">Notice</h5>
                <p class="small mb-0 opacity-75">All communications must follow SRA guidelines and GDPR protocols.</p>
            </div>
        </div>
    </div>
</div>
@endsection
