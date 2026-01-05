@include('layouts.header')
@include('layouts.sidebar')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Business Person Dashboard</title>
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
      flex-wrap: wrap;
    }

    .dash-unique-header h1 {
      font-size: 22px;
      font-weight: 600;
      color: #00C853;
    }

    .dash-unique-header input {
      padding: 10px 15px;
      border-radius: 12px;
      border: 1px solid #ddd;
      width: 220px;
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

    .dash-unique-product-sell {
      background: #fff;
      border-radius: 16px;
      padding: 20px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }

    .dash-unique-product-sell h4 {
      font-size: 18px;
      margin-bottom: 20px;
      color: #00C853;
    }

    .dash-unique-table-header,
    .dash-unique-table-row {
      display: grid;
      grid-template-columns: 2fr 1fr 1fr 1fr;
      gap: 10px;
      align-items: center;
      padding: 10px 0;
      border-bottom: 1px solid #f0f0f0;
    }

    .dash-unique-table-header {
      font-weight: bold;
      color: #999;
    }

    .dash-unique-product-image {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .dash-unique-product-image img {
      width: 40px;
      height: 40px;
      border-radius: 10px;
      object-fit: cover;
    }

    .dash-unique-product-name {
      font-weight: 500;
    }

    .dash-unique-product-desc {
      font-size: 12px;
      color: #888;
    }

    @media (max-width: 992px) {
      .dash-unique-wrapper {
        margin-left: 0;
        width: 100%;
      }
    }

    @media (max-width: 768px) {
      .dash-unique-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
      }

      .dash-unique-header input {
        width: 100%;
      }

      .dash-unique-table-header,
      .dash-unique-table-row {
        grid-template-columns: 1fr;
        gap: 5px;
        padding: 10px 5px;
      }

      .dash-unique-product-image {
        flex-direction: column;
        align-items: flex-start;
      }
    }

    @media (max-width: 480px) {
      .dash-unique-card p {
        font-size: 18px;
      }

      .dash-unique-card h3 {
        font-size: 12px;
      }
    }
  </style>
</head>
<body>
  <div class="dash-unique-wrapper">
    <div class="dash-unique-header">
      <h1>Hello, Business Person 👋</h1>
    </div>

    <div class="dash-unique-stats">
      <div class="dash-unique-card">
        <h3>Monthly Revenue</h3>
        <p>$198k</p>
      </div>
      <div class="dash-unique-card">
        <h3>Available Balance</h3>
        <p>$2.4k</p>
      </div>
      <div class="dash-unique-card">
        <h3>Total Sales</h3>
        <p>$89k</p>
      </div>
    </div>

    <div class="dash-unique-charts">
      <div class="dash-unique-chart-box">
        <h4>Revenue Over Time</h4>
        <canvas id="barChart"></canvas>
      </div>
      <div class="dash-unique-chart-box">
        <h4>Customer Segments</h4>
        <canvas id="pieChart"></canvas>
      </div>
    </div>

    <div class="dash-unique-product-sell">
      <h4>Top Selling Products</h4>
      <div class="dash-unique-table-header">
        <span>Product Name</span>
        <span>Stock</span>
        <span>Price</span>
        <span>Total Sales</span>
      </div>

      <div class="dash-unique-table-row">
        <div class="dash-unique-product-image">
          <img src="/images/abstract.jpg" alt="Abstract 3D">
          <div>
            <div class="dash-unique-product-name">Abstract 3D</div>
            <div class="dash-unique-product-desc">Modern digital artwork</div>
          </div>
        </div>
        <div>23 in stock</div>
        <div>$46.99</div>
        <div>28</div>
      </div>

      <div class="dash-unique-table-row">
        <div class="dash-unique-product-image">
          <img src="/images/sapphire.jpg" alt="Sapphire Illustration">
          <div>
            <div class="dash-unique-product-name">Sapphire Illustration</div>
            <div class="dash-unique-product-desc">Graphic design asset</div>
          </div>
        </div>
        <div>18 in stock</div>
        <div>$59.00</div>
        <div>45</div>
      </div>

      <div class="dash-unique-table-row">
        <div class="dash-unique-product-image">
          <img src="/images/landing.jpg" alt="Landing Page 3D">
          <div>
            <div class="dash-unique-product-name">Landing Page 3D</div>
            <div class="dash-unique-product-desc">Web design asset</div>
          </div>
        </div>
        <div>10 in stock</div>
        <div>$72.00</div>
        <div>38</div>
      </div>

      <div class="dash-unique-table-row">
        <div class="dash-unique-product-image">
          <img src="/images/collab.jpg" alt="Collab Illustration">
          <div>
            <div class="dash-unique-product-name">Collab Illustration</div>
            <div class="dash-unique-product-desc">Creative team design</div>
          </div>
        </div>
        <div>30 in stock</div>
        <div>$38.99</div>
        <div>52</div>
      </div>
    </div>
  </div>

  <script>
    const barCtx = document.getElementById('barChart').getContext('2d');
    new Chart(barCtx, {
      type: 'bar',
      data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
        datasets: [{
          label: 'Revenue ($)',
          data: [12000, 19000, 3000, 5000, 20000, 30000, 45000, 60000],
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
            beginAtZero: true
          }
        }
      }
    });

    const pieCtx = document.getElementById('pieChart').getContext('2d');
    new Chart(pieCtx, {
      type: 'doughnut',
      data: {
        labels: ['Returning', 'New', 'Referrals'],
        datasets: [{
          label: 'Customers',
          data: [55, 30, 15],
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
