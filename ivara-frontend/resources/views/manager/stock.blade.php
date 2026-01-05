@include('manager.connect')
@include('layouts.header')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Our Stock Dashboard</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body.dashboard-body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 10px;
      background-color: #f5f5f5;
      font-size: 13px;
    }

    .dashboard-container {
      max-width: 1000px;
      margin: auto;
      padding: 10px;
      margin-left:240px;
    }

    h1.dashboard-title {
      text-align: center;
      font-size: 1.6rem;
      color: #1e293b;
      margin-bottom: 15px;
    }

    .dashboard-grid {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      justify-content: center;
    }

    .dashboard-card {
      background-color: #fff;
      flex: 0 0 300px; /* Fixed width to avoid stretching */
      border-radius: 10px;
      padding: 10px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      display: flex;
      flex-direction: column;
      align-items: center;
      transition: transform 0.15s;
      min-width: 280px;
    }

    .dashboard-card:hover {
      transform: translateY(-3px);
    }

    .card-title {
      font-size: 1rem;
      font-weight: 600;
      margin-bottom: 5px;
      color: #334155;
      text-align: center;
    }

    .card-number {
      font-size: 1.4rem;
      font-weight: 700;
      color: #4f46e5;
      margin-bottom: 8px;
    }

    .mini-chart-container {
      width: 90%;
      margin-top: 5px;
    }

    canvas {
      width: 100% !important;
      height: 100px !important;
    }

    @media (max-width: 768px) {
      .dashboard-card {
        flex: 0 0 90%;
      }
    }
  </style>
</head>
<body class="dashboard-body">

  <div class="dashboard-container">
    <h1 class="dashboard-title">Our Stock</h1>

    <div class="dashboard-grid">
      <!-- Inventory -->
      <div class="dashboard-card">
        <div class="card-title">Inventory</div>
        <div class="card-number" id="inventory-number">120</div>
        <canvas id="inventoryChart"></canvas>
        <div class="mini-chart-container">
          <canvas id="inventoryMiniChart"></canvas>
        </div>
      </div>

      <!-- Sales -->
      <div class="dashboard-card">
        <div class="card-title">Sales</div>
        <div class="card-number" id="sales-number">85</div>
        <canvas id="salesChart"></canvas>
        <div class="mini-chart-container">
          <canvas id="salesMiniChart"></canvas>
        </div>
      </div>

      <!-- Daily Transactions -->
      <div class="dashboard-card">
        <div class="card-title">Daily Transactions</div>
        <div class="card-number" id="transactions-number">45</div>
        <canvas id="transactionsChart"></canvas>
        <div class="mini-chart-container">
          <canvas id="transactionsMiniChart"></canvas>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Inventory Main Chart
    new Chart(document.getElementById('inventoryChart'), {
      type: 'bar',
      data: {
        labels: ['Item A','Item B','Item C','Item D'],
        datasets: [{ label: 'Stock', data: [30,25,40,25], backgroundColor: '#4f46e5' }]
      },
      options: { responsive:true, plugins:{ legend:{ display:false } }, scales:{ y:{ beginAtZero:true } } }
    });

    // Inventory Mini Chart
    new Chart(document.getElementById('inventoryMiniChart'), {
      type: 'line',
      data: { labels:['Mon','Tue','Wed','Thu'], datasets:[{ data:[10,12,8,15], borderColor:'#4f46e5', backgroundColor:'rgba(59,130,246,0.2)', fill:true, tension:0.3 }] },
      options: { responsive:true, plugins:{ legend:{ display:false } }, scales:{ y:{ display:false }, x:{ display:false } } }
    });

    // Sales Main Chart
    new Chart(document.getElementById('salesChart'), {
      type: 'line',
      data: { labels:['Mon','Tue','Wed','Thu','Fri'], datasets:[{ data:[5,10,8,12,7], borderColor:'#10b981', backgroundColor:'rgba(16,185,129,0.2)', fill:true, tension:0.3 }] },
      options: { responsive:true, plugins:{ legend:{ display:false } }, scales:{ y:{ beginAtZero:true } } }
    });

    // Sales Mini Chart
    new Chart(document.getElementById('salesMiniChart'), {
      type: 'bar',
      data: { labels:['A','B','C'], datasets:[{ data:[3,5,2], backgroundColor:'#10b981' }] },
      options: { responsive:true, plugins:{ legend:{ display:false } }, scales:{ y:{ display:false }, x:{ display:false } } }
    });

    // Transactions Main Chart
    new Chart(document.getElementById('transactionsChart'), {
      type: 'doughnut',
      data: { labels:['Completed','Pending','Failed'], datasets:[{ data:[25,15,5], backgroundColor:['#4f46e5','#facc15','#ef4444'] }] },
      options: { responsive:true, plugins:{ legend:{ position:'bottom', labels:{ font:{ size:10 } } } } }
    });

    // Transactions Mini Chart
    new Chart(document.getElementById('transactionsMiniChart'), {
      type: 'line',
      data: { labels:['Mon','Tue','Wed','Thu'], datasets:[{ data:[3,5,2,6], borderColor:'#f59e0b', backgroundColor:'rgba(245,158,11,0.2)', fill:true, tension:0.3 }] },
      options: { responsive:true, plugins:{ legend:{ display:false } }, scales:{ y:{ display:false }, x:{ display:false } } }
    });
  </script>

</body>
</html>
@include('layouts.footer')
