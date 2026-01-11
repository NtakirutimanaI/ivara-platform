@include('layouts.header')
@include('layouts.sidebar')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard UI</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Inter', sans-serif;
    }

    body {
      background: #f5f7fa;
      color: #333;
      margin: 0;
      padding: 0;
    }

    .dash-unique-wrapper {
      margin-left: var(--sidebar-width, 260px);
      width: calc(100% - var(--sidebar-width, 260px));
      margin-top: var(--header-height, 72px);
      padding: 30px;
      box-sizing: border-box;
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
      color: #924FC2;
    }

    .username {
      font-weight: 700;
      color: #007B33;
      white-space: nowrap;
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
      color: #924FC2;
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
      color: #924FC2;
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
      color: #924FC2;
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

    @media (max-width: 768px) {
      .dash-unique-wrapper {
        margin-left: 0;
        width: 100%;
        padding: 0 15px;
      }

      .dash-unique-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
      }

      .username {
        align-self: flex-end;
        width: 100%;
        text-align: right;
      }

      .dash-unique-header input {
        width: 100%;
      }
    }
  </style>
</head>
<body>
  <div class="dash-unique-wrapper">
    <div class="dash-unique-header">
      <h1>Hello, Admin 👋</h1>
       <div class="username" data-gender="{{ Auth::user()->gender ?? 'male' }}">
        {{ Auth::user()->name ?? 'Guest' }}
      </div>
    </div>

    <div class="dash-unique-stats">
      <div class="dash-unique-card">
        <h3>Earnings</h3>
        <p>$198k</p>
      </div>
      <div class="dash-unique-card">
        <h3>Balance</h3>
        <p>$2.4k</p>
      </div>
      <div class="dash-unique-card">
        <h3>Sales</h3>
        <p>$89k</p>
      </div>
    </div>

    <div class="dash-unique-charts">
      <div class="dash-unique-chart-box">
        <h4>Monthly Earnings</h4>
        <canvas id="barChart"></canvas>
      </div>
      <div class="dash-unique-chart-box">
        <h4>Customer Distribution</h4>
        <canvas id="pieChart"></canvas>
      </div>
    </div>

    <div class="dash-unique-product-sell">
      <h4>Product Sell</h4>
      <div class="dash-unique-table-header">
        <span>Product Name</span>
        <span>Stock</span>
        <span>Price</span>
        <span>Total Sales</span>
      </div>

      <div class="dash-unique-table-row">
        <div class="dash-unique-product-image">
          <img src="/images/abstract.jpg" alt="Abstract 3D" />
          <div>
            <div class="dash-unique-product-name">Abstract 3D</div>
            <div class="dash-unique-product-desc">Lorem ipsum dolor sit amet</div>
          </div>
        </div>
        <div>23 in stock</div>
        <div>$46.99</div>
        <div>28</div>
      </div>

      <div class="dash-unique-table-row">
        <div class="dash-unique-product-image">
          <img src="/images/sapphire.jpg" alt="Sapphire Illustration" />
          <div>
            <div class="dash-unique-product-name">Sapphire Illustration</div>
            <div class="dash-unique-product-desc">Lorem ipsum dolor sit amet</div>
          </div>
        </div>
        <div>23 in stock</div>
        <div>$46.99</div>
        <div>28</div>
      </div>

      <div class="dash-unique-table-row">
        <div class="dash-unique-product-image">
          <img src="/images/landing.jpg" alt="Landing Page 3D" />
          <div>
            <div class="dash-unique-product-name">Landing Page 3D</div>
            <div class="dash-unique-product-desc">Lorem ipsum dolor sit amet</div>
          </div>
        </div>
        <div>23 in stock</div>
        <div>$46.99</div>
        <div>28</div>
      </div>

      <div class="dash-unique-table-row">
        <div class="dash-unique-product-image">
          <img src="/images/collab.jpg" alt="Collab Illustration" />
          <div>
            <div class="dash-unique-product-name">Collab Illustration</div>
            <div class="dash-unique-product-desc">Lorem ipsum dolor sit amet</div>
          </div>
        </div>
        <div>23 in stock</div>
        <div>$46.99</div>
        <div>28</div>
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
          label: 'Earnings ($)',
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

    // Add prefix Mr. or Mrs. and append statement
    const usernameDiv = document.querySelector('.username');
    const name = usernameDiv.textContent.trim();
    const gender = usernameDiv.getAttribute('data-gender');

    let prefix = '';
    if (gender === 'male') {
      prefix = 'Mr. ';
    } else if (gender === 'female') {
      prefix = 'Mrs. ';
    }

    usernameDiv.textContent = prefix + name + " — I'm Proud of you!";
  </script>
</body>
</html>
@include('layouts.footer')