@include('manager.connect')
@include('layouts.header')
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Daily Transactions</title>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, sans-serif;
        background: #f4f6f9;
        margin: 0;
        padding: 0;
        color: #333;
    }
    header {
        background: #071839;
        color: white;
        padding: 10px 20px;
        font-size: 1.2rem;
        font-weight: bold;
    }
    .container {
        padding: 10px;
        max-width: 80%;
        margin-left:240px;
    }
    .widgets {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-bottom: 10px;
    }
    .widget {
        background: white;
        flex: 1;
        min-width: 150px;
        padding: 10px;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        text-align: center;
    }
    .widget h3 {
        margin: 0;
        font-size: 1.2rem;
    }
    .widget p {
        font-size: 1.4rem;
        font-weight: bold;
        margin: 5px 0 0;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        border-radius: 8px;
        overflow: hidden;
    }
    table th, table td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #eee;
        font-size: 0.9rem;
    }
    table th {
        background: #071839;
        color: white;
    }
    .filters {
        display: flex;
        gap: 10px;
        margin-bottom: 10px;
        flex-wrap: wrap;
    }
    select, input[type="date"] {
        padding: 5px;
        font-size: 0.9rem;
    }
    /* Centered Charts */
    .charts {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        gap: 20px;
        flex-wrap: wrap;
        margin-top: 20px;
    }
    .charts canvas {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        padding: 10px;
        max-width: 250px;
        max-height: 150px;
    }
    .forms {
        margin-top: 15px;
    }
    .form-box {
        background: white;
        padding: 10px;
        border-radius: 8px;
        margin-bottom: 10px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .form-box h4 {
        margin-top: 0;
        font-size: 1rem;
        border-bottom: 1px solid #eee;
        padding-bottom: 5px;
    }
    .form-box label {
        display: block;
        font-size: 0.85rem;
        margin-top: 5px;
    }
    .form-box input, .form-box select {
        width: 100%;
        padding: 5px;
        margin-top: 3px;
        font-size: 0.9rem;
    }
    .form-box button {
        background: #924FC2;
        color: white;
        padding: 6px 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 8px;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<div class="container">

    <!-- Widgets -->
    <div class="widgets">
        <div class="widget">
            <h3>Total Sales</h3>
            <p>$12,450</p>
        </div>
        <div class="widget">
            <h3>Total Purchases</h3>
            <p>$8,200</p>
        </div>
        <div class="widget">
            <h3>Profit</h3>
            <p>$4,250</p>
        </div>
        <div class="widget">
            <h3>Transactions</h3>
            <p>58</p>
        </div>
    </div>

    <!-- Filters -->
    <div class="filters">
        <input type="date" id="dateFilter" value="2025-08-13">
        <select id="categoryFilter">
            <option>All Categories</option>
            <option>Fruits</option>
            <option>Vegetables</option>
            <option>Grains</option>
        </select>
        <select id="typeFilter">
            <option>All Types</option>
            <option>Sale</option>
            <option>Purchase</option>
        </select>
    </div>

    <!-- Table -->
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Category</th>
                <th>Type</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Total</th>
                <th>Buyer/Seller</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>Tomatoes</td><td>Vegetables</td><td>Sale</td><td>100kg</td><td>$2</td><td>$200</td><td>John</td><td>Completed</td><td>2025-08-13</td></tr>
            <tr><td>Rice</td><td>Grains</td><td>Purchase</td><td>500kg</td><td>$1.5</td><td>$750</td><td>ABC Supplies</td><td>Pending</td><td>2025-08-13</td></tr>
        </tbody>
    </table>

    <!-- Charts -->
    <div class="charts">
        <canvas id="salesVsPurchases"></canvas>
        <canvas id="profitTrend"></canvas>
        <canvas id="categoryPie"></canvas>
    </div>

    <!-- Forms -->
    <div class="forms">
        <div class="form-box">
            <h4>Add Sale</h4>
            <label>Product</label><input type="text">
            <label>Category</label><select><option>Vegetables</option></select>
            <label>Quantity</label><input type="number">
            <label>Price</label><input type="number">
            <label>Buyer</label><input type="text">
            <button>Add Sale</button>
        </div>

        <div class="form-box">
            <h4>Add Purchase</h4>
            <label>Product</label><input type="text">
            <label>Category</label><select><option>Grains</option></select>
            <label>Quantity</label><input type="number">
            <label>Price</label><input type="number">
            <label>Seller</label><input type="text">
            <button>Add Purchase</button>
        </div>

        <div class="form-box">
            <h4>Record Return/Refund</h4>
            <label>Product</label><input type="text">
            <label>Category</label><select><option>Fruits</option></select>
            <label>Quantity</label><input type="number">
            <label>Reason</label><input type="text">
            <button>Record Return</button>
        </div>
    </div>

</div>

<script>
    new Chart(document.getElementById('salesVsPurchases'), {
        type: 'bar',
        data: {
            labels: ['Sales', 'Purchases'],
            datasets: [{ label: 'Amount', data: [12450, 8200], backgroundColor: ['#4CAF50', '#FF9800'] }]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });

    new Chart(document.getElementById('profitTrend'), {
        type: 'line',
        data: {
            labels: ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'],
            datasets: [{ label: 'Profit', data: [500,800,600,900,700,1000,750], borderColor: '#071839', fill: false }]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });

    new Chart(document.getElementById('categoryPie'), {
        type: 'pie',
        data: {
            labels: ['Fruits','Vegetables','Grains'],
            datasets: [{ data: [30,50,20], backgroundColor: ['#FF6384','#924FC2','#FFCE56'] }]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });
</script>

</body>
</html>
@include('layouts.footer')
