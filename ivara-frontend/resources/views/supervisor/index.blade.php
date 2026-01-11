@include('layouts.header')
@include('layouts.sidebar')


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Supervisor Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background: #f5f7fa;
      color: #333;
      padding: 20px;
      margin-top: 60px;
    }

    .dash-unique-wrapper {
      max-width: 1200px;
      margin-left: 240px;
      width: 80%;
    }

    .dash-unique-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 25px;
    }

    .dash-unique-header h1 {
      font-size: 22px;
      font-weight: 600;
      color: #00C853;
    }

    .dash-unique-stats {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      margin-bottom: 30px;
    }

    .dash-unique-card {
      background: #fff;
      flex: 1 1 200px;
      padding: 20px;
      border-radius: 16px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }

    .dash-unique-card h3 {
      font-size: 14px;
      color: #888;
      margin-bottom: 10px;
    }

    .dash-unique-card p {
      font-size: 22px;
      font-weight: bold;
      color: #00C853;
    }

    .dash-unique-charts {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 30px;
      margin-bottom: 40px;
    }

    .dash-unique-chart-box {
      background: #fff;
      padding: 20px;
      border-radius: 16px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }

    .dash-unique-chart-box h4 {
      margin-bottom: 15px;
      font-size: 16px;
      color: #00C853;
    }

    @media (max-width: 768px) {
      .dash-unique-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
      }
    }
  </style>
</head>
<body>
  <div class="dash-unique-wrapper">
    <div class="dash-unique-header">
      <h1>Welcome, Supervisor 👋</h1>
    </div>

    <!-- Performance Review Area -->
    @php
        $mockSupervisors = session('mock_supervisors', []);
        $mySupReview = null;
        if(!empty($mockSupervisors)) {
             foreach($mockSupervisors as $s) {
                 if(isset($s['latest_review'])) {
                     $mySupReview = $s;
                     break;
                 }
             }
        }
    @endphp

    @if($mySupReview && isset($mySupReview['latest_review']))
    <div style="background: #e8f5e9; border-left: 5px solid #00C853; padding: 20px; border-radius: 10px; margin-bottom: 30px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
            <h3 style="color: #2e7d32; margin: 0; font-size: 1.1rem;">
                <i class="fas fa-clipboard-check" style="margin-right: 8px;"></i> Performance Review
            </h3>
            <span style="background: #00C853; color: white; padding: 5px 10px; border-radius: 20px; font-weight: bold; font-size: 0.9rem;">
                Score: {{ $mySupReview['rating'] }}/10
            </span>
        </div>
        <p style="color: #1b5e20; font-style: italic; line-height: 1.5;">
            "{{ $mySupReview['latest_review'] }}"
        </p>
        <div style="text-align: right; margin-top: 10px; font-size: 0.8rem; color: #66bb6a; font-weight: 600;">
            - Super Admin Feedback
        </div>
    </div>
    @endif
    <!-- End Performance Review -->

    <div class="dash-unique-stats">
      <div class="dash-unique-card">
        <h3>Assigned Tasks</h3>
        <p>32</p>
      </div>
      <div class="dash-unique-card">
        <h3>Ongoing Projects</h3>
        <p>6</p>
      </div>
      <div class="dash-unique-card">
        <h3>Team Members</h3>
        <p>14</p>
      </div>
    </div>

    <div class="dash-unique-charts">
      <div class="dash-unique-chart-box">
        <h4>Progress Overview</h4>
        <canvas id="barChart"></canvas>
      </div>
      <div class="dash-unique-chart-box">
        <h4>Workforce Distribution</h4>
        <canvas id="pieChart"></canvas>
      </div>
    </div>
  </div>

  <script>
    const barCtx = document.getElementById('barChart').getContext('2d');
    new Chart(barCtx, {
      type: 'bar',
      data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        datasets: [{
          label: 'Progress %',
          data: [30, 45, 60, 70, 80, 85, 95],
          backgroundColor: '#00C853',
          borderRadius: 8
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: { display: false }
        },
        scales: {
          y: {
            beginAtZero: true,
            max: 100
          }
        }
      }
    });

    const pieCtx = document.getElementById('pieChart').getContext('2d');
    new Chart(pieCtx, {
      type: 'doughnut',
      data: {
        labels: ['Field Workers', 'Technicians', 'Managers'],
        datasets: [{
          label: 'Workforce',
          data: [50, 30, 20],
          backgroundColor: ['#00C853', '#a5d6a7', '#e0f2f1'],
          borderWidth: 0
        }]
      },
      options: {
        responsive: true,
        cutout: '70%',
        plugins: {
          legend: {
            position: 'bottom'
          }
        }
      }
    });
  </script>
</body>
</html>

@include('layouts.footer')