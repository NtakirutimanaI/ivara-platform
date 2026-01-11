@extends('layouts.app')

@section('title', 'Seller Dashboard - IVARA Marketplace')

@section('content')
<style>
    .seller-dashboard {
        max-width: 1400px;
        margin: 40px auto;
        padding: 0 20px;
        font-family: 'Poppins', sans-serif;
    }
    
    .dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 40px;
    }
    
    .stat-card {
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        border: 1px solid #eee;
    }
    
    .stat-title {
        color: #777;
        font-size: 0.9rem;
        margin-bottom: 10px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        color: var(--primary-navy);
    }
    
    .orders-section {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }
    
    .tabs {
        display: flex;
        gap: 20px;
        border-bottom: 1px solid #eee;
        margin-bottom: 20px;
        overflow-x: auto;
    }
    
    .tab {
        padding: 10px 0;
        color: #777;
        text-decoration: none;
        font-weight: 600;
        border-bottom: 3px solid transparent;
        white-space: nowrap;
    }
    
    .tab.active {
        color: var(--primary-navy);
        border-color: var(--accent-gold);
    }
    
    .order-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .order-table th {
        text-align: left;
        padding: 15px;
        background: #f8f9fa;
        color: #555;
        font-weight: 600;
    }
    
    .order-table td {
        padding: 15px;
        border-bottom: 1px solid #eee;
        vertical-align: middle;
    }
    
    .status-badge {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }
    
    .status-pending { background: #fff3cd; color: #856404; }
    .status-confirmed { background: #cce5ff; color: #004085; }
    .status-shipped { background: #d4edda; color: #155724; }
    .status-delivered { background: #d1ecf1; color: #0c5460; }
    .status-cancelled { background: #f8d7da; color: #721c24; }
    
    .action-btn {
        padding: 6px 12px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 0.8rem;
        margin-right: 5px;
        transition: 0.2s;
    }
    
    .btn-approve { background: #28a745; color: white; }
    .btn-ship { background: #17a2b8; color: white; }
    .btn-deliver { background: #007bff; color: white; }
    .btn-cancel { background: #dc3545; color: white; }
    
    .btn-approve:hover { background: #218838; }
    .btn-ship:hover { background: #138496; }
    .btn-deliver:hover { background: #0069d9; }
    .btn-cancel:hover { background: #c82333; }
</style>

<div class="seller-dashboard">
    <div class="dashboard-header">
        <h1>Seller Dashboard</h1>
        <div>
            <a href="{{ route('seller.products.create') }}" class="btn btn-primary" style="margin-right: 10px;">
                <i class="fas fa-plus"></i> Add Product
            </a>
            <a href="{{ route('marketplace.index') }}" class="btn btn-outline-primary">Marketplace Home</a>
        </div>
    </div>
    
    <!-- Stats -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-title">Total Orders</div>
            <div class="stat-value">{{ $stats['totalOrders'] ?? 0 }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-title">Total Revenue</div>
            <div class="stat-value">{{ number_format($stats['totalRevenue'] ?? 0) }} FRW</div>
        </div>
        <div class="stat-card">
            <div class="stat-title">Pending Orders</div>
            @php
                $pendingCount = 0;
                if(isset($stats['byStatus'])) {
                    foreach($stats['byStatus'] as $s) {
                        if($s['_id'] === 'Pending') $pendingCount = $s['count'];
                    }
                }
            @endphp
            <div class="stat-value" style="color: #924FC2;">{{ $pendingCount }}</div>
        </div>
    </div>
    
    <!-- Orders Section -->
    <div class="orders-section">
        <div class="tabs">
            <a href="{{ route('seller.dashboard') }}" class="tab {{ $currentStatus == '' ? 'active' : '' }}">All Orders</a>
            <a href="{{ route('seller.dashboard', ['status' => 'Pending']) }}" class="tab {{ $currentStatus == 'Pending' ? 'active' : '' }}">Pending</a>
            <a href="{{ route('seller.dashboard', ['status' => 'Confirmed']) }}" class="tab {{ $currentStatus == 'Confirmed' ? 'active' : '' }}">Confirmed</a>
            <a href="{{ route('seller.dashboard', ['status' => 'Shipped']) }}" class="tab {{ $currentStatus == 'Shipped' ? 'active' : '' }}">Shipped</a>
            <a href="{{ route('seller.dashboard', ['status' => 'Delivered']) }}" class="tab {{ $currentStatus == 'Delivered' ? 'active' : '' }}">Delivered</a>
        </div>
        
        <table class="order-table">
            <thead>
                <tr>
                    <th>Order #</th>
                    <th>Date</th>
                    <th>Customer</th>
                    <th>Items</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                @php
                    $orderId = $order['_id'] ?? '';
                @endphp
                <tr>
                    <td>{{ $order['orderNumber'] ?? strtoupper(substr($orderId, -8)) }}</td>
                    <td>{{ \Carbon\Carbon::parse($order['createdAt'] ?? now())->format('d M Y') }}</td>
                    <td>{{ $order['buyerId']['name'] ?? 'Unknown' }}</td>
                    <td>
                        @foreach($order['items'] as $item)
                            <div style="font-size: 0.85rem;">
                                {{ $item['quantity'] }}x {{ \Illuminate\Support\Str::limit($item['productName'], 30) }}
                            </div>
                        @endforeach
                    </td>
                    <td>{{ number_format($order['totalAmount'] ?? 0) }} FRW</td>
                    <td>
                        <span class="status-badge status-{{ strtolower($order['status']) }}">
                            {{ $order['status'] }}
                        </span>
                    </td>
                    <td>
                        @if($order['status'] === 'Pending')
                        <button onclick="updateStatus('{{ $orderId }}', 'Confirmed')" class="action-btn btn-approve" title="Approve Order">
                            <i class="fas fa-check"></i> Approve
                        </button>
                        <button onclick="updateStatus('{{ $orderId }}', 'Cancelled')" class="action-btn btn-cancel" title="Reject Order">
                            <i class="fas fa-times"></i> Reject
                        </button>
                        @elseif($order['status'] === 'Confirmed')
                        <button onclick="updateStatus('{{ $orderId }}', 'Shipped')" class="action-btn btn-ship" title="Mark Shipped">
                            <i class="fas fa-shipping-fast"></i> Ship
                        </button>
                        @elseif($order['status'] === 'Shipped')
                        <button onclick="updateStatus('{{ $orderId }}', 'Delivered')" class="action-btn btn-deliver" title="Mark Delivered">
                            <i class="fas fa-box-open"></i> Delivered
                        </button>
                        @endif
                        
                        <a href="{{ route('orders.show', $orderId) }}" class="action-btn" style="background:#6c757d; color:white; text-decoration:none;">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align: center; padding: 40px; color: #777;">
                        No orders found in this category.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        
        @if($pagination && $pagination['pages'] > 1)
            <div style="margin-top: 20px; text-align: center;">
                @for($i = 1; $i <= $pagination['pages']; $i++)
                    <a href="{{ request()->fullUrlWithQuery(['page' => $i]) }}" 
                       style="display:inline-block; padding:5px 10px; margin:0 2px; border:1px solid #ddd; border-radius:4px; text-decoration:none; {{ $pagination['page'] == $i ? 'background:var(--primary-navy); color:white;' : 'color:#333;' }}">
                        {{ $i }}
                    </a>
                @endfor
            </div>
        @endif
    </div>
</div>

<script>
    function updateStatus(orderId, status) {
        if(!confirm(`Are you sure you want to mark this order as ${status}?`)) return;
        
        const btn = event.target.closest('button');
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
        btn.disabled = true;
        
        fetch(`{{ url('/seller/orders') }}/${orderId}/status`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ status: status })
        })
        .then(res => res.json())
        .then(data => {
            if(data.success) {
                location.reload();
            } else {
                alert('Failed to update: ' + (data.message || 'Unknown error'));
                btn.innerHTML = originalText;
                btn.disabled = false;
            }
        })
        .catch(err => {
            alert('Error updating status');
            console.error(err);
            btn.innerHTML = originalText;
            btn.disabled = false;
        });
    }
</script>
@endsection
