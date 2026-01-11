@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
<style>
    :root {
        --nature-green: #2D5A27;
        --earth-brown: #5D4037;
        --leaf-light: #81C784;
        --sun-yellow: #924FC2;
        --bg-cream: #F9FBE7;
        --text-dark: #1B2E1C;
        --text-muted: #546E7A;
    }

    .agri-dashboard {
        background: var(--bg-cream);
        color: var(--text-dark);
        min-height: 100vh;
        padding: 40px;
        font-family: 'Outfit', sans-serif;
    }

    .agri-header {
        background: white;
        padding: 35px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(45, 90, 39, 0.05);
        margin-bottom: 40px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 5px solid var(--nature-green);
    }

    .header-title h1 {
        font-family: 'Playfair Display', serif;
        font-size: 2.8rem;
        color: var(--nature-green);
        margin: 0;
        letter-spacing: -1px;
    }

    .header-title p {
        color: var(--text-muted);
        font-size: 1.1rem;
        margin-top: 5px;
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
        border-radius: 18px;
        padding: 25px;
        border: 1px solid rgba(45, 90, 39, 0.1);
        display: flex;
        flex-direction: column;
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .stat-card:hover {
        transform: scale(1.03);
        box-shadow: 0 15px 35px rgba(45, 90, 39, 0.1);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        background: #DCEDC8;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        color: var(--nature-green);
        margin-bottom: 20px;
    }

    .stat-value {
        font-size: 2.4rem;
        font-weight: 800;
        color: var(--nature-green);
        line-height: 1;
        margin-bottom: 5px;
    }

    .stat-label {
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .content-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 30px;
    }

    .agri-card {
        background: white;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
    }

    .agri-card-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.8rem;
        color: var(--earth-brown);
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .agri-card-title i { color: var(--nature-green); }

    .crop-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 10px;
    }

    .crop-table th {
        padding: 15px;
        text-align: left;
        color: var(--text-muted);
        font-size: 0.9rem;
        text-transform: uppercase;
    }

    .crop-table td {
        padding: 20px 15px;
        background: #F1F8E9;
    }

    .crop-table tr td:first-child { border-radius: 12px 0 0 12px; }
    .crop-table tr td:last-child { border-radius: 0 12px 12px 0; }

    .status-badge {
        padding: 6px 14px;
        border-radius: 6px;
        font-weight: 700;
        font-size: 0.8rem;
    }

    .badge-harvest { background: #C8E6C9; color: #1B5E20; }
    .badge-growing { background: #E1F5FE; color: #01579B; }

    .weather-widget {
        background: linear-gradient(135deg, var(--nature-green), #1B2E1C);
        color: white;
        padding: 30px;
        border-radius: 20px;
        text-align: center;
    }

    .weather-temp {
        font-size: 3.5rem;
        font-weight: 700;
        margin: 15px 0;
    }

    .btn-agri {
        padding: 14px 28px;
        background: var(--sun-yellow);
        color: var(--earth-brown);
        border: none;
        border-radius: 12px;
        font-weight: 700;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-agri:hover {
        background: white;
        border: 2px solid var(--sun-yellow);
        transform: translateY(-2px);
    }
</style>

<div class="agri-dashboard">
    <div class="agri-header">
        <div class="header-title">
            <h1><i class="fas fa-seedling me-3"></i>Agriculture Admin</h1>
            <p>Sustainable Farming & Environmental Management</p>
        </div>
        <div class="header-actions">
            <button class="btn-agri"><i class="fas fa-plus-circle me-2"></i> New Farm Entry</button>
        </div>
    </div>

    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-tractor"></i></div>
            <div class="stat-value">4,200</div>
            <div class="stat-label">Active Farms</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-tint"></i></div>
            <div class="stat-value">92%</div>
            <div class="stat-label">Soil Moisture</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-users"></i></div>
            <div class="stat-value">1.2k</div>
            <div class="stat-label">Field Workers</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-leaf"></i></div>
            <div class="stat-value">850t</div>
            <div class="stat-label">Stockpile</div>
        </div>
    </div>

    <div class="content-grid">
        <div class="agri-card">
            <h3 class="agri-card-title"><i class="fas fa-chart-line"></i> Production Summary</h3>
            <table class="crop-table">
                <thead>
                    <tr>
                        <th>Region</th>
                        <th>Crop Type</th>
                        <th>Status</th>
                        <th>Yield Estimate</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>North Valley</strong></td>
                        <td>Wheat</td>
                        <td><span class="status-badge badge-harvest">Ready to Harvest</span></td>
                        <td class="fw-bold">1,200 Tons</td>
                    </tr>
                    <tr>
                        <td><strong>East Highland</strong></td>
                        <td>Coffee</td>
                        <td><span class="status-badge badge-growing">Flowering</span></td>
                        <td class="fw-bold">450 Tons</td>
                    </tr>
                    <tr>
                        <td><strong>South Delta</strong></td>
                        <td>Maize</td>
                        <td><span class="status-badge badge-growing">Vegetative</span></td>
                        <td class="fw-bold">2,100 Tons</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="side-panel">
            <div class="weather-widget">
                <i class="fas fa-sun fa-4x mb-3" style="color: #924FC2;"></i>
                <div class="weather-temp">28°C</div>
                <h5 class="fw-bold">Sunny Skies</h5>
                <p class="opacity-75 mb-4">Ideal conditions for harvesting in North Valley.</p>
                <div style="background: rgba(255,255,255,0.1); padding: 15px; border-radius: 12px; text-align: left;">
                    <p class="small mb-1"><i class="fas fa-wind me-2"></i> Wind: 12 km/h</p>
                    <p class="small mb-0"><i class="fas fa-cloud-rain me-2"></i> Rain Chance: 5%</p>
                </div>
            </div>
            
            <div class="agri-card mt-4" style="background: var(--earth-brown); color: white;">
                <h5 class="fw-bold mb-2">Notice</h5>
                <p class="small mb-0 opacity-75">Irrigation schedule for South Delta updated. Please check the support logs.</p>
            </div>
        </div>
    </div>
</div>
@endsection
