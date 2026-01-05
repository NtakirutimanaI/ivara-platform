<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Horizontal Sidebar</title>
  <style>
    /* Base styles */
    body.hsidebar-body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      padding: 0;
      background-color: #f5f5f5;
      transition: filter 0.3s;
      font-size: 14px; /* Small text */
    }

    /* Horizontal "sidebar" container */
    .hsidebar-nav {
      display: flex;
      background-color: #1e293b; /* Dark blue-gray */
      padding: 0;
      width: 60%;
      margin-left: 5px;
      margin-top: 0px;
      list-style: none;
      overflow-x: auto;
    }

    /* Links inside the bar */
    .hsidebar-nav a {
      display: block;
      color: #ffffff;
      text-decoration: none;
      padding: 10px 15px; /* Smaller padding */
      transition: background 0.3s, transform 0.2s;
      white-space: nowrap; /* Prevent wrapping */
    }

    /* Hover effect */
    .hsidebar-nav a:hover {
      background-color: #334155;
      transform: scale(1.05); /* Slight pop effect */
    }

    /* Active link styling */
    .hsidebar-nav a.active {
      background-color: #924FC2; /* Highlighted blue */
    }

    /* Responsive: stack links on small screens */
    @media (max-width: 600px) {
      .hsidebar-nav {
        flex-direction: column;
        width: 100%;
        margin-left: 0;
        margin-top: 0;
      }
      .hsidebar-nav a {
        text-align: center;
      }
    }

    /* Content styling */
    .hsidebar-content {
      padding: 10px;
    }

    .hsidebar-content h1 {
      font-size: 1rem; /* Very small */
      margin: 5px 0;
    }

    .hsidebar-content p {
      font-size: 0.9rem;
      margin: 2px 0;
    }
  </style>
</head>
<body class="hsidebar-body">

  <nav class="hsidebar-nav">
    <a href="/inventory" class="active">Inventory</a>
    <a href="/sales">Sales</a>
    <a href="/daily-transactions">Daily Transactions</a>
  </nav>

  <div class="hsidebar-content">
    <h1>Welcome to your Dashboard</h1>
    <p>Select a section above to manage it.</p>
  </div>

  <script>
    // Brightness toggle on mouse move
    document.body.addEventListener('mousemove', (e) => {
      let x = e.clientX / window.innerWidth;
      let y = e.clientY / window.innerHeight;
      let brightness = 0.9 + 0.2 * ((x + y)/2); // 0.9 to 1.1
      document.body.style.filter = `brightness(${brightness})`;
    });

    // Reset brightness when mouse leaves
    document.body.addEventListener('mouseleave', () => {
      document.body.style.filter = 'brightness(1)';
    });
  </script>

</body>
</html>
