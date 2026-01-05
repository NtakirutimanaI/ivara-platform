<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Service Features</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: Arial, sans-serif;
      background-color: #ffff;
      padding: 40px 20px;
    }

    .features {
      display: flex;
      justify-content: space-between;
      gap: 20px;
      text-align: center;
      flex-wrap: wrap;
    }

    .feature-box {
      flex: 1 1 250px;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 20px;
    }

    .feature-icon {
      background-color: #FCD72B;
      color: white;
      border-radius: 50%;
      width: 60px;
      height: 60px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 28px;
      margin-bottom: 15px;
    }

    .feature-title {
      font-weight: bold;
      font-size: 16px;
      margin-bottom: 6px;
      color: #001633; /* changed color here */
    }

    .feature-desc {
      font-size: 14px;
      color: #555;
    }

    @media (max-width: 768px) {
      .features {
        flex-direction: column;
        align-items: center;
      }

      .feature-box {
        max-width: 300px;
      }
    }
  </style>

  <!-- Include icons (optional, for real icons use Font Awesome or similar) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
</head>
<body>

  <div class="features">
    <!-- Box 1 -->
    <div class="feature-box">
      <div class="feature-icon">
        <i class="fas fa-truck"></i>
      </div>
      <div class="feature-title">FREE AND FAST DELIVERY</div>
      <div class="feature-desc">Free delivery for all orders over $140</div>
    </div>

    <!-- Box 2 -->
    <div class="feature-box">
      <div class="feature-icon">
        <i class="fas fa-headset"></i>
      </div>
      <div class="feature-title">24/7 CUSTOMER SERVICE</div>
      <div class="feature-desc">Friendly 24/7 customer support</div>
    </div>

    <!-- Box 3 -->
    <div class="feature-box">
      <div class="feature-icon">
        <i class="fas fa-rotate-left"></i>
      </div>
      <div class="feature-title">MONEY BACK GUARANTEE</div>
      <div class="feature-desc">We return money within 30 days</div>
    </div>
  </div>

</body>
</html>
