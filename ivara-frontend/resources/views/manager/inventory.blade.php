
@include('layouts.header')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Dashboard</title>
    <style>
        /* === Your Provided CSS (unchanged) === */
        body {
            background: #f4f6f8;
            font-family: Arial, sans-serif;
            margin-top: 0px;
            margin-bottom: 25px;
            font-size: 12px;
        }
        .inventory-container {
            width: 81.5%;
            margin-left: 17.5%;
            margin-top: 0px;
            position: relative;
            font-size: 12px;
        }
        .header-title {
            font-size: 16px;
            margin-top: 10px;
            margin-bottom: 15px;
            color: #2c3e50;
        }
        .alert-success {
            background-color: #d4edda;
            border-left: 3px solid #28a745;
            color: #155724;
            padding: 6px 12px;
            margin-bottom: 15px;
            border-radius: 5px;
            font-weight: 600;
            animation: fadeOut 6s forwards;
            font-size: 12px;
        }
        @keyframes fadeOut {
            0% {opacity: 1;}
            80% {opacity: 1;}
            100% {opacity: 0; display: none;}
        }
        .button-row {
            display: flex;
            gap: 8px;
            margin-bottom: 15px;
        }
        .stats-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 10px;
        }
        .card {
            background: white;
            border-radius: 6px;
            padding: 5px;
            flex: 1;
            min-width: 150px;
            position: relative;
            margin-top: 0px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            font-size: 12px;
        }
        .card h4 {
            margin: 0;
            font-size: 13px;
            color: #555;
            margin-top: 10px;
        }
        .card p {
            font-size: 16px;
            margin-top: 10px;
            font-weight: bold;
            color: #2c3e50;
        }
        .pagination-container {
            margin: 10px 0 5px 0;
            margin-top: 90px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 10px;
            font-size: 12px;
        }
        .pagination {
            display: flex;
            gap: 5px;
        }
        .pagination button {
            padding: 3px 8px;
            font-size: 12px;
            border: 1px solid #924FC2;
            background: white;
            color: #924FC2;
            cursor: pointer;
            border-radius: 4px;
        }
        .pagination button.active {
            background: #924FC2;
            color: white;
        }
        table {
            width: 100%;
            background: white;
            border-collapse: collapse;
            border-radius: 6px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            margin-top: 10px;
            font-size: 12px;
        }
        th, td {
            padding: 6px 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background: #924FC2;
            color: white;
            font-size: 12px;
        }
        tr:nth-child(even) {
            background: #f9f9f9;
        }
        .action-btn {
            padding: 2px 6px;
            margin: 1px;
            font-size: 10px;
            border-radius: 4px;
            color: white;
            cursor: pointer;
            user-select: none;
            white-space: nowrap;
        }
        .view-btn { background: #924FC2; }
        .edit-btn { background: #28a745; }
        .delete-btn { background: #dc3545; }
        .restock-btn { background: #17a2b8; }
        .add-btn {
            background: #924FC2;
            color: white;
            padding: 6px 12px;
            border: none;
            border-radius: 6px;
            margin-top: 0px;
            cursor: pointer;
            display:flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
        }
        .add-supplier-btn {
            background: #6f42c1;
        }
        .modal {
            display: none;
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        .modal-content {
            background: white;
            padding: 15px 20px;
            border-radius: 10px;
            width: 380px;
            margin-top: 15px;
            position: relative;
            font-size: 12px;
        }
        .modal-header {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 10px;
            margin-top: 0;
        }
        .modal input,
        .modal select,
        .modal textarea {
            width: 100%;
            margin-top: 8px;
            margin-bottom: 6px;
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 12px;
            box-sizing: border-box;
            height: 26px;
            resize: vertical;
        }
        .modal textarea {
            min-height: 50px;
        }
        .close-modal {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            color: #888;
            font-size: 14px;
            user-select: none;
        }
        #itemsPerPage {
            padding: 3px 6px;
            font-size: 12px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>

<div class="inventory-container">

    <!-- Stat Cards -->
    <div class="stats-grid">
        <div class="card">
            <h3>Total Products</h3>
            <p><strong>152</strong></p>
        </div>
        <div class="card">
            <h3>Low Stock Alerts</h3>
            <p><strong>8</strong></p>
        </div>
        <div class="card">
            <h3>Total Categories</h3>
            <p><strong>12</strong></p>
        </div>
        <div class="card">
            <h3>Suppliers</h3>
            <p><strong>5</strong></p>
        </div>
        <div class="card">
            <h3>Total Stock Value</h3>
            <p><strong>$4,560</strong></p>
        </div>
    </div>

    <!-- Charts -->
    <div class="stats-grid" style="margin-top:10px;">
        <div class="card">
            <h3>Stock by Category</h3>
            <canvas id="categoryChart"></canvas>
        </div>
        <div class="card">
            <h3>Monthly Purchases</h3>
            <canvas id="purchaseChart"></canvas>
        </div>
        <div class="card">
            <h3>Reorder Level Status</h3>
            <canvas id="reorderChart"></canvas>
        </div>
    </div>

    <!-- Inventory Table -->
    <div class="card" style="margin-top:10px;">
        <h3>Inventory List</h3>
        <button class="add-btn" onclick="openModal('addProductModal')">➕ Add Product</button>
        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Category</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Supplier</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Tomatoes</td>
                    <td>Vegetables</td>
                    <td>120 kg</td>
                    <td>$1.20/kg</td>
                    <td>FreshFarm Ltd</td>
                    <td>
                        <button class="action-btn edit-btn" onclick="openModal('editProductModal')">Edit</button>
                        <button class="action-btn restock-btn" onclick="openModal('restockModal')">Restock</button>
                        <button class="action-btn delete-btn">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>Rice</td>
                    <td>Grains</td>
                    <td>90 bags</td>
                    <td>$20/bag</td>
                    <td>AgroTrade Co</td>
                    <td>
                        <button class="action-btn edit-btn" onclick="openModal('editProductModal')">Edit</button>
                        <button class="action-btn restock-btn" onclick="openModal('restockModal')">Restock</button>
                        <button class="action-btn delete-btn">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

<!-- Add Product Modal -->
<div id="addProductModal" class="modal">
    <div class="modal-content">
        <span class="close-modal" onclick="closeModal('addProductModal')">&times;</span>
        <h3>Add Product</h3>
        <input type="text" placeholder="Product Name">
        <input type="text" placeholder="Category">
        <input type="number" placeholder="Quantity">
        <input type="number" placeholder="Price">
        <input type="text" placeholder="Supplier">
        <input type="number" placeholder="Reorder Level">
        <button class="add-btn">Save</button>
    </div>
</div>

<!-- Edit Product Modal -->
<div id="editProductModal" class="modal">
    <div class="modal-content">
        <span class="close-modal" onclick="closeModal('editProductModal')">&times;</span>
        <h3>Edit Product</h3>
        <input type="text" placeholder="Product Name">
        <input type="text" placeholder="Category">
        <input type="number" placeholder="Quantity">
        <input type="number" placeholder="Price">
        <input type="text" placeholder="Supplier">
        <input type="number" placeholder="Reorder Level">
        <button class="action-btn edit-btn">Update</button>
    </div>
</div>

<!-- Restock Modal -->
<div id="restockModal" class="modal">
    <div class="modal-content">
        <span class="close-modal" onclick="closeModal('restockModal')">&times;</span>
        <h3>Restock Product</h3>
        <input type="number" placeholder="Add Quantity">
        <button class="action-btn restock-btn">Restock</button>
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

    // Stock by Category Chart
    new Chart(document.getElementById('categoryChart'), {
        type: 'pie',
        data: {
            labels: ['Vegetables', 'Fruits', 'Grains', 'Dairy'],
            datasets: [{
                data: [40, 25, 20, 15],
                backgroundColor: ['#4caf50','#ff9800','#2196f3','#9c27b0']
            }]
        },
        options: {
            plugins: { legend: { position: 'bottom', labels: { boxWidth: 12 } } }
        }
    });

    // Monthly Purchases Chart
    new Chart(document.getElementById('purchaseChart'), {
        type: 'bar',
        data: {
            labels: ['Jan','Feb','Mar','Apr','May','Jun'],
            datasets: [{
                label: 'Purchases',
                data: [12, 19, 8, 17, 14, 22],
                backgroundColor: '#924FC2'
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { y: { ticks: { font: { size: 10 } } }, x: { ticks: { font: { size: 10 } } } }
        }
    });

    // Reorder Level Chart
    new Chart(document.getElementById('reorderChart'), {
        type: 'doughnut',
        data: {
            labels: ['Below Reorder', 'Sufficient Stock'],
            datasets: [{
                data: [8, 144],
                backgroundColor: ['#dc3545','#28a745']
            }]
        },
        options: {
            plugins: { legend: { position: 'bottom', labels: { boxWidth: 12 } } }
        }
    });
</script>

</body>
</html>

@include('layouts.footer')
