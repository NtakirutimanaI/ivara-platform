@include('layouts.header')
@include('layouts.sidebar')

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Mediator Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
    body { background: #f5f7fa; color: #333; padding: 20px; margin-top: 60px; }
    .dash-unique-wrapper { max-width: 1200px; margin-left: 240px; width: 80%; }
    .dash-unique-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
    .dash-unique-header h1 { font-size: 22px; font-weight: 600; color: #00C853; }
    .dash-unique-header input { padding: 10px 15px; border-radius: 12px; border: 1px solid #ddd; width: 220px; }
    .dash-unique-stats { display: flex; flex-wrap: wrap; gap: 20px; margin-bottom: 30px; }
    .dash-unique-card { background: #fff; flex: 1 1 200px; padding: 20px; border-radius: 16px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05); }
    .dash-unique-card h3 { font-size: 14px; color: #888; margin-bottom: 10px; }
    .dash-unique-card p { font-size: 22px; font-weight: bold; color: #00C853; }
    .dash-unique-charts { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; margin-bottom: 40px; }
    .dash-unique-chart-box { background: #fff; padding: 20px; border-radius: 16px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05); }
    .dash-unique-chart-box h4 { margin-bottom: 15px; font-size: 16px; color: #00C853; }
    .dash-unique-product-sell { background: #fff; border-radius: 16px; padding: 20px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05); }
    .dash-unique-product-sell h4 { font-size: 18px; margin-bottom: 20px; color: #00C853; }
    .dash-unique-table-header, .dash-unique-table-row { display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 10px; align-items: center; padding: 10px 0; border-bottom: 1px solid #f0f0f0; }
    .dash-unique-table-header { font-weight: bold; color: #999; }
    .dash-unique-product-image { display: flex; align-items: center; gap: 10px; }
    .dash-unique-product-image img { width: 40px; height: 40px; border-radius: 10px; object-fit: cover; }
    .dash-unique-product-name { font-weight: 500; }
    .dash-unique-product-desc { font-size: 12px; color: #888; }
    @media (max-width: 768px) {
      .dash-unique-wrapper { margin-left: 0; width: 100%; padding: 10px; }
      .dash-unique-header { flex-direction: column; align-items: flex-start; gap: 10px; }
      .dash-unique-header input { width: 100%; }
    }
  </style>
</head>
<body>
  <div class="dash-unique-wrapper">
    <div class="dash-unique-header">
      <h1>Hello, Mediator 👋</h1>
    </div>

    <div class="dash-unique-stats">
  <div class="dash-unique-card">
    <h3>Scheduled Meetings</h3>
    <p>{{ $scheduledMeetings ?? 0 }}</p>
  </div>
  <div class="dash-unique-card">
    <h3>New Clients</h3>
    <p>{{ $newClients ?? 0 }}</p>
  </div>
  <div class="dash-unique-card">
    <h3>Unread Feedback</h3>
    <p>{{ $unreadFeedback ?? 0 }}</p>
  </div>
</div>


    <div class="dash-unique-charts">
      <div class="dash-unique-chart-box">
        <h4>Bookings Overview</h4>
        <canvas id="barChart"></canvas>
      </div>
      <div class="dash-unique-chart-box">
        <h4>Notification Reach</h4>
        <canvas id="pieChart"></canvas>
      </div>
    </div>

    <div class="dash-unique-product-sell">
      <h4>Recent Bookings</h4>
      <div class="dash-unique-table-header">
        <span>Client Name</span>
        <span>Service</span>
        <span>Date</span>
        <span>Status</span>
      </div>

      @foreach($recentBookings ?? [] as $booking)
      <div class="dash-unique-table-row">
        <div class="dash-unique-product-image">
          <img src="{{ $booking->client->photo ?? '/images/user1.jpg' }}" alt="Client">
          <div>
            <div class="dash-unique-product-name">
                {{ $booking->client->name ?? 'No Client' }}
            </div>
            <div class="dash-unique-product-desc">
                {{ $booking->client->notes ?? $booking->client->phone ?? 'No details' }}
            </div>
          </div>
        </div>
        <div>{{ $booking->assigned_type ?? 'N/A' }}</div>
        <div>{{ \Carbon\Carbon::parse($booking->preferred_date)->format('M d') ?? 'N/A' }}</div>
        <div>{{ $booking->status ?? 'N/A' }}</div>
      </div>
      @endforeach
    </div>
  </div>

  <script>
    const barCtx = document.getElementById('barChart').getContext('2d');
    new Chart(barCtx, {
      type: 'bar',
      data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        datasets: [{
          label: 'Bookings',
          data: @json($bookingsData ?? []),
          backgroundColor: '#00C853',
          borderRadius: 8
        }]
      },
      options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true } }
      }
    });

    const pieCtx = document.getElementById('pieChart').getContext('2d');
    new Chart(pieCtx, {
      type: 'doughnut',
      data: {
        labels: ['Email', 'SMS', 'App'],
        datasets: [{
          label: 'Notifications',
          data: [
            {{ $notificationData->email_count ?? 0 }},
            {{ $notificationData->sms_count ?? 0 }},
            {{ $notificationData->app_count ?? 0 }}
          ],
          backgroundColor: ['#00C853', '#a5d6a7', '#e0f2f1'],
          borderWidth: 0
        }]
      },
      options: {
        responsive: true,
        cutout: '70%',
        plugins: { legend: { position: 'bottom' } }
      }
    });
  </script>
</body>
</html>

@include('layouts.footer')
