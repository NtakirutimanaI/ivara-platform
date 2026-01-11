@include('manager.connect')
@include('layouts.header')
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sales Dashboard</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background: #f4f6f8;
        margin: 0;
        padding: 0;
        color: #333;
    }
    header {
        background: #0d253f;
        color: white;
        padding: 10px 20px;
        text-align: center;
        font-size: 2em;
        font-weight: bold;
    }
    .container {
        max-width: 80%;
        margin: auto;
        margin-left:240px;
        padding: 15px;
    }
    .grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 10px;
    }
    .card {
        background: white;
        margin-left:10px;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.1);
        font-size: 1em;
    }
    .card h3 {
        font-size: 1.5em;
        margin: 0 0 8px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 1em;
    }
    th, td {
        padding: 6px;
        border-bottom: 1px solid #ddd;
        text-align: left;
    }
    th {
        background: #e9ecef;
    }
    .btn {
        padding: 4px 8px;
        font-size: 0.75em;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    .btn-primary { background: #4f46e5; color: white; }
    .btn-warning { background: #924FC2; color: black; }
    .btn-danger { background: #dc3545; color: white; }
    .btn-success { background: #28a745; color: white; }
    /* Modal */
    .modal {
        display: none;
        position: fixed;
        z-index: 999;
        padding-top: 80px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background: rgba(0,0,0,0.4);
    }
    .modal-content {
        background: white;
        margin: auto;
        padding: 15px;
        border-radius: 8px;
        width: 280px;
    }
    .modal-content h3 {
        margin-top: 0;
    }
    input, select {
        width: 100%;
        padding: 5px;
        margin: 5px 0;
        font-size: 0.8em;
    }
    .close {
        float: right;
        font-size: 1.2em;
        cursor: pointer;
    }
    canvas {
        max-width: 100%;
        height: 100px !important; /* Very small chart height */
    }
</style>
</head>
<body>

<div class="container">

    <!-- Small Stat Cards -->
    <div class="grid">
        <div class="card">
            <h3>Total Sales (Today)</h3>
            <p><strong>$1,250</strong></p>
        </div>
        <div class="card">
            <h3>Total Orders</h3>
            <p><strong>35</strong></p>
        </div>
        <div class="card">
            <h3>Top Selling Category</h3>
            <p><strong>Beverages</strong></p>
        </div>
        <div class="card">
            <h3>Pending Deliveries</h3>
            <p><strong>6</strong></p>
        </div>
    </div>

    <!-- Charts -->
    <div class="grid" style="margin-top:10px;">
        <div class="card">
            <h3>Sales by Category</h3>
            <canvas id="categorySalesChart"></canvas>
        </div>
        <div class="card">
            <h3>Monthly Revenue</h3>
            <canvas id="monthlyRevenueChart"></canvas>
        </div>
        <div class="card">
            <h3>Region-wise Sales</h3>
            <canvas id="regionSalesChart"></canvas>
        </div>
    </div>

    <!-- Sales Table -->
    <div class="card" style="margin-top:10px;">
        <h3>Recent Sales</h3>
        <button class="btn btn-primary" onclick="openModal('addSaleModal')">➕ Record Sale</button>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Qty</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                    <th>Region</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>2025-08-13</td>
                    <td>Cola Drink</td>
                    <td>Beverages</td>
                    <td>20</td>
                    <td>$1.50</td>
                    <td>$30</td>
                    <td>North</td>
                    <td>
                        <button class="btn btn-warning" onclick="openModal('editSaleModal')">Edit</button>
                        <button class="btn btn-danger">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

<!-- Add Sale Modal -->
<div id="addSaleModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('addSaleModal')">&times;</span>
        <h3>Record New Sale</h3>
        <input type="date">
        <input type="text" placeholder="Product Name">
        <input type="text" placeholder="Category">
        <input type="number" placeholder="Quantity">
        <input type="number" placeholder="Unit Price">
        <input type="text" placeholder="Region">
        <button class="btn btn-primary">Save</button>
    </div>
</div>

<!-- Edit Sale Modal -->
<div id="editSaleModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('editSaleModal')">&times;</span>
        <h3>Edit Sale</h3>
        <input type="date">
        <input type="text" placeholder="Product Name">
        <input type="text" placeholder="Category">
        <input type="number" placeholder="Quantity">
        <input type="number" placeholder="Unit Price">
        <input type="text" placeholder="Region">
        <button class="btn btn-warning">Update</button>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    function openModal(id) {
        document.getElementById(id).style.display = 'block';
    }
    function closeModal(id) {
        document.getElementById(id).style.display = 'none';
    }

    // Sales by Category
    new Chart(document.getElementById('categorySalesChart'), {
        type: 'pie',
        data: {
            labels: ['Beverages', 'Snacks', 'Dairy', 'Bakery'],
            datasets: [{
                data: [40, 25, 20, 15],
                backgroundColor: ['#4caf50','#ff9800','#4f46e5','#9c27b0']
            }]
        }
    });

    // Monthly Revenue
    new Chart(document.getElementById('monthlyRevenueChart'), {
        type: 'bar',
        data: {
            labels: ['Jan','Feb','Mar','Apr','May','Jun'],
            datasets: [{
                label: 'Revenue ($)',
                data: [5000, 6200, 4800, 7000, 5600, 8000],
                backgroundColor: '#4f46e5'
            }]
        }
    });

    // Region Sales
    new Chart(document.getElementById('regionSalesChart'), {
        type: 'doughnut',
        data: {
            labels: ['North', 'South', 'East', 'West'],
            datasets: [{
                data: [30, 25, 20, 25],
                backgroundColor: ['#ff5722','#8bc34a','#4f46e5','#924FC2']
            }]
        }
    });
</script>

</body>
</html>
@include('layouts.footer')
