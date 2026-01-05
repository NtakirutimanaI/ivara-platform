@include('layouts.header')
@include('layouts.sidebar')

@php
    $chartData = [
        'months'   => $months ?? ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
        'earnings' => $totals ?? [12000, 19000, 3000, 5000, 20000, 30000, 45000, 60000],
        'customers' => [
            'labels' => $customerLabels ?? ['Returning', 'New', 'Referrals'],
            'data'   => $customerValues ?? [55, 30, 15],
        ]
    ];
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Premium Dashboard | IVARA</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary-purple: #924FC2;
            --primary-green: #007B33;
            --accent-green: #00C853;
            --bg-glass: rgba(255, 255, 255, 0.7);
            --border-glass: rgba(255, 255, 255, 0.3);
            --shadow-soft: 0 8px 32px 0 rgba(31, 38, 135, 0.07);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f8f9ff 0%, #f1f4f9 100%);
            color: #1a1f36;
            min-height: 100vh;
            padding-top: 40px;
            overflow-x: hidden;
        }

        .dashboard-container {
            max-width: calc(100% - 320px);
            margin-left: 280px;
            padding: 0 40px 40px 40px;
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* --- Header Section --- */
        .welcome-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 35px;
            background: var(--bg-glass);
            backdrop-filter: blur(10px);
            padding: 25px 35px;
            border-radius: 24px;
            border: 1px solid var(--border-glass);
            box-shadow: var(--shadow-soft);
        }

        .welcome-text h1 {
            font-size: 28px;
            font-weight: 700;
            background: linear-gradient(to right, var(--primary-purple), #6366f1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 5px;
        }

        .welcome-text p {
            color: #64748b;
            font-size: 14px;
        }

        .user-status {
            text-align: right;
        }

        .premium-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(0, 123, 51, 0.1);
            color: var(--primary-green);
            padding: 8px 16px;
            border-radius: 100px;
            font-weight: 600;
            font-size: 13px;
        }

        /* --- Bento Grid Stats --- */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 25px;
            margin-bottom: 35px;
        }

        .stat-card {
            background: var(--bg-glass);
            backdrop-filter: blur(10px);
            padding: 30px;
            border-radius: 24px;
            border: 1px solid var(--border-glass);
            box-shadow: var(--shadow-soft);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px 0 rgba(31, 38, 135, 0.12);
            border-color: var(--primary-purple);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0; right: 0;
            width: 80px; height: 80px;
            background: linear-gradient(135deg, transparent 50%, rgba(146, 79, 194, 0.05) 50%);
            border-radius: 0 0 0 100%;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }

        .stat-card:hover .stat-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .icon-purple { background: rgba(146, 79, 194, 0.1); color: var(--primary-purple); }
        .icon-green { background: rgba(0, 123, 51, 0.1); color: var(--primary-green); }
        .icon-blue { background: rgba(59, 130, 246, 0.1); color: #3b82f6; }
        .icon-orange { background: rgba(249, 115, 22, 0.1); color: #f97316; }

        .stat-info h3 {
            font-size: 15px;
            color: #64748b;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .stat-info .value {
            font-size: 28px;
            font-weight: 700;
            color: #1a1f36;
        }

        .trend {
            margin-top: 15px;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .trend.up { color: #10b981; }

        /* --- Charts Section --- */
        .analytics-row {
            display: grid;
            grid-template-columns: 1.8fr 1.2fr;
            gap: 25px;
            margin-bottom: 35px;
            height: 420px;
        }

        .chart-container {
            background: var(--bg-glass);
            backdrop-filter: blur(10px);
            padding: 30px;
            border-radius: 24px;
            border: 1px solid var(--border-glass);
            box-shadow: var(--shadow-soft);
            display: flex;
            flex-direction: column;
        }

        .chart-container canvas {
            flex-grow: 1;
            max-height: 300px;
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .chart-header h4 {
            font-size: 18px;
            font-weight: 700;
            color: #1a1f36;
        }

        /* --- Tables & Activity --- */
        .bottom-row {
            display: grid;
            grid-template-columns: 1.5fr 1fr;
            gap: 25px;
        }

        .glass-card {
            background: var(--bg-glass);
            backdrop-filter: blur(10px);
            padding: 30px;
            border-radius: 24px;
            border: 1px solid var(--border-glass);
            box-shadow: var(--shadow-soft);
        }

        .glass-card h4 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 25px;
            color: #1a1f36;
        }

        /* Activities */
        .activity-timeline {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .timeline-item {
            display: flex;
            gap: 15px;
            position: relative;
        }

        .timeline-item:not(:last-child)::after {
            content: '';
            position: absolute;
            left: 20px;
            top: 45px;
            bottom: -20px;
            width: 2px;
            background: #e2e8f0;
        }

        .timeline-marker {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            z-index: 1;
        }

        .timeline-content {
            background: rgba(255,255,255,0.5);
            padding: 15px 20px;
            border-radius: 16px;
            flex: 1;
            transition: all 0.2s;
        }

        .timeline-content:hover {
            background: white;
            transform: translateX(5px);
        }

        /* Product Table */
        .premium-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 12px;
        }

        .premium-table th {
            text-align: left;
            padding: 10px 20px;
            color: #64748b;
            font-size: 13px;
            font-weight: 600;
        }

        .premium-table td {
            padding: 15px 20px;
            background: rgba(255,255,255,0.4);
            border-top: 1px solid rgba(255,255,255,0.8);
        }

        .premium-table tr td:first-child { border-radius: 16px 0 0 16px; }
        .premium-table tr td:last-child { border-radius: 0 16px 16px 0; }

        .product-meta {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .product-meta img {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            object-fit: cover;
        }

        .price-badge {
            background: white;
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: 700;
            color: var(--primary-purple);
        }

        @media (max-width: 1200px) {
            .dashboard-container { margin-left: 20px; padding: 0 20px; }
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
            .analytics-row, .bottom-row { grid-template-columns: 1fr; }
        }

        @media (max-width: 768px) {
            .stats-grid { grid-template-columns: 1fr; }
            .welcome-header { flex-direction: column; text-align: center; gap: 20px; }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Header -->
        <header class="welcome-header">
            <div class="welcome-text">
                <h1>Hello, {{ Auth::user()->name }} 👋</h1>
                <p>Welcome back! Here's what's happening with your business today.</p>
            </div>
            <div class="user-status">
                <div class="premium-badge">
                   <i class="fas fa-crown"></i> Premium Manager Plan
                </div>
            </div>
        </header>

        <!-- Stats Grid -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon icon-purple">
                    <i class="fas fa-wallet"></i>
                </div>
                <div class="stat-info">
                    <h3>Total Earnings</h3>
                    <div class="value">${{ number_format($stats['earnings'], 2) }}</div>
                    <div class="trend up">
                        <i class="fas fa-arrow-up"></i> 12.5% vs last month
                    </div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon icon-green">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stat-info">
                    <h3>Total Sales</h3>
                    <div class="value">{{ number_format($stats['sales']) }}</div>
                    <div class="trend up">
                        <i class="fas fa-arrow-up"></i> 8.2% vs last month
                    </div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon icon-blue">
                    <i class="fas fa-tools"></i>
                </div>
                <div class="stat-info">
                    <h3>Pending Repairs</h3>
                    <div class="value">{{ number_format($stats['repairs'] ?? 0) }}</div>
                    <div class="trend" style="color:#64748b">
                        <i class="fas fa-clock"></i> Active jobs now
                    </div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon icon-orange">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-info">
                    <h3>Total Users</h3>
                    <div class="value">{{ number_format($stats['users'] ?? 0) }}</div>
                    <div class="trend up">
                        <i class="fas fa-arrow-up"></i> 4 new today
                    </div>
                </div>
            </div>
        </div>

        <!-- Analytics Row -->
        <div class="analytics-row">
            <div class="chart-container">
                <div class="chart-header">
                    <h4>Revenue Analytics</h4>
                    <select style="padding: 8px; border-radius: 8px; border: 1px solid #e2e8f0; font-size: 13px;">
                        <option>Last 8 Months</option>
                        <option>Year to Date</option>
                    </select>
                </div>
                <canvas id="mainChart" height="280"></canvas>
            </div>

            <div class="chart-container">
                <div class="chart-header">
                    <h4>Customers</h4>
                </div>
                <canvas id="customerChart" height="280"></canvas>
            </div>
        </div>

        <!-- Bottom Row -->
        <div class="bottom-row">
            <div class="glass-card">
                <div class="chart-header">
                    <h4>Recent Product Sells</h4>
                    <button style="color: var(--primary-purple); background: none; border: none; font-weight: 600; cursor: pointer;">View All</button>
                </div>
                <div style="overflow-x: auto;">
                    <table class="premium-table">
                        <thead>
                            <tr>
                                <th>PRODUCT</th>
                                <th>STOCK</th>
                                <th>STATUS</th>
                                <th>PRICE</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>
                                    <div class="product-meta">
                                        <img src="{{ asset('storage/' . $product->image) }}" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($product->name) }}&background=924FC2&color=fff'" />
                                        <div>
                                            <div style="font-weight: 700; font-size: 14px;">{{ $product->name }}</div>
                                            <div style="font-size: 12px; color: #64748b;">{{ Str::limit($product->description, 30) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td><span style="font-weight: 600;">{{ $product->stock }}</span></td>
                                <td>
                                    <span style="background: {{ $product->stock > 5 ? 'rgba(16, 185, 129, 0.1)' : 'rgba(239, 68, 68, 0.1)' }}; color: {{ $product->stock > 5 ? '#10b981' : '#ef4444' }}; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 600;">
                                        {{ $product->stock > 5 ? 'In Stock' : 'Low Stock' }}
                                    </span>
                                </td>
                                <td><div class="price-badge">${{ number_format($product->price, 2) }}</div></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="glass-card">
                <h4>Recent Activity</h4>
                <div class="activity-timeline">
                    @forelse($activities as $activity)
                    <div class="timeline-item">
                        <div class="timeline-marker" style="color: var(--primary-purple)">
                            <i class="{{ $activity->icon ?? 'fas fa-dot-circle' }}"></i>
                        </div>
                        <div class="timeline-content">
                            <p style="font-size: 14px; color: #1a1f36; line-height: 1.4;">{{ $activity->message }}</p>
                            <span style="font-size: 12px; color: #94a3b8; margin-top: 5px; display: block;">
                                <i class="far fa-clock"></i> {{ $activity->created_at->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                    @empty
                    <p style="text-align: center; color: #64748b; padding: 40px 0;">No activities to report.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <script>
        // --- Main Chart ---
        const mainCtx = document.getElementById('mainChart').getContext('2d');
        const purpleGradient = mainCtx.createLinearGradient(0, 0, 0, 300);
        purpleGradient.addColorStop(0, 'rgba(146, 79, 194, 0.2)');
        purpleGradient.addColorStop(1, 'rgba(146, 79, 194, 0)');

        new Chart(mainCtx, {
            type: 'line',
            data: {
                labels: @json($chartData['months']),
                datasets: [{
                    label: 'Revenue',
                    data: @json($chartData['earnings']),
                    borderColor: '#924FC2',
                    borderWidth: 3,
                    backgroundColor: purpleGradient,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#924FC2',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 6,
                    pointHoverRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { grid: { display: false }, ticks: { font: { weight: 600 } } },
                    y: { 
                        beginAtZero: true,
                        grid: { color: 'rgba(0,0,0,0.03)' },
                        ticks: { font: { weight: 600 } }
                    }
                }
            }
        });

        // --- Customer Chart ---
        const customerCtx = document.getElementById('customerChart').getContext('2d');
        new Chart(customerCtx, {
            type: 'doughnut',
            data: {
                labels: @json($chartData['customers']['labels']),
                datasets: [{
                    data: @json($chartData['customers']['data']),
                    backgroundColor: ['#924FC2', '#007B33', '#3b82f6', '#f59e0b', '#ec4899'],
                    borderWidth: 0,
                    hoverOffset: 15
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '75%',
                plugins: {
                    legend: { position: 'bottom', labels: { usePointStyle: true, padding: 20, font: { weight: 600 } } }
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }
        });
    </script>
</body>
</html>

@include('layouts.footer')
