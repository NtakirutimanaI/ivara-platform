@include('layouts.header')
@include('layouts.sidebar')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Global Command Center | IVARA Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --admin-purple: #924FC2;
            --admin-pink: #FF1B6B;
            --admin-gold: #FFD700;
            --bg-glass: rgba(255, 255, 255, 0.7);
            --border-glass: rgba(255, 255, 255, 0.3);
            --shadow-premium: 0 10px 40px -10px rgba(0,0,0,0.1);
            --page-bg: radial-gradient(circle at top right, #fdf4ff, #f3f4f6);
            --page-text: #2d3748;
        }

        /* Dark Mode Overrides */
        body.dark-theme {
            --bg-glass: rgba(30, 41, 59, 0.7) !important;
            --border-glass: rgba(255, 255, 255, 0.08) !important;
            --shadow-premium: 0 10px 40px -10px rgba(0,0,0,0.5) !important;
            --page-bg: radial-gradient(circle at top right, #1e1b4b, #0f172a) !important;
            --page-text: #cbd5e1 !important;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background: var(--page-bg) !important;
            color: var(--page-text) !important;
            min-height: 100vh;
            padding-top: 40px;
            overflow-x: hidden;
            transition: background 0.3s, color 0.3s;
        }

        .admin-wrapper {
            margin-left: 250px;
            margin-right: 20px;
            padding: 0 40px 40px 40px;
            animation: slideUp 0.7s ease-out;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* --- Command Center Header --- */
        .command-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            background: var(--bg-glass);
            backdrop-filter: blur(15px);
            padding: 30px 40px;
            border-radius: 30px;
            border: 1px solid var(--border-glass);
            box-shadow: var(--shadow-premium);
        }

        .command-title h1 {
            font-size: 32px;
            font-weight: 800;
            background: linear-gradient(135deg, var(--admin-purple), var(--admin-pink));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -1px;
        }

        .system-status {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .status-dot {
            width: 12px;
            height: 12px;
            background: #10b981;
            border-radius: 50%;
            box-shadow: 0 0 10px #10b981;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.5); opacity: 0.5; }
            100% { transform: scale(1); opacity: 1; }
        }

        /* --- Bento Stats Grid --- */
        .bento-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-template-rows: auto;
            gap: 25px;
            margin-bottom: 40px;
        }

        .bento-card {
            background: var(--bg-glass);
            backdrop-filter: blur(10px);
            padding: 35px;
            border-radius: 30px;
            border: 1px solid var(--border-glass);
            box-shadow: var(--shadow-premium);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
        }

        .bento-card:hover {
            transform: scale(1.03);
            border-color: var(--admin-pink);
            background: white;
        }

        .bento-card.wide { grid-column: span 2; }

        .card-icon {
            width: 60px;
            height: 60px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 25px;
            background: white;
            box-shadow: 0 8px 15px rgba(0,0,0,0.05);
        }

        .icon-p { color: var(--admin-purple); }
        .icon-pk { color: var(--admin-pink); }
        .icon-g { color: #f59e0b; }
        .icon-b { color: #3b82f6; }

        .card-info h3 { font-size: 16px; color: #718096; font-weight: 600; margin-bottom: 10px; }
        .card-info .big-value { font-size: 36px; font-weight: 800; color: #1a202c; }

        /* --- Analytics Section --- */
        .analytics-container {
            display: grid;
            grid-template-columns: 1.8fr 1.2fr;
            gap: 25px;
            margin-bottom: 40px;
            height: 450px;
        }

        .glass-box {
            background: var(--bg-glass);
            backdrop-filter: blur(10px);
            padding: 30px;
            border-radius: 30px;
            border: 1px solid var(--border-glass);
            box-shadow: var(--shadow-premium);
            display: flex;
            flex-direction: column;
        }

        .glass-box canvas {
            flex-grow: 1;
            max-height: 320px;
        }

        .header-flex { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .header-flex h4 { font-size: 20px; font-weight: 700; color: #1a202c; }

        /* --- Activity & Modules --- */
        .system-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
        }

        .activity-feed {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .activity-card {
            background: white;
            padding: 20px;
            border-radius: 20px;
            display: flex;
            gap: 15px;
            align-items: center;
            border: 1px solid #f1f5f9;
            transition: transform 0.2s;
        }

        .activity-card:hover { transform: translateX(10px); border-color: var(--admin-purple); }

        .activity-avatar {
            width: 45px; height: 45px; border-radius: 12px;
            background: #f8fafc; display: flex; align-items: center; justify-content: center;
            font-size: 18px; color: var(--admin-purple);
        }

        .activity-details p { font-size: 14px; font-weight: 600; color: #334155; }
        .activity-details span { font-size: 12px; color: #94a3b8; }

        /* Categorized Modules (The 7 Categories) */
        .module-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .module-item {
            padding: 20px;
            border-radius: 20px;
            background: white;
            border: 1px solid #f1f5f9;
            text-align: center;
            transition: all 0.3s;
            text-decoration: none;
            color: inherit;
        }

        .module-item:hover {
            background: var(--admin-purple);
            color: white;
            box-shadow: 0 10px 20px rgba(146, 79, 194, 0.2);
        }

        .module-item i { font-size: 24px; margin-bottom: 12px; display: block; }
        .module-item span { font-size: 13px; font-weight: 600; }

        @media (max-width: 1200px) {
            .admin-wrapper { margin-left: 20px; padding: 0 20px; }
            .bento-grid { grid-template-columns: repeat(2, 1fr); }
            .analytics-container, .system-row { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="admin-wrapper">
        <!-- Global Header -->
        <div class="command-header">
            <div class="command-title">
                <h1>Global Command Center</h1>
                <p style="color: #64748b; font-weight: 500; margin-top: 5px;">Unified Oversight for all 7 Service Modules</p>
            </div>
            <div class="system-status">
                <span class="premium-badge" style="background: rgba(0,0,0,0.05); padding: 10px 20px; border-radius: 15px; font-weight: 700; font-size: 14px;">
                    <i class="fas fa-microchip" style="color: var(--admin-purple); margin-right: 8px;"></i> System Core v2.0
                </span>
                <div style="display: flex; align-items: center; gap: 10px; background: #ecfdf5; padding: 10px 20px; border-radius: 15px; color: #065f46; font-weight: 700;">
                    <div class="status-dot"></div> Live
                </div>
            </div>
        </div>

        <!-- Bento Grid Stats -->
        <div class="bento-grid">
            <div class="bento-card">
                <div class="card-icon icon-pk"><i class="fas fa-coins"></i></div>
                <div class="card-info">
                    <h3>Total Ecosystem Revenue</h3>
                    <div class="big-value">${{ number_format($stats['earnings'], 2) }}</div>
                </div>
            </div>

            <div class="bento-card">
                <div class="card-icon icon-p"><i class="fas fa-user-shield"></i></div>
                <div class="card-info">
                    <h3>Total Users Enrolled</h3>
                    <div class="big-value">{{ number_format($stats['users']) }}</div>
                </div>
            </div>

            <div class="bento-card">
                <div class="card-icon icon-g"><i class="fas fa-shopping-bag"></i></div>
                <div class="card-info">
                    <h3>Successful Orders</h3>
                    <div class="big-value">{{ number_format($stats['orders']) }}</div>
                </div>
            </div>

            <div class="bento-card">
                <div class="card-icon icon-b"><i class="fas fa-network-wired"></i></div>
                <div class="card-info">
                    <h3>Active Workload</h3>
                    <div class="big-value">{{ number_format($stats['repairs']) }}</div>
                </div>
            </div>
        </div>

        <!-- Analytics Section -->
        <div class="analytics-container">
            <div class="glass-box">
                <div class="header-flex">
                    <h4>Ecosystem Growth Analytics</h4>
                    <div style="display:flex; gap:10px;">
                        <span style="background: rgba(146, 79, 194, 0.1); color: var(--admin-purple); padding: 5px 15px; border-radius: 8px; font-size: 12px; font-weight: 700;">Revenue</span>
                        <span style="background: #f1f5f9; color: #64748b; padding: 5px 15px; border-radius: 8px; font-size: 12px; font-weight: 700;">Orders</span>
                    </div>
                </div>
                <canvas id="revenueChart" height="300"></canvas>
            </div>

            <div class="glass-box">
                <div class="header-flex">
                    <h4>User Distribution</h4>
                </div>
                <canvas id="userTypeChart" height="300"></canvas>
            </div>
        </div>

        <!-- Bottom Role/Activity Section -->
        <div class="system-row">
            <!-- Global Activity -->
            <div class="glass-box">
                <div class="header-flex">
                    <h4>Global System Activity</h4>
                    <button style="border:none; background:none; color: var(--admin-purple); font-weight: 700;">View Logs</button>
                </div>
                <div class="activity-feed">
                    @forelse($activities as $activity)
                    <div class="activity-card">
                        <div class="activity-avatar">
                            <i class="{{ $activity->icon ?? 'fas fa-bolt' }}"></i>
                        </div>
                        <div class="activity-details">
                            <p>{{ $activity->message }}</p>
                            <span><i class="far fa-clock"></i> {{ $activity->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    @empty
                    <p style="text-align:center; padding: 40px; color: #94a3b8;">System idle. No recent events.</p>
                    @endforelse
                </div>
            </div>

            <!-- Module Quick Access -->
            <div class="glass-box">
                <div class="header-flex">
                    <h4>Core Service Categories</h4>
                </div>
                <div class="module-grid">
                    <a href="#" class="module-item">
                        <i class="fas fa-tools"></i>
                        <span>Technical & Repair</span>
                    </a>
                    <a href="#" class="module-item">
                        <i class="fas fa-spa"></i>
                        <span>Lifestyle & Wellness</span>
                    </a>
                    <a href="#" class="module-item">
                        <i class="fas fa-truck"></i>
                        <span>Transport & Hospitality</span>
                    </a>
                    <a href="#" class="module-item">
                        <i class="fas fa-utensils"></i>
                        <span>Food & Fashion</span>
                    </a>
                    <a href="#" class="module-item">
                        <i class="fas fa-graduation-cap"></i>
                        <span>Education & Knowledge</span>
                    </a>
                    <a href="#" class="module-item">
                        <i class="fas fa-seedling"></i>
                        <span>Agriculture & Farming</span>
                    </a>
                </div>
                <div style="margin-top: 25px; padding: 25px; background: linear-gradient(135deg, var(--admin-purple), #6366f1); border-radius: 20px; color: white;">
                    <div style="display:flex; justify-content:space-between; align-items:center;">
                        <div>
                            <h5 style="font-size: 16px; font-weight: 700;">Admin Support</h5>
                            <p style="font-size: 12px; opacity: 0.9;">Need help with system configuration?</p>
                        </div>
                        <i class="fas fa-headset" style="font-size: 30px; opacity: 0.5;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Logic -->
    <script>
        // --- Revenue Line Chart ---
        const revCtx = document.getElementById('revenueChart').getContext('2d');
        const pinkGrad = revCtx.createLinearGradient(0, 0, 0, 400);
        pinkGrad.addColorStop(0, 'rgba(255, 27, 107, 0.2)');
        pinkGrad.addColorStop(1, 'rgba(255, 27, 107, 0)');

        new Chart(revCtx, {
            type: 'line',
            data: {
                labels: @json($chartData['months']),
                datasets: [{
                    label: 'System Revenue',
                    data: @json($chartData['earnings']),
                    borderColor: '#FF1B6B',
                    borderWidth: 4,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#FF1B6B',
                    pointBorderWidth: 2,
                    pointRadius: 6,
                    tension: 0.4,
                    fill: true,
                    backgroundColor: pinkGrad
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { grid: { display: false }, ticks: { font: { weight: 700 } } },
                    y: { grid: { color: 'rgba(0,0,0,0.03)' }, ticks: { font: { weight: 700 } } }
                }
            }
        });

        // --- User Distribution Pie ---
        const userCtx = document.getElementById('userTypeChart').getContext('2d');
        new Chart(userCtx, {
            type: 'doughnut',
            data: {
                labels: @json($chartData['customers']['labels']),
                datasets: [{
                    data: @json($chartData['customers']['data']),
                    backgroundColor: ['#924FC2', '#FF1B6B', '#3b82f6', '#f59e0b', '#10b981', '#6366f1'],
                    borderWidth: 0,
                    hoverOffset: 20
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '75%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { usePointStyle: true, padding: 25, font: { weight: 700, size: 12 } }
                    }
                }
            }
        });
    </script>
</body>
</html>

@include('layouts.footer')
