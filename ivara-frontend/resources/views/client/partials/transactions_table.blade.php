<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Transactions</title>
    <style>
        /* === Your CSS (same as before) === */
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
        .button-row { display: flex; gap: 8px; margin-bottom: 15px; }
        .stats-grid { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 10px; }
        .card {
            background: white; border-radius: 6px; padding: 5px;
            flex: 1; min-width: 150px; position: relative;
            margin-top: 0px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            font-size: 12px;
        }
        .card h4 { margin: 0; font-size: 13px; color: #555; margin-top: 10px; }
        .card p { font-size: 16px; margin-top: 10px; font-weight: bold; color: #2c3e50; }
        .pagination-container {
            margin: 10px 0 5px 0; margin-top: 90px;
            display: flex; justify-content: flex-end; align-items: center;
            gap: 10px; font-size: 12px;
        }
        .pagination { display: flex; gap: 5px; }
        .pagination button {
            padding: 3px 8px; font-size: 12px; border: 1px solid #4f46e5;
            background: white; color: #4f46e5; cursor: pointer; border-radius: 4px;
        }
        .pagination button.active { background: #4f46e5; color: white; }
        table {
            width: 100%; background: white; border-collapse: collapse;
            border-radius: 6px; overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            margin-top: 10px; font-size: 12px;
        }
        th, td { padding: 6px 8px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #4f46e5; color: white; font-size: 12px; }
        tr:nth-child(even) { background: #f9f9f9; }
        .action-btn {
            padding: 2px 6px; margin: 1px; font-size: 10px;
            border-radius: 4px; color: white; cursor: pointer;
            user-select: none; white-space: nowrap;
            transition: background-color 0.2s ease;
        }
        .view-btn { background: #4f46e5; }
        .edit-btn { background: #28a745; }
        .delete-btn { background: #dc3545; }
        .restock-btn { background: #17a2b8; }
        .add-btn {
            background: #4f46e5; color: white;
            padding: 6px 12px; border: none; border-radius: 6px;
            margin-top: 0px; cursor: pointer;
            display:flex; align-items: center; justify-content: center;
            font-size: 12px;
        }
        .add-supplier-btn { background: #6f42c1; }
        /* Hover effects */
        .view-btn:hover { background: #3730a3; }
        .edit-btn:hover { background: #1e7e34; }
        .delete-btn:hover { background: #a71d2a; }
        .restock-btn:hover { background: #117a8b; }
    </style>
</head>
<body>
<div class="inventory-container">
    <h2 class="header-title">Transactions</h2>

    <div id="transactionsTableContainer">
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Client</th>
                        <th>Type</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $index => $transaction)
                        <tr>
                            <td>{{ $transactions->firstItem() + $index }}</td>
                            <td>{{ $transaction->client->name ?? 'N/A' }}</td>
                            <td>{{ ucfirst($transaction->type ?? 'N/A') }}</td>
                            <td>{{ number_format($transaction->amount, 2) }}</td>
                            <td>
                                <span class="badge bg-{{ $transaction->status == 'completed' ? 'success' : 'warning' }}">
                                    {{ ucfirst($transaction->status) }}
                                </span>
                            </td>
                            <td>{{ $transaction->created_at->format('Y-m-d H:i') }}</td>
                            <td class="text-end">
                                <button class="action-btn view-btn">View</button>
                                <button class="action-btn edit-btn">Edit</button>
                                <button class="action-btn delete-btn">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No transactions found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination-container">
            {!! $transactions->links('pagination::bootstrap-5') !!}
        </div>
    </div>
</div>

<script>
function loadTransactions(url) {
    fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
    .then(async response => {
        let text = await response.text();
        try {
            // Try parsing JSON
            let data = JSON.parse(text);
            if (data.html) {
                document.getElementById('transactionsTableContainer').innerHTML = data.html;
            }
        } catch (e) {
            // If it's plain HTML, just inject it
            document.getElementById('transactionsTableContainer').innerHTML = text;
        }
    })
    .catch(error => console.error('Error:', error));
}

// Handle pagination clicks
document.addEventListener('click', function(e) {
    if (e.target.closest('.pagination a')) {
        e.preventDefault();
        let url = e.target.closest('.pagination a').getAttribute('href');
        loadTransactions(url);
    }
});
</script>
</body>
</html>
