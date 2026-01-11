@extends('layouts.app')

@section('title', 'My Orders - IVARA Marketplace')

@section('content')
<style>
    :root {
        --primary-navy: #0A1128;
        --secondary-navy: #162447;
        --accent-gold: #924FC2;
        --bg-light: #f8f9fa;
        --text-gray: #666;
    }

    .orders-container {
        max-width: 1000px;
        margin: 40px auto;
        padding: 0 20px;
        font-family: 'Poppins', sans-serif;
    }

    .orders-header {
        margin-bottom: 30px;
        border-bottom: 2px solid #eee;
        padding-bottom: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .orders-header h1 {
        font-size: 2rem;
        color: var(--primary-navy);
        font-weight: 800;
        margin: 0;
    }

    .order-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        margin-bottom: 25px;
        overflow: hidden;
        border: 1px solid #eee;
        transition: transform 0.2s;
    }

    .order-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    }

    .order-header {
        background: #f8f9fa;
        padding: 15px 20px;
        border-bottom: 1px solid #eee;
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 15px;
    }

    .order-meta {
        font-size: 0.85rem;
        color: #666;
        display: flex;
        gap: 20px;
    }

    .order-meta strong {
        color: var(--primary-navy);
        display: block;
        font-size: 0.95rem;
    }

    .order-status {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
    }

    .status-pending { background: #fff3cd; color: #856404; }
    .status-processing { background: #cce5ff; color: #004085; }
    .status-shipped { background: #d4edda; color: #155724; }
    .status-delivered { background: #d1ecf1; color: #0c5460; }
    .status-cancelled { background: #f8d7da; color: #721c24; }

    .order-body {
        padding: 20px;
    }

    .order-item {
        display: flex;
        gap: 20px;
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid #f5f5f5;
    }

    .order-item:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }

    .item-img {
        width: 80px;
        height: 80px;
        border-radius: 8px;
        object-fit: cover;
        background: #f8f9fa;
    }

    .item-info {
        flex: 1;
    }

    .item-name {
        font-weight: 700;
        color: var(--primary-navy);
        margin-bottom: 5px;
        font-size: 1.05rem;
    }

    .item-meta {
        font-size: 0.9rem;
        color: #777;
    }

    .order-footer {
        padding: 15px 20px;
        background: #fff;
        border-top: 1px solid #eee;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .btn-view {
        padding: 8px 20px;
        background: var(--primary-navy);
        color: white;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        transition: 0.3s;
    }

    .btn-view:hover {
        background: var(--accent-gold);
        color: var(--primary-navy);
    }

    .empty-orders {
        text-align: center;
        padding: 60px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }

    .empty-orders i {
        font-size: 4rem;
        color: #ddd;
        margin-bottom: 20px;
    }

    .btn-shop {
        display: inline-block;
        margin-top: 20px;
        padding: 12px 30px;
        background: var(--accent-gold);
        color: var(--primary-navy);
        border-radius: 8px;
        text-decoration: none;
        font-weight: 700;
    }

    /* Dark Mode Overrides */
    [data-theme="dark"] .orders-header {
        border-bottom-color: rgba(255, 255, 255, 0.1);
    }

    [data-theme="dark"] .orders-header h1 {
        color: #f8fafc;
    }

    [data-theme="dark"] .orders-header a {
        color: #94a3b8 !important;
    }

    [data-theme="dark"] .order-card {
        background: #1e293b;
        border-color: rgba(255, 255, 255, 0.1);
        box-shadow: 0 4px 6px rgba(0,0,0,0.3);
    }
    
    [data-theme="dark"] .order-header {
        background: rgba(0, 0, 0, 0.2);
        border-bottom-color: rgba(255, 255, 255, 0.1);
    }

    [data-theme="dark"] .order-footer {
        background: rgba(0, 0, 0, 0.2);
        border-top-color: rgba(255, 255, 255, 0.1);
    }

    [data-theme="dark"] .order-meta span {
        color: #94a3b8;
    }
    
    [data-theme="dark"] .order-meta strong {
        color: #f8fafc;
    }

    [data-theme="dark"] .order-item {
        border-bottom-color: rgba(255, 255, 255, 0.1);
    }

    [data-theme="dark"] .item-name {
        color: #f8fafc;
    }
    
    [data-theme="dark"] .item-meta {
        color: #94a3b8;
    }
    
    [data-theme="dark"] .item-img {
        background: #0f172a;
        border-color: rgba(255, 255, 255, 0.1) !important;
    }
    
    /* Empty Orders State */
    [data-theme="dark"] .empty-orders {
        background: #1e293b;
        box-shadow: 0 4px 6px rgba(0,0,0,0.3);
    }
    
    [data-theme="dark"] .empty-orders h2 {
        color: #f8fafc;
    }
    
    [data-theme="dark"] .empty-orders p {
        color: #94a3b8;
    }
    
    [data-theme="dark"] .empty-orders i {
        color: #334155;
    }

    /* Status Badges Dark Mode */
    [data-theme="dark"] .status-pending { background: rgba(255, 193, 7, 0.2); color: #924FC2 !important; }
    [data-theme="dark"] .status-processing { background: rgba(13, 110, 253, 0.2); color: #6ea8fe !important; }
    [data-theme="dark"] .status-shipped { background: rgba(25, 135, 84, 0.2); color: #75b798 !important; }
    [data-theme="dark"] .status-delivered { background: rgba(13, 202, 240, 0.2); color: #3dd5f3 !important; }
    [data-theme="dark"] .status-cancelled { background: rgba(220, 53, 69, 0.2); color: #ea868f !important; }
</style>

<div class="orders-container">
    <div class="orders-header">
        <h1>My Orders</h1>
        <a href="{{ route('marketplace.index') }}" style="color: var(--primary-navy); font-weight: 600; text-decoration: none;">
            <i class="fas fa-arrow-left"></i> Back to Market
        </a>
    </div>

    @if(isset($error))
        <div class="alert alert-danger">{{ $error }}</div>
    @endif

    @if(count($orders) > 0)
        @foreach($orders as $order)
            @php
                $orderId = $order['_id'] ?? null;
                $displayId = $orderId ? strtoupper(substr($orderId, -8)) : 'N/A';
                $orderNumber = $order['orderNumber'] ?? $displayId;
                $createdAt = $order['createdAt'] ?? now();
                $totalAmount = $order['totalAmount'] ?? 0;
                $status = $order['status'] ?? 'pending';
                $items = $order['items'] ?? [];
                $paymentMethod = $order['paymentMethod'] ?? 'N/A';
            @endphp
            <div class="order-card">
                <div class="order-header">
                    <div class="order-meta">
                        <div>
                            <span>ORDER PLACED</span>
                            <strong>{{ \Carbon\Carbon::parse($createdAt)->format('d M Y') }}</strong>
                        </div>
                        <div>
                            <span>TOTAL</span>
                            <strong>{{ number_format($totalAmount) }} FRW</strong>
                        </div>
                        <div>
                            <span>ORDER #</span>
                            <strong>{{ $orderNumber }}</strong>
                        </div>
                    </div>
                    <div>
                        <span class="order-status status-{{ strtolower($status) }}">
                            {{ $status }}
                        </span>
                    </div>
                </div>
                
                <div class="order-body">
                    @foreach($items as $item)
                        @php
                            $product = $item['productId'] ?? [];
                            $name = $product['name'] ?? ($item['productName'] ?? 'Product');
                            $price = $item['price'] ?? 0;
                            $quantity = $item['quantity'] ?? 1;
                            $image = null;
                            if (isset($product['images']) && is_array($product['images']) && count($product['images']) > 0) {
                                $image = $product['images'][0];
                            }
                            if ($image && !str_starts_with($image, 'http')) {
                                $image = rtrim($backendUrl, '/') . '/' . ltrim($image, '/');
                            }
                        @endphp
                        <div class="order-item">
                            @if($image)
                                <img src="{{ $image }}" class="item-img" onerror="this.style.display='none'; this.parentElement.querySelector('.fallback-icon').style.display='flex';">
                                <div class="item-img fallback-icon" style="display: none; align-items: center; justify-content: center; font-size: 1.5rem; color: #ccc; border: 1px solid #eee;">
                                    <i class="fas fa-box"></i>
                                </div>
                            @else
                                <div class="item-img" style="display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: #ccc; border: 1px solid #eee;">
                                    <i class="fas fa-box"></i>
                                </div>
                            @endif
                            <div class="item-info">
                                <div class="item-name">{{ $name }}</div>
                                <div class="item-meta">
                                    Qty: {{ $quantity }} × {{ number_format($price) }} FRW
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="order-footer">
                    <span style="font-size: 0.9rem; color: #777;">
                        Payment Method: {{ strtoupper($paymentMethod) }}
                    </span>
                    @if($orderId)
                        <a href="{{ route('orders.show', $orderId) }}" class="btn-view">View Details</a>
                    @else
                        <button class="btn-view" disabled style="opacity: 0.5; cursor: not-allowed;">Details Unavailable</button>
                    @endif
                </div>
            </div>
        @endforeach
    @else
        <div class="empty-orders">
            <i class="fas fa-shopping-bag"></i>
            <h2>No orders found</h2>
            <p>You haven't placed any orders yet. Start exploring our marketplace!</p>
            <a href="{{ route('marketplace.index') }}" class="btn-shop">Explore Marketplace</a>
        </div>
    @endif
</div>
@endsection
